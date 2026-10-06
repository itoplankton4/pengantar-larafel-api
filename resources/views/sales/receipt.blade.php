<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk {{ $sale->transaction_number }} | {{ $store->name }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 24px 12px;
            color: #000000;
            background: #eef1ed;
            font: 12px/1.3 "Courier New", monospace;
            -webkit-font-smoothing: antialiased;
            text-rendering: geometricPrecision;
        }
        .receipt {
            width: min(100%, 320px);
            margin: 0 auto;
            padding: 16px 16px 12px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(17, 17, 17, 0.08);
            border: 1px solid rgba(17,17,17,0.08);
        }
        .receipt-header, .receipt-footer { text-align: center; }
        .receipt-header h1 {
            margin: 0 0 2px;
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 0.02em;
            color: #000000;
        }
        .receipt-header p, .receipt-footer p { margin: 2px 0; }
        .receipt-rule {
            margin: 8px 0;
            border-top: 1px dashed #000000;
        }
        .receipt-meta, .receipt-line, .receipt-total {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
        }
        .receipt-meta {
            margin: 2px 0;
            font-weight: 800;
            color: #000000;
        }
        .receipt-item {
            padding: 4px 0;
        }
        .receipt-item-name {
            overflow-wrap: anywhere;
            font-weight: 900;
            color: #000000;
        }
        .receipt-item-detail {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 2px;
        }
        .receipt-summary {
            display: grid;
            gap: 4px;
        }
        .receipt-total {
            margin-top: 5px;
            font-size: 14px;
            font-weight: 900;
            color: #000000;
        }
        .receipt-footer {
            margin-top: 10px;
        }
        .receipt-actions {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 16px auto 0;
        }
        .receipt-actions a, .receipt-actions button {
            padding: 9px 12px;
            color: #fff;
            background: #176b46;
            border: 0;
            border-radius: 4px;
            font: 600 12px Arial, sans-serif;
            text-decoration: none;
            cursor: pointer;
        }
        .receipt-actions a { color: #24332b; background: #dfe8e1; }

        @media print {
            @page { size: 58mm auto; margin: 2mm; }
            body {
                margin: 0;
                padding: 0;
                background: #fff;
                font-size: 10px;
                line-height: 1.3;
                color: #000000;
                font-weight: 900;
            }
            .receipt {
                width: 54mm;
                margin: 0;
                padding: 6px 8px 6px;
                box-shadow: none;
                border: none;
                background: #fff;
            }
            .receipt-header h1 { font-size: 16px; color: #000000; font-weight: 1000; }
            .receipt-rule { margin: 5px 0; border-top-color: #000000; }
            .receipt-meta, .receipt-line, .receipt-total { gap: 6px; }
            .receipt-total { font-size: 12px; font-weight: 1000; color: #000000; }
            .receipt-meta { font-weight: 1000; color: #000000; }
            .receipt-item-name { font-weight: 1000; color: #000000; }
            .receipt-item-detail { font-weight: 900; }
            .receipt-footer { margin-top: 8px; color: #000000; font-weight: 900; }
            .receipt-actions { display: none; }
            * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
<main class="receipt">
    <header class="receipt-header">
        <h1>{{ mb_strtoupper($store->name) }}</h1>
        <p>{{ $store->address }}, {{ $store->city }}</p>
        <p>Telp. {{ $store->phone }}</p>
    </header>

    <div class="receipt-rule"></div>
    <div class="receipt-meta"><span>No. Transaksi</span><strong>{{ $sale->transaction_number }}</strong></div>
    <div class="receipt-meta"><span>Tanggal</span><span>{{ $sale->created_at?->format('d/m/Y H:i') }}</span></div>
    <div class="receipt-meta"><span>Kasir</span><span>{{ $sale->cashier?->name ?? '-' }}</span></div>
    <div class="receipt-meta"><span>Pelanggan</span><span>{{ $sale->customer_type }}</span></div>

    <div class="receipt-rule"></div>
    @foreach ($sale->items ?? [] as $item)
        <div class="receipt-item">
            <div class="receipt-item-name">{{ $item['name'] ?? 'Produk' }}</div>
            <div class="receipt-item-detail">
                <span>{{ (int) ($item['qty'] ?? 0) }} x Rp {{ number_format((float) ($item['price'] ?? 0), 0, ',', '.') }}</span>
                <strong>Rp {{ number_format((float) ($item['price'] ?? 0) * (int) ($item['qty'] ?? 0), 0, ',', '.') }}</strong>
            </div>
        </div>
    @endforeach

    <div class="receipt-rule"></div>
    <div class="receipt-summary">
        <div class="receipt-line"><span>Subtotal</span><span>Rp {{ number_format($sale->subtotal, 0, ',', '.') }}</span></div>
        <div class="receipt-line"><span>Diskon</span><span>- Rp {{ number_format($sale->discount, 0, ',', '.') }}</span></div>
        <div class="receipt-line"><span>Pajak / PPN</span><span>Rp {{ number_format($sale->tax, 0, ',', '.') }}</span></div>
        <div class="receipt-line"><span>Biaya lain</span><span>Rp {{ number_format($sale->other_fee, 0, ',', '.') }}</span></div>
        <div class="receipt-total"><span>TOTAL</span><span>Rp {{ number_format($sale->total, 0, ',', '.') }}</span></div>
        <div class="receipt-line"><span>Bayar ({{ $sale->payment_method }})</span><span>Rp {{ number_format($sale->paid, 0, ',', '.') }}</span></div>
        <div class="receipt-line"><strong>Kembalian</strong><strong>Rp {{ number_format(max(0, $sale->paid - $sale->total), 0, ',', '.') }}</strong></div>
    </div>

    <div class="receipt-rule"></div>
    <footer class="receipt-footer"><p>Terima kasih telah berbelanja</p><p>Barang yang sudah dibeli tidak dapat dikembalikan.</p></footer>
</main>
<nav class="receipt-actions" aria-label="Aksi struk">
    <a href="{{ route('kasir') }}">Kembali ke kasir</a>
    <button type="button" onclick="window.print()">Cetak ulang</button>
</nav>
</body>
</html>