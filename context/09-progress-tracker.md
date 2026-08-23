# Progress tracker — Erijane

Living checklist. Update after every feature. Agents read this early each session.

## Now
- Phase: 4 complete — listing/auth/community hybrid parity wave
- Active feature: none
- Blockers: none

## Phase 4
- [x] 14 — SkillUI per-page packs (7 URLs)
- [x] 15 — Community decision lock (**C** hybrid)
- [x] 16 — Programs / Videos / Recipes listing chrome
- [x] 17 — About + Login + Signup shells
- [x] 18 — Community per locked option
- [x] 18b — `/community` live forums chrome (2026-08-22)
- [x] 19 — Parity tests beyond home

## Phase 1
- [x] 01 — Context pack + decisions locked
- [x] 01b — SkillUI ultra design system (chloeting.com end-to-end)
- [x] 02 — Roles on users + policies
- [x] 03 — Filament panel install
- [x] 04 — Migrate catalogs off config (Program/Video/Recipe/Product)
- [x] 05 — Filament CRUD for catalogs

## Phase 2
- [x] 06 — Site settings + nav/socials CMS
- [x] 07 — Home + Community + About CMS
- [x] 08 — Erijane content pass (business plan)
- [x] 09 — Auth member path

## Phase 3
- [x] 10 — Media UX + empty states
- [x] 11 — Cart shell sanity
- [x] 12 — Remove legacy config catalogs
- [x] 13 — Payments — cut

## Session log (short)
| Date | Done | Next |
|------|------|------|
| 2026-08-11 | Architect + SkillUI + Phase 1–3 CMS | Optional: real Erijane socials / media uploads |
| 2026-08-11 | Filament forms filled + FileUpload + Media storage URLs | Ship / commit when ready |
| 2026-08-11 | Architect feature page-parity + SkillUI 7-page extract | Lock Community A/B/C → go / pipeline |
| 2026-08-11 | Phase 4: auth 2-col, community C hybrid, listing chrome | Optional: re-SkillUI recipes; imprint |
| 2026-08-11 | Imprint + remember; recipes featured/rows from live IA | Commit/PR when asked |
| 2026-08-11 | git init + initial commit (screens gitignored) | Optional: remote + PR |
| 2026-08-22 | Live `/program` capture: screens + measured spec | Implement listing parity when approved |
| 2026-08-22 | Programs listing matches live chrome (hero, browse, filters, collections) | Optional: SkillUI ultra after Playwright; collection CMS fields |
| 2026-08-22 | Live `/workout-video-library` capture: screens + measured spec | Implement `/videos` listing parity when approved |
| 2026-08-22 | Videos listing matches live chrome (browse, favorites, 6-col filters, landscape rows) | Optional: collection CMS fields; recipes next |
| 2026-08-22 | Live `/recipes` capture: screens + measured spec | Implement `/recipes` listing parity when approved |
| 2026-08-22 | Recipes listing matches live chrome (browse, saved, 5-col filters, popular tiles) | Optional: collection CMS fields |
| 2026-08-22 | Program days/min meta chips: pill radius + surface fill | Commit/PR when asked |
| 2026-08-22 | Recipe card overlay pill + circular actions + star chip chrome | Commit/PR when asked |
| 2026-08-22 | Community `/c/fitness-discussions` live chrome on `/community` | Commit/PR when asked |
| 2026-08-22 | `/videos` live chrome check: 1240 Latest row, browse 0.3s, Load More 43px, duration 18px | Commit/PR when asked |
| 2026-08-22 | `/about` live chrome: hero band, story split, value cards, closing | Commit/PR when asked |
| 2026-08-22 | Listing rails: fluid fit at lg+ so rightmost cards never clip (recipes 4 / programs+videos 5) | Commit/PR when asked |
| 2026-08-22 | App-promo hero: stacked live collage (8 PNGs, 719×572) on home + `/programs` | Commit/PR when asked |
| 2026-08-22 | Shared listing icons match live `/program` sizes (`.ui-icon--*`) across programs/videos/recipes/community + footer socials | Commit/PR when asked |
| 2026-08-23 | Home no longer 500s when no published recipes (`$featured` null guard) | Deploy to erijane.minfinnovations.com |
| 2026-08-23 | `DatabaseSeeder` idempotent (`updateOrCreate` users); catalog+images re-seedable | On prod: `php artisan db:seed` + deploy `public/images` |
