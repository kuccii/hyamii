# Hyamii Documentation

> **Hyamii** (formerly TableTrack) is a commercial SaaS restaurant management platform built on Laravel 12. It provides a complete suite of tools for managing restaurants, including POS, Kitchen Display Systems, reservations, menu management, delivery, staff management, and more — all from a single multi-tenant platform.

---

## Table of Contents

1. [Architecture Overview](#1-architecture-overview)
2. [Tech Stack](#2-tech-stack)
3. [Key Features](#3-key-features)
4. [Module System](#4-module-system)
5. [Project Structure](#5-project-structure)
6. [Authentication & Authorization](#6-authentication--authorization)
7. [Payment Gateway Integration](#7-payment-gateway-integration)
8. [Real-time Features](#8-real-time-features)
9. [Reporting & Exports](#9-reporting--exports)
10. [Design System](#10-design-system)
11. [Installation & Setup](#11-installation--setup)
12. [Build & Deployment](#12-build--deployment)
13. [Development Guidelines](#13-development-guidelines)

---

## 1. Architecture Overview

Hyamii follows a **multi-tenant SaaS architecture** where a single platform instance serves multiple restaurant clients. Each restaurant (tenant) manages its own:

- Branches (locations)
- Staff with role-based permissions
- Menu items, categories, and modifiers
- Orders, reservations, and tables
- Customers and delivery executives
- Payment configurations and subscriptions

The platform itself is managed by **SuperAdmins** who handle global settings, plans/pricing, payment gateway credentials, and tenant lifecycle.

### Multi-Tenancy Model

Tenancy is implemented on the **application level** rather than the database level:

- A `restaurant_id` or `branch_id` column on relevant tables scopes data per tenant
- Middleware and model scopes enforce data isolation
- `app/Scopes/` contains reusable query scopes for tenant filtering
- Traits in `app/Traits/` (e.g., `HasRestaurant`, `HasBranch`) provide model-level tenant awareness

---

## 2. Tech Stack

### Backend
| Technology | Purpose |
|---|---|
| **Laravel 12** | Core PHP framework |
| **PHP 8.2+** | Runtime |
| **MySQL / PostgreSQL** | Database |
| **Laravel Jetstream** | Authentication scaffolding |
| **Spatie Laravel Permission** | Roles & permissions |
| **Pusher** | WebSockets & push notifications |

### Frontend
| Technology | Purpose |
|---|---|
| **Livewire 3** | Reactive UI components (admin panels) |
| **Vue 3** | POS interface, customer-facing pages |
| **Tailwind CSS 3** | Utility-first styling |
| **Vite** | Asset bundling |
| **GSAP** | Animations |
| **ApexCharts** | Charts & analytics |
| **Flowbite / Preline** | UI component libraries |
| **SweetAlert2** | Alert dialogs |

### Key Packages
| Package | Purpose |
|---|---|
| `nwidart/laravel-modules` | Modular feature plugins |
| `maatwebsite/excel` | Import/export (XLSX, CSV) |
| `barryvdh/laravel-dompdf` | PDF generation |
| `intervention/image` | Image processing |
| `laravel/cashier` | Stripe subscription billing |
| `laravel/cashier-paddle` | Paddle subscription billing |
| `spatie/laravel-translatable` | Multi-language models |
| `stichoza/google-translate-php` | Auto-translation |
| `ladumor/laravel-pwa` | Progressive Web App |
| `opcodesio/log-viewer` | Log inspection |
| `froiden/laravel-installer` | Web-based installation wizard |

---

## 3. Key Features

### Restaurant Management
- **Multi-Restaurant / Multi-Branch** — Manage multiple locations under one account
- **Table Management** — Floor layout, table states (available, occupied, reserved, billed)
- **Reservation System** — Online booking with time-slot management
- **Operational Shifts** — Branch-level shift scheduling (`BranchOperationalShift`)

### Point of Sale (POS)
- **Vue-based POS** — Fast, reactive interface for cashiers
- **Livewire-based POS** — Alternative server-rendered POS
- **Order types** — Dine-in, Delivery, Takeaway
- **Split orders** — Split bills across multiple payers
- **Multi-order** — Handle multiple orders simultaneously

### Menu Management
- **Item categories** — Organizational grouping
- **Menu items** — With images, descriptions, prices, taxes
- **Item variations** — Size/color/type variants with different pricing
- **Modifier groups** — Customization options (e.g., extras, toppings)
- **Modifier options** — Individual selectable options with price overrides
- **Multi-currency pricing** — Per-item pricing in different currencies
- **Multi-language translation** — Auto-translate menu items via Google Translate

### Kitchen Display System (KDS/KOT)
- **KOT (Kitchen Order Ticket)** — Digital tickets for kitchen staff
- **Real-time updates** — Orders appear on KOT screens instantly via Pusher
- **KOT places** — Designated preparation stations (grill, cold section, bar)
- **KOT items** — Individual line items per ticket
- **Cancel reasons** — Track why items are voided

### Order Management
- **Full order lifecycle** — New → Preparing → Ready → Served → Paid
- **Order history** — Audit trail of all order changes
- **Order charges** — Service charges, delivery fees, taxes
- **Waiter requests** — Customer call-for-waiter functionality
- **Order notifications** — Email, SMS, and push notification triggers

### Delivery Management
- **Delivery Executive Portal** — Dedicated mobile-friendly portal
- **OTP Authentication** — Executive login via one-time password
- **Cash Settlement** — Track delivery cash collections and settlements
- **Delivery Fee Tiers** — Distance/order-value based pricing
- **Delivery Platforms** — Integration with third-party delivery services

### Customer Management
- **Customer profiles** — Contact info, order history, preferences
- **Customer addresses** — Multiple saved addresses
- **Loyalty system** — Points/rewards tracking (model foundation present)
- **Customer display** — Real-time customer-facing order status screen

### Staff Management
- **Roles & Permissions** — Granular permission system via Spatie
- **Staff accounts** — Per-restaurant/branch staff management
- **Staff reports** — Performance and activity tracking

### Subscription & Billing
- **Plan system** — Tiered subscription plans (monthly/yearly)
- **Packages** — Feature-bundle packages with module access control
- **Payment gateways** — Stripe, Paddle, PayPal for subscription billing
- **Offline payments** — Manual payment recording
- **Global invoices** — Unified invoice tracking
- **Trial management** — Trial license expiry notifications

### PWA Support
- Installable as a mobile app
- Offline-capable service worker
- Push notifications via web push protocol

---

## 4. Module System

Hyamii uses `nwidart/laravel-modules` for optional feature plugins. Modules live in `Modules/` and can be enabled/disabled per restaurant plan.

### Available Modules

| Module | Description |
|---|---|
| **Backup** | Automated database and file backups |
| **Cash Register** | Daily cash drawer management |
| **Inventory** | Stock tracking, supplier management, auto-reorder |
| **Kiosk** | Self-service ordering kiosk mode |
| **Kitchen** | Enhanced KDS features |
| **Language Pack** | Additional language packs |
| **MultiPOS** | Support for multiple POS terminals |
| **SMS** | SMS notification integration |
| **Subdomain** | Custom subdomain per restaurant |
| **WhatsApp** | WhatsApp notification integration |

### Module Registration

Modules auto-register their service providers. The `mhmiton/laravel-modules-livewire` package enables Livewire components within modules.

---

## 5. Project Structure

```
├── app/
│   ├── Actions/              # Atomic business actions
│   ├── ApiResource/          # API resource transformers
│   ├── Console/              # Artisan commands
│   ├── Enums/                # PHP enums (OrderStatus, PackageType, DeliveryFeeType)
│   ├── Events/               # Event classes (23 events)
│   ├── Exports/              # Excel/CSV export classes (18 exports)
│   ├── Helper/               # Helper functions, start.php
│   ├── Http/
│   │   ├── Controllers/      # 54 controllers including SuperAdmin/ sub-namespace
│   │   └── Middleware/       # Custom middleware
│   ├── Imports/              # Excel import classes
│   ├── Jobs/                 # Queued jobs
│   ├── Listeners/            # Event listeners
│   ├── Livewire/             # 47+ Livewire component directories
│   ├── Models/               # 111 Eloquent models
│   ├── Notifications/        # 19 notification classes
│   ├── Observers/            # 34 model observers
│   ├── Providers/            # Service providers
│   ├── Routing/              # Custom route bindings
│   ├── Scopes/               # Reusable query scopes
│   ├── Services/             # Business logic services (7)
│   ├── Traits/               # Reusable model traits (9)
│   └── View/                 # View composers
├── bootstrap/                # Framework bootstrapping
├── config/                   # 35 configuration files
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── lang/                     # Language files
├── Modules/                  # Feature modules (Inventory, Whatsapp)
├── public/                   # Web root
├── resources/
│   ├── css/                  # Global stylesheets
│   ├── js/                   # Vue components, app.js
│   └── views/                # Blade templates
├── routes/
│   ├── api.php               # API routes (print jobs, partners)
│   ├── console.php           # Artisan console routes
│   └── web.php               # Main web routes (474 lines)
├── storage/                  # Logs, cache, uploads
├── tests/
│   ├── Feature/              # Feature tests
│   └── Unit/                 # Unit tests
├── vendor/                   # Composer dependencies
├── .env.example              # Environment configuration template
├── composer.json             # PHP dependencies
├── package.json              # Node.js dependencies
├── tailwind.config.js        # Tailwind configuration
├── vite.config.js            # Vite bundler configuration
├── DESIGN.md                 # Design system documentation
├── AGENTS.md                 # Project memory / onboarding
└── DOCUMENTATION.md          # This file
```

### Key Directories Explained

#### `app/Models/` (111 models)
Core domain models including `Restaurant`, `Branch`, `Order`, `MenuItem`, `Table`, `Reservation`, `Customer`, `User`, `Kot`, `Payment`, and many more. All models use Eloquent ORM with extensive relationships.

#### `app/Observers/` (34 observers)
Observers handle cross-cutting concerns like cache invalidation, event firing, and related record updates when models are created/updated/deleted. For example:
- `RestaurantObserver` — Handles setup when a new restaurant registers
- `OrderObserver` — Fires order lifecycle events
- `PaymentObserver` — Updates order status on payment changes

#### `app/Services/` (7 services)
Business logic extracted into service classes:
- `CartSessionService` — Shopping cart management
- `DeliveryCashSettlementService` — Delivery cash reconciliation
- `KotStatusNotificationFeed` — KOT real-time status feed
- `MenuItemExportService` — Menu item bulk export
- `OrderCashCollectionService` — Cash collection reconciliation
- `PushNotificationService` — Push notification dispatch
- `RestaurantAvailabilityService` — Table/restaurant availability checks

#### `app/Http/Controllers/` (54 controllers)
Controllers handle HTTP request/response cycles. Notable sub-namespaces:
- `SuperAdmin/` — 15 controllers for payment gateway webhooks (Stripe, PayPal, Mollie, Flutterwave, Paystack, Razorpay, Xendit, Tap, Payfast, Paddle)
- `PosController`, `PosAjaxController`, `PosApiController` — POS operations
- `OrderController` — Order CRUD and management
- `PaymentController` — Payment initiation and processing
- `ReportController` — Reporting and analytics

#### `app/Livewire/` (47+ components)
Livewire components power the reactive UI. Organized by feature domain:
- `Pos/` — POS interface components
- `Order/` — Order management components
- `Menu/` — Menu management components
- `Reports/` — Reporting components
- `Settings/` — Configuration components
- `Restaurant/`, `Table/`, `Reservations/` — Core domain components

#### `app/Enums/`
- `OrderStatus` — Order state machine (pending, confirmed, preparing, ready, served, completed, cancelled)
- `PackageType` — Plan types (monthly, yearly)
- `DeliveryFeeType` — Delivery fee calculation methods

#### `routes/web.php` (474 lines)
The main route file containing:
- Authentication routes (Jetstream)
- Restaurant admin routes (scoped by middleware)
- POS routes
- API-like JSON endpoints for AJAX operations
- SuperAdmin routes (prefixed with `/super-admin`)
- Webhook routes for payment gateways

#### `routes/api.php`
- Desktop print job API endpoints
- Partner integration endpoints

---

## 6. Authentication & Authorization

### Staff Authentication (Jetstream)
- Laravel Jetstream provides login, registration, password reset, email verification
- Two-factor authentication support
- Session management

### Customer OTP Login
- Phone number / email based one-time password login
- `OtpLoginController` handles OTP generation and verification
- `SendOtp` notification sends the OTP code
- Used for customer-facing ordering interfaces

### Delivery Executive OTP Auth
- Dedicated `DeliveryExecutiveAuthController`
- OTP-based login for delivery personnel
- Separate portal with restricted features

### SuperAdmin Authentication
- Middleware-protected routes (`SuperAdmin` middleware)
- Separate login flow for platform administrators
- Full access to all tenant data and global settings

### Role-Based Permissions
- **Spatie Laravel Permission** (`spatie/laravel-permission`) provides role/permission management
- `app/Models/Role.php` extends Spatie's Role model
- `config/permission.php` configures permission settings
- Permissions are granular at the feature level (e.g., "create order", "edit menu", "view reports")

---

## 7. Payment Gateway Integration

Hyamii supports **9 payment gateways** for processing customer payments and **3 subscription billing providers**.

### Payment Gateway Pattern

Each gateway follows a consistent pattern:

```
Initiate POST → Success/Cancel GET → Webhook POST
```

| Gateway | Controller | Webhook Controller |
|---|---|---|
| **Stripe** | `StripeController` | `StripeWebhookController` |
| **PayPal** | `PaypalPaymentController` | `PaypalController` |
| **Mollie** | `MolliePaymentController` | `MollieController` |
| **Flutterwave** | `FlutterwavePaymentController` | `FlutterwaveWebhookController` |
| **Paystack** | `PaystackPaymentController` | `PaystackWebhookController` |
| **Razorpay** | `RazorpayPaymentController` | `RazorpayWebhookController` |
| **Xendit** | `XenditPaymentController` | `XenditWebhookController` |
| **Tap** | `TapPaymentController` | `TapController` |
| **Payfast** | `PayfastPaymentController` | `PayFastWebhookController` |

Webhook routes are registered under `/webhook/{hash}` where `{hash}` identifies the restaurant.

### Subscription Billing
- **Stripe** — via `laravel/cashier`
- **Paddle** — via `laravel/cashier-paddle`, `PaddleController` for webhooks
- **PayPal** — via custom integration, `PaypalController`
- **Offline** — Manual payment recording via `OfflinePaymentMethod`

### Gateway Configuration
- `config/paystack.php`, `config/flutterwave.php`, `config/mollie.php`, `config/payfast.php`
- `app/Models/PaymentGatewayCredential.php` — Per-restaurant gateway credentials
- `config/cashier.php` — Stripe Cashier configuration
- `SuperadminPaymentGateway.php` — Global gateway settings

---

## 8. Real-time Features

### Pusher Integration
- **WebSockets** for real-time event broadcasting
- **Push notifications** via Pusher Push Notifications
- `pusher/pusher-php-server` for server-side events
- `pusher/pusher-push-notifications` for mobile push

### Real-time Events (23 events)
- `NewOrderCreated` — Fired when a new order is placed
- `KotUpdated` — KOT status changes (preparing, ready)
- `CustomerDisplayUpdated` — Customer-facing order status
- `TodayOrdersUpdated` — Live order board refresh
- `ActiveWaiterRequestCreatedEvent` — Waiter call button
- `OrderTableAssigned` / `ReservationTableAssigned` — Table assignment
- `PrintJobCreated` — Trigger desktop printing

### KDS Real-time
- Kitchen displays update via Pusher channels
- `KotStatusNotificationFeed` service manages KOT status broadcasting
- Orders appear on KOT screens within seconds of being placed

### Customer Display
- Dedicated `CustomerDisplay.php` Livewire component
- `CustomerDisplayUpdated` event pushes status changes
- Customers can view order progress in real-time

---

## 9. Reporting & Exports

### Reports (via `app/Exports/`)
| Report | Description |
|---|---|
| `SalesReportExport` | Daily/monthly sales summary |
| `TaxReportExport` | Tax collection breakdown |
| `RefundReportExport` | Refund/void tracking |
| `CancelledOrderReportExport` | Cancelled order analysis |
| `CategoryReportExport` | Sales by menu category |
| `ItemReportExport` | Per-item sales performance |
| `CustomerReportExport` | Customer spending patterns |
| `DeliveryExecutiveExport` | Delivery performance |
| `StaffExport` | Staff activity summary |
| `ExpenseSummaryReportExport` | Expense categorization |
| `OutstandingReportExport` | Outstanding payments |
| `DuePaymentReportExport` | Overdue payment tracking |

### Menu Imports/Exports
- `MenuItemExport` / `MenuItemExportService` — Bulk export menu data
- `MenuItemImport` — Bulk import menu items
- `MenuItemExportJob` — Queued export processing

### Customer Imports
- `CustomerImport` — Bulk import customer data
- `ImportCustomerDataJob` — Queued import processing

---

## 10. Design System

> Full details in `DESIGN.md`

### Brand Identity
- **Primary (Deep Teal)** — `#0d3c38` — Navigation, headers, brand expression
- **Secondary (Soft Amaranth)** — `#a33b38` — Action buttons, active states, alerts
- **Tertiary (Elegant Charcoal)** — `#202020` — Primary text and icons
- **Neutral (Soft Gray/White)** — `#f8f9fa` — Background surfaces

### Typography
- **Manrope** — Primary typeface (headings, body, titles)
- **Hanken Grotesk** — UI labels, metadata, badges

### CSS Variable System
The color system uses CSS custom properties via Tailwind:
- `text-skin-base` / `bg-skin-base` — Deep Teal (primary)
- `text-skin-secondary` / `bg-skin-secondary` — Soft Amaranth (secondary)
- Surface colors use `bg-skin-base/10`, `bg-skin-secondary/10` for tonal variants

### Elevation Levels
- Level 0: Base background
- Level 1: White cards with 1px border
- Level 2: Soft shadow on hover/interaction
- Level 3: Strong shadow + backdrop blur for modals

### Available Classes
The Tailwind config (`tailwind.config.js`) extends the default theme with skin-based color tokens. All `.blade.php` files have been migrated from hardcoded purple/indigo/violet/fuchsia/magenta classes to skin tokens.

---

## 11. Installation & Setup

### Requirements
- PHP >= 8.2
- MySQL >= 5.7 or PostgreSQL
- Composer
- Node.js & npm/pnpm
- Web server (Apache/Nginx)

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url> hyamii
   cd hyamii
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Edit `.env` with your database, Pusher, mail, and storage credentials.

4. **Install Node dependencies**
   ```bash
   npm install
   # or
   pnpm install
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Storage linking**
   ```bash
   php artisan storage:link
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Serve the application**
   ```bash
   php artisan serve
   ```

### Web Installer
An alternative installation wizard is available via `froiden/laravel-installer` at `/install`.

---

## 12. Build & Deployment

### Development
```bash
npm run dev
```
Starts Vite dev server with hot module replacement.

### Production Build
```bash
npm run build
```
Builds assets via Vite and optionally uploads to S3 via a custom script.

### Environment Configuration
Key `.env` variables:
- `DB_*` — Database connection
- `PUSHER_*` — Pusher credentials for real-time features
- `STRIPE_*`, `PADDLE_*`, `PAYPAL_*` — Payment gateway keys
- `AWS_*` — S3 file storage
- `MAIL_*` — Mail configuration
- `VONAGE_*` — SMS via Vonage
- `GOOGLE_TRANSLATE_API_KEY` — Auto-translation

---

## 13. Development Guidelines

### Code Conventions
- **Strict typing** — Use `declare(strict_types=1)` in all PHP files
- **Naming** — Follow Laravel conventions: camelCase methods, snake_case DB columns, PascalCase classes
- **Routes** — Web routes in `routes/web.php`, API routes in `routes/api.php`
- **Livewire** — Components in `app/Livewire/`, views in `resources/views/livewire/`
- **Vue** — Components in `resources/js/`

### Adding a New Payment Gateway
1. Create a controller in `app/Http/Controllers/` (or `SuperAdmin/` for webhooks)
2. Create a model in `app/Models/` for gateway-specific records
3. Register routes in `routes/web.php` following the initiate → success/cancel → webhook pattern
4. Add gateway configuration file in `config/`
5. Create observer if needed in `app/Observers/`

### Creating a New Module
1. Use `php artisan module:make <ModuleName>`
2. Register module in `config/modules.php`
3. Create Livewire components using `mhmiton/laravel-modules-livewire` conventions
4. Add module permissions and plan associations

### Testing
- PHPUnit tests in `tests/Feature/` and `tests/Unit/`
- `TestCase.php` extends Laravel's base test case
- Run tests: `phpunit` or `php vendor/bin/phpunit`

### Observers
Observers are auto-discovered and registered. When creating a new model, create a corresponding observer in `app/Observers/` and register it in `App\Providers\EventServiceProvider`.

### Language Files
- `lang/` directory contains translation files
- `app/Models/LanguageSetting.php` manages supported languages
- Google Translate integration for auto-translation via `tanmuhittin/laravel-google-translate`
- Translation management UI via `barryvdh/laravel-translation-manager`

---

## Appendix: Key Models (111 total)

### Core Domain
| Model | Purpose |
|---|---|
| `Restaurant` | Tenant restaurant entity |
| `Branch` | Restaurant location/branch |
| `User` | Staff user (Jetstream) |
| `Customer` | Diner/consumer |
| `Table` | Physical restaurant table |
| `Area` | Table grouping area |
| `Menu` | Restaurant menu |
| `MenuItem` | Individual menu item |
| `ItemCategory` | Menu item grouping |
| `ModifierGroup` | Customization group (e.g., "Choose sides") |
| `ModifierOption` | Individual option within a group |
| `Order` | Customer order |
| `OrderItem` | Line item within an order |
| `Kot` | Kitchen Order Ticket |
| `KotItem` | Line item within a KOT |
| `Reservation` | Table reservation |
| `Payment` | Payment transaction |

### Configuration
| Model | Purpose |
|---|---|
| `RestaurantSetting` | Per-restaurant settings |
| `KotSetting` | KDS configuration |
| `ReceiptSetting` | Receipt template config |
| `ReservationSetting` | Booking preferences |
| `OrderNumberSetting` | Order numbering scheme |
| `Printer` | Network/local printer config |

### Billing
| Model | Purpose |
|---|---|
| `Package` | Subscription plan |
| `GlobalInvoice` | Invoice record |
| `GlobalSubscription` | Subscription record |
| `PackageModule` | Module-per-plan mapping |
| `OfflinePlanChange` | Manual plan change request |

### Payment Gateways
| Model | Purpose |
|---|---|
| `PaymentGatewayCredential` | Per-restaurant gateway keys |
| `StripePayment` | Stripe transaction record |
| `PaypalPayment` | PayPal transaction record |
| `MolliePayment` | Mollie transaction record |
| `FlutterwavePayment` | Flutterwave transaction record |
| `PaystackPayment` | Paystack transaction record |
| `RazorpayPayment` | Razorpay transaction record |
| `XenditPayment` | Xendit transaction record |
| `TapPayment` | Tap transaction record |
| `EpayPayment` | E-payment record |
| `AdminPayfastPayment` | Payfast payment record |

---

## Appendix: Event Flow Examples

### Placing an Order
1. `PosController` or Livewire component creates `Order` and `OrderItem` records
2. `OrderObserver::created()` fires `NewOrderCreated` event
3. `NewOrderCreated` broadcasts via Pusher to KDS screens
4. Kitchen accepts order → `KotUpdated` event → status feed updates
5. Order prepared → status changes to "Ready" → `TodayOrdersUpdated` event
6. Waiter delivers → `OrderUpdated` event → status to "Served"
7. Payment initiated → `StripeController` (or other) → `PaymentObserver`
8. Payment confirmed → order status to "Completed"

### Making a Reservation
1. Customer books online → `ReservationController::store()`
2. `ReservationObserver` fires `ReservationReceived` event
3. Restaurant notified via `NewReservationForRestaurant` notification
4. Staff confirms → `ReservationStatusUpdated` event
5. `ReservationConfirmationSent` notification sent to customer

---

*This documentation was generated from the project source. For design-specific details, see `DESIGN.md`. For project memory and onboarding, see `AGENTS.md`.*
