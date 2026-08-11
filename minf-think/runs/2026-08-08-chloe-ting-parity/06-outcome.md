# 06 — Outcome — chloe-ting parity scope A

**Date:** 2026-08-08  
**Status:** done  
**Grill lock:** A · 1 · M · S · T · E · L

## Shipped

### Home
- Hero background + phone collage + `.home-reveal` stagger
- Embla carousels: merch (mobile peek, desktop 160px gutters, 320×399) + videos (4-up, rounded)
- Programs / recipes / community sections match live IA
- `scripts/verify-merch-motion.mjs`, `measure-merch.mjs`, `measure-home-hero.mjs`

### Chrome
- Nav: h-14, `#f7f7f7` surface, centered links, Sign Up filled / Log In outline
- Footer: Support + Socials columns (5 icons)
- Auth shell: Welcome Back / Track Your Progress titles, Google stub, flat forms

### Indexes + shows
- Programs **Latest Challenges** — home-style pastel cards
- Videos **Latest Workouts** — 16:10 rounded thumbs
- Recipes — 10px radius, View Full Recipe
- Store **Merch** — portrait grid
- Show templates per type (program/video/recipe/store)

### Static / routing
- `/community` → shared community CTA partial (same as home)
- `/journey` → redirect `/login` (live nav parity)
- `/about` → study disclaimer + support stubs
- Nav **My Fitness Journey** → login route

### Verify
- `php artisan test` → **28/28**
- `npm run verify:parity` → all measure scripts green
- `tests/Feature/ParityShellTest.php` — shell assertions

## Accepted deltas (documented)
- Erijane brand vs Chloe Ting wordmark
- Manrope vs live Poppins on hero (brand E)
- Internal `/store` vs store.chloeting.com
- Legal pages as about stubs (scope A)
- No logged-in app / community forum
- Local image catalog vs full live content crawl

## Commands
```bash
php artisan serve
npm run build
php artisan test
npm run verify:parity
```

## Rollback
Revert commits on `resources/views`, `resources/css/app.css`, `resources/js/app.js`, `config/chloe.php`, `routes/web.php`, `scripts/`, `tests/Feature/ParityShellTest.php`.
