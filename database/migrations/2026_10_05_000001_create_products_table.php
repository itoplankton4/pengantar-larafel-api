<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('barcode')->unique()->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();

            $table->index('name');
        });

        DB::table('products')->insert([
            ['id' => 1, 'name' => 'Indomie Goreng', 'code' => 'BRG001', 'barcode' => '899123456001', 'price' => 3500, 'stock' => 40, 'image' => '/images/products/indomie-goreng.jpg'],
            ['id' => 2, 'name' => 'Aqua 600ml', 'code' => 'BRG002', 'barcode' => '899123456002', 'price' => 4000, 'stock' => 50, 'image' => '/images/products/aqua-600.jpg'],
            ['id' => 3, 'name' => 'Teh Botol Sosro', 'code' => 'BRG003', 'barcode' => '899123456003', 'price' => 5000, 'stock' => 35, 'image' => '/images/products/teh-botol-sosro.jpg'],
            ['id' => 4, 'name' => 'Beras 5 Kg', 'code' => 'BRG004', 'barcode' => '899123456004', 'price' => 75000, 'stock' => 20, 'image' => '/images/products/rice.jpg'],
            ['id' => 5, 'name' => 'Minyak Goreng 1 Liter', 'code' => 'BRG005', 'barcode' => '899123456005', 'price' => 18000, 'stock' => 25, 'image' => '/images/products/oil.jpg'],
            ['id' => 6, 'name' => 'Gula Pasir 1 Kg', 'code' => 'BRG006', 'barcode' => '899123456006', 'price' => 17000, 'stock' => 30, 'image' => '/images/products/sugar.jpg'],
            ['id' => 7, 'name' => 'Mie Sedaap Goreng', 'code' => 'BRG007', 'barcode' => '899123456007', 'price' => 3500, 'stock' => 45, 'image' => '/images/products/mie-sedaap.jpg'],
            ['id' => 8, 'name' => 'Air Mineral 1.5 Liter', 'code' => 'BRG008', 'barcode' => '899123456008', 'price' => 6000, 'stock' => 55, 'image' => '/images/products/water.jpg'],
            ['id' => 9, 'name' => 'Le Minerale 600ml', 'code' => 'BRG009', 'barcode' => '899123456009', 'price' => 4000, 'stock' => 40, 'image' => '/images/products/le-minerale.jpg'],
            ['id' => 10, 'name' => 'Teh Pucuk Harum 350ml', 'code' => 'BRG010', 'barcode' => '899123456010', 'price' => 4000, 'stock' => 38, 'image' => '/images/products/teh-pucuk.jpg'],
            ['id' => 11, 'name' => 'Kopi Kapal Api', 'code' => 'BRG011', 'barcode' => '899123456011', 'price' => 1500, 'stock' => 60, 'image' => '/images/products/kopi-kapal-api.jpg'],
            ['id' => 12, 'name' => 'Susu UHT Cokelat 250ml', 'code' => 'BRG012', 'barcode' => '899123456012', 'price' => 6500, 'stock' => 32, 'image' => '/images/products/cokelat-uht.jpg'],
            ['id' => 13, 'name' => 'Roti Tawar', 'code' => 'BRG013', 'barcode' => '899123456013', 'price' => 16000, 'stock' => 18, 'image' => '/images/products/bread.jpg'],
            ['id' => 14, 'name' => 'Telur Ayam 1 Kg', 'code' => 'BRG014', 'barcode' => '899123456014', 'price' => 28000, 'stock' => 22, 'image' => '/images/products/eggs.jpg'],
            ['id' => 15, 'name' => 'Sabun Mandi', 'code' => 'BRG015', 'barcode' => '899123456015', 'price' => 4000, 'stock' => 36, 'image' => '/images/products/soap.jpg'],
            ['id' => 16, 'name' => 'Pasta Gigi', 'code' => 'BRG016', 'barcode' => '899123456016', 'price' => 12000, 'stock' => 24, 'image' => '/images/products/toothpaste.jpg'],
            ['id' => 17, 'name' => 'Tisu Wajah', 'code' => 'BRG017', 'barcode' => '899123456017', 'price' => 8000, 'stock' => 28, 'image' => '/images/products/tissue.jpg'],
            ['id' => 18, 'name' => 'Keripik Kentang', 'code' => 'BRG018', 'barcode' => '899123456018', 'price' => 9500, 'stock' => 34, 'image' => '/images/products/chips.jpg'],
            ['id' => 19, 'name' => 'Biskuit Cokelat', 'code' => 'BRG019', 'barcode' => '899123456019', 'price' => 8500, 'stock' => 31, 'image' => '/images/products/cookies.jpg'],
            ['id' => 20, 'name' => 'Kecap Manis', 'code' => 'BRG020', 'barcode' => '899123456020', 'price' => 13500, 'stock' => 27, 'image' => '/images/products/soy-sauce.jpg'],
            ['id' => 21, 'name' => 'Saus Sambal', 'code' => 'BRG021', 'barcode' => '899123456021', 'price' => 11000, 'stock' => 29, 'image' => '/images/products/chili-sauce.jpg'],
            ['id' => 22, 'name' => 'Sabun Cuci Piring 750ml', 'code' => 'BRG022', 'barcode' => '899123456022', 'price' => 12000, 'stock' => 26, 'image' => '/images/products/dish-soap.jpg'],
            ['id' => 23, 'name' => 'Deterjen Bubuk 1 Kg', 'code' => 'BRG023', 'barcode' => '899123456023', 'price' => 18000, 'stock' => 21, 'image' => '/images/products/detergent.jpg'],
            ['id' => 24, 'name' => 'Shampoo Sachet', 'code' => 'BRG024', 'barcode' => '899123456024', 'price' => 1000, 'stock' => 70, 'image' => '/images/products/shampoo.jpg'],
            ['id' => 25, 'name' => 'Susu Kental Manis 370ml', 'code' => 'BRG025', 'barcode' => '899123456025', 'price' => 13000, 'stock' => 33, 'image' => '/images/products/susu-kental-manis.jpg'],
            ['id' => 26, 'name' => 'Kopi Sachet', 'code' => 'BRG026', 'barcode' => '899123456026', 'price' => 1500, 'stock' => 68, 'image' => '/images/products/kopi-sachet.jpg'],
            ['id' => 27, 'name' => 'Air Galon Isi Ulang', 'code' => 'BRG027', 'barcode' => '899123456027', 'price' => 7000, 'stock' => 18, 'image' => '/images/products/gallon.jpg'],
            ['id' => 28, 'name' => 'Mi Kuah Ayam Bawang', 'code' => 'BRG028', 'barcode' => '899123456028', 'price' => 3500, 'stock' => 42, 'image' => '/images/products/noodle-soup.jpg'],
            ['id' => 29, 'name' => 'Minuman Cola 390ml', 'code' => 'BRG029', 'barcode' => '899123456029', 'price' => 6000, 'stock' => 39, 'image' => '/images/products/cola-bottle.jpg'],
            ['id' => 30, 'name' => 'Susu UHT Full Cream 1 Liter', 'code' => 'BRG030', 'barcode' => '899123456030', 'price' => 19000, 'stock' => 20, 'image' => '/images/products/milk-full-cream.jpg'],
            ['id' => 31, 'name' => 'Yogurt Stroberi 180ml', 'code' => 'BRG031', 'barcode' => '899123456031', 'price' => 8000, 'stock' => 25, 'image' => '/images/products/yogurt-cup.jpg'],
            ['id' => 32, 'name' => 'Margarin 200g', 'code' => 'BRG032', 'barcode' => '899123456032', 'price' => 7000, 'stock' => 30, 'image' => '/images/products/margarine.jpg'],
            ['id' => 33, 'name' => 'Tepung Terigu 1 Kg', 'code' => 'BRG033', 'barcode' => '899123456033', 'price' => 12000, 'stock' => 23, 'image' => '/images/products/flour.jpg'],
            ['id' => 34, 'name' => 'Garam Dapur 500g', 'code' => 'BRG034', 'barcode' => '899123456034', 'price' => 4000, 'stock' => 36, 'image' => '/images/products/salt.jpg'],
            ['id' => 35, 'name' => 'Sarden Kaleng 155g', 'code' => 'BRG035', 'barcode' => '899123456035', 'price' => 14000, 'stock' => 24, 'image' => '/images/products/sardines.jpg'],
            ['id' => 36, 'name' => 'Wafer Cokelat 140g', 'code' => 'BRG036', 'barcode' => '899123456036', 'price' => 9000, 'stock' => 28, 'image' => '/images/products/chocolate-wafer.jpg'],
            ['id' => 37, 'name' => 'Tisu Toilet 10 Roll', 'code' => 'BRG037', 'barcode' => '899123456037', 'price' => 25000, 'stock' => 17, 'image' => '/images/products/toilet-tissue.jpg'],
            ['id' => 38, 'name' => 'Pembersih Lantai 800ml', 'code' => 'BRG038', 'barcode' => '899123456038', 'price' => 14000, 'stock' => 22, 'image' => '/images/products/floor-cleaner.jpg'],
            ['id' => 39, 'name' => 'Baterai AA 2 pcs', 'code' => 'BRG039', 'barcode' => '899123456039', 'price' => 15000, 'stock' => 19, 'image' => '/images/products/aa-batteries.jpg'],
            ['id' => 40, 'name' => 'Madu Murni 250g', 'code' => 'BRG040', 'barcode' => '899123456040', 'price' => 28000, 'stock' => 12, 'image' => '/images/products/honey.jpg'],
            ['id' => 41, 'name' => 'Spons Cuci Piring 2 pcs', 'code' => 'BRG041', 'barcode' => '899123456041', 'price' => 5000, 'stock' => 35, 'image' => '/images/products/dish-sponge.jpg'],
            ['id' => 42, 'name' => 'Selai Kacang 340g', 'code' => 'BRG042', 'barcode' => '899123456042', 'price' => 28000, 'stock' => 14, 'image' => '/images/products/peanut-butter.jpg'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
