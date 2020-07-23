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
 * @property float subtotal
 */
class OrderProduct extends Model
{
    protected $fillable = ["sku", "name", "description", "price", "quantity", "subtotal", "unit"];
    public $timestamps = false;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function calcSubtotal()
    {
        $this->subtotal = $this->quantity * $this->price;
        return $this->subtotal;
    }
}
