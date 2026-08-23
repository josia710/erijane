"""Live capture of https://chloeting.com/recipes."""

from __future__ import annotations

import json
from pathlib import Path

from playwright.sync_api import sync_playwright

OUT = Path(
    r"d:\chloeting-clone\context\designs\skillui-pages\recipes"
    r"\chloeting-recipes-design\screens\live-2026-08-22"
)
OUT.mkdir(parents=True, exist_ok=True)
URL = "https://chloeting.com/recipes"
EDGE = r"C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe"

MEASURE = """
() => {
  const cs = (el) => {
    if (!el) return null;
    const s = getComputedStyle(el);
    const r = el.getBoundingClientRect();
    return {
      tag: el.tagName,
      id: el.id || null,
      className: (el.className && el.className.toString) ? el.className.toString().slice(0, 220) : '',
      text: (el.innerText || '').replace(/\\s+/g, ' ').trim().slice(0, 160),
      font: s.fontFamily,
      size: s.fontSize,
      weight: s.fontWeight,
      line: s.lineHeight,
      color: s.color,
      bg: s.backgroundColor,
      border: s.border,
      radius: s.borderRadius,
      pad: s.padding,
      display: s.display,
      grid: s.gridTemplateColumns,
      gap: s.gap,
      w: Math.round(r.width),
      h: Math.round(r.height),
      x: Math.round(r.x),
      y: Math.round(r.y),
    };
  };

  const pick = (sel) => cs(document.querySelector(sel));
  const byText = (tag, needle) => {
    const el = [...document.querySelectorAll(tag)].find((n) =>
      (n.innerText || '').replace(/\\s+/g, ' ').includes(needle)
    );
    return cs(el);
  };

  const h1s = [...document.querySelectorAll('h1')].map(cs);
  const h2s = [...document.querySelectorAll('h2')].map(cs);
  const h3s = [...document.querySelectorAll('h3')].slice(0, 40).map(cs);

  const toolbarBits = [...document.querySelectorAll('button, a, span, div')]
    .filter((el) => {
      const t = (el.innerText || '').replace(/\\s+/g, ' ').trim();
      return ['Browse By Collection', 'Search', 'Saved Recipes', 'Filters', 'Load More Latest Recipes', 'View All Recipes', 'View All', 'View Recipe'].includes(t);
    })
    .slice(0, 40)
    .map(cs);

  const grids = [...document.querySelectorAll('div')]
    .filter((el) => getComputedStyle(el).display.includes('grid'))
    .slice(0, 30)
    .map(cs);

  const cards = [...document.querySelectorAll('a')]
    .filter((a) => a.querySelector('img') && a.getBoundingClientRect().width > 80)
    .slice(0, 24)
    .map((a) => {
      const img = a.querySelector('img');
      const ir = img ? img.getBoundingClientRect() : null;
      const m = cs(a);
      m.href = (a.getAttribute('href') || '').slice(0, 120);
      m.imgW = ir ? Math.round(ir.width) : null;
      m.imgH = ir ? Math.round(ir.height) : null;
      m.imgRadius = img ? getComputedStyle(img).borderRadius : null;
      return m;
    });

  const header = document.querySelector('header') || document.querySelector('[class*="header"]');
  const body = document.body;

  return {
    title: document.title,
    url: location.href,
    pageH: document.documentElement.scrollHeight,
    viewport: { w: innerWidth, h: innerHeight },
    body: cs(body),
    header: cs(header),
    h1s,
    h2s,
    h3s,
    toolbarBits,
    grids,
    cards,
    browse: byText('button', 'Browse By Collection') || byText('div', 'Browse By Collection'),
    search: byText('button', 'Search') || pick('input[placeholder="Search"]'),
    saved: byText('button', 'Saved Recipes') || byText('div', 'Saved Recipes'),
    filters: byText('button', 'Filters'),
    loadMore: byText('button', 'Load More Latest Recipes') || byText('div', 'Load More Latest Recipes'),
    popular: byText('h2', 'Popular Categories') || byText('div', 'Popular Categories'),
  };
}
"""


def dump(page, name: str, extra=None) -> dict:
    data = page.evaluate(MEASURE)
    if extra:
        data.update(extra)
    (OUT / f"{name}.json").write_text(json.dumps(data, indent=2), encoding="utf-8")
    return data


def dismiss_cookies(page) -> None:
    for label in ("Accept All", "Accept", "I Accept", "Agree"):
        loc = page.get_by_role("button", name=label)
        try:
            if loc.count() and loc.first.is_visible():
                loc.first.click(timeout=1500)
                page.wait_for_timeout(400)
                return
        except Exception:
            pass
    page.evaluate(
        """() => {
          document.querySelectorAll('[class*="cky"], [id*="cookie"], [class*="cookie"]').forEach((el) => {
            if ((el.innerText || '').toLowerCase().includes('cookie')) el.remove();
          });
        }"""
    )


def click_inner(page, needle: str) -> dict:
    return page.evaluate(
        """(needle) => {
          const nodes = [...document.querySelectorAll('button, a, span, div')];
          const el = nodes.find((n) => (n.innerText || '').replace(/\\s+/g, ' ').trim() === needle);
          if (!el) return { clicked: false };
          const target = el.querySelector('button, span, a') || el;
          target.click();
          return { clicked: true, tag: target.tagName, text: (target.innerText || '').trim().slice(0, 80) };
        }""",
        needle,
    )


