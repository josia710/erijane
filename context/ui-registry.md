# UI registry — Erijane

Updated: 2026-08-22 (about live chrome)

## Components
- **ButtonPrimary** — `btn-pill` — dark pill CTA (`--color-pill`); auth submit, Create Account, View Challenge
- **ButtonGhost** — `btn-ghost` — outline pill; View All / Load More chrome
- **FilterChip** — `filter-chip` / `filter-chip-active` — listing filters, forum sort toggles
- **AuthInput** — `auth-input` — rounded-xl bordered fields on login/signup
- **AuthOAuth** — `auth-oauth` — disabled Google shell (no real OAuth)
- **AuthFeatureCard** — `auth-feature` + `card-tone-*` — pastel benefit rows in auth aside
- **AppPromoHero** — `<x-app-promo-hero>` — home + `/programs` 572px band; 8-layer PNG collage (`hero-collage`)
- **ProgramListCard** — `program-portrait` — 232px collection cards
- **ProgramMetaChip** — `program-meta-chip` — days / min-day pills (`bg-surface`, `rounded-full`)
- **ProgramFeaturedSplit** — `program-featured-split` — Latest Challenges desktop split card
- **ProgramToolbar** — `programs-toolbar` / `programs-browse` / `programs-filters`
- **VideoListThumb** — `videos-card` / `videos-featured` + `video-duration` (landscape 230×130 / 320×180)
- **VideoToolbar** — programs-toolbar + `videos-fav` (muted until login)
- **RecipeListCard** — `recipes-card` / `recipes-featured` + `recipes-popular__tile` + `recipes-overlay` / `recipes-rating-chip`
- **RecipeToolbar** — programs-toolbar + `videos-fav` (Saved Recipes muted until login)
- **ListingToolbar** — `listing-toolbar` + `listing-search__input` — programs/videos chrome
- **ForumShell** — `forum-shell` / `forum-channel` / `forum-thread` / `forum-action` / `forum-tag`
- **CommunityCTA** — `partials/community-cta` — marketing CTA on **home** only
- **AboutHero** — `about-hero` 705/411 band, 40px name + 22px role + bio
- **AboutValueCard** — `about-award` sky tiles (Brand Values)
- **AboutClosing** — `about-closing` 496/quote split
- **EmptyState** — `<x-empty-state>` — catalog empty copy

## Patterns
- **Auth two-column** — `auth-shell` form left / features aside right (lg+); form-only on mobile
- **Community hybrid C** — home CTA; `/community` is live forums chrome (no posting backend)
- **Programs listing** — app-promo hero; Browse/Search/Filters; 736/484 Latest+Popular; collection rows
- **Listing featured + rail** — **videos** Latest 737/232/232 + collection rows; **recipes** Latest 925/293 + Popular Categories + themed rails
- **Motion 3 (listings)** — hover image scale 1.03 / 200ms ease-out; browse menu `forumMenuIn` 0.3s scaleY; reduced-motion kills both
- **Tokens only** — ink/muted/pill/surface/brand + pastel tones; filter SkillUI Ant

## Forbidden
- Ad-hoc hex on CTAs (use `btn-pill` / tokens)
- Poppins / Inter as UI default (Manrope)
- Real Google OAuth / payments / live forum posts
- Ant Design carousel (Embla on home only)

## Inconsistencies (fix list — do not mass-restyle)
1. Auth fields use `sr-only` labels + placeholders; `05-ui-rules` prefers visible labels — align when polishing a11y
2. “View All” / “Load More” / “Create Post” are non-functional chrome (intentional shells)
3. Recipes listing chrome matches live capture (2026-08-22); catalog still maps collections from `category`/`time` (no extra columns)
4. `welcome.blade.php` still Laravel default hex soup — unused public shell; ignore or delete later
5. Forum active channel uses lavender fill + brand bar (Chloe purple cue, Erijane accent)
6. Programs listing chrome matches live capture (2026-08-22); catalog still maps collections from `level`/`focus` (no extra columns)
7. Videos listing chrome matches live capture (2026-08-22); catalog still maps collections from `category`/`duration` (no extra columns)
