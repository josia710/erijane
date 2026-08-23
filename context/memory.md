# Memory — Erijane
Updated: 2026-08-23

## Current state
- Phases 1–4 complete: Filament CMS + catalog + site chrome + listing/auth/community parity wave
- Brand: Erijane teal `#026068`, Manrope, Gilroy wordmark PNGs
- Visual ref: Chloe Ting IA; curated `DESIGN.md` beats SkillUI Ant/Poppins
- App promo hero is an 8-layer stacked PNG collage (live `/program` positions), not a single phone image
- Listing chrome icons use measured live `/program` sizes via `.ui-icon--chevron|search|filters|meta-cal|meta-clock|social`
- Home featured recipe must tolerate empty catalog (`$recipes->first()` + `@if ($featured)`); production 500 was null array offset on `sweet-potato-pancakes`
- `php artisan db:seed` is idempotent (users `updateOrCreate`); catalog images live in `public/images/chloe` (~409 files, git-tracked)
- Extra live fetches: `php scripts/fetch-chloe-images.php` → `public/images/chloe/cdn` (about/home/program/recipes/workout-video-library). Videos live URL is `/workout-video-library`, not `/videos`.
- Public catalog thumbs live under `public/images/chloe/{programs,videos,recipes,store,hero,ui}`. Views use `Media::url()` so missing files fall back to the Erijane icon. `php scripts/map-chloe-images.php` copies the largest same-stem CDN file onto those dests (WebP dests stay WebP; a few recipe covers alias nearby CDN photos). Do not git-add the ~136MB `cdn/` dump unless asked.

## Decisions (durable)
- Catalog-only store — no payments (Decision 1)
- Roles: admin / editor / member
- Keep Chloe public IA labels/routes
- Hybrid Filament + Livewire/Blade
- Community **C**: CTA hero + forums UI shell (no backend)
- Google OAuth = disabled shell only

## Patterns established
- Listings: toolbar + featured/rail + grid; MOTION 3
- Auth: `auth-shell` two-column + `partials/auth-features`
- Community: Livewire forums chrome on `/community`; CTA stays on home
- SkillUI packs under `context/designs/skillui-pages/` + home `skillui-out/`
- UI registry: `context/ui-registry.md`

## Next session
- Start at: leftover collection CMS fields, or login/signup live chrome
- Watch outs: no programs hero on recipes/videos; recipe rating chrome is visual-only (no invented 4.1/4.3); no CTA stacked on `/community`; filter Ant tokens; video cards stay on `/videos/{slug}` (no YouTube, no invented view counts); about value cards use brand/sky not Chloe award blue; full-width rails use `programs-rail--fit` / recipes fluid 4-col — keep scroll rails in narrow split columns
- Commit/PR when user asks
