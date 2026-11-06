<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $products = [
            ['name' => 'Roti Tawar', 'code' => 'BRG013', 'barcode' => '899123456013', 'price' => 16000, 'stock' => 18, 'image' => '/images/products/bread.jpg'],
            ['name' => 'Telur Ayam 1 Kg', 'code' => 'BRG014', 'barcode' => '899123456014', 'price' => 28000, 'stock' => 22, 'image' => '/images/products/eggs.jpg'],
            ['name' => 'Sabun Mandi', 'code' => 'BRG015', 'barcode' => '899123456015', 'price' => 4000, 'stock' => 36, 'image' => '/images/products/soap.jpg'],
            ['name' => 'Pasta Gigi', 'code' => 'BRG016', 'barcode' => '899123456016', 'price' => 12000, 'stock' => 24, 'image' => '/images/products/toothpaste.jpg'],
            ['name' => 'Tisu Wajah', 'code' => 'BRG017', 'barcode' => '899123456017', 'price' => 8000, 'stock' => 28, 'image' => '/images/products/tissue.jpg'],
            ['name' => 'Keripik Kentang', 'code' => 'BRG018', 'barcode' => '899123456018', 'price' => 9500, 'stock' => 34, 'image' => '/images/products/chips.jpg'],
            ['name' => 'Biskuit Cokelat', 'code' => 'BRG019', 'barcode' => '899123456019', 'price' => 8500, 'stock' => 31, 'image' => '/images/products/cookies.jpg'],
            ['name' => 'Kecap Manis', 'code' => 'BRG020', 'barcode' => '899123456020', 'price' => 13500, 'stock' => 27, 'image' => '/images/products/soy-sauce.jpg'],
            ['name' => 'Saus Sambal', 'code' => 'BRG021', 'barcode' => '899123456021', 'price' => 11000, 'stock' => 29, 'image' => '/images/products/chili-sauce.jpg'],
            ['name' => 'Sabun Cuci Piring 750ml', 'code' => 'BRG022', 'barcode' => '899123456022', 'price' => 12000, 'stock' => 26, 'image' => '/images/products/dish-soap.jpg'],
            ['name' => 'Deterjen Bubuk 1 Kg', 'code' => 'BRG023', 'barcode' => '899123456023', 'price' => 18000, 'stock' => 21, 'image' => '/images/products/detergent.jpg'],
            ['name' => 'Shampoo Sachet', 'code' => 'BRG024', 'barcode' => '899123456024', 'price' => 1000, 'stock' => 70, 'image' => '/images/products/shampoo.jpg'],
            ['name' => 'Susu Kental Manis 370ml', 'code' => 'BRG025', 'barcode' => '899123456025', 'price' => 13000, 'stock' => 33, 'image' => '/images/products/susu-kental-manis.jpg'],
            ['name' => 'Kopi Sachet', 'code' => 'BRG026', 'barcode' => '899123456026', 'price' => 1500, 'stock' => 68, 'image' => '/images/products/kopi-sachet.jpg'],
            ['name' => 'Air Galon Isi Ulang', 'code' => 'BRG027', 'barcode' => '899123456027', 'price' => 7000, 'stock' => 18, 'image' => '/images/products/gallon.jpg'],
            ['name' => 'Mi Kuah Ayam Bawang', 'code' => 'BRG028', 'barcode' => '899123456028', 'price' => 3500, 'stock' => 42, 'image' => '/images/products/noodle-soup.jpg'],
            ['name' => 'Minuman Cola 390ml', 'code' => 'BRG029', 'barcode' => '899123456029', 'price' => 6000, 'stock' => 39, 'image' => '/images/products/cola-bottle.jpg'],
            ['name' => 'Susu UHT Full Cream 1 Liter', 'code' => 'BRG030', 'barcode' => '899123456030', 'price' => 19000, 'stock' => 20, 'image' => '/images/products/milk-full-cream.jpg'],
            ['name' => 'Yogurt Stroberi 180ml', 'code' => 'BRG031', 'barcode' => '899123456031', 'price' => 8000, 'stock' => 25, 'image' => '/images/products/yogurt-cup.jpg'],
            ['name' => 'Margarin 200g', 'code' => 'BRG032', 'barcode' => '899123456032', 'price' => 7000, 'stock' => 30, 'image' => '/images/products/margarine.jpg'],
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
