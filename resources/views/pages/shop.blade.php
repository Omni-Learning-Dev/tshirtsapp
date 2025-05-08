@extends('layouts.app')

@section('content')
    <!-- First Row of Products -->
    <section class="section-4">
        <!-- Puffer Vest -->
        <div class="item-1">
            <div class="text-8-copy">PUFFER VEST</div>
            <div class="small-text">Place an order for CK branding
                anywhere, anytime and your order
                will arrive within the stated time</div>
            <img src="{{ asset('images/black-3d-vest-PNG.png') }}"
                 loading="lazy"
                 sizes="(max-width: 900px) 100vw, 900px"
                 srcset="{{ asset('images/black-3d-vest-PNG-p-500.png') }} 500w, {{ asset('images/black-3d-vest-PNG-p-800.png') }} 800w, {{ asset('images/black-3d-vest-PNG.png') }} 900w"
                 alt=""
                 class="image-22">
        </div>

        <!-- T-shirt -->
        <div class="item-1">
            <div class="text-8-copy">T-shirt</div>
            <div class="small-text">Place an order for CK branding
                anywhere, anytime and your order
                will arrive within the stated time</div>
            <img src="{{ asset('images/Black-Tshirt-small_00000.png') }}"
                 loading="lazy"
                 sizes="(max-width: 1000px) 100vw, 1000px"
                 srcset="{{ asset('images/Black-Tshirt-small_00000-p-500.png') }} 500w, {{ asset('images/Black-Tshirt-small_00000-p-800.png') }} 800w, {{ asset('images/Black-Tshirt-small_00000.png') }} 1000w"
                 alt=""
                 class="image-23">
        </div>

        <!-- Golf T-shirt -->
        <div class="item-1">
            <div class="text-8-copy">Golf T-shirt</div>
            <div class="small-text">Place an order for CK branding
                anywhere, anytime and your order
                will arrive within the stated time</div>
            <img src="{{ asset('images/Golf-T-shirt_00000.png') }}"
                 loading="lazy"
                 sizes="(max-width: 1000px) 100vw, 1000px"
                 srcset="{{ asset('images/Golf-T-shirt_00000-p-500.png') }} 500w, {{ asset('images/Golf-T-shirt_00000-p-800.png') }} 800w, {{ asset('images/Golf-T-shirt_00000.png') }} 1000w"
                 alt=""
                 class="image-23">
        </div>

        <!-- Cap -->
        <div class="item-1">
            <div class="text-8-copy">CAP</div>
            <div class="small-text">Place an order for CK branding
                anywhere, anytime and your order
                will arrive within the stated time</div>
            <img src="{{ asset('images/black-cap-PNG.png') }}"
                 loading="lazy"
                 sizes="(max-width: 1920px) 100vw, 1920px"
                 srcset="{{ asset('images/black-cap-PNG-p-500.png') }} 500w, {{ asset('images/black-cap-PNG-p-800.png') }} 800w, {{ asset('images/black-cap-PNG-p-1080.png') }} 1080w, {{ asset('images/black-cap-PNG-p-1600.png') }} 1600w, {{ asset('images/black-cap-PNG.png') }} 1920w"
                 alt=""
                 class="image-24">
        </div>
    </section>

    <!-- Second Row of Products -->
    <section class="section-4">
        <!-- Jacket -->
        <div class="item-1">
            <div class="text-8-copy">JACKET</div>
            <div class="small-text">Place an order for CK branding
                anywhere, anytime and your order
                will arrive within the stated time</div>
            <img src="{{ asset('images/black-jacket.png') }}"
                 loading="lazy"
                 width="407"
                 sizes="(max-width: 479px) 100vw, 407px"
                 srcset="{{ asset('images/black-jacket-p-500.png') }} 500w, {{ asset('images/black-jacket-p-800.png') }} 800w, {{ asset('images/black-jacket-p-1080.png') }} 1080w, {{ asset('images/black-jacket-p-1600.png') }} 1600w, {{ asset('images/black-jacket.png') }} 1920w"
                 alt=""
                 class="image-25">
        </div>

        <!-- Hoodie -->
        <div class="item-1">
            <div class="text-8-copy">HOODIE</div>
            <div class="small-text">Place an order for CK branding
                anywhere, anytime and your order
                will arrive within the stated time</div>
            <img src="{{ asset('images/Black-Hoodie_00000.png') }}"
                 loading="lazy"
                 sizes="(max-width: 1000px) 100vw, 1000px"
                 srcset="{{ asset('images/Black-Hoodie_00000-p-500.png') }} 500w, {{ asset('images/Black-Hoodie_00000-p-800.png') }} 800w, {{ asset('images/Black-Hoodie_00000.png') }} 1000w"
                 alt=""
                 class="image-26">
        </div>

        <!-- Customizable 1 -->
        <div class="item-1">
            <div class="text-8-copy">Customizable</div>
            <div class="small-text">Place an order for CK branding
                anywhere, anytime and your order
                will arrive within the stated time</div>
            <img src="{{ asset('images/black-3d-vest-PNG.png') }}"
                 loading="lazy"
                 sizes="(max-width: 900px) 100vw, 900px"
                 srcset="{{ asset('images/black-3d-vest-PNG-p-500.png') }} 500w, {{ asset('images/black-3d-vest-PNG-p-800.png') }} 800w, {{ asset('images/black-3d-vest-PNG.png') }} 900w"
                 alt=""
                 class="image-22">
        </div>

        <!-- Customizable 2 -->
        <div class="item-1">
            <div class="text-8-copy">Customizable</div>
            <div class="small-text">Place an order for CK branding
                anywhere, anytime and your order
                will arrive within the stated time</div>
            <img src="{{ asset('images/black-3d-vest-PNG.png') }}"
                 loading="lazy"
                 sizes="(max-width: 900px) 100vw, 900px"
                 srcset="{{ asset('images/black-3d-vest-PNG-p-500.png') }} 500w, {{ asset('images/black-3d-vest-PNG-p-800.png') }} 800w, {{ asset('images/black-3d-vest-PNG.png') }} 900w"
                 alt=""
                 class="image-22">
        </div>
    </section>
@endsection
