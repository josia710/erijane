# Spec — Chloe Ting public shell parity (Wave 1 Home)

**Date:** 2026-08-08  
**Grill lock:** A · 1 · M · S · T · E · L  
**STATE:** `d:\chloeting-clone\STATE.md`

## Problem Statement

The local Erijane Laravel clone should match https://chloeting.com/ public marketing UI — layout, cards, and motion — without copying trademark branding or backend auth.

## Solution

Measure live with Playwright/CDP, fix gaps in Blade + Tailwind + Embla on home first, then shared chrome, indexes, and one show template per content type. Keep Erijane wordmark, disclaimer, and internal `/store` CTA.

## User Stories

1. As a visitor, I see the same home section order as live (hero → programs → videos → merch → recipes → community).
2. As a visitor, hero uses live background art and phone collage layout on desktop.
3. As a visitor, merch carousel peeks the next slide on mobile and uses live-like desktop gutters.
4. As a visitor, videos carousel shows rounded landscape thumbs with title/date and autoplay loop.
5. As a visitor, program cards use pastel beds and hover scale like live.
6. As a visitor, recipes block shows featured recipe + category rows like live.
7. As a visitor, community CTA shows checklist + app mock card like live.
8. As a visitor with reduced motion, carousels do not autoplay and peek padding is removed.
9. As a developer, `RouteSmokeTest` stays green after each slice.
10. As a developer, `verify-merch-motion.mjs` and measure scripts pass against local + live baselines.

## Implementation Decisions

- **Stack:** Laravel 13 · Livewire 4 · Tailwind 4 · Embla + Autoplay
- **Brand:** Erijane assets; Chloe layout/motion as visual reference only
- **Carousel engine:** Embla (locked 2026-08-03); no Ant Design React
- **Verify:** Playwright measure scripts in `scripts/`; screenshots in `prototypes/`
- **Home hero:** `homepage-background-2025` cover; `.home-reveal` stagger; Manrope (accepted vs live Poppins)
- **Merch desktop:** 160px viewport gutters; 320×399 slides (live CDP Aug 2026)
- **Auth:** signup/login shell UI only in later slice

## Testing Decisions

- External behavior only: route smoke, carousel motion, padding/slide dimensions
- Prior art: `RouteSmokeTest`, `verify-merch-motion.mjs`, `measure-merch.mjs`, `measure-home-hero.mjs`
- Manual: side-by-side browser QA after each home section

## Out of Scope

- Legal pages (Privacy, Terms, FAQs) as real routes
- Logged-in app / journey backend
- Full catalog of program/video/recipe detail pages
- Live ad slots · hotlinked CDN assets · payment/video streams

## Further Notes

- Plan MCP offline this session — spec lives in repo + STATE until Plan URL available
- Prior run: `minf-think/runs/2026-08-03/chloe-pixel-match/`
