<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function shop()
    {
         $products = Product::with('primaryImage')->get();
        return view('pages.shop', ['products' => $products]);
    }

    public function viewProduct($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['images' => function($query) {
                $query->orderBy('is_primary', 'desc'); // Primary images first
            }])
            ->firstOrFail();

        // Make sure sizes and colors are properly decoded from JSON
        if (is_string($product->sizes)) {
            $product->sizes = json_decode($product->sizes);
        }

        if (is_string($product->colors)) {
            $product->colors = json_decode($product->colors);
        }

        return view('pages.shop.view-product', compact('product'));
    }


    public function addToCart(Request $request)
    {

        $product = Product::find($request->product_id);
        $cartItems = Session::get('cart_items', []);


        // Check if product already exists in cart
        if (isset($cartItems[$request->product_id])) {
            // Increase quantity if product already in cart
            $cartItems[$request->product_id]['quantity'] += 1;
            flash()->info('Product quantity updated in cart');
        } else {
            // Add new product to cart
            $cartItems[$request->product_id] = [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => [
                    'size' => $request->size,
                    'image' => $product->primaryImage->image_path,
                    'branding_instructions' => $request->branding_instructions
                ]
            ];
            flash()->success('Product added to cart successfully');
        }

        // Save cart back to session
        Session::put('cart_items', $cartItems);

        return back();
    }


    public function cart(){
        $cartItems = Session::get('cart_items', []);

        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('pages.cart', compact('cartItems', 'total'));
    }

    public function removeFromCart(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cartItems = Session::get('cart_items', []);

        // Check if product exists in cart
        if (isset($cartItems[$request->product_id])) {
            // Remove the product from the cart
            unset($cartItems[$request->product_id]);

            // Save updated cart back to session
            Session::put('cart_items', $cartItems);

            flash()->success('Product removed from cart');
        } else {
            flash()->error('Product not found in cart');
        }

        return redirect()->route('cart');
    }


    public function updateCart(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'action' => 'required|in:increase,decrease,update',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $cartItems = Session::get('cart_items', []);
        $productId = $request->product_id;

        // Check if product exists in cart
        if (!isset($cartItems[$productId])) {
            flash()->error('Product not found in cart');
            return redirect()->route('cart');
        }

        // Handle different actions
        switch ($request->action) {
            case 'increase':
                $cartItems[$productId]['quantity'] += 1;
                flash()->info('Product quantity increased');
                break;

            case 'decrease':
                if ($cartItems[$productId]['quantity'] > 1) {
                    $cartItems[$productId]['quantity'] -= 1;
                    flash()->info('Product quantity decreased');
                } else {
                    // Remove the product if quantity will be 0
                    unset($cartItems[$productId]);
                    flash()->success('Product removed from cart');
                }
                break;

            case 'update':
                // If they provided a specific quantity value
                if ($request->has('quantity')) {
                    $quantity = (int) $request->quantity;
                    if ($quantity > 0) {
                        $cartItems[$productId]['quantity'] = $quantity;
                        flash()->info('Product quantity updated');
                    } else {
                        // Remove the product if quantity is 0
                        unset($cartItems[$productId]);
                        flash()->success('Product removed from cart');
                    }
                }
                break;
        }

        // Save updated cart back to session
        Session::put('cart_items', $cartItems);

        return redirect()->route('cart');
    }


    public function checkout()
    {
        $cartItems = Session::get('cart_items', []);

        // Redirect to cart if no items in cart
        if (empty($cartItems)) {
            flash()->error('Your cart is empty');
            return redirect()->route('cart');
        }

        // Calculate total
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Calculate shipping (you can replace this with your actual shipping calculation logic)
        $shipping = 0;

        // Calculate tax (example rate of 8.25%)
        $taxRate = 0;
        $tax = $subtotal * $taxRate;

        // Calculate total
        $total = $subtotal + $shipping + $tax;

        return view('pages.checkout', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }



}
