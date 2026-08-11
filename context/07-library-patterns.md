# Library patterns — Erijane

## Stack versions
| Lib | Version / notes |
|-----|-----------------|
| PHP | 8.3 |
| Laravel | 13 |
| Livewire | 4 (SFCs under `resources/views/components/`) |
| Tailwind | 4 |
| Filament | ^5.6.5 (installed 5.7.x) — hybrid admin CMS |
| Auth | Laravel session + optional Breeze-like existing controllers |

## Auth
- Public: existing `AuthenticatedSessionController` / `RegisteredUserController`; assign new users `role=member`
- Filament: `canAccessPanel` allows `admin` and `editor` only
- Protect content mutations via Policies (`viewAny`, `create`, `update`, `delete`)
- How to protect a route: `middleware('auth')` public; Filament panel auth for `/admin`

## Database
- How to add a table/model: migration → model → factory → seeder → Filament resource → feature test → wire public view
- Query conventions: `published()` scope for public indexes; `orderBy('sort')` or `orderByDesc('published_at')`
- Migrations vs dashboard: schema via migrations only; content via Filament/seeders

## Storage / files
- Upload path: Filament FileUpload → `disk('public')` directories `programs`, `videos`, `recipes`, `products`
- Public URL: `App\Support\Media::url()` resolves `public/` seed paths **or** `storage/app/public` uploads
- Run once: `php artisan storage:link`
- Keep existing `public/images/chloe/*` and `public/images/erijane/*` as seed assets; new uploads go to storage

## AI / external APIs
- None in v1
- Never log secrets

## Analytics
- None required in v1

## Filament patterns
- One Resource per catalog model
- Use form + table + view pages as needed
- Media: `FileUpload` with image editor optional
- Navigation groups: Content (Programs, Videos, Recipes, Products), Site (Home blocks, Community, About, Settings), Users (admin only)

## Livewire / public
- Prefer SFC under `resources/views/components/`
- Controllers/closures load Eloquent; avoid reading catalogs from `config/chloe.php` after cutover

## Before using a new third-party lib
1. Read this file + Context7 / official docs
2. Add a short pattern note here after first use
3. Prefer maintained libs (Filament, Laravel) over custom admin wheels
