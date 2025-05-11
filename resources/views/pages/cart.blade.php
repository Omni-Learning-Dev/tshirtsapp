@extends('layouts.app')

@section('content')
    <section id="cart-section" class="section-3">
        <div class="gradient-strip"></div>

        <div class="form-border full-width">
            <h2 class="heading-4">Your Shopping Cart</h2>

            @if(count($cartItems) > 0)
                <div class="cart-container">
                    <div class="cart-header">
                        <div class="cart-product-col">Product</div>
                        <div class="cart-details-col">Details</div>
                        <div class="cart-quantity-col">Quantity</div>
                        <div class="cart-price-col">Price</div>
                        <div class="cart-actions-col">Actions</div>
                    </div>

                    @foreach($cartItems as $id => $item)
                        <div class="cart-item">
                            <div class="cart-product-col">
                                <img src="{{ asset('images/'.$item['attributes']['image']) }}" alt="{{ $item['product_name'] }}" class="cart-product-image">
                            </div>
                            <div class="cart-details-col">
                                <h4>{{ $item['product_name'] }}</h4>
                                <p>Size: {{ $item['attributes']['size'] }}</p>
                                @if($item['attributes']['branding_instructions'])
                                    <p class="branding-instructions">Branding: {{ $item['attributes']['branding_instructions'] }}</p>
                                @endif
                            </div>
                            <div class="cart-quantity-col">
                                <form action="{{ route('cart.update') }}" method="POST" class="quantity-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" name="action" value="decrease" class="quantity-btn">-</button>
                                    <input type="text" name="quantity" value="{{ $item['quantity'] }}" class="quantity-input" readonly>
                                    <button type="submit" name="action" value="increase" class="quantity-btn">+</button>
                                </form>
                            </div>
                            <div class="cart-price-col">
                                <p class="item-price">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                <p class="item-unit-price">${{ $item['price'] }} each</p>
                            </div>
                            <div class="cart-actions-col">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <div class="cart-summary">
                        <div class="cart-summary-row">
                            <span>Subtotal:</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="cart-summary-row">
                            <span>Shipping:</span>
                            <span>Calculated at checkout</span>
                        </div>
                        <div class="cart-summary-row cart-total">
                            <span>Total:</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="cart-actions">
                        <a href="{{ route('shop') }}" class="button continue-shopping">Continue Shopping</a>
                        <a href="{{ route('checkout') }}" class="button checkout">Proceed to Checkout</a>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <img src="{{ asset('images/empty-cart.svg') }}" alt="Empty Cart" class="empty-cart-icon">
                    <h3>Your cart is empty</h3>
                    <p>Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('shop') }}" class="button">Start Shopping</a>
                </div>
            @endif
        </div>
    </section>

    <style>
        /* Full-width form styles with margins */
        .section-3 {
            padding: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 60px; /* Added bottom margin */
        }

        .gradient-strip {
            width: 100%;
            margin-right: 0;
        }

        .form-border.full-width {
            width: calc(100% - 60px); /* Width minus side margins */
            max-width: 1400px;
            margin: 30px 30px 30px 30px; /* Left, right and bottom margins */
            padding: 40px;
            border-radius: 8px; /* Restored border radius for better look with margins */
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Added subtle shadow for elevation */
        }

        .heading-4 {
            width: 100%;
            text-align: center;
            margin-bottom: 40px;
        }

        /* Cart Styles - matching the site's existing CSS patterns */
        .cart-container {
            width: 100%;
            max-width: 1200px;
        }

        .cart-header {
            display: flex;
            padding: 15px 0;
            border-bottom: 2px solid #f6c648;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            color: #232323;
        }

        .cart-item {
            display: flex;
            padding: 20px 0;
            border-bottom: 1px solid #eeeeee;
            align-items: center;
        }

        .cart-product-col {
            width: 15%;
        }

        .cart-details-col {
            width: 35%;
        }

        .cart-quantity-col {
            width: 20%;
        }

        .cart-price-col {
            width: 15%;
        }

        .cart-actions-col {
            width: 15%;
            text-align: right;
        }

        .cart-product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .cart-item h4 {
            margin: 0 0 5px 0;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            color: #232323;
        }

        .cart-item p {
            margin: 0 0 5px 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #333333;
        }

        .branding-instructions {
            font-style: italic;
            color: #075163;
        }

        .quantity-form {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            background-color: #f6c648;
            border: none;
            color: #232323;
            font-size: 18px;
            cursor: pointer;
            border-radius: 4px;
        }

        .quantity-btn:hover {
            background-color: #232323;
            color: #fff;
        }

        .quantity-input {
            width: 40px;
            height: 30px;
            text-align: center;
            border: 1px solid #dddddd;
            margin: 0 5px;
        }

        .item-price {
            font-weight: bold;
            font-size: 18px !important;
            color: #232323 !important;
        }

        .item-unit-price {
            font-size: 12px !important;
            color: #666666 !important;
        }

        .remove-btn {
            background-color: transparent;
            border: none;
            color: #f00;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            text-decoration: underline;
        }

        .cart-summary {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            width: 100%;
            max-width: 500px;
            margin-left: auto;
        }

        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
        }

        .cart-total {
            font-weight: bold;
            font-size: 20px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            width: 100%;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            text-decoration: none;
            border-radius: 50vw;
            transition: all 0.3s ease;
        }

        .continue-shopping {
            background-color: #232323;
            color: #fff !important;
        }

        .continue-shopping:hover {
            background-color: #333;
            color: #f6c648 !important;
        }

        .checkout {
            background-color: #f6c648;
            color: #232323 !important;
        }

        .checkout:hover {
            background-color: #023459;
            color: #fff !important;
        }

        .empty-cart {
            text-align: center;
            padding: 40px 0;
            width: 100%;
        }

        .empty-cart-icon {
            width: 100px;
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            margin-bottom: 10px;
            color: #232323;
        }

        .empty-cart p {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            margin-bottom: 20px;
            color: #666;
        }

        .empty-cart .button {
            background-color: #f6c648;
            color: #232323 !important;
        }

        .empty-cart .button:hover {
            background-color: #023459;
            color: #fff !important;
        }

        /* Responsive Styles */
        @media screen and (max-width: 767px) {
            .form-border.full-width {
                width: calc(100% - 30px);
                margin: 0 15px 30px 15px;
                padding: 20px;
            }

            .cart-header {
                display: none;
            }

            .cart-item {
                flex-wrap: wrap;
                position: relative;
                padding: 15px 0;
            }

            .cart-product-col {
                width: 30%;
            }

            .cart-details-col {
                width: 70%;
            }

            .cart-quantity-col, .cart-price-col {
                width: 50%;
                margin-top: 15px;
            }

            .cart-actions-col {
                width: 100%;
                text-align: right;
                margin-top: 10px;
            }

            .cart-actions {
                flex-direction: column;
                gap: 10px;
            }

            .button {
                text-align: center;
            }

            .cart-summary {
                max-width: 100%;
            }
        }

        @media screen and (max-width: 479px) {
            .section-3 {
                margin-bottom: 40px;
            }

            .form-border.full-width {
                width: calc(100% - 20px);
                margin: 20px 10px 20px 10px;
                padding: 15px;
            }

            .cart-product-col {
                width: 40%;
            }

            .cart-details-col {
                width: 60%;
            }

            .cart-product-image {
                width: 60px;
                height: 60px;
            }

            .cart-item h4 {
                font-size: 18px;
            }

            .cart-item p {
                font-size: 12px;
            }

            .quantity-btn {
                width: 25px;
                height: 25px;
                font-size: 16px;
            }

            .quantity-input {
                width: 30px;
                height: 25px;
                font-size: 14px;
            }

            .cart-summary-row {
                font-size: 14px;
            }

            .cart-total {
                font-size: 18px;
            }
        }
    </style>
@endsection
