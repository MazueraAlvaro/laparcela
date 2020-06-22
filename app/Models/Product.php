<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property string sku
 * @property string name
 * @property string description
 * @property integer regular_price
 * @property integer discount_price
 * @property boolean taxable
 * @property Unit unit
 * @property ProductStatus status
 * @property Category[] categories
 */
class Product extends Model
{
    protected $fillable = ["sku", "name", "description", "regular_price", "discount_price", "taxable"];

    protected $casts = [
        "taxable" => "boolean"
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, "product_status_id");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
