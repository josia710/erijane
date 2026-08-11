# Folder structure — Erijane

## Canonical tree

```text
chloeting-clone/
  AGENTS.md
  CLAUDE.md
  DESIGN.md                    # legacy design notes; prefer context/05 + 06
  PRODUCT.md                   # legacy; prefer context/01
  context/
    01-product-overview.md
    02-architecture.md
    03-folder-structure.md
    04-code-standards.md
    05-ui-rules.md
    06-design-tokens.md
    07-library-patterns.md
    08-build-plan.md
    09-progress-tracker.md
    decisions/
    designs/                   # optional screenshots
    memory.md                  # after /remember save
  app/
    Models/
    Policies/
    Filament/                  # Resources, Pages, Widgets
    Http/Controllers/
    Livewire/                  # if class-based; prefer SFC under resources/views/components
  database/migrations/
  database/seeders/
  resources/views/
    layouts/
    partials/
    components/                # Livewire SFCs (⚡*)
    programs|videos|recipes|store|…
  routes/web.php
  tests/Feature/
  public/images/erijane/
  config/                      # chloe.php becomes thin/legacy until removed
```

## Where new code goes

| Kind | Path |
|------|------|
| Public page view | `resources/views/{section}/…` |
| Livewire SFC | `resources/views/components/{section}/⚡*.blade.php` |
| Eloquent model | `app/Models/` |
| Filament resource | `app/Filament/Resources/` |
| Policy | `app/Policies/` |
| Migration / seeder | `database/migrations/`, `database/seeders/` |
| Feature test | `tests/Feature/` |
| Brand assets | `public/images/erijane/` |
| Architect decisions | `context/decisions/` |

## Naming
- Models singular PascalCase (`Program`, `Product`)
- Routes keep existing names (`programs`, `store.show`, …)
- Filament resources `ProgramResource`, etc.
- Slugs kebab-case, unique per table

## Do not
- Invent a second admin UI alongside Filament
- Put catalog content back into `config/chloe.php` after migration
- Add top-level folders without updating this file
