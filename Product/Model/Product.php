<?php

namespace Product\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Category\Model\Category;
use Provider\Model\Provider;
use Sale\Model\Sale;

class Product extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id', 'image', 'provider_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sales()
    {
        return $this->belongsTo(Sale::class, 'sale_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
    public function provider()
{
    return $this->belongsTo(Provider::class);
}
}
