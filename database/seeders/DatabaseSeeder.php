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
    }
}
