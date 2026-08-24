<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Hyamii — the all-in-one restaurant management platform for Rwanda. POS, kitchen display, online ordering, inventory and RRA EBM ready.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hyamii — Restaurant Management Software for Rwanda</title>

    <link rel="icon" type="image/png" href="{{ asset('vendor/custom-home/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/main.css') }}">

    <style>
        body {
            background-color: #fff;
            overflow-x: hidden;
        }

        .hy-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-radius: 100px;
            font-family: var(--tp-ff-heading);
            font-weight: 700;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0;
            line-height: 1;
            transition: all .3s ease;
        }

        .hy-btn i {
            font-size: 14px;
        }

        .hy-btn-primary {
            background: var(--tp-theme-primary);
            color: #fff;
            padding: 19px 36px;
        }

        .hy-btn-primary:hover {
            background: var(--tp-theme-secondary);
            color: #fff;
        }

        .hy-btn-secondary {
            background: transparent;
            color: var(--tp-common-black);
            border: 1px solid var(--tp-border-1);
            padding: 18px 34px;
        }

        .hy-btn-secondary:hover {
            background: var(--tp-theme-primary);
            color: #fff;
            border-color: var(--tp-theme-primary);
        }

        .hy-logo {
            font-family: var(--tp-ff-clash-bold);
            font-size: 30px;
            font-weight: 700;
            color: var(--tp-common-black);
            letter-spacing: -0.02em;
        }

        .hy-header {
            position: sticky;
            top: 0;
            z-index: 90;
            background: rgba(255, 255, 255, .88);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--tp-border-1);
        }

        .hy-nav-link {
            font-family: var(--tp-ff-heading);
            font-weight: 600;
            font-size: 16px;
            color: var(--tp-common-black);
            text-transform: uppercase;
        }

        .hy-nav-link:hover {
            color: var(--tp-theme-secondary);
        }

        .tp-hero-title em {
            font-style: normal;
            color: var(--tp-theme-secondary);
        }

        /* Display font only on big headings; smaller headings stay in the clean body font */
        .tp-hero-title {
            font-family: var(--tp-ff-clash-bold);
        }

        /* Calmer, cleaner card hovers — keep the motion, drop the harsh full-colour inversion */
        .tp-service-item {
            transition: all .35s ease;
        }

        .tp-service-item-bg {
            display: none;
        }

        .tp-service-item:hover {
            border-color: var(--tp-theme-primary);
            transform: translateY(-8px);
            box-shadow: 0 24px 50px rgba(0, 37, 34, .08);
        }

        .tp-service-item:hover .tp-service-shape {
            color: var(--tp-theme-primary) !important;
        }

        .tp-feature-md-item {
            background: #fff;
            border: 1px solid var(--tp-border-1);
            transition: all .35s ease;
        }

        .tp-feature-md-item:hover {
            background: #f3f8f7;
            border-color: var(--tp-theme-primary);
            transform: translateY(-6px);
            box-shadow: 0 24px 50px rgba(0, 37, 34, .08);
        }

        .tp-feature-md-item:hover .tp-feature-md-icon {
            color: var(--tp-theme-primary) !important;
        }

        .hy-section-soft {
            background: #fafaf8;
        }

        .hy-hero-img {
            border-radius: 24px;
            box-shadow: 0 30px 60px rgba(0, 37, 34, .15);
        }

        .hy-shape {
            position: absolute;
            z-index: 0;
            pointer-events: none;
        }

        .hy-stat .num {
            font-family: var(--tp-ff-clash-bold);
            font-size: 64px;
            line-height: 1;
            color: var(--tp-theme-primary);
            font-weight: 700;
        }

        .hy-stat .lbl {
            font-family: var(--tp-ff-heading);
            text-transform: uppercase;
            font-weight: 600;
            color: var(--tp-grey-1);
            margin-top: 10px;
        }

        .tp-cta-ai-bg {
            background: var(--tp-theme-primary);
            color: #fff;
            text-align: center;
        }

        .tp-cta-ai-bg .tp-section-title-clash-600 {
            color: #fff;
        }

        .tp-footer-top-title {
            font-family: var(--tp-ff-clash-bold);
            color: var(--tp-common-black);
        }

        @media (max-width: 991.98px) {
            .tp-hero-title {
                font-size: 56px !important;
            }
        }
    </style>
