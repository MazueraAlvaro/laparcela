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

    protected $with = ["products", "products.images", "products.unit"];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity")->as("cartProduct");
    }

    public function getTotalAttribute()
    {
        return $this->products->reduce(function ($total, $product){
            return $product->getTotalPrice($product->cartProduct->quantity) + $total;
        }, 0);
    }
}
