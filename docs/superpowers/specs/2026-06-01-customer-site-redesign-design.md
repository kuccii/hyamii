# Customer Site Redesign: Mobile-App UI

## Overview

Redesign the customer-facing restaurant ordering page (`layouts.guest` + `shop.index`) to feel like a native mobile app. Same features, same backend — pure frontend UI upgrade. Mobile-first, single-scroll layout optimized for QR-code scanning users.

## Design Principles

1. **Mobile-first** — designed for phone screens, works on tablets/desktop as is (no layout breakouts)
2. **Content-forward** — menu items are the hero; decorative sections (hero glows, "How It Works", premium CTA cards) are removed
3. **Native feel** — bottom sheets, sticky bars, swipe/scroll gestures, big tap targets
4. **Thin header, no wasted space** — restaurant info is compact, all remaining space goes to the menu

## Layout

- **Single scroll column** — full width, no sidebars, no grid breakouts at any breakpoint
- **Desktop navigation removed** — QR users don't need a multi-column layout; mobile nav is the default
- **GSAP hero animations, ambient glows, decorative sections removed** — no "How It Works", no premium CTA card, no luxury footer grid
- **Footer** — simplified to restaurant name + social links, no 4-column grid

## Sections (top to bottom)

### 1. Minimal Header
- Left: restaurant logo or name (link to menu refresh)
- Right: profile/account icon + language switcher
- No sticky header background — transparent until scroll, then solid

### 2. Restaurant Info Bar
- Compact card (~120px height) below header
- Restaurant name, subtitle/description text
- Optional: blurred hero image as background
- Badge row: star rating, delivery time estimate, distance
- On scroll, this compresses or fades into the header

### 3. Search + Category Pills
- Sticky search bar (always visible when scrolling up)
- Horizontal scrollable category pills below search
- Active pill highlighted with restaurant theme color
- Toggle for veg/halal filters (if restaurant configures them)

### 4. Menu Items (Vertical List)
- **Single column list** — no 3-column grid at any screen size
- **Item card layout:** small thumbnail (60x60px) | item name + truncated description + price | "Add" button right-aligned
- Tapping card → bottom sheet for variations/modifiers (same flow, just presented as a sheet instead of a modal)
- Infinite scroll as user scrolls down (keep existing IntersectionObserver logic)

### 5. Cart (Sticky Bottom Bar → Bottom Sheet)
- **Bar:** Always visible at bottom once items are in cart — shows item count + total price + "View Cart" button
- **Sheet:** Tapping "View Cart" slides up a bottom sheet (~70% screen height) with:
  - Item list with quantities, modifiers, line total
  - Swipe-to-delete (or minus button)
  - Note/instruction field per item
  - "Proceed to Checkout" button
- **Checkout:** Sheet expands to full screen or shows a modal for payment (same flow as current cart, just positioned as a sheet)

### 6. Secondary Pages
Accessible from header profile icon (hamburger or avatar):
- **Orders** — full-screen page (same content as current `my-orders`)
- **Profile** — slide-in from right (same content as current `profile`)
- **Book a Table** — same content, clean mobile layout
- **About / Contact** — simple page, no decorative elements

All secondary pages use the same minimal chrome (thin header, back button, bottom bar hidden when not on menu).

## Cart Bottom Sheet Details

- Trigger: tap "View Cart" button in sticky bar
- Presentation: slides up from bottom, overlays menu with backdrop blur
- Dismiss: swipe down or tap backdrop
- Content:
  - Header: "Your Order" + close button
  - Scrollable item list with quantity controls (+/-) and line total
  - Each item shows: name, modifiers (e.g., "Mushroom Sauce + ₣1,000"), quantity, line total
  - Swipe left to delete item (or minus-to-zero deletes)
  - Special instructions field per item
  - Fixed bottom area: subtotal, delivery/pickup fee (if applicable), total, "Proceed to Checkout" button
- "Proceed to Checkout" opens the existing payment flow (same modals/forms, no changes)

## Styles

- **Font:** Manrope (existing), possibly bump up font sizes for readability
- **Colors:** Use restaurant's `--color-base` theme for accents, buttons, active tabs
- **Cards:** White background (or darker in dark mode), subtle border or shadow, rounded corners (12px)
- **Tap targets:** Minimum 44x44px for all interactive elements
- **Bottom sheet:** Native-feel with drag handle bar at top, smooth spring animation
- **Sticky bar:** Subtle top border/shadow to separate it from content

## Files to Modify

| File | Change |
|------|--------|
| `resources/views/layouts/guest.blade.php` | Remove desktop nav, simplify footer, streamline CSS, replace hero section layout |
| `resources/views/shop/index.blade.php` | Replace hero section with compact info bar, remove "How It Works", premium CTA, decorative elements |
| `resources/views/livewire/shop/cart.blade.php` | Restructure to work with bottom sheet instead of sidebar cart; reorganize layout as vertical list |
| `resources/views/livewire/shop-navigation.blade.php` | Update to minimal header style (profile icon instead of hamburger drawer) |
| `resources/views/shop/*.blade.php` | Update secondary pages to use consistent minimal chrome |

## What Does NOT Change

- All Livewire components (`Cart.php`, `Orders.php`, `OrderDetail.php`, `BookATable.php`, etc.) — same backend logic
- OTP auth flow
- Payment flow
- Customer session handling
- Route structure
- QR code scanning flow
- WiFi landing page
- All features (orders, profile, bookings, addresses, about, contact)
