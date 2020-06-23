<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @property string name
 * @property string code
 * @property string description
 * @property Product[] products
 */
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'description'];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
