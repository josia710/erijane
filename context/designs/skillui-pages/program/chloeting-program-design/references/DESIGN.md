# chloeting-program DESIGN.md

> Auto-generated design system — reverse-engineered via static analysis by skillui.
> Frameworks: None detected
> Colors: 11 · Fonts: 2 · Components: 0
> Icon library: not detected · State: not detected
> Primary theme: light · Dark mode toggle: no · Motion: none

## Visual Reference

**Match this design exactly** — study colors, fonts, spacing, and component shapes before writing any UI code.

![chloeting-program Homepage](../screenshots/homepage.png)

---

## 1. Visual Theme & Atmosphere

This is a **light-themed** interface with a cool, approachable feel. The light background emphasizes content clarity. Typography pairs **Manrope** for display/headings with **Poppins** for body text, creating clear visual hierarchy through type contrast. Spacing follows a **5px base grid** (standard density), with scale: 5, 10, 15, 20, 25, 30, 40, 50px. The palette is predominantly monochromatic with **#c1ebe6** as the single accent color — used sparingly for interactive elements and emphasis.

---

## 2. Color Palette & Roles

| Token | Hex | Role | Use |
|---|---|---|---|
| background | `#ffffff` | background | Page background, darkest surface |
| surface | `#edfefc` | surface | Card and panel backgrounds |
| text-primary | `#303033` | text-primary | Headings and body text |
| text-muted | `#868a93` | text-muted | Captions, placeholders, secondary info |
| accent | `#c1ebe6` | accent | CTAs, links, focus rings, active states |
| danger | `#e4485b` | danger | Error states, destructive actions |
| info | `#1890ff` | info | Informational highlights |
| unknown | `#000000` | unknown | Palette color |
| unknown | `#c4c4c4` | unknown | Palette color |
| unknown | `#eff0f4` | unknown | Palette color |
| unknown | `#e3e4eb` | unknown | Palette color |

### CSS Variable Tokens

```css
--color-primary: #303033;
--color-primary-disabled: #c4c4c4;
--color-secondary: #868a93;
--color-background-primary: #f7f7f7;
--color-background-secondary: #f3f3f3;
--border-primary: 1px solid var(--color-primary-disabled);
--border-secondary: 1px solid #eff0f4;
--color-background: #fafafa;
--color-action-background: #eaedef;
```


---

## 3. Typography Rules

**Font Stack:**
- **Poppins** — Heading 1, Heading 2, Heading 3
- **Manrope** — Body

| Role | Font | Size | Weight |
|---|---|---|---|
| Heading 1 | Poppins | 45px | 700 |
| Heading 2 | Poppins | 16px | 700 |
| Heading 3 | Poppins | 14px | 700 |
| Body | Manrope | 0px | 400 |

**Typographic Rules:**
- Limit to 2 font families max per screen
- Use **Poppins** for body/UI text, **Manrope** for display/headings
- Maintain consistent hierarchy: no more than 3-4 font sizes per screen
- Headings use bold (600-700), body uses regular (400)
- Line height: 1.5 for body text, 1.2 for headings
- Use color and opacity for secondary hierarchy, not additional font sizes


---

## 4. Component Stylings

No components detected. Scan `src/components/` or `components/` to populate this section.

---

## 5. Layout Principles

- **Base spacing unit:** 5px
- **Spacing scale:** 5, 10, 15, 20, 25, 30, 40, 50, 60, 80, 90, 100
- **Border radius:** 1px, 2px, 4px, 6px, 8px, 15px, 16px, 20px, 35px, 52px, 97px

**Spacing as Meaning:**
| Spacing | Use |
|---|---|
| 2.5-5px | Tight: related items within a group |
| 10px | Medium: between groups |
| 15-20px | Wide: between sections |
| 30px+ | Vast: major section breaks |


---

## 6. Depth & Elevation

### Flat — subtle depth hints

- `rgba(0, 0, 0, 0.016) 0px 2px 0px 0px`



---

## 8. Do's and Don'ts

### Do's

- Use `#c1ebe6` for interactive elements (buttons, links, focus rings)
- Use `#ffffff` as the primary page background
- Pair **Poppins** (body) with **Manrope** (display) — these are the only allowed fonts
- Follow the **5px** spacing grid for all margins, padding, and gaps
- Use the defined shadow tokens for elevation — see Section 6
- Use border-radius from the scale: 1px, 2px, 4px, 6px, 8px

### Don'ts

- Don't introduce colors outside this palette — extend the design tokens first
- Don't introduce additional font families beyond Poppins and Manrope
- Don't use arbitrary spacing values — stick to multiples of 5px
- Don't create custom box-shadow values outside the system tokens
- Don't use gradients — the design uses solid colors only
- Don't use arbitrary border-radius values — pick from the defined scale
- Don't use backdrop-blur or blur effects

### Anti-Patterns (detected from codebase)

- No gradient backgrounds
- No blur or backdrop-blur effects
- No zebra striping on tables/lists


---

## 9. Responsive Behavior

No breakpoints detected. Consider adding responsive breakpoints to the design system.

---

## 10. Agent Prompt Guide

Use these as starting points when building new UI:

### Build a Card

```
Background: #edfefc
Border: 1px solid var(--border)
Radius: 15px
Padding: 20px
Font: Poppins
Use shadow tokens from Section 6.
```

### Build a Button

```
Primary: bg #c1ebe6, text white
Ghost: bg transparent, border var(--border)
Padding: 10px 20px
Radius: 15px
Hover: opacity 0.9 or lighter shade
Focus: ring with #c1ebe6
```

### Build a Page Layout

```
Background: #ffffff
Max-width: 1280px, centered
Grid: 5px base
Responsive: mobile-first, breakpoints from Section 9
```

### Build a Stats Card

```
Surface: #edfefc
Label: #868a93 (muted, 12px, uppercase)
Value: #303033 (primary, 24-32px, bold)
Status: use success/warning/danger from Section 2
```

### Build a Form

```
Input bg: #ffffff
Input border: 1px solid var(--border)
Focus: border-color #c1ebe6
Label: #868a93 12px
Spacing: 20px between fields
Radius: 15px
```

### General Component

```
1. Read DESIGN.md Sections 2-6 for tokens
2. Colors: only from palette
3. Font: Poppins, type scale from Section 3
4. Spacing: 5px grid
5. Components: match patterns from Section 4
6. Elevation: shadow tokens
```
