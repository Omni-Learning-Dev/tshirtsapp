@extends('layouts.app')

@section('content')
    <section id="Section-3" class="section-3">
        @if($product->images->where('is_primary', true)->first())
            <img src="{{ asset('storage/' . $product->images->where('is_primary', true)->first()->image_path) }}"
                 loading="lazy"
                 alt="{{ $product->product_name }}"
                 class="vest-product"
            >
        @else
            <img src="{{ asset('images/black-3d-vest-PNG.png') }}"
                 loading="lazy"
                 alt="{{ $product->product_name }}"
                 class="vest-product"
            >
        @endif
        <div class="gradient-strip"></div>
        <div class="form-border">
            <div class="product-header">
                <h1 class="heading-4">
                    {{ $product->product_name }}
                </h1>

                @if($cartCount > 0)
                    <a href="{{ route('cart') }}" class="view-cart-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        View Cart ({{ $cartCount }})
                    </a>
                @endif
            </div>

            <div class="price-display">${{ number_format($product->price, 2) }}</div>
            <hr>

            <div class="form-block  ">
                <form class="esform"   action="{{ route('shop.add-to-cart') }}" method="POST"   enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="color" id="selected-color-input" value="">
                    <input type="hidden" name="size" id="selected-size-input" value="">

                    <!-- Color Selection -->

                    <div class="optionsbox"  >
                        <div class="option-section" >
                            <div class="option-label">Colors:</div>
                            <div class="color-options">
                                @php
                                    // Map color names to hex codes for better display
                                    $colorMap = [
                                        'White' => '#FFFFFF',
                                        'Black' => '#000000',
                                        'Navy' => '#000080',
                                        'Red' => '#FF0000',
                                        'Green' => '#008000',
                                        'Yellow' => '#FFFF00',
                                        'Blue' => '#0000FF',
                                        'Grey' => '#808080',
                                        'Khaki' => '#F0E68C',
                                        'Maroon' => '#800000',
                                        'Forest Green' => '#228B22',
                                        'Sky Blue' => '#87CEEB',
                                        'Lime Green' => '#32CD32',
                                        'Orange' => '#FFA500',
                                        'Teal' => '#008080',
                                        'Light Blue' => '#ADD8E6',
                                    ];
                                @endphp

                                @foreach($product->colors as $color)
                                    <div class="color-option {{ strtolower($color) }}"
                                         data-color="{{ $color }}"
                                         style="background-color: {{ $colorMap[$color] ?? $color }};"
                                         onclick="selectColor('{{ $color }}', this)">
                                        @if($color == 'White')
                                            <div class="white-border"></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Size Selection -->
                        <div class="option-section">
                            <div class="option-label">Size:</div>
                            <div class="size-options">
                                @foreach($product->sizes as $size)
                                    <div class="size-option" data-size="{{ $size }}" onclick="selectSize('{{ $size }}', this)">
                                        {{ $size }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="branding-section">
                        <div class="branding-toggle">
                            <input type="checkbox" name="customization" id="customization" onchange="toggleLogoUpload()" class="branding-checkbox">
                            <label for="customization" class="branding-label">Add custom branding/logo</label>
                        </div>

                        <div id="logo-upload" style="display: none;" class="logo-upload-container">
                            <input type="file" name="logo" id="logo" accept="image/*" class="logo-file-input">
                            <textarea name="branding_instructions" class="branding-instructions" placeholder="Branding instructions (placement, size, etc.)"></textarea>
                        </div>
                    </div>

                    <!-- Action Row (Add to Cart, Quantity, Wishlist) -->
                    <div class="action-row">
                        <div class="quantity-control">
                            <button type="button" onclick="decrementQuantity()" class="quantity-btn minus">-</button>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" class="quantity-input" required>
                            <button type="button" onclick="incrementQuantity()" class="quantity-btn plus">+</button>
                        </div>

                        <button type="submit" class="add-to-cart-btn">Add to Order</button>
                    </div>
                </form>
            </div>

            <!-- Product image gallery - small row of thumbnails -->
            @if($product->images->count() > 1)
                <div class="product-thumbnails">
                    @foreach($product->images as $image)
                        <div class="thumbnail-item">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                 alt="{{ $product->product_name }}"
                                 class="thumbnail-image"
                                 onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')"
                            >
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- JavaScript for form interactions -->
    <script>
        // Function to increment quantity
        function incrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        // Function to decrement quantity
        function decrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }

        // Function to toggle logo upload visibility
        function toggleLogoUpload() {
            const customizationCheckbox = document.getElementById('customization');
            const logoUploadDiv = document.getElementById('logo-upload');

            logoUploadDiv.style.display = customizationCheckbox.checked ? 'block' : 'none';
        }

        // Function to change the main product image
        function changeMainImage(imageUrl) {
            const mainImage = document.querySelector('.vest-product');
            mainImage.src = imageUrl;
        }

        // Function to select color
        function selectColor(colorName, element) {
            // Remove active class from all color options
            document.querySelectorAll('.color-option').forEach(option => {
                option.classList.remove('active');
            });

            // Add active class to selected color
            element.classList.add('active');

            // Update hidden input
            document.getElementById('selected-color-input').value = colorName;
        }

        // Function to select size
        function selectSize(sizeName, element) {
            // Remove active class from all size options
            document.querySelectorAll('.size-option').forEach(option => {
                option.classList.remove('active');
            });

            // Add active class to selected size
            element.classList.add('active');

            // Update hidden input
            document.getElementById('selected-size-input').value = sizeName;
        }

        // Initialize form
        document.addEventListener('DOMContentLoaded', function() {
            // Select first color and size by default
            const firstColor = document.querySelector('.color-option');
            const firstSize = document.querySelector('.size-option');

            if (firstColor) {
                selectColor(firstColor.dataset.color, firstColor);
            }

            if (firstSize) {
                selectSize(firstSize.dataset.size, firstSize);
            }
        });
    </script>

    <style>
        /* Product view styles */
        .form-border {
            padding: 30px 40px;
            overflow-y: auto;
            min-width: 550px;
        }

        /* Product header with cart button */
        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .view-cart-btn {
            display: inline-flex;
            align-items: center;
            background-color: #f6c648;
            color: #232323;
            padding: 8px 15px;
            border-radius: 50px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .view-cart-btn:hover {
            background-color: #023459;
            color: #fff;
        }

        .view-cart-btn svg {
            margin-right: 8px;
        }

        .heading-4 {
            margin-bottom: 0;
            color: #023459;
            font-size: 24px;
            text-transform: uppercase;
        }

        .price-display {
            font-size: 20px;
            font-weight: bold;
            color: #023459;
            margin-bottom: 15px;
        }

        .product-description-short {
            margin-bottom: 25px;
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }

        /* Options layout */
        .option-section {
            margin-bottom: 20px;
        }

        .option-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            font-size: 16px;
        }

        /* Color selection */
        .color-options {
            display: flex;
            gap: 12px;
            margin-bottom: 5px;
        }

        .color-option {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.2s;
            position: relative;
        }

        .color-option:hover {
            transform: scale(1.1);
        }

        .color-option.active {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        .color-option.white {
            background-color: #fff;
        }

        .white-border {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            border: 1px solid #ddd;
        }

        /* Size selection */
        .size-options {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .size-option {
            min-width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #fff;
            font-size: 14px;
        }

        .size-option:hover {
            background-color: #f5f5f5;
        }

        .size-option.active {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        /* Action row styling */
        .action-row {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Quantity controls */
        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            height: 38px;
            font-size: 16px;
        }

        .quantity-input:focus {
            outline: none;
        }

        .quantity-btn {
            width: 38px;
            height: 38px;
            background-color: #f5f5f5;
            border: none;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background-color: #e5e5e5;
        }

        /* Add to cart button */
        .add-to-cart-btn {
            flex: 1;
            height: 40px;
            background-color: #3b82f6; /* Blue color */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .add-to-cart-btn:hover {
            background-color: #2563eb;
        }


        /* Branding section */
        .branding-section {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .branding-toggle {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .branding-checkbox {
            margin-right: 10px;
        }

        .branding-label {
            font-size: 14px;
            color: #333;
        }

        .logo-upload-container {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .logo-file-input {
            margin-bottom: 10px;
            width: 100%;
        }

        .branding-instructions {
            width: 100%;
            height: 60px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            resize: none;
        }

        /* Thumbnails */
        .product-thumbnails {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .thumbnail-item {
            flex: 0 0 60px;
            height: 60px;
            cursor: pointer;
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .thumbnail-image:hover {
            border-color: #3b82f6;
        }

        @media (max-width: 768px) {
            .form-border {
                padding: 20px;
            }

            .product-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .view-cart-btn {
                align-self: flex-end;
            }

            .action-row {
                flex-wrap: wrap;
            }

            .quantity-control {
                width: 120px;
            }

            .add-to-cart-btn {
                order: 3;
                flex: 1 0 100%;
                margin-top: 10px;
            }
        }

        @media (max-width: 479px) {
            .form-border {
                padding:unset !important;
                min-width:90vw !important;
                height: unset !important;
            }

            .product-header {
                padding: 0 15px;
                margin-top: 10px;
            }

            .heading-4 {
                font-size: 25px !important;
                margin-top: 10px !important;
            }

            .esform{
                width:100% !important;
                padding: 0 15px;
            }

            .optionsbox{
                display: flex;
                flex-direction: column;
                align-content: center;
                justify-content: space-between
            }

            .quantity-control{
                width: 100% !important;
            }

            .quantity-btn {
                width: 33% !important;
            }

            .quantity-input{
                width: 33% !important;
            }
        }
    </style>
@endsection
