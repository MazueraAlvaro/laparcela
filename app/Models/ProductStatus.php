<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductStatus
 * @package App\Models
 * @property string name
 * @property string rendering
 * @property Product[] products
 */
class ProductStatus extends Model
{
    protected $fillable = ["name", "rendering"];
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
