@extends('layouts.app')

@section('content')
    <section id="Section-3" class="section-3">
        <img src="{{ asset('images/Black-Tshirt-small_00000.png') }}"
             loading="lazy"
             alt=""
             class="tshirt-product">
        <div class="gradient-strip"></div>
        <div class="form-border">
            <h1 class="heading-4">T-SHIRTS</h1>

            <div class="form-block w-form">
                <form action="{{ route('tshirt.order') }}" method="POST" enctype="multipart/form-data" class="form">
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

                        <!-- Column 2 -->
                        <div class="form-column">
                            <!-- Style Field -->
                            <div class="form-group">
                                <label for="style">Style</label>
                                <select class="w-select" name="style" id="style">
                                    <option value="Crew" {{ old('style') == 'Crew' ? 'selected' : '' }} selected>Crew Neck</option>
                                    <option value="V-Neck" {{ old('style') == 'V-Neck' ? 'selected' : '' }}>V-Neck</option>
                                    <option value="Polo" {{ old('style') == 'Polo' ? 'selected' : '' }}>Polo</option>
                                    <option value="Henley" {{ old('style') == 'Henley' ? 'selected' : '' }}>Henley</option>
                                </select>
                                @error('style') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Size Field -->
                            <div class="form-group">
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

                            <!-- Material Field -->
                            <div class="form-group">
                                <label for="material">Material</label>
                                <select class="w-select" name="material" id="material">
                                    <option value="Cotton" {{ old('material') == 'Cotton' ? 'selected' : '' }} selected>100% Cotton</option>
                                    <option value="Blend" {{ old('material') == 'Blend' ? 'selected' : '' }}>Cotton Blend</option>
                                    <option value="Performance" {{ old('material') == 'Performance' ? 'selected' : '' }}>Performance Fabric</option>
                                    <option value="Organic" {{ old('material') == 'Organic' ? 'selected' : '' }}>Organic Cotton</option>
                                </select>
                                @error('material') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Full Width Elements -->
                    <div class="form-full-width">
                        <!-- Color Field -->
                        <div class="form-group">
                            <label>Color</label>
                            <div class="color-selector">
                                <label class="color-option">
                                    <input type="radio" name="color" value="White" class="color-radio" {{ old('color', 'White') == 'White' ? 'checked' : '' }}>
                                    <span class="color-swatch" style="background-color: white; border: 1px solid #ccc;"></span>
                                    <span class="color-name">White</span>
                                </label>
                                <label class="color-option">
                                    <input type="radio" name="color" value="Black" class="color-radio" {{ old('color') == 'Black' ? 'checked' : '' }}>
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
                                <label class="color-option">
                                    <input type="radio" name="color" value="Gray" class="color-radio" {{ old('color') == 'Gray' ? 'checked' : '' }}>
                                    <span class="color-swatch" style="background-color: gray;"></span>
                                    <span class="color-name">Gray</span>
                                </label>
                            </div>
                            @error('color') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Grid for Print Location and Customization -->
                        <div class="form-grid">
                            <div class="form-column">
                                <!-- Printing Location Field -->
                                <div class="form-group">
                                    <label>Printing Location</label>
                                    <div class="print-location-selector">
                                        <label class="print-option">
                                            <input type="radio" name="print_location" value="Front" class="print-radio" {{ old('print_location', 'Front') == 'Front' ? 'checked' : '' }}>
                                            <span class="print-name">Front</span>
                                        </label>
                                        <label class="print-option">
                                            <input type="radio" name="print_location" value="Back" class="print-radio" {{ old('print_location') == 'Back' ? 'checked' : '' }}>
                                            <span class="print-name">Back</span>
                                        </label>
                                        <label class="print-option">
                                            <input type="radio" name="print_location" value="Both" class="print-radio" {{ old('print_location') == 'Both' ? 'checked' : '' }}>
                                            <span class="print-name">Both Front & Back</span>
                                        </label>
                                        <label class="print-option">
                                            <input type="radio" name="print_location" value="Sleeve" class="print-radio" {{ old('print_location') == 'Sleeve' ? 'checked' : '' }}>
                                            <span class="print-name">Sleeve</span>
                                        </label>
                                    </div>
                                    @error('print_location') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-column">
                                <!-- Customization Toggle -->
                                <div class="form-group">
                                    <div class="customization-toggle">
                                        <label for="customization" class="w-checkbox">
                                            <input type="checkbox" name="customization" id="customization" class="w-checkbox-input" {{ old('customization') ? 'checked' : '' }} onchange="toggleLogoUpload()">
                                            <span class="w-checkbox-label">Add Custom Logo/Design</span>
                                        </label>
                                    </div>

                                    <!-- Logo Upload (Hidden by default, shown by JavaScript) -->
                                    <div id="logo-upload" class="logo-upload" style="display: {{ old('customization') ? 'block' : 'none' }};">
                                        <label for="logo">Upload Your Design</label>
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
                            <textarea name="notes" id="notes" class="w-input" rows="3" placeholder="Any special printing instructions or requirements...">{{ old('notes') }}</textarea>
                            @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <input type="submit" class="w-button" value="Order T-Shirts">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- CSS for Grid Layout -->
    <style>
        /* Product image styling */
        .section-3 {
            position: relative;
        }

        .tshirt-product {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            max-width: 40%;
            height: auto;
        }

        .form-border {
            position: relative;
            z-index: 0;
            margin-left: 35%;
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
            margin-bottom: 10px;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .tshirt-product {
                position: relative;
                max-width: 100%;
                margin-bottom: 20px;
            }

            .form-border {
                margin-left: 0;
            }
        }

        /* Improve color selector layout */
        .color-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* Improve print location selector layout */
        .print-location-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
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
