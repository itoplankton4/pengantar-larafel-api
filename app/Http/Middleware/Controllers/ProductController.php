<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $keyword = trim($request->query('search'));
            $query->where(function ($builder) use ($keyword) {
                $builder->where('name', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%")
                    ->orWhere('barcode', 'like', "%{$keyword}%");
            });
        }

        return response()->json(
            $query->orderBy('name')->get([
                'id',
                'name',
                'code',
                'barcode',
                'price',
                'stock',
                'image',
            ])
        );
    }

    public function inventorySummary(): JsonResponse
    {
        $lowStockThreshold = 5;

        return response()->json([
            'total_products' => Product::count(),
            'total_stock' => Product::sum('stock'),
            'low_stock_count' => Product::where('stock', '<=', $lowStockThreshold)->where('stock', '>', 0)->count(),
            'out_of_stock_count' => Product::where('stock', 0)->count(),
            'restock_needed' => Product::where('stock', '<=', $lowStockThreshold)->orderBy('stock')->orderBy('name')->get(['id', 'name', 'stock', 'code']),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'code' => ['required', 'string', 'max:40', 'unique:products,code'],
            'barcode' => ['nullable', 'string', 'max:40', 'unique:products,barcode'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'url:http,https'],
        ]);

        $product = Product::create($data);

        return response()->json($product, 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:120'],
            'code' => ['sometimes', 'required', 'string', 'max:40', 'unique:products,code,' . $product->id],
            'barcode' => ['sometimes', 'nullable', 'string', 'max:40', 'unique:products,barcode,' . $product->id],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'stock' => ['sometimes', 'required', 'integer', 'min:0'],
            'image' => ['sometimes', 'nullable', 'url:http,https'],
        ]);

        $product->fill($data);
        $product->save();

        return response()->json($product);
    }

    public function restock(Request $request, Product $product): JsonResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $product->increment('stock', $data['quantity']);

        StockMovement::create([
            'product_id' => $product->id,
            'movement_type' => 'in',
            'quantity' => $data['quantity'],
            'note' => $data['note'] ?? 'Restock',
            'created_by' => $request->user()?->id,
        ]);

        return response()->json([
            'message' => 'Stok berhasil ditambah.',
            'product' => $product->fresh(),
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus.']);
    }
}
