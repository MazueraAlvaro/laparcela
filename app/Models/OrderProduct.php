<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderProduct
 * @package App\Models
 * @property string sku
 * @property string name
 * @property string description
 * @property integer price
 * @property integer quantity
 * @property integer total
 */
class OrderProduct extends Model
{
    protected $fillable = ["sku", "name", "description", "price", "quantity", "subtotal"];
    public $timestamps = false;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
