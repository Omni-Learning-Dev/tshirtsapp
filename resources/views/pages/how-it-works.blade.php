@extends('layouts.app')

@section('content')
    <!-- Background Video -->
    <div data-poster-url="https://uploads-ssl.webflow.com/66b8d8c2a3f56bbc32e2e107%2F66cba36430d078cb45ca6a1b_Showreel%20Footage1-poster-00001.jpg"
         data-video-urls="https://uploads-ssl.webflow.com/66b8d8c2a3f56bbc32e2e107%2F66cba36430d078cb45ca6a1b_Showreel%20Footage1-transcode.mp4,https://uploads-ssl.webflow.com/66b8d8c2a3f56bbc32e2e107%2F66cba36430d078cb45ca6a1b_Showreel%20Footage1-transcode.webm"
         data-autoplay="true"
         data-loop="true"
         data-wf-ignore="true"
         class="background-video w-background-video w-background-video-atom">
        <video id="448d70db-5feb-cdc9-afe3-f11dc1ddf1d9-video"
               autoplay=""
               loop=""
               style="background-image:url(&quot;https://uploads-ssl.webflow.com/66b8d8c2a3f56bbc32e2e107%2F66cba36430d078cb45ca6a1b_Showreel%20Footage1-poster-00001.jpg&quot;)"
               muted=""
               playsinline=""
               data-wf-ignore="true"
               data-object-fit="cover">
            <source src="https://uploads-ssl.webflow.com/66b8d8c2a3f56bbc32e2e107%2F66cba36430d078cb45ca6a1b_Showreel%20Footage1-transcode.mp4" data-wf-ignore="true">
            <source src="https://uploads-ssl.webflow.com/66b8d8c2a3f56bbc32e2e107%2F66cba36430d078cb45ca6a1b_Showreel%20Footage1-transcode.webm" data-wf-ignore="true">
        </video>
        <noscript>
            <style>
                [data-wf-bgvideo-fallback-img] {
                    display: none;
                }
                @media (prefers-reduced-motion: reduce) {
                    [data-wf-bgvideo-fallback-img] {
                        position: absolute;
                        z-index: -100;
                        display: inline-block;
                        height: 100%;
                        width: 100%;
                        object-fit: cover;
                    }
                }
            </style>
            <img data-wf-bgvideo-fallback-img="true" src="https://uploads-ssl.webflow.com/66b8d8c2a3f56bbc32e2e107%2F66cba36430d078cb45ca6a1b_Showreel%20Footage1-poster-00001.jpg" alt="">
        </noscript>
        <div aria-live="polite">
            <button type="button"
                    data-w-bg-video-control="true"
                    aria-controls="448d70db-5feb-cdc9-afe3-f11dc1ddf1d9-video"
                    class="w-backgroundvideo-backgroundvideoplaypausebutton w-background-video--control">
                <span><img loading="lazy" src="https://uploads-ssl.webflow.com/6022af993a6b2191db3ed10c/628299f8aa233b83918e24fd_Pause.svg" alt="Pause video"></span>
                <span hidden=""><img loading="lazy" src="https://uploads-ssl.webflow.com/6022af993a6b2191db3ed10c/628298b20ae0236682d4b87f_Play-24.svg" alt="Play video"></span>
            </button>
        </div>
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
                <img src="{{ asset('images/Screenshot-2025-02-20-093345-1.png') }}"
                     loading="lazy"
                     width="736"
                     height="413"
                     alt=""
                     srcset="{{ asset('images/Screenshot-2025-02-20-093345-1-p-500.png') }} 500w, {{ asset('images/Screenshot-2025-02-20-093345-1.png') }} 736w"
                     sizes="(max-width: 736px) 100vw, 736px"
                     class="screenshot-2025-02-20-093345-2">
            </div>
        </div>
    </section>
@endsection
