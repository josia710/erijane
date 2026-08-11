# Architecture — Erijane

## Shape
- Style: modular monolith (Laravel)
- Frontend: Blade layouts + Livewire 4 SFCs for public interactive bits (carousels, filters if any)
- Backend: Laravel HTTP + Filament admin panel
- Data store: SQLite/MySQL via Eloquent (project default DB)
- File/object storage: public disk for product/program/video/recipe images (`storage/app/public`)
- Auth: Laravel session auth; Spatie-style or simple `users.role` enum — prefer simple `role` column unless Spatie already present

## Boundaries
| Layer | Owns | Must not |
|-------|------|----------|
| Public Blade/Livewire | Rendering, routing, member auth UI | Direct schema changes; payment logic |
| Filament resources | CRUD forms, validation, media upload | Public marketing layout |
| Eloquent models | Persistence, scopes (`published`), relationships | HTML presentation |
| Policies | `admin`/`editor`/`member` abilities | Hard-code role checks in views without Policy |
| Config | Feature flags, Filament path, brand asset paths | Content catalogs (migrate off `chloe.php`) |

## Data flow (happy path)
1. Editor logs into Filament → CRUD Program/Video/Recipe/Product/PageBlock/Setting.
2. Model saved (optional `published_at` / `is_published`).
3. Public route loads model(s) via controller or route closure / Livewire → Blade.
4. Images served from `Storage::url()` / asset helper after `php artisan storage:link`.

## Auth & tenancy
- Model: single-tenant; roles on `users.role`: `admin` | `editor` | `member`
- Session: web guard for public; Filament panel guard (same users table OK)
- Access: Filament `canAccessPanel` → admin|editor only
- Policies: admin manages users/roles; editor CRUD content resources; member public-only

## Content domains (CRUD targets)
| Domain | Table(s) | Public surface |
|--------|----------|----------------|
| Program | `programs` | `/programs`, `/programs/{slug}` |
| Video | `videos` | `/videos`, `/videos/{slug}` |
| Recipe | `recipes` | `/recipes`, `/recipes/{slug}` |
| Product | `products` | `/store`, `/store/{slug}` |
| Community feature | `community_features` | `/community` |
| About / brand pages | `page_sections` or dedicated `about_*` | `/about` |
| Home blocks | `home_blocks` / `page_sections` | `/` |
| Nav / socials / site | `site_settings` (JSON or rows) | layout partials |
| User | `users` | auth + Filament |

## Integrations
| System | Purpose | Owner module |
|--------|---------|--------------|
| Filament | Admin CRUD | `app/Filament` |
| YouTube (links) | Video embeds/outlinks | `videos.external_url` |
| Local storage | Media | Laravel filesystem |

## Non-negotiables
- Catalog-only store — no payment providers.
- Public IA routes/labels unchanged.
- Fail loud on missing published content (404), not empty silent pages for show routes.
- Schema/auth migrations require architect approval stop before first migrate in a session if destructive.

## Open questions
- [ ] Prefer polymorphic `page_sections` vs per-page models for Home/About/Community — default: `page_sections` (page_key + sort + payload) + dedicated catalog models for Program/Video/Recipe/Product
- [ ] Soft deletes for CMS entities? Default: yes for catalogs
