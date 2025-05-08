@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div id="Nav-Bar" class="hero-section">
        <div class="frame-7">
            <img src="{{ asset('images/Man-Edied-1.png') }}" loading="lazy" width="601" height="777" alt="" srcset="{{ asset('images/Man-Edied-1-p-500.png') }} 500w, {{ asset('images/Man-Edied-1.png') }} 601w" sizes="(max-width: 601px) 100vw, 601px" class="man-edited">
            <div class="frame-6">
                <div class="shop-boxes">
                    <!-- T-shirts -->
                    <a href="{{ route('t-shirt-form') }}" class="t-shirt w-inline-block">
                        <img src="{{ asset('images/Custom-T-shirts-White_00000.png') }}" loading="lazy" style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" sizes="(max-width: 767px) 100vw, 531.2999267578125px" alt="" srcset="{{ asset('images/Custom-T-shirts-White_00000-p-500.png') }} 500w, {{ asset('images/Custom-T-shirts-White_00000.png') }} 506w" class="golf-white">
                        <img src="{{ asset('images/Custom-T-shirts_00000.png') }}" loading="lazy" width="171.60000610351562" height="312" alt="" srcset="{{ asset('images/6bdb9c6b6cd8c13ab88c70f6d6a158c2_Custom-T-shirts_00000-p-500.png') }} 500w, {{ asset('images/Custom-T-shirts_00000.png') }} 506w" sizes="171.59722900390625px" class="man-edied-1">
                    </a>

                    <!-- Vests -->
                    <a href="{{ route('vests-form') }}" class="vests w-inline-block">
                        <img src="{{ asset('images/Custom-Vests-White_00000.png') }}" loading="lazy" style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" data-w-id="7970d0b9-1542-a7c2-9e7c-3c19ac25bf0d" alt="" class="vest1">
                        <img src="{{ asset('images/Custom-Vests_00000.png') }}" loading="lazy" width="169.25491333007812" height="312" alt="" data-w-id="f881fcc1-f15c-41e8-d816-db8f69398581" style="opacity:0" class="vest2">
                    </a>

                    <!-- Jackets -->
                    <a href="{{ route('jackets-form') }}" class="jacket-fixed w-inline-block">
                        <img src="{{ asset('images/Custom-Jackets-White_00000.png') }}" loading="lazy" style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" alt="" class="golf-white">
                        <img src="{{ asset('images/Custom-Jackets_00000.png') }}" loading="lazy" alt="" class="man-edied-1">
                    </a>

                    <!-- Caps -->
                    <a href="{{ route('cap-form') }}" class="caps w-inline-block">
                        <img src="{{ asset('images/Custom-Caps-White_00000.png') }}" loading="lazy" style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" alt="" class="golf-white">
                        <img src="{{ asset('images/Custom-Caps_00000.png') }}" loading="lazy" width="167.89541625976562" height="312" alt="" class="man-edied-1">
                    </a>

                    <!-- Hoodies -->
                    <a href="{{ route('hoodies-form') }}" class="hoodies w-inline-block">
                        <img src="{{ asset('images/Custom-Hoodies-White_00000.png') }}" loading="lazy" style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" alt="" class="golf-white">
                        <img src="{{ asset('images/Custom-Hoodies_00000.png') }}" loading="lazy" width="168.886962890625" height="312" alt="" class="man-edied-1">
                    </a>

                    <!-- Golf T-shirts -->
                    <a href="{{ route('golf-t-shirt-form') }}" class="golf-t-shirt w-inline-block">
                        <img src="{{ asset('images/Golf-White_00000.png') }}" loading="lazy" style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" alt="" class="golf-white">
                        <img src="{{ asset('images/Custom-Golf-T-shirts_00000.png') }}" loading="lazy" width="169.37229919433594" height="313" alt="" class="man-edied-1">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us">
        <div class="header-1">
            <div data-w-id="fa8a9773-422c-2279-a293-f1ee2609f394" style="opacity:0" class="why-choose-branding">Why Choose CK BRANDING?</div>
        </div>
        <div class="frame-29">
            <div class="frame-29">
                <div class="frame-26">
                    <div class="frame-20">
                        <div class="frame-19">
                            <div class="frame-20">
                                <div class="frame-12">
                                    <div class="text-7">1</div>
                                    <div class="frame-33">
                                        <div class="text-8">Customizable</div>
                                        <div class="small-text">Place an order for CK branding
                                            anywhere, anytime and your order
                                            will arrive within the stated time</div>
                                    </div>
                                </div>
                            </div>
                            <div class="frame-12">
                                <div class="text-7">2</div>
                                <div class="frame-34">
                                    <div class="text-8">HIGH QUALITY</div>
                                    <div class="small-text">Available as plain
                                        Available with customized
                                        branding</div>
                                </div>
                            </div>
                        </div>
                        <div class="frame-12">
                            <div class="text-7">3</div>
                            <div class="frame-34">
                                <div class="text-8">ALWAYS ONLINE</div>
                                <div class="small-text">Place an order for CK branding
                                    anywhere, anytime and your order
                                    will arrive within the stated time</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="frame-26">
                    <div class="frame-22">
                        <div class="frame-19">
                            <div class="frame-12">
                                <div class="text-7">4</div>
                                <div class="frame-34">
                                    <div class="text-8">WE DELIVER</div>
                                    <div class="small-text">Place an order for CK branding
                                        anywhere, anytime and your order
                                        will arrive within the stated time</div>
                                </div>
                            </div>
                            <div class="frame-12">
                                <div class="text-7">5</div>
                                <div class="frame-34">
                                    <div class="text-8">FAST TURN AROUND TIME</div>
                                    <div class="small-text">Available as plain
                                        Available with customized
                                        branding</div>
                                </div>
                            </div>
                            <div class="frame-12">
                                <div class="text-7">6</div>
                                <div class="frame-34">
                                    <div class="text-8">Bulk &amp; Individual Orders</div>
                                    <div class="small-text">Available as plain
                                        Available with customized
                                        branding</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('images/Online-24-7_00000_00000-1.png') }}" loading="lazy" width="438.5390625" height="533.9241943359375" alt="" srcset="{{ asset('images/Online-24-7_00000_00000-1-p-500.png') }} 500w, {{ asset('images/Online-24-7_00000_00000-1.png') }} 534w" sizes="(max-width: 479px) 100vw, 438.52777099609375px" class="online-24-7_00000_00000-1">
            </div>
        </div>
    </section>

    <!-- Sample Images -->
    <div class="sample-images">
        <a href="#" class="lightbox-link w-inline-block w-lightbox" aria-label="open lightbox" aria-haspopup="dialog"><img src="images/Rectangle-4.png" loading="lazy" width="288" height="810" alt="" class="rectangle-4">
            <script type="application/json" class="w-json">{
                  "items": [
                    {
                      "_id": "681540d1359a44d47e683a74",
                      "origFileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileSize": 0,
                      "height": 414,
                      "url": "https://cdn.prod.website-files.com/68152a2ec418651a6f7260fd/681540d1359a44d47e683a74_Screenshot-2025-02-20-093345-1.png",
                      "width": 736,
                      "type": "image"
                    }
                  ],
                  "group": ""
                }
            </script>
        </a>
        <a href="#" class="lightbox-link w-inline-block w-lightbox" aria-label="open lightbox" aria-haspopup="dialog"><img src="images/Rectangle-5.png" loading="lazy" width="288" height="810" alt="" class="rectangle-4">
            <script type="application/json" class="w-json">{
                  "items": [
                    {
                      "_id": "681540d1359a44d47e683a74",
                      "origFileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileSize": 0,
                      "height": 414,
                      "url": "https://cdn.prod.website-files.com/68152a2ec418651a6f7260fd/681540d1359a44d47e683a74_Screenshot-2025-02-20-093345-1.png",
                      "width": 736,
                      "type": "image"
                    }
                  ],
                  "group": ""
                }
            </script>
        </a>
        <a href="#" class="lightbox-link w-inline-block w-lightbox" aria-label="open lightbox" aria-haspopup="dialog"><img src="images/Rectangle-6.png" loading="lazy" width="288" height="810" alt="" class="rectangle-4">
            <script type="application/json" class="w-json">{
                  "items": [
                    {
                      "_id": "681540d1359a44d47e683a74",
                      "origFileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileSize": 0,
                      "height": 414,
                      "url": "https://cdn.prod.website-files.com/68152a2ec418651a6f7260fd/681540d1359a44d47e683a74_Screenshot-2025-02-20-093345-1.png",
                      "width": 736,
                      "type": "image"
                    }
                  ],
                  "group": ""
                }
            </script>
        </a>
        <a href="#" class="lightbox-link w-inline-block w-lightbox" aria-label="open lightbox" aria-haspopup="dialog"><img src="images/Rectangle-7.png" loading="lazy" width="288" height="810" alt="" class="rectangle-4">
            <script type="application/json" class="w-json">{
                  "items": [
                    {
                      "_id": "681540d1359a44d47e683a74",
                      "origFileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileSize": 0,
                      "height": 414,
                      "url": "https://cdn.prod.website-files.com/68152a2ec418651a6f7260fd/681540d1359a44d47e683a74_Screenshot-2025-02-20-093345-1.png",
                      "width": 736,
                      "type": "image"
                    }
                  ],
                  "group": ""
                }
            </script>
        </a>
        <a href="#" class="lightbox-link w-inline-block w-lightbox" aria-label="open lightbox" aria-haspopup="dialog"><img src="images/Rectangle-8.png" loading="lazy" width="293" height="810" alt="" class="rectangle-4">
            <script type="application/json" class="w-json">{
                  "items": [
                    {
                      "_id": "681540d1359a44d47e683a74",
                      "origFileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileSize": 0,
                      "height": 414,
                      "url": "https://cdn.prod.website-files.com/68152a2ec418651a6f7260fd/681540d1359a44d47e683a74_Screenshot-2025-02-20-093345-1.png",
                      "width": 736,
                      "type": "image"
                    }
                  ],
                  "group": ""
                }
            </script>
        </a>
        <a href="#" class="lightbox-link w-inline-block w-lightbox" aria-label="open lightbox" aria-haspopup="dialog"><img src="images/Mamji.jpg" loading="lazy" sizes="(max-width: 810px) 100vw, 810px" srcset="images/Mamji-p-500.jpg 500w, images/Mamji.jpg 810w" alt="" class="rectangle-4">
            <script type="application/json" class="w-json">{
                  "items": [
                    {
                      "_id": "681540d1359a44d47e683a74",
                      "origFileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileName": "Screenshot-2025-02-20-093345-1.png",
                      "fileSize": 0,
                      "height": 414,
                      "url": "https://cdn.prod.website-files.com/68152a2ec418651a6f7260fd/681540d1359a44d47e683a74_Screenshot-2025-02-20-093345-1.png",
                      "width": 736,
                      "type": "image"
                    }
                  ],
                  "group": ""
                }
            </script>
        </a>
    </div>

    <div class="pattern-straight-copy">
        <img sizes="(max-width: 4000px) 100vw, 4000px" srcset="{{ asset('images/Pattern-Long_00000-p-500.png') }} 500w, {{ asset('images/Pattern-Long_00000-p-800.png') }} 800w, {{ asset('images/Pattern-Long_00000-p-1080.png') }} 1080w, {{ asset('images/Pattern-Long_00000-p-2000.png') }} 2000w, {{ asset('images/Pattern-Long_00000-p-2600.png') }} 2600w, {{ asset('images/Pattern-Long_00000-p-3200.png') }} 3200w, {{ asset('images/Pattern-Long_00000.png') }} 4000w" alt="" src="{{ asset('images/Pattern-Long_00000.png') }}" loading="lazy" class="pattern">
    </div>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="frame-36">
            <div class="text-9">HOW IT WORKS</div>
            <div class="frame-37">
                <div class="frame-38">
                    <div class="frame-39">
                        <div class="text-7">1</div>
                        <div class="frame-34">
                            <div class="text-8">Pick your product</div>
                            <div class="available-as-plain-available-with-customized-branding-2">Available as plain
                                Available with customized
                                branding</div>
                        </div>
                    </div>
                    <div class="frame-40">
                        <div class="text-7">2</div>
                        <div class="frame-34">
                            <div class="text-8">CUSTOMIZE YOUR ORDER</div>
                            <div class="available-as-plain-available-with-customized-branding-2">Available as plain
                                Available with customized
                                branding</div>
                        </div>
                    </div>
                    <div class="frame-41">
                        <div class="text-7">3</div>
                        <div class="frame-34">
                            <div class="text-8">COMPLETE YOUR pURCHASE</div>
                            <div class="available-as-plain-available-with-customized-branding-2">Available as plain
                                Available with customized
                                branding</div>
                        </div>
                    </div>
                </div>
                <a href="#" class="lightbox-link-2 w-inline-block w-lightbox">
                    <img src="{{ asset('images/Screenshot-2025-02-20-093345-1.png') }}" loading="lazy" width="736" height="413" alt="" srcset="{{ asset('images/Screenshot-2025-02-20-093345-1-p-500.png') }} 500w, {{ asset('images/Screenshot-2025-02-20-093345-1.png') }} 736w" sizes="(max-width: 736px) 100vw, 736px" class="screenshot-2025-02-20-093345-2">
                    <script type="application/json" class="w-json">{
                    "items": [
                        {
                            "url": "https://www.youtube.com/watch?v=6KcMwsp0Qwc",
                            "originalUrl": "https://www.youtube.com/watch?v=6KcMwsp0Qwc",
                            "width": 940,
                            "height": 528,
                            "thumbnailUrl": "https://i.ytimg.com/vi/6KcMwsp0Qwc/hqdefault.jpg",
                            "html": "<iframe class=\"embedly-embed\" src=\"//cdn.embedly.com/widgets/media.html?src=https%3A%2F%2Fwww.youtube.com%2Fembed%2F6KcMwsp0Qwc%3Ffeature%3Doembed&display_name=YouTube&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3D6KcMwsp0Qwc&image=https%3A%2F%2Fi.ytimg.com%2Fvi%2F6KcMwsp0Qwc%2Fhqdefault.jpg&type=text%2Fhtml&schema=youtube\" width=\"940\" height=\"528\" scrolling=\"no\" title=\"YouTube embed\" frameborder=\"0\" allow=\"autoplay; fullscreen; encrypted-media; picture-in-picture;\" allowfullscreen=\"true\"></iframe>",
                            "type": "video"
                        }
                    ],
                    "group": ""
                }</script>
                </a>
            </div>
        </div>
    </section>
@endsection
