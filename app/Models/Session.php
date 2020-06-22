<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * @package App\Models
 * @property string data
 * @property Order[} orders
 */
class Session extends Model
{
    protected $fillable = ["data"];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
