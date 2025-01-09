<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
        'category_id',
        'product_name',
        'price',
        'size',
        'color',
        'stock',
        'image_url',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
