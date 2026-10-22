<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $groups = [
            'spark-plug.svg' => [11, 44],
            'motorcycle-battery.svg' => [21],
            'led-headlight.svg' => [22],
            'multimeter.svg' => [40],
            'rain-suit.svg' => [42],
            'motorcycle-cover.svg' => [43],
            'motorcycle-horn.svg' => [45],
        ];

        foreach ($groups as $image => $productIds) {
            DB::table('products')->whereIn('id', $productIds)->update([
                'image' => "/images/products/motorcycle/{$image}",
            ]);
        }
    }
};