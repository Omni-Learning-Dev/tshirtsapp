<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Emmanuelsiziba\Payments\Pesepay;

class PaymentController extends Controller
{

    public function paymentGateway($orderNumber)
    {
       $order = Order::where('order_number', $orderNumber)
        ->where('status', 'pending')
        ->firstOrFail();

        $pesepay = new Pesepay(
                env('PESEPAY_INTEGRATION_KEY'),
                env('PESEPAY_ENCRYPTION_KEY')
            );

            // Set the URLs on the Pesepay instance, not on the transaction
            $pesepay->returnUrl = url('/check-payment');
            $pesepay->resultUrl = url('/payment-success/'.$orderNumber);

            // Create transaction
            $transaction = $pesepay->createTransaction(
                $order->total,
                'USD',
                'Order #' . $order->order_number,
                $order->order_number.now()
            );

            // Initiate transaction
            $response = $pesepay->initiateTransaction($transaction);

            if ($response->success()) {
                // Save payment reference and poll URL to order
                $referenceNumber = $response->referenceNumber();
                $pollUrl = $response->pollUrl();

                $order->payment_reference = $referenceNumber;
                $order->payment_poll_url = $pollUrl;
                $order->save();

                // Add reference to session
                session(['referenceNumber' => $referenceNumber]);
                session(['orderNumber' => $order->order_number]);

                // Redirect to PesePay
                return redirect($response->redirectUrl());
            } else {
                // Log error
                Log::error('PesePay payment initiation failed: ' . $response->message());

                // Return with error message
                flash()->error('Payment initiation failed: ' . $response->message());
                return redirect()->route('order.confirmation', ['order_number' => $orderNumber]);
            }

    }

    /**
     * Handle return from PesePay after payment attempt
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pesePayReturnExternal()
    {
        $referenceNumber = session('referenceNumber');
        $orderNumber = session('orderNumber');

        if (!$referenceNumber) {
            flash()->error('Payment reference not found.');
            return redirect()->route('shop');
        }

        // Initialize PesePay with environment variables
        $pesepay = new Pesepay(
            env('PESEPAY_INTEGRATION_KEY'),
            env('PESEPAY_ENCRYPTION_KEY')
        );

        // Check payment status
        $response = $pesepay->checkPayment($referenceNumber);

        if ($response->success()) {
            if ($response->paid()) {
                // Get the order by payment reference
                $order = Order::where('payment_reference', $referenceNumber)->first();

                if (!$order && $orderNumber) {
                    // Fallback to finding by order number if stored in session
                    $order = Order::where('order_number', $orderNumber)->first();
                }

                if ($order) {
                    // Update order status
                    $order->status = 'paid';
                    $order->save();

                    // Redirect to success page
                    flash()->success('Payment successful! Your order has been confirmed.');
                    return redirect()->route('pese-result', $order->order_number);
                }
            } else {
                // Get the order by payment reference
                $order = Order::where('payment_reference', $referenceNumber)->first();

                if (!$order && $orderNumber) {
                    // Fallback to finding by order number if stored in session
                    $order = Order::where('order_number', $orderNumber)->first();
                }

                if ($order) {
                    // Payment failed but still show the order confirmation page with pending status
                    flash()->warning('Your payment was not successful or is still being processed.');
                    return redirect()->route('order.confirmation', ['order_number' => $order->order_number]);
                }
            }
        } else {
            // Error checking payment
            Log::error('PesePay payment check failed: ' . $response->message());

            // Try to get the order by reference number
            $order = Order::where('payment_reference', $referenceNumber)->first();

            if (!$order && $orderNumber) {
                // Fallback to finding by order number if stored in session
                $order = Order::where('order_number', $orderNumber)->first();
            }

            if ($order) {
                flash()->error('Error checking payment status. Please contact customer support.');
                return redirect()->route('order.confirmation', ['order_number' => $order->order_number]);
            }
        }

        // Fallback redirection if we couldn't find the order
        return redirect()->route('shop');
    }

    /**
     * Show payment result page (reuses the order confirmation page)
     *
     * @param string $id (order number)
     * @return \Illuminate\View\View
     */
    public function pesePayResult($id)
    {
        // Get the order
        $order = Order::where('order_number', $id)
            ->with('orderItems')
            ->firstOrFail();

        // We're using the same order confirmation page for both success and pending
        return view('pages.order-confirmation', [
            'order' => $order
        ]);
    }

    /**
     * Legacy method - redirects to payment gateway
     * This is kept to maintain compatibility with the routes
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pesePayCheckout()
    {
        // This method would have been used if orders were stored in session
        // Since they're not, redirect to homepage with error
        flash()->error('No active order found. Please complete checkout first.');
        return redirect()->route('shop');
    }
}
