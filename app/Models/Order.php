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

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function quantities()
    {
        return $this->hasMany(Quantity::class);
    }
}
