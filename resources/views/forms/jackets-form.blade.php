@extends('layouts.app')

@section('content')
    <section id="Section-3" class="section-3">
        <img src="{{ asset('images/black-jacket.png') }}"
             loading="lazy"
             width="407"
             sizes="(max-width: 479px) 100vw, 407px"
             srcset="{{ asset('images/black-jacket-p-500.png') }} 500w, {{ asset('images/black-jacket-p-800.png') }} 800w, {{ asset('images/black-jacket-p-1080.png') }} 1080w, {{ asset('images/black-jacket-p-1600.png') }} 1600w, {{ asset('images/black-jacket.png') }} 1920w"
             alt=""
             class="jacket-product">
        <div class="gradient-strip"></div>
        <div class="form-border">
            <h1 class="heading-4">CUSTOM JACKETS</h1>

            <div class="form-block w-form">
                <form action="{{ route('jacket.order') }}" method="POST" enctype="multipart/form-data" class="form">
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

                    <!-- Name Field -->
                    <label for="name">Name</label>
                    <input class="w-input" maxlength="256" name="name" type="text" id="name" value="{{ old('name') }}">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Email Field -->
                    <label for="email">Email Address</label>
                    <input class="w-input" maxlength="256" name="email" type="email" id="email" required value="{{ old('email') }}">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Quantity Field -->
                    <label for="quantity">Quantity</label>
                    <div class="quantity-selector">
                        <button type="button" class="quantity-btn" onclick="decrementQuantity()">-</button>
                        <input class="w-input quantity-input" name="quantity" type="number" id="quantity" min="1" value="{{ old('quantity', 1) }}">
                        <button type="button" class="quantity-btn" onclick="incrementQuantity()">+</button>
                    </div>
                    @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Size Field -->
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
                            <input type="radio" name="color" value="Gray" class="color-radio" {{ old('color') == 'Gray' ? 'checked' : '' }}>
                            <span class="color-swatch" style="background-color: #888;"></span>
                            <span class="color-name">Gray</span>
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
@endsection
