# Build plan — Erijane

Phased features. Architect before complex ones. Update when pivoting.

## Phase 1 — Foundation
| ID | Feature | Acceptance | Status |
|----|---------|------------|--------|
| 01 | Context pack + decisions locked | `context/` 01–09 + AGENTS.md exist; decisions file dated | done |
| 01b | SkillUI ultra design system (chloeting.com) | Package under `context/designs/skillui-out/`; SITE_MAP; skill installs | done |
| 02 | Roles on users + policies | `admin`/`editor`/`member`; feature tests for access | done |
| 03 | Filament panel install | `/admin` login; only admin/editor enter | done |
| 04 | Migrate catalogs off config | Program, Video, Recipe, Product models + seeders; public pages read DB | done |
| 05 | Filament CRUD for catalogs | Full CRUD each resource; soft deletes optional | done |

## Phase 2 — Site chrome & brand pages
| ID | Feature | Acceptance | Status |
|----|---------|------------|--------|
| 06 | Site settings + nav/socials CMS | Layout reads DB/settings; Chloe IA labels preserved | done |
| 07 | Home + Community + About CMS | Page sections CRUD; seeded from business plan copy | done |
| 08 | Erijane content pass | Store lines (women’s/men’s), mission/vision/values, founder story in About | done |
| 09 | Auth member path | Signup creates `member`; no Filament access | done |

## Phase 3 — Polish / leverage
| ID | Feature | Acceptance | Status |
|----|---------|------------|--------|
| 10 | Media UX + empty states | Required alts; public empty copy; storage link docs | done |
| 11 | Cart shell sanity | UI-only cart; no payment affordances that imply checkout | done |
| 12 | Remove legacy `config/chloe.php` catalogs | Config thin or deleted; tests still green | done |
| 13 | Payments / Shopify | Out of scope until product re-opens Decision 1 | cut |

## Phase 4 — Listing + auth page parity (proposed)
| ID | Feature | Acceptance | Status |
|----|---------|------------|--------|
| 14 | SkillUI per-page packs (7 URLs) | `context/designs/skillui-pages/{name}/` + SITE_MAP index | done |
| 15 | Community decision lock | A CTA / B forums shell / C hybrid — see `decisions/2026-08-11-page-parity.md` | done |
| 16 | Programs / Videos / Recipes listing chrome | Side-by-side vs SkillUI PNGs; curated tokens; MOTION 3 | done |
| 17 | About + Login + Signup shells | Match live layout; no real Google OAuth | done |
| 18 | Community per locked option | CTA polish or forums UI shell (no real backend) | done |
| 19 | Parity tests beyond home | Listing/auth structure asserts; optional measure script | done |

Feature plan: `context/plans/2026-08-11-page-parity.md`

## Pivot log
| Date | Change | Why |
|------|--------|-----|
| 2026-08-11 | Catalog-only store; roles; keep Chloe IA; Filament hybrid | Architect grill |
| 2026-08-11 | Phase 4 listing/auth SkillUI parity wave | Golden + architect feature |

## Notes
- Status: `todo` · `doing` · `done` · `cut` · `proposed`
- Mirror statuses in `09-progress-tracker.md`
- After Phase 3: optional socials/media uploads; Phase 4 is visual parity for secondary pages
