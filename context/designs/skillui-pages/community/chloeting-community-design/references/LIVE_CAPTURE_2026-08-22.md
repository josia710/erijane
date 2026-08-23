# Live capture — `/c/fitness-discussions` (2026-08-22)

Source: Playwright 1440×900 + 390×844 against https://chloeting.com/c/fitness-discussions  
Screens: `screens/live-2026-08-22/` (gitignored). Older SkillUI embeds mixed homepage/login.

## Chrome (implement)

- White canvas, Manrope 14px, ink `#303033`. No marketing CTA on this URL.
- Two columns: sidebar ~220px + feed. Sidebar `border-right` `#eff0f4`.
- Sidebar heading **Community**. Channels with line icons: `#fitness` (active lavender fill + brand bar), `#before-after-results`, `#fitness-journeys`, `#food`, `#off-topic`, `#feedback`, `#tech-support`, `#looking-for-team`, `#announcements`.
- Sidebar footer: four muted icon slots (bookmark, chat, messages, settings) — chrome only.
- Feed header: `#fitness` + Search (icon + label) + **Create Post** pill (`114×29`, radius 35px, weight 700, fill ink).
- Sort: **Latest** (active dark pill) / **Last Active**. **All** dropdown (Misc / Programs on live tags).
- Thread: 32px avatar, username + shield, relative time, Pinned (lavender + pin) and category pills (Misc chat / Programs calendar), 18px/600 title, 2–3 line muted snippet.
- Thread actions: Replies count, vote up/count/down, Save, Share — light border pills.
- Pager: Previous / Next.
- Search click: pill field, placeholder **Search posts**. Duration **0.3s** (live INTERACTIONS).
- Mobile: `#fitness` select, mag search, Latest/Last Active, sliders = All, FAB **+ New Post**.

## Local Erijane notes

1. Canonical route stays `/community`; `/c/fitness-discussions` redirects there (Chloe IA URL).
2. Home still has the Decision C marketing CTA. This page is forums chrome only.
3. Threads are a static shell — votes / Save / Share stay muted. Create Post and + New Post go to login.
4. Do not copy live member avatars, display names, or post bodies.
5. Filter Ant: no `#40a9ff` focus rings; Erijane tokens. Active channel uses lavender + brand bar.
