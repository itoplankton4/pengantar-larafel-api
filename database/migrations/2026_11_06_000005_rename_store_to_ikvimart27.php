<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('store_settings')) {
            DB::table('store_settings')
                ->where('name', 'ikeevimart')
                ->update(['name' => 'ikvimart27', 'updated_at' => now()]);
        }
    }

    public function down(): void
    {
        // Keep the new store name if this migration is rolled back.
    }
};
