<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'transaction_number',
        'cashier_id',
        'payment_method',
        'customer_type',
        'subtotal',
        'discount',
        'tax',
        'other_fee',
        'total',
        'paid',
        'items',
        'is_demo',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'float',
            'discount' => 'float',
            'tax' => 'float',
            'other_fee' => 'float',
            'total' => 'float',
            'paid' => 'float',
            'items' => 'array',
            'is_demo' => 'boolean',
        ];
    }

    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
}