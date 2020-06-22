<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App\Models
 * @property string name
 * @property Product[] products
 */
class Tag extends Model
{
    protected $fillable = ["name"];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
