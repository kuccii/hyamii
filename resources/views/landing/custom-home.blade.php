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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Hanken+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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

        .hy-section {
            padding: clamp(64px, 9vw, 120px) 0;
        }

        .hy-display {
            font-weight: 800;
            font-size: clamp(38px, 5.2vw, 72px);
            line-height: 1.05;
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
        }

        .hy-btn i { font-size: 14px; }

        .hy-btn-primary {
            background: var(--hy-teal);
            color: #fff;
        }

        .hy-btn-primary:hover {
            background: var(--hy-amaranth);
            color: #fff;
        }

        .hy-btn-ghost {
            background: #fff;
            color: var(--hy-ink);
            border: 1px solid var(--hy-line);
        }

        .hy-btn-ghost:hover {
            border-color: var(--hy-teal);
            color: var(--hy-teal);
        }

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
            width: 8px;
            height: 8px;
            border-radius: 50%;
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

        .hy-nav a:hover { color: var(--hy-amaranth); }

        /* media */
        .hy-media {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 37, 34, .14);
            background: var(--hy-soft);
        }

        .hy-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

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
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 37, 34, .07);
            color: var(--hy-teal);
            font-size: 22px;
            margin-bottom: 18px;
        }

        .hy-card:hover .hy-icon {
            background: var(--hy-teal);
            color: #fff;
        }

        .hy-card h3 {
            font-size: 21px;
            font-weight: 700;
            margin-bottom: 10px;
        }

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

        /* testimonial */
        .hy-quote {
            background: #fff;
            border: 1px solid var(--hy-line);
            border-radius: 18px;
            padding: 32px;
            height: 100%;
        }

        .hy-quote p {
            font-size: 18px;
            line-height: 1.6;
            color: var(--hy-ink);
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

        .hy-cta .hy-btn-ghost {
            background: transparent;
            color: #fff;
            border-color: rgba(255, 255, 255, .4);
        }

        .hy-cta .hy-btn-ghost:hover {
            background: #fff;
            color: var(--hy-teal);
            border-color: #fff;
        }

        /* footer */
        .hy-footer {
            background: var(--hy-ink);
            color: rgba(255, 255, 255, .75);
        }

        .hy-footer a { color: rgba(255, 255, 255, .75); }
        .hy-footer a:hover { color: #fff; }

        .hy-footer h5 {
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: .04em;
            margin-bottom: 16px;
        }

        .hy-social a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .08);
            padding: 8px 16px;
            border-radius: 100px;
            margin: 0 8px 8px 0;
            font-size: 14px;
            font-weight: 600;
        }

        .hy-news {
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 10px;
            height: 52px;
            width: 100%;
            color: #fff;
            padding: 5px 60px 5px 18px;
        }

        .hy-news::placeholder { color: rgba(255, 255, 255, .5); }

        .hy-news-btn {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            border-radius: 8px;
            border: 0;
            background: var(--hy-amaranth);
            color: #fff;
        }

        /* swiper polish */
        .swiper { overflow: hidden; }
        .brand-slide img { height: 38px; opacity: .6; filter: grayscale(1); }

        /* loader (Hyamii themed) */
        .loader-wrap {
            background: var(--hy-teal);
        }

        .loader-wrap .loader-wrap-heading {
            position: relative;
            z-index: 20;
            text-align: center;
        }

        .loader-wrap .load-text {
            color: #fff !important;
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 800;
            letter-spacing: -0.02em;
            font-size: clamp(34px, 6vw, 62px);
        }

        /* hide custom cursor on touch / small screens */
        @media (max-width: 991.98px) {
            #magic-cursor { display: none !important; }
            .hy-nav { display: none !important; }
        }
    </style>
</head>

