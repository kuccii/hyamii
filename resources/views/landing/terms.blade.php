@extends('layouts.landing')

@section('content')

<section class="relative py-24 lg:py-32">
    <div class="absolute inset-0 geometric-pattern pointer-events-none opacity-30"></div>
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-8">Terms & Conditions</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-12">Last updated: {{ now()->format('F d, Y') }}</p>

        <div class="prose prose-gray dark:prose-invert max-w-none">
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing or using Hyamii ("the Platform"), you agree to be bound by these Terms & Conditions. If you do not agree, you may not use the Platform.</p>

            <h2>2. Description of Service</h2>
            <p>Hyamii provides a cloud-based restaurant management platform including POS, order management, kitchen display, table management, reservation systems, customer management, reporting, and related features.</p>

            <h2>3. Account Registration</h2>
            <p>You must create an account to use our services. You agree to provide accurate, current, and complete information and to maintain the security of your account credentials. You are responsible for all activities under your account.</p>

            <h2>4. Subscription and Billing</h2>
            <h3>4.1 Fees</h3>
            <p>Subscription fees are charged in advance on a monthly or annual basis as selected. Fees are non-refundable except as expressly stated in our Refund Policy.</p>

            <h3>4.2 Payment</h3>
            <p>We use third-party payment processors. By providing payment information, you authorize us to charge the applicable fees.</p>

            <h3>4.3 Changes</h3>
            <p>We may change our fees with 30 days notice. Continued use after changes constitutes acceptance.</p>

            <h2>5. Use of Service</h2>
            <h3>5.1 License</h3>
            <p>We grant you a non-exclusive, non-transferable, revocable license to use the Platform for your restaurant operations.</p>

            <h3>5.2 Restrictions</h3>
            <p>You may not: copy, modify, or distribute the Platform; reverse engineer our software; use the Platform for illegal purposes; interfere with the Platform's operation; or exceed usage limits.</p>

            <h2>6. Data Ownership</h2>
            <p>You retain all rights to your restaurant data. We claim no ownership over the information you input into the Platform. We may use anonymized, aggregated data for analytics and service improvement.</p>

            <h2>7. Data Protection</h2>
            <p>We implement security measures to protect your data. We process personal data in accordance with our Privacy Policy. You are responsible for ensuring compliance with applicable data protection laws in your jurisdiction.</p>

            <h2>8. Service Level</h2>
            <p>We strive for 99.9% uptime but do not guarantee uninterrupted service. We may perform maintenance during low-traffic periods. We are not liable for downtime caused by third-party services or factors beyond our control.</p>

            <h2>9. Limitation of Liability</h2>
            <p>To the maximum extent permitted by law, Hyamii shall not be liable for indirect, incidental, or consequential damages. Our total liability is limited to the fees paid in the 12 months preceding the claim.</p>

            <h2>10. Termination</h2>
            <p>Either party may terminate the agreement with 30 days written notice. We may terminate immediately for breach of terms. Upon termination, you may export your data within 30 days; after which it may be permanently deleted.</p>

            <h2>11. Intellectual Property</h2>
            <p>The Platform, including its code, design, and branding, is owned by Hyamii and protected by intellectual property laws. You may not use our trademarks without prior written consent.</p>

            <h2>12. Governing Law</h2>
            <p>These terms are governed by applicable laws. Any disputes shall be resolved through binding arbitration or in the courts of the governing jurisdiction.</p>

            <h2>13. Changes to Terms</h2>
            <p>We may modify these terms with 30 days notice. Continued use after changes take effect constitutes acceptance.</p>

            <h2>14. Contact</h2>
            <p>For questions about these terms, contact us at support@hyamii.com.</p>
        </div>
    </div>
</section>

@endsection
