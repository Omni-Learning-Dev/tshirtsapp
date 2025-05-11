<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'postal_code',
        'country',
        'special_instructions',
        'payment_method',
        'subtotal',
        'shipping',
        'tax',
        'total',
        'status',
        'payment_reference',
        'payment_poll_url',
    ];

    /**
     * Get the order items for the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get customer's full name
     *
     * @return string
     */
    public function getCustomerNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isPaid()
    {
        return $this->status === 'paid';
    }

    /**
     * Check if the order is pending payment
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }
}
