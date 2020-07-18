<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage
 * @package App\Models
 * @property string file_name
 * @property boolean main
 * @property Product product
 */
class ProductImage extends Model
{
    protected $fillable = ["file_name", "main"];
    public $timestamps = false;
    protected $casts = [
        "main" => "boolean"
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
