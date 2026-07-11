@extends('layouts.landing')

@section('content')

<section class="relative py-24 lg:py-32">
    <div class="absolute inset-0 geometric-pattern pointer-events-none opacity-30"></div>
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-8">Refund Policy</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-12">Last updated: {{ now()->format('F d, Y') }}</p>

        <div class="prose prose-gray dark:prose-invert max-w-none">
            <h2>1. Overview</h2>
            <p>This Refund Policy outlines the terms under which Hyamii ("we," "our," or "us") provides refunds for subscriptions and services purchased through our platform.</p>

            <h2>2. Subscription Plans</h2>

            <h3>2.1 Monthly Subscriptions</h3>
            <p>Monthly subscriptions are billed in advance. If you cancel your monthly subscription, you will retain access until the end of the current billing period. No partial refunds will be provided for the remaining days in the billing period.</p>

            <h3>2.2 Annual Subscriptions</h3>
            <p>Annual subscriptions are billed in advance at a discounted rate. If you cancel within the first 14 days of your annual subscription, you may request a full refund. After the first 14 days, cancellations will take effect at the end of the current billing period with no partial refund.</p>

            <h3>2.3 Lifetime Plans</h3>
            <p>Lifetime plans are a one-time payment for continued access. Due to the nature of lifetime pricing, refunds are not available for lifetime plan purchases.</p>

            <h2>3. Trial Period</h2>
            <p>We offer a trial period for new users. If you cancel during the trial period, no charges will be applied. You are responsible for canceling before the trial ends to avoid being charged.</p>

            <h2>4. Refund Process</h2>
            <p>To request a refund, contact our support team at support@hyamii.com within the applicable refund window. Include your account details and reason for the request. We will process approved refunds within 5-10 business days to the original payment method.</p>

            <h2>5. Add-Ons and Modules</h2>
            <p>Payments for additional modules, add-ons, or one-time services are non-refundable unless otherwise stated at the time of purchase.</p>

            <h2>6. Service Cancellation</h2>
            <p>We reserve the right to suspend or terminate accounts that violate our Terms & Conditions. In such cases, refunds for the remaining subscription period are not provided. If we discontinue a service entirely, we will provide pro-rata refunds for prepaid periods.</p>

            <h2>7. Chargebacks</h2>
            <p>If you initiate a chargeback, your account may be suspended until the matter is resolved. We may dispute chargebacks where applicable fees were properly charged according to these terms.</p>

            <h2>8. Contact</h2>
            <p>For refund requests or questions about this policy, contact us at:</p>
            <p>Email: support@hyamii.com</p>
        </div>
    </div>
</section>

@endsection
