# Interaction Reference

> Micro-interactions extracted from live DOM. Recreate these exactly for authentic feel.

## Coverage

| Component Type | Count | States Captured |
|----------------|-------|----------------|
| Button | 2 | default, hover, focus |
| Link | 3 | default, hover, focus |

## Transition System

These transition declarations were extracted from interactive elements:

```css
transition: 0.3s;
transition: color 0.3s;
```

Apply these to all interactive elements. Never invent new durations or easings.

## Button Interactions

### Button 1 — `View All Programs`

**States:**

- Default: `../screens/states/button-1-default.png`
- Hover: `../screens/states/button-1-hover.png`
- Focus: `../screens/states/button-1-focus.png`

**On hover:**

```css
/* background-color: rgba(0, 0, 0, 0) → */ background-color: rgb(255, 255, 255);
```

**Transition:** `0.3s`

### Button 2 — `Visit Store`

**States:**

- Default: `../screens/states/button-2-default.png`
- Hover: `../screens/states/button-2-hover.png`
- Focus: `../screens/states/button-2-focus.png`

**On hover:**

```css
/* background-color: rgba(0, 0, 0, 0) → */ background-color: rgb(255, 255, 255);
```

**Transition:** `0.3s`

## Link Interactions

### Link 1 — `CHLOE TING`

**States:**

- Default: `../screens/states/link-1-default.png`
- Hover: `../screens/states/link-1-hover.png`
- Focus: `../screens/states/link-1-focus.png`

**On hover:**

```css
/* outline: rgb(48, 48, 51) none 3px → */ outline: rgb(48, 48, 51) none 0px;
```

**On focus:**

```css
/* outline: rgb(48, 48, 51) none 3px → */ outline: rgb(48, 48, 51) none 0px;
```

**Transition:** `color 0.3s`

### Link 2 — `My Fitness Journey`

**States:**

- Default: `../screens/states/link-2-default.png`
- Hover: `../screens/states/link-2-hover.png`
- Focus: `../screens/states/link-2-focus.png`

**On hover:**

```css
/* outline: rgb(48, 48, 51) none 3px → */ outline: rgb(48, 48, 51) none 0px;
```

**On focus:**

```css
/* outline: rgb(48, 48, 51) none 3px → */ outline: rgb(48, 48, 51) none 0px;
```

**Transition:** `color 0.3s`

### Link 3 — `Workout Programs`

**States:**

- Default: `../screens/states/link-3-default.png`
- Hover: `../screens/states/link-3-hover.png`
- Focus: `../screens/states/link-3-focus.png`

**On hover:**

```css
/* outline: rgb(48, 48, 51) none 3px → */ outline: rgb(48, 48, 51) none 0px;
```

**On focus:**

```css
/* outline: rgb(48, 48, 51) none 3px → */ outline: rgb(48, 48, 51) none 0px;
```

**Transition:** `color 0.3s`

## Interaction Rules

- Accent color `#40a9ff` is used for focus rings, active states, and hover highlights
- Hover effects include **color transitions** — use the extracted values, not approximations
- Focus states use **outline** (not box-shadow) — always match the extracted focus ring
- Transition durations in use: `0.3s`
- Always respect `prefers-reduced-motion` — set all transitions to `0s` when enabled

