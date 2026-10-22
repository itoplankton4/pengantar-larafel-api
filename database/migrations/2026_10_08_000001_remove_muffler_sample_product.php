<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('products')->where('code', 'BRG046')->delete();
    }

    public function down(): void
    {
        DB::table('products')->insertOrIgnore([
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
};