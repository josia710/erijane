# 02 — Unknowns — chloe pixel-match

**Goal:** Match https://chloeting.com/ structure, format, animations, scrolling, carousels. Keep Erijane brand.  
**Date:** 2026-08-03  
**Sources:** [Blind spot](d5a25833-5424-441a-a3fb-839b3fbe3b2c) · [Live scrape](fbb0119f-07ca-47bb-9c6a-cb4388f73181) · [Pathfinder](87afc072-9420-4522-9aa2-56f1e947be15)

## Blind spot — three failure modes
1. Merch sold as “carousel” while only CSS snap — live = `ant-carousel` + slick + mobile peek `padding: 0 0 0 29%`
2. Hero wrong — live uses `homepage-background-2025` cover; local has `hero_bg` unused, gradient collage instead
3. False “done” via skillui Poppins/Ant tokens or prior outcome that accepted non-pixel

## Live section order (from index.js — confirm CDP)
1. Hero → 2. Programs → 3. Recent videos (API hydrate) → 4. Merch (desktop alt / mobile slick) → 5. Recipes (API hydrate) → 6. Community CTA (conditional) → Footer  
Ads slots exist live — **skip** (forbidden/gold-plate).

Local always renders Videos/Recipes/Community (good IA match once hydrated); diverge on merch motion + hero bg + hero type.

## Unknown types

| ID | Finding | Type |
|----|---------|------|
| U1 | Exact slick settings (autoplay, dots, speed, slidesToShow, center/peek) | known unknown |
| U2 | Desktop merch component vs mobile carousel | known unknown |
| U3 | skillui Poppins/#40a9ff vs root DESIGN Manrope | mislabeled |
| U4 | Scope home-only vs sitewide | interview |
| U5 | Embla vs slick-vanilla vs Swiper (ban Ant React) | interview — advisor: don't pre-lock Embla until CDP |
| U5b | DESIGN.md §6 MOTION 3 forbids goal — amend at Gate B | known known (advisor) |
| U6 | Live hero **Poppins** vs DESIGN/AuthTest Manrope-only | interview / brand fence |
| U7 | Unused `hero_bg` asset | unknown known |
| U8 | Prior outcome accepted non-pixel; STATE “done” mislabeled for motion | mislabeled |
| U9 | Keep Erijane + disclaimer | forbidden |
| U10 | Auth rate-limit missing (security audit) — out of pixel scope unless asked | known known |

## Approaches
1. **Smallest:** home — Embla merch + hero_bg + section polish; keep Manrope
2. **Clean:** shared carousel component → home then store
3. **Prototype first:** grilling Embla vs snap vs slick-vanilla in `prototypes/`

## Interview (open)
T1 scope · T2 carousel · T3 tokens/Manrope vs live Poppins hero · approve execute

## Audits rolled in
- Testing ([9739420e…](9739420e-c4a9-46b7-8889-6ba7d005b45f)): auth sad paths, Livewire filters, extra 404s — Stage C/D or follow-up, not pixel blocker
- Eloquent/security ([fdbbef10…](fdbbef10-425c-4d60-88e0-4f772e0b0125)): User OK; **throttle login/signup** High — separate ticket
