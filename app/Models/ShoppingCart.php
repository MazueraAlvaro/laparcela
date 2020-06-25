<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{

    protected $with = ["products"];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }
}
