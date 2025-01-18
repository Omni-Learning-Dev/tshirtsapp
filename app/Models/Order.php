<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable =[

        'quantity',
        'logo_image',
        'front_text',
        'back_text',
        'total_price',
        'status',
        'payment_status',
        'gender',
        'size',
    ];
}
