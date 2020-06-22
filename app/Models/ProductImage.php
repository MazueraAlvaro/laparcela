<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage
 * @package App\Models
 * @property string file_name
 * @property Product product
 */
class ProductImage extends Model
{
    protected $fillable = ["file_name"];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
