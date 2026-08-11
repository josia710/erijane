/**
 * Playwright: measure https://chloeting.com/ merch carousel vs local home.
 * Usage: node scripts/measure-merch.mjs [localUrl]
 */
import { chromium } from 'playwright';
import { mkdir } from 'node:fs/promises';
import path from 'node:path';

const LIVE = 'https://chloeting.com/';
const LOCAL = process.argv[2] || 'http://127.0.0.1:8000/';
const OUT = path.resolve('prototypes/merch-measure');

async function measureMerch(page, label) {
  await page.waitForTimeout(1500);

  const data = await page.evaluate(() => {
    const pick =
      document.querySelector('.merch-mobile') ||
      document.querySelector('.ant-carousel') ||
      document.querySelector('#merch-carousel') ||
      document.querySelector('[data-home-carousel].merch-carousel') ||
      document.querySelector('.merch-carousel') ||
      [...document.querySelectorAll('h2,h3')].find((h) => /merch/i.test(h.textContent || ''))
        ?.closest('section') ||
      null;

    if (!pick) {
      return { found: false };
    }

    const section = pick.closest('section') || pick;
    const heading = section.querySelector('h2,h3');
    const cta = [...section.querySelectorAll('a')].find((a) => /store|visit/i.test(a.textContent || ''));
    const slides = section.querySelectorAll(
      '.slick-slide:not(.slick-cloned) img, .embla__slide img, .ant-carousel img, a img',
    );
    const list =
      section.querySelector('.slick-list') ||
      section.querySelector('.embla__viewport') ||
      section.querySelector('.ant-carousel');
    const track = section.querySelector('.slick-track') || section.querySelector('.embla__container');

    const listCs = list ? getComputedStyle(list) : null;
    const firstSlide =
      section.querySelector('.slick-slide:not(.slick-cloned)') ||
      section.querySelector('.embla__slide') ||
      section.querySelector('a');
    const firstImg = firstSlide?.querySelector('img') || slides[0];

    const rect = (el) => {
      if (!el) return null;
      const r = el.getBoundingClientRect();
      return { w: Math.round(r.width), h: Math.round(r.height), x: Math.round(r.x), y: Math.round(r.y) };
    };

    return {
      found: true,
      heading: heading?.textContent?.trim() || null,
      cta: cta?.textContent?.trim() || null,
      ctaHref: cta?.getAttribute('href') || null,
      slideCount: slides.length,
      listPadding: listCs ? listCs.padding : null,
      listOverflow: listCs ? listCs.overflow : null,
      sectionClass: section.className,
      listClass: list?.className || null,
      trackWidth: track ? Math.round(track.getBoundingClientRect().width) : null,
      firstSlide: rect(firstSlide),
      firstImg: rect(firstImg),
      imgObjectFit: firstImg ? getComputedStyle(firstImg).objectFit : null,
      hasSlick: !!section.querySelector('.slick-slider'),
      hasEmbla: !!section.querySelector('.embla__viewport, [data-home-carousel], .merch-carousel'),
      hasAnt: !!section.querySelector('.ant-carousel'),
    };
  });

  const shot = path.join(OUT, `${label}.png`);
  const section = page.locator('section').filter({ hasText: /Merch/i }).first();
  if (await section.count()) {
    await section.scrollIntoViewIfNeeded();
    await page.waitForTimeout(800);
    await section.screenshot({ path: shot });
  } else {
    await page.screenshot({ path: shot, fullPage: false });
  }

  return { ...data, screenshot: shot };
}

async function runViewport(browser, url, label, size) {
  const page = await browser.newPage({ viewport: size });
  try {
    await page.goto(url, { waitUntil: 'networkidle', timeout: 60000 });
  } catch {
    await page.goto(url, { waitUntil: 'domcontentloaded', timeout: 60000 });
  }
  const result = await measureMerch(page, `${label}-${size.width}`);
  await page.close();
  return { label, viewport: size, ...result };
}

await mkdir(OUT, { recursive: true });

const browser = await chromium.launch({ headless: true });
const reports = [];

try {
  reports.push(await runViewport(browser, LIVE, 'live', { width: 390, height: 844 }));
  reports.push(await runViewport(browser, LIVE, 'live', { width: 1280, height: 800 }));

  try {
    reports.push(await runViewport(browser, LOCAL, 'local', { width: 390, height: 844 }));
    reports.push(await runViewport(browser, LOCAL, 'local', { width: 1280, height: 800 }));
  } catch (e) {
    reports.push({ label: 'local', error: String(e), note: 'Start `php artisan serve` then re-run' });
  }
} finally {
  await browser.close();
}

console.log(JSON.stringify(reports, null, 2));
