<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @property \DateTime date
 * @property float total
 * @property integer number
 * @property User user
 * @property Session session
 * @property Payment payment
 */
class Order extends Model
{
    protected $fillable = ["date", "total", "number"];

    protected $casts = [
        "date" => "date"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function detail()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
