<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
     protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
        'whatsapp'
    ];
}
