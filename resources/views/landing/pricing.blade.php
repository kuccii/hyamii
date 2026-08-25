@extends('landing.layout')
@section('title', 'Pricing — Hyamii')

@section('content')
    <!-- page hero -->
    <section class="hy-page-hero hy-section">
        <div class="container text-center">
            <span class="hy-pill mb-3"><span class="dot"></span> Pricing</span>
            <h1 class="hy-h1 mb-3">Simple plans that scale with you</h1>
            <p class="hy-lead mx-auto" style="max-width:620px;">
                Start free, upgrade when you are ready. Every plan includes the core POS, kitchen display and reporting.
            </p>
        </div>
    </section>

    <!-- pricing -->
    <section class="hy-section">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @foreach (($tiers ?? []) as $t)
                    <div class="col-lg-4 col-md-6">
                        <div class="hy-price {{ $t['featured'] ? 'featured' : '' }}">
                            @if ($t['featured'])
                                <span class="hy-pill mb-2" style="align-self:flex-start;"><span class="dot"></span> Most popular</span>
                            @endif
                            <h3 style="font-size:22px;font-weight:700;">{{ $t['name'] }}</h3>
                            <p class="hy-lead">{{ $t['description'] }}</p>
                            <div class="amount">{{ $currencySymbol }} {{ number_format($t['monthly'], 0) }}<span style="font-size:16px;font-weight:600;color:var(--hy-muted);">/mo</span></div>
                            <div class="mb-1" style="font-size:13px;color:var(--hy-muted);">
                                {{ $currencyCode }} {{ number_format($t['annual'], 0) }}/yr · 2 months free
                            </div>
                            <ul>
                                @foreach (array_slice($t['features'], 0, 6) as $f)
                                    <li><i class="fa-solid fa-check"></i> {{ $f }}</li>
                                @endforeach
                            </ul>
                            @if ($t['featured'])
                                <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary w-100">Choose {{ $t['name'] }}</a>
                            @elseif ($t['name'] == 'Enterprise')
                                <a href="{{ url('/contact') }}" class="hy-btn hy-btn-ghost w-100">Talk to us</a>
                            @else
                                <a href="{{ url('/login') }}" class="hy-btn hy-btn-ghost w-100">Start with {{ $t['name'] }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="text-center mt-4" style="color:var(--hy-muted);font-size:14px;">
                Prices shown in <strong>{{ $currencyCode }}</strong> for <strong>{{ $countryName ?? '' }}</strong>.
                Change your country in the menu above to see local pricing.
            </p>
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
                    <div class="tp-faq-wrap accordion" id="hyFaqPricing">
                        @foreach (($lh['faq']['items'] ?? []) as $i => $f)
                            <div class="accordion-item mb-3 border-0"
                                style="border-radius:14px;overflow:hidden;background:#fff;border:1px solid var(--hy-line) !important;">
                                <h2 class="accordion-header">
                                    <button class="tp-faq-btn accordion-button {{ $i > 0 ? 'collapsed' : '' }}"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#pfaq{{ $i }}" style="padding:18px 22px;font-weight:700;">
                                        {{ $f['question'] ?? '' }}
                                    </button>
                                </h2>
                                <div id="pfaq{{ $i }}"
                                    class="accordion-collapse collapse {{ $i == 0 ? 'show' : '' }}"
                                    data-bs-parent="#hyFaqPricing">
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
                <h2 class="hy-h2 mb-3">Ready when you are</h2>
                <p class="hy-lead mb-4 mx-auto" style="color:rgba(255,255,255,.8);max-width:560px;">
                    Start free today — no card required.
                </p>
                <a href="{{ url('/login') }}" class="hy-btn hy-btn-ghost">Get started free <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
@endsection
