@extends('layouts.landing')

@section('content')

<section class="relative py-24 lg:py-32">
    <div class="absolute inset-0 geometric-pattern pointer-events-none opacity-30"></div>
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-8">Privacy Policy</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-12">Last updated: {{ now()->format('F d, Y') }}</p>

        <div class="prose prose-gray dark:prose-invert max-w-none">
            <h2>1. Introduction</h2>
            <p>Hyamii ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our restaurant management platform.</p>

            <h2>2. Information We Collect</h2>
            <h3>2.1 Personal Information</h3>
            <p>We may collect personal information such as your name, email address, phone number, billing address, and payment information when you register for an account or use our services.</p>

            <h3>2.2 Restaurant Data</h3>
            <p>We collect data related to your restaurant operations, including menu items, orders, customer information, sales data, and staff details necessary to provide our services.</p>

            <h3>2.3 Usage Information</h3>
            <p>We automatically collect information about how you interact with our platform, including IP addresses, browser types, device information, and usage patterns.</p>

            <h2>3. How We Use Your Information</h2>
            <ul>
                <li>To provide, maintain, and improve our restaurant management platform</li>
                <li>To process transactions and send related information</li>
                <li>To send administrative messages, updates, security alerts, and support</li>
                <li>To comply with legal obligations and protect our rights</li>
                <li>To analyze usage trends and improve user experience</li>
            </ul>

            <h2>4. Data Sharing and Disclosure</h2>
            <p>We do not sell your personal information. We may share your data with:</p>
            <ul>
                <li>Service providers who assist in operating our platform (payment processors, hosting providers)</li>
                <li>Law enforcement or regulatory authorities when required by law</li>
                <li>Business partners with your consent or as necessary to provide services</li>
            </ul>

            <h2>5. Data Security</h2>
            <p>We implement industry-standard security measures including encryption, access controls, and regular security audits to protect your data against unauthorized access, alteration, disclosure, or destruction.</p>

            <h2>6. Data Retention</h2>
            <p>We retain your information for as long as your account is active or as needed to provide services. We may retain certain data after account closure to comply with legal obligations or resolve disputes.</p>

            <h2>7. Your Rights</h2>
            <p>Depending on your jurisdiction, you may have the right to:</p>
            <ul>
                <li>Access the personal information we hold about you</li>
                <li>Request correction of inaccurate data</li>
                <li>Request deletion of your data</li>
                <li>Object to or restrict processing of your data</li>
                <li>Data portability</li>
            </ul>

            <h2>8. Cookies</h2>
            <p>We use cookies and similar tracking technologies to enhance your experience, analyze usage, and support our marketing efforts. You can control cookie preferences through your browser settings.</p>

            <h2>9. Third-Party Services</h2>
            <p>Our platform may integrate with third-party services (payment gateways, analytics providers). These services have their own privacy policies, and we encourage you to review them.</p>

            <h2>10. Children's Privacy</h2>
            <p>Our services are not intended for individuals under the age of 18. We do not knowingly collect personal information from children.</p>

            <h2>11. Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. We will notify you of material changes by email or through a notice on our platform.</p>

            <h2>12. Contact Us</h2>
            <p>If you have questions or concerns about this Privacy Policy, please contact us at support@hyamii.com.</p>
        </div>
    </div>
</section>

@endsection
