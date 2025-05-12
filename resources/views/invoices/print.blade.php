<!-- resources/views/invoices/print.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .invoice-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .company-logo {
            max-width: 200px;
            height: auto;
        }
        .company-details {
            text-align: right;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #113559;
            text-align: center;
            padding: 10px 0;
            border-bottom: 2px solid #f6c648;
        }
        .invoice-details, .customer-details {
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
            color: #008f9b;
        }
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background-color: #f0f0f0;
            text-align: left;
            padding: 10px;
            border-bottom: 2px solid #ddd;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .item-name {
            width: 40%;
        }
        .text-right {
            text-align: right;
        }
        .summary {
            width: 300px;
            margin-left: auto;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        .summary-row.total {
            font-weight: bold;
            border-top: 2px solid #ddd;
            padding-top: 10px;
            margin-top: 5px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .payment-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 12px;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-processing {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }
        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
        .status-refunded {
            background-color: #e2e3e5;
            color: #383d41;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
<div class="invoice-wrapper">
    <div class="header">
        <div>
            <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" class="company-logo">
        </div>
        <div class="company-details">
            <h3>{{ $company['name'] }}</h3>
            <p>{{ $company['address'] }}</p>
            <p>{{ $company['phone'] }}</p>
            <p>{{ $company['email'] }}</p>
            <p>{{ $company['website'] }}</p>
        </div>
    </div>

    <div class="invoice-title">
        INVOICE #{{ $order->order_number }}
    </div>

    <div class="details-grid">
        <div class="invoice-details">
            <div class="section-title">Invoice Details</div>
            <p><strong>Invoice Date:</strong> {{ $date }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d F, Y') }}</p>
            <p>
                <strong>Status:</strong>
                <span class="status-badge status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
            </p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method_label }}</p>
        </div>

        <div class="customer-details">
            <div class="section-title">Bill To</div>
            <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong><br>
                {{ $order->address }}<br>
                {{ $order->city }}, {{ $order->postal_code }}<br>
                {{ $order->country }}
            </p>
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th class="item-name">Product</th>
            <th>Options</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th class="text-right">Subtotal</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderItems as $item)
            <tr>
                <td class="item-name">{{ $item->product_name }}</td>
                <td>
                    @if($item->options)
                        @foreach($item->options as $key => $value)
                            <div><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</div>
                        @endforeach
                    @endif
                </td>
                <td>{{ $item->quantity }}</td>
                <td>ZWL ${{ number_format($item->price, 2) }}</td>
                <td class="text-right">ZWL ${{ number_format($item->subtotal, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="summary">
        <div class="summary-row">
            <div>Subtotal:</div>
            <div>USD ${{ number_format($order->subtotal, 2) }}</div>
        </div>
        <div class="summary-row">
            <div>Shipping:</div>
            <div>USD ${{ number_format($order->shipping, 2) }}</div>
        </div>
        <div class="summary-row">
            <div>Tax:</div>
            <div>USD ${{ number_format($order->tax, 2) }}</div>
        </div>
        <div class="summary-row total">
            <div>Total:</div>
            <div>USD ${{ number_format($order->total, 2) }}</div>
        </div>
    </div>

    @if($order->special_instructions)
        <div class="payment-info">
            <div class="section-title">Special Instructions</div>
            <p>{{ $order->special_instructions }}</p>
        </div>
    @endif

    <div class="payment-info">
        <div class="section-title">Payment Information</div>
        <p>Please include your invoice number when making payment.</p>
        <p><strong>Bank Details:</strong><br>
            Bank: ZB Bank<br>
            Account Name: Makombero Branding<br>
            Account Number: 1234567890<br>
            Branch: First Street, Harare<br>
            Branch Code: 12345
        </p>
    </div>

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>&copy; {{ date('Y') }} {{ $company['name'] }}. All rights reserved.</p>
    </div>
</div>
</body>
</html>
