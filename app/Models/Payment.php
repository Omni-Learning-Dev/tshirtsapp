<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[
        'order_id',
        'payment_method',
        'transaction_id',
        'amount',
        'status',
        'payment_date',
        
    ];
}