</head>

<body class="tp-magic-cursor">
    <div id="magic-cursor">
        <div id="ball"></div>
    </div>

    @php
        $lh = landing_home_setting();
        $img = fn($path, $fallback) => landing_home_image($path, $fallback);
        $serviceIcons = ['fa-utensils', 'fa-kitchen-set', 'fa-cart-shopping', 'fa-chair', 'fa-chart-line', 'fa-heart'];
    @endphp

    <!-- header -->
    <header class="hy-header">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between py-3">
                <a href="#" class="hy-logo">Hyamii</a>
                <nav class="d-none d-lg-flex align-items-center gap-4">
                    <a href="#features" class="hy-nav-link">Features</a>
                    <a href="#about" class="hy-nav-link">About</a>
                    <a href="#faq" class="hy-nav-link">FAQ</a>
                    <a href="#contact" class="hy-nav-link">Contact</a>
                </nav>
                <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary">Get Started <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </header>

    <!-- hero -->
    <section class="tp-hero-spacing position-relative">
        <img class="hy-shape" style="top:-40px;left:-60px;width:220px;opacity:.5"
            src="{{ asset('vendor/custom-home/images/hero-shape-1.png') }}" alt="">
        <img class="hy-shape" style="bottom:0;right:-30px;width:260px;opacity:.4"
            src="{{ asset('vendor/custom-home/images/hero-shape-3.png') }}" alt="">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="tp-section-subtitle mb-3"><span class="borders"></span>
                        {{ $lh['hero']['subtitle'] ?? 'Restaurant software built for Rwanda' }}</span>
                    <h1 class="tp-hero-title">{{ $lh['hero']['title'] ?? 'Run your restaurant on autopilot' }}</h1>
                    <p class="mt-4" style="font-size:18px;line-height:30px;color:var(--tp-grey-1);max-width:520px;">
                        {{ $lh['hero']['paragraph'] ?? 'Hyamii brings POS, kitchen display, online ordering, inventory and RRA EBM compliance into one fast, beautiful platform.' }}
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4 pt-2">
                        <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary">Start free <i
                                class="fa-solid fa-arrow-right"></i></a>
                        <a href="#features" class="hy-btn hy-btn-secondary"><i
                                class="fa-solid fa-play"></i> Watch demo</a>
                    </div>
                </div>
                <div class="col-lg-6 position-relative">
                    <div class="tp-hero-thumb">
                        <img class="w-100 hy-hero-img" src="{{ $img($lh['hero']['image'] ?? null, 'thumb-main.png') }}"
                            alt="Hyamii dashboard">
                        <img class="hy-shape" style="top:30px;right:10px;width:90px"
                            src="{{ asset('vendor/custom-home/images/hero-shape-5.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- brand slider -->
    <section class="pb-100 pt-60">
        <div class="container">
            <p class="text-center mb-4"
                style="font-family:var(--tp-ff-heading);text-transform:uppercase;font-weight:600;color:var(--tp-grey-2);letter-spacing:.05em;">
                {{ $lh['brand']['title'] ?? 'Trusted by restaurants across Rwanda' }}</p>
            <div class="swiper tp-brand-slide-active">
                <div class="swiper-wrapper align-items-center">
                    @foreach (['brand-1.png', 'brand-3.png', 'brand-4.png', 'brand-5.png', 'brand-6.png', 'brand-1.png', 'brand-3.png', 'brand-4.png'] as $b)
                        <div class="swiper-slide text-center">
                            <img src="{{ asset('vendor/custom-home/images/' . $b) }}" alt=""
                                style="height:42px;opacity:.65;filter:grayscale(1);">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- services -->
    <section id="features" class="pb-100 position-relative">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="tp-section-subtitle mb-3"><span class="borders"></span>
                        {{ $lh['services']['subtitle'] ?? 'All-in-one platform' }}</span>
                    <h2 class="tp-section-title-clash-600 fs-60">
                        {{ $lh['services']['title'] ?? 'Everything your restaurant needs' }}</h2>
                </div>
            </div>

            <div class="row g-4">
                @foreach (($lh['services']['items'] ?? []) as $i => $s)
                    <div class="col-lg-4 col-md-6">
                        <div class="tp-service-item position-relative overflow-hidden h-100">
                            <div class="tp-service-item-bg"></div>
                            <div class="tp-service-shape" style="color:var(--tp-theme-secondary)">
                                <i class="fa-solid {{ $serviceIcons[$i % count($serviceIcons)] }}"
                                    style="font-size:34px;"></i>
                            </div>
                            <h3 class="tp-service-item-title">{{ $s['title'] ?? '' }}</h3>
                            <p class="tp-service-para" style="color:var(--tp-grey-1);">{{ $s['text'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- about + stats -->
    <section id="about" class="pb-100">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 position-relative">
                    <img class="w-100" src="{{ $img($lh['about']['image'] ?? null, 'thumb-2.jpg') }}" alt=""
                        style="border-radius:24px;">
                    <img class="hy-shape" style="bottom:-30px;left:-30px;width:120px"
                        src="{{ asset('vendor/custom-home/images/hero-shape-2.png') }}" alt="">
                </div>
                <div class="col-lg-6">
                    <span class="tp-section-subtitle mb-3"><span class="borders"></span>
                        {{ $lh['about']['subtitle'] ?? 'Why Hyamii' }}</span>
                    <h2 style="font-family:var(--tp-ff-clash-bold);font-size:48px;line-height:1.05;text-transform:uppercase;">
                        {{ $lh['about']['title'] ?? 'Made for Rwandan restaurants' }}</h2>
                    <p class="mt-3" style="font-size:18px;line-height:30px;color:var(--tp-grey-1);">
                        {{ $lh['about']['paragraph1'] ?? '' }}</p>
                    <p style="font-size:18px;line-height:30px;color:var(--tp-grey-1);">
                        {{ $lh['about']['paragraph2'] ?? '' }}</p>
                    <div class="row g-4 mt-2">
                        <div class="col-6">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="500" data-purecounter-suffix="+">0</span></div>
                                <div class="lbl">Restaurants</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="50" data-purecounter-suffix="k+">0</span></div>
                                <div class="lbl">Orders / day</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="30" data-purecounter-suffix="+">0</span></div>
                                <div class="lbl">Cities</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="99.9" data-purecounter-decimals="1"
                                        data-purecounter-suffix="%">0</span></div>
                                <div class="lbl">Uptime</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- features band -->
    <section class="pb-100 hy-section-soft">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="tp-section-subtitle mb-3"><span class="borders"></span> Built different</span>
                    <h2 class="tp-section-title-clash-600 fs-60">Designed for the way you work</h2>
                </div>
            </div>
            <div class="row g-4">
                @php
                    $features = [
                        ['icon' => 'fa-network-wired', 'title' => 'Multi-branch', 'text' => 'Run several branches from one dashboard with shared menu and stock.'],
                        ['icon' => 'fa-language', 'title' => 'Kinyarwanda ready', 'text' => 'Serve staff and customers in English, French and Kinyarwanda.'],
                        ['icon' => 'fa-wifi', 'title' => 'Offline mode', 'text' => 'Keep selling when the internet drops — sync automatically when back.'],
                        ['icon' => 'fa-mobile-screen-button', 'title' => 'Any device', 'text' => 'Works on tablets, phones and desktop with a clean, fast interface.'],
                    ];
                @endphp
                @foreach ($features as $f)
                    <div class="col-lg-3 col-md-6">
                        <div class="tp-feature-md-item d-flex flex-column h-100">
                            <div class="tp-feature-md-icon" style="color:var(--tp-theme-secondary)">
                                <i class="fa-solid {{ $f['icon'] }}" style="font-size:40px;"></i>
                            </div>
                            <h4 style="font-family:var(--tp-ff-heading);font-size:22px;text-transform:uppercase;">
                                {{ $f['title'] }}</h4>
                            <p style="color:var(--tp-grey-1);">{{ $f['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- testimonials -->
    <section class="pb-100">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="tp-section-subtitle mb-3"><span class="borders"></span> Loved by owners</span>
                    <h2 class="tp-section-title-clash-600 fs-60">What restaurateurs say</h2>
                </div>
            </div>
            <div class="swiper tp-testimonial-ai-slide-active">
                <div class="swiper-wrapper">
                    @php
                        $testimonials = [
                            ['name' => 'Jean Claude', 'role' => 'Owner, Kigali Bites', 'text' => 'Since we switched to Hyamii, our kitchen runs 30% faster and the RRA receipts are effortless.', 'img' => 'testimonial-item-1.png'],
                            ['name' => 'Alice Uwase', 'role' => 'Manager, Nyamirambo', 'text' => 'Inventory alerts alone paid for the software. I finally know my real food cost.', 'img' => 'testimonial-item-2.png'],
                            ['name' => 'Patrick N.', 'role' => 'Group Ops, Rivermark', 'text' => 'Managing three branches from one screen used to be a dream. Now it is just Tuesday.', 'img' => 'testimonial-item-3.png'],
                        ];
                    @endphp
                    @foreach ($testimonials as $t)
                        <div class="swiper-slide">
                            <div class="tp-feature-md-item"
                                style="background:#fff;border:1px solid var(--tp-border-1);">
                                <p style="font-size:20px;line-height:32px;color:var(--tp-common-black);">“{{ $t['text'] }}”</p>
                                <div class="d-flex align-items-center gap-3 mt-4">
                                    <img src="{{ asset('vendor/custom-home/images/' . $t['img']) }}" width="56"
                                        height="56" style="border-radius:50%;object-fit:cover;" alt="">
                                    <div>
                                        <h5 style="margin:0;font-family:var(--tp-ff-heading);">{{ $t['name'] }}</h5>
                                        <span style="color:var(--tp-grey-2);font-size:14px;">{{ $t['role'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- faq -->
    <section id="faq" class="pb-100">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="tp-section-subtitle mb-3"><span class="borders"></span>
                        {{ $lh['faq']['subtitle'] ?? 'FAQ' }}</span>
                    <h2 class="tp-section-title-clash-600 fs-60">
                        {{ $lh['faq']['title'] ?? 'Questions, answered' }}</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="tp-faq-wrap accordion" id="hyFaq">
                        @foreach (($lh['faq']['items'] ?? []) as $i => $f)
                            <div class="accordion-item"
                                style="border:1px solid var(--tp-border-1);margin-bottom:12px;border-radius:10px;overflow:hidden;">
                                <h2 class="accordion-header">
                                    <button class="tp-faq-btn accordion-button {{ $i > 0 ? 'collapsed' : '' }}"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq{{ $i }}">
                                        {{ $f['question'] ?? '' }}
                                    </button>
                                </h2>
                                <div id="faq{{ $i }}"
                                    class="accordion-collapse collapse {{ $i == 0 ? 'show' : '' }}"
                                    data-bs-parent="#hyFaq">
                                    <div class="accordion-body" style="color:var(--tp-grey-1);">
                                        {{ $f['answer'] ?? '' }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- cta -->
    <section class="pb-100">
        <div class="container">
            <div class="tp-cta-ai-bg position-relative overflow-hidden">
                <img class="hy-shape" style="top:0;left:0;width:30%;opacity:.15"
                    src="{{ asset('vendor/custom-home/images/cta-shape-2.png') }}" alt="">
                <img class="hy-shape" style="bottom:0;right:0;width:30%;opacity:.15"
                    src="{{ asset('vendor/custom-home/images/cta-shape-3.png') }}" alt="">
                <div class="position-relative" style="z-index:2;padding:90px 30px;">
                    <h2 class="tp-section-title-clash-600 fs-60">
                        {{ $lh['cta']['title'] ?? 'Ready to modernize your restaurant?' }}</h2>
                    <p class="mt-3 mb-4"
                        style="font-size:18px;color:rgba(255,255,255,.8);max-width:560px;margin-inline:auto;">
                        {{ $lh['cta']['text'] ?? 'Join hundreds of Rwandan restaurants already running smoother with Hyamii.' }}
                    </p>
                    <a href="{{ url('/login') }}" class="hy-btn hy-btn-secondary"
                        style="border-color:#fff;color:#fff;background:transparent;">Get started free <i
                            class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer id="contact" class="pt-80 pb-30" style="background:#0d2b27;color:#fff;">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <a href="#" class="hy-logo" style="color:#fff;">Hyamii</a>
                    <p class="mt-3" style="color:rgba(255,255,255,.6);max-width:320px;">
                        {{ $lh['footer']['text'] ?? 'The all-in-one restaurant management platform built for Rwanda — POS, kitchen, online ordering, inventory and RRA EBM.' }}
                    </p>
                    <div class="tp-footer-social mt-4">
                        <ul class="list-unstyled d-flex flex-wrap gap-2 p-0 m-0">
                            <li><a href="#" style="background:rgba(255,255,255,.08);color:#fff;"><i
                                        class="fa-brands fa-facebook-f"></i> Facebook</a></li>
                            <li><a href="#" style="background:rgba(255,255,255,.08);color:#fff;"><i
                                        class="fa-brands fa-instagram"></i> Instagram</a></li>
                            <li><a href="#" style="background:rgba(255,255,255,.08);color:#fff;"><i
                                        class="fa-brands fa-linkedin-in"></i> LinkedIn</a></li>
                            <li><a href="#" style="background:rgba(255,255,255,.08);color:#fff;"><i
                                        class="fa-brands fa-x-twitter"></i> X</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 style="font-family:var(--tp-ff-heading);text-transform:uppercase;">Product</h5>
                    <ul class="list-unstyled mt-3" style="line-height:2.2;color:rgba(255,255,255,.7);">
                        <li><a href="#features" style="color:inherit;">Features</a></li>
                        <li><a href="#about" style="color:inherit;">About</a></li>
                        <li><a href="#faq" style="color:inherit;">FAQ</a></li>
                        <li><a href="{{ url('/login') }}" style="color:inherit;">Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h5 style="font-family:var(--tp-ff-heading);text-transform:uppercase;">Contact</h5>
                    <ul class="list-unstyled mt-3" style="line-height:2.2;color:rgba(255,255,255,.7);">
                        <li><i class="fa-solid fa-envelope me-2"></i>
                            {{ $lh['contact']['email'] ?? 'hello@hyamii.rw' }}</li>
                        <li><i class="fa-solid fa-phone me-2"></i>
                            {{ $lh['contact']['phone'] ?? '+250 788 000 000' }}</li>
                        <li><i class="fa-solid fa-location-dot me-2"></i>
                            {{ $lh['contact']['address'] ?? 'Kigali, Rwanda' }}</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-12">
                    <h5 style="font-family:var(--tp-ff-heading);text-transform:uppercase;">Newsletter</h5>
                    <p style="color:rgba(255,255,255,.6);">Get product updates in Kinyarwanda & English.</p>
                    <div class="tp-footer-widget-form position-relative mt-2">
                        <input type="email" class="tp-input" placeholder="Your email"
                            style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:10px;height:54px;width:100%;color:#fff;padding:5px 70px 5px 20px;">
                        <button class="tp-button btn border-0"
                            style="background:var(--tp-theme-secondary);color:#fff;width:46px;height:46px;border-radius:8px;right:6px;top:50%;transform:translateY(-50%);position:absolute;"><i
                                class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="tp-footer-bottom mt-5"
                style="border-top:1px solid rgba(255,255,255,.1);padding-top:22px;color:rgba(255,255,255,.6);">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <p class="mb-0">© {{ date('Y') }} Hyamii. All rights reserved.</p>
                    <div class="tp-footer-menu">
                        <ul class="list-unstyled d-flex gap-4 mb-0"
                            style="color:rgba(255,255,255,.7);text-transform:uppercase;font-size:14px;font-family:var(--tp-ff-heading);">
                            <li><a href="#" style="color:inherit;">Privacy</a></li>
                            <li><a href="#" style="color:inherit;">Terms</a></li>
                            <li><a href="#" style="color:inherit;">Cookies</a></li>
                        </ul>
                    </div>
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
    <script src="{{ asset('vendor/custom-home/js/slider-init.js') }}"></script>
    <script src="{{ asset('vendor/custom-home/js/tp-cursor.js') }}"></script>
</body>

</html>
