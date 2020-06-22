<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @property \DateTime date
 * @property integer total
 * @property User user
 * @property Session session
 * @property Payment payment
 */
class Order extends Model
{
    protected $fillable = ["date", "total"];

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
}
