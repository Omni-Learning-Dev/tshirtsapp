@extends('layouts.app')

@section('content')
    <section id="Section-3" class="section-3">
        <img src="{{ asset('images/black-cap-PNG.png') }}"
             loading="lazy"
             sizes="(max-width: 1920px) 100vw, 1920px"
             srcset="{{ asset('images/black-cap-PNG-p-500.png') }} 500w, {{ asset('images/black-cap-PNG-p-800.png') }} 800w, {{ asset('images/black-cap-PNG-p-1080.png') }} 1080w, {{ asset('images/black-cap-PNG-p-1600.png') }} 1600w, {{ asset('images/black-cap-PNG.png') }} 1920w"
             alt=""
             class="cap-product"
        >

        <div class="gradient-strip"></div>
        <div class="form-border">
            <h1 class="heading-4">CUSTOM CAPS</h1>

            <div class="form-block w-form">
                <form action="{{ route('cap.order') }}" method="POST" enctype="multipart/form-data" class="form">
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

                    <!-- Grid Layout for Form -->
                    <div class="form-grid">
                        <!-- Column 1 -->
                        <div class="form-column">
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="w-input" maxlength="256" name="name" type="text" id="name" value="{{ old('name') }}">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input class="w-input" maxlength="256" name="email" type="email" id="email" required value="{{ old('email') }}">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Column 2 -->
                        <div class="form-column">
                            <!-- Quantity Field -->
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <div class="quantity-selector">
                                    <button type="button" class="quantity-btn" onclick="decrementQuantity()">-</button>
                                    <input class="w-input quantity-input" name="quantity" type="number" id="quantity" min="1" value="{{ old('quantity', 1) }}">
                                    <button type="button" class="quantity-btn" onclick="incrementQuantity()">+</button>
                                </div>
                                @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>


                        </div>
                    </div>

                    <!-- Full Width Elements -->
                    <div class="form-full-width">
                        <!-- Grid for Embroidery Options and Customization -->
                        <div class="form-grid">
                            <div class="form-column">
                                <!-- Embroidery Location Field -->
                                <div class="form-group">
                                    <label>Embroidery Location</label>
                                    <div class="embroidery-location-selector">
                                        <label class="embroidery-option">
                                            <input type="radio" name="embroidery_location" value="Front" class="embroidery-radio" {{ old('embroidery_location', 'Front') == 'Front' ? 'checked' : '' }}>
                                            <span class="embroidery-name">Front</span>
                                        </label>
                                        <label class="embroidery-option">
                                            <input type="radio" name="embroidery_location" value="Side" class="embroidery-radio" {{ old('embroidery_location') == 'Side' ? 'checked' : '' }}>
                                            <span class="embroidery-name">Side</span>
                                        </label>
                                        <label class="embroidery-option">
                                            <input type="radio" name="embroidery_location" value="Back" class="embroidery-radio" {{ old('embroidery_location') == 'Back' ? 'checked' : '' }}>
                                            <span class="embroidery-name">Back</span>
                                        </label>
                                    </div>
                                    @error('embroidery_location') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-column">
                                <!-- Customization Toggle -->
                                <div class="form-group">
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
                                        <p class="upload-hint">Recommended: High resolution PNG or vector files</p>
                                        @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div class="form-group">
                            <label for="notes">Additional Notes</label>
                            <textarea name="notes" id="notes" class="w-input" rows="3" placeholder="Any special embroidery instructions or requirements...">{{ old('notes') }}</textarea>
                            @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <input type="submit" class="w-button" value="Order Caps">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- CSS for Grid Layout -->
    <style>
        /* Product image styling - updated based on Webflow design */
        .section-3 {
            position: relative;
            padding-top: 30px;
        }

        .cap-product {
            position: absolute;
            bottom: 30%;
            left: 0;
            z-index: 1;
            max-width: 45%;
            height: auto;
            object-fit: contain;
        }

        .form-border {
            position: relative;
            z-index: 0;
            margin-left: 45%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
        }

        .heading-4 {
            font-family: 'Bebas Neue', sans-serif;
            margin-bottom: 25px;
        }

        /* Grid layout */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-column {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-full-width {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .cap-product {
                position: relative;
                max-width: 100%;
                margin-bottom: 20px;
            }

            .form-border {
                margin-left: 0;
                padding: 15px;
            }
        }

        /* Improve embroidery location selector layout */
        .embroidery-location-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 5px;
        }

        /* Styling for option containers */
        .embroidery-option {
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        /* Upload hint */
        .upload-hint {
            font-size: 0.85em;
            color: #666;
            margin-top: 5px;
        }

        /* Form inputs styling */
        .w-input, .w-select {
            height: 38px;
            padding: 8px 12px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea.w-input {
            min-height: 100px;
        }

        /* Submit button styling */
        .w-button {
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        .w-button:hover {
            background-color: #333;
        }

        /* Quantity selector */
        .quantity-selector {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #e0e0e0;
            background: #f5f5f5;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-input {
            width: 60px !important;
            text-align: center;
            margin: 0 5px;
        }
    </style>

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
