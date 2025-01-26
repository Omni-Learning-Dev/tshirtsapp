<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable =[
    'name',
    'description'
  ];

  protected $casts = [
      'gender' =>'array',
      'sizes' =>'array'
  ];

  public function products()
  {
    return $this->hasMany(Product::class);
  }

  public function prices(){
    return $this->hasMany(Price::class);
  }
}
