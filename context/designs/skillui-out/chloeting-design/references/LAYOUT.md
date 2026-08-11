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

## Flex Layouts

| Element | Direction | Justify | Align | Gap | Children |
|---------|-----------|---------|-------|-----|----------|
| `section.sc-b8265d47-2.gsUVEg` | column | — | — | — | 1 |
| `section.sc-4da9f25d-28.kYudmT` | column | — | start | — | 4 |
| `section.sc-bd8e59e8-3.brPMPN` | column | center | — | — | 1 |

## Grid Layouts

| Element | Template Columns | Gap | Children |
|---------|-----------------|-----|----------|
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |
| `article.sc-bd8e59e8-0.bmTsYe` | `820px` | — | 2 |

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

### `<section>` (`section.sc-7f97eba3-1.bmYFFU`)

```
display:          block
children:         1
```

### `<section>` (`section.sc-b8265d47-2.gsUVEg`)

```
display:          flex
flex-direction:   column
justify-content:  —
align-items:      —
children:         1
```

### `<section>` (`section.sc-4da9f25d-28.kYudmT`)

```
display:          flex
flex-direction:   column
justify-content:  —
align-items:      start
padding:          24px
max-width:        404px
children:         4
```

### `<nav>` (`nav.sc-e0a9e758-0.fzNVgI`)

```
display:          block
children:         2
```

### `<section>` (`section.sc-bd8e59e8-3.brPMPN`)

```
display:          flex
flex-direction:   column
justify-content:  center
align-items:      —
padding:          54px 0px 100px
max-width:        1440px
children:         1
```

### `<article>` (`article.sc-bd8e59e8-0.bmTsYe`)

```
display:          grid
grid-template-columns: 820px
children:         2
```

### `<article>` (`article.sc-bd8e59e8-0.bmTsYe`)

```
display:          grid
grid-template-columns: 820px
children:         2
```

### `<article>` (`article.sc-bd8e59e8-0.bmTsYe`)

```
display:          grid
grid-template-columns: 820px
children:         2
```

### `<article>` (`article.sc-bd8e59e8-0.bmTsYe`)

```
display:          grid
grid-template-columns: 820px
children:         2
```

### `<article>` (`article.sc-bd8e59e8-0.bmTsYe`)

```
display:          grid
grid-template-columns: 820px
children:         2
```

## Layout Rules

- **Container max-width:** `404px` — always center with `margin: auto`
- Primary layout system: **Flexbox**
- Secondary layout system: **CSS Grid** (used for card grids and multi-column layouts)
- Every spacing value must be a multiple of **4px**
- Never use arbitrary margin/padding values outside the spacing scale

