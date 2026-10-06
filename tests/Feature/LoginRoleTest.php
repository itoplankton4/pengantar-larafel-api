<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_and_kasir_can_login_through_separate_routes(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $cashier = User::factory()->create([
            'name' => 'Kasir Toko',
            'email' => 'kasir@example.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
        ]);

        $this->post(route('login.admin'), [
            'email' => $admin->email,
            'password' => 'admin123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);

        Auth::logout();

        $this->post(route('login.kasir'), [
            'email' => $cashier->email,
            'password' => 'kasir123',
        ])->assertRedirect(route('kasir'));

        $this->assertAuthenticatedAs($cashier);
    }

    public function test_generic_login_redirects_cashier_to_cashier_even_with_admin_intended_url(): void
    {
        $cashier = User::factory()->create([
            'email' => 'kasir@example.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
        ]);

        $this->withSession(['url.intended' => route('admin.dashboard')])
            ->post(route('login.store'), [
                'email' => $cashier->email,
                'password' => 'kasir123',
            ])
            ->assertRedirect(route('kasir'));

        $this->assertAuthenticatedAs($cashier);
    }
}
