# Design System: Chloe Ting Clone

> Source of truth: live CDP + screenshots from https://chloeting.com/  
> skillui extract is secondary (filter Ant Design noise). Local study only.

## 1. Visual Theme & Atmosphere
Light, airy fitness marketing site. White canvas, soft pink hero wash, pastel program card beds, black pill CTAs. Calm density with generous section padding. Motion: card hover plus home merch carousel / light section entrance; respect reduced motion.

**Dials (preserve):** VARIANCE 5 · MOTION 5 (home marketing) / MOTION 3 (listing pages) · DENSITY 4

## 2. Color Palette & Roles
| Token | Hex | Role |
|-------|-----|------|
| Canvas | `#FFFFFF` | Page background |
| Ink | `#303033` | Primary text (live body) |
| Ink strong | `#111111` | Logo / heavy headings |
| Muted | `#868A93` | Secondary text |
| Pill | `#2D2D2D` | Primary CTA fill |
| Border | `#EFF0F4` | Hairlines / card rings |
| Surface | `#F7F7F7` | Alternating section bg |
| Blush | `#FFF5F5` | Hero wash |
| Mint | `#D8F3E7` | Program card tone |
| Lavender | `#E8E0F5` | Program card tone |
| Sky | `#D6EAF8` | Program card tone |
| Peach | `#FDE8DF` | Program card tone |

**Banned as primary CTA:** `#ff7875` and other Ant Design leftovers from skillui.

## 3. Typography
- **Body / UI:** Manrope (300/400/500/600/700), 14px base
- **Display / H1–H3:** Manrope (600/700) — chloeting.com is Manrope-only (verified 2026-07-11 via its head font-load + app CSS; skillui's "Poppins headings" was @font-face noise). No Poppins.
- **Logo wordmark:** Erijane — Gilroy Heavy Italic (see §8)
- **Container:** max-width 1240px (chloeting.com fresnel `lg` breakpoint)
- **Banned:** Inter as project default

## 4. Components
- **Primary button:** full pill, dark fill, white text (`btn-pill`)
- **Ghost button:** pill outline, light border (`btn-ghost`)
- **Nav links:** Manrope medium; active = underline offset
- **Cards:** large radius (~16–24px); program cards image-forward on pastel beds
- **Play control:** white circular overlay on video thumbs

## 5. Layout
- Container ~ `max-w-6xl` centered with horizontal padding
- Sticky white header, hairline bottom border
- Hero: split text left / phone collage right on desktop
- Section rhythm: title + ghost CTA row, then grid

## 6. Motion
- Card hover: slight lift / image scale ~1.03–1.05, 200ms ease-out
- Home merch: Embla loop + autoplay (~3.2s), pause on hover/focus/off-screen; mobile peek (~29% next slide); drag OK; not Ant Design React
- Optional light section entrance (opacity / slight translate) on home; no bounce
- Honor `prefers-reduced-motion`: disable autoplay/loop animation; static layout OK
- Engine choice locked 2026-08-03 Gate B: Embla default

## 7. Anti-patterns
- No invent brand palette
- No emoji as icons
- No real payment or video stream embeds
- Keep study disclaimer in footer

## 8. Erijane brand (2026-07-11 rebrand)
- Brand teal: `#026068` (`--color-brand`) — from official logo exports
- Gradient pair (approx, from raster): `#2fb69e` → `#8ce0ae` (`--color-brand-grad-from/to`) — note: Tailwind 4 tree-shakes unused @theme tokens from built CSS; these live in source and compile in once first consumed
- Hot-path icon: `icon-112.png` (hero) + `favicon.ico`; `icon.svg` (430KB, embedded rasters) is a master only — keep it off page loads
- Wordmark font: Gilroy Heavy Italic (commercial — do NOT embed as webfont; header uses locally-rendered 2× PNG, SVG master in `public/images/erijane/`)
- Assets: `icon.svg` (textured teal, white EJ), `wordmark-dark.svg`, `wordmark-gradient.svg` + rendered PNG set & `favicon.ico`
- Disclaimer in footer still credits Chloe Ting (study project) — do not remove
