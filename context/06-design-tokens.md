# Design tokens — Erijane

Source: live Chloe shell + Erijane brand lock in `DESIGN.md` (2026-07-11).

## Color
| Token | Value | Use |
|-------|-------|-----|
| Canvas / `--color-canvas` | `#FFFFFF` | Page background |
| Ink / `--color-ink` | `#303033` | Body text |
| Ink strong | `#111111` | Logo-adjacent / heavy headings |
| Muted | `#868A93` | Secondary text |
| Pill | `#2D2D2D` | Primary CTA fill |
| Border | `#EFF0F4` | Hairlines / card rings |
| Surface | `#F7F7F7` | Alternating section bg |
| Blush | `#FFF5F5` | Hero wash |
| Mint | `#D8F3E7` | Program card tone |
| Lavender | `#E8E0F5` | Program card tone |
| Sky | `#D6EAF8` | Program card tone |
| Peach | `#FDE8DF` | Program card tone |
| Brand / `--color-brand` | `#026068` | Erijane teal accent |
| Brand grad from | `#2fb69e` | Gradient pair |
| Brand grad to | `#8ce0ae` | Gradient pair |

**Banned as primary CTA:** Ant Design leftover reds (e.g. `#ff7875`).

## Typography
| Token | Value |
|-------|-------|
| `--font-sans` | Manrope (300–700) |
| Body | 14px base Manrope |
| Display | Manrope 600/700 |
| Wordmark | Gilroy Heavy Italic — **PNG/SVG only**, do not webfont |

## Spacing & radius
| Token | Value |
|-------|-------|
| Container | max ~1240px, horizontal padding via `site-container` |
| Card radius | ~16–24px |
| Section padding | generous (existing layout rhythm) |

## Implementation
- Source of truth for **Erijane chrome**: Tailwind `@theme` / CSS variables + curated table above (and repo `DESIGN.md`)
- SkillUI pack (`context/designs/skillui-out/chloeting-design/tokens/`) is a raw crawl — **filter Ant Design leftovers** (`#40a9ff`, `#ff7875`, `#ff4d4f`, etc.) for marketing UI
- Features consume tokens/utilities only — no raw hex in new Blade/Livewire
- Filament panel may use Filament’s own theme; do not force marketing tokens into admin

## Open questions
- [ ] When first Tailwind `@theme` token is unused, tree-shaking may drop it — consume brand tokens once in layout if needed
- [ ] Live merch/store URL not in SkillUI 15-page set — confirm when wiring `/store` parity
