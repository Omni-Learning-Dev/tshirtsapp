<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    protected $fillable = [
        'order_id',
        'size',
        'quantity',
        'gender',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
