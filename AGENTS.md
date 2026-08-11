# AGENTS.md — Erijane

Instruction manual for coding agents. **Context files are knowledge; this file is how to use them.**

## Stack
- Laravel 13, Livewire 4, Tailwind 4, PHP 8.3
- Filament admin (hybrid CMS); public site Blade/Livewire
- Visual reference: https://chloeting.com/ (IA/shell) · Brand: Erijane

## Commands
```bash
composer install
npm install && npm run build
php artisan serve
php artisan test --filter=RouteSmokeTest
php artisan storage:link
```

## Reading order (Must)

1. This file
2. `context/01-product-overview.md`
3. `context/02-architecture.md`
4. `context/03-folder-structure.md`
5. `context/04-code-standards.md`
6. `context/09-progress-tracker.md`
7. `context/08-build-plan.md`
8. Feature-specific: UI → `05-ui-rules.md` + `06-design-tokens.md` + `context/designs/SITE_MAP.md` + `context/designs/skillui-out/chloeting-design/SKILL.md` (or `@chloeting-design`); data/API → architecture + `07-library-patterns.md`
9. Always load `07-library-patterns.md` before third-party libraries
10. `context/memory.md` if present
11. Locked decisions: `context/decisions/`

Confirm in one line when loaded.

## Skills — when to run

| Skill | Trigger |
|-------|---------|
| `/minf-architect` | Before complex features; schema/auth/billing |
| `/minf-golden` / `/minf-pipeline` | Lane dispatch / multi-session execute |
| remember save / restore | End/start of session → `context/memory.md` |
| review | After non-trivial feature |
| recover | Stuck, drift, env confusion |
| imprint | After UI → `context/ui-registry.md` |
| laravel-backend-expert / Livewire SFC | Implement public features under `resources/views/components/` |

## Hard rules

- Do not guess product decisions — ask or run `/minf-architect feature`
- Update `09-progress-tracker.md` after every feature
- No hard-coded design hex when tokens exist
- Fail loud; verify before claiming done
- Prefer surgical diffs; no speculative scope
- **Store is catalog-only** — no payments unless Decision 1 is reopened
- **Keep Chloe public IA** (routes/labels)
- Stop for approval on destructive migrations / auth model changes

## AI Team Configuration
Routing: `Obsidian Vault/minf-think/agent-map.md` + `/minf-pipeline`.  
Implement: laravel-backend-expert patterns; Livewire SFC under `resources/views/components/`.  
Review: RouteSmokeTest + browser side-by-side vs https://chloeting.com/ (shell) with Erijane content.

## Stack bias
- Follow `context/07-library-patterns.md`
- Hernanz: simplest that meets requirements; maintained libs; no backward-compat obligation unless stated
