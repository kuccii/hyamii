<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingHomeSetting extends Model
{
    protected $table = 'landing_home_settings';

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];

    public static function defaults(): array
    {
        return [
            'hero' => [
                'subtitle' => 'Hyamii',
                'title' => 'Restaurant management, made effortless.',
                'paragraph' => 'From orders and kitchen displays to menus, tables and reservations — Hyamii brings your whole restaurant onto one calm, connected platform.',
                'primary_btn' => 'Get Started',
                'secondary_btn' => 'Explore',
                'image' => null,
                'card1_label' => 'Orders today',
                'card1_value' => '248',
                'card2_label' => 'Revenue',
                'card2_value' => '1.2M RWF',
            ],
            'brand' => [
                'title' => 'Trusted by restaurants across Rwanda',
                'logos' => [null, null, null, null, null, null],
            ],
            'about' => [
                'subtitle' => 'About Hyamii',
                'title' => 'One platform for your whole restaurant.',
                'paragraph1' => 'Hyamii connects every part of service — front of house, kitchen, and management — into a single calm system built for the pace of real service.',
                'paragraph2' => 'No more disconnected tools. Just one source of truth, from the first order to the end-of-day report.',
                'image' => null,
                'fact_value' => '15',
                'fact_label' => 'Years of experience',
                'feature1_title' => 'Real-time orders',
                'feature1_text' => 'Orders flow to the kitchen the moment they\'re placed — dine-in, takeaway or delivery.',
                'feature2_title' => 'Smart menus',
                'feature2_text' => 'Update items, prices and modifiers once and they sync everywhere instantly.',
            ],
            'services' => [
                'subtitle' => 'What you get',
                'title' => 'Everything your restaurant needs to run smoothly.',
                'items' => [
                    ['title' => 'POS & Orders', 'text' => 'A fast, reliable point of sale that keeps pace with the rush and never loses a ticket.', 'icon' => null],
                    ['title' => 'Kitchen Display', 'text' => 'Live tickets on the line, color-coded by course and time so nothing slips.', 'icon' => null],
                    ['title' => 'Menu Management', 'text' => 'Build menus, modifiers and categories that update across every channel at once.', 'icon' => null],
                    ['title' => 'Tables & Reservations', 'text' => 'A visual floor plan with real-time occupancy and a smooth waitlist.', 'icon' => null],
                    ['title' => 'Reporting', 'text' => 'Clear sales, tax and VAT reports — including RRA EBM-ready receipts.', 'icon' => null],
                    ['title' => 'Customer & Loyalty', 'text' => 'Know your regulars, run loyalty and send them back through smart notifications.', 'icon' => null],
                ],
            ],
            'faq' => [
                'subtitle' => 'FAQ',
                'title' => 'Questions, answered.',
                'image' => null,
                'items' => [
                    ['question' => 'Can I run dine-in, takeaway and delivery from one system?', 'answer' => 'Yes. Hyamii unifies all three order types into a single, real-time flow so your kitchen and staff always see the full picture.'],
                    ['question' => 'Does it work with the Rwanda tax authority (RRA EBM)?', 'answer' => 'Hyamii includes an RRA EBM module that submits sales and issues compliant electronic receipts automatically.'],
                    ['question' => 'How long does setup take?', 'answer' => 'Most restaurants are live within a day. Menus, tables and taxes are configured in a guided setup.'],
                    ['question' => 'Is there a free trial?', 'answer' => 'Yes — start with a free trial, no card required, and upgrade only when you\'re ready.'],
                ],
            ],
            'cta' => [
                'subtitle' => 'Empowering your restaurant',
                'title' => 'Ready to run a calmer, smarter service?',
                'text' => 'Start free today — bring orders, kitchen, menus and reports into one place.',
                'button' => 'Get Started',
            ],
            'contact' => [
                'subtitle' => 'Get in touch',
                'title' => 'Start your free trial today.',
                'email' => 'hello@hyamii.com',
                'phone' => '+250 788 000 000',
                'address' => 'Kigali, Rwanda',
            ],
            'footer' => [
                'text' => 'Hyamii — restaurant management made effortless, built for Rwanda and beyond.',
                'logo' => null,
                'location' => 'Kigali, Rwanda',
                'email' => 'hello@hyamii.com',
                'phone' => '+250 788 000 000',
            ],
        ];
    }
}
