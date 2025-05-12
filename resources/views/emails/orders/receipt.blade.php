<!-- resources/views/emails/orders/receipt.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        h1 {
            color: #113559;
        }
        .order-details {
            margin-bottom: 30px;
        }
        .order-details div {
            margin-bottom: 10px;
        }
        .button {
            display: inline-block;
            background-color: #f6c648;
            color: #232323;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #666;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ asset('images/logo.png') }}" alt="Makombero Branding" class="logo">
    <h1>Thank You for Your Order!</h1>
</div>

<p>Dear {{ $order->first_name }} {{ $order->last_name }},</p>

<p>We're pleased to confirm that your order has been received and is being processed. Your order details are below:</p>

<div class="order-details">
    <div><strong>Order Number:</strong> {{ $order->order_number }}</div>
    <div><strong>Order Date:</strong> {{ $order->created_at->format('d F, Y') }}</div>
    <div><strong>Order Status:</strong> {{ ucfirst($order->status) }}</div>
    <div><strong>Payment Method:</strong> {{ $order->payment_method_label }}</div>
    <div><strong>Order Total:</strong> ZWL ${{ number_format($order->total, 2) }}</div>
</div>

<p>Please find your invoice attached to this email. If you have any questions or need assistance, please don't hesitate to contact our customer service team.</p>

<p>
    <a href="{{ route('order.track', $order) }}" class="button">Track Your Order</a>
</p>

<p>Thank you for shopping with us!</p>

<p>
    Best regards,<br>
    The Makombero Branding Team
</p>

<div class="footer">
    <p>Makombero Branding, 123 Brand Street, Harare, Zimbabwe</p>
    <p>Phone: +263 77 123 4567 | Email: info@makomberobranding.co.zw</p>
    <p>&copy; {{ date('Y') }} Makombero Branding. All rights reserved.</p>
</div>
</body>
</html>
