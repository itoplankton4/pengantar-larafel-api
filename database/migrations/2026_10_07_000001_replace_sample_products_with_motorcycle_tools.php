<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $products = [
            1 => ['Kunci Pas Ring 10 mm', 35000],
            2 => ['Kunci Pas Ring 12 mm', 42000],
            3 => ['Set Kunci L 9 pcs', 65000],
            4 => ['Obeng Plus', 18000],
            5 => ['Obeng Minus', 18000],
            6 => ['Tang Kombinasi', 45000],
            7 => ['Tang Potong', 40000],
            8 => ['Tang Jepit', 35000],
            9 => ['Kunci Inggris 8 inci', 85000],
            10 => ['Kunci Busi 21 mm', 25000],
            11 => ['Busi Standar', 28000],
            12 => ['Oli Mesin 10W-40 0.8L', 65000],
            13 => ['Oli Gardan', 18000],
            14 => ['Kampas Rem Depan', 45000],
            15 => ['Kampas Rem Belakang', 38000],
            16 => ['Rantai Motor', 120000],
            17 => ['Gear Set Motor', 180000],
            18 => ['Ban Dalam 14 inci', 70000],
            19 => ['Peralatan Tambal Ban', 18000],
            20 => ['Pompa Angin Mini', 95000],
            21 => ['Aki Motor 12V', 350000],
            22 => ['Lampu LED Motor', 65000],
            23 => ['Spion Motor Universal', 55000],
            24 => ['Handle Grip Motor', 30000],
            25 => ['Kabel Gas Motor', 25000],
            26 => ['Kabel Rem Motor', 22000],
            27 => ['Filter Udara Motor', 35000],
            28 => ['Filter Oli Motor', 28000],
            29 => ['Kampas Kopling', 120000],
            30 => ['Per Kopling Motor', 45000],
            31 => ['Bearing Roda Motor', 38000],
            32 => ['Seal Shock Depan', 25000],
            33 => ['Minyak Rem', 30000],
            34 => ['Cairan Pendingin Radiator', 45000],
            35 => ['Pembersih Rantai Motor', 40000],
            36 => ['Pelumas Rantai Motor', 55000],
            37 => ['Lap Microfiber', 18000],
            38 => ['Sikat Rantai Motor', 22000],
            39 => ['Toolkit Darurat Motor', 150000],
            40 => ['Multimeter Digital', 95000],
            41 => ['Sarung Tangan Mekanik', 60000],
            42 => ['Jas Hujan Motor', 85000],
            43 => ['Cover Motor', 120000],
            44 => ['Busi Iridium', 75000],
            45 => ['Klakson Motor', 55000],
        ];

        foreach ($products as $id => [$name, $price]) {
            DB::table('products')->where('id', $id)->update([
                'name' => $name,
                'price' => $price,
                'image' => '/images/products/product-default.jpg',
            ]);
        }
    }
};