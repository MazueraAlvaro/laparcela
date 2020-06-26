<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShoppingCart
 * @package App\Models
 * @property Collection<Product> $products
 */
class ShoppingCart extends Model
{

    protected $with = ["products"];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity")->as("cartProduct");
    }
}
