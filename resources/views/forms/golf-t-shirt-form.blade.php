@extends('layouts.app')

@section('content')
    <section id="Section-3" class="section-3">
        <img src="{{ asset('images/Golf-T-shirt_00000.png') }}"
             loading="lazy"
             sizes="(max-width: 1000px) 100vw, 1000px"
             srcset="{{ asset('images/Golf-T-shirt_00000-p-500.png') }} 500w, {{ asset('images/Golf-T-shirt_00000-p-800.png') }} 800w, {{ asset('images/Golf-T-shirt_00000.png') }} 1000w"
             alt=""
             class="image-21">
        <div class="gradient-strip"></div>
        <div class="form-border">
            <h1 class="heading-4">GOLF T-SHIRTS</h1>
            <div class="form-block w-form">
                <form id="email-form" action="{{ route('golf-tshirt.order') }}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    <label for="name">Name</label>
                    <input class="w-input" maxlength="256" name="name" type="text" id="name">

                    <label for="email">Email Address</label>
                    <input class="w-input" maxlength="256" name="email" type="email" id="email" required>

                    <label for="size">Size</label>
                    <select class="w-select" name="size" id="size">
                        <option value="S">Small (S)</option>
                        <option value="M" selected>Medium (M)</option>
                        <option value="L">Large (L)</option>
                        <option value="XL">Extra Large (XL)</option>
                    </select>

                    <label for="color">Color</label>
                    <select class="w-select" name="color" id="color">
                        <option value="Black" selected>Black</option>
                        <option value="White">White</option>
                        <option value="Navy">Navy</option>
                        <option value="Green">Green</option>
                    </select>

                    <label for="customization">Add Customization</label>
                    <select class="w-select" name="customization_type" id="customization_type" onchange="toggleCustomFields()">
                        <option value="None" selected>No Customization</option>
                        <option value="Text">Custom Text</option>
                        <option value="Logo">Custom Logo</option>
                    </select>

                    <div id="text-customization" style="display: none;">
                        <label for="custom_text">Your Custom Text</label>
                        <input class="w-input" maxlength="256" name="custom_text" type="text" id="custom_text">
                    </div>

                    <div id="logo-customization" style="display: none;">
                        <label for="logo">Upload Logo</label>
                        <input class="w-input" name="logo" type="file" id="logo">
                    </div>

                    <input type="submit" class="w-button" value="Order Now">
                </form>
                <div class="w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="w-form-fail">
                    <div>Oops! Something went wrong while submitting the form.</div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleCustomFields() {
            const customType = document.getElementById('customization_type').value;
            const textField = document.getElementById('text-customization');
            const logoField = document.getElementById('logo-customization');

            textField.style.display = 'none';
            logoField.style.display = 'none';

            if (customType === 'Text') {
                textField.style.display = 'block';
            } else if (customType === 'Logo') {
                logoField.style.display = 'block';
            }
        }
    </script>
@endsection
