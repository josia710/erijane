# 06 — Outcome — chloe pixel-match home motion

**Date:** 2026-08-03  
**Status:** execute complete; visual QA recommended

## Shipped
- DESIGN.md MOTION 5 home / §6 carousel + reduced-motion
- Embla merch carousel (`resources/js/app.js`, home merch markup, CSS peek)
- Desktop hero background from live `homepage-background-2025`
- Light `.home-reveal` entrance on hero columns
- Tests: RouteSmokeTest 15/15, AuthTest 6/6; Vite build green

## Accepted deltas (not this wave)
- Live ads slots
- Live Poppins hero type (kept Manrope per T3)
- Next.js hydrate timing for videos/recipes
- Auth rate-limit (security audit — separate)
- Sitewide listing page motion

## Rollback
Revert `DESIGN.md`, `home.blade.php`, `app.js`, `app.css`, `package.json`/`package-lock.json`, delete downloaded PNG if unwanted.
