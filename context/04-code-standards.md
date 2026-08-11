# Code standards — Erijane

## Language & tooling
- Language / version: PHP 8.3, Laravel 13
- Frontend: Livewire 4, Tailwind 4, Vite
- Admin: Filament (pin compatible major at install)
- Formatter: Pint (`vendor/bin/pint`)
- Test runner: PHPUnit / Artisan test

## Principles
- Karpathy: think → simple → surgical → verify
- Hernanz: simplest that meets requirements; maintained libs; no backward-compat obligation unless stated
- Fail loud — no silent `catch` that swallows errors
- Domain-first: Eloquent + policies before view tweaks for CMS work

## Errors
- Public show routes: `abort_unless` / `findOrFail` → 404
- Filament: validation messages on forms; no silent save failures
- Never empty `catch {}`

## Testing bar
- New logic: Feature tests for CRUD authorization (admin/editor/member) and public index/show for each section
- Keep/extend `RouteSmokeTest` for all public routes
- UI: manual side-by-side vs chloeting.com for shell; Filament smoke for one resource create/edit
- Done when: objective check (test filter + URL load)

## Git
- Small commits; no secrets; no `.env` commits
- Only commit when user asks

## Open questions
- [ ] Pest vs PHPUnit — keep existing PHPUnit style unless team switches
