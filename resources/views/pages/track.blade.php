<!-- resources/views/orders/track.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Order - {{ $order->order_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
<div class="max-w-5xl mx-auto py-10 px-4">
    <div class="mb-8 text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Makombero Branding" class="h-16 mx-auto mb-4">
        <h1 class="text-3xl font-bold text-gray-800">Order Tracking</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Order #{{ $order->order_number }}</h2>
            <div class="inline-flex px-3 py-1 rounded-full text-sm font-medium
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800 @endif">
                {{ ucfirst($order->status) }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <h3 class="text-gray-500 font-medium mb-2">Order Date</h3>
                <p>{{ $order->created_at->format('F d, Y') }}</p>
            </div>
            <div>
                <h3 class="text-gray-500 font-medium mb-2">Total Amount</h3>
                <p>ZWL ${{ number_format($order->total, 2) }}</p>
            </div>
            <div>
                <h3 class="text-gray-500 font-medium mb-2">Payment Method</h3>
                <p>{{ $order->payment_method_label }}</p>
            </div>
        </div>

        <div class="relative mb-8">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="px-3 bg-white text-lg font-medium text-gray-900">Shipping Progress</span>
            </div>
        </div>

        <div class="mb-8">
            <div class="relative">
                <!-- Progress bar -->
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                    <div style="width:
                            @if($order->status === 'pending') 25%
                            @elseif($order->status === 'processing') 50%
                            @elseif($order->status === 'completed') 100%
                            @else 0% @endif"
                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                    </div>
                </div>

                <!-- Progress steps -->
                <div class="flex justify-between">
                    <div class="text-center">
                        <div class="
                                @if(in_array($order->status, ['pending', 'processing', 'completed']))
                                    bg-blue-500 text-white
                                @else
                                    bg-gray-200 text-gray-500
                                @endif
                                rounded-full w-8 h-8 flex items-center justify-center mb-2 mx-auto">
                            1
                        </div>
                        <div class="text-sm">Order Placed</div>
                    </div>
                    <div class="text-center">
                        <div class="
                                @if(in_array($order->status, ['processing', 'completed']))
                                    bg-blue-500 text-white
                                @else
                                    bg-gray-200 text-gray-500
                                @endif
                                rounded-full w-8 h-8 flex items-center justify-center mb-2 mx-auto">
                            2
                        </div>
                        <div class="text-sm">Processing</div>
                    </div>
                    <div class="text-center">
                        <div class="
                                @if($order->status === 'completed')
                                    bg-blue-500 text-white
                                @else
                                    bg-gray-200 text-gray-500
                                @endif
                                rounded-full w-8 h-8 flex items-center justify-center mb-2 mx-auto">
                            3
                        </div>
                        <div class="text-sm">Completed</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Order Items</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                @if($item->options)
                                    <div class="text-sm text-gray-500">
                                        @foreach($item->options as $key => $value)
                                            <span>{{ ucfirst($key) }}: {{ $value }}</span><br>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ZWL ${{ number_format($item->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ZWL ${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4">Shipping Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-gray-500 font-medium mb-2">Contact Information</h4>
                <p class="mb-1">{{ $order->first_name }} {{ $order->last_name }}</p>
                <p class="mb-1">{{ $order->email }}</p>
                <p>{{ $order->phone }}</p>
            </div>
            <div>
                <h4 class="text-gray-500 font-medium mb-2">Shipping Address</h4>
                <p class="mb-1">{{ $order->address }}</p>
                <p class="mb-1">{{ $order->city }}, {{ $order->postal_code }}</p>
                <p>{{ $order->country }}</p>
            </div>
        </div>

        @if($order->special_instructions)
            <div class="mt-6">
                <h4 class="text-gray-500 font-medium mb-2">Special Instructions</h4>
                <p class="text-gray-700">{{ $order->special_instructions }}</p>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('invoice.download', $order) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                </svg>
                Download Invoice
            </a>
        </div>
    </div>
</div>
</body>
</html>
