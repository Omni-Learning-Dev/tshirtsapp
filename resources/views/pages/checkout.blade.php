@extends('layouts.app')

@section('content')
    <section id="checkout-section" class="section-3">
        <div class="gradient-strip"></div>

        <div class="form-border checkout-container">
            <h2 class="heading-4">Checkout</h2>

            <div class="checkout-content">
                <div class="checkout-details">
                    <div class="checkout-section">
                        <h3 class="checkout-section-title">Shipping Information</h3>
                        <form id="checkout-form" method="POST" action="{{ route('place.order') }}">
                            @csrf

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Street Address</label>
                                <input type="text" id="address" name="address" class="form-control" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <select id="country" name="country" class="form-control" required>
                                    <option value="">Select country</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Botswana">Botswana</option>
                                    <!-- Add more countries as needed -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="special_instructions">Special Instructions (Optional)</label>
                                <textarea id="special_instructions" name="special_instructions" class="form-control" rows="3"></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="checkout-section">
                        <h3 class="checkout-section-title">Payment Method</h3>
                        <div class="payment-options">

{{--                            <div class="payment-option">--}}
{{--                                <input type="radio" id="payment_on_delivery" name="payment_method" value="on_delivery" form="checkout-form">--}}
{{--                                <label for="payment_on_delivery">Cash On Delivery</label>--}}
{{--                                <div class="payment-details cod-details">--}}
{{--                                    <p>Pay with cash upon delivery. Available for local deliveries only.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="payment-option">
                                <input type="radio" id="payment_pesepay" name="payment_method" value="pesepay" form="checkout-form" checked>
                                <label for="payment_pesepay">Pay Online (PesePay)</label>
                                <div class="payment-details pesepay-details">
                                    <p>Pay securely online using PesePay. Supports multiple payment methods including EcoCash and card payments.</p>
                                    <div class="pesepay-methods">
                                        <img src="{{ asset('images/visa.png') }}" alt="Visa" class="payment-icon">
                                        <img src="{{ asset('images/mastercard.png') }}" alt="MasterCard" class="payment-icon">
                                        <img src="{{ asset('images/ecocash.png') }}" alt="EcoCash" class="payment-icon">
                                        <img src="{{ asset('images/innbucks.png') }}" alt="EcoCash" class="payment-icon">
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
                                    <img src="{{ asset('images/'.$item['attributes']['image']) }}" alt="{{ $item['product_name'] }}">
                                </div>
                                <div class="summary-item-details">
                                    <h4>{{ $item['product_name'] }}</h4>
                                    <p>Size: {{ $item['attributes']['size'] }}</p>
                                    <p>Qty: {{ $item['quantity'] }}</p>
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
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax :</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total:</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="terms-agreement">
                        <label class="checkbox-container">
                            <input type="checkbox" id="terms_agreement" name="terms_agreement" required form="checkout-form">
                            <span class="checkmark"></span>
                            I have read and agree to the <a href="{{ route('terms') }}" target="_blank">Terms and Conditions</a>
                        </label>
                    </div>

                    <button type="submit" class="place-order-btn" form="checkout-form">Place Order</button>

                    <div class="back-to-cart">
                        <a href="{{ route('cart') }}">← Back to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Checkout Page Styles */

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
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #f6c648;
            outline: none;
        }

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

        .payment-details {
            margin-top: 10px;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 4px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
        }

        .bank-details {
            margin-top: 10px;
        }

        .bank-details p {
            margin: 5px 0;
        }

        .summary-items {
            margin-bottom: 20px;
            max-height: 300px;
            overflow-y: auto;
        }

        .summary-item {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-item-image {
            width: 60px;
            margin-right: 10px;
        }

        .summary-item-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .summary-item-details {
            flex: 1;
        }

        .summary-item-details h4 {
            margin: 0 0 5px 0;
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

        .summary-item-price {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #232323;
            min-width: 80px;
            text-align: right;
        }

        .summary-totals {
            padding-top: 15px;
            border-top: 1px solid #ddd;
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
        }

        .terms-agreement {
            margin: 20px 0;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            cursor: pointer;
        }

        .checkbox-container input {
            margin-right: 10px;
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
            border-radius: 50vw;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .place-order-btn:hover {
            background-color: #023459;
            color: #fff;
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

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
@endsection
