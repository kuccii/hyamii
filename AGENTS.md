## Objective
- Build Hyamii business/document library (done) and maintain the Laravel `custom_home` marketing site (home/features/pricing/about/contact) — fix presentation bugs and the "took too long to respond on some networks" issue.

## Important Details
- Brand: Deep Teal `#002522`, Soft Amaranth `#a33b38`. Fonts Manrope (body) + Hanken Grotesk (headings).
- VPS `72.60.188.94`, SSH key `C:\Users\impat\.ssh\id_ed25519_opencode`, web root `/var/www/hyamii`. **App runs on the HOST**: php-fpm 8.3 (socket `/run/php/php8.3-fpm.sock`) fronted by **nginx** (`/etc/nginx/sites-enabled/hyamii`), Cloudflare proxies. Deploy = `git pull && php artisan optimize:clear && php artisan view:clear` on the host (this IS effective for hyamii). Never `view:cache`.
- Standing instruction from user: **"always commit and deploy"** — commit + push + deploy after every change.
- Other VPS containers (8001 `job-hunter`, 8000 uvicorn, 8080 python, 5678 n8n, 32768 agent-zero) are UNRELATED apps — not hyamii. The earlier `:8001` curl showing Google Fonts was the `job-hunter` app, a red herring; hyamii is served by host nginx on :80/:443.
- Marketing pages extend `resources/views/landing/layout.blade.php` (shell: hy- classes, preloader, nav, footer, scripts). CMS data via `landing_home_setting()` in `app/Helper/start.php`.
- PowerShell `curl` is alias → use `curl.exe`; use `NUL` (not `$null`) with `-o` to suppress body; `grep` is not a PS cmdlet.

## Work State
### Completed
- Full document library (pitch deck, one-pager, business plan, financial model, data room, ops manual, onboarding SOP, support playbook, brand guidelines, messaging, marketing plan, merchant flyer, email/sales playbooks + templates, battlecard, social strategy/calendar/36 post graphics, showcase deck) — committed/pushed/deployed.
- Fixed about-stats "0": set static fallback text to real values.
- Realistic stats (40+ restaurants, 3k+ orders/day, 6+ cities, 99% uptime) + section consistency across pages.
- Added Contactless Table Ordering System block to all 5 pages.
- Fixed empty features services grid + pricing FAQ (controllers didn't pass `$lh`; added to `landingShared()` in `HomeController.php`).
- Fixed testimonial carousel: `public/vendor/custom-home/js/slider-init.js` now multi-slide + autoplay + pagination; added `.tp-testimonial-ai-pagination` to home/features/about + brand-styled dots CSS in layout.
- **Fixed "took too long on some networks" — two root causes:**
  1. **Google Fonts render-blocking** `<link>` to `fonts.googleapis.com`/`fonts.gstatic.com` (layout.blade.php:13-15) hung for users on networks that block/slow Google. **Fix:** self-hosted Manrope + Hanken Grotesk in `public/vendor/custom-home/fonts/` (font_0..9.woff2 + `hyamii-fonts.css`, local `@font-face`); layout now loads the local stylesheet via `asset('vendor/custom-home/fonts/hyamii-fonts.css')`. Committed/pushed.
  2. **nginx was DOWN** (`systemctl is-active nginx` = failed) → Cloudflare origin fetches failed on cache misses. **Fix:** `systemctl start nginx` + `systemctl enable nginx` (survives reboots). Config valid; now listening on :80/:443; origin responds 200 in ~0.05s. Public latency dropped from 21s/timeouts to 1.3–5.6s.

### Active
- (none) — "took too long" diagnosed and resolved; testimonial, fonts, and nginx all fixed.

### Blocked
- (none)

## Next Move
- Optional: other admin/app layouts (`resources/views/layouts/*.blade.php`, guest/auth/app) still reference Google Fonts; fix only if those areas show the same symptom.
- Monitor hyamii.com for stability; if nginx ever stops again, investigate why (crash/reboot) — `journalctl -u nginx` on VPS.

## Relevant Files
- `resources/views/landing/layout.blade.php` (shell; font link now local; testimonial pagination CSS; scripts)
- `resources/views/landing/{custom-home,features,pricing,about,contact}.blade.php`
- `public/vendor/custom-home/fonts/hyamii-fonts.css` + `font_0..9.woff2` (new self-hosted fonts)
- `public/vendor/custom-home/js/slider-init.js` (testimonial init)
- `app/Http/Controllers/HomeController.php` (`landingShared()` includes `lh`)
- VPS: `/etc/nginx/sites-enabled/hyamii` (web server; was down, now running)
