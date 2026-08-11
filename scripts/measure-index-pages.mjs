/**
 * Playwright: measure index listing pages live vs local.
 * Usage: node scripts/measure-index-pages.mjs [localBase]
 */
import { chromium } from 'playwright';
import { mkdir } from 'node:fs/promises';
import path from 'node:path';

const LOCAL = process.argv[2] || 'http://127.0.0.1:8000';
const OUT = path.resolve('prototypes/index-measure');

const PAGES = [
  { key: 'programs', live: 'https://chloeting.com/program', local: '/programs' },
  { key: 'videos', live: 'https://chloeting.com/workout-video-library', local: '/videos' },
  { key: 'recipes', live: 'https://chloeting.com/recipes', local: '/recipes' },
  { key: 'store', live: 'https://store.chloeting.com/', local: '/store' },
];

async function measure(page) {
  await page.waitForTimeout(1200);
  return page.evaluate(() => {
    const h1 = document.querySelector('h1,h2');
    const cards = document.querySelectorAll('a img, .slick-slide img, article img, [class*="card"] img');
    const chips = document.querySelectorAll('button, [role="tab"], .ant-radio-button-wrapper, a[class*="filter"]');
    const grid = document.querySelector('[class*="grid"], .slick-slider, ul');
    const gridCs = grid ? getComputedStyle(grid) : null;
    return {
      title: h1?.textContent?.trim()?.slice(0, 80) || null,
      h1Size: h1 ? getComputedStyle(h1).fontSize : null,
      cardCount: cards.length,
      chipCount: chips.length,
      gridDisplay: gridCs?.display || null,
      gridCols: gridCs?.gridTemplateColumns?.slice(0, 80) || null,
      hasCarousel: !!document.querySelector('.slick-slider, .ant-carousel, [data-home-carousel]'),
    };
  });
}

async function run(browser, base, label, paths) {
  const page = await browser.newPage({ viewport: { width: 1280, height: 800 } });
  const results = [];
  await mkdir(OUT, { recursive: true });

  for (const p of paths) {
    const url = `${base.replace(/\/$/, '')}${p.local || ''}`;
    if (!url.startsWith('http')) continue;
    try {
      await page.goto(url, { waitUntil: 'networkidle', timeout: 60000 });
    } catch {
      await page.goto(url, { waitUntil: 'domcontentloaded', timeout: 60000 });
    }
    const data = await measure(page);
    const shot = path.join(OUT, `${label}-${p.key}.png`);
    await page.screenshot({ path: shot, fullPage: false });
    results.push({ key: p.key, url, ...data, screenshot: shot });
  }

  await page.close();
  return { label, pages: results };
}

const browser = await chromium.launch({ headless: true });
try {
  const livePages = PAGES.map(({ key, live }) => ({ key, local: live.replace('https://chloeting.com', '').replace('https://store.chloeting.com', '') || '/', live }));
  const reports = [
    await run(browser, 'https://chloeting.com', 'live', PAGES.map((p) => ({ ...p, local: p.live.replace(/^https:\/\/[^/]+/, '') || '/' }))),
  ];
  // live urls are full - fix run function

  // Simpler approach - run each URL directly
  const out = [];
  for (const label of ['live', 'local']) {
    const page = await browser.newPage({ viewport: { width: 1280, height: 800 } });
    const pages = [];
    for (const p of PAGES) {
      const url = label === 'live' ? p.live : `${LOCAL}${p.local}`;
      try {
        await page.goto(url, { waitUntil: 'networkidle', timeout: 60000 });
      } catch {
        await page.goto(url, { waitUntil: 'domcontentloaded', timeout: 60000 });
      }
      const data = await measure(page);
      const shot = path.join(OUT, `${label}-${p.key}.png`);
      await page.screenshot({ path: shot });
      pages.push({ key: p.key, url, ...data, screenshot: shot });
    }
    await page.close();
    out.push({ label, pages });
  }
  console.log(JSON.stringify(out, null, 2));
} finally {
  await browser.close();
}
