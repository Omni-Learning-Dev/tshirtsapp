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

        // Get cart count for the view cart button
        $cartItems = Session::get('cart_items', []);
        $cartCount = count($cartItems);

        return view('pages.shop.view-product', compact('product', 'cartCount'));
    }

    public function addToCart(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => 'required|string',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'custom_color' => 'nullable|string|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'branding_instructions' => 'nullable|string|max:1000'
        ]);

        $product = Product::find($request->product_id);
        $cartItems = Session::get('cart_items', []);

        // Handle color selection - use custom color if provided, otherwise use selected color
        $selectedColor = $request->custom_color ?: $request->color;
        $isCustomColor = !empty($request->custom_color);

        // Handle logo upload if provided
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Create unique cart key based on product, color, and size
        $cartKey = $request->product_id . '_' . str_replace(' ', '_', strtolower($selectedColor)) . '_' . str_replace(' ', '_', strtolower($request->size));

        // Check if exact same product with same attributes already exists in cart
        if (isset($cartItems[$cartKey])) {
            // Increase quantity if exact same product configuration is already in cart
            $cartItems[$cartKey]['quantity'] += (int)$request->quantity;
            flash()->info('Product quantity updated in cart');
        } else {
            // Add new product configuration to cart
            $cartItems[$cartKey] = [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => (int)$request->quantity,
                'attributes' => [
                    'color' => $selectedColor,
                    'is_custom_color' => $isCustomColor,
                    'size' => $request->size,
                    'image' => $product->primaryImage ? $product->primaryImage->image_path : null,
                    'logo_path' => $logoPath,
                    'branding_instructions' => $request->branding_instructions,
                    'customization' => $request->has('customization') ? true : false
                ]
            ];
            flash()->success('Product added to cart successfully');
        }

        // Save cart back to session
        Session::put('cart_items', $cartItems);

        return redirect()->route('cart');
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
            'cart_key' => 'required|string'
        ]);

        $cartItems = Session::get('cart_items', []);

        // Check if cart item exists
        if (isset($cartItems[$request->cart_key])) {
            // Remove the item from the cart
            unset($cartItems[$request->cart_key]);

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
            'cart_key' => 'required|string',
            'action' => 'required|in:increase,decrease,update',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $cartItems = Session::get('cart_items', []);
        $cartKey = $request->cart_key;

        // Check if cart item exists
        if (!isset($cartItems[$cartKey])) {
            flash()->error('Product not found in cart');
            return redirect()->route('cart');
        }

        // Handle different actions
        switch ($request->action) {
            case 'increase':
                $cartItems[$cartKey]['quantity'] += 1;
                flash()->info('Product quantity increased');
                break;

            case 'decrease':
                if ($cartItems[$cartKey]['quantity'] > 1) {
                    $cartItems[$cartKey]['quantity'] -= 1;
                    flash()->info('Product quantity decreased');
                } else {
                    // Remove the product if quantity will be 0
                    unset($cartItems[$cartKey]);
                    flash()->success('Product removed from cart');
                }
                break;

            case 'update':
                // If they provided a specific quantity value
                if ($request->has('quantity')) {
                    $quantity = (int) $request->quantity;
                    if ($quantity > 0) {
                        $cartItems[$cartKey]['quantity'] = $quantity;
                        flash()->info('Product quantity updated');
                    } else {
                        // Remove the product if quantity is 0
                        unset($cartItems[$cartKey]);
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
