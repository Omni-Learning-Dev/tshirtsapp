@extends('layouts.app')

@section('content')
    <section id="Section-3" class="section-3">
        <img src="{{ asset('images/black-3d-vest-PNG.png') }}"
             loading="lazy"
             sizes="(max-width: 900px) 100vw, 900px"
             srcset="{{ asset('images/black-3d-vest-PNG-p-500.png') }} 500w, {{ asset('images/black-3d-vest-PNG-p-800.png') }} 800w, {{ asset('images/black-3d-vest-PNG.png') }} 900w"
             alt=""
             class="vest-product">
        <div class="gradient-strip"></div>
        <div class="form-border">
            <h1 class="heading-4">PUFFER VESTS</h1>

            <div class="form-block w-form">
                <form action="{{ route('vest.order') }}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf

                    @if (session()->has('message'))
                        <div class="success-message w-form-done" style="display: block;">
                            <div>{{ session('message') }}</div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="error-message w-form-fail" style="display: block;">
                            <div>Oops! Something went wrong while submitting the form.</div>
                        </div>
                    @endif

                    <!-- Row 1: Name and Email -->
                    <div class="form-row">
                        <div class="form-col">
                            <label for="name">Name</label>
                            <input class="w-input" maxlength="256" name="name" type="text" id="name" value="{{ old('name') }}">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-col">
                            <label for="email">Email Address</label>
                            <input class="w-input" maxlength="256" name="email" type="email" id="email" required value="{{ old('email') }}">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 2: Quantity and Size -->
                    <div class="form-row">
                        <div class="form-col">
                            <label for="quantity">Quantity</label>
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn" onclick="decrementQuantity()">-</button>
                                <input class="w-input quantity-input" name="quantity" type="number" id="quantity" min="1" value="{{ old('quantity', 1) }}">
                                <button type="button" class="quantity-btn" onclick="incrementQuantity()">+</button>
                            </div>
                            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-col">
                            <label for="size">Size</label>
                            <select class="w-select" name="size" id="size">
                                <option value="XS" {{ old('size') == 'XS' ? 'selected' : '' }}>Extra Small (XS)</option>
                                <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>Small (S)</option>
                                <option value="M" {{ old('size') == 'M' ? 'selected' : '' }} selected>Medium (M)</option>
                                <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>Large (L)</option>
                                <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>Extra Large (XL)</option>
                                <option value="XXL" {{ old('size') == 'XXL' ? 'selected' : '' }}>Extra Extra Large (XXL)</option>
                            </select>
                            @error('size') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Color Field -->
                    <label>Color</label>
                    <div class="color-selector">
                        <label class="color-option">
                            <input type="radio" name="color" value="Black" class="color-radio" {{ old('color', 'Black') == 'Black' ? 'checked' : '' }}>
                            <span class="color-swatch" style="background-color: black;"></span>
                            <span class="color-name">Black</span>
                        </label>
                        <label class="color-option">
                            <input type="radio" name="color" value="Navy" class="color-radio" {{ old('color') == 'Navy' ? 'checked' : '' }}>
                            <span class="color-swatch" style="background-color: navy;"></span>
                            <span class="color-name">Navy</span>
                        </label>
                        <label class="color-option">
                            <input type="radio" name="color" value="Red" class="color-radio" {{ old('color') == 'Red' ? 'checked' : '' }}>
                            <span class="color-swatch" style="background-color: red;"></span>
                            <span class="color-name">Red</span>
                        </label>
                    </div>
                    @error('color') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Customization Toggle -->
                    <div class="customization-toggle">
                        <label for="customization" class="w-checkbox">
                            <input type="checkbox" name="customization" id="customization" class="w-checkbox-input" {{ old('customization') ? 'checked' : '' }} onchange="toggleLogoUpload()">
                            <span class="w-checkbox-label">Add Custom Logo/Branding</span>
                        </label>
                    </div>

                    <!-- Logo Upload (Hidden by default, shown by JavaScript) -->
                    <div id="logo-upload" class="logo-upload" style="display: {{ old('customization') ? 'block' : 'none' }};">
                        <label for="logo">Upload Your Logo</label>
                        <input type="file" name="logo" id="logo" class="w-input">
                        @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Additional Notes -->
                    <label for="notes">Additional Notes</label>
                    <textarea name="notes" id="notes" class="w-input" rows="3" placeholder="Any special instructions or requirements...">{{ old('notes') }}</textarea>
                    @error('notes') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Submit Button -->
                    <input type="submit" class="w-button" value="Order Now">
                </form>
            </div>
        </div>
    </section>

    <!-- Simple JavaScript for form interactions -->
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
    </script>

    <style>
        /* Simple row-based grid layout */
        .form-row {
            display: flex;
            margin-bottom: 15px;
            gap: 20px;
        }

        .form-col {
            flex: 1;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
@endsection
