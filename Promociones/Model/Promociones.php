<?php

namespace Promociones\Model;

use Illuminate\Database\Eloquent\Model;
use Product\Model\Product;

class Promocion extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'descuento', 'fecha_inicio', 'fecha_fin'];
    protected $table = 'promociones';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_promocion');
    }

    public function isActive()
    {
        $now = now();
        return $now->between($this->fecha_inicio, $this->fecha_fin);
    }
}