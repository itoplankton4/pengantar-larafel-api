<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_get_per_item_sales_report(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::create([
            'name' => 'Produk Laris',
            'code' => 'BRG201',
            'barcode' => '899123456201',
            'price' => 12000,
            'stock' => 20,
            'image' => '/images/products/product-default.jpg',
        ]);

        Sale::create([
            'transaction_number' => 'TRX-RPT-001',
            'cashier_id' => User::factory()->create(['role' => 'kasir'])->id,
            'payment_method' => 'Tunai',
            'customer_type' => 'Umum',
            'subtotal' => 24000,
            'discount' => 0,
            'tax' => 0,
            'other_fee' => 0,
            'total' => 24000,
            'paid' => 24000,
            'items' => [[
                'id' => $product->id,
                'code' => $product->code,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 2,
            ]],
            'is_demo' => false,
        ]);

        $response = $this->actingAs($admin)->getJson(route('admin.sales.items'));

        $response->assertOk();
        $response->assertJsonPath('0.product_name', 'Produk Laris');
        $response->assertJsonPath('0.quantity_sold', 2);
        $response->assertJsonPath('0.total_revenue', 24000);
    }

    public function test_admin_can_export_sales_report_as_csv_and_pdf(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::create([
            'name' => 'Produk Laris',
            'code' => 'BRG205',
            'barcode' => '899123456205',
            'price' => 15000,
            'stock' => 10,
            'image' => '/images/products/product-default.jpg',
        ]);

        Sale::create([
            'transaction_number' => 'TRX-RPT-CSV-001',
            'cashier_id' => User::factory()->create(['role' => 'kasir'])->id,
            'payment_method' => 'Tunai',
            'customer_type' => 'Umum',
            'subtotal' => 15000,
            'discount' => 0,
            'tax' => 0,
            'other_fee' => 0,
            'total' => 15000,
            'paid' => 15000,
            'items' => [[
                'id' => $product->id,
                'code' => $product->code,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
            ]],
            'is_demo' => false,
        ]);

        $csvResponse = $this->actingAs($admin)->get(route('admin.sales.export', ['format' => 'csv']));
        $csvResponse->assertOk();
        $csvResponse->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $csvResponse->assertHeader('Content-Disposition', 'attachment; filename="laporan-penjualan.csv"');
        $csvResponse->assertSee('Produk Laris');

        $pdfResponse = $this->actingAs($admin)->get(route('admin.sales.export', ['format' => 'pdf']));
        $pdfResponse->assertOk();
        $pdfResponse->assertHeader('Content-Type', 'application/pdf');
        $pdfResponse->assertHeader('Content-Disposition', 'attachment; filename="laporan-penjualan.pdf"');
        $pdfResponse->assertSee('Produk Laris');
    }
}
