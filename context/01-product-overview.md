# Product overview — Erijane

## One-liner
Erijane is a fitness apparel + community content site (Chloe Ting–style IA) with a Filament CMS so staff can CRUD every public section.

## Primary user
- Who: Fitness-curious adults 18–45 (beginners, body-confidence seekers, budget-conscious shoppers); secondary: faith/inspirational and social-fitness communities.
- Job-to-be-done: Discover Erijane’s story and affordable apparel; follow workout programs/videos/recipes; feel included and motivated.
- Staff job-to-be-done: Update programs, videos, recipes, store catalog, community copy, about/mission, and site chrome without deploying code.

## Success looks like
- Public pages match Chloe Ting layout patterns with Erijane brand (teal, wordmark) and business-plan messaging.
- Every section’s content is DB-backed; `admin`/`editor` can CRUD via Filament.
- Catalog store works (list/detail); cart remains non-checkout shell.
- `php artisan test --filter=RouteSmokeTest` green; side-by-side vs https://chloeting.com/ for shell parity.

## In scope (v1)
- Keep routes: `/`, `/programs`, `/videos`, `/recipes`, `/store`, `/community`, `/about` (+ show pages).
- Eloquent models + migrations for section content (replace static `config/chloe.php` as source of truth).
- Filament admin resources for all section entities + site settings (nav/socials/home blocks).
- Roles: `admin`, `editor`, optional public `member`.
- Seed from Erijane business plan + adapted existing sample data (apparel lines, mission/vision/values).
- Auth: public signup/login for members; Filament login for staff.

## Non-goals (do not build)
- Real payments, checkout, inventory sync, or Shopify embed.
- Mobile apps / Fitness Academy app (Year 2+ in plan).
- Renaming public IA away from Chloe structure.
- Streaming video hosting (YouTube/external links OK).
- Multi-tenant / multi-brand.
- Physical retail / pop-ups.

## Constraints
- Platform: Laravel 13, Livewire 4, Tailwind 4, PHP 8.3; Filament for admin.
- Study/disclaimer: not affiliated with Chloe Ting; keep footer study credit while brand is Erijane.
- Design tokens: `DESIGN.md` + `context/06-design-tokens.md` — no ad-hoc hex in features.
- Content authority: `c:\Users\Josia\Downloads\Erijane Business Plan.pdf` for brand copy; visual ref https://chloeting.com/.
- Timeline: multi-session Lane C; architect before schema migrations.

## Open questions
- [ ] Exact Filament major version compatible with Laravel 13 (pin at install) — owner: implementer, date: 2026-08-11
- [ ] Whether `member` role unlocks any private “My Fitness Journey” features beyond auth shell — deferred; default: login shell only
- [ ] Final social URLs for Erijane (replace Chloe placeholders in seeder) — owner: product, date: open
