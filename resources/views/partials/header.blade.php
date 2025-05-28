<div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
    <a href="{{ route('home') }}" class="brand w-nav-brand {{ request()->routeIs('home') ? 'w--current' : '' }}">
        <img width="85" sizes="85px" alt="" src="{{ asset('images/Large-Logo2_00000.png') }}" loading="lazy" srcset="{{ asset('images/Large-Logo2_00000-p-500.png') }} 500w, {{ asset('images/Large-Logo2_00000-p-800.png') }} 800w, {{ asset('images/Large-Logo2_00000-p-1080.png') }} 1080w, {{ asset('images/Large-Logo2_00000-p-1600.png') }} 1600w, {{ asset('images/Large-Logo2_00000-p-2000.png') }} 2000w, {{ asset('images/Large-Logo2_00000-p-2600.png') }} 2600w, {{ asset('images/Large-Logo2_00000-p-3200.png') }} 3200w, {{ asset('images/Large-Logo2_00000.png') }} 4000w" class="image-20">
    </a>
    <nav role="navigation" class="nav-menu w-nav-menu">
        <a href="{{ route('cart') }}" class="pes-5 nav-link-4 cart-nav w-nav-link {{ request()->routeIs('cart') ? 'w--current' : '' }}">Cart<div class="cart-count">{{ $cartCount }}</div></a>
        <a href="{{ route('about') }}" class="pes-5 nav-link-4 w-nav-link {{ request()->routeIs('about') ? 'w--current' : '' }}">ABOUT</a>
        <a href="{{ route('how-it-works') }}" class="pes-5 nav-link-4 w-nav-link {{ request()->routeIs('how-it-works') ? 'w--current' : '' }}">How it works</a>
        <a href="#Contact-Us" class="pes-5 nav-link-4 w-nav-link">Contact</a>
        <a href="{{ route('shop') }}" class="nav-link-3 w-nav-link {{ request()->routeIs('shop') ? 'w--current' : '' }}">SHOP</a>
    </nav>
    <div class="w-nav-button">
        <img width="20" sizes="(max-width: 767px) 20px, 100vw" alt="" src="{{ asset('images/Hamburger-menu.png') }}" loading="lazy" srcset="{{ asset('images/Hamburger-menu-p-500.png') }} 500w, {{ asset('images/Hamburger-menu.png') }} 512w">
    </div>
</div>

<style>
    .cart-count {
        border: 1px solid red;
        width: 25px;
        height: 25px;
        display: block;
        border-radius: 50%;
        background: red;
        color: white;
        text-align: center;
        padding: 2px;
        font-size: 16px;
        margin-left: 2px;
        margin-top: -14px;
    }

    .cart-nav{
        display: flex !important;
    }

    .pes-5{
        padding: 5px !important;
    }
</style>
