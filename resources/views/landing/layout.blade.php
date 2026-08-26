<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Hyamii — the all-in-one restaurant management platform. POS, kitchen display, online ordering, inventory and compliance ready.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hyamii — Restaurant Management Software')</title>

    <link rel="icon" type="image/png" href="{{ asset('vendor/custom-home/images/favicon.png') }}">
    <link rel="preload" as="style" href="{{ asset('vendor/custom-home/fonts/hyamii-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/fonts/hyamii-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/main.css') }}">

    <style>
        :root {
            --hy-teal: #002522;
            --hy-amaranth: #a33b38;
            --hy-ink: #0d2b27;
            --hy-muted: #4a5c59;
            --hy-line: #e8e8e3;
            --hy-soft: #fafaf8;
        }

        body {
            background: #fff;
            color: var(--hy-ink);
            overflow-x: hidden;
            font-family: 'Manrope', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Hanken Grotesk', sans-serif;
            color: var(--hy-ink);
            line-height: 1.12;
            letter-spacing: -0.02em;
        }

        .hy-section { padding: clamp(64px, 9vw, 120px) 0; }

        .hy-display {
            font-weight: 800;
            font-size: clamp(38px, 5.2vw, 72px);
            line-height: 1.05;
            letter-spacing: -0.03em;
        }

        .hy-h1 {
            font-weight: 800;
            font-size: clamp(34px, 4.4vw, 56px);
            line-height: 1.08;
            letter-spacing: -0.03em;
        }

        .hy-h2 {
            font-weight: 800;
            font-size: clamp(30px, 3.6vw, 48px);
            line-height: 1.1;
            letter-spacing: -0.02em;
        }

        .hy-lead {
            font-size: clamp(16px, 1.4vw, 19px);
            line-height: 1.7;
            color: var(--hy-muted);
        }

        /* buttons */
        .hy-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 15px;
            line-height: 1;
            padding: 17px 32px;
            transition: all .25s ease;
            font-family: 'Hanken Grotesk', sans-serif;
            white-space: nowrap;
        }

        .hy-btn i { font-size: 14px; }

        .hy-btn-primary { background: var(--hy-teal); color: #fff; }
        .hy-btn-primary:hover { background: var(--hy-amaranth); color: #fff; }

        .hy-btn-ghost { background: #fff; color: var(--hy-ink); border: 1px solid var(--hy-line); }
        .hy-btn-ghost:hover { border-color: var(--hy-teal); color: var(--hy-teal); }

        /* pill subtitle */
        .hy-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--hy-line);
            border-radius: 50px;
            padding: 6px 16px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--hy-muted);
            font-family: 'Hanken Grotesk', sans-serif;
        }

        .hy-pill .dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--hy-teal);
        }

        /* header */
        .hy-header {
            position: sticky;
            top: 0;
            z-index: 90;
            background: rgba(255, 255, 255, .9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--hy-line);
        }

        .hy-logo {
            font-weight: 800;
            font-size: 26px;
            letter-spacing: -0.02em;
            color: var(--hy-ink);
        }

        .hy-nav a {
            font-weight: 600;
            font-size: 15px;
            color: var(--hy-ink);
            margin: 0 14px;
        }

        .hy-nav a:hover, .hy-nav a.active { color: var(--hy-amaranth); }

        .hy-burger {
            border: 1px solid var(--hy-line);
            background: #fff;
            border-radius: 10px;
            width: 44px; height: 44px;
            color: var(--hy-ink);
            font-size: 18px;
        }

        .hy-mobile-menu { border-top: 1px solid var(--hy-line); }
        .hy-mobile-menu a {
            display: block;
            padding: 14px 4px;
            font-weight: 600;
            color: var(--hy-ink);
            border-bottom: 1px solid var(--hy-line);
        }
        .hy-mobile-menu a:hover { color: var(--hy-amaranth); }

        /* country / currency selector */
        .hy-country-select {
            height: 42px;
            border: 1px solid var(--hy-line);
            border-radius: 100px;
            padding: 0 14px;
            font-weight: 600;
            font-size: 14px;
            color: var(--hy-ink);
            background: #fff;
            cursor: pointer;
        }

        .hy-country-select:focus { outline: none; border-color: var(--hy-teal); }

        /* media */
        .hy-media {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 37, 34, .14);
            background: var(--hy-soft);
        }

        .hy-media img { width: 100%; height: 100%; object-fit: cover; display: block; }

        /* screenshot variant: shows full product shot without cropping */
        .hy-media.hy-shot { background: #0d2b27; padding: 14px; }
        .hy-media.hy-shot img { object-fit: contain; border-radius: 10px; }

        /* cards */
        .hy-card {
            background: #fff;
            border: 1px solid var(--hy-line);
            border-radius: 18px;
            padding: 34px 30px;
            height: 100%;
            transition: all .3s ease;
        }

        .hy-card:hover {
            border-color: var(--hy-teal);
            transform: translateY(-6px);
            box-shadow: 0 22px 44px rgba(0, 37, 34, .08);
        }

        .hy-icon {
            width: 54px; height: 54px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(0, 37, 34, .07);
            color: var(--hy-teal);
            font-size: 22px;
            margin-bottom: 18px;
        }

        .hy-card:hover .hy-icon { background: var(--hy-teal); color: #fff; }
        .hy-card h3 { font-size: 21px; font-weight: 700; margin-bottom: 10px; }
        .hy-card p { color: var(--hy-muted); margin: 0; }

        /* stats */
        .hy-stat .num {
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 800;
            font-size: clamp(40px, 4.5vw, 60px);
            line-height: 1;
            color: var(--hy-teal);
        }

        .hy-stat .lbl {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: .04em;
            color: var(--hy-muted);
            margin-top: 8px;
        }

        /* pricing */
        .hy-price {
            background: #fff;
            border: 1px solid var(--hy-line);
            border-radius: 22px;
            padding: 38px 34px;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all .3s ease;
        }

        .hy-price:hover { box-shadow: 0 24px 48px rgba(0, 37, 34, .08); transform: translateY(-6px); }
        .hy-price.featured { border-color: var(--hy-teal); box-shadow: 0 24px 48px rgba(0, 37, 34, .1); }
        .hy-price .amount { font-family: 'Hanken Grotesk', sans-serif; font-weight: 800; font-size: 46px; color: var(--hy-teal); line-height: 1; }
        .hy-price ul { list-style: none; padding: 0; margin: 22px 0; flex-grow: 1; }
        .hy-price li { padding: 9px 0; color: var(--hy-muted); display: flex; align-items: center; gap: 10px; }
        .hy-price li i { color: var(--hy-teal); }

        /* testimonial */
        .hy-quote {
            background: #fff;
            border: 1px solid var(--hy-line);
            border-radius: 18px;
            padding: 32px;
            height: 100%;
        }

        .hy-quote p { font-size: 18px; line-height: 1.6; color: var(--hy-ink); }

        /* testimonial pagination */
        .tp-testimonial-ai-pagination { text-align: center; }
        .tp-testimonial-ai-pagination .swiper-pagination-bullet {
            width: 9px; height: 9px; background: var(--hy-muted); opacity: .35; transition: .25s;
        }
        .tp-testimonial-ai-pagination .swiper-pagination-bullet-active {
            background: var(--hy-teal); opacity: 1; width: 22px; border-radius: 6px;
        }

        /* cta */
        .hy-cta {
            background: var(--hy-teal);
            color: #fff;
            border-radius: 28px;
            padding: clamp(40px, 6vw, 80px);
            text-align: center;
        }

        .hy-cta h2 { color: #fff; }
        .hy-cta .hy-btn-ghost { background: transparent; color: #fff; border-color: rgba(255, 255, 255, .4); }
        .hy-cta .hy-btn-ghost:hover { background: #fff; color: var(--hy-teal); border-color: #fff; }

        /* footer */
        .hy-footer { background: var(--hy-ink); color: rgba(255, 255, 255, .75); }
        .hy-footer a { color: rgba(255, 255, 255, .75); }
        .hy-footer a:hover { color: #fff; }
        .hy-footer h5 { color: #fff; text-transform: uppercase; font-size: 14px; letter-spacing: .04em; margin-bottom: 16px; }
        .hy-social a {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255, 255, 255, .08);
            padding: 8px 16px; border-radius: 100px; margin: 0 8px 8px 0;
            font-size: 14px; font-weight: 600;
        }

        .hy-news {
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 10px; height: 52px; width: 100%;
            color: #fff; padding: 5px 60px 5px 18px;
        }

        .hy-news::placeholder { color: rgba(255, 255, 255, .5); }
        .hy-news-btn {
            position: absolute; right: 6px; top: 50%;
            transform: translateY(-50%);
            width: 42px; height: 42px; border-radius: 8px; border: 0;
            background: var(--hy-amaranth); color: #fff;
        }

        /* contact form */
        .hy-input {
            width: 100%; height: 54px;
            border: 1px solid var(--hy-line); border-radius: 12px;
            padding: 0 18px; font-size: 15px; color: var(--hy-ink); background: #fff;
        }
        .hy-input:focus { outline: none; border-color: var(--hy-teal); }
        textarea.hy-input { height: 140px; padding: 16px 18px; resize: none; }

        /* swiper polish */
        .swiper { overflow: hidden; }
        .brand-slide img { height: 38px; opacity: .6; filter: grayscale(1); }

        /* page hero */
        .hy-page-hero { background: var(--hy-soft); }

        /* loader (Hyamii themed) */
        .loader-wrap {
            position: fixed; inset: 0; z-index: 9999;
            display: flex; align-items: center; justify-content: center;
            background: var(--hy-teal);
            overflow: hidden;
        }
        .loader-wrap::before {
            content: ""; position: absolute;
            width: 680px; height: 680px; border-radius: 50%;
            background: radial-gradient(circle, rgba(163, 59, 56, .22), transparent 68%);
            top: 50%; left: 50%; transform: translate(-50%, -50%);
        }
        .loader-inner {
            position: relative; z-index: 2;
            display: flex; flex-direction: column; align-items: center;
            gap: 22px; text-align: center;
        }
        .loader-brand { display: flex; align-items: center; gap: 14px; }
        .loader-mark {
            width: 56px; height: 56px; border-radius: 15px; background: #fff;
            padding: 10px; box-shadow: 0 12px 34px rgba(0, 0, 0, .28);
            display: flex; align-items: center; justify-content: center;
        }
        .loader-mark img { width: 100%; height: 100%; object-fit: contain; }
        .loader-word {
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 800; letter-spacing: -0.02em;
            font-size: clamp(34px, 6vw, 60px); color: #fff; line-height: 1;
        }
        .loader-ring {
            width: 46px; height: 46px; border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, .16);
            border-top-color: var(--hy-amaranth);
            animation: hy-spin .9s linear infinite;
        }
        @keyframes hy-spin { to { transform: rotate(360deg); } }
        .loader-track {
            width: min(260px, 62vw); height: 4px; border-radius: 99px;
            background: rgba(255, 255, 255, .14); overflow: hidden;
        }
        .loader-fill {
            display: block; height: 100%; width: 0%;
            background: var(--hy-amaranth); border-radius: 99px;
        }
        .loader-status {
            font-family: 'Hanken Grotesk', sans-serif; font-weight: 700;
            color: rgba(255, 255, 255, .85); font-size: 15px; letter-spacing: .04em;
        }
        .loader-tag {
            margin: 0; font-family: 'Manrope', sans-serif;
            color: rgba(255, 255, 255, .55); font-size: 14px;
        }
        body.hy-loading { overflow: hidden; }

        /* hide custom cursor on touch / small screens */
        @media (max-width: 991.98px) {
            #magic-cursor { display: none !important; }
        }
    </style>
</head>

<body class="tp-magic-cursor">
    <div class="loader-wrap" id="hyLoader">
        <div class="loader-inner">
            <div class="loader-brand">
                <span class="loader-mark">
                    <img src="{{ asset('vendor/custom-home/images/favicon.png') }}" alt="Hyamii">
                </span>
                <span class="loader-word">Hyamii</span>
            </div>
            <div class="loader-ring" aria-hidden="true"></div>
            <div class="loader-track" role="progressbar" aria-label="Loading">
                <span class="loader-fill" id="hyLoaderFill"></span>
            </div>
            <div class="loader-status"><span id="hyLoaderPct">0</span>%</div>
            <p class="loader-tag">Restaurant management, made effortless.</p>
        </div>
    </div>
    <div id="magic-cursor">
        <div id="ball"></div>
    </div>

    @php
        $lh = landing_home_setting();
        $img = fn($path, $fallback) => landing_home_image($path, $fallback);
    @endphp

    <!-- header / site nav -->
    <header class="hy-header">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between py-3">
                <a href="{{ url('/') }}" class="hy-logo">Hyamii</a>
                <nav class="hy-nav d-none d-lg-flex align-items-center">
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ url('/features') }}" class="{{ request()->is('features') ? 'active' : '' }}">Features</a>
                    <a href="{{ url('/pricing') }}" class="{{ request()->is('pricing') ? 'active' : '' }}">Pricing</a>
                    <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
                    <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                </nav>
                <div class="d-flex align-items-center gap-2">
                    <div class="d-none d-lg-block">
                        <select id="hyCountry" class="hy-country-select" onchange="hySetCountry(this.value)"
                            aria-label="Select your country">
                            @foreach (($countries ?? []) as $cc => $c)
                                <option value="{{ $cc }}"
                                    {{ $cc === ($countryCode ?? 'RW') ? 'selected' : '' }}>
                                    {{ $c['name'] }} · {{ $c['currency_code'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary">Get Started <i
                            class="fa-solid fa-arrow-right"></i></a>
                    <button class="hy-burger d-lg-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#hyMobileMenu" aria-label="Menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
            <div class="hy-mobile-menu collapse d-lg-none" id="hyMobileMenu">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/features') }}">Features</a>
                <a href="{{ url('/pricing') }}">Pricing</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ url('/contact') }}">Contact</a>
                <div class="pt-2">
                    <select class="hy-country-select w-100" onchange="hySetCountry(this.value)" aria-label="Select your country">
                        @foreach (($countries ?? []) as $cc => $c)
                            <option value="{{ $cc }}"
                                {{ $cc === ($countryCode ?? 'RW') ? 'selected' : '' }}>
                                {{ $c['name'] }} · {{ $c['currency_code'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- footer -->
    <footer class="hy-footer pt-5 pb-4">
        <div class="container py-4">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="hy-logo text-white">Hyamii</div>
                    <p class="mt-3" style="max-width:320px;">
                        {{ $lh['footer']['text'] ?? 'The all-in-one restaurant management platform — POS, kitchen, online ordering, inventory and compliance, built for modern restaurants.' }}
                    </p>
                    <div class="hy-social mt-3">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i> Facebook</a>
                        <a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i> X</a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5>Product</h5>
                    <ul class="list-unstyled" style="line-height:2.2;">
                        <li><a href="{{ url('/features') }}">Features</a></li>
                        <li><a href="{{ url('/pricing') }}">Pricing</a></li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h5>Contact</h5>
                    <ul class="list-unstyled" style="line-height:2.2;">
                        <li><i class="fa-solid fa-envelope me-2"></i>
                            {{ $lh['contact']['email'] ?? 'hello@hyamii.com' }}</li>
                        <li><i class="fa-solid fa-phone me-2"></i>
                            {{ $lh['contact']['phone'] ?? '+250 788 000 000' }}</li>
                        <li><i class="fa-solid fa-location-dot me-2"></i>
                            {{ $lh['contact']['address'] ?? 'Kigali, Rwanda' }}</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-12">
                    <h5>Newsletter</h5>
                    <p style="color:rgba(255,255,255,.6);">Get product updates in your language.</p>
                    <div class="position-relative mt-2">
                        <input type="email" class="hy-news" placeholder="Your email">
                        <button class="hy-news-btn"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-5 pt-4"
                style="border-top:1px solid rgba(255,255,255,.12);">
                <span>© {{ date('Y') }} Hyamii. All rights reserved.</span>
                <div class="d-flex gap-4" style="text-transform:uppercase;font-size:13px;font-weight:600;">
                    <a href="{{ url('/privacy-policy') }}">Privacy</a>
                    <a href="{{ url('/terms-conditions') }}">Terms</a>
                    <a href="{{ url('/refund-policy') }}">Refund</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('vendor/custom-home/js/jquery.js') }}"></script>
    <script src="{{ asset('vendor/custom-home/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('vendor/custom-home/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('vendor/custom-home/js/purecounter.js') }}"></script>
    <script src="{{ asset('vendor/custom-home/js/plugin.js') }}"></script>
    <script src="{{ asset('vendor/custom-home/js/main.js') }}"></script>
    <script>
        (function () {
            var loader = document.getElementById('hyLoader');
            if (!loader) return;
            document.body.classList.add('hy-loading');
            var fill = document.getElementById('hyLoaderFill');
            var pct = document.getElementById('hyLoaderPct');

            function hide() {
                loader.style.display = 'none';
                document.body.classList.remove('hy-loading');
            }

            function run(gsap) {
                var counter = { v: 0 };
                gsap.timeline({ onComplete: function () {
                    gsap.to(loader, {
                        yPercent: -100, duration: .45, ease: 'power3.inOut',
                        onComplete: hide
                    });
                } }).to(counter, {
                    v: 100, duration: .8, ease: 'power1.inOut',
                    onUpdate: function () {
                        var val = Math.round(counter.v);
                        if (fill) fill.style.width = val + '%';
                        if (pct) pct.textContent = val;
                    }
                });
            }

            if (window.gsap) {
                run(window.gsap);
            } else {
                window.addEventListener('load', function () {
                    if (window.gsap) run(window.gsap);
                    else setTimeout(hide, 1200);
                });
            }

            // safety net: never leave the page blocked
            setTimeout(hide, 3000);
        })();
    </script>
    <script src="{{ asset('vendor/custom-home/js/slider-init.js') }}"></script>
    <script src="{{ asset('vendor/custom-home/js/tp-cursor.js') }}"></script>
    <script>
        function hySetCountry(code) {
            var url = new URL(window.location.href);
            url.searchParams.set('country', code);
            window.location.href = url.toString();
        }
    </script>
</body>

</html>
