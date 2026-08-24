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
                            ['name' => 'Jean Claude', 'role' => 'Owner, Kigali Bites', 'text' => 'Since we switched to Hyamii, our kitchen runs 30% faster and the receipts are effortless.', 'img' => 'testimonial-item-1.png'],
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
