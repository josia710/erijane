# Memory — Erijane
Updated: 2026-08-11

## Current state
- Phases 1–4 complete: Filament CMS + catalog + site chrome + listing/auth/community parity wave
- Brand: Erijane teal `#026068`, Manrope, Gilroy wordmark PNGs
- Visual ref: Chloe Ting IA; curated `DESIGN.md` beats SkillUI Ant/Poppins

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
- Community: `community-cta` + `community-forums-shell`
- SkillUI packs under `context/designs/skillui-pages/` + home `skillui-out/`
- UI registry: `context/ui-registry.md`

## Next session
- Start at: optional — a11y visible auth labels; real Erijane socials/media; commit/PR
- Watch outs: SkillUI recipes PNGs unreliable; no payments; filter Ant tokens
- Commit/PR when user asks
