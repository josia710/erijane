# Blind spot — page parity (2026-08-11)

Goal: SkillUI-driven parity for program, videos, recipes, community, about, login, signup.

## Three failure modes
1. **Community product fork** — Live forums chrome vs local CTA stub; coding “parity” without A/B/C locks the wrong surface.
2. **Token pack contamination** — SkillUI Ant blues/reds + Poppins overwrite curated Manrope/Erijane teal.
3. **False green tests** — Home-only `verify:parity` / thin ParityShell while listings stay off.

## Must-read
- `context/designs/SITE_MAP.md`
- `context/plans/2026-08-11-page-parity.md`
- `context/decisions/2026-08-11-page-parity.md`
- Curated `DESIGN.md` + `context/06-design-tokens.md`
- Explore: [Blind spot page parity](beabb0ba-fa39-48ed-a1ef-4a0b66013aeb)

## Unknown types (per finding)
| Finding | Known unknown | Unknown unknown | Knowns that aren't | Unknown knowns |
|---------|---------------|-----------------|--------------------|----------------|
| Community | A/B/C choice | How deep forums shell feels “done” | Prior “no forum” may not be final | Tests encode CTA |
| Tokens | Filter list exists | Page-specific CSS vars | SkillUI DESIGN ≠ brand SoT | Agents trust latest extract |
| Verify | Home measure only | Measure script gaps per route | Routes “exist” ≠ layout match | Smoke green hides UI debt |
