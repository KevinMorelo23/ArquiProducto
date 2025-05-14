<?php

namespace Sale\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Payment\Model\Payment;
use Product\Model\Product;
use app\Models\User;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'payment_method', 'payment_details', 'status', 'user_id', 'shipping_name', 'shipping_address', 'shipping_city', 'shipping_phone'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}