<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class CartHelper
{
    /**
     * Get the total number of items in the cart
     *
     * @return int
     */
    public static function getCartCount()
    {
        $cartItems = Session::get('cart_items', []);

        // Count total quantity of all items
        $totalItems = 0;
        foreach ($cartItems as $item) {
            $totalItems += $item['quantity'];
        }

        return $totalItems;
    }

    /**
     * Get the cart items
     *
     * @return array
     */
    public static function getCartItems()
    {
        return Session::get('cart_items', []);
    }

    /**
     * Calculate the cart total
     *
     * @return float
     */
    public static function getCartTotal()
    {
        $cartItems = Session::get('cart_items', []);

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
