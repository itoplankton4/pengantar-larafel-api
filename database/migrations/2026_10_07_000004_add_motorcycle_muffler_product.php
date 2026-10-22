<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('products')->where('code', 'BRG046')->exists()) {
            return;
        }

        DB::table('products')->insert([
            'id' => 46,
            'name' => 'Knalpot Motor Universal',
            'code' => 'BRG046',
            'barcode' => '899123456046',
            'price' => 350000,
            'stock' => 10,
            'image' => '/images/products/motorcycle/muffler-photo.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('products')->where('id', 46)->where('code', 'BRG046')->delete();
    }
};