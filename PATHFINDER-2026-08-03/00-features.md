# Pathfinder — Feature inventory (Phase 0) — APPROVED

**Repo:** `d:\chloeting-clone`  
**Date:** 2026-08-03  
**Status:** approved from [Pathfinder feature discovery](87afc072-9420-4522-9aa2-56f1e947be15)  
**Goal context:** pixel-match https://chloeting.com/ structure / motion / carousels

## Features

| # | Name | Entry points | Core files | Purpose |
|---|------|--------------|------------|---------|
| F1 | Shell / layout | `layouts/app.blade.php:1` | `app.css`, `app.js`, Vite | Shared HTML, fonts, Livewire, flash |
| F2 | Nav / footer | `layouts/app.blade.php:25,39` | `partials/nav|footer`, `config/chloe.php` nav | Sticky nav + disclaimer footer |
| F3 | Home composition | `routes/web.php:7` | `home.blade.php`, `config/chloe.*` | Monolithic home: hero→programs→videos→merch→recipes→community |
| F4 | Programs | `routes/web.php:9–15` | Livewire `programs/⚡index`, show | Filters + slug detail |
| F5 | Videos | `routes/web.php:17–23` | Livewire videos | Filters + detail |
| F6 | Recipes | `routes/web.php:25–31` | Livewire recipes | Filters + detail + `?category=` |
| F7 | Store | `routes/web.php:33–39` | Livewire store | Filters + detail; home merch teaser separate |
| F8 | Static pages | `routes/web.php:41–43` | community/journey/about | Marketing static |
| F9 | Auth | `routes/web.php:45–54` | Auth controllers + blades, `User` | Session auth |
| F10 | Content catalog | consumed everywhere | `config/chloe.php` | Single content source (no DB) |
| F11 | Motion / carousel (gap) | `app.js:1` (empty) | `package.json` (no libs); home merch `home.blade.php:100–106` | **Gap vs live ant-carousel/slick** |

## Ownership

| Concern | Feature | Notes |
|---------|---------|-------|
| Carousels | F3 + F11 | Only merch snap-x today; live = Ant/slick |
| Scroll animations | F1 (minimal) | `scroll-behavior:smooth` + hover scale only |
| Home composition | F3 | Not Livewire |
| Nav/footer | F2 | |
| Listings | F4–F7 | Parallel Livewire chip/grid pattern |

## Phase 1 priority (this run)

Flowcharts first for: **F3 Home**, **F11 Motion**, **F1 Shell**, **F7 Store** (merch teaser vs listing). Listing deep parity deferred until T1 says otherwise.
