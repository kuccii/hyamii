@extends('layouts.landing')

@section('content')
{{-- Hero --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden mesh-gradient pt-24">
    <div class="absolute inset-0 geometric-pattern pointer-events-none"></div>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full opacity-20" style="background: radial-gradient(circle, rgba(var(--color-base), 0.3) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 rounded-full opacity-15" style="background: radial-gradient(circle, rgba(var(--color-base), 0.2) 0%, transparent 70%);"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-[0.04] dark:opacity-[0.08]" style="background: radial-gradient(circle, rgba(var(--color-base), 1) 0%, transparent 70%);"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-label font-semibold bg-skin-secondary/10 text-skin-secondary border border-skin-secondary/20 mb-8 animate-fade-in">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                {{ $frontDetails->header_title ?? __('landing.heroSearchEngine') }}
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-tight animate-fade-in-up" style="letter-spacing: -0.02em">
                {{ $frontDetails->header_title ?? __('landing.heroTitle') }}
            </h1>

            <div class="mt-6 text-lg sm:text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed animate-fade-in-up animation-delay-200">
                {!! $frontDetails->header_description ?? __('landing.heroSubTitle') !!}
            </div>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up animation-delay-300">
                <a href="{{ route('restaurant_signup') }}" class="btn-primary">
                    @if($trialPackage)
                        @lang('landing.startTrial', ['days' => $trialPackage->trial_days])
                    @else
                        @lang('landing.heroCtaPrimary')
                    @endif
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="#features" class="btn-secondary">
                    @lang('landing.heroCtaSecondary')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </a>
            </div>

            <p class="mt-4 text-sm text-gray-400 dark:text-gray-500 animate-fade-in-up animation-delay-400">@lang('landing.ctaNoCard')</p>
        </div>

        <div class="mt-16 relative animate-fade-in-up animation-delay-500">
            <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent dark:from-gray-950 z-10 pointer-events-none"></div>
            <div class="relative mx-auto max-w-5xl">
                <div class="elevation-1 rounded-xl overflow-hidden">
                    <img src="{{ $frontDetails->image_url ?? asset('landing/dashboard.png') }}" class="w-full h-auto" alt="Hyamii Dashboard">
                </div>
            </div>
            <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 w-3/4 h-12 bg-skin-base/10 blur-3xl rounded-full"></div>
        </div>
    </div>
</section>

@if(!$frontFeatures->isEmpty())
{{-- Features --}}
<section id="features" class="py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">
                {{ $frontDetails->feature_with_image_heading ?? __('landing.featureSection1') }}
            </h2>
        </div>

        <div class="space-y-24">
            @foreach($frontFeatures as $index => $feature)
                @if($feature->type == 'image')
                    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                        @if($index % 2 == 0)
                            <div class="order-2 lg:order-1 reveal-left">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white leading-tight">{{ $feature->title }}</h3>
                                <div class="mt-4 text-lg text-gray-500 dark:text-gray-400 leading-relaxed [&_*]:text-gray-500 [&_*]:dark:text-gray-400">{!! $feature->description !!}</div>
                            </div>
                            <div class="order-1 lg:order-2 reveal-right">
                                <div class="relative">
                                    <div class="absolute -inset-4 bg-gradient-to-br from-skin-secondary/20 to-transparent rounded-3xl blur-2xl"></div>
                                    <img src="{{ $feature->image ? asset('user-uploads/front_feature/' . $feature->image) : asset('landing/order-management.png') }}" class="relative rounded-xl border border-gray-200 dark:border-gray-800 shadow-xl w-full" alt="{{ $feature->title }}">
                                </div>
                            </div>
                        @else
                            <div class="order-2 lg:order-2 reveal-right">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white leading-tight">{{ $feature->title }}</h3>
                                <div class="mt-4 text-lg text-gray-500 dark:text-gray-400 leading-relaxed [&_*]:text-gray-500 [&_*]:dark:text-gray-400">{!! $feature->description !!}</div>
                            </div>
                            <div class="order-1 lg:order-1 reveal-left">
                                <div class="relative">
                                    <div class="absolute -inset-4 bg-gradient-to-br from-skin-secondary/20 to-transparent rounded-3xl blur-2xl"></div>
                                    <img src="{{ $feature->image ? asset('user-uploads/front_feature/' . $feature->image) : asset('landing/table-reservation.png') }}" class="relative rounded-xl border border-gray-200 dark:border-gray-800 shadow-xl w-full" alt="{{ $feature->title }}">
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

{{-- Icon Features --}}
<section class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900/50" id="icon-features">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">
                {{ $frontDetails->feature_with_icon_heading ?? __('landing.featureSection2') }}
            </h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @foreach($frontFeatures as $index => $feature)
                @if($feature->type == 'icon')
                    <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300" style="transition-delay: {{ $index * 0.05 }}s">
                        @if(!empty($feature->image))
                            <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                {!! $feature->image !!}
                            </div>
                        @endif
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $feature->title }}</h3>
                        <div class="text-sm text-gray-500 dark:text-gray-400 [&_*]:text-gray-500 [&_*]:dark:text-gray-400">{!! $feature->description !!}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

@if(!$frontReviews->isEmpty())
{{-- Testimonials --}}
<section class="py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">
                {{ $frontDetails->review_heading ?? __('landing.testimonialSection1') }}
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
            @foreach($frontReviews as $rIndex => $review)
                <div class="reveal group p-6 lg:p-8 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300" style="transition-delay: {{ $rIndex * 0.1 }}s">
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">"{{ $review->reviews }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-skin-base/20 flex items-center justify-center text-skin-base font-bold text-sm">{{ substr($review->reviewer_name, 0, 1) }}</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $review->reviewer_name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $review->reviewer_designation }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Pricing --}}
<section class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900/50" id="pricing">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">
                {{ $frontDetails->price_heading ?? __('landing.pricingTitle1') }}
            </h2>
            <div class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                {!! $frontDetails->price_description ?? __('landing.pricingSubTitle1') !!}
            </div>
        </div>

        @include('landing.pricing', ['packages' => $packages, 'modules' => $AllModulesWithFeature])
    </div>
</section>

@if(!$frontFaqs->isEmpty())
{{-- FAQ --}}
<section class="py-20 lg:py-28" id="faq">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">
                {{ $frontDetails->faq_heading ?? __('landing.faqTitle1') }}
            </h2>
            <div class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                {!! $frontDetails->faq_description ?? __('landing.faqSubTitle1') !!}
            </div>
        </div>

        <div class="space-y-4" x-data="{ open: null }">
            @foreach($frontFaqs as $index => $frontFaq)
                <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 overflow-hidden" :class="{ 'border-skin-base/30': open === {{ $index }} }">
                    <button @click="open = open === {{ $index }} ? null : {{ $index }}" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="text-base font-semibold text-gray-900 dark:text-white">{{ $frontFaq->question }}</span>
                        <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open === {{ $index }} }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === {{ $index }}" x-collapse>
                        <div class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed [&_*]:text-gray-500 [&_*]:dark:text-gray-400">{!! $frontFaq->answer !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900/50" id="contact">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center reveal-scale">
        <div class="relative p-8 lg:p-12 rounded-xl bg-gradient-to-br from-skin-secondary/10 via-white to-skin-base/5 dark:from-skin-secondary/5 dark:via-gray-900 dark:to-transparent border border-skin-base/20">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(var(--color-base),0.08),transparent_70%)] rounded-xl pointer-events-none"></div>
            <div class="relative">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">@lang('landing.ctaTitle')</h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">@lang('landing.ctaSubTitle')</p>
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('restaurant_signup') }}" class="btn-primary">
                        @lang('landing.ctaButton')
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
                <p class="mt-3 text-sm text-gray-400 dark:text-gray-500">@lang('landing.ctaNoCard')</p>
            </div>
        </div>
    </div>
</section>
@endsection