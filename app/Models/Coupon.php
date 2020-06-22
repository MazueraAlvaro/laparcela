<?php

namespace App\Models;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Coupon
 * @package App\Models
 * @property string code
 * @property string description
 * @property boolean active
 * @property DateTime start_date
 * @property DateTime end_date
 * @property Order[] orders
 */
class Coupon extends Model
{
    protected $fillable = ["code", "description", "active", "start_date", "end_date"];
    protected $casts = [
        "active" => "boolean",
        "start_date" => "datetime",
        "end_date" => "datetime",
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
