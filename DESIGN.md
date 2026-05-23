---
name: Hyamii UI
colors:
  surface: '#f8f9fa'
  surface-dim: '#d9dadb'
  surface-bright: '#f8f9fa'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f4f5'
  surface-container: '#edeeef'
  surface-container-high: '#e7e8e9'
  surface-container-highest: '#e1e3e4'
  on-surface: '#191c1d'
  on-surface-variant: '#404847'
  inverse-surface: '#2e3132'
  inverse-on-surface: '#f0f1f2'
  outline: '#717977'
  outline-variant: '#c0c8c6'
  surface-tint: '#3b6661'
  primary: '#002522'
  on-primary: '#ffffff'
  primary-container: '#0d3c38'
  on-primary-container: '#7ba6a1'
  inverse-primary: '#a2cfc9'
  secondary: '#a33b38'
  on-secondary: '#ffffff'
  secondary-container: '#fe8078'
  on-secondary-container: '#741819'
  tertiary: '#202020'
  on-tertiary: '#ffffff'
  tertiary-container: '#353535'
  on-tertiary-container: '#9f9e9d'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#beebe5'
  primary-fixed-dim: '#a2cfc9'
  on-primary-fixed: '#00201d'
  on-primary-fixed-variant: '#224e49'
  secondary-fixed: '#ffdad7'
  secondary-fixed-dim: '#ffb3ad'
  on-secondary-fixed: '#410004'
  on-secondary-fixed-variant: '#832423'
  tertiary-fixed: '#e5e2e1'
  tertiary-fixed-dim: '#c8c6c5'
  on-tertiary-fixed: '#1b1b1b'
  on-tertiary-fixed-variant: '#474746'
  background: '#f8f9fa'
  on-background: '#191c1d'
  surface-variant: '#e1e3e4'
typography:
  display-lg:
    fontFamily: Manrope
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Manrope
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: Manrope
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  headline-md:
    fontFamily: Manrope
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  title-lg:
    fontFamily: Manrope
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Manrope
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Manrope
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Hanken Grotesk
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.05em
  caption:
    fontFamily: Hanken Grotesk
    fontSize: 12px
    fontWeight: '400'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  container-max: 1280px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 40px
  stack-sm: 4px
  stack-md: 12px
  stack-lg: 24px
---

## Brand & Style

The brand identity is built on the intersection of hospitality and high-technology. It aims to evoke a sense of **quiet confidence, seamless efficiency, and culinary prestige**. The design caters to two distinct users: the sophisticated diner looking for a frictionless ordering experience and the busy restaurateur requiring high-density, actionable data at a glance.

The visual style is **Corporate Modern with a Minimalist edge**. It moves away from the generic "tech-blue" into a more culinary-inspired palette, using refined color choices to signal quality. The interface utilizes generous whitespace to reduce cognitive load during high-pressure dining hours, paired with subtle depth to guide the user's attention through complex ordering workflows.

## Colors

The color palette is grounded in "Deep Teal" (Primary), a color that conveys stability and high-end aesthetics, providing a more premium feel than standard black or blue. "Soft Amaranth" (Secondary) is used sparingly as a functional accent for primary actions and alerts, providing a warm, appetizing contrast.

- **Primary (Deep Teal):** Brand expression, primary navigation backgrounds, and high-level headers.
- **Secondary (Soft Amaranth):** "Add to Order" buttons, active state indicators, and critical path highlights.
- **Tertiary (Elegant Charcoal):** Primary text and iconography to ensure high legibility.
- **Neutral (Soft Gray/White):** Surface backgrounds and subtle dividers to maintain a "light" and airy feel even in data-heavy dashboard views.

The system defaults to **Light Mode** to maintain a clean, hygienic aesthetic suitable for food service environments, though a high-contrast dark mode is supported for low-light evening dining.

## Typography

This design system uses **Manrope** as the primary typeface for its modern, geometric construction that remains highly legible in both large display formats and small body text. It provides a balanced, professional tone that feels both technical and human.

**Hanken Grotesk** is introduced for labels and functional metadata. Its slightly more condensed and sharp character works perfectly for UI-specific elements like table numbers, price tags, and status badges, where space is at a premium and clarity is paramount. 

Typography hierarchy emphasizes clear item naming (Title LG) and price visibility, ensuring the menu remains the hero of the experience.

## Layout & Spacing

The layout utilizes a **fluid grid system** on mobile to maximize screen real estate for menu browsing, while transitioning to a **fixed-width centered layout** on desktop dashboards to prevent line lengths from becoming unreadable.

- **Desktop Dashboard:** 12-column grid with a fixed sidebar (280px).
- **Consumer Menu:** A 2-column or 3-column card-based fluid grid that reflows based on screen width.
- **Vertical Rhythm:** An 8px baseline grid ensures consistent spacing between elements. Elements are grouped using "Stack" units (4px, 12px, 24px) to create clear proximity relationships between images, titles, and descriptions.
- **Safe Zones:** Generous bottom padding is reserved for fixed "View Cart" or "Check Out" bars on mobile to ensure they don't obscure content.

## Elevation & Depth

To maintain a premium feel, the design system avoids heavy shadows, instead using **tonal layers and soft ambient depth**:

- **Level 0 (Base):** The main background (Neutral #F9FAFB).
- **Level 1 (Cards/Containers):** Pure white (#FFFFFF) with a 1px soft border (#E5E7EB) and no shadow. This is used for menu items and list rows.
- **Level 2 (Active/Hover):** A very soft, diffused shadow (0px 4px 20px rgba(13, 60, 56, 0.05)) to indicate interactivity or to lift a focused card.
- **Level 3 (Modals/Overlays):** A more pronounced shadow with a background backdrop-blur (12px) to focus the user on critical actions like "Confirm Order" or "Payment."

This approach creates a tactile, clean environment that feels like a well-organized physical menu.

## Shapes

The shape language is **Rounded**, striking a balance between the precision of professional software and the warmth of hospitality. 

- **Containers & Cards:** Use a base radius of 0.5rem (8px) to feel approachable but structured.
- **Interactive Elements:** Buttons and input fields mirror this 8px radius to maintain consistency.
- **Badges/Chips:** Status indicators (e.g., "Veg," "Popular," "Paid") use a pill-shape (full radius) to distinguish them from actionable buttons.
- **Imagery:** Food photography should always use the `rounded-lg` (16px) or `rounded-xl` (24px) setting to create a soft, inviting frame for the dishes.

## Components

### Buttons
- **Primary:** Deep Teal background with White text. Bold, authoritative.
- **Secondary:** Transparent with Deep Teal border. For less critical actions.
- **Action (Ghost):** Soft Amaranth text with no background. Used for "Add more" or "Customize."

### Menu Cards
Menu cards feature a fixed-aspect-ratio image (1:1 or 4:3) on the left or top. The title is Manrope 600, with the price highlighted in the Primary color. A prominent "+" icon in Soft Amaranth is positioned at the bottom right for quick adding.

### Status Indicators
Use a tonal background system:
- **Pending:** Soft Yellow background / Dark Brown text.
- **Completed:** Soft Green background / Dark Green text.
- **Cancelled/Urgent:** Soft Red background / Dark Red text.

### Input Fields
Minimalist design with a 1px border. On focus, the border transitions to Primary (Deep Teal) with a subtle 2px outer glow in a semi-transparent teal. Labels are always persistent above the field using Hanken Grotesk.

### Dashboards
Use high-density tables for the POS view with alternating row colors. Ensure "Live Orders" have a pulsing indicator in the sidebar to denote real-time activity.