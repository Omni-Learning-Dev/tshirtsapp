<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Order Confirmation #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .company-info {
            margin-bottom: 10px;
            font-size: 10px;
        }

        .order-info {
            margin-bottom: 20px;
        }

        .order-number {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .order-date {
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #f6c648;
        }

        .columns {
            display: table;
            width: 100%;
        }

        .column {
            display: table-cell;
            width: 50%;
            padding-right: 10px;
            vertical-align: top;
        }

        .box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .customer-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order-table th {
            background-color: #f0f0f0;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }

        .order-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }

        .total-label {
            display: table-cell;
            width: 70%;
            text-align: right;
            padding-right: 10px;
        }

        .total-value {
            display: table-cell;
            width: 30%;
            text-align: right;
        }

        .grand-total {
            font-weight: bold;
            font-size: 14px;
            padding-top: 5px;
            border-top: 1px solid #ddd;
        }

        .payment-info {
            margin-top: 20px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
        }

        .bank-details {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo">{{ $companyInfo['name'] }}</div>
        <div class="company-info">
            {{ $companyInfo['address'] }} | Phone: {{ $companyInfo['phone'] }}<br>
            WhatsApp: {{ $companyInfo['whatsapp'] }} | Email: {{ $companyInfo['email'] }} <br>
             {{ $companyInfo['website'] }}
        </div>
    </div>

    <div class="order-info">
        <div class="order-number">Order Confirmation #{{ $order->order_number }}</div>
        <div class="order-date">Order Date: {{ $order->created_at->format('F j, Y') }}</div>
        <div>Order Status: {{ ucfirst($order->status) }}</div>
    </div>

    <div class="section-title">Customer Information</div>
    <div class="columns">
        <div class="column">
            <div class="box">
                <div class="customer-name">{{ $order->first_name }} {{ $order->last_name }}</div>
                <div>{{ $order->address }}</div>
                <div>Phone: {{ $order->phone }}</div>
                <div>Email: {{ $order->email }}</div>
            </div>
        </div>
        <div class="column">
            <div class="box">
                <div class="sub-title">Order & Payment Details</div>
                <div>Payment Method: {{ $order->payment_method == 'bank_transfer' ? 'Bank Transfer' : 'Cash On Delivery' }}</div>

                @if($order->payment_method == 'bank_transfer')
                    <div class="bank-details">
                        <div><b>Bank:</b> Your Bank Name</div>
                        <div><b>Account Name:</b> {{ $companyInfo['name'] }}</div>
                        <div><b>Account Number:</b> XXXXXXXXXXXX</div>
                        <div><b>Branch Code:</b> XXXXX</div>
                        <div><b>Reference:</b> {{ $order->order_number }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="section-title">Order Summary</div>
    <table class="order-table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th style="text-align: right;">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderItems as $item)
            <tr>
                <td>
                    {{ $item->product_name }}
                    @if($item->branding_instructions)
                        <br><small><i>Branding: {{ $item->branding_instructions }}</i></small>
                    @endif
                </td>
                <td>{{ $item->size ?? 'N/A' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td style="text-align: right;">${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="width: 250px; float: right;">
        <div class="total-row">
            <div class="total-label">Subtotal:</div>
            <div class="total-value">${{ number_format($order->subtotal, 2) }}</div>
        </div>
        <div class="total-row">
            <div class="total-label">Shipping:</div>
            <div class="total-value">${{ number_format($order->shipping, 2) }}</div>
        </div>
        <div class="total-row">
            <div class="total-label">Tax:</div>
            <div class="total-value">${{ number_format($order->tax, 2) }}</div>
        </div>
        <div class="total-row grand-total">
            <div class="total-label">Total:</div>
            <div class="total-value">${{ number_format($order->total, 2) }}</div>
        </div>
    </div>

    <div style="clear: both;"></div>

    @if($order->special_instructions)
        <div class="section-title">Special Instructions</div>
        <div class="box" style="margin-bottom: 20px;">
            {{ $order->special_instructions }}
        </div>
    @endif

    <div class="footer">
        <p>Thank you for your order! If you have any questions, please contact our customer service at {{ $companyInfo['email'] }} or call us at {{ $companyInfo['phone'] }}.</p>
        <p>This is an automatically generated document and does not require a signature.</p>
    </div>
</div>
</body>
</html>
