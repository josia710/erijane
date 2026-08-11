# Council merge — 2026-08-03

## Stage 1 sources
- Response A minimal: [e05b0e6f…](e05b0e6f-0afb-43c1-a978-79631c49d63c)
- Response B thorough: [cc73f924…](cc73f924-be3c-4ea6-9d93-d57d799475e3)
- council-advisor: [d4d5b1a6…](d4d5b1a6-923e-4d39-9c2f-ec5cadf8211b)

## Stage 2 — anonymized peer review (orchestrator)

| Reviewer | Notes | FINAL RANKING |
|----------|-------|---------------|
| R1 (lean) | A sharper Karpathy cut; B correct that snap≠done + measure live slick | 1. A 2. B |
| R2 (parity) | B stronger on grill → measure → prototype; A underweights U1 settings | 1. B 2. A |
| R3 (advisor) | DESIGN.md §6 blocks goal; home is plain Blade (no wire:navigate); slick-vs-Embla stay open until CDP | — |

Aggregate: **conservative merge** + advisor corrections.

## Stage 3 — Chairman synthesis (final)

**Gate B mandatory artifact:** amend `DESIGN.md` §1 dials + §6 Motion before Stage C — today MOTION 3 / “hover scale only” forbids carousels/scroll work. Draft:

```markdown
## 6. Motion
- Card hover: image scale ~1.03–1.05, 200ms ease-out
- Home merch: drag/peek carousel parity with live (engine TBD: Embla or slick-vanilla — not Ant Design React)
- Optional subtle section entrance (opacity/translate) matching live hydrate; honor prefers-reduced-motion
- Dial: MOTION 5 for home marketing surfaces only; listings stay MOTION 3
```

**Ship:** home-first Blade; measure live slick/peek (U1) then pick engine — **Embla preferred, slick-vanilla allowed if CDP proves feel gap**; ban Ant Design React; wire `hero_bg`; minimal `app.js`; Manrope/Erijane tokens unless T3 says Poppins hero.

**Livewire:** home has no Livewire — carousel `DOMContentLoaded` OK. Catalog `⚡` SFCs only need `wire:ignore` if a carousel lands there later.

**Skip:** GSAP invent, skillui token overwrite, Next rewrite, sitewide before home, `/loop`.

**Order:** T1–T3 approve → DESIGN.md §6 amend → CDP U1 → (optional prototype) → carousel+hero → RouteSmokeTest/build → code-reviewer + laravel-simplifier.

**Confidence:** 7.5/10 — DESIGN conflict resolved in plan; still capped on interview + engine choice.
