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
                <div class="col-lg-4 col-md-6">
                    <div class="hy-price">
                        <h3 style="font-size:22px;font-weight:700;">Starter</h3>
                        <p class="hy-lead">For a single location getting going.</p>
                        <div class="amount">$0<span style="font-size:16px;font-weight:600;color:var(--hy-muted);">/mo</span></div>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> 1 branch</li>
                            <li><i class="fa-solid fa-check"></i> POS & kitchen display</li>
                            <li><i class="fa-solid fa-check"></i> Up to 3 staff accounts</li>
                            <li><i class="fa-solid fa-check"></i> Basic reports</li>
                            <li><i class="fa-solid fa-check"></i> Email support</li>
                        </ul>
                        <a href="{{ url('/login') }}" class="hy-btn hy-btn-ghost w-100">Start free</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="hy-price featured">
                        <span class="hy-pill mb-2" style="align-self:flex-start;"><span class="dot"></span> Most popular</span>
                        <h3 style="font-size:22px;font-weight:700;">Growth</h3>
                        <p class="hy-lead">For multi-branch restaurants.</p>
                        <div class="amount">$39<span style="font-size:16px;font-weight:600;color:var(--hy-muted);">/mo</span></div>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Up to 5 branches</li>
                            <li><i class="fa-solid fa-check"></i> Online ordering</li>
                            <li><i class="fa-solid fa-check"></i> Unlimited staff</li>
                            <li><i class="fa-solid fa-check"></i> Inventory & suppliers</li>
                            <li><i class="fa-solid fa-check"></i> Priority support</li>
                        </ul>
                        <a href="{{ url('/login') }}" class="hy-btn hy-btn-primary w-100">Choose Growth</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="hy-price">
                        <h3 style="font-size:22px;font-weight:700;">Enterprise</h3>
                        <p class="hy-lead">For groups & franchises.</p>
                        <div class="amount">Custom</div>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Unlimited branches</li>
                            <li><i class="fa-solid fa-check"></i> Custom integrations</li>
                            <li><i class="fa-solid fa-check"></i> Dedicated manager</li>
                            <li><i class="fa-solid fa-check"></i> SLA & onboarding</li>
                            <li><i class="fa-solid fa-check"></i> 24/7 support</li>
                        </ul>
                        <a href="{{ url('/contact') }}" class="hy-btn hy-btn-ghost w-100">Talk to us</a>
                    </div>
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
