<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'category_id',
        'size',
        'gender',
        'usd_price',
        'rtgs_price',
        'category_id', // Add this line to indicate the relationship
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
