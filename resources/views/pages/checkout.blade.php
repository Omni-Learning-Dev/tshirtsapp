@extends('layouts.app')

@section('content')
    <section id="checkout-section" class="section-3">
        <div class="gradient-strip"></div>

        <div class="form-border checkout-container">
            <h2 class="heading-4">Checkout</h2>

            <div class="checkout-content">
                <div class="checkout-details">
                    <!-- Delivery Options Section -->
                    <div class="checkout-section">
                        <h3 class="checkout-section-title">Delivery Option</h3>
                        <div class="delivery-options">
                            <div class="delivery-option">
                                <input type="radio" id="pickup" name="delivery_method" value="pickup" onchange="toggleDeliveryForm()">
                                <label for="pickup">Pick-Up</label>
                                <p class="delivery-description">Collect your order from our location</p>
                            </div>
                            <div class="delivery-option">
                                <input type="radio" id="delivery" name="delivery_method" value="delivery" onchange="toggleDeliveryForm()">
                                <label for="delivery">Delivery</label>
                                <p class="delivery-description">We deliver to your specified address</p>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Form -->
                    <div class="checkout-section">
                        <h3 class="checkout-section-title">Customer Information</h3>
                        <form id="checkout-form" method="POST" action="{{ route('place.order') }}">
                            @csrf
                            <input type="hidden" id="selected_delivery_method" name="delivery_method" value="">

                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>

                            <!-- Delivery Address Section (Hidden by default) -->
                            <div id="delivery-address-section" class="delivery-address-section" style="display: none;">
                                <h4 class="delivery-address-title">Delivery Address</h4>
                                <div class="form-group">
                                    <label for="address">Full Address & Directions</label>
                                    <textarea id="address" name="address" class="form-control" rows="4" placeholder="Please provide your complete address and any specific directions to help our delivery team find you easily..."></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="special_instructions">Special Instructions (Optional)</label>
                                <textarea id="special_instructions" name="special_instructions" class="form-control" rows="3" placeholder="Any special requests or notes..."></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Method Section -->
                    <div class="checkout-section">
                        <h3 class="checkout-section-title">Payment Method</h3>
                        <div class="payment-options">
                            <div class="payment-option">
                                <input type="radio" id="payment_pesepay" name="payment_method" value="pesepay" form="checkout-form" checked>
                                <label for="payment_pesepay">Pay Online (PesePay)</label>
                                <div class="payment-details pesepay-details">
                                    <p>Pay securely online using PesePay. Supports multiple payment methods including EcoCash and card payments.</p>
                                    <div class="pesepay-methods">
                                        <img src="{{ asset('images/visa.png') }}" alt="Visa" class="payment-icon">
                                        <img src="{{ asset('images/mastercard.png') }}" alt="MasterCard" class="payment-icon">
                                        <img src="{{ asset('images/ecocash.png') }}" alt="EcoCash" class="payment-icon">
                                        <img src="{{ asset('images/innbucks.png') }}" alt="InnBucks" class="payment-icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout-summary">
                    <h3 class="checkout-section-title">Order Summary</h3>

                    <div class="summary-items">
                        @foreach($cartItems as $id => $item)
                            <div class="summary-item">
                                <div class="summary-item-image">
                                    @if(isset($item['attributes']['image']) && $item['attributes']['image'])
                                        <img src="{{ asset('storage/' . $item['attributes']['image']) }}" alt="{{ $item['product_name'] }}">
                                    @else
                                        <img src="{{ asset('images/default-product.png') }}" alt="{{ $item['product_name'] }}">
                                    @endif
                                </div>
                                <div class="summary-item-details">
                                    <h4>{{ $item['product_name'] }}</h4>
                                    @if(isset($item['attributes']['color']))
                                        <p>Color: {{ $item['attributes']['color'] }}</p>
                                    @endif
                                    @if(isset($item['attributes']['size']))
                                        <p>Size: {{ $item['attributes']['size'] }}</p>
                                    @endif
                                    <p>Qty: {{ $item['quantity'] }}</p>
                                    @if(isset($item['attributes']['has_customization']) && $item['attributes']['has_customization'])
                                        <p><small>✓ Custom branding</small></p>
                                    @endif
                                </div>
                                <div class="summary-item-price">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="summary-totals">
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span id="shipping-cost">${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax:</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total:</span>
                            <span id="total-cost">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="terms-agreement">
                        <label class="checkbox-container">
                            <input type="checkbox" id="terms_agreement" name="terms_agreement" required form="checkout-form">
                            <span class="checkmark"></span>
                            I have read and agree to the <a href="{{ route('terms') }}" target="_blank">Terms and Conditions</a>
                        </label>
                    </div>

                    <button type="submit" class="place-order-btn" form="checkout-form" disabled>Select Delivery Option</button>

                    <div class="back-to-cart">
                        <a href="{{ route('cart') }}">← Back to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleDeliveryForm() {
            const pickupRadio = document.getElementById('pickup');
            const deliveryRadio = document.getElementById('delivery');
            const deliverySection = document.getElementById('delivery-address-section');
            const addressField = document.getElementById('address');
            const hiddenDeliveryMethod = document.getElementById('selected_delivery_method');
            const placeOrderBtn = document.querySelector('.place-order-btn');
            const shippingCost = document.getElementById('shipping-cost');
            const totalCost = document.getElementById('total-cost');

            if (deliveryRadio.checked) {
                // Show delivery form
                deliverySection.style.display = 'block';

                // Make address field required
                addressField.required = true;

                // Set delivery method
                hiddenDeliveryMethod.value = 'delivery';

                // Update shipping cost (example: $5 for delivery)
                shippingCost.textContent = '$5.00';
                totalCost.textContent = '${{ number_format($subtotal + 5 + $tax, 2) }}';

                // Update button text
                placeOrderBtn.textContent = 'Place Order - Delivery';
                placeOrderBtn.disabled = false;

            } else if (pickupRadio.checked) {
                // Hide delivery form
                deliverySection.style.display = 'none';

                // Remove required from address field
                addressField.required = false;

                // Clear address field
                addressField.value = '';

                // Set delivery method
                hiddenDeliveryMethod.value = 'pickup';

                // Update shipping cost (free for pickup)
                shippingCost.textContent = '$0.00';
                totalCost.textContent = '${{ number_format($subtotal + $tax, 2) }}';

                // Update button text
                placeOrderBtn.textContent = 'Place Order - Pick-Up';
                placeOrderBtn.disabled = false;
            }
        }

        // Initialize form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('checkout-form');

            form.addEventListener('submit', function(e) {
                const deliveryMethod = document.getElementById('selected_delivery_method').value;

                if (!deliveryMethod) {
                    e.preventDefault();
                    alert('Please select a delivery option (Pick-Up or Delivery).');
                    return false;
                }

                return true;
            });
        });
    </script>

    <style>
        /* Checkout Page Styles */
        .checkout-container {
            width: 90%;
            max-width: 1100px;
            padding: 30px;
        }

        .checkout-content {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .checkout-details {
            width: 60%;
            padding-right: 30px;
        }

        .checkout-summary {
            width: 40%;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .checkout-section {
            margin-bottom: 30px;
        }

        .checkout-section-title {
            color: #232323;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f6c648;
        }

        /* Delivery Options Styles */
        .delivery-options {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .delivery-option {
            flex: 1;
            padding: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .delivery-option:hover {
            border-color: #f6c648;
            background-color: #fefcf5;
        }

        .delivery-option input[type="radio"] {
            margin-right: 10px;
        }

        .delivery-option input[type="radio"]:checked + label {
            color: #023459;
            font-weight: bold;
        }

        .delivery-option:has(input[type="radio"]:checked) {
            border-color: #f6c648;
            background-color: #fefcf5;
        }

        .delivery-option label {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            color: #232323;
            cursor: pointer;
            display: block;
            margin-bottom: 5px;
        }

        .delivery-description {
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        /* Delivery Address Section */
        .delivery-address-section {
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #f6c648;
        }

        .delivery-address-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            color: #023459;
            margin-bottom: 15px;
        }

        /* Form Styles */
        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #f6c648;
            outline: none;
            box-shadow: 0 0 0 2px rgba(246, 198, 72, 0.2);
        }

        /* Payment Options */
        .payment-options {
            margin-top: 15px;
        }

        .payment-option {
            margin-bottom: 15px;
        }

        .payment-option label {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: bold;
            margin-left: 5px;
            cursor: pointer;
        }

        .pesepay-details {
            margin-top: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .pesepay-methods {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .payment-icon {
            height: 30px;
            object-fit: contain;
        }

        /* Order Summary */
        .summary-items {
            margin-bottom: 20px;
            max-height: 300px;
            overflow-y: auto;
        }

        .summary-item {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-item-image {
            width: 60px;
            margin-right: 15px;
        }

        .summary-item-image img {
            width: 100%;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .summary-item-details {
            flex: 1;
        }

        .summary-item-details h4 {
            margin: 0 0 8px 0;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            color: #232323;
        }

        .summary-item-details p {
            margin: 0 0 3px 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            color: #666;
        }

        .summary-item-details small {
            color: #28a745;
            font-weight: 600;
        }

        .summary-item-price {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #232323;
            min-width: 80px;
            text-align: right;
            align-self: flex-start;
        }

        .summary-totals {
            padding-top: 15px;
            border-top: 2px solid #ddd;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
        }

        .summary-total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            color: #023459;
        }

        .terms-agreement {
            margin: 20px 0;
        }

        .checkbox-container {
            display: flex;
            align-items: flex-start;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            cursor: pointer;
            line-height: 1.4;
        }

        .checkbox-container input {
            margin-right: 10px;
            margin-top: 2px;
        }

        .checkbox-container a {
            color: #075163;
            text-decoration: underline;
        }

        .place-order-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #f6c648;
            color: #232323;
            border: none;
            border-radius: 50px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .place-order-btn:hover:not(:disabled) {
            background-color: #023459;
            color: #fff;
        }

        .place-order-btn:disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        .back-to-cart {
            text-align: center;
            margin-top: 15px;
        }

        .back-to-cart a {
            color: #075163;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            text-decoration: none;
        }

        .back-to-cart a:hover {
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media screen and (max-width: 767px) {
            .checkout-details, .checkout-summary {
                width: 100%;
                padding-right: 0;
            }

            .checkout-details {
                margin-bottom: 30px;
            }

            .delivery-options {
                flex-direction: column;
                gap: 15px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
@endsection
