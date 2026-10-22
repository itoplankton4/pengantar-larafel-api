<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('products')->where('code', 'BRG047')->exists()) {
            return;
        }

        DB::table('products')->insert([
            'id' => 47,
            'name' => 'Helm Full Face Grafis',
            'code' => 'BRG047',
            'barcode' => '899123456047',
            'price' => 450000,
            'stock' => 8,
            'image' => '/images/products/motorcycle/helmet-photo.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('products')->where('id', 47)->where('code', 'BRG047')->delete();
    }
};