<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * @package App\Models
 * @property string data
 * @property Order[} orders
 * @property ShoppingCart shoppingCart
 */
class Session extends Model
{
    protected $fillable = ["data"];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shoppingCart()
    {
        return $this->hasOne(ShoppingCart::class);
    }
}
