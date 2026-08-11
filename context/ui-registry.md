# UI registry — Erijane

Updated: 2026-08-11 (Phase 4 page-parity)

## Components
- **ButtonPrimary** — `btn-pill` — dark pill CTA (`--color-pill`); auth submit, Create Account, View Challenge
- **ButtonGhost** — `btn-ghost` — outline pill; View All / Load More chrome
- **FilterChip** — `filter-chip` / `filter-chip-active` — listing filters, forum sort toggles
- **AuthInput** — `auth-input` — rounded-xl bordered fields on login/signup
- **AuthOAuth** — `auth-oauth` — disabled Google shell (no real OAuth)
- **AuthFeatureCard** — `auth-feature` + `card-tone-*` — pastel benefit rows in auth aside
- **ProgramListCard** — `program-list-card__bed` + tone + `program-list-card__img`
- **ProgramFeatured** — `program-featured` / `__hero` / `__rail` — Latest Challenges layout
- **VideoListThumb** — `video-list-card__thumb` + `play-btn` + `video-duration`
- **VideoFeatured** — `video-featured` / `__rail` — Latest Workouts layout
- **RecipeListCard** — `recipe-list-card__img` — catalog recipe grid
- **ListingToolbar** — `listing-toolbar` + `listing-search__input` — programs/videos chrome
- **ForumShell** — `forum-shell` / `forum-channel` / `forum-thread` / `forum-tag` — Community C
- **CommunityCTA** — `partials/community-cta` — marketing CTA (shared home + community)
- **AboutHero / Panel / Closing** — `about-hero`, `about-panel`, `about-closing`
- **EmptyState** — `<x-empty-state>` — catalog empty copy

## Patterns
- **Auth two-column** — `auth-shell` form left / features aside right (lg+); form-only on mobile
- **Community hybrid C** — CTA section then forums UI shell (no posting backend)
- **Listing featured + rail** — first item large; next 2–3 stacked; remainder grid
- **Motion 3 (listings)** — hover image scale ~200ms ease-out; reduced-motion kills transitions
- **Tokens only** — ink/muted/pill/surface/brand + pastel tones; filter SkillUI Ant

## Forbidden
- Ad-hoc hex on CTAs (use `btn-pill` / tokens)
- Poppins / Inter as UI default (Manrope)
- Real Google OAuth / payments / live forum posts
- Ant Design carousel (Embla on home only)

## Inconsistencies (fix list — do not mass-restyle)
1. Auth fields use `sr-only` labels + placeholders; `05-ui-rules` prefers visible labels — align when polishing a11y
2. “View All” / “Load More” / “Create Post” are non-functional chrome (intentional shells)
3. Recipes SkillUI PNG packs unreliable for that URL — parity from live HTML IA + catalog; do not trust food-blog OCR on screenshots
4. `welcome.blade.php` still Laravel default hex soup — unused public shell; ignore or delete later
5. Forum active channel uses lavender (Chloe purple cue) vs brand teal — acceptable for IA parity; optional teal active later
