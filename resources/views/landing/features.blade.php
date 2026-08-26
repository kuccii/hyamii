@extends('landing.layout')
@section('title', 'Features — Hyamii')

@section('content')
    @php
        $serviceIcons = ['fa-utensils', 'fa-kitchen-set', 'fa-cart-shopping', 'fa-chair', 'fa-chart-line', 'fa-heart'];
    @endphp

    <!-- page hero -->
    <section class="hy-page-hero hy-section">
        <div class="container text-center">
            <span class="hy-pill mb-3"><span class="dot"></span> Features</span>
            <h1 class="hy-h1 mb-3">Everything your restaurant runs on</h1>
            <p class="hy-lead mx-auto" style="max-width:620px;">
                One platform for orders, kitchen, inventory, customers and compliance — designed to feel effortless from day one.
            </p>
        </div>
    </section>

    <!-- services -->
    <section class="hy-section">
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
                        ['icon' => 'fa-language', 'title' => 'Localized', 'text' => 'Serve staff and customers in the languages your market actually uses.'],
                        ['icon' => 'fa-receipt', 'title' => 'Compliant receipts', 'text' => 'Tax-ready, audit-friendly receipts generated automatically.'],
                        ['icon' => 'fa-shield-halved', 'title' => 'Secure by default', 'text' => 'Role-based access, encrypted data and regular backups included.'],
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

    <!-- contactless table ordering -->
    <section class="hy-section" style="background:var(--hy-soft);">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-lg-2">
                    <div class="hy-media hy-shot" style="aspect-ratio: 16 / 11;">
                        <img src="{{ asset('vendor/custom-home/images/ch03-qr.png') }}" alt="Guests scan a QR code to order from the table" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <span class="hy-pill mb-3"><span class="dot"></span> Contactless ordering</span>
                    <h2 class="hy-h2 mb-3">Contactless Table Ordering System</h2>
                    <p class="hy-lead mb-4">Turn every table into a self-order station. Guests scan a QR code, browse the live menu, and send orders and payments straight from their phone — no app, no waiting, no shared menus.</p>
                    <ul class="list-unstyled mb-4" style="line-height:2.2;">
                        <li><i class="fa-solid fa-check" style="color:var(--hy-amaranth);"></i> One QR code per table opens the digital menu</li>
                        <li><i class="fa-solid fa-check" style="color:var(--hy-amaranth);"></i> Orders hit the kitchen and POS in real time</li>
                        <li><i class="fa-solid fa-check" style="color:var(--hy-amaranth);"></i> Guests pay at the table from their phone</li>
                    </ul>
                    <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary">Get started free <i class="fa-solid fa-arrow-right"></i></a>
                </div>
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
                            ['name' => 'Jean Claude', 'role' => 'Owner, Kigali Bites', 'text' => 'Since we switched to Hyamii, our kitchen runs 30% faster and the receipts are effortless.', 'img' => 'testimonial-item-1.png', 'stars' => 5],
                            ['name' => 'Alice Uwase', 'role' => 'Manager, Nyamirambo', 'text' => 'Inventory alerts alone paid for the software. I finally know my real food cost.', 'img' => 'testimonial-item-2.png', 'stars' => 5],
                            ['name' => 'Patrick N.', 'role' => 'Group Ops, Rivermark', 'text' => 'Managing three branches from one screen used to be a dream. Now it is just Tuesday.', 'img' => 'testimonial-item-3.png', 'stars' => 5],
                        ];
                    @endphp
                    @foreach ($testimonials as $t)
                        <div class="swiper-slide h-auto">
                            <div class="hy-quote d-flex flex-column">
                                <i class="fa-solid fa-quote-left qmark"></i>
                                <div class="t-stars">
                                    @for ($s = 0; $s < ($t['stars'] ?? 5); $s++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </div>
                                <p class="flex-grow-1">“{{ $t['text'] }}”</p>
                                <div class="t-foot">
                                    <img class="t-avatar" src="{{ asset('vendor/custom-home/images/' . $t['img']) }}"
                                        alt="{{ $t['name'] }}">
                                    <div>
                                        <p class="t-name">{{ $t['name'] }}</p>
                                        <span class="t-role">{{ $t['role'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tp-testimonial-ai-pagination mt-4"></div>
        </div>
    </section>

    <!-- cta -->
    <section class="hy-section">
        <div class="container">
            <div class="hy-cta">
                <h2 class="hy-h2 mb-3">See Hyamii on your floor</h2>
                <p class="hy-lead mb-4 mx-auto" style="color:rgba(255,255,255,.8);max-width:560px;">
                    Start free and bring your whole restaurant onto one calm, connected platform.
                </p>
                <a href="{{ url('/login') }}" class="hy-btn hy-btn-ghost">Get started free <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
@endsection
