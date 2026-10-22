<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_list_products(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Product::create([
            'name' => 'Indomie Jumbo',
            'code' => 'BRG998',
            'barcode' => '899123456998',
            'price' => 3500,
            'stock' => 12,
            'image' => '/images/products/indomie-goreng.jpg',
        ]);

        $response = $this->actingAs($admin)->getJson(route('products.index'));

        $response->assertOk();
        $response->assertJsonFragment(['name' => 'Indomie Jumbo']);
        $response->assertJsonFragment(['name' => 'Kunci Pas Ring 10 mm']);
        $response->assertJsonFragment([
            'name' => 'Kunci Pas Ring 10 mm',
            'image' => '/images/products/motorcycle/tools.jpg',
        ]);
        $response->assertJsonFragment([
            'name' => 'Busi Standar',
            'image' => '/images/products/motorcycle/spark-plug.svg',
        ]);
        $response->assertJsonFragment([
            'name' => 'Jas Hujan Motor',
            'image' => '/images/products/motorcycle/rain-suit.svg',
        ]);
        $response->assertJsonFragment([
            'name' => 'Aki Motor 12V',
            'image' => '/images/products/motorcycle/motorcycle-battery.svg',
        ]);
        $response->assertJsonFragment([
            'name' => 'Helm Full Face Grafis',
            'code' => 'BRG047',
            'image' => '/images/products/motorcycle/helmet-photo.jpg',
        ]);
        $response->assertJsonMissing([
            'name' => 'Knalpot Motor Universal',
            'code' => 'BRG046',
        ]);
        $response->assertJsonFragment([
            'name' => 'Velg Racing Motor Set',
            'code' => 'BRG048',
            'image' => '/images/products/motorcycle/motorcycle-rims.svg',
        ]);
    }

    public function test_selling_product_reduces_stock(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);
        $product = Product::create([
            'name' => 'Aqua Plus',
            'code' => 'BRG999',
            'barcode' => '899123456999',
            'price' => 4000,
            'stock' => 5,
            'image' => '/images/products/aqua-600.jpg',
        ]);

        $response = $this->actingAs($cashier)->postJson(route('sales.store'), [
            'transaction_number' => 'TRX-TEST-001',
            'payment_method' => 'Tunai',
            'customer_type' => 'Umum',
            'discount_percent' => 0,
            'discount_amount' => 0,
            'tax' => 0,
            'other_fee' => 0,
            'paid' => 8000,
            'items' => [[
                'id' => $product->id,
                'code' => $product->code,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 2,
            ]],
        ]);

        $response->assertCreated();
        $response->assertJsonStructure(['receipt_url']);
        $this->assertSame(3, $product->fresh()->stock);
    }

    public function test_admin_can_restock_product(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::create([
            'name' => 'Minyak Goreng',
            'code' => 'BRG101',
            'barcode' => '899123456101',
            'price' => 18000,
            'stock' => 5,
            'image' => '/images/products/oil.jpg',
        ]);

        $response = $this->actingAs($admin)->postJson(route('admin.products.restock', $product), [
            'quantity' => 12,
            'note' => 'Pembelian dari distributor',
        ]);

        $response->assertOk();
        $this->assertSame(17, $product->fresh()->stock);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'movement_type' => 'in',
            'quantity' => 12,
        ]);
    }

    public function test_admin_can_get_inventory_summary(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Product::create([
            'name' => 'Produk Kosong',
            'code' => 'BRG102',
            'barcode' => '899123456102',
            'price' => 12000,
            'stock' => 0,
            'image' => '/images/products/product-default.jpg',
        ]);
        Product::create([
            'name' => 'Produk Rendah',
            'code' => 'BRG103',
            'barcode' => '899123456103',
            'price' => 15000,
            'stock' => 2,
            'image' => '/images/products/product-default.jpg',
        ]);

        $response = $this->actingAs($admin)->getJson(route('admin.inventory')); 

        $response->assertOk();
        $response->assertJsonPath('low_stock_count', 1);
        $response->assertJsonPath('out_of_stock_count', 1);
    }
}
