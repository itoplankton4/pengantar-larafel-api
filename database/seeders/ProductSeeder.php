<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->upsert([
            ['name' => 'Indomie Goreng', 'price' => 3500, 'stock' => 40, 'code' => 'BRG001', 'barcode' => '899123456001', 'image' => '/images/products/indomie-goreng.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aqua 600ml', 'price' => 4000, 'stock' => 50, 'code' => 'BRG002', 'barcode' => '899123456002', 'image' => '/images/products/aqua-600.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teh Botol Sosro', 'price' => 5000, 'stock' => 35, 'code' => 'BRG003', 'barcode' => '899123456003', 'image' => '/images/products/teh-botol-sosro.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beras 5 Kg', 'price' => 75000, 'stock' => 20, 'code' => 'BRG004', 'barcode' => '899123456004', 'image' => '/images/products/rice.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Minyak Goreng 1 Liter', 'price' => 18000, 'stock' => 25, 'code' => 'BRG005', 'barcode' => '899123456005', 'image' => '/images/products/oil.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gula Pasir 1 Kg', 'price' => 17000, 'stock' => 30, 'code' => 'BRG006', 'barcode' => '899123456006', 'image' => '/images/products/sugar.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mie Sedaap Goreng', 'price' => 3500, 'stock' => 45, 'code' => 'BRG007', 'barcode' => '899123456007', 'image' => '/images/products/mie-sedaap.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Air Mineral 1.5 Liter', 'price' => 6000, 'stock' => 55, 'code' => 'BRG008', 'barcode' => '899123456008', 'image' => '/images/products/water.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Le Minerale 600ml', 'price' => 4000, 'stock' => 40, 'code' => 'BRG009', 'barcode' => '899123456009', 'image' => '/images/products/le-minerale.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teh Pucuk Harum 350ml', 'price' => 4000, 'stock' => 38, 'code' => 'BRG010', 'barcode' => '899123456010', 'image' => '/images/products/teh-pucuk.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kopi Kapal Api', 'price' => 1500, 'stock' => 60, 'code' => 'BRG011', 'barcode' => '899123456011', 'image' => '/images/products/kopi-kapal-api.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Susu UHT Cokelat 250ml', 'price' => 6500, 'stock' => 32, 'code' => 'BRG012', 'barcode' => '899123456012', 'image' => '/images/products/cokelat-uht.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Roti Tawar', 'price' => 16000, 'stock' => 18, 'code' => 'BRG013', 'barcode' => '899123456013', 'image' => '/images/products/bread.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Telur Ayam 1 Kg', 'price' => 28000, 'stock' => 22, 'code' => 'BRG014', 'barcode' => '899123456014', 'image' => '/images/products/eggs.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sabun Mandi', 'price' => 4000, 'stock' => 36, 'code' => 'BRG015', 'barcode' => '899123456015', 'image' => '/images/products/soap.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pasta Gigi', 'price' => 12000, 'stock' => 24, 'code' => 'BRG016', 'barcode' => '899123456016', 'image' => '/images/products/toothpaste.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tisu Wajah', 'price' => 8000, 'stock' => 28, 'code' => 'BRG017', 'barcode' => '899123456017', 'image' => '/images/products/tissue.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Keripik Kentang', 'price' => 9500, 'stock' => 34, 'code' => 'BRG018', 'barcode' => '899123456018', 'image' => '/images/products/chips.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biskuit Cokelat', 'price' => 8500, 'stock' => 31, 'code' => 'BRG019', 'barcode' => '899123456019', 'image' => '/images/products/cookies.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kecap Manis', 'price' => 13500, 'stock' => 27, 'code' => 'BRG020', 'barcode' => '899123456020', 'image' => '/images/products/soy-sauce.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Saus Sambal', 'price' => 11000, 'stock' => 29, 'code' => 'BRG021', 'barcode' => '899123456021', 'image' => '/images/products/chili-sauce.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sabun Cuci Piring 750ml', 'price' => 12000, 'stock' => 26, 'code' => 'BRG022', 'barcode' => '899123456022', 'image' => '/images/products/dish-soap.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Deterjen Bubuk 1 Kg', 'price' => 18000, 'stock' => 21, 'code' => 'BRG023', 'barcode' => '899123456023', 'image' => '/images/products/detergent.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shampoo Sachet', 'price' => 1000, 'stock' => 70, 'code' => 'BRG024', 'barcode' => '899123456024', 'image' => '/images/products/shampoo.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Susu Kental Manis 370ml', 'price' => 13000, 'stock' => 33, 'code' => 'BRG025', 'barcode' => '899123456025', 'image' => '/images/products/susu-kental-manis.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kopi Sachet', 'price' => 1500, 'stock' => 68, 'code' => 'BRG026', 'barcode' => '899123456026', 'image' => '/images/products/kopi-sachet.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Air Galon Isi Ulang', 'price' => 7000, 'stock' => 18, 'code' => 'BRG027', 'barcode' => '899123456027', 'image' => '/images/products/gallon.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mi Kuah Ayam Bawang', 'price' => 3500, 'stock' => 42, 'code' => 'BRG028', 'barcode' => '899123456028', 'image' => '/images/products/noodle-soup.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Minuman Cola 390ml', 'price' => 6000, 'stock' => 39, 'code' => 'BRG029', 'barcode' => '899123456029', 'image' => '/images/products/cola-bottle.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Susu UHT Full Cream 1 Liter', 'price' => 19000, 'stock' => 20, 'code' => 'BRG030', 'barcode' => '899123456030', 'image' => '/images/products/milk-full-cream.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yogurt Stroberi 180ml', 'price' => 8000, 'stock' => 25, 'code' => 'BRG031', 'barcode' => '899123456031', 'image' => '/images/products/yogurt-cup.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Margarin 200g', 'price' => 7000, 'stock' => 30, 'code' => 'BRG032', 'barcode' => '899123456032', 'image' => '/images/products/margarine.jpg', 'created_at' => now(), 'updated_at' => now()],
        ], ['code'], ['name', 'barcode', 'price', 'image', 'updated_at']);
    }
}
