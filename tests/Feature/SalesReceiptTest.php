<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesReceiptTest extends TestCase
{
    use RefreshDatabase;

    public function test_cashier_can_view_their_sale_receipt(): void
    {
        $cashier = User::factory()->create(['name' => 'Kasir Uji', 'role' => 'kasir']);
        $sale = $this->createSale($cashier);

        $this->actingAs($cashier)
            ->get(route('sales.receipt', $sale))
            ->assertOk()
            ->assertSee('VITOMART')
            ->assertSee('TRX-STRUK-001')
            ->assertSee('Produk Uji')
            ->assertSee('Kasir Uji')
            ->assertSee('Rp 12.000');
    }

    public function test_cashier_cannot_view_another_cashiers_receipt(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);
        $otherCashier = User::factory()->create(['role' => 'kasir']);
        $sale = $this->createSale($otherCashier);

        $this->actingAs($cashier)
            ->get(route('sales.receipt', $sale))
            ->assertForbidden();
    }

    private function createSale(User $cashier): Sale
    {
        return Sale::create([
            'transaction_number' => 'TRX-STRUK-001',
            'cashier_id' => $cashier->id,
            'payment_method' => 'Tunai',
            'customer_type' => 'Umum',
            'subtotal' => 12000,
            'discount' => 0,
            'tax' => 0,
            'other_fee' => 0,
            'total' => 12000,
            'paid' => 15000,
            'items' => [[
                'code' => 'BRG001',
                'name' => 'Produk Uji',
                'price' => 6000,
                'qty' => 2,
            ]],
            'is_demo' => false,
        ]);
    }
}