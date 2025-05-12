@extends('layouts.app')

@section('content')
    <!-- Products Grid -->
    <div class="shop-products">
        @foreach($products->chunk(4) as $productRow)
            <section class="section-4">
                @foreach($productRow as $product)
                    <div class="item-1">
                        <a href="{{ route('view.product', $product->slug) }}" class="product-link">
                            <div class="text-8-copy">{{ strtoupper($product->product_name) }}</div>
                            <div class="small-text">{{ Str::limit($product->description, 80) }}</div>
                            <div class="product-price">${{ number_format($product->price, 2) }}</div>
                            <img src="{{ $product->image_url }}"
                                 loading="lazy"
                                 alt="{{ $product->product_name }}"
                                 class="product-image">
                        </a>
                    </div>
                @endforeach

                {{-- Fill the row with empty items if needed --}}
                @for($i = count($productRow); $i < 4; $i++)
                    <div class="item-1 empty-item"></div>
                @endfor
            </section>
        @endforeach
    </div>

    {{-- Show message if no products found --}}
    @if($products->isEmpty())
        <div class="no-products">
            <p>No products available at the moment. Please check back soon!</p>
        </div>
    @endif

    <style>
        .shop-products {
            padding: 40px 0;
        }

        .product-link {
            text-decoration: none;
            display: block;
            height: 100%;
        }

        .product-image {
            width: auto;
            max-width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .item-1:hover .product-image {
            transform: scale(1.05);
        }

        .product-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: #f6c648;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .empty-item {
            visibility: hidden;
        }

        .no-products {
            text-align: center;
            padding: 50px 0;
            color: #666;
            font-size: 18px;
        }

        /* Keep your existing styles as well */
    </style>
@endsection