# Decisions — Erijane CMS foundation (2026-08-11)

Locked via `/minf-architect new` grilling.

| # | Decision | Choice |
|---|----------|--------|
| 1 | Store commerce depth | **Catalog CMS only** — admin CRUD + public browse/detail; cart UI shell; **no payments** in v1 |
| 2 | Auth / who can CRUD | **Roles:** `admin` + `editor`; optional public `member` (no CMS) |
| 3 | Public IA | **Keep Chloe Ting IA** — same routes/labels; Erijane content via CMS |
| 4 | Admin UI | **Hybrid** — Filament for data; public site stays Livewire/Blade |

## Implications
- Migrate `config/chloe.php` content into Eloquent models + seeders (Erijane-branded copy from business plan where applicable).
- Policies: `admin` full CRUD; `editor` CRUD on content resources (not user/role management unless later expanded).
- No Stripe/Shopify checkout in Phase 1–2.
- Filament panel at `/admin` (or similar); gate by role middleware.
