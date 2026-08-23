# Live capture — https://chloeting.com/program

Captured 2026-08-22 from the live page (Cursor browser + computed styles).  
**This file + `screens/live-2026-08-22/` beat the older SkillUI markdown in this folder.** That pack mislabeled homepage screens, claimed “solid colors only / no gradients,” and swapped Poppins/Manrope roles.

SkillUI `--mode ultra` was attempted; Playwright Chromium/headless-shell was not installed on this machine, so ultra screens/scroll frames were not regenerated. Tokens below are measured, not guessed.

Local screens (gitignored): `screens/live-2026-08-22/`

| File | What |
|------|------|
| `00-hero-initial.png` | First load (~1920) |
| `01-hero-1440.png` | Hero + toolbar at 1440×900 |
| `02-latest-featured-1440.png` | Featured Latest + Most Popular cards |
| `03-collection-rows-1440.png` | Full-width collection rows |
| `04-featured-beginner-1440.png` | Featured + Beginner Friendly |
| `05-filters-open-1440.png` | Filters panel open |
| `06-browse-dropdown-1440.png` | Browse By Collection menu |
| `07-footer-no-equipment-1440.png` | Last row + footer |
| `08-mobile-390.png` | 390×844 stacked layout |

---

## Page chrome

- **URL:** `https://chloeting.com/program`
- **Title:** Chloe Ting Free Workout Programs
- **Page height:** ~5410px at 1440×900
- **Shell bg:** page column `rgb(247, 247, 247)` (`#f7f7f7`); `body` white
- **Ink:** `rgb(48, 48, 51)` (`#303033`)
- **Muted / Ant leftover on links:** `rgb(24, 144, 255)` — do **not** use as brand; filter per `DESIGN.md`
- **Header:** 56px tall, `padding: 0 20px`, bg `#f7f7f7`
- **Logo:** “CHLOE TING” uppercase, Manrope, `#303033`
- **Nav:** Manrope 14px / 21px, weight 500. Active “Workout Programs” has underline
- **Sign Up (desktop visible):** text link, transparent, `#303033`, ~91×35
- **Log In (desktop visible):** pill `bg #303033`, white text, radius 35px, pad `0 20px`, ~80×35
- **UI font (almost everything):** Manrope stack  
  `Manrope, -apple-system, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif`
- **Exception:** hero H1 “Available Now” is **Poppins** 45px / 54px, weight 600, letter-spacing 0.45px, color `rgba(0,0,0,0.85)`

---

## 1. Hero (desktop 1440)

App promo, not a programs H1.

- **Section** `section.sc-b8265d47-2`: flex, **572px** tall, full content width (~1425px)
- **Background image (not a CSS gradient):**  
  `https://chloeting.com/_next/static/media/homepage-background-2025.fac416eb.png`  
  Soft pink / lavender wash
- Inner row pad `0 24px`; left copy column ~360px; right collage (phone + floating app cards)
- H1: “Available Now”
- Sub: “Download for free on the app stores” (Manrope, ink)
- Store badges: Google Play + App Store images, **176×51** each
- Floating labels around phone: TRACK KCAL OUT / MONITOR / CONNECT / ORGANIZE / TRAIN / TRACK KCAL IN

**Mobile 390:** different copy — “Download Core by Chloe Ting”; Chloe photo on the right instead of the big phone collage; hamburger replaces desktop nav.

---

## 2. Toolbar

Single row under the hero.

| Control | Measure |
|---------|---------|
| Browse By Collection | Grey pill `bg #ededed`, radius **20px**, pad `5px 14px`, 14px Manrope, gap 5px, ~186×32, chevron |
| Search | Magnifying glass + “Search” (desktop). Native `input` placeholder Search |
| Filters (idle) | Icon + “Filters”, ~95–115×34 |
| Filters (open) | **Filled** `bg #303033`, white text, radius **15px**, pad `5px 14px`, weight 500 |

Mobile: Browse pill stays; Search and Filters collapse to **icons only**.

---

## 3. Browse By Collection dropdown

Opens as a white menu (Ant dropdown). Items, in order:

1. View All Collections  
2. Latest Challenges  
3. Most Popular  
4. Beginner Friendly  
5. Moderate to Advanced  
6. Weight Loss  
7. Abs  
8. Booty and Legs  
9. Strength Training  
10. No Equipment  

Active Browse trigger fills dark like Filters when open.

---

## 4. Filters panel (open)

