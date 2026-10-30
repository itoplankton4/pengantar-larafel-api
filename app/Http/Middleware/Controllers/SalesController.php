<?php

• namespace App\Http\Middleware\Controllers;

• use App\Events\OrderPlaced;

use App\Models\Product;
use App\Models\Sale;
use App\Models\StockMovement;
use App\Models\StoreSetting;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class SalesController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'transaction_number' => ['required', 'string', 'max:50', 'unique:sales,transaction_number'],
            'payment_method' => ['required', 'string', 'max:40'],
            'customer_type' => ['required', 'string', 'max:60'],
            'discount_percent' => ['required', 'numeric', 'between:0,100'],
            'discount_amount' => ['required', 'numeric', 'min:0'],
            'tax' => ['required', 'numeric', 'min:0'],
            'other_fee' => ['required', 'numeric', 'min:0'],
            'paid' => ['required', 'numeric', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'min:1'],
            'items.*.code' => ['required', 'string', 'max:20'],
            'items.*.name' => ['required', 'string', 'max:80'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
        ]);

        $subtotal = collect($data['items'])->sum(fn (array $item) => $item['price'] * $item['qty']);
        $discount = ($subtotal * $data['discount_percent'] / 100) + $data['discount_amount'];
        $total = max(0, round($subtotal - $discount + $data['tax'] + $data['other_fee']));

        if ($data['paid'] < $total) {
            return response()->json(['message' => 'Pembayaran kurang dari total transaksi.'], 422);
        }

        $productIds = collect($data['items'])->pluck('id')->all();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        foreach ($data['items'] as $item) {
            $product = $products->get($item['id']);

            if (! $product) {
                return response()->json(['message' => 'Produk tidak ditemukan.'], 422);
            }

            if ($product->stock < $item['qty']) {
                return response()->json([
                    'message' => 'Stok untuk produk '.$product->name.' tidak mencukupi.',
                ], 422);
            }
        }

        $sale = DB::transaction(function () use ($data, $request, $products, $subtotal, $discount, $total) {
            foreach ($data['items'] as $item) {
                $product = $products->get($item['id']);
                if ($product) {
                    $product->decrement('stock', $item['qty']);
                    StockMovement::create([
                        'product_id' => $product->id,
                        'movement_type' => 'out',
                        'quantity' => $item['qty'],
                        'note' => 'Penjualan #' . $data['transaction_number'],
                        'created_by' => $request->user()->id,
                    ]);
                }
            }

            return Sale::create([
                'transaction_number' => $data['transaction_number'],
                'cashier_id' => $request->user()->id,
                'payment_method' => $data['payment_method'],
                'customer_type' => $data['customer_type'],
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $data['tax'],
                'other_fee' => $data['other_fee'],
                'total' => $total,
                'paid' => $data['paid'],
                'items' => $data['items'],
                'is_demo' => false,
            ]);
        });
        broadcast(new OrderPlaced($sale, $request->user()));

        return response()->json([
            'id' => $sale->id,
            'transaction_number' => $sale->transaction_number,
            'total' => $sale->total,
            'receipt_url' => route('sales.receipt', $sale),
        ], 201);
    }

    public function receipt(Request $request, Sale $sale): View
    {
        if ($request->user()->role !== 'admin' && $sale->cashier_id !== $request->user()->id) {
            abort(403);
        }

        $sale->load('cashier');
        $store = Schema::hasTable('store_settings')
            ? StoreSetting::query()->latest()->first()
            : null;
        $store ??= (object) [
            'name' => 'VitoMart',
            'address' => 'Jl. Contoh No. 123',
            'city' => 'Jember',
            'phone' => '0812-xxxx-xxxx',
        ];

        return view('sales.receipt', compact('sale', 'store'));
    }

    public function itemsReport(): JsonResponse
    {
        $report = Sale::query()
            ->where('is_demo', false)
            ->get(['items'])
            ->flatMap(fn (Sale $sale) => $sale->items ?? [])
            ->groupBy(fn (array $item) => $item['id'] ?? $item['code'] ?? $item['name'])
            ->map(function ($items, $groupKey) {
                $first = $items->first();
                $quantity = $items->sum(fn (array $item) => (int) ($item['qty'] ?? 0));
                $revenue = $items->sum(fn (array $item) => (float) (($item['price'] ?? 0) * ($item['qty'] ?? 0)));

                return [
                    'product_id' => $first['id'] ?? null,
                    'product_code' => $first['code'] ?? null,
                    'product_name' => $first['name'] ?? 'Produk',
                    'quantity_sold' => $quantity,
                    'total_revenue' => round($revenue),
                ];
            })
            ->sortByDesc('total_revenue')
            ->values();

        return response()->json($report);
    }

    public function export(Request $request, string $format): Response
    {
        $format = strtolower($format);

        if (! in_array($format, ['csv', 'pdf'], true)) {
            abort(404);
        }

        $sales = Sale::query()->where('is_demo', false)->orderBy('created_at')->get();
        $rows = [[
            'Tanggal',
            'Transaksi',
            'Produk',
            'Qty',
            'Harga',
            'Total',
        ]];

        foreach ($sales as $sale) {
            foreach ($sale->items ?? [] as $item) {
                $rows[] = [
                    $sale->created_at?->format('d-m-Y H:i') ?? '-',
                    $sale->transaction_number,
                    $item['name'] ?? 'Produk',
                    (int) ($item['qty'] ?? 0),
                    number_format((float) ($item['price'] ?? 0), 0, ',', '.'),
                    number_format((float) (($item['price'] ?? 0) * ($item['qty'] ?? 0)), 0, ',', '.'),
                ];
            }
        }

        if ($format === 'csv') {
            return response($this->toCsv($rows), 200, [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="laporan-penjualan.csv"',
            ]);
        }

        return response($this->toPdf($rows), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="laporan-penjualan.pdf"',
        ]);
    }

    private function toCsv(array $rows): string
    {
        $handle = fopen('php://temp', 'r+');
        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return $csv ?: '';
    }

    private function toPdf(array $rows): string
    {
        $lines = ['LAPORAN PENJUALAN', ''];
        foreach (array_slice($rows, 1, 12) as $row) {
            $lines[] = implode(' | ', $row);
        }

        $stream = "BT\n/F1 12 Tf\n50 760 Td\n";
        foreach ($lines as $index => $line) {
            $stream .= sprintf("50 %d Td (%s) Tj\n", 750 - ($index * 18), $this->escapePdfText($line));
        }
        $stream .= "ET\n";

        $objects = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 5 0 R >> >> /Contents 4 0 R >>',
            sprintf('<< /Length %d >>\nstream\n%s\nendstream', strlen($stream), $stream),
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($index + 1) . " 0 obj\n" . $object . "\nendobj\n";
        }

        $xrefPosition = strlen($pdf);
        $pdf .= "xref\n0 " . count($offsets) . "\n";
        $pdf .= "0000000000 65535 f \n";
        foreach (array_slice($offsets, 1) as $offset) {
            $pdf .= sprintf("%010d 00000 n \n", $offset);
        }
        $pdf .= "trailer\n<< /Size " . count($offsets) . " /Root 1 0 R >>\nstartxref\n" . $xrefPosition . "\n%%EOF";

        return $pdf;
    }

    private function escapePdfText(string $value): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $value);
    }

    public function checkout(Request $request): JsonResponse
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1000'],
            'order_id' => ['required', 'string', 'max:80'],
            'customer_name' => ['nullable', 'string', 'max:80'],
            'customer_email' => ['nullable', 'email'],
            'customer_phone' => ['nullable', 'string', 'max:30'],
        ]);

        $serverKey = config('services.midtrans.server_key');
        $clientKey = config('services.midtrans.client_key');

        if (empty($serverKey) || empty($clientKey)) {
            return response()->json([
                'status' => 'demo',
                'demo' => true,
                'token' => null,
                'redirect_url' => null,
                'message' => 'Gateway demo aktif. Masukkan MIDTRANS_SERVER_KEY dan MIDTRANS_CLIENT_KEY untuk transaksi nyata.',
            ]);
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
            'transaction_details' => [
                'order_id' => $data['order_id'],
                'gross_amount' => (int) round((float) $data['amount']),
            ],
            'customer_details' => [
                'first_name' => $data['customer_name'] ?? 'Customer',
                'email' => $data['customer_email'] ?? 'customer@localhost',
                'phone' => $data['customer_phone'] ?? '',
            ],
            'enabled_payments' => ['gopay', 'shopeepay', 'bank_transfer', 'echannel'],
        ]);

        if ($response->failed()) {
            return response()->json([
                'status' => 'error',
                'demo' => false,
                'token' => null,
                'redirect_url' => null,
                'message' => $response->json('message') ?? 'Gateway Midtrans gagal memproses permintaan.',
            ], 502);
        }

        $payload = $response->json();

        return response()->json([
            'status' => 'pending',
            'demo' => false,
            'token' => $payload['token'] ?? null,
            'redirect_url' => $payload['redirect_url'] ?? null,
            'message' => 'Pembayaran siap diproses melalui Midtrans.',
        ]);
    }

    public function callback(Request $request): JsonResponse
    {
        $payload = $request->validate([
            'order_id' => ['nullable', 'string', 'max:80'],
            'transaction_status' => ['nullable', 'string', 'max:40'],
            'status_code' => ['nullable', 'string', 'max:10'],
            'gross_amount' => ['nullable', 'string', 'max:30'],
            'transaction_id' => ['nullable', 'string', 'max:80'],
        ]);

        Log::info('Midtrans callback received', $payload);

        return response()->json([
            'status' => 'ok',
            'order_id' => $payload['order_id'] ?? null,
            'transaction_status' => $payload['transaction_status'] ?? null,
        ]);
    }

    public function chart(Request $request): JsonResponse
    {
        $period = $request->validate([
            'period' => ['required', 'in:daily,weekly,monthly'],
        ])['period'];
        $now = CarbonImmutable::now();

        if ($period === 'daily') {
            $start = $now->startOfDay();
            $slots = collect(range(0, 23))->map(fn (int $hour) => [
                'key' => (string) $hour,
                'label' => str_pad((string) $hour, 2, '0', STR_PAD_LEFT),
            ]);
            $keyForSale = fn (Sale $sale) => (string) $sale->created_at->hour;
        } elseif ($period === 'weekly') {
            $start = $now->startOfDay()->subDays(6);
            $slots = collect(range(0, 6))->map(function (int $offset) use ($start) {
                $day = $start->addDays($offset);

                return ['key' => $day->format('Y-m-d'), 'label' => $day->format('d/m')];
            });
            $keyForSale = fn (Sale $sale) => $sale->created_at->format('Y-m-d');
        } else {
            $start = $now->startOfMonth()->subMonths(11);
            $slots = collect(range(0, 11))->map(function (int $offset) use ($start) {
                $month = $start->addMonths($offset);

                return ['key' => $month->format('Y-m'), 'label' => $month->format('m/y')];
            });
            $keyForSale = fn (Sale $sale) => $sale->created_at->format('Y-m');
        }

        $sales = Sale::query()
            ->where('is_demo', false)
            ->whereBetween('created_at', [$start, $now])
            ->get(['total', 'created_at']);
        $totalsByPeriod = $sales->groupBy($keyForSale)
            ->map(fn ($periodSales) => $periodSales->sum('total'));
        $series = $slots->map(fn (array $slot) => [
            'label' => $slot['label'],
            'total' => round($totalsByPeriod->get($slot['key'], 0)),
        ])->values();
        $todayStart = $now->startOfDay();
        $weekStart = $todayStart->subDays(6);
        $monthStart = $now->startOfMonth();
        $totalBetween = fn ($from, $to) => (float) Sale::query()
            ->where('is_demo', false)
            ->whereBetween('created_at', [$from, $to])
            ->sum('total');
        $todaySales = Sale::query()
            ->where('is_demo', false)
            ->whereBetween('created_at', [$todayStart, $now]);

        return response()->json([
            'period' => $period,
            'total' => round($sales->sum('total')),
            'transactions' => $sales->count(),
            'series' => $series,
            'summary' => [
                'today_total' => round($totalBetween($todayStart, $now)),
                'today_transactions' => (clone $todaySales)->count(),
                'week_total' => round($totalBetween($weekStart, $now)),
                'month_total' => round($totalBetween($monthStart, $now)),
            ],
        ]);
    }
}