## Objective
- Deliver a polished, CMS-driven landing page ("custom home") for Hyamii that blends template richness (Aleric animations/fonts/structure) with clean, controlled design and full responsiveness. Final direction (latest user feedback): **clean, fully-responsive Bootstrap layout with own `hy-` classes + template animations (Swiper, PureCounter, cursor) + Hyamii palette + clean Manrope/Hanken fonts** — NOT the raw Aleric template DOM (which broke image positioning & responsiveness).

## Important Details
- Hyamii colors in recolored `main.css`: Deep Teal `#002522`, Soft Amaranth `#a33b38`.
- Fonts (user-preferred): **Manrope** (body) + **Hanken Grotesk** (display headings). :root in `main.css` set to these.
- VPS: `72.60.188.94`, SSH key `C:\Users\impat\.ssh\id_ed25519_opencode`, web root `/var/www/hyamii`. Deploy = `git pull` + `php artisan optimize:clear` (+ `view:clear`).
- **VPS port gotcha:** port `8080` is an UNRELATED python3 process — do NOT curl `localhost:8080` to verify. The real Laravel app serves on `:80`/`:443` at domain `hyamii.com`. Verify with `curl -sk https://hyamii.com/`.
- Custom home live at `/` when `global_settings.landing_type='custom_home'` AND `disable_landing_site=0` (both set on VPS; confirmed 200 on https).
- `landing_home_setting()` = nested `defaults()` merged with stored `data` via native `array_replace_recursive`. Stored row EXISTS; hero resolves to "Restaurant management, made effortless." (CMS value overrides default). Structure: `hero.*`, `services.items[].title/text` (6 items), `about.*`, `faq.items[].question/answer`, `cta.*`, `contact.*`, `footer.*`, `brand.*`.
- `landing_home_image($path, $default)` returns `asset_url_local_s3('landing_home/'.$path)` or `asset('vendor/custom-home/images/'.$default)`.
- Template JS kept (animations): `swiper-bundle`, `purecounter`, `tp-cursor` (+ `plugin.js` provides gsap), `slider-init` (auto-inits `.tp-brand-slide-active`, `.tp-testimonial-ai-slide-active`), `main.js` (PureCounter, SplitType), `bootstrap-bundle`, `jquery`.
- Available images in `public/vendor/custom-home/images/`: brand-1/3/4/5/6.png, hero-shape-*, testimonial-item-1/2/3.png, thumb-main.png, thumb-2.jpg, cta-shape-2/3.png, favicon.png.

## Work State
### Completed
- Custom home fully rebuilt & shipped: clean responsive Bootstrap layout (`hy-section`, `hy-card`, `hy-media`, `hy-cta`, `hy-footer`, `hy-btn`, `hy-pill`, `hy-stat`, `hy-quote`, `hy-price`, `hy-input` classes in shared `layout.blade.php` `<style>`), Bootstrap grid `row`/`col` for all sections, controlled image sizing via `aspect-ratio` + `object-fit:cover`. Retains Swiper brand slider, Swiper testimonials, PureCounter stats, custom cursor (`#magic-cursor`/`#ball`, `tp-magic-cursor` body class), Bootstrap accordion FAQ, Hyamii-themed preloader (`.loader-wrap` + GSAP timeline in `main.js`). Manrope/Hanken fonts.
- **Site nav + public pages added**: shared `resources/views/landing/layout.blade.php` (head, preloader, sticky header nav with links to `/`, `/features`, `/pricing`, `/about`, `/contact` + mobile burger menu, footer with Privacy/Terms/Refund links, scripts). Pages extend it: `custom-home` (home), `features`, `pricing` (Starter/Growth/Enterprise tiers), `about` (values + stats), `contact` (info + form). Routes added in `routes/web.php` (with `DisableFrontend` middleware), methods added to `HomeController`. All return 200 live; footer links to existing `/privacy-policy`, `/terms-conditions`, `/refund-policy`.
- Fixed `landing_home_setting()` helper (native array_replace_recursive). Migration for `landing_home_settings` table ran earlier; row exists.
- Cleaned git: `.gitignore` now ignores `storage/framework/*` generated files; no generated files tracked. Force-pushed to origin/master.
- **Localized multi-currency pricing + country selector (shipped, commit `70ca320`)**:
  - `package_prices` table + `PackagePrice` model (package_id, currency_code, monthly_price, annual_price). `Package` gains `prices()` + `localizedPrice($code)` (currency → USD fallback).
  - `CountrySelector` middleware (`app/Http/Middleware/CountrySelector.php`): `?country=` override (session + 1-yr cookie) > `CF-IPCountry`/`X-Country` auto-detect > default **RW**. Applied to all landing routes in `routes/web.php`.
  - `PackageSeeder` rewritten (idempotent `updateOrCreate`) → **Starter / Growth ⭐ / Enterprise** tiers (RWF base) + `package_prices` for RWF/TZS/UGX/KES/BIF/USD. Keeps system `Default` + `Trial`.
  - Global country/currency `<select>` in `layout.blade.php` header (desktop + mobile). `pricing.blade.php` and `custom-home.blade.php` render prices in the visitor's selected currency (verified: `?country=RW`→RWF, `?country=TZ`→TZS, default→RWF). Home shows a "Pricing in your currency" preview band.
