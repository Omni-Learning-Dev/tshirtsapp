<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Binafy\LaravelCart\Cartable;

class Product extends Model  implements Cartable
{
    protected $fillable = [
        'product_name',
        'slug',
        'price',
        'sizes',
        'colors',
        'description',
    ];

    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
        'price' => 'decimal:2',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_primary', true)
            ->withDefault(function () {
                return new ProductImage([
                    'image_path' => 'placeholder.jpg',
                    'is_primary' => true,
                ]);
            });
    }

    public function getImageUrlAttribute()
    {
        if ($this->primaryImage) {
            return asset('storage/' . $this->primaryImage->image_path);
        }

        return asset('storage/placeholder.jpg');
    }

     public function getPrice(): float
    {
        return (float) $this->price;
    }
}
