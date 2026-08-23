# Live capture — https://chloeting.com/workout-video-library

Captured 2026-08-22 from the live page (Edge/Playwright + computed styles).  
**This file + `screens/live-2026-08-22/` beat the older SkillUI markdown in this folder.** That pack mislabeled homepage screens, put Poppins on UI type, and used Ant `#40a9ff` as the accent.

SkillUI `--mode ultra` was not regenerated (Playwright Chromium/headless-shell missing). Tokens below are measured, not guessed.

Local screens (gitignored): `screens/live-2026-08-22/`

| File | What |
|------|------|
| `00-hero-initial.png` | First load (toolbar + Latest; **no app-promo hero**) |
| `01-hero-1440.png` | Toolbar + Latest at 1440×900 |
| `02-latest-featured-1440.png` | Featured Latest + two side cards |
| `03-popular-1440.png` | Most Popular + HIIT rows |
| `04-collection-rows-1440.png` | Collection rails (Abs and neighbours) |
| `05-filters-open-1440.png` | Six-column Filters panel |
| `06-browse-dropdown-1440.png` | Browse By Collection menu |
| `07-footer-1440.png` | Last collection rows (Dumbbell / 10 Mins / 20 Mins+) |
| `08-mobile-390.png` | 390×844 stacked Latest |
| `09-mobile-listing-390.png` | Mobile Latest + Most Popular rail |
| `10-mobile-filters-390.png` | Mobile Filters sheet (accordion) |

CookieYes banners appear on some frames — they are third-party, not product UI.

---

## Page chrome

- **URL:** `https://chloeting.com/workout-video-library`
- **Title:** Chloe Ting - Workout Videos
- **No H1.** Listing starts under the header with the toolbar.
- **No app-promo hero** (unlike `/program`). Do not paste the programs hero onto `/videos`.
- **Page height:** ~4016px at 1440×900 after all collection rows load
- **Shell bg:** header + toolbar band `rgb(247, 247, 247)` (`#f7f7f7`); `body` white
- **Ink:** `rgb(48, 48, 51)` (`#303033`)
- **Muted:** `rgb(134, 138, 147)` (`#868A93`) on views/meta and Load More text
- **Disabled grey:** `rgb(196, 196, 196)` (`#c4c4c4`) — Favorites (signed out), History options, idle Apply
- **Header:** 56px tall, `padding: 0 20px`, bg `#f7f7f7`
- **Content width:** **1240px**, left offset 100px at 1440
- **Nav:** Manrope 14px. Active “Workout Videos” has underline
- **Sign Up (desktop):** text link
- **Log In (desktop):** filled pill `bg #303033`, white, radius 35px
- **UI font:** Manrope stack (same as programs). No Poppins on this page.

Thumbnails link out to **YouTube** (`youtu.be`), not an in-site video player.

---

## 1. Toolbar

Single row under the header. **No hero above it.**

| Control | Measure |
|---------|---------|
| Browse By Collection | Grey pill `bg #ededed`, radius **20px**, pad `5px 14px`, 14px Manrope, gap 5px, **186×32**. Open: filled `#303033`, white |
| Search | Magnifying glass + “Search”, ~99×34, ink, 14px |
| Favorites | Heart + “Favorites”, **113×34**, pad `5px 14px`, radius **15px**, 14px/500. Signed out: text `#c4c4c4` (not clickable) |
| Filters (idle) | Icon + “Filters”, **95×34**, pad `5px 14px`, radius **15px**, 14px/500, bg `#f7f7f7` |
| Filters (open) | Filled `bg #303033`, white |

Mobile 390: Browse pill stays (~190×38, pad `8px 16px`). Search, Favorites, Filters collapse to **icons only** (~32×38).

---

## 2. Browse By Collection dropdown

Ant dropdown. Items, in order:

1. View All Collections  
2. Latest Workouts  
3. Most Popular  
4. HIIT  
5. Abs  
6. Booty  
7. Dumbbell  
8. 10 Mins  
9. 20 Mins+  
10. Standing Workouts  
11. No Jumping  
12. No Planks  
13. Burpee Free  
14. Wrist Friendly  

**Homepage rows stop at 20 Mins+.** Items 10–14 exist in the menu (preference collections) but are not extra H2 rails on the index.

---

## 3. Filters panel (desktop, open)

- Container `.sc-4c05a62d-13`: flex column, pad `24px 0`, gap 14px, width **1240px**, height **482px**
- Six columns with vertical rules (not the five program columns):

| Column | Options |
|--------|---------|
| **Focus Area** | Abs, Arms, Back, Booty, Chest, Full Body, Legs, Lower Body, Upper Body |
| **Workout Type** | Body Weight Workouts, Cooldown, HIIT & Cardio, Weighted Workouts, Warm Up |
| **Preference** | Low Impact Alternatives, No Burpees, No Jumping, No Planks, Reps-Based, Standing Workout, Wrist Friendly |
| **Duration** | 5–10 Min, 10–15 Min, 15–20 Min, 20 Min + |
| **Equipment** | Bench, Dumbbells, Resistance Bands |
| **History** | I’ve Tried, I Have Not Tried (muted until signed in) |

