# Live capture — https://chloeting.com/about

Captured 2026-08-22 from the live page (Cursor browser + computed styles).  
**This file beats the older SkillUI markdown in this folder** for structure. That pack mixed homepage screens and Ant/Poppins noise.

Tokens below are measured. Brand chrome still uses curated `DESIGN.md` / `context/06-design-tokens.md` (filter Ant `#40a9ff` and Chloe award blue `#5b80d0`).

## Page chrome

- **URL:** `https://chloeting.com/about`
- **Title:** Chloe Ting - About Page
- **No H1.** Name is a 40px/700 paragraph.
- **UI font:** Manrope. Ink `#303033`.
- **Content width:** **1240px**, left offset 100px at 1440 / 140px at 1536.
- **Page height:** ~3301px at 1536×756
- **Body:** white. Hero band is a rounded 8px wash, not full-bleed grey.

## 1. Hero band

Container **1240×644**, `border-radius: 8px`, bg `rgb(252, 251, 255)`, pad `40px 0 0 65px`.

```
grid-template-columns: 705px 411.25px
grid-template-rows: auto 1fr
column-gap: 5%
```

| Cell | Measure |
|------|---------|
| Name | 40px / 700 / line 62.86, ink, margin-bottom 12px |
| Role | 22px / 700 / line 34.57, ink, two lines with `<br>` |
| Bio | grid row 2, 22px / 400, ink, margin-top **80px**, width 705 |
| Portrait | column 2 / rows 1–3, **411×604**, align end. Live file `chloeting-header.png` |

## 2. Story split (Walmart row on live)

`grid 600px 596px`, gap `20px 44px`, image **600×337**. Body 22px / 400 ink.

**Do not copy** Chloe’s Walmart equipment copy or photo. Local maps CMS `story` + an existing catalog/hero image.

## 3. Awards band

Section pad `50px 0 75px`, radius 16px, white.

- H2 **40px / 500**, `rgba(0,0,0,0.85)`
- Inner **1110px**: `grid 424px 666px`, gap `68px 20px`
- Left: clapping illustration ~290×365
- Right: `grid 209px × 3`, gap `32px 20px`
- Cards **209×266**, bg `rgb(235, 244, 255)`, radius 8px, pad `30px 16px 20px`, **centered**
- Live card type is `rgb(91, 128, 208)` 22px/700 + 16px/400 — **do not use**. Local value cards use `--color-sky` + `--color-brand`
- Live award seals/YouTube glyphs are Chloe-specific — omit

Academic block under the cards: heading **36px / 500**; two-col list `516px 516px`, gap `10px 50px`; items **18px / 700** ink.

## 4. Closing

`grid 496px 744px`. Portrait **496×689**, radius 8px. Quote **25px / 700**, copy column pad `120px 0`. Live signature SVG — local uses “— Erijane” text.

## Local Erijane notes (implemented 2026-08-22)

`/about` follows this capture’s chrome with CMS copy:

1. Intro → hero name / role / bio + banner portrait
2. Story → split row (no Walmart)
3. Brand Values items → six sky cards (no award logos)
4. Mission / Vision / Impact → two-col list (bodies kept so CMS tests still see them)
5. Closing quote stays the Erijane line (no “watch the ads”)
6. Study-note disclaimer stays muted at the bottom

## minf-design

Pencil MCP is not connected. Approved direction: live Chloe Ting About structure, Erijane content.