<body class="tp-magic-cursor">
    <div class="loader-wrap">
        <div class="loader-wrap-heading">
            <span class="load-text">Hyamii</span>
        </div>
        <svg id="svg" viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <path fill="#002522" d="M0 502S175 272 500 272s500 230 500 230V0H0Z"></path>
        </svg>
    </div>
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
                <nav class="hy-nav d-none d-lg-flex align-items-center">
                    <a href="#features">Features</a>
                    <a href="#about">About</a>
                    <a href="#faq">FAQ</a>
                    <a href="#contact">Contact</a>
                </nav>
                <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary">Get Started <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </header>

    <!-- hero -->
    <section class="hy-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="hy-pill mb-3"><span class="dot"></span>
                        {{ $lh['hero']['subtitle'] ?? 'Restaurant software built for Rwanda' }}</span>
                    <h1 class="hy-display mb-3">{{ $lh['hero']['title'] ?? 'Run your restaurant on autopilot' }}</h1>
                    <p class="hy-lead mb-4">{{ $lh['hero']['paragraph'] ?? 'Hyamii brings POS, kitchen display, online ordering, inventory and RRA EBM compliance into one fast, beautiful platform.' }}</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary">Start free <i
                                class="fa-solid fa-arrow-right"></i></a>
                        <a href="#features" class="hy-btn hy-btn-ghost"><i class="fa-solid fa-play"></i> Watch demo</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hy-media" style="aspect-ratio: 4 / 3;">
                        <img src="{{ $img($lh['hero']['image'] ?? null, 'thumb-main.png') }}" alt="Hyamii dashboard">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- brand slider -->
    <section class="pb-5">
        <div class="container">
            <p class="text-center mb-4"
                style="font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:var(--hy-muted);font-size:13px;">
                {{ $lh['brand']['title'] ?? 'Trusted by restaurants across Rwanda' }}</p>
            <div class="swiper tp-brand-slide-active">
                <div class="swiper-wrapper align-items-center">
                    @foreach (['brand-1.png', 'brand-3.png', 'brand-4.png', 'brand-5.png', 'brand-6.png', 'brand-1.png', 'brand-3.png', 'brand-4.png'] as $b)
                        <div class="swiper-slide text-center brand-slide">
                            <img src="{{ asset('vendor/custom-home/images/' . $b) }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- services -->
    <section id="features" class="hy-section" style="background:var(--hy-soft);">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="hy-pill mb-3"><span class="dot"></span>
                        {{ $lh['services']['subtitle'] ?? 'All-in-one platform' }}</span>
                    <h2 class="hy-h2">{{ $lh['services']['title'] ?? 'Everything your restaurant needs' }}</h2>
                </div>
            </div>
            <div class="row g-4">
                @foreach (($lh['services']['items'] ?? []) as $i => $s)
                    <div class="col-lg-4 col-md-6">
                        <div class="hy-card">
                            <div class="hy-icon"><i class="fa-solid {{ $serviceIcons[$i % count($serviceIcons)] }}"></i></div>
                            <h3>{{ $s['title'] ?? '' }}</h3>
                            <p>{{ $s['text'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- about + stats -->
    <section id="about" class="hy-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hy-media" style="aspect-ratio: 1 / 1;">
                        <img src="{{ $img($lh['about']['image'] ?? null, 'thumb-2.jpg') }}" alt="About Hyamii">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="hy-pill mb-3"><span class="dot"></span>
                        {{ $lh['about']['subtitle'] ?? 'Why Hyamii' }}</span>
                    <h2 class="hy-h2 mb-3">{{ $lh['about']['title'] ?? 'Made for Rwandan restaurants' }}</h2>
                    <p class="hy-lead mb-2">{{ $lh['about']['paragraph1'] ?? '' }}</p>
                    <p class="hy-lead">{{ $lh['about']['paragraph2'] ?? '' }}</p>
                    <div class="row g-4 mt-3">
                        <div class="col-6 col-sm-3">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="500" data-purecounter-suffix="+">0</span></div>
                                <div class="lbl">Restaurants</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="50" data-cursor="" data-purecounter-suffix="k+">0</span></div>
                                <div class="lbl">Orders / day</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="30" data-purecounter-suffix="+">0</span></div>
                                <div class="lbl">Cities</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
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
    <section class="hy-section" style="background:var(--hy-soft);">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="hy-pill mb-3"><span class="dot"></span> Built different</span>
                    <h2 class="hy-h2">Designed for the way you work</h2>
                </div>
            </div>
            <div class="row g-4">
                @php
                    $features = [
                        ['icon' => 'fa-network-wired', 'title' => 'Multi-branch', 'text' => 'Run several branches from one dashboard with shared menu and stock.'],
                        ['icon' => 'fa-wifi', 'title' => 'Offline mode', 'text' => 'Keep selling when the internet drops — sync automatically when back.'],
                        ['icon' => 'fa-mobile-screen-button', 'title' => 'Any device', 'text' => 'Works on tablets, phones and desktop with a clean, fast interface.'],
                    ];
                @endphp
                @foreach ($features as $f)
                    <div class="col-lg-4 col-md-6">
                        <div class="hy-card">
                            <div class="hy-icon"><i class="fa-solid {{ $f['icon'] }}"></i></div>
                            <h3>{{ $f['title'] }}</h3>
                            <p>{{ $f['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- testimonials -->
    <section class="hy-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="hy-pill mb-3"><span class="dot"></span> Loved by owners</span>
                    <h2 class="hy-h2">What restaurateurs say</h2>
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
                        <div class="swiper-slide h-auto">
                            <div class="hy-quote d-flex flex-column">
                                <p class="flex-grow-1">“{{ $t['text'] }}”</p>
                                <div class="d-flex align-items-center gap-3 mt-3">
                                    <img src="{{ asset('vendor/custom-home/images/' . $t['img']) }}" width="52"
                                        height="52" style="border-radius:50%;object-fit:cover;" alt="">
                                    <div>
                                        <h5 style="margin:0;">{{ $t['name'] }}</h5>
                                        <span style="color:var(--hy-muted);font-size:14px;">{{ $t['role'] }}</span>
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
    <section id="faq" class="hy-section" style="background:var(--hy-soft);">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="hy-pill mb-3"><span class="dot"></span>
                        {{ $lh['faq']['subtitle'] ?? 'FAQ' }}</span>
                    <h2 class="hy-h2">{{ $lh['faq']['title'] ?? 'Questions, answered' }}</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="tp-faq-wrap accordion" id="hyFaq">
                        @foreach (($lh['faq']['items'] ?? []) as $i => $f)
                            <div class="accordion-item mb-3 border-0"
                                style="border-radius:14px;overflow:hidden;background:#fff;border:1px solid var(--hy-line) !important;">
                                <h2 class="accordion-header">
                                    <button class="tp-faq-btn accordion-button {{ $i > 0 ? 'collapsed' : '' }}"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq{{ $i }}" style="padding:18px 22px;font-weight:700;">
                                        {{ $f['question'] ?? '' }}
                                    </button>
                                </h2>
                                <div id="faq{{ $i }}"
                                    class="accordion-collapse collapse {{ $i == 0 ? 'show' : '' }}"
                                    data-bs-parent="#hyFaq">
                                    <div class="accordion-body" style="color:var(--hy-muted);">
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
    <section class="hy-section">
        <div class="container">
            <div class="hy-cta">
                <h2 class="hy-h2 mb-3">{{ $lh['cta']['title'] ?? 'Ready to modernize your restaurant?' }}</h2>
                <p class="hy-lead mb-4 mx-auto" style="color:rgba(255,255,255,.8);max-width:560px;">
                    {{ $lh['cta']['text'] ?? 'Join hundreds of Rwandan restaurants already running smoother with Hyamii.' }}
                </p>
                <a href="{{ url('/login') }}" class="hy-btn hy-btn-ghost">Get started free <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer id="contact" class="hy-footer pt-5 pb-4">
        <div class="container py-4">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="hy-logo text-white">Hyamii</div>
                    <p class="mt-3" style="max-width:320px;">
                        {{ $lh['footer']['text'] ?? 'The all-in-one restaurant management platform built for Rwanda — POS, kitchen, online ordering, inventory and RRA EBM.' }}
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
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h5>Contact</h5>
                    <ul class="list-unstyled" style="line-height:2.2;">
                        <li><i class="fa-solid fa-envelope me-2"></i>
                            {{ $lh['contact']['email'] ?? 'hello@hyamii.rw' }}</li>
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
                    <a href="#">Privacy</a><a href="#">Terms</a><a href="#">Cookies</a>
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
