<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * @package App\Models
 * @property string name
 * @property Order[] orders
 */
class Payment extends Model
{
    protected $fillable = ["name"];
    public $timestamps = false;
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
