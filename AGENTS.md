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
- Custom home fully rebuilt & shipped: clean responsive Bootstrap layout (`hy-section`, `hy-card`, `hy-media`, `hy-cta`, `hy-footer`, `hy-btn`, `hy-pill`, `hy-stat`, `hy-quote` classes in Blade `<style>`), Bootstrap grid `row`/`col` for all sections, controlled image sizing via `aspect-ratio` + `object-fit:cover`. Retains Swiper brand slider, Swiper testimonials, PureCounter stats, custom cursor (`#magic-cursor`/`#ball`, `tp-magic-cursor` body class), Bootstrap accordion FAQ. Manrope/Hanken fonts. Deployed & verified live (https 200, hero/sections/assets all 200).
- Fixed `landing_home_setting()` helper (native array_replace_recursive). Migration for `landing_home_settings` table ran earlier; row exists.
- Cleaned git: removed accidentally-tracked `storage/framework/cache|views` generated files; amended commit `bfa81b5`. Force-pushed to origin/master.
### Active
- (none — current task complete)
### Blocked
- (none)

## Next Move
- Optional polish if user requests: add subtle scroll-reveal animations (AOS/IntersectionObserver) to cards; tune hero/about image sources via CMS upload; add a pricing section. Otherwise done.

## Relevant Files
- `resources/views/landing/custom-home.blade.php`: live page (clean responsive layout).
- `public/vendor/custom-home/css/main.css`: recolored template CSS; `:root` fonts = Manrope/Hanken.
- `public/vendor/custom-home/js/`: animation libs kept (swiper-bundle, purecounter, tp-cursor, slider-init, main, plugin, bootstrap-bundle, jquery).
- `public/vendor/custom-home/images/`: template images.
- `app/Helper/start.php`: `landing_home_setting()`, `landing_home_image()`.
- `app/Models/LandingHomeSetting.php`: `defaults()` nested structure.
- VPS `/var/www/hyamii`: deploy target (SSH `id_ed25519_opencode`); site at `hyamii.com` (80/443).

## Recent Commits
- `bfa81b5` fix: clean responsive layout for custom home (Bootstrap grid + hy- classes, Manrope/Hanken fonts)
- `d53f853` Blend template richness with clean restraint on custom home