- **Full tutorial VIDEO — assets captured + script written**: form = video, deliverable = script + captured real screens → assembled video.
  - 27 real screenshots captured from the live TANIA demo (`admin@tania.rw` / `123456`, Rwanda deployment at `hyamii.com`) via headless-Chrome DevTools Protocol (Node script `scripts/capture-all.mjs` logs in by `fetch` POST to `/login`, then screenshots each admin URL). Saved in `tutorial-screens/*.png` (ch01-landing … ch15-upgrade).
  - Full English narration script + per-shot table + assembly notes written to `tutorial-screens/TUTORIAL-SCRIPT.md` (15 chapters, ~30–40 min deep-dive).
  - **Animation rebuilt in Remotion** (2026-08-25): `tutorial-screens/tutorial.mp4` is now a Remotion render (H.264, 1920×1080, 30fps, 17,705 frames ≈ 9:50, ~214 MB). Reuses the 27 TTS WAVs (`tutorial-screens/audio/NN.wav`, Windows `Microsoft David`) + 27 real screenshots (`tutorial-screens/*.png`). Remotion project auto-generated by the `remotion-mcp-server` at `C:\npm-cache\_npx\ed8ab2538b3c27a8\node_modules\remotion-mcp-server\assets\projects\hyamii-tutorial` (remotion v4.0.340). Composition = `VideoComposition.tsx` (chapter `CardView` title cards + per-slide `SlideView` with Ken Burns zoom, lower-third caption w/ chapter label, manual opacity crossfade via `Sequence` + `FadeWrapper`). `data.ts` = 27 SLIDES + CHAPTERS (1–15) + CARD_FRAMES=75, TOTAL_FRAMES=17705. Render cmd (run from project dir): `remotion render src/index.ts VideoComposition <out>.mp4` (use `--bundle-cache=false` the first time; a stale webpack cache caused `undefined` component / `@remotion/transitions` errors). NOTE: do NOT add `@remotion/transitions` to the project — it breaks the bundle; manual crossfade is used instead. (Original ffmpeg-based 10.4 MB cut kept at `tutorial-screens/tutorial.mp4.old`.)
  - Admin URL map discovered: dashboard `/dashboard`, menus `/menus` `/menu-items` `/item-categories` `/modifier-groups`, orders `/orders` `/kots` `/pos`, `/reservations`, `/customers`, `/staff`, `/reports/*`, `/payments`(+/expenses,/due), `/inventory/*` (VPS-only module, present on live), `/delivery-executives` `/waiter-requests`, `/rra-ebm` (Rwanda EBM tax), customer site `/restaurant/{branchHash}`, `/billing/upgrade-plan` (localized plans), `/settings`.
### Active
- (none) — tutorial fully delivered: 27 real screenshots + English script + assembled `tutorial.mp4` video. Optional polish: replace robotic TTS voiceover with a recorded/human or ElevenLabs track and rebuild.
### Blocked
- (none)

## Next Move
- (none pending) — tutorial video assets (27 screenshots) + full English script + assembled `tutorial.mp4` are complete in `tutorial-screens/`. Optional: replace robotic TTS voiceover with a recorded/human track and rebuild. Marketing site + localized Rwandan packages are complete.

## Relevant Files
- `resources/views/landing/layout.blade.php`: shared shell (head, preloader, header nav, footer, scripts, all `hy-` styles). Child pages @extend it and @yield('content').
- `resources/views/landing/custom-home.blade.php`: home page (extends layout).
- `resources/views/landing/features.blade.php`, `pricing.blade.php`, `about.blade.php`, `contact.blade.php`: public pages (extend layout).
- `routes/web.php`: `/` + `/features` + `/pricing` + `/about` + `/contact` (all `DisableFrontend` middleware) → `HomeController` methods `landing/features/pricing/about/contact`.
- `app/Http/Controllers/HomeController.php`: added `features/pricing/about/contact` methods (mirror `landing()` guard).
- `public/vendor/custom-home/css/main.css`: recolored template CSS; `:root` fonts = Manrope/Hanken.
- `public/vendor/custom-home/js/`: animation libs kept (swiper-bundle, purecounter, tp-cursor, slider-init, main, plugin, bootstrap-bundle, jquery).
- `public/vendor/custom-home/images/`: template images.
- `app/Helper/start.php`: `landing_home_setting()`, `landing_home_image()`.
- `app/Models/LandingHomeSetting.php`: `defaults()` nested structure.
- `app/Http/Middleware/CountrySelector.php`: `?country=` override + `CF-IPCountry` auto-detect; `$map` of supported countries (RW/TZ/UG/KE/BI/US) → currency.
- `app/Models/Package.php` / `PackagePrice.php`: multi-currency prices; `localizedPrice($code)`.
- `database/migrations/2026_08_24_100000_create_package_prices_table.php`: per-currency package prices.
- `database/seeders/PackageSeeder.php`: Starter/Growth/Enterprise tiers (RWF) + `package_prices` for RWF/TZS/UGX/KES/BIF/USD; keeps Default + Trial.
- VPS `/var/www/hyamii`: deploy target (SSH `id_ed25519_opencode`); site at `hyamii.com` (80/443).
- `tutorial-screens/*.png` + `tutorial-screens/TUTORIAL-SCRIPT.md`: 27 captured demo screenshots + full 15-chapter English narration script/shot list for the tutorial video.
- `scripts/capture-all.mjs`: headless-Chrome DevTools-Protocol capture script (fetch-login as `admin@tania.rw`, screenshot each admin URL). Requires Chrome launched with `--headless=new --remote-debugging-port=9222`.

## Gotchas
- **Blade scope:** variables defined in a layout's `@php` block are NOT in scope inside child `@section('content')` blocks (sections render in the child view's scope). Define `$lh`/`$img` per child page where used (done in custom-home & about; `$lh` happens to also be reachable but define explicitly to be safe).
- **Git hygiene:** `storage/framework/*` must stay untracked — `.gitignore` now covers it; never `git add -A` without checking.

## Recent Commits
- `bfa81b5` fix: clean responsive layout for custom home (Bootstrap grid + hy- classes, Manrope/Hanken fonts)
- `d53f853` Blend template richness with clean restraint on custom home
