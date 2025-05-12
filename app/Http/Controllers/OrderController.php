<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CompanyInfo;

class OrderController extends Controller
{

    public function placeOrder(Request $request)
    {
        // Validate order form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'special_instructions' => 'nullable|string',
            'payment_method' => 'required|in:bank_transfer,on_delivery,pesepay',
            'terms_agreement' => 'required|accepted',
        ]);

        // Get cart items from session
        $cartItems = Session::get('cart_items', []);

        // Check if cart is empty
        if (empty($cartItems)) {
            flash()->error('Your cart is empty. Please add items to cart before checkout.');
            return redirect()->route('shop');
        }

        // Calculate order totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Calculate shipping and tax
        $shipping = 0;
        $taxRate  = 0; // 8.25%
        $tax      = $subtotal * $taxRate;
        $total    = $subtotal + $shipping + $tax;

        // Generate unique order number
        $orderNumber = 'ORD-' . strtoupper(Str::random(8));

        // Create the order using database transaction
        try {
            DB::beginTransaction();

            // Create new order
            $order = new Order();
            $order->order_number = $orderNumber;
            $order->first_name = $validated['first_name'];
            $order->last_name = $validated['last_name'];
            $order->email = $validated['email'];
            $order->phone = $validated['phone'];
            $order->address = $validated['address'];
            $order->city = $validated['city'];
            $order->postal_code = $validated['postal_code'];
            $order->country = $validated['country'];
            $order->special_instructions = $validated['special_instructions'];
            $order->payment_method = $validated['payment_method'];
            $order->subtotal = $subtotal;
            $order->shipping = $shipping;
            $order->tax = $tax;
            $order->total = $total;
            $order->status = 'pending';
            $order->save();

            // Add order items
            foreach ($cartItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item['id'];
                $orderItem->product_name = $item['product_name'];
                $orderItem->price = $item['price'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->size = $item['attributes']['size'] ?? null;
                $orderItem->branding_instructions = $item['attributes']['branding_instructions'] ?? null;
                $orderItem->save();
            }

            // Clear cart
            // Session::forget('cart_items');

            DB::commit();

            // Successful order placement
            flash()->success('Your order has been placed successfully! Your order number is: ' . $orderNumber);

            // Check if payment method is PesePay
            if ($validated['payment_method'] === 'pesepay') {
                // Redirect to the payment gateway
                return redirect()->route('payment.gateway', ['order_number' => $orderNumber]);
            }

            // Redirect to order confirmation page
            return redirect()->route('order.confirmation', ['order_number' => $orderNumber]);

        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            \Log::error('Order placement failed: ' . $e->getMessage());

            flash()->error('There was an error processing your order. Please try again or contact support.');
            return redirect()->route('checkout');
        }
    }


    public function orderConfirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('pages.order-confirmation', compact('order'));
    }

    /**
     * Send order confirmation email
     *
     * @param Order $order
     * @return void
     */
    private function sendOrderConfirmationEmail(Order $order)
    {
        // This is a placeholder for email sending functionality
        // Implement this using Laravel's Mail facade with a mailable class

        // Example implementation:
        // Mail::to($order->email)->send(new OrderConfirmation($order));
    }


    public function downloadOrderPdf($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with('orderItems')
            ->firstOrFail();

         $companyInfo = CompanyInfo::first();

        $pdf = PDF::loadView('pdfs.order-confirmation', [
            'order' => $order,
            'companyInfo' => $companyInfo
        ]);

        return $pdf->download('order_'.$order->order_number.'.pdf');
    }


    public function printOrder($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with('orderItems')
            ->firstOrFail();

        // Get company info (you can store this in config or database)
         $companyInfo = CompanyInfo::first();

        return view('pages.print-order', [
            'order' => $order,
            'companyInfo' => $companyInfo
        ]);
    }

    public function track(Order $order)
    {
        // You could implement order tracking logic here
        // For now, we'll just show order details

        return view('pages.track', compact('order'));
    }
}