Footer: **Clear Filters** (disabled grey when empty) · **Cancel** 16px/500 · **Apply** pill radius 35px, disabled `bg #c4c4c4` until a filter is chosen.

**Mobile:** full-screen Filters sheet — title “Filters” + X; six accordion rows (same column names, collapsed); Clear Filters + disabled Apply.

---

## 4. Desktop listing layout (1440)

**Latest Workouts** is a 3-column grid, not the programs 736/484 split:

```
grid-template-columns: 737px 232px 232px
gap: 20px
width: 1240px
height: ~242px
overflow-x: scroll (hidden-scrollbar)
```

| Column | Body |
|--------|------|
| Left 737px | **Featured split** — landscape thumb **320×180** r16 + meta column 325px (`grid 320px 325px`, gap 30px) |
| Two 232px | Landscape cards, image **230×130** r16 |

Then **Load More Latest Workouts** (full 1240px bar).

Then **full-width collection rows** (same 1240px): H2 + optional blurb + View All + 5×232px landscape cards (`grid 232px × 5`, gap 20px, row height ~242px).

**Index H2s in order:** Latest Workouts · Most Popular · HIIT · Abs · Booty · Dumbbell · 10 Mins · 20 Mins+

H2: **22px / 29.7px Manrope 600**, color `rgba(0,0,0,0.85)`

**Blurbs (14px ink `#303033`):**

- Most Popular — These are some of the most popular workout videos. Give them a try and see why people love these routines.
- HIIT — Ready to get your heart pumping? These HIIT & cardio workouts will help you burn those calories!
- Abs — If you're looking to work on that 6 pack, check out these ab and core workout routines!
- Booty — Want to grow a booty? There are equipment and non-equipment workouts to help you grow your glutes.
- Dumbbell — Check out these dumbbell workouts that you can do at home to build strength and get toned.
- 10 Mins — Want a quick workout? These videos are only 10 minutes long to help you get a quick and effective workout in.
- 20 Mins+ — If you prefer longer workouts, check out these 20+ minutes workouts.

Latest has **no** blurb.

**View All:** `/workout-video-library/c/{slug}` — outline pill, `border 1px solid #303033`, radius **52px**, pad `6px 15px`, 14px, ~82×36.

---

## 5. Cards

### Featured (Latest, desktop)

- Landscape thumb **320×180**, radius **16px** (image itself 0 radius inside the clip)
- **Duration badge:** bottom-right of thumb, `bg #303033`, `#fafafa` 10px/700, pad `2px 0`, radius **4px**, ~40×18 (e.g. `21:06`)
- Title: **18px / Manrope 500**, ink (e.g. “20 Min HIIT”)
- **Category tags:** uppercase pills, `bg #f7f7f7`, 10px/600, pad `6px 12px`, radius **54px**, ~28px tall (BODY WEIGHT WORKOUTS · HIIT & CARDIO · FULL BODY)
- Meta: `37K views • Aug 26` — 14px/500 `#868A93`
- Icons: info outline + heart (heart `cursor: not-allowed` until signed in)
- **No play-button overlay** on live thumbs

### Rail / collection card (232px)

- Column ~232px; image **230×130** r16
- Title: **16px / Manrope 400**, ink
- Same views • date + info/heart row
- Duration badge same as featured

These are **landscape 16:9 thumbs**, not the programs 232×434 portrait cards.

### Load More Latest Workouts

- **1240×43**, radius **12px** (not a 35px pill), white fill, `border 1px solid #eff0f4`, text 16px `#868A93`, pad 8px
- Mobile: 342×37, 12px type, border `#e9e9ef`

---

## 6. Mobile 390

- Hamburger; Sign Up text + Log In pill
- No featured/side split: Latest is **one stacked featured card** (grid `342px`; inner `292px`)
- View All is a **text link** (~50×22), not the outline pill
- Load More full-width bar under the featured card
- Most Popular: blurb + **horizontal rail** of smaller cards
- Filters = accordion sheet (see §3)

---

## 7. Footer

Same site footer as programs: Privacy · Terms · FAQs · About + socials. Extra bottom pad on desktop.

---

## Local Erijane notes (implemented 2026-08-22)

`/videos` follows this capture’s chrome. Remaining data gaps (no CMS columns):

1. Catalog still has a single `category` + `duration` string — collections/filters are mapped, not stored
2. Cards route to `/videos/{slug}` (Erijane show pages), not YouTube
3. No view counts — meta shows `date_label` only
4. Favorites / History stay muted until auth exists for them
5. Preference browse items (Standing, No Jumping, …) are in the menu; rows hide when empty
6. 2026-08-22 check: Latest 737/232/232 fits the 1240 column; browse menu 0.3s scale-in; Load More 43px bar; duration badge 10px/700 on ink chip

Brand tokens stay curated (`DESIGN.md` / `context/06-design-tokens.md`). Structure/motion/screens follow this capture.

---

## minf-design

Pencil MCP is not connected. Approved direction: live Chloe Ting workout video library. Phase 2 implemented 2026-08-22 on local `/videos`.
