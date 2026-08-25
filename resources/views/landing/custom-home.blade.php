@extends('landing.layout')

@section('content')
    @php
        $lh = landing_home_setting();
        $img = fn($path, $fallback) => landing_home_image($path, $fallback);
        $serviceIcons = ['fa-utensils', 'fa-kitchen-set', 'fa-cart-shopping', 'fa-chair', 'fa-chart-line', 'fa-heart'];
    @endphp

    <!-- hero -->
    <section class="hy-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="hy-pill mb-3"><span class="dot"></span>
                        {{ $lh['hero']['subtitle'] ?? 'Restaurant software, built for you' }}</span>
                    <h1 class="hy-display mb-3">{{ $lh['hero']['title'] ?? 'Run your restaurant on autopilot' }}</h1>
                    <p class="hy-lead mb-4">{{ $lh['hero']['paragraph'] ?? 'Hyamii brings POS, kitchen display, online ordering, inventory and compliance into one fast, beautiful platform.' }}</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary">Start free <i
                                class="fa-solid fa-arrow-right"></i></a>
                        <a href="{{ url('/features') }}" class="hy-btn hy-btn-ghost"><i class="fa-solid fa-layer-group"></i> Explore features</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hy-media hy-shot" style="aspect-ratio: 16 / 11;">
                        <img src="{{ asset('vendor/custom-home/images/ch05-pos.png') }}" alt="Hyamii point-of-sale screen">
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
                {{ $lh['brand']['title'] ?? 'Trusted by restaurants everywhere' }}</p>
            <div class="swiper tp-brand-slide-active">
                <div class="swiper-wrapper align-items-center">
                    @foreach (['brand-1.png', 'brand-3.png', 'brand-4.png', 'brand-5.png', 'brand-6.png', 'brand-1.png', 'brand-3.png', 'brand-4.png'] as $b)
                        <div class="swiper-slide text-center brand-slide">
                            <img src="{{ asset('vendor/custom-home/images/' . $b) }}" alt="" loading="lazy">
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
            <div class="text-center mt-5">
                <a href="{{ url('/features') }}" class="hy-btn hy-btn-ghost">See all features <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- about + stats -->
    <section id="about" class="hy-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hy-media hy-shot" style="aspect-ratio: 16 / 11;">
                        <img src="{{ asset('vendor/custom-home/images/ch09-reports.png') }}" alt="Hyamii reports and insights" loading="lazy">
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

    <!-- contactless table ordering -->
    <section class="hy-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hy-media hy-shot" style="aspect-ratio: 16 / 11;">
                        <img src="{{ asset('vendor/custom-home/images/ch03-qr.png') }}" alt="Guests scan a QR code to order from the table" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="hy-pill mb-3"><span class="dot"></span> Contactless ordering</span>
                    <h2 class="hy-h2 mb-3">Contactless Table Ordering System</h2>
                    <p class="hy-lead mb-4">Turn every table into a self-order station. Guests scan a QR code, browse the live menu, and send orders and payments straight from their phone — no app, no waiting, no shared menus.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="hy-card h-100">
                                <div class="hy-icon"><i class="fa-solid fa-qrcode"></i></div>
                                <h3>Scan to order</h3>
                                <p>One QR code per table opens the digital menu instantly.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="hy-card h-100">
                                <div class="hy-icon"><i class="fa-solid fa-bolt"></i></div>
                                <h3>Orders to kitchen</h3>
                                <p>Items land on the KOT and POS in real time, zero re-keying.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="hy-card h-100">
                                <div class="hy-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                                <h3>Pay at the table</h3>
                                <p>Guests settle the bill from their phone and leave when ready.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="hy-card h-100">
                                <div class="hy-icon"><i class="fa-solid fa-language"></i></div>
                                <h3>Menu in their language</h3>
                                <p>Clear, up-to-date items with modifiers and options built in.</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/features') }}" class="hy-btn hy-btn-primary">Explore the system <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- localized pricing preview -->
    <section class="hy-section" style="background:var(--hy-soft);">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="hy-pill mb-3"><span class="dot"></span> Pricing in your currency</span>
                    <h2 class="hy-h2">Simple plans for {{ $countryName ?? 'your restaurant' }}</h2>
                    <p class="hy-lead">All prices shown in {{ $currencyCode }}. Switch your country in the menu above to see local pricing.</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach (($tiers ?? []) as $t)
                    <div class="col-lg-4 col-md-6">
                        <div class="hy-price {{ $t['featured'] ? 'featured' : '' }}">
                            @if ($t['featured'])
                                <span class="hy-pill mb-2" style="align-self:flex-start;"><span class="dot"></span> Most popular</span>
                            @endif
                            <h3 style="font-size:22px;font-weight:700;">{{ $t['name'] }}</h3>
                            <div class="amount">{{ $currencySymbol }} {{ number_format($t['monthly'], 0) }}<span style="font-size:16px;font-weight:600;color:var(--hy-muted);">/mo</span></div>
                            <ul>
                                @foreach (array_slice($t['features'], 0, 5) as $f)
                                    <li><i class="fa-solid fa-check"></i> {{ $f }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ url('/pricing') }}" class="hy-btn {{ $t['featured'] ? 'hy-btn-primary' : 'hy-btn-ghost' }} w-100">View {{ $t['name'] }}</a>
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
            <div class="tp-testimonial-ai-pagination mt-4"></div>
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
                    {{ $lh['cta']['text'] ?? 'Join restaurants already running smoother with Hyamii.' }}
                </p>
                <a href="{{ url('/login') }}" class="hy-btn hy-btn-ghost">Get started free <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
@endsection