def main() -> None:
    with sync_playwright() as p:
        browser = p.chromium.launch(executable_path=EDGE, headless=True, channel=None)
        context = browser.new_context(viewport={"width": 1440, "height": 900}, device_scale_factor=1)
        page = context.new_page()
        page.goto(URL, wait_until="domcontentloaded", timeout=90000)
        page.wait_for_timeout(4000)
        page.wait_for_timeout(2500)
        dismiss_cookies(page)
        page.wait_for_timeout(800)

        dump(page, "00-metrics")
        page.screenshot(path=str(OUT / "00-hero-initial.png"), full_page=False)
        page.screenshot(path=str(OUT / "01-hero-1440.png"), full_page=False)

        page.evaluate("window.scrollTo(0, 220)")
        page.wait_for_timeout(400)
        page.screenshot(path=str(OUT / "02-latest-featured-1440.png"), full_page=False)

        for y, name in ((900, "03-popular-1440"), (1600, "04-featured-row-1440"), (2800, "07-collection-rows-1440")):
            page.evaluate(f"window.scrollTo(0, {y})")
            page.wait_for_timeout(400)
            page.screenshot(path=str(OUT / f"{name}.png"), full_page=False)

        page.evaluate("window.scrollTo(0, 0)")
        page.wait_for_timeout(400)

        browse_click = click_inner(page, "Browse By Collection")
        page.wait_for_timeout(700)
        items = page.evaluate(
            """() => {
              const menu = document.querySelector('.ant-dropdown:not(.ant-dropdown-hidden), .ant-select-dropdown, [class*="dropdown"]');
              const texts = [...document.querySelectorAll('li, [role="menuitem"], .ant-dropdown-menu-item')]
                .map((el) => (el.innerText || '').replace(/\\s+/g, ' ').trim())
                .filter(Boolean)
                .slice(0, 40);
              return { menuClass: menu ? menu.className.toString().slice(0, 180) : null, texts };
            }"""
        )
        (OUT / "06-browse-click.json").write_text(json.dumps(browse_click, indent=2), encoding="utf-8")
        (OUT / "06-browse-items.json").write_text(json.dumps(items, indent=2), encoding="utf-8")
        dump(page, "06-metrics", {"browseOpen": True})
        page.screenshot(path=str(OUT / "06-browse-dropdown-1440.png"), full_page=False)
        page.keyboard.press("Escape")
        page.wait_for_timeout(300)

        filters_click = click_inner(page, "Filters")
        page.wait_for_timeout(800)
        panel = page.evaluate(
            """() => {
              const headings = [...document.querySelectorAll('h3, h4, [class*="filter"] h2, [class*="Filter"] h2')]
                .map((el) => (el.innerText || '').replace(/\\s+/g, ' ').trim())
                .filter(Boolean)
                .slice(0, 20);
              const labels = ['Course', 'Convenience', 'Preference', 'Dietary Restriction', 'Total Time'];
              const cols = labels.map((name) => {
                const el = [...document.querySelectorAll('div, h3, h4')].find((n) =>
                  (n.innerText || '').replace(/\\s+/g, ' ').trim().startsWith(name) && n.getBoundingClientRect().height < 600
                );
                if (!el) return { name, found: false };
                const s = getComputedStyle(el);
                const r = el.getBoundingClientRect();
                return {
                  name,
                  found: true,
                  w: Math.round(r.width),
                  h: Math.round(r.height),
                  text: (el.innerText || '').replace(/\\s+/g, ' ').trim().slice(0, 240),
                };
              });
              const apply = [...document.querySelectorAll('button')].find((b) =>
                (b.innerText || '').trim() === 'Apply' || (b.innerText || '').includes('Apply')
              );
              let applyCs = null;
              if (apply) {
                const s = getComputedStyle(apply);
                const r = apply.getBoundingClientRect();
                applyCs = { text: apply.innerText.trim(), bg: s.backgroundColor, color: s.color, w: Math.round(r.width), h: Math.round(r.height), disabled: apply.disabled };
              }
              return { headings, cols, apply: applyCs };
            }"""
        )
        (OUT / "05-filters-click.json").write_text(json.dumps(filters_click, indent=2), encoding="utf-8")
        (OUT / "05-filters-panel.json").write_text(json.dumps(panel, indent=2), encoding="utf-8")
        dump(page, "05-metrics", {"filtersOpen": True})
        page.screenshot(path=str(OUT / "05-filters-open-1440.png"), full_page=False)
        page.keyboard.press("Escape")
        page.wait_for_timeout(300)

        page.evaluate("window.scrollTo(0, document.body.scrollHeight)")
        page.wait_for_timeout(500)
        dump(page, "08-footer-metrics")
        page.screenshot(path=str(OUT / "08-footer-1440.png"), full_page=False)

        context.close()
        mobile = browser.new_context(viewport={"width": 390, "height": 844}, device_scale_factor=2, is_mobile=True)
        mpage = mobile.new_page()
        mpage.goto(URL, wait_until="domcontentloaded", timeout=90000)
        mpage.wait_for_timeout(4000)
        mpage.wait_for_timeout(2500)
        dismiss_cookies(mpage)
        dump(mpage, "09-mobile-metrics")
        mpage.screenshot(path=str(OUT / "09-mobile-390.png"), full_page=False)
        mpage.evaluate("window.scrollTo(0, 500)")
        mpage.wait_for_timeout(400)
        mpage.screenshot(path=str(OUT / "10-mobile-listing-390.png"), full_page=False)
        click_inner(mpage, "Filters")
        mpage.wait_for_timeout(800)
        dump(mpage, "11-mobile-filters-metrics", {"filtersOpen": True})
        mpage.screenshot(path=str(OUT / "11-mobile-filters-390.png"), full_page=False)
        mobile.close()
        browser.close()
        print("wrote", OUT)


if __name__ == "__main__":
    main()
