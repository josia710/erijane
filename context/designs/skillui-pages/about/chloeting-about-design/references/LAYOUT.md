# Layout Reference

> Auto-extracted from live DOM. Use this to understand how the site is structured spatially.

## Spacing System

**Base grid:** 4px

**Scale:** `2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30` px

| Spacing | Semantic Use |
|---------|-------------|
| 4px | Tight — within a component |
| 8px | Medium — between sibling items |
| 16px | Wide — between sections |
| 32px | Vast — major section breaks |

## Grid Layouts

| Element | Template Columns | Gap | Children |
|---------|-----------------|-----|----------|
| `section.sc-4f516a77-8.hsXoiv` | `600px 596px` | 20px 44px | 2 |
| `article.sc-4f516a77-15.dwknDW` | `176.656px` | — | 3 |
| `article.sc-4f516a77-15.dwknDW` | `176.672px` | — | 3 |
| `article.sc-4f516a77-15.dwknDW` | `176.672px` | — | 3 |
| `article.sc-4f516a77-15.dwknDW` | `176.656px` | — | 3 |
| `article.sc-4f516a77-15.dwknDW` | `176.672px` | — | 3 |
| `article.sc-4f516a77-15.dwknDW` | `176.672px` | — | 3 |

## Structural Containers

### `<header>` (`header.sc-fa17463b-0.cqsIsV`)

```
display:          block
padding:          0px 20px
children:         1
```

### `<footer>` (`footer.sc-920433a0-0.begBAW`)

```
display:          block
padding:          0px 20px
children:         1
```

### `<section>` (`section.sc-7f97eba3-1.duMVlZ`)

```
display:          block
padding:          0px 24px
max-width:        1288px
children:         1
```

### `<section>` (`section.sc-4f516a77-0.lmSFSE`)

```
display:          block
children:         4
```

### `<section>` (`section.sc-4f516a77-8.hsXoiv`)

```
display:          grid
grid-template-columns: 600px 596px
gap:              20px 44px
children:         2
```

### `<section>` (`section.sc-4f516a77-10.gDmQBC`)

```
display:          block
padding:          50px 0px 75px
children:         2
```

### `<nav>` (`nav.sc-e0a9e758-0.fzNVgI`)

```
display:          block
children:         2
```

### `<article>` (`article.sc-4f516a77-15.dwknDW`)

```
display:          grid
grid-template-columns: 176.656px
padding:          30px 16px 20px
children:         3
```

### `<article>` (`article.sc-4f516a77-15.dwknDW`)

```
display:          grid
grid-template-columns: 176.672px
padding:          30px 16px 20px
children:         3
```

### `<article>` (`article.sc-4f516a77-15.dwknDW`)

```
display:          grid
grid-template-columns: 176.672px
padding:          30px 16px 20px
children:         3
```

### `<article>` (`article.sc-4f516a77-15.dwknDW`)

```
display:          grid
grid-template-columns: 176.656px
padding:          30px 16px 20px
children:         3
```

### `<article>` (`article.sc-4f516a77-15.dwknDW`)

```
display:          grid
grid-template-columns: 176.672px
padding:          30px 16px 20px
children:         3
```

## Layout Rules

- **Container max-width:** `1288px` — always center with `margin: auto`
- Secondary layout system: **CSS Grid** (used for card grids and multi-column layouts)
- Every spacing value must be a multiple of **4px**
- Never use arbitrary margin/padding values outside the spacing scale

