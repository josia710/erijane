# Live capture — https://chloeting.com/recipes

Captured 2026-08-22 from the live page (Edge/Playwright at 1440×900 + Cursor browser).  
**This file + `screens/live-2026-08-22/` beat the older SkillUI markdown in this folder.** That pack mixed food-blog OCR, Poppins, and Ant `#40a9ff`.

SkillUI `--mode ultra` was not regenerated. Tokens below are measured, not guessed.

Local screens (gitignored): `screens/live-2026-08-22/`

| File | What |
|------|------|
| `00-hero-initial.png` | First load (toolbar + Latest; **no app-promo hero**) |
| `01-hero-1440.png` | Toolbar + Latest at 1440×900 |
| `02-latest-featured-1440.png` | Featured Latest split + side card |
| `03-popular-1440.png` | Featured Recipes collection row |
| `04-featured-row-1440.png` | Berry Delicious / Easy Vegan rails |
| `05-filters-open-1440.png` | Five-column Filters panel |
| `06-browse-dropdown-1440.png` | Browse By Collection menu |
| `07-collection-rows-1440.png` | Later collection rails |
| `08-footer-1440.png` | Footer / View All Recipes |
| `09-mobile-390.png` | 390 stacked Latest card |
| `10-mobile-listing-390.png` | Mobile listing |
| `11-mobile-filters-390.png` | Mobile Filters accordion sheet |

CookieYes / ad slots appear on some frames — third-party, not product UI.

---

## Page chrome

- **URL:** `https://chloeting.com/recipes`
- **Title:** Chloe Ting - Free Recipes
- **No H1.** “Latest Recipes” and “Popular Categories” are section titles (22px / 600 Manrope), not `h1`.
- **No app-promo hero** (unlike `/program`). Do not paste the programs hero onto `/recipes`.
- **Page height:** **8201px** at 1440×900 after collection rows load
- **Shell:** header `bg #f7f7f7`, `body` white, ink `rgb(48, 48, 51)` (`#303033`)
- **Muted:** `rgb(134, 138, 147)` (`#868A93`) on Load More
- **Disabled grey:** `rgb(196, 196, 196)` (`#c4c4c4`) — Saved Recipes (signed out), idle Apply, Clear Filters
- **Header:** 56px, `padding: 0 20px`, bg `#f7f7f7`
- **Content width:** **1240px** (100px side offset at 1440)
- **UI font:** **Manrope**. No Poppins on this page.
- Recipe cards route to **`/recipes/{slug}`** (in-site show pages), not YouTube.

---

## 1. Toolbar

Single row under the header. **No extra category chips** (no All / High Protein row under the toolbar).

| Control | Measure |
|---------|---------|
| Browse By Collection | Grey pill `bg #ededed`, radius **20px**, pad `5px 14px`, 14px, **186×32**. Open: filled `#303033`, white |
| Search | Magnifying glass + “Search”, **99×34**, inner pill `bg #f7f7f7` r15 pad `5px 14px` 14px/500 |
| Saved Recipes | Heart + “Saved Recipes”, **148×34**, pad `5px 14px`, radius **15px**, 14px/500. Signed out: text `#c4c4c4` |
| Filters (idle) | Icon + “Filters”, **95×34**, pad `5px 14px`, radius **15px**, 14px/500, `bg #f7f7f7` |
| Filters (open) | Filled `bg #303033`, white |

Mobile 390: Browse pill stays. Search / Saved / Filters collapse to **icons only**. Filters opens a full-screen accordion sheet (title “Filters” + X).

---

## 2. Browse By Collection

Ant dropdown. Items, in order (nav chrome also leaks into the scrape — product items are these):

1. View All Collections
2. Latest Recipes
3. Featured Recipes
4. Berry Delicious
5. Easy Vegan Recipes
6. Healthy Dessert Recipes
7. Quick And Easy Recipes
8. Healthy Snack Ideas
9. The Best High Protein Recipes
10. Easy Breakfast Ideas
11. Healthy Drinks Recipes
12. Party Food Recipes
13. Healthy Pancakes Recipes

**Not in Browse:** Popular Categories tiles (High Protein / Low Carb / Dairy Free / Vegetarian) — those are a separate row, plus `/recipes/category/{slug}` links.

---

## 3. Filters (desktop)

Five columns (not videos’ six). Panel sits under the toolbar and **pushes content down**.

| Column | Options |
|--------|---------|
| Course | Appetizers, Breakfast, Desserts, Drinks, Mains, Salads, Side Dish, Snacks |
| Convenience | 3 Ingredients Or Less, 5 Ingredients Or Less, Baking, Meal Prep, No-Cook, One Pan |
| Preference | High Protein, Low Carb, Low Fat |
| Dietary Restriction | Dairy Free, Gluten Free, Pescatarian, Vegan, Vegetarian |
| Total Time | 30 Mins Or Less, 10 Mins Or Less, 30 Mins + |

