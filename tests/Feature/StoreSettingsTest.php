<?php

namespace Tests\Feature;

use App\Models\StoreSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_settings_are_loaded_from_database(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);
        StoreSetting::create([
            'name' => 'Toko Baru',
            'address' => 'Jl. Merdeka 12',
            'city' => 'Malang',
            'phone' => '081234567890',
        ]);

        $response = $this->actingAs($cashier)->get('/profil');

        $response->assertOk();
        $response->assertSee('Toko Baru');
        $response->assertSee('Jl. Merdeka 12');
        $response->assertSee('081234567890');
    }

    public function test_admin_can_update_store_settings_from_admin_panel(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        StoreSetting::create([
            'name' => 'Toko Lama',
            'address' => 'Jl. Lama',
            'city' => 'Jember',
            'phone' => '0811',
        ]);

        $this->actingAs($admin)
            ->from(route('admin.dashboard'))
            ->post(route('admin.store-settings.update'), [
                'name' => 'Toko Modern',
                'address' => 'Jl. Baru No. 10',
                'city' => 'Malang',
                'phone' => '081234567890',
            ])
            ->assertRedirect(route('admin.store-settings'))
            ->assertSessionHas('status', 'Pengaturan toko berhasil disimpan.');

        $store = StoreSetting::latest()->first();
        $this->assertNotNull($store);
        $this->assertSame('Toko Modern', $store->name);
        $this->assertSame('Jl. Baru No. 10', $store->address);
        $this->assertSame('Malang', $store->city);
        $this->assertSame('081234567890', $store->phone);
    }
}
