<?php

namespace Tests\Feature;

use App\Http\Middleware\Admin as AdminMiddleware;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        $response->assertSee('VITOMART');
        $response->assertSee('Ringkasan Pembayaran');
        $response->assertSee('Bayar & Cetak');
    }

    public function test_the_profile_page_displays_store_and_cashier_details(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);
        $response = $this->actingAs($cashier)->get('/profil');

        $response->assertOk();
        $response->assertSee('Profil Toko dan Pengelola');
        $response->assertSee('VitoMart');
        $response->assertSee('Jl. Contoh No. 123');
        $response->assertSee($cashier->name);
    }

    public function test_authenticated_user_can_upload_and_view_profile_photo(): void
    {
        Storage::fake('local');
        $cashier = User::factory()->create(['role' => 'kasir']);
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/ncoAAAAASUVORK5CYII=');

        $this->actingAs($cashier)
            ->from(route('profil'))
            ->post(route('profil.photo.update'), ['photo' => UploadedFile::fake()->createWithContent('profile.png', $png)])
            ->assertRedirect(route('profil'))
            ->assertSessionHas('status', 'Foto profil berhasil diperbarui.');

        $photoPath = $cashier->fresh()->profile_photo_path;
        $this->assertNotEmpty($photoPath);
        Storage::disk('local')->assertExists($photoPath);

        $this->get(route('profil.photo'))->assertOk()->assertHeader('Content-Type', 'image/png');
        $this->actingAs($cashier)->get(route('profil'))->assertSee(route('profil.photo'));
    }

    public function test_profile_photo_upload_rejects_non_image_files(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);

        $this->actingAs($cashier)
            ->from(route('profil'))
            ->post(route('profil.photo.update'), ['photo' => UploadedFile::fake()->create('notes.txt', 10, 'text/plain')])
            ->assertRedirect(route('profil'))
            ->assertSessionHasErrors('photo');

        $this->assertNull($cashier->fresh()->profile_photo_path);
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

        $this->actingAs($admin)->get('/admin')->assertOk()
            ->assertSee('Panel Admin')
            ->assertSee('Grafik Penjualan')
            ->assertSee('Harian')
            ->assertSee('Mingguan')
            ->assertSee('Bulanan');
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

    public function test_recorded_sales_appear_in_daily_weekly_and_monthly_charts(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($cashier)->postJson(route('sales.store'), [
            'transaction_number' => 'TRX-CHART-TEST-001',
            'payment_method' => 'Tunai',
            'customer_type' => 'Umum',
            'discount_percent' => 0,
            'discount_amount' => 0,
            'tax' => 0,
            'other_fee' => 0,
            'paid' => 7000,
            'items' => [
                ['id' => 1, 'code' => 'BRG001', 'name' => 'Indomie Goreng', 'price' => 3500, 'qty' => 2],
            ],
        ])->assertCreated()->assertJsonPath('total', 7000);

        $this->assertDatabaseCount('sales', 1);

        $this->actingAs($admin)->getJson(route('admin.sales.chart', ['period' => 'daily']))
            ->assertOk()
            ->assertJsonPath('total', 7000)
            ->assertJsonPath('transactions', 1)
            ->assertJsonCount(24, 'series')
            ->assertJsonPath('series.'.now()->hour.'.total', 7000);

        $this->getJson(route('admin.sales.chart', ['period' => 'weekly']))
            ->assertOk()
            ->assertJsonCount(7, 'series')
            ->assertJsonPath('series.6.total', 7000);

        $this->getJson(route('admin.sales.chart', ['period' => 'monthly']))
            ->assertOk()
            ->assertJsonCount(12, 'series')
            ->assertJsonPath('series.11.total', 7000);
    }

    public function test_cashiers_cannot_access_sales_chart_data(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);

        $this->actingAs($cashier)
            ->getJson(route('admin.sales.chart', ['period' => 'daily']))
            ->assertForbidden();
    }

    public function test_gateway_payment_checkout_falls_back_to_demo_when_midtrans_is_not_configured(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);

        $this->actingAs($cashier)
            ->postJson(route('payment.checkout'), [
                'amount' => 25000,
                'order_id' => 'ORDER-TEST-001',
                'customer_name' => 'Budi',
                'customer_email' => 'budi@example.com',
                'customer_phone' => '081234567890',
            ])
            ->assertOk()
            ->assertJsonPath('demo', true)
            ->assertJsonPath('status', 'demo');
    }

    public function test_gateway_payment_checkout_uses_midtrans_when_configured(): void
    {
        config([
            'services.midtrans.server_key' => 'SB-Mid-server-123',
            'services.midtrans.client_key' => 'SB-Mid-client-123',
        ]);

        Http::fake([
            'https://app.sandbox.midtrans.com/snap/v1/transactions' => Http::response([
                'token' => 'midtrans-token-xyz',
                'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/midtrans-token-xyz',
            ], 201),
        ]);

        $this->actingAs(User::factory()->create(['role' => 'kasir']))
            ->postJson(route('payment.checkout'), [
                'amount' => 25000,
                'order_id' => 'ORDER-REAL-001',
                'customer_name' => 'Budi',
                'customer_email' => 'budi@example.com',
                'customer_phone' => '081234567890',
            ])
            ->assertOk()
            ->assertJsonPath('status', 'pending')
            ->assertJsonPath('demo', false)
            ->assertJsonPath('token', 'midtrans-token-xyz');
    }

    public function test_midtrans_notification_callback_accepts_request(): void
    {
        $this->postJson(route('payment.callback'), [
            'order_id' => 'ORDER-REAL-001',
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => '25000',
            'transaction_id' => 'abc-123',
        ])->assertOk()
            ->assertJsonPath('status', 'ok');
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