Footer: **Clear Filters** (muted until a filter is chosen) · **Cancel** · **Apply** (idle `#c4c4c4` 69×35 r35, disabled until a filter is chosen).

Mobile: accordion rows for the same five groups + X + Clear + Apply.

---

## 4. Latest Recipes

Section title 22px/600 + **View All** pill **82×36**, radius **52px**, pad `6px 15px`, 14px/500, `border 0.8px solid #303033`.

Desktop row is **not** videos’ 737/232/232 landscape thumbs. It is:

| Piece | Measure |
|-------|---------|
| Featured split card | **925×448**, radius **15px**, `border 0.8px solid #e9e9ef`, pad `24px 15px`, grid **`656px 217px`**, gap 20px, white |
| Featured image | **656×369**, radius **10px**; dietary pills overlay bottom-left |
| Featured copy | Title + star rating (e.g. 4.1) + **View Recipe** pill **111×35** r35 + plus + heart |
| Side card | Image **293×391**, radius **20px**; rating top-left; plus/heart top-right; tags bottom-left; title under image |
| Load More | **1240×43**, radius **12px**, pad 8px, 16px `#868A93`, `border 0.8px solid #eff0f4` — same bar as videos, not a 35px pill |

Mobile: Latest becomes a **stacked portrait** card (rating on image, time + tags under title), then the same Load More bar.

---

## 5. Popular Categories

Title **22px / 600**, full 1240 width.

Four tiles, grid **`295px × 4`**, gap `8px 20px`, row **90px**. Each tile: **88×88** thumb radius **14px** + H2 **18px/500** (`rgba(0,0,0,0.85)`) + muted count (`118 recipes`, …). Links: `/recipes/category/high-protein` (and low-carb, dairy-free, vegetarian).

---

## 6. Collection rails

After Popular Categories: **Featured Recipes**, then themed H2s (22px/600, flex row with View All). Each H2 row is grid `1150px 82px` gap 8px. Blurb under the title (14px muted).

Card rails: grid **`295px × 4`**, gap **20px**, row ~**475px**. Portrait image **293×391** r20. Overlays: rating pill, plus, heart, stacked dietary circles (LF / DF / Vg / Vn / GF / LC / HP / Pe). Title under image — **no cook-time on desktop rails** (time shows on the Latest featured meta and on mobile Latest).

Live blurbs (copy for parity, Erijane can keep tone):

| Collection | Blurb |
|------------|--------|
| Featured Recipes | Here is a list of the most popular recipes that people are loving! Try out some of these recipes to find out why everyone is raving about them. |
| Berry Delicious | Dreaming of summer-sweet berries? This recipe collection can inspire you all year round! |
| Easy Vegan Recipes | A collection of simple, delicious recipes free from dairy, meat or eggs. |
| Healthy Dessert Recipes | Love dessert while on a fitness journey? These healthy yet delicious sweet treats will satisfy that sweet tooth while keeping you on track. |
| Quick And Easy Recipes | Recipes that require only one pan and less than 30 minutes to make. Perfect for lazy days! |
| Healthy Snack Ideas | Easy healthy snacks full of protein, fiber, and healthy fats to keep you fueled up throughout the day. |
| The Best High Protein Recipes | Discover the best high protein meal ideas that are as easy to make as they are delicious! |
| Easy Breakfast Ideas | Start your day right with these easy peasy ideas. Some can even be prepared ahead of time! |
| Healthy Drinks Recipes | From smoothies to matcha latte or homemade boba, here are some healthy drinks to quench that thirst! |
| Party Food Recipes | Here are some of the best finger food and bite-sized appetizers to serve at your next party or picnic. |
| Healthy Pancakes Recipes | The best healthy pancakes recipes that still taste like a treat! Pick from gluten-free, high protein, vegan, and more. |

Page end: **View All Recipes** control on the 1240 column (~40px tall).

---

## 7. Tokens (implement)

Use Erijane tokens, not Ant hex: `bg-border` / `bg-pill` / `bg-surface` / `text-ink` / `text-muted`. Manrope. Hover scale ~200ms on thumbs; `prefers-reduced-motion` kills it.

Do **not** invent numeric star scores or view counts. Overlay stars / rating chip are chrome only. Plus / heart stay muted until auth exists. Dietary letters may map from catalog `category` (HP / LC / DF / Vg) — do not add CMS columns unless asked.

---

## Local Erijane notes (implemented 2026-08-22)

`/recipes` follows this capture’s chrome. Remaining data gaps (no CMS columns):

1. Catalog still has a single `category` + `time` — collections/filters are mapped, not stored
2. Rating chrome is visual-only (overlay pill + star chip) — catalog has no scores, so cards do not invent 4.1 / 4.3
3. Saved Recipes / plus / heart stay muted until auth exists for them
4. Course and Convenience filters match nothing (no catalog fields)
5. Themed rails hide when empty; Popular Categories counts come from catalog `category`
6. Dietary pills map from `category` (+ `Vn` when the title contains “vegan”)
