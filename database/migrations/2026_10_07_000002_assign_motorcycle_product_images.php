<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $groups = [
            'tools.jpg' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 19, 20, 39, 40],
            'engine-oil.jpg' => [12, 13, 28, 33, 34],
            'chain-lubricant.jpg' => [35, 36, 38],
            'brake-wheel.jpg' => [14, 15, 31],
            'rear-wheel-chain.jpg' => [16, 17, 18],
            'motorcycle-mirror.jpg' => [23],
            'motorcycle-repair.jpg' => [11, 21, 22, 24, 25, 26, 27, 29, 30, 32, 37, 41, 42, 43, 44, 45],
        ];

        foreach ($groups as $image => $productIds) {
            DB::table('products')->whereIn('id', $productIds)->update([
                'image' => "/images/products/motorcycle/{$image}",
            ]);
        }
    }
};