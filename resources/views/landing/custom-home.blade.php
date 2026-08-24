<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lh['hero']['title'] ?? 'Hyamii' }}</title>
    <meta name="description" content="{{ $lh['hero']['paragraph'] ?? '' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom-home/css/main.css') }}">

    <style>
        :root {
            --skin-base: #002522;
            --skin-secondary: #a33b38;
        }

        body {
            font-family: 'Manrope', sans-serif;
            color: #4a5c59;
            background: #fff;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Hanken Grotesk', sans-serif;
            color: var(--skin-base);
            font-weight: 700;
            line-height: 1.12;
            letter-spacing: -0.02em;
        }

        .hy-section {
            padding: 90px 0;
        }

        .hy-eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--skin-secondary);
            background: rgba(163, 59, 56, 0.08);
            padding: 6px 16px;
            border-radius: 999px;
            margin-bottom: 18px;
        }

        .hy-title {
            font-size: clamp(30px, 4vw, 48px);
            margin-bottom: 18px;
        }

        .hy-lead {
            font-size: 17px;
            line-height: 1.7;
            color: #4a5c59;
            max-width: 620px;
        }

        .hy-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 28px;
            border-radius: 10px;
            text-decoration: none;
            transition: all .25s ease;
        }

        .hy-btn-primary {
            background: var(--skin-base);
            color: #fff;
        }

        .hy-btn-primary:hover {
            background: var(--skin-secondary);
            color: #fff;
            transform: translateY(-2px);
        }

        .hy-btn-outline {
            background: transparent;
            color: var(--skin-base);
            border: 1.5px solid rgba(0, 37, 34, 0.18);
        }

        .hy-btn-outline:hover {
            border-color: var(--skin-base);
            color: var(--skin-base);
            transform: translateY(-2px);
        }

        .hy-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #eee;
        }

        .hy-logo {
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: var(--skin-base);
            text-decoration: none;
            letter-spacing: -0.03em;
        }

        .hy-logo span {
            color: var(--skin-secondary);
        }

        .hy-hero {
            background:
                radial-gradient(1200px 500px at 85% -10%, rgba(163, 59, 56, 0.08), transparent 60%),
                radial-gradient(900px 500px at 0% 10%, rgba(0, 37, 34, 0.06), transparent 55%);
            padding: 70px 0 90px;
        }

        .hy-hero-img {
            border-radius: 24px;
            box-shadow: 0 40px 80px -30px rgba(0, 37, 34, 0.35);
        }

        .hy-stat {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 16px;
            padding: 18px 22px;
            box-shadow: 0 20px 40px -28px rgba(0, 37, 34, 0.3);
        }

        .hy-stat .val {
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 800;
            font-size: 28px;
            color: var(--skin-base);
        }

        .hy-stat .lab {
            font-size: 13px;
            color: #4a5c59;
        }

        .hy-brand {
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
            background: #fafafa;
        }

        .hy-brand img {
            height: 34px;
            width: auto;
            opacity: 0.65;
            filter: grayscale(1);
            transition: all .25s ease;
        }

        .hy-brand img:hover {
            opacity: 1;
            filter: grayscale(0);
        }

        .hy-about-img {
            border-radius: 24px;
            box-shadow: 0 40px 80px -30px rgba(0, 37, 34, 0.3);
        }

        .hy-fact {
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 800;
            font-size: 56px;
            color: var(--skin-secondary);
            line-height: 1;
        }

        .hy-feature {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .hy-feature .ic {
            flex: none;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(0, 37, 34, 0.08);
            color: var(--skin-base);
            display: grid;
            place-items: center;
            font-size: 18px;
        }

        .hy-feature h5 {
            font-size: 17px;
            margin-bottom: 4px;
        }

        .hy-feature p {
            margin: 0;
            font-size: 15px;
        }

        .hy-service-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 20px;
            padding: 32px 28px;
            height: 100%;
            transition: all .25s ease;
        }

        .hy-service-card:hover {
            border-color: rgba(0, 37, 34, 0.2);
            transform: translateY(-6px);
            box-shadow: 0 30px 60px -34px rgba(0, 37, 34, 0.3);
        }

        .hy-service-ic {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            background: var(--skin-base);
            color: #fff;
            display: grid;
            place-items: center;
            font-size: 26px;
            margin-bottom: 20px;
        }

        .hy-service-ic img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .hy-faq-img {
            border-radius: 24px;
            box-shadow: 0 40px 80px -30px rgba(0, 37, 34, 0.3);
        }

        .accordion-item {
            border: 1px solid #eee;
            border-radius: 14px !important;
            margin-bottom: 14px;
            overflow: hidden;
        }

        .accordion-button {
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 700;
            font-size: 17px;
            color: var(--skin-base);
            background: #fff;
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            background: #fff;
            color: var(--skin-secondary);
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .hy-cta {
            background: var(--skin-base);
            border-radius: 28px;
            color: #fff;
            padding: 70px 40px;
            text-align: center;
        }

        .hy-cta h2, .hy-cta .hy-eyebrow {
            color: #fff;
        }

        .hy-cta .hy-eyebrow {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
        }

        .hy-cta .hy-lead {
            color: rgba(255, 255, 255, 0.8);
            margin: 0 auto;
        }

        .hy-cta .hy-btn-primary {
            background: #fff;
            color: var(--skin-base);
        }

        .hy-cta .hy-btn-primary:hover {
            background: var(--skin-secondary);
            color: #fff;
        }

        .hy-contact-card {
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 28px;
            height: 100%;
            text-align: center;
        }

        .hy-contact-card .ic {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: rgba(163, 59, 56, 0.1);
            color: var(--skin-secondary);
            display: grid;
            place-items: center;
            font-size: 22px;
            margin: 0 auto 16px;
        }

        .hy-footer {
            background: #041c1a;
            color: rgba(255, 255, 255, 0.7);
            padding: 60px 0 30px;
        }

        .hy-footer h4, .hy-footer .hy-logo {
            color: #fff;
        }

        .hy-footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
        }

        .hy-footer a:hover {
            color: #fff;
        }

        .hy-footer .finfo i {
            color: var(--skin-secondary);
            width: 22px;
        }

        @media (max-width: 767.98px) {
            .hy-section { padding: 60px 0; }
            .hy-hero { padding: 40px 0 60px; }
        }
    </style>
