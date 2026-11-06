<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            $products = [
                [
                    'name' => 'Mie Sedaap Goreng',
                    'code' => 'BRG007',
                    'barcode' => '899123456007',
                    'price' => 3500,
                    'stock' => 45,
                    'image' => '/images/products/mie-sedaap.jpg',
                ],
                [
                    'name' => 'Air Mineral 1.5 Liter',
                    'code' => 'BRG008',
                    'barcode' => '899123456008',
                    'price' => 6000,
                    'stock' => 55,
                    'image' => '/images/products/water.jpg',
                ],
                [
                    'name' => 'Le Minerale 600ml',
                    'code' => 'BRG009',
                    'barcode' => '899123456009',
                    'price' => 4000,
                    'stock' => 40,
                    'image' => '/images/products/le-minerale.jpg',
                ],
            ];

            foreach ($products as $product) {
                $existing = DB::table('products')->where('name', $product['name'])->first();
                $codeOwner = DB::table('products')->where('code', $product['code'])->first();
                $barcodeOwner = DB::table('products')->where('barcode', $product['barcode'])->first();

                $code = $codeOwner && (! $existing || $codeOwner->id !== $existing->id)
                    ? 'POS-'.$product['code']
                    : $product['code'];
                $barcode = $barcodeOwner && (! $existing || $barcodeOwner->id !== $existing->id)
                    ? 'POS'.$product['barcode']
                    : $product['barcode'];

                $values = [
                    'code' => $code,
                    'barcode' => $barcode,
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
