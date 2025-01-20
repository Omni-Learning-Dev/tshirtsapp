<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable =[
        'quantity',
        'logo_image',
        'front_text',
        'back_text',
        'total_price',
        'client_id',
        'category_id',
        'status',
        'payment_status',
    ];
}
