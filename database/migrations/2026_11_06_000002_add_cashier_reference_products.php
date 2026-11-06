<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $products = [
            ['name' => 'Indomie Goreng', 'code' => 'BRG001', 'barcode' => '899123456001', 'price' => 3500, 'stock' => 40, 'image' => '/images/products/indomie-goreng.jpg'],
            ['name' => 'Aqua 600ml', 'code' => 'BRG002', 'barcode' => '899123456002', 'price' => 4000, 'stock' => 50, 'image' => '/images/products/aqua-600.jpg'],
            ['name' => 'Teh Botol Sosro', 'code' => 'BRG003', 'barcode' => '899123456003', 'price' => 5000, 'stock' => 35, 'image' => '/images/products/teh-botol-sosro.jpg'],
            ['name' => 'Beras 5 Kg', 'code' => 'BRG004', 'barcode' => '899123456004', 'price' => 75000, 'stock' => 20, 'image' => '/images/products/rice.jpg'],
            ['name' => 'Minyak Goreng 1 Liter', 'code' => 'BRG005', 'barcode' => '899123456005', 'price' => 18000, 'stock' => 25, 'image' => '/images/products/oil.jpg'],
            ['name' => 'Gula Pasir 1 Kg', 'code' => 'BRG006', 'barcode' => '899123456006', 'price' => 17000, 'stock' => 30, 'image' => '/images/products/sugar.jpg'],
            ['name' => 'Teh Pucuk Harum 350ml', 'code' => 'BRG010', 'barcode' => '899123456010', 'price' => 4000, 'stock' => 38, 'image' => '/images/products/teh-pucuk.jpg'],
            ['name' => 'Kopi Kapal Api', 'code' => 'BRG011', 'barcode' => '899123456011', 'price' => 1500, 'stock' => 60, 'image' => '/images/products/kopi-kapal-api.jpg'],
            ['name' => 'Susu UHT Cokelat 250ml', 'code' => 'BRG012', 'barcode' => '899123456012', 'price' => 6500, 'stock' => 32, 'image' => '/images/products/cokelat-uht.jpg'],
        ];

        DB::transaction(function () use ($products) {
            foreach ($products as $product) {
                $existing = DB::table('products')->where('name', $product['name'])->first();
                $codeOwner = DB::table('products')->where('code', $product['code'])->first();
                $barcodeOwner = DB::table('products')->where('barcode', $product['barcode'])->first();

                $values = [
                    'code' => $codeOwner && (! $existing || $codeOwner->id !== $existing->id)
                        ? 'POS-'.$product['code']
                        : $product['code'],
                    'barcode' => $barcodeOwner && (! $existing || $barcodeOwner->id !== $existing->id)
                        ? 'POS'.$product['barcode']
                        : $product['barcode'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'updated_at' => now(),
                ];

                if ($existing) {
                    DB::table('products')->where('id', $existing->id)->update($values);
                } else {
                    DB::table('products')->insert($values + [
                        'name' => $product['name'],
                        'stock' => $product['stock'],
                        'created_at' => now(),
                    ]);
                }
            }
        });
    }

    public function down(): void
    {
        // Keep catalog rows on rollback to avoid removing products already used in sales.
    }
};
