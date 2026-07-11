# Hyamii - Project Memory

## Overview
**Hyamii** (formerly TableTrack) is a commercial SaaS restaurant management system built on Laravel 12. It's a multi-tenant platform for managing restaurants, POS, orders, kitchen displays, and more.

## Tech Stack
- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Livewire 3, Vue 3, Tailwind CSS, Vite
- **Database:** MySQL/PostgreSQL
- **Real-time:** Pusher (websockets + push notifications)
- **Architecture:** Laravel Modules (nwidart/laravel-modules) for feature plugins

## Key Features
- Multi-restaurant management (SaaS)
- POS system (Vue-based and Livewire-based interfaces)
- Kitchen Display System (KDS/KOT)
- Table & reservation management
- Menu & item management with categories/modifiers
- Order management (dine-in, delivery, takeaway)
- Customer management & loyalty
- Delivery executive portal with OTP auth
- Staff management with roles/permissions (spatie/laravel-permission)
- Comprehensive reporting (sales, tax, refund, delivery, etc.)
- Multi-language support (Google Translate integration)
- Subscription/billing system (Stripe, Paddle, PayPal)
- Multiple payment gateways: Stripe, PayPal, Mollie, Paystack, Flutterwave, Razorpay, Xendit, Payfast, Tap

## Module System
Optional modules via `Modules/` directory:
- Backup, Cash Register, Inventory, Kiosk, Kitchen, Language Pack, MultiPOS, SMS, Subdomain

## Project Structure Highlights
- `app/Http/Controllers/` - Traditional controllers + SuperAdmin sub-namespace
- `app/Livewire/` - Livewire components
- `app/Models/` - Eloquent models with extensive observers
- `app/Observers/` - Model observers for caching/event handling
- `app/Services/` - Business logic services
- `routes/web.php` - Main routes (474 lines, extensive)
- `routes/api.php` - Desktop print job API + partner endpoints

## Payment Integration Pattern
Each gateway follows: initiate POST → success/cancel GET → webhook POST. Webhooks are routed under `/webhook/` with `{hash}` for restaurant identification.

## Auth
- Laravel Jetstream for restaurant staff auth
- OTP-based login for customers and delivery executives
- SuperAdmin middleware for platform admin routes

## Build Process
- `npm run dev` - Vite dev server
- `npm run build` - Vite build + upload to S3 via custom script

## Notable Dependencies
- `laravel-cashier` / `laravel-cashier-paddle` - Subscription billing
- `maatwebsite/excel` - Import/export
- `barryvdh/laravel-dompdf` - PDF generation
- `intervention/image` - Image processing
- `jantinnerezo/livewire-alert` - SweetAlert2 + Livewire
- `opcodesio/log-viewer` - Log viewing
- `ladumor/laravel-pwa` - PWA support
- `froiden/laravel-installer` - Installation wizard

## Color Migration Progress (Tailwind purple/indigo → skin system)
### Goal
Replace all purple/indigo/violet/fuchsia/magenta Tailwind color classes in `.blade.php` files with Deep Teal (`text-skin-base`/`bg-skin-base`) or Soft Amaranth (`text-skin-secondary`/`bg-skin-secondary`) per DESIGN.md color rules.

### Status: ✅ COMPLETE
- All files in `resources/views/` processed (auth, dashboard, livewire, plans, profile, billing, custom-modules, errors, vendor/froiden-envato)
- Final verification grep returns zero matches for purple/indigo/violet/fuchsia/magenta color classes
- Status badge colors preserved per DESIGN.md: Pending=Yellow, Completed=Green, Cancelled=Red, Confirmed=text-yellow-600 bg-yellow-100, Preparing=text-skin-secondary bg-skin-secondary/10

## Rwanda Localization (✅ Complete)

### Configuration
- **`.env`** - `APP_ENV=local`, `APP_URL=http://localhost:8080`, DB: `hyamii` (root, no password)
- **Access URL**: `http://localhost:8080/`
- **Vite HMR**: `http://127.0.0.1:5173/`
- **Server**: XAMPP Apache + MariaDB on Windows (`C:\xamp`)
- Apache configured with VirtualHost `*:8080` → `C:/xamp/htdocs/Hyamii/public`

### Default Credentials
| Role | Email | Password |
|------|-------|----------|
| Super Admin | `superadmin@example.com` | `123456` |
| Admin | `admin@example.com` | `123456` |
| Waiter | `waiter@example.com` | `123456` |

### Currency — RWF (Rwanda Franc)
- **Default global currency**: RWF (FRw, 0 decimals)
- **Restaurant currency**: RWF (id:1), also USD, EUR, GBP available
- All INR references removed from seeders

