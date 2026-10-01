<?php

namespace Tests\Feature;

use App\Http\Middleware\Admin as AdminMiddleware;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);
        $response = $this->actingAs($cashier)->get('/kasir');

        $response->assertStatus(200);
        $response->assertSee('TOKO RETAIL VITOXX');
        $response->assertSee('Ringkasan Pembayaran');
        $response->assertSee('Bayar & Cetak');
    }

    public function test_the_profile_page_displays_store_and_cashier_details(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);
        $response = $this->actingAs($cashier)->get('/profil');

        $response->assertOk();
        $response->assertSee('Profil Toko dan Pengelola');
        $response->assertSee('Toko Retail Vitoxx');
        $response->assertSee('Jl. Contoh No. 123');
        $response->assertSee($cashier->name);
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/kasir')->assertRedirect('/login');
        $this->get('/admin')->assertRedirect('/login');
        $this->get('/profil')->assertRedirect('/login');
    }

    public function test_cashiers_can_open_kasir_but_not_admin_dashboard(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);

        $this->actingAs($cashier)->get('/kasir')->assertOk();
        $this->actingAs($cashier)->get('/admin')->assertForbidden();
    }

    public function test_admins_can_open_admin_dashboard_and_kasir(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/admin')->assertOk()->assertSee('Panel Admin');
        $this->actingAs($admin)->get('/kasir')->assertOk();
    }

    public function test_users_can_log_in_and_are_sent_to_their_role_dashboard(): void
    {
        $cashier = User::factory()->create([
            'email' => 'cashier@example.test',
            'password' => 'password',
            'role' => 'kasir',
        ]);

        $this->post('/login', [
            'email' => $cashier->email,
            'password' => 'password',
        ])->assertRedirect(route('kasir'));

        $this->assertAuthenticatedAs($cashier);
    }

    public function test_cashier_can_log_in_with_updated_credentials(): void
    {
        $cashier = User::factory()->create([
            'email' => 'itolulu2005@gmail.com',
            'password' => 'vito2005',
            'role' => 'kasir',
        ]);

        $this->post('/login', [
            'email' => 'itolulu2005@gmail.com',
            'password' => 'vito2005',
        ])->assertRedirect(route('kasir'));

        $this->assertAuthenticatedAs($cashier);
    }

    public function test_admin_can_log_in_with_updated_credentials(): void
    {
        $admin = User::factory()->create([
            'email' => 'olivia2024@gmail.com',
            'password' => 'olivia2024',
            'role' => 'admin',
        ]);

        $this->post('/login', [
            'email' => 'olivia2024@gmail.com',
            'password' => 'olivia2024',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_authenticated_users_can_open_logout_confirmation(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);

        $this->actingAs($cashier)
            ->get('/logout')
            ->assertOk()
            ->assertSee('Keluar dari akun?')
            ->assertSee($cashier->name);
    }

    public function test_logout_ends_the_session_and_shows_a_success_message(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);

        $this->actingAs($cashier)
            ->post('/logout')
            ->assertRedirect('/login')
            ->assertSessionHas('status', 'Anda berhasil keluar dari sistem.');

        $this->assertGuest();
    }

    public function test_guests_cannot_open_logout_confirmation(): void
    {
        $this->get('/logout')->assertRedirect('/login');
    }

    public function test_admin_middleware_logs_after_response(): void
    {
        Log::spy();
        $request = Request::create('/admin', 'GET');
        $response = new Response('OK', 200);

        (new AdminMiddleware())->terminate($request, $response);

        Log::shouldHaveReceived('info')->once()->with('Request selesai', [
            'url' => $request->fullUrl(),
            'status' => 200,
        ]);
    }
}
