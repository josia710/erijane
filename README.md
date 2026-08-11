# Chloe Ting Clone (Laravel + Livewire)

Local recreation of [chloeting.com](https://chloeting.com/) information architecture and UI for study.

**Not affiliated with Chloe Ting.** Do not publish as an official site.

## Stack

- Laravel 13 + Livewire 4 + Tailwind 4 (Vite)
- Content: `config/chloe.php` (seeded arrays, no live API)
- Auth: session login/signup (shell matches live; Google OAuth stub only)

## Run

```bash
cd D:\chloeting-clone
composer install
npm install && npm run build
php artisan serve
```

Open http://127.0.0.1:8000

## Pages

| Route | Notes |
|-------|--------|
| `/` | Homepage (hero, programs, videos, merch, recipes, community) |
| `/programs` | Livewire filters (level, focus) |
| `/videos` | Livewire category filters |
| `/recipes` | Livewire category filters |
| `/store` | Livewire category filters |
| `/community`, `/about` | Community CTA · about/stubs |
| `/journey` | Redirects to `/login` (live nav parity) |
| `/login`, `/signup` | Auth shell (live titles + Google stub) |

## Tests

```bash
php artisan test
npm run verify:parity   # Playwright measure scripts (needs php artisan serve)
```

## Dual-orchestrator

- **Cursor:** UI / Livewire / routes
- **Verify:** browser + PHPUnit smoke
