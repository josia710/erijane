# Chloe Ting live site map (SkillUI ultra, 2026-08-11)

Source crawl: `skillui --url https://chloeting.com/ --mode ultra --screens 15`  
Package: `context/designs/skillui-out/chloeting-design/`  
Skill installs: `~/.cursor/skills/chloeting-design`, `~/.claude/skills/chloeting-design`

## Per-page packs (Phase 4 — secondary routes)

Ultra extracts for listing/auth targets (prefer these screens when polishing that route). Each pack: `chloeting-<name>-design/` with `screens/pages/` (3) + `screens/scroll/` (7).

| Page | Pack root | Live URL | Local route |
|------|-----------|----------|-------------|
| Programs | `skillui-pages/program/chloeting-program-design/` | https://chloeting.com/program | `/programs` |
| Videos | `skillui-pages/workout-video-library/chloeting-workout-video-library-design/` | https://chloeting.com/workout-video-library | `/videos` |
| Recipes | `skillui-pages/recipes/chloeting-recipes-design/` | https://chloeting.com/recipes | `/recipes` |
| Community | `skillui-pages/community/chloeting-community-design/` | https://chloeting.com/c/fitness-discussions | `/community` |
| About | `skillui-pages/about/chloeting-about-design/` | https://chloeting.com/about | `/about` |
| Login | `skillui-pages/login/chloeting-login-design/` | https://chloeting.com/login | `/login` |
| Signup | `skillui-pages/signup/chloeting-signup-design/` | https://chloeting.com/signup | `/signup` |

Token rule unchanged: **filter Ant** — use curated `DESIGN.md` + `context/06-design-tokens.md` for brand chrome; SkillUI packs = structure/motion/screens.

**Note:** SkillUI ultra screenshots for `/recipes` often mis-capture food-blog chrome. Prefer live HTML structure (Latest Recipes → featured + category rows → Load More) + `skillui-out/.../screens/pages/recipes.png` as secondary. Local `/recipes` follows that IA with Erijane catalog data.

Plan: `context/plans/2026-08-11-page-parity.md` · Blind spot: `context/blind-spot-page-parity.md` · Registry: `context/ui-registry.md`

## Public IA (live URLs → local Erijane routes)

| Live page | Live URL | Local route (keep Chloe IA labels) | Screenshot |
|-----------|----------|--------------------------------------|------------|
| Home | `/` | `/` | `screens/pages/home.png` |
| Login / Journey | `/login` | `/login` | `screens/pages/login.png` |
| Signup | `/signup` | `/signup` | `screens/pages/signup.png` |
| Forgot password | `/forgot-password` | _(optional later)_ | `screens/pages/forgot-password.png` |
| Programs index | `/program` | `/programs` | `screens/pages/program.png` |
| Latest challenges | `/program/c/latest-challenge` | `/programs` (filter/tab) | `screens/pages/program-c-latest-challenge.png` |
| Program detail | `/program/2026/...` | `/programs/{slug}` | `screens/pages/program-2026-*.png` |
| Videos library | `/workout-video-library` | `/videos` | `screens/pages/workout-video-library.png` |
| Recipes | `/recipes` | `/recipes` | `screens/pages/recipes.png` |
| Community | `/c/fitness-discussions` | `/community` | `screens/pages/c-fitness-discussions.png` |
| About | `/about` | `/about` | `screens/pages/about.png` |
| Privacy | `/privacy-policy` | _(legal, Phase 3)_ | `screens/pages/privacy-policy.png` |
| Terms | `/term-conditions` | _(legal, Phase 3)_ | `screens/pages/term-conditions.png` |

**Not in this 15-page crawl:** dedicated Store/Merch listing URL (merch appears on home carousel). Local `/store` remains in scope per architect decisions — match home merch + any live store when URL known.

## Shell structure (every page)

1. **Header** — logo, primary nav, Sign Up / Log In (or user menu)
2. **Main** — page-specific sections (hero / grids / detail)
3. **Footer** — links, socials, legal

Documented in `references/LAYOUT.md` (header/footer/nav/section containers).

## Home scroll journey

`screens/scroll/scroll-000.png` … `scroll-100.png` (7 frames) — hero → programs → merch/carousel → community CTAs → footer.

## Design system files (read order for UI)

1. `SKILL.md` (overview + embeds)
2. `references/VISUAL_GUIDE.md`
3. `references/DESIGN.md` + root `DESIGN.md`
4. `references/LAYOUT.md` · `COMPONENTS.md` · `ANIMATIONS.md` · `INTERACTIONS.md`
5. `tokens/*.json`
6. **Filter Ant Design noise** — live CSS includes Ant leftovers (`#40a9ff`, `#ff7875`, `#ff4d4f`). Prefer curated tokens in repo `DESIGN.md` + `context/06-design-tokens.md` (ink `#303033`, muted `#868A93`, pill dark CTA, pastel card beds, Erijane `#026068`). SkillUI extraction is structure/motion/reference; curated tokens win for brand chrome.

## Components detected (structural)

Carousels (Slick), program/video cards, nav list items, lazy images — see `references/COMPONENTS.md`. Local stack uses Embla for home merch (Gate B 2026-08-03), not Ant Design React.

## CMS mapping (Erijane)

| Live surface | CRUD entity |
|--------------|-------------|
| Home sections | `home_blocks` / `page_sections` |
| Programs + details | `programs` |
| Video library | `videos` |
| Recipes | `recipes` |
| Community forums shell | `community_features` (+ CTA copy) |
| About | `page_sections` / about fields |
| Nav + socials + footer | `site_settings` |
| Store (local) | `products` |
| Auth screens | users + role; UI shell from login/signup screenshots |
