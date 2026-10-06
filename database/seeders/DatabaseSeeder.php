<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        $admin = User::where('email', 'admin@vitoxx.local')->first()
            ?? User::where('email', 'olivia2024@gmail.com')->first()
            ?? new User();

        $admin->fill([
            'name' => 'Admin Vitoxx',
            'email' => 'olivia2024@gmail.com',
            'password' => 'olivia2024',
            'role' => 'admin',
        ])->save();

        $cashier = User::where('email', 'kasir@vitoxx.local')->first()
            ?? User::where('email', 'itolulu2005@gmail.com')->first()
            ?? new User();

        $cashier->fill([
            'name' => 'Kasir Vitoxx',
            'email' => 'itolulu2005@gmail.com',
            'password' => 'vito2005',
            'role' => 'kasir',
        ])->save();

        if (class_exists(\App\Models\Product::class) && \Schema::hasTable('products')) {
            $existingProducts = \App\Models\Product::query()->count();

            if ($existingProducts === 0) {
                \App\Models\Product::query()->insert([
                    ['name' => 'Indomie Goreng', 'code' => 'ALF-001', 'barcode' => '899123456001', 'price' => 3500, 'stock' => 40, 'image' => '/images/products/indomie-goreng.jpg'],
                    ['name' => 'Aqua 600ml', 'code' => 'ALF-002', 'barcode' => '899123456002', 'price' => 4000, 'stock' => 50, 'image' => '/images/products/aqua-600.jpg'],
                    ['name' => 'Teh Botol Sosro', 'code' => 'ALF-003', 'barcode' => '899123456003', 'price' => 5000, 'stock' => 35, 'image' => '/images/products/teh-botol-sosro.jpg'],
                    ['name' => 'Beras 5 Kg', 'code' => 'ALF-004', 'barcode' => '899123456004', 'price' => 75000, 'stock' => 20, 'image' => '/images/products/rice.jpg'],
                    ['name' => 'Minyak Goreng 1 Liter', 'code' => 'ALF-005', 'barcode' => '899123456005', 'price' => 18000, 'stock' => 25, 'image' => '/images/products/oil.jpg'],
                    ['name' => 'Gula Pasir 1 Kg', 'code' => 'ALF-006', 'barcode' => '899123456006', 'price' => 17000, 'stock' => 30, 'image' => '/images/products/sugar.jpg'],
                    ['name' => 'Mie Sedaap Goreng', 'code' => 'ALF-007', 'barcode' => '899123456007', 'price' => 3500, 'stock' => 45, 'image' => '/images/products/mie-sedaap.jpg'],
                    ['name' => 'Air Mineral 1.5 Liter', 'code' => 'ALF-008', 'barcode' => '899123456008', 'price' => 6000, 'stock' => 55, 'image' => '/images/products/water.jpg'],
                    ['name' => 'Le Minerale 600ml', 'code' => 'ALF-009', 'barcode' => '899123456009', 'price' => 4000, 'stock' => 40, 'image' => '/images/products/le-minerale.jpg'],
                    ['name' => 'Teh Pucuk Harum 350ml', 'code' => 'ALF-010', 'barcode' => '899123456010', 'price' => 4000, 'stock' => 38, 'image' => '/images/products/teh-pucuk.jpg'],
                    ['name' => 'Kopi Kapal Api', 'code' => 'ALF-011', 'barcode' => '899123456011', 'price' => 1500, 'stock' => 60, 'image' => '/images/products/kopi-kapal-api.jpg'],
                    ['name' => 'Susu UHT Cokelat 250ml', 'code' => 'ALF-012', 'barcode' => '899123456012', 'price' => 6500, 'stock' => 32, 'image' => '/images/products/cokelat-uht.jpg'],
                    ['name' => 'Roti Tawar', 'code' => 'ALF-013', 'barcode' => '899123456013', 'price' => 16000, 'stock' => 18, 'image' => '/images/products/bread.jpg'],
                    ['name' => 'Telur Ayam 1 Kg', 'code' => 'ALF-014', 'barcode' => '899123456014', 'price' => 28000, 'stock' => 22, 'image' => '/images/products/eggs.jpg'],
                    ['name' => 'Sabun Mandi', 'code' => 'ALF-015', 'barcode' => '899123456015', 'price' => 4000, 'stock' => 36, 'image' => '/images/products/soap.jpg'],
                    ['name' => 'Pasta Gigi', 'code' => 'ALF-016', 'barcode' => '899123456016', 'price' => 12000, 'stock' => 24, 'image' => '/images/products/toothpaste.jpg'],
                    ['name' => 'Tisu Wajah', 'code' => 'ALF-017', 'barcode' => '899123456017', 'price' => 8000, 'stock' => 28, 'image' => '/images/products/tissue.jpg'],
                    ['name' => 'Keripik Kentang', 'code' => 'ALF-018', 'barcode' => '899123456018', 'price' => 9500, 'stock' => 34, 'image' => '/images/products/chips.jpg'],
                    ['name' => 'Biskuit Cokelat', 'code' => 'ALF-019', 'barcode' => '899123456019', 'price' => 8500, 'stock' => 31, 'image' => '/images/products/cookies.jpg'],
                    ['name' => 'Kecap Manis', 'code' => 'ALF-020', 'barcode' => '899123456020', 'price' => 13500, 'stock' => 27, 'image' => '/images/products/soy-sauce.jpg'],
                    ['name' => 'Saus Sambal', 'code' => 'ALF-021', 'barcode' => '899123456021', 'price' => 11000, 'stock' => 29, 'image' => '/images/products/chili-sauce.jpg'],
                    ['name' => 'Sabun Cuci Piring 750ml', 'code' => 'ALF-022', 'barcode' => '899123456022', 'price' => 12000, 'stock' => 26, 'image' => '/images/products/dish-soap.jpg'],
                    ['name' => 'Deterjen Bubuk 1 Kg', 'code' => 'ALF-023', 'barcode' => '899123456023', 'price' => 18000, 'stock' => 21, 'image' => '/images/products/detergent.jpg'],
                    ['name' => 'Shampoo Sachet', 'code' => 'ALF-024', 'barcode' => '899123456024', 'price' => 1000, 'stock' => 70, 'image' => '/images/products/shampoo.jpg'],
                    ['name' => 'Susu Kental Manis 370ml', 'code' => 'ALF-025', 'barcode' => '899123456025', 'price' => 13000, 'stock' => 33, 'image' => '/images/products/susu-kental-manis.jpg'],
                    ['name' => 'Kopi Sachet', 'code' => 'ALF-026', 'barcode' => '899123456026', 'price' => 1500, 'stock' => 68, 'image' => '/images/products/kopi-sachet.jpg'],
                    ['name' => 'Air Galon Isi Ulang', 'code' => 'ALF-027', 'barcode' => '899123456027', 'price' => 7000, 'stock' => 18, 'image' => '/images/products/gallon.jpg'],
                    ['name' => 'Mi Kuah Ayam Bawang', 'code' => 'ALF-028', 'barcode' => '899123456028', 'price' => 3500, 'stock' => 42, 'image' => '/images/products/noodle-soup.jpg'],
                    ['name' => 'Minuman Cola 390ml', 'code' => 'ALF-029', 'barcode' => '899123456029', 'price' => 6000, 'stock' => 39, 'image' => '/images/products/cola-bottle.jpg'],
                    ['name' => 'Susu UHT Full Cream 1 Liter', 'code' => 'ALF-030', 'barcode' => '899123456030', 'price' => 19000, 'stock' => 20, 'image' => '/images/products/milk-full-cream.jpg'],
                    ['name' => 'Yogurt Stroberi 180ml', 'code' => 'ALF-031', 'barcode' => '899123456031', 'price' => 8000, 'stock' => 25, 'image' => '/images/products/yogurt-cup.jpg'],
                    ['name' => 'Margarin 200g', 'code' => 'ALF-032', 'barcode' => '899123456032', 'price' => 7000, 'stock' => 30, 'image' => '/images/products/margarine.jpg'],
                    ['name' => 'Tepung Terigu 1 Kg', 'code' => 'ALF-033', 'barcode' => '899123456033', 'price' => 12000, 'stock' => 23, 'image' => '/images/products/flour.jpg'],
                    ['name' => 'Garam Dapur 500g', 'code' => 'ALF-034', 'barcode' => '899123456034', 'price' => 4000, 'stock' => 36, 'image' => '/images/products/salt.jpg'],
                    ['name' => 'Sarden Kaleng 155g', 'code' => 'ALF-035', 'barcode' => '899123456035', 'price' => 14000, 'stock' => 24, 'image' => '/images/products/sardines.jpg'],
                    ['name' => 'Wafer Cokelat 140g', 'code' => 'ALF-036', 'barcode' => '899123456036', 'price' => 9000, 'stock' => 28, 'image' => '/images/products/chocolate-wafer.jpg'],
                    ['name' => 'Tisu Toilet 10 Roll', 'code' => 'ALF-037', 'barcode' => '899123456037', 'price' => 25000, 'stock' => 17, 'image' => '/images/products/toilet-tissue.jpg'],
                    ['name' => 'Pembersih Lantai 800ml', 'code' => 'ALF-038', 'barcode' => '899123456038', 'price' => 14000, 'stock' => 22, 'image' => '/images/products/floor-cleaner.jpg'],
                    ['name' => 'Baterai AA 2 pcs', 'code' => 'ALF-039', 'barcode' => '899123456039', 'price' => 15000, 'stock' => 19, 'image' => '/images/products/aa-batteries.jpg'],
                    ['name' => 'Madu Murni 250g', 'code' => 'ALF-040', 'barcode' => '899123456040', 'price' => 28000, 'stock' => 12, 'image' => '/images/products/honey.jpg'],
                    ['name' => 'Spons Cuci Piring 2 pcs', 'code' => 'ALF-041', 'barcode' => '899123456041', 'price' => 5000, 'stock' => 35, 'image' => '/images/products/dish-sponge.jpg'],
                    ['name' => 'Selai Kacang 340g', 'code' => 'ALF-042', 'barcode' => '899123456042', 'price' => 28000, 'stock' => 14, 'image' => '/images/products/peanut-butter.jpg'],
                    ['name' => 'Kue Ulang Tahun', 'code' => 'ALF-043', 'barcode' => '899123456043', 'price' => 120000, 'stock' => 8, 'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=900&q=80'],
                    ['name' => 'Ayam Geprek', 'code' => 'ALF-044', 'barcode' => '899123456044', 'price' => 22000, 'stock' => 15, 'image' => 'https://images.unsplash.com/photo-1562967916-eb82221dfb92?auto=format&fit=crop&w=900&q=80'],
                    ['name' => 'Ikan Bakar', 'code' => 'ALF-045', 'barcode' => '899123456045', 'price' => 25000, 'stock' => 10, 'image' => 'https://images.unsplash.com/photo-1534939561126-855b8675edd7?auto=format&fit=crop&w=900&q=80'],
                ]);
            }
        }
    }
}
