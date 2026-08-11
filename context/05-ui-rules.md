# UI rules — Erijane

## Product feel
Light, airy fitness marketing (Chloe Ting shell) with Erijane teal brand accents and founder-led authenticity. Confident, inclusive, affordable — not premium-luxury or dark-mode gym tropes.

## Layout
- Shell / nav: sticky white header, hairline border; Erijane wordmark PNG; Chloe IA labels
- Page width: ~1240px / `site-container` / `max-w-6xl` pattern already in layouts
- Empty / loading / error: empty section copy (“No programs yet”); show routes 404; Filament empty tables use Filament defaults

## Components
- Buttons: `btn-pill` (primary dark), `btn-outline-pill` / `btn-ghost` — token classes only
- Cards: large radius program/video/recipe/store cards on pastel tone beds (`mint`/`lavender`/`sky`/`peach`)
- Forms (public auth): labeled inputs, inline validation
- Admin: Filament defaults (do not restyle Filament to match marketing site)

## Motion
- Card hover lift/scale ~200ms; home merch Embla carousel if present
- Honor `prefers-reduced-motion`
- No decorative particle/glow noise

## Accessibility
- WCAG AA body contrast; visible focus; semantic headings; alt text on CMS images (required field in Filament)

## Design refs
- Live: https://chloeting.com/
- **SkillUI ultra pack (2026-08-11):** `context/designs/skillui-out/chloeting-design/` — also `~/.cursor/skills/chloeting-design`
- Site map (live → local): `context/designs/SITE_MAP.md`
- Curated tokens (prefer over SkillUI Ant noise): repo `DESIGN.md` + `context/06-design-tokens.md`
- Brand assets: `public/images/erijane/`
- Brand copy: Erijane Business Plan PDF
- Screens: `screens/pages/*`, home `screens/scroll/*`, hover `screens/states/*`

## Do not
- Invent a new visual language per page
- Hard-code hex/spacing when tokens exist
- Put real checkout UI that implies payment
- Use Inter as default; keep Manrope
- Embed Gilroy as webfont (wordmark PNG/SVG only)
