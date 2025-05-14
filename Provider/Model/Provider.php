<?php

namespace Provider\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Product\Model\Product;

class Provider extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'created_at',
        'updated_at',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
