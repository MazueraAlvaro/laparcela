<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unit
 * @package App\Models
 * @property string name
 * @property string code
 * @property string unit
 * @property double increment
 */
class Unit extends Model
{
    protected $fillable = ["name", "code", "unit", "increment"];
    protected $casts = [
        "increment" =>  "double"
    ];
    public $timestamps = false;
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
