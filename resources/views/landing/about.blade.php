@extends('landing.layout')
@section('title', 'About — Hyamii')

@section('content')
    @php
        $lh = landing_home_setting();
        $img = fn($path, $fallback) => landing_home_image($path, $fallback);
    @endphp

    <!-- page hero -->
    <section class="hy-page-hero hy-section">
        <div class="container text-center">
            <span class="hy-pill mb-3"><span class="dot"></span> About</span>
            <h1 class="hy-h1 mb-3">We build calm software for busy kitchens</h1>
            <p class="hy-lead mx-auto" style="max-width:620px;">
                Hyamii started with a simple idea: restaurant software should reduce stress, not add to it.
            </p>
        </div>
    </section>

    <!-- about + stats -->
    <section class="hy-section">
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
                    <h2 class="hy-h2 mb-3">{{ $lh['about']['title'] ?? 'Made for modern restaurants' }}</h2>
                    <p class="hy-lead mb-2">{{ $lh['about']['paragraph1'] ?? '' }}</p>
                    <p class="hy-lead">{{ $lh['about']['paragraph2'] ?? '' }}</p>
                    <div class="row g-4 mt-3">
                        <div class="col-6 col-sm-3">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="40" data-purecounter-suffix="+">40+</span></div>
                                <div class="lbl">Restaurants</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="3" data-cursor="" data-purecounter-suffix="k+">3k+</span></div>
                                <div class="lbl">Orders / day</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="6" data-purecounter-suffix="+">6+</span></div>
                                <div class="lbl">Cities</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="hy-stat"><div class="num"><span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="99" data-purecounter-suffix="%">99%</span></div>
                                <div class="lbl">Uptime</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- values -->
    <section class="hy-section" style="background:var(--hy-soft);">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="hy-pill mb-3"><span class="dot"></span> Our values</span>
                    <h2 class="hy-h2">What we care about</h2>
                </div>
            </div>
            <div class="row g-4">
                @php
                    $values = [
                        ['icon' => 'fa-bolt', 'title' => 'Fast by default', 'text' => 'Every screen loads in a blink, even on a busy floor with spotty wifi.'],
                        ['icon' => 'fa-heart', 'title' => 'Built with care', 'text' => 'We sweat the small details so your team never has to think about the tool.'],
                        ['icon' => 'fa-globe', 'title' => 'Made for the world', 'text' => 'Localized, compliant and ready for restaurants everywhere, not just one market.'],
                        ['icon' => 'fa-handshake-angle', 'title' => 'Partners, not vendors', 'text' => 'We grow when your restaurant grows. Your success is the metric.'],
                    ];
                @endphp
                @foreach ($values as $v)
                    <div class="col-lg-3 col-md-6">
                        <div class="hy-card">
                            <div class="hy-icon"><i class="fa-solid {{ $v['icon'] }}"></i></div>
                            <h3>{{ $v['title'] }}</h3>
                            <p>{{ $v['text'] }}</p>
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
                <h2 class="hy-h2 mb-3">Let's build something calm together</h2>
                <p class="hy-lead mb-4 mx-auto" style="color:rgba(255,255,255,.8);max-width:560px;">
                    Join the restaurants already running smoother with Hyamii.
                </p>
                <a href="{{ url('/login') }}" class="hy-btn hy-btn-ghost">Get started free <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
@endsection