### Tax — VAT 18%
- SGST (2.5%) + CGST (2.5%) replaced with **VAT 18%** per branch
- Single VAT entry per branch

### Timezone — Africa/Kigali
- `GlobalSetting.timezone` set to `Africa/Kigali`

### Package Prices (RWF, ~1,300 rate)
| Package | Annual | Monthly | Lifetime |
|---------|--------|---------|---------|
| Subscription | 130,000 | 13,000 | — |
| Lifetime | — | — | 259,000 |
| Private | 65,000 | 6,500 | — |

### Demo Data (3 restaurants, all seeded)
| Entity | Per Restaurant | Total |
|--------|---------------|-------|
| Branches | 2 | 6 |
| Kigali Districts (areas) | 8 | 24 |
| Tables | 10 | 30 |
| Menu Items (Rwandan dishes) | 17 | 51 |
| Orders w/ items | 9 | 27 |
| Delivery Executives (+250) | 11 | 33 |
| Item Categories | 6 | 18 |
| Users (admin + waiter) | 2 | 7 (incl. superadmin) |

**Menu names**: "Amakuru y'Igihugu", "Indumburwa z'Abanyarwanda", "Ibinyobwa n'Indyo"
**Sample items**: Ugali na Isombe (2,500 FRw), Ibihaza (3,000 FRw), Brochettes (5,000 FRw), Kawa y'u Rwanda (1,500 FRw), Akabanga hot sauce modifier
**Delivery exec**: Rwandan names (Jean Claude, Alice, Patrick, etc.), phone code +250

### Verified ✅
- Login page renders at `http://localhost:8080/login`
- All user passwords verify correctly (bcrypt)
- Global currencies: RWF, USD, EUR, GBP (no INR)
- Taxes: VAT 18% for all branches
- Timezone: Africa/Kigali

### Database Dump
- `database/hyamii_dump.sql` — fresh dump after `migrate:fresh --seed`

## RRA EBM Module (✅ Built + Deployed)

### Overview
**RRA EBM** (Rwanda Revenue Authority Electronic Billing Machine) is a toggle-able nwidart module (`Modules/RraEbm/`) integrating Hyamii with RRA EBM API v8.2 (VSDC model). Supports global on/off (`modules_statuses.json`) plus per-branch per-sale-type toggles.

### Module Activation
```bash
php artisan module:enable RraEbm      # enable globally
# OR set in storage/app/modules_statuses.json: {"RraEbm": true}
php artisan migrate --force            # run 5 migrations
# FK fix migration fails on old Doctrine — FK is already in migration 1
```

### Architecture
- **5 migrations** — rra_ebm_settings, rra_ebm_receipt_signatures, rra_ebm_invoice_sequences, order columns (+rra_response_code, +rra_receipt_signature), FK on settings.branch_id
- **3 Entities** — `RraEbmSetting`, `RraEbmReceiptSignature`, `RraEbmInvoiceSequence`
- **4 Services** — `RraEbmService` (HTTP/URL builder), `RraInitializationService` (TIN/branch init), `RraSaleSubmissionService` (sale payload → `/trnsSales/saveSales`), `RraProductSyncService` (menu sync → `/items/saveItems`)
- **3 Queue Jobs** — `SubmitSaleToRraJob` (paid orders), `SyncProductToRraJob` (menu item CRUD), `RetryFailedRraSubmissionJob`
- **Observers** — `OrderObserver.php` (status=paid → dispatch), `MenuItemObserver.php` (create/update → dispatch)
- **Admin UI** — `AdminRraEbmController` (CRUD + initialize), 3 Blade views under superadmin sidebar
- **18 Unit Tests** — in `tests/Unit/Modules/` (RraEbmSettingTest, RraEbmServiceTest, RraProductSyncServiceTest)

### Configuration
| Setting | Description |
|---------|-------------|
| `enabled` | Per-branch toggle |
| `tin_number` | RRA TIN for the branch |
| `branch_id_rra` | Branch ID registered with RRA |
| `server_url` | RRA API base URL (e.g. `https://ebm.rra.gov.rw/ebm` or sandbox) |
| `app_name` | Application name registered with RRA |
| `device_serial_no` / `machine_reference_code` / `security_key` | Device identity |
| `auto_sync_products` | Auto-sync menu items to RRA |
| `submit_on_pos_complete` / `submit_on_online_order` / `submit_on_kiosk` | Per-sale-type toggle |

### Tax Codes
- **A**: 0% (VAT exempt)
- **B**: 18% (standard VAT)

### Deployment
- **VPS**: `72.60.188.94`, module enabled, all 5 migrations ran, FK exists
- **VPS PHP**: 8.3.6 (not 8.4+) — use `--ignore-platform-req=php` for composer
- **Code**: committed `b4d6e8c` to `origin/master`