- Container: flex column, pad `24px 0`, gap 14px, width **1240px**, height ~482px
- Five columns with vertical rules: **Focus Area · Duration · Equipment · Year · History**
- Focus Area: Abs & Core, Arms, Booty, Full Body, Legs, Resistance, Weight Loss
- Duration: 1–14 / 15–21 / 22–28 / 29 days +
- Equipment: Dumbbells, Fitness Mat, Resistance Bands
- Year: 2018–2026
- History: I’ve Completed, I Have Not Completed (muted until signed in)
- Footer: **Clear Filters** (disabled grey `#c4c4c4` when empty) · **Cancel** 16px/500 · **Apply** pill 35px radius, disabled `bg #c4c4c4` white 14px/500 until a filter is chosen

---

## 5. Desktop listing layout (1440)

**Top block is a 2-column CSS grid**, not one stacked list:

```
grid-template-columns: 736px 484px
gap: 30px 20px
width: 1240px
```

| Column | Header | Body |
|--------|--------|------|
| Left 736px | “Latest Challenges” + View All | **Featured split card** (image left, meta right) |
| Right 484px | “Most Popular” + View All | Horizontal **portrait cards** (~232×434) |

Then **full-width collection rows** (same 1240px), each:

- H2 22px / 29.7px Manrope **600**, color `rgba(0,0,0,0.85)`
- Optional description `p` 14px `#303033` (Beginner Friendly and below; Latest/Most Popular have no blurb)
- View All on the right
- Horizontal scroller: `overflow-x: scroll`, `gap: 20px`, class `hidden-scrollbar`

**Collection H2s in order:** Latest Challenges · Most Popular · Beginner Friendly · Moderate to Advanced · Weight Loss · Abs · Booty and Legs · Strength Training · No Equipment

**Blurbs (live):**

- Beginner Friendly — Looking to get started on your fitness journey? Try one of these beginner-friendly programs! These have shorter time commitments or have low-impact alternatives.
- Moderate to Advanced — If you're looking for something that pushes you a little harder, try any of these moderate to advanced challenges to help you progress further.
- Weight Loss — Get started on your weight loss journey with one of these challenges that are high intensity and will get you sweating!
- Abs — Your abs will love you and hate you at the same time! Try out any one of these core focused workout programs.
- Booty and Legs — If you're looking to work your lower body or grow your glutes, try out these leg and booty programs without equipment or with dumbbells and resistance bands.
- Strength Training — If you're looking to work on your strength, check out these resistance based programs. We'd recommend having resistance bands and a variety of dumbbells.
- No Equipment — These programs can be done at home without the need for equipment like dumbbells or resistance bands!

---

## 6. Cards

### Featured (Latest Challenges, desktop)

- Split: portrait image (~232×340, radius **15px**) + text column
- **NEW** badge: `bg #c1ebe6`, 12px Manrope **700**, pad `6px 12px`, radius ~97px (pill), ~51×31
- Date: small uppercase muted (e.g. AUGUST 2026)
- Title: large bold
- Meta icons: calendar “14 days” · clock “30 min/day”
- TYPE / EQUIPMENT labels uppercase muted; values ink
- **View Challenge:** white fill, ~0.8px `#303033` border, radius 35px, pad `0 16px`, 14px Manrope, ~132×35

### Portrait collection card

- Card `a`: **232×434**, radius **20px**, white
- Image: **230×320**, radius **16px**
- H3 title: **18px / 23.4px Manrope 500**, `#303033`, pad `0 10px`
- Days + min/day row between image and title
- Hover: “View Challenge” overlay (same pill as featured)

### View All (section)

- Outline pill, `border 0.8px solid #303033`, radius **52px**, pad `6px 15px`, 14px/500, ~81×36, transparent fill

**Mobile 390:** Latest Challenges is a **horizontal row of portrait cards** (no split featured card, no 2-col with Most Popular). View All is a text link, not the outline pill.

---

## 7. Footer

- Copyright + Privacy Policy · Terms & Conditions · FAQs · About
- Social icons right: Facebook, Instagram, X, Discord, YouTube
- Light top rule; footer pad includes extra bottom space on desktop (`90px` in older LAYOUT.md)

---

## Local Erijane gaps (do not “fix” until Phase 2 is approved)

Live `/program` vs current `resources/views/programs` + `livewire:programs.index`:

1. Missing app-promo hero (desktop collage / mobile Core banner)
2. Missing Browse By Collection dropdown (local uses level + focus **chips**)
3. Missing five-column Filters panel (local “Filters” only clears chips)
4. Missing 736/484 two-column Latest + Most Popular
5. Missing collection rows + blurbs; local is featured + remainder grid
6. Search placeholder live is “Search”, local is “Search by Collection...”

Brand tokens stay curated (`DESIGN.md` / `context/06-design-tokens.md`). Structure/motion/screens follow this capture.

---

## minf-design

Pencil MCP is not connected. Approved direction: live Chloe Ting program listing. Phase 2 implemented 2026-08-22 on local `/programs`.
