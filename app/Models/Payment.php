<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'payment_method', // 'cash', 'transfer', 'credit_card', 'debit_card'
        'reference_number',
        'card_number',
        'cardholder_name',
        'card_expiry',
        'bank_name',
        'account_number',
        'amount',
        'status',
        'amount_tendered',
        'change',
        'installments'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
