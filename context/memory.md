# Memory — Erijane
Updated: 2026-08-22

## Current state
- Phases 1–4 complete: Filament CMS + catalog + site chrome + listing/auth/community parity wave
- Brand: Erijane teal `#026068`, Manrope, Gilroy wordmark PNGs
- Visual ref: Chloe Ting IA; curated `DESIGN.md` beats SkillUI Ant/Poppins
- App promo hero is an 8-layer stacked PNG collage (live `/program` positions), not a single phone image
- Listing chrome icons use measured live `/program` sizes via `.ui-icon--chevron|search|filters|meta-cal|meta-clock|social`

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
