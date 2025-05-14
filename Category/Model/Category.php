<?php

namespace Category\Model;

use Illuminate\Database\Eloquent\Model;
use Product\Model\Product;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}