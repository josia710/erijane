/**
 * Playwright: measure home hero vs https://chloeting.com/
 * Usage: node scripts/measure-home-hero.mjs [localUrl]
 */
import { chromium } from 'playwright';
import { mkdir } from 'node:fs/promises';
import path from 'node:path';

const LIVE = 'https://chloeting.com/';
const LOCAL = process.argv[2] || 'http://127.0.0.1:8000/';
const OUT = path.resolve('prototypes/hero-measure');

async function measureHero(page, label) {
  await page.waitForTimeout(1200);

  const data = await page.evaluate(async () => {
    const hero =
      document.querySelector('.home-hero') ||
      document.querySelector('h1')?.closest('section') ||
      document.querySelector('main section:first-of-type');

    if (!hero) {
      return { found: false };
    }

    const h1 = hero.querySelector('h1');
    const floats = [...hero.querySelectorAll('img')].filter((img) => {
      const r = img.getBoundingClientRect();
      return r.width > 40 && r.width < 200;
    });

    const sampleFloat = floats[0] || null;
    let animated = false;
    if (sampleFloat) {
      const t0 = sampleFloat.getBoundingClientRect().y;
      await new Promise((r) => setTimeout(r, 800));
      const t1 = sampleFloat.getBoundingClientRect().y;
      animated = Math.abs(t1 - t0) > 0.5;
    }

    const cs = h1 ? getComputedStyle(h1) : null;
    const heroCs = getComputedStyle(hero);

    return {
      found: true,
      h1: h1?.textContent?.trim() || null,
      h1Font: cs?.fontFamily || null,
      h1Size: cs?.fontSize || null,
      floatCount: floats.length,
      floatAnimated: animated,
      heroBg: heroCs.backgroundImage?.slice(0, 80) || null,
      hasReveal: !!document.querySelector('.home-reveal'),
    };
  });

  const shot = path.join(OUT, `${label}.png`);
  const section = page.locator('section').first();
  if (await section.count()) {
    await section.screenshot({ path: shot });
  }

  return { ...data, screenshot: shot };
}

async function run(browser, url, label, size) {
  const page = await browser.newPage({ viewport: size });
  try {
    await page.goto(url, { waitUntil: 'networkidle', timeout: 60000 });
  } catch {
    await page.goto(url, { waitUntil: 'domcontentloaded', timeout: 60000 });
  }
  const result = await measureHero(page, `${label}-${size.width}`);
  await page.close();
  return { label, viewport: size, ...result };
}

await mkdir(OUT, { recursive: true });
const browser = await chromium.launch({ headless: true });
const size = { width: 1280, height: 800 };

try {
  const reports = [
    await run(browser, LIVE, 'live', size),
    await run(browser, LOCAL, 'local', size),
  ];
  console.log(JSON.stringify(reports, null, 2));
} finally {
  await browser.close();
}
