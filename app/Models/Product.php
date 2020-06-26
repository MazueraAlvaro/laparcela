<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @property integer id
 * @property string sku
 * @property string name
 * @property string description
 * @property integer regular_price
 * @property integer discount_price
 * @property integer actual_price
 * @property boolean taxable
 * @property Unit unit
 * @property ProductStatus status
 * @property Category[] categories
 */
class Product extends Model
{
    use SoftDeletes;

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

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getActualPriceAttribute()
    {
        return (!is_null($this->discount_price) and $this->discount_price < $this->regular_price)
            ? $this->discount_price
            : $this->regular_price;
    }

    public function getTotalPrice($quantity)
    {
        return $this->actual_price * $quantity;
    }
}
