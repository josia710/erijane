"""Live capture of https://chloeting.com/c/fitness-discussions."""

from __future__ import annotations

import json
from pathlib import Path

from playwright.sync_api import sync_playwright

OUT = Path(
    r"d:\chloeting-clone\context\designs\skillui-pages\community"
    r"\chloeting-community-design\screens\live-2026-08-22"
)
OUT.mkdir(parents=True, exist_ok=True)
URL = "https://chloeting.com/c/fitness-discussions"
EDGE = r"C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe"

MEASURE = """
() => {
  const cs = (el) => {
    if (!el) return null;
    const s = getComputedStyle(el);
    const r = el.getBoundingClientRect();
    return {
      tag: el.tagName,
      className: (el.className && el.className.toString) ? el.className.toString().slice(0, 220) : '',
      text: (el.innerText || '').replace(/\\s+/g, ' ').trim().slice(0, 220),
      font: s.fontFamily,
      size: s.fontSize,
      weight: s.fontWeight,
      line: s.lineHeight,
      color: s.color,
      bg: s.backgroundColor,
      border: s.border,
      borderLeft: s.borderLeft,
      radius: s.borderRadius,
      pad: s.padding,
      display: s.display,
      gap: s.gap,
      w: Math.round(r.width),
      h: Math.round(r.height),
      x: Math.round(r.x),
      y: Math.round(r.y),
    };
  };

  const byText = (tag, needle) => {
    const el = [...document.querySelectorAll(tag)].find((n) =>
      (n.innerText || '').replace(/\\s+/g, ' ').trim() === needle
        || (n.innerText || '').replace(/\\s+/g, ' ').includes(needle)
    );
    return cs(el);
  };

  const channels = [...document.querySelectorAll('a, p, div, li')]
    .filter((el) => /^#[a-z0-9-]+$/i.test((el.innerText || '').trim()) && el.getBoundingClientRect().width < 280)
    .slice(0, 20)
    .map(cs);

  const h2s = [...document.querySelectorAll('h1, h2')].slice(0, 16).map(cs);

  const toolbar = ['Search', 'Create Post', 'Latest', 'Last Active', 'All'].map((t) => ({
    t,
    ... (byText('button', t) || byText('div', t) || byText('span', t) || {}),
  }));

  const posts = [...document.querySelectorAll('h2, h3')]
    .map((el) => (el.innerText || '').replace(/\\s+/g, ' ').trim())
    .filter((t) => t && t.length > 8 && !t.startsWith('#') && t !== 'Community')
    .slice(0, 20);

  return {
    title: document.title,
    url: location.href,
    pageH: document.documentElement.scrollHeight,
    viewport: { w: innerWidth, h: innerHeight },
    body: cs(document.body),
    h2s,
    channels,
    toolbar,
    posts,
    createPost: byText('button', 'Create Post') || byText('a', 'Create Post'),
    latest: byText('button', 'Latest') || byText('div', 'Latest'),
    lastActive: byText('button', 'Last Active') || byText('div', 'Last Active'),
    all: byText('button', 'All') || byText('div', 'All'),
    search: byText('button', 'Search') || byText('div', 'Search'),
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
        page.wait_for_timeout(5000)
        dismiss_cookies(page)
        page.wait_for_timeout(800)

        dump(page, "00-metrics")
        page.screenshot(path=str(OUT / "00-hero-1440.png"), full_page=False)

        page.evaluate("window.scrollTo(0, 420)")
        page.wait_for_timeout(400)
        page.screenshot(path=str(OUT / "01-threads-1440.png"), full_page=False)

        all_click = click_inner(page, "All")
        page.wait_for_timeout(700)
        items = page.evaluate(
            """() => {
              const texts = [...document.querySelectorAll('li, [role="menuitem"], .ant-dropdown-menu-item, button, a')]
                .map((el) => (el.innerText || '').replace(/\\s+/g, ' ').trim())
                .filter((t) => t && t.length < 40)
                .slice(0, 50);
              return texts;
            }"""
        )
        (OUT / "02-all-click.json").write_text(json.dumps({"click": all_click, "items": items}, indent=2), encoding="utf-8")
        dump(page, "02-all-metrics", {"allOpen": True})
        page.screenshot(path=str(OUT / "02-all-dropdown-1440.png"), full_page=False)
        page.keyboard.press("Escape")
        page.wait_for_timeout(300)

        search_click = click_inner(page, "Search")
        page.wait_for_timeout(500)
        (OUT / "03-search-click.json").write_text(json.dumps(search_click, indent=2), encoding="utf-8")
        dump(page, "03-search-metrics", {"searchOpen": True})
        page.screenshot(path=str(OUT / "03-search-1440.png"), full_page=False)

        page.evaluate("window.scrollTo(0, document.body.scrollHeight)")
        page.wait_for_timeout(500)
        dump(page, "04-footer-metrics")
        page.screenshot(path=str(OUT / "04-footer-1440.png"), full_page=False)

        context.close()
        mobile = browser.new_context(viewport={"width": 390, "height": 844}, device_scale_factor=2, is_mobile=True)
        mpage = mobile.new_page()
        mpage.goto(URL, wait_until="domcontentloaded", timeout=90000)
        mpage.wait_for_timeout(5000)
        dismiss_cookies(mpage)
        dump(mpage, "05-mobile-metrics")
        mpage.screenshot(path=str(OUT / "05-mobile-390.png"), full_page=False)
        mpage.evaluate("window.scrollTo(0, 400)")
        mpage.wait_for_timeout(400)
        mpage.screenshot(path=str(OUT / "06-mobile-threads-390.png"), full_page=False)
        mobile.close()
        browser.close()
        print("wrote", OUT)


if __name__ == "__main__":
    main()
