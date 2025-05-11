@extends('layouts.app')

@section('content')
    <section id="confirmation-section" class="section-3">
        <div class="gradient-strip"></div>

        <div class="form-border confirmation-container">
            <div class="confirmation-success">
                <div class="success-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h2 class="heading-4">Order Confirmed!</h2> <br>
                <p class="confirmation-message">Thank you for your purchase. Your order has been received and is now being processed.</p>
                <div class="order-number">
                    <p>Order Number: <span>{{ $order->order_number }}</span></p>
                </div>
            </div>

            <div class="confirmation-details">
                <div class="confirmation-section">
                    <h3 class="confirmation-section-title">Payment Information</h3>
                    <div class="confirmation-info">
                        <div class="confirmation-row">
                            <span class="info-label">Payment Method:</span>
                            <span class="info-value">
                @if($order->payment_method == 'bank_transfer')
                                    Bank Transfer
                                @elseif($order->payment_method == 'on_delivery')
                                    Cash On Delivery
                                @elseif($order->payment_method == 'pesepay')
                                    PesePay Online Payment
                                @else
                                    {{ ucfirst($order->payment_method) }}
                                @endif
            </span>
                        </div>

                        <div class="confirmation-row">
                            <span class="info-label">Payment Status:</span>
                            <span class="info-value">
                @if($order->status == 'paid')
                                    <span class="status-badge success">Paid</span>
                                @elseif($order->status == 'pending')
                                    <span class="status-badge warning">Pending</span>
                                @else
                                    <span class="status-badge">{{ ucfirst($order->status) }}</span>
                                @endif
            </span>
                        </div>

                        @if($order->payment_reference)
                            <div class="confirmation-row">
                                <span class="info-label">Payment Reference:</span>
                                <span class="info-value">{{ $order->payment_reference }}</span>
                            </div>
                        @endif
                    </div>

                    @if($order->payment_method == 'pesepay' && $order->status == 'pending')
                        <div class="payment-actions">
                            <p class="payment-note">Your payment is pending or was not completed. You can complete your payment now:</p>
                            <a href="{{ route('payment.gateway', ['order_number' => $order->order_number]) }}" class="button complete-payment">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 6v6l4 2"></path>
                                </svg>
                                Complete Payment
                            </a>
                        </div>
                    @endif

                    @if($order->payment_method == 'bank_transfer')
                        <div class="bank-transfer-info">
                            <h4>Bank Transfer Details</h4>
                            <p>Please transfer the total amount to our bank account using your order number as reference:</p>
                            <div class="bank-details-box">
                                <p><strong>Bank:</strong> Your Bank Name</p>
                                <p><strong>Account Name:</strong> Your Company Name</p>
                                <p><strong>Account Number:</strong> XXXXXXXXXXXX</p>
                                <p><strong>Branch Code:</strong> XXXXX</p>
                                <p><strong>Reference:</strong> {{ $order->order_number }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="confirmation-section">
                    <h3 class="confirmation-section-title">Customer Information</h3>
                    <div class="confirmation-columns">
                        <div class="confirmation-column">
                            <div class="address-info">
                                <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                                <p>{{ $order->address }}</p>
                                <p>{{ $order->phone }}</p>
                                <p>{{ $order->email }}</p>
                            </div>
                        </div>

                        @if($order->payment_method == 'bank_transfer')
                            <div class="confirmation-column">
                                <h4>Payment Instructions</h4>
                                <div class="payment-info">
                                    <p>Please transfer the total amount to our bank account using your order number as reference.</p>
                                    <div class="bank-details">
                                        <p><strong>Bank:</strong> Your Bank Name</p>
                                        <p><strong>Account Name:</strong> Your Company Name</p>
                                        <p><strong>Account Number:</strong> XXXXXXXXXXXX</p>
                                        <p><strong>Branch Code:</strong> XXXXX</p>
                                        <p><strong>Reference:</strong> {{ $order->order_number }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="confirmation-section">
                    <h3 class="confirmation-section-title">Order Summary</h3>
                    <div class="order-items">
                        <table class="order-table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->size ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="order-totals">
                        <div class="total-row">
                            <span>Subtotal:</span>
                            <span>${{ number_format($order->subtotal, 2) }}</span>
                        </div> 
                        <div class="total-row">
                            <span>Tax:</span>
                            <span>${{ number_format($order->tax, 2) }}</span>
                        </div>
                        <div class="total-row grand-total">
                            <span>Total:</span>
                            <span>${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="confirmation-actions">
                    <a href="{{ route('shop') }}" class="button continue-shopping">Continue Shopping</a>
                    <a href="{{ route('order.pdf', ['order_number' => $order->order_number]) }}" class="button download-pdf">
                        <svg xmlns="http://www.w3.org/2000/svg" class="pdf-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="12" y1="18" x2="12" y2="12"></line>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                        Download PDF
                    </a>
                    <a href="{{ route('order.print', ['order_number' => $order->order_number]) }}" class="button print-order" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="print-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg>
                        Print Order
                    </a>
                </div>

                <div class="confirmation-help">
                    <p>If you have any questions about your order, please contact our customer service at <a href="mailto:info@capitalkreatives.com">info@capitalkreatives.com</a> or call us at +263 782 893 151.</p>
                </div>
            </div>
        </div>
    </section>

    <style>

          #confirmation-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 0;
        }

        .form-border.confirmation-container {
            width: 90%;
            max-width: 1000px;
            padding: 30px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }


        .status-badge.success {
            background-color: #10b981;
        }

        .status-badge.warning {
            background-color: #f59e0b;
        }

        .payment-actions {
            margin-top: 20px;
            background-color: #f0f9ff;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #3b82f6;
        }

        .payment-note {
            margin-bottom: 15px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #333;
        }

        .complete-payment {
            background-color: #3b82f6;
            color: #fff !important;
            display: inline-flex;
            align-items: center;
        }

        .complete-payment:hover {
            background-color: #2563eb;
        }

        .complete-payment svg {
            margin-right: 8px;
        }

        .bank-transfer-info {
            margin-top: 20px;
        }

        .bank-transfer-info h4 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            color: #232323;
            margin-bottom: 10px;
        }

        .bank-details-box {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #eee;
        }

        .bank-details-box p {
            margin: 5px 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #333;
        }

        .confirmation-container {
            width: 90%;
            max-width: 1000px;
            padding: 30px;
        }

        .confirmation-success {
            text-align: center;
            margin-bottom: 40px;
        }

        .success-icon {
            margin: 0 auto 20px;
            width: 70px;
            height: 70px;
            background-color: #f6c648;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-icon svg {
            width: 40px;
            height: 40px;
            color: #232323;
        }

        .confirmation-message {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        .order-number {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            color: #232323;
        }

        .order-number span {
            font-weight: bold;
        }

        .confirmation-section {
            margin-bottom: 30px;
        }

        .confirmation-section-title {
            color: #232323;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f6c648;
        }

        .confirmation-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }

        .confirmation-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        .info-value {
            color: #666;
        }

        .status-badge {
            background-color: #075163;
            color: #fff;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .confirmation-columns {
            display: flex;
            gap: 20px;
        }

        .confirmation-column {
            flex: 1;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }

        .confirmation-column h4 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            color: #232323;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .address-info p, .payment-info p {
            margin: 5px 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #666;
        }

        .bank-details {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order-table th {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: left;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            color: #232323;
        }

        .order-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #666;
        }

        .order-totals {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #666;
        }

        .grand-total {
            font-weight: bold;
            font-size: 18px;
            color: #232323;
            padding-top: 10px;
            margin-top: 10px;
            border-top: 1px solid #ddd;
        }

        .confirmation-actions {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            gap: 15px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            text-decoration: none;
            border-radius: 50vw;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .continue-shopping {
            background-color: #232323;
            color: #fff !important;
        }

        .continue-shopping:hover {
            background-color: #333;
            color: #f6c648 !important;
        }

        .download-pdf {
            background-color: #075163;
            color: #fff !important;
        }

        .download-pdf:hover {
            background-color: #053e4d;
        }

        .print-order {
            background-color: #f6c648;
            color: #232323 !important;
        }

        .print-order:hover {
            background-color: #023459;
            color: #fff !important;
        }

        .pdf-icon, .print-icon {
            margin-right: 8px;
        }

        .confirmation-help {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #666;
        }

        .confirmation-help a {
            color: #075163;
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media screen and (max-width: 767px) {
            .confirmation-columns {
                flex-direction: column;
                gap: 15px;
            }

            .order-table {
                display: block;
                overflow-x: auto;
            }

            .confirmation-actions {
                flex-direction: column;
                gap: 10px;
            }

            .button {
                width: 100%;
            }
        }
    </style>
@endsection
