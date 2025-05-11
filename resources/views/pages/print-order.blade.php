<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->order_number }} - Print Version</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            background-color: white;
            margin: 0;
            padding: 20px;
        }

        .print-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .print-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #f6c648;
            margin-bottom: 20px;
        }

        .company-logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .company-info {
            margin-bottom: 10px;
            font-size: 12px;
        }

        .print-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .order-info {
            margin-bottom: 30px;
        }

        .order-number {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .order-date, .order-status {
            margin-bottom: 5px;
        }

        .status-badge {
            display: inline-block;
            background-color: #075163;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #f6c648;
        }

        .columns {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .column {
            flex: 1;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }

        .column-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .customer-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .address-line {
            margin: 0 0 5px 0;
        }

        .bank-details {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .order-table th {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }

        .order-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .totals {
            float: right;
            width: 250px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .total-label {
            text-align: right;
            padding-right: 10px;
        }

        .grand-total {
            font-weight: bold;
            font-size: 16px;
            padding-top: 5px;
            margin-top: 5px;
            border-top: 1px solid #ddd;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .no-print {
            text-align: center;
            margin: 20px 0;
        }

        .print-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f6c648;
            color: #232323;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-link {
            display: inline-block;
            margin-left: 10px;
            color: #075163;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
            }

            .print-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="print-container">
    <div class="no-print">
        <button onclick="window.print();" class="print-btn">Print This Page</button>
        <a href="{{ route('order.confirmation', ['order_number' => $order->order_number]) }}" class="back-link">Back to Order</a>
    </div>

    <div class="print-header">
        <div class="company-logo">{{ $companyInfo['name'] }}</div>
        <div class="company-info">
            {{ $companyInfo['address'] }} | Phone: {{ $companyInfo['phone'] }}<br>
            WhatsApp: {{ $companyInfo['whatsapp'] }} | Email: {{ $companyInfo['email'] }} <br>
             {{ $companyInfo['website'] }}
        </div>
    </div>

    <div class="print-title">Order Confirmation</div>

    <div class="order-info">
        <div class="order-number">Order #{{ $order->order_number }}</div>
        <div class="order-date">Order Date: {{ $order->created_at->format('F j, Y') }}</div>
        <div class="order-status">Status: <span class="status-badge">{{ ucfirst($order->status) }}</span></div>
        <div class="payment-method">Payment Method: {{ $order->payment_method == 'bank_transfer' ? 'Bank Transfer' : 'Cash On Delivery' }}</div>
    </div>

    <div class="section-title">Customer Information</div>
    <div class="columns">
        <div class="column">
            <div class="customer-name">{{ $order->first_name }} {{ $order->last_name }}</div>
            <p class="address-line">{{ $order->address }}</p>
            <p class="address-line">Phone: {{ $order->phone }}</p>
            <p class="address-line">Email: {{ $order->email }}</p>
        </div>

        @if($order->payment_method == 'bank_transfer')
            <div class="column">
                <h3 class="column-title">Payment Instructions</h3>
                <p>Please transfer the total amount to our bank account using your order number as reference.</p>
                <div class="bank-details">
                    <p><strong>Bank:</strong> Your Bank Name</p>
                    <p><strong>Account Name:</strong> {{ $companyInfo['name'] }}</p>
                    <p><strong>Account Number:</strong> XXXXXXXXXXXX</p>
                    <p><strong>Branch Code:</strong> XXXXX</p>
                    <p><strong>Reference:</strong> {{ $order->order_number }}</p>
                </div>
            </div>
        @endif
    </div>

    <div class="section-title">Order Summary</div>
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
                <td>
                    {{ $item->product_name }}
                    @if($item->branding_instructions)
                        <br><small><i>Branding: {{ $item->branding_instructions }}</i></small>
                    @endif
                </td>
                <td>{{ $item->size ?? 'N/A' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div class="total-row">
            <div class="total-label">Subtotal:</div>
            <div>${{ number_format($order->subtotal, 2) }}</div>
        </div>
        <div class="total-row">
            <div class="total-label">Shipping:</div>
            <div>${{ number_format($order->shipping, 2) }}</div>
        </div>
        <div class="total-row">
            <div class="total-label">Tax:</div>
            <div>${{ number_format($order->tax, 2) }}</div>
        </div>
        <div class="total-row grand-total">
            <div class="total-label">Total:</div>
            <div>${{ number_format($order->total, 2) }}</div>
        </div>
    </div>

    <div style="clear: both;"></div>

    @if($order->special_instructions)
        <div class="section-title">Special Instructions</div>
        <p>{{ $order->special_instructions }}</p>
    @endif

    <div class="footer">
        <p>Thank you for your order! If you have any questions, please contact our customer service at {{ $companyInfo['email'] }} or call us at {{ $companyInfo['phone'] }}.</p>
    </div>
</div>

<script>
    // Auto-print when the page loads (with a slight delay to ensure everything is rendered)
    window.onload = function() {
        setTimeout(function() { window.print(); }, 1000);
    };
</script>
</body>
</html>
