<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('VitoMart');
            $table->string('address')->default('Jl.elltari seba');
            $table->string('city')->default('menia');
            $table->string('phone')->default('0812-xxxx-xxxx');
            $table->timestamps();
        });

        DB::table('store_settings')->insert([
            [
                'name' => 'VitoMart',
                'address' => 'Jl. elltari seba',
                'city' => 'menia',
                'phone' => '0812-xxxx-xxxx',
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('store_settings');
    }
};
