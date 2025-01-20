<!DOCTYPE html>
<html>
<head>
    <title>Your Order Details</title>
</head>
<body>
<h1>Thank you for your order!</h1>

<p>Here are the details of your order:</p>

<ul>
    <li><strong>Order ID:</strong> {{ $order->id }}</li>
    <li><strong>Quantity:</strong> {{ $order->quantity }}</li>
    <li><strong>Size:</strong> {{ $order->size }}</li>
    <li><strong>Gender:</strong> {{ $order->gender }}</li>
    @if($order->front_text)
        <li><strong>Front Text:</strong> {{ $order->front_text }}</li>
    @endif
    @if($order->back_text)
        <li><strong>Back Text:</strong> {{ $order->back_text }}</li>
    @endif
</ul>

@if($order->logo_image)
    <p><strong>Uploaded Logo:</strong></p>
    <img src="{{ asset('storage/' . $order->logo_image) }}" alt="Logo" style="max-width: 200px;">
@endif

<p>We will notify you when your order is processed.</p>
</body>
</html>
