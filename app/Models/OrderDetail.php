<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        "first_name",
        "last_name",
        "city",
        "address",
        "address_additional",
        "phone",
        "email",
        "notes",
    ];

    protected $hidden = ["id", "order_id"];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
