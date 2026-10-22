<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('products')->where('code', 'BRG048')->exists()) {
            return;
        }

        DB::table('products')->insert([
            'id' => 48,
            'name' => 'Velg Racing Motor Set',
            'code' => 'BRG048',
            'barcode' => '899123456048',
            'price' => 650000,
            'stock' => 8,
            'image' => '/images/products/motorcycle/motorcycle-rims.svg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('products')->where('id', 48)->where('code', 'BRG048')->delete();
    }
};