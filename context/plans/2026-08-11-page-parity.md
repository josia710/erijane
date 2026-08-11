# Plan — listing + auth page parity (SkillUI-driven)

## Goal
Match Chloe Ting live layout/chrome for Programs, Videos, Recipes, Community, About, Login, Signup — using SkillUI screens + curated Erijane tokens — without reopening payments/OAuth.

## Context touched
- `AGENTS.md`, `01`–`09`, `DESIGN.md`, `SITE_MAP.md`
- SkillUI: `context/designs/skillui-out/chloeting-design/` + per-page `context/designs/skillui-pages/`
- Views: listing Livewire SFCs, auth blades, about/community
- CSS: `resources/css/app.css` listing/auth utilities
- Tests: extend beyond home-only `verify:parity` / `ParityShellTest`

## Decisions locked
- Chloe IA routes/labels stay
- Catalog CMS already backs listings
- Tokens = curated DESIGN (Ant filtered)
- Embla/CSS motion; listing MOTION 3
- Community: **C** — CTA hero + forums-looking cards shell (`decisions/2026-08-11-page-parity.md`)

## Blind spot (summary)
1. Community CTA ≠ live forums → product fork  
2. SkillUI Ant/Poppins vs curated Manrope/teal → wrong pack kills brand  
3. `verify:parity` home-only → false green  

Full: explore agent [Blind spot page parity](beabb0ba-fa39-48ed-a1ef-4a0b66013aeb)

## Steps (ordered)
1. Finish SkillUI per-page packs; index screens in SITE_MAP  
2. Lock Community A/B/C  
3. Side-by-side audit: each local route vs SkillUI PNG (programs → videos → recipes → about → login → signup → community)  
4. Implement CSS/markup deltas per page (Ponytail: surgical)  
5. Wire `measure-index-pages.mjs` into verify OR add Feature assertions for structure  
6. Emil pass: hover/active, reduced-motion, no `transition: all`  
7. Imprint UI registry if shells change  

## Files to create/edit
| Area | Paths |
|------|--------|
| Designs | `context/designs/skillui-pages/**`, `SITE_MAP.md` |
| Listings | `resources/views/components/{programs,videos,recipes}/⚡index.blade.php`, index wrappers, `app.css` |
| About | `resources/views/about.blade.php` |
| Community | `community.blade.php` + partial (after A/B/C) |
| Auth | `resources/views/auth/{login,signup}.blade.php` |
| Tests | `ParityShellTest` / new `ListingParityTest` / scripts |

## Done when (verify)
- [ ] Hard-refresh side-by-side vs SkillUI PNGs for all 7 routes (layout/chips/grid/auth shell)  
- [ ] No Ant accent/Poppins introduced  
- [ ] `php artisan test --filter=Parity` (+ new listing asserts) green  
- [ ] Community decision honored (CTA or forums shell)  
- [ ] `prefers-reduced-motion` respected on any new motion  

## Risks / out of scope
- Real forums backend, Google auth, payments  
- Pixel-identical Next.js micro-CSS  
- Store listing deep parity (unless scoped later)  

## Skills after implement
- [ ] imprint (UI)  
- [ ] review (complex listing wave)  
- [ ] remember save (end of session)  

## Next lane
| Next | When |
|------|------|
| Lane A | Single page after Community locked |
| Lane B | Grill remaining taxonomy/tabs unknowns |
| Lane C | Full 7-page wave via `/minf-pipeline` |

**Stop:** Community C locked + Phase 4 implement landed (2026-08-11). Optional: `/imprint`, re-SkillUI recipes.
