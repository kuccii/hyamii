@extends('landing.layout')
@section('title', 'Contact — Hyamii')

@section('content')
    <!-- page hero -->
    <section class="hy-page-hero hy-section">
        <div class="container text-center">
            <span class="hy-pill mb-3"><span class="dot"></span> Contact</span>
            <h1 class="hy-h1 mb-3">Let's talk about your restaurant</h1>
            <p class="hy-lead mx-auto" style="max-width:620px;">
                Questions, demos or enterprise plans — we are happy to help. Reach out and a human will reply.
            </p>
        </div>
    </section>

    <!-- contact -->
    <section class="hy-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <span class="hy-pill mb-3"><span class="dot"></span> Say hello</span>
                    <h2 class="hy-h2 mb-4">Get in touch</h2>
                    <ul class="list-unstyled" style="line-height:2.4;">
                        <li class="d-flex align-items-center gap-3">
                            <span class="hy-icon" style="margin:0;"><i class="fa-solid fa-envelope"></i></span>
                            <a href="mailto:{{ $lh['contact']['email'] ?? 'hello@hyamii.com' }}" style="color:var(--hy-ink);font-weight:600;">{{ $lh['contact']['email'] ?? 'hello@hyamii.com' }}</a>
                        </li>
                        <li class="d-flex align-items-center gap-3">
                            <span class="hy-icon" style="margin:0;"><i class="fa-solid fa-phone"></i></span>
                            <span style="color:var(--hy-ink);font-weight:600;">{{ $lh['contact']['phone'] ?? '+250 788 000 000' }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-3">
                            <span class="hy-icon" style="margin:0;"><i class="fa-solid fa-location-dot"></i></span>
                            <span style="color:var(--hy-ink);font-weight:600;">{{ $lh['contact']['address'] ?? 'Kigali, Rwanda' }}</span>
                        </li>
                    </ul>
                    <div class="hy-social mt-4">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i> Facebook</a>
                        <a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i> X</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form class="hy-card" style="border:none;box-shadow:0 22px 44px rgba(0,37,34,.06);" onsubmit="return false;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="hy-input" placeholder="Your name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="hy-input" placeholder="Your email">
                            </div>
                            <div class="col-12">
                                <input type="text" class="hy-input" placeholder="Subject">
                            </div>
                            <div class="col-12">
                                <textarea class="hy-input" placeholder="How can we help?"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="hy-btn hy-btn-primary">Send message <i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
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

    <!-- cta -->
    <section class="hy-section">
        <div class="container">
            <div class="hy-cta">
                <h2 class="hy-h2 mb-3">Prefer to dive right in?</h2>
                <p class="hy-lead mb-4 mx-auto" style="color:rgba(255,255,255,.8);max-width:560px;">
                    Create a free account and explore Hyamii yourself.
                </p>
                <a href="{{ url('/login') }}" class="hy-btn hy-btn-ghost">Get started free <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
@endsection