</head>

<body>
@php
    $lh = landing_home_setting();
    $brandImgs = ['brand-1.png', 'brand-3.png', 'brand-4.png', 'brand-5.png', 'brand-6.png', 'brand-1.png'];
    $serviceIcons = ['fa-cash-register', 'fa-kitchen-set', 'fa-utensils', 'fa-chair', 'fa-chart-line', 'fa-heart'];
@endphp

    <!-- Header -->
    <header class="hy-header">
        <div class="container">
            <nav class="d-flex align-items-center justify-content-between py-3">
                <a href="{{ route('home') }}" class="hy-logo">Hya<span>mii</span></a>
                <a href="{{ route('restaurant_signup') }}" class="hy-btn hy-btn-primary">Get Started</a>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="hy-hero" id="home">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    @if(!empty($lh['hero']['subtitle']))
                        <span class="hy-eyebrow">{{ $lh['hero']['subtitle'] }}</span>
                    @endif
                    <h1 class="hy-title">{{ $lh['hero']['title'] }}</h1>
                    <p class="hy-lead mb-4">{{ $lh['hero']['paragraph'] }}</p>
                    <div class="d-flex flex-wrap gap-3 mb-5">
                        @if(!empty($lh['hero']['primary_btn']))
                            <a href="{{ route('restaurant_signup') }}" class="hy-btn hy-btn-primary">{{ $lh['hero']['primary_btn'] }} <i class="fa-light fa-arrow-right"></i></a>
                        @endif
                        @if(!empty($lh['hero']['secondary_btn']))
                            <a href="#services" class="hy-btn hy-btn-outline">{{ $lh['hero']['secondary_btn'] }}</a>
                        @endif
                    </div>
                    <div class="row g-3">
                        <div class="col-6 col-sm-5">
                            <div class="hy-stat">
                                <div class="val">{{ $lh['hero']['card1_value'] ?? '' }}</div>
                                <div class="lab">{{ $lh['hero']['card1_label'] ?? '' }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-5">
                            <div class="hy-stat">
                                <div class="val">{{ $lh['hero']['card2_value'] ?? '' }}</div>
                                <div class="lab">{{ $lh['hero']['card2_label'] ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ landing_home_image($lh['hero']['image'] ?? null, 'thumb-main.png') }}" alt="Hyamii" class="img-fluid hy-hero-img w-100">
                </div>
            </div>
        </div>
    </section>

    <!-- Brand -->
    <section class="hy-brand py-5">
        <div class="container">
            @if(!empty($lh['brand']['title']))
                <p class="text-center mb-4" style="color:#4a5c59;font-weight:600;font-size:14px;letter-spacing:.04em;">{{ $lh['brand']['title'] }}</p>
            @endif
            <div class="row align-items-center justify-content-center g-4">
                @foreach($lh['brand']['logos'] as $i => $logo)
                    <div class="col-4 col-sm-2 text-center">
                        <img src="{{ landing_home_image($logo, $brandImgs[$i % count($brandImgs)]) }}" alt="Partner">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="hy-section" id="about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="{{ landing_home_image($lh['about']['image'] ?? null, 'thumb-1.png') }}" alt="About Hyamii" class="img-fluid hy-about-img w-100">
                </div>
                <div class="col-lg-6">
                    @if(!empty($lh['about']['subtitle']))
                        <span class="hy-eyebrow">{{ $lh['about']['subtitle'] }}</span>
                    @endif
                    <h2 class="hy-title">{{ $lh['about']['title'] }}</h2>
                    @if(!empty($lh['about']['paragraph1']))
                        <p class="hy-lead">{{ $lh['about']['paragraph1'] }}</p>
                    @endif
                    @if(!empty($lh['about']['paragraph2']))
                        <p class="hy-lead">{{ $lh['about']['paragraph2'] }}</p>
                    @endif

                    <div class="d-flex align-items-center gap-3 my-4">
                        <div class="hy-fact">{{ $lh['about']['fact_value'] ?? '' }}</div>
                        <div style="font-weight:600;color:var(--skin-base);">{{ $lh['about']['fact_label'] ?? '' }}</div>
                    </div>

                    @if(!empty($lh['about']['feature1_title']))
                        <div class="hy-feature">
                            <div class="ic"><i class="fa-light fa-circle-check"></i></div>
                            <div>
                                <h5>{{ $lh['about']['feature1_title'] }}</h5>
                                <p>{{ $lh['about']['feature1_text'] }}</p>
                            </div>
                        </div>
                    @endif
                    @if(!empty($lh['about']['feature2_title']))
                        <div class="hy-feature">
                            <div class="ic"><i class="fa-light fa-circle-check"></i></div>
                            <div>
                                <h5>{{ $lh['about']['feature2_title'] }}</h5>
                                <p>{{ $lh['about']['feature2_text'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="hy-section" id="services" style="background:#fafafa;">
        <div class="container">
            <div class="text-center mb-5">
                @if(!empty($lh['services']['subtitle']))
                    <span class="hy-eyebrow">{{ $lh['services']['subtitle'] }}</span>
                @endif
                <h2 class="hy-title">{{ $lh['services']['title'] }}</h2>
            </div>
            <div class="row g-4">
                @foreach($lh['services']['items'] as $i => $s)
                    <div class="col-md-6 col-lg-4">
                        <div class="hy-service-card">
                            <div class="hy-service-ic">
                                @if(!empty($s['icon']))
                                    <img src="{{ landing_home_image($s['icon'], 'thumb-2.png') }}" alt="">
                                @else
                                    <i class="fa-light {{ $serviceIcons[$i % count($serviceIcons)] }}"></i>
                                @endif
                            </div>
                            <h4 style="font-size:20px;margin-bottom:10px;">{{ $s['title'] }}</h4>
                            <p style="margin:0;font-size:15px;">{{ $s['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="hy-section" id="faq">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <img src="{{ landing_home_image($lh['faq']['image'] ?? null, 'portfolio-thumb.png') }}" alt="FAQ" class="img-fluid hy-faq-img w-100">
                </div>
                <div class="col-lg-7">
                    @if(!empty($lh['faq']['subtitle']))
                        <span class="hy-eyebrow">{{ $lh['faq']['subtitle'] }}</span>
                    @endif
                    <h2 class="hy-title mb-4">{{ $lh['faq']['title'] }}</h2>
                    <div class="accordion" id="hyFaq">
                        @foreach($lh['faq']['items'] as $i => $f)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="hyFaqH{{ $i }}">
                                    <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#hyFaqC{{ $i }}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="hyFaqC{{ $i }}">
                                        {{ $f['question'] }}
                                    </button>
                                </h2>
                                <div id="hyFaqC{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" aria-labelledby="hyFaqH{{ $i }}" data-bs-parent="#hyFaq">
                                    <div class="accordion-body" style="color:#4a5c59;">{{ $f['answer'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="hy-section">
        <div class="container">
            <div class="hy-cta">
                @if(!empty($lh['cta']['subtitle']))
                    <span class="hy-eyebrow">{{ $lh['cta']['subtitle'] }}</span>
                @endif
                <h2 class="hy-title">{{ $lh['cta']['title'] }}</h2>
                @if(!empty($lh['cta']['text']))
                    <p class="hy-lead mb-4">{{ $lh['cta']['text'] }}</p>
                @endif
                @if(!empty($lh['cta']['button']))
                    <a href="{{ route('restaurant_signup') }}" class="hy-btn hy-btn-primary">{{ $lh['cta']['button'] }} <i class="fa-light fa-arrow-right"></i></a>
                @endif
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="hy-section" id="contact" style="background:#fafafa;">
        <div class="container">
            <div class="text-center mb-5">
                @if(!empty($lh['contact']['subtitle']))
                    <span class="hy-eyebrow">{{ $lh['contact']['subtitle'] }}</span>
                @endif
                <h2 class="hy-title">{{ $lh['contact']['title'] }}</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <div class="hy-contact-card">
                        <div class="ic"><i class="fa-light fa-envelope"></i></div>
                        <h5 style="font-size:16px;">Email</h5>
                        <a href="mailto:{{ $lh['contact']['email'] ?? '' }}" style="color:#4a5c59;">{{ $lh['contact']['email'] ?? '' }}</a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="hy-contact-card">
                        <div class="ic"><i class="fa-light fa-phone"></i></div>
                        <h5 style="font-size:16px;">Phone</h5>
                        <a href="tel:{{ $lh['contact']['phone'] ?? '' }}" style="color:#4a5c59;">{{ $lh['contact']['phone'] ?? '' }}</a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="hy-contact-card">
                        <div class="ic"><i class="fa-light fa-location-dot"></i></div>
                        <h5 style="font-size:16px;">Location</h5>
                        <span style="color:#4a5c59;">{{ $lh['contact']['address'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="hy-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    @if(!empty($lh['footer']['logo']))
                        <img src="{{ landing_home_image($lh['footer']['logo'], 'logo.png') }}" alt="Hyamii" style="height:36px;margin-bottom:16px;">
                    @else
                        <a href="{{ route('home') }}" class="hy-logo" style="display:inline-block;margin-bottom:16px;">Hya<span>mii</span></a>
                    @endif
                    <p style="max-width:420px;color:rgba(255,255,255,0.7);">{{ $lh['footer']['text'] ?? '' }}</p>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <h4 class="mb-3" style="font-size:18px;">Contact</h4>
                    <div class="finfo">
                        <p class="mb-2"><i class="fa-light fa-location-dot"></i> {{ $lh['footer']['location'] ?? '' }}</p>
                        <p class="mb-2"><i class="fa-light fa-envelope"></i> <a href="mailto:{{ $lh['footer']['email'] ?? '' }}">{{ $lh['footer']['email'] ?? '' }}</a></p>
                        <p class="mb-0"><i class="fa-light fa-phone"></i> <a href="tel:{{ $lh['footer']['phone'] ?? '' }}">{{ $lh['footer']['phone'] ?? '' }}</a></p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <h4 class="mb-3" style="font-size:18px;">Get Started</h4>
                    <p class="mb-2"><a href="{{ route('restaurant_signup') }}">Start free trial</a></p>
                    <p class="mb-2"><a href="{{ route('login') }}">Sign in</a></p>
                    <p class="mb-0"><a href="#services">Features</a></p>
                </div>
            </div>
            <hr style="border-color:rgba(255,255,255,0.12);margin:36px 0 20px;">
            <p class="text-center mb-0" style="font-size:14px;color:rgba(255,255,255,0.55);">© {{ date('Y') }} Hyamii. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('vendor/custom-home/js/bootstrap-bundle.js') }}"></script>
</body>

</html>
