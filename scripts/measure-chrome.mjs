/**
 * Playwright: measure nav + footer chrome vs live.
 * Usage: node scripts/measure-chrome.mjs [localUrl]
 */
import { chromium } from 'playwright';
import { mkdir } from 'node:fs/promises';
import path from 'node:path';

const LIVE = 'https://chloeting.com/';
const LOCAL = process.argv[2] || 'http://127.0.0.1:8000/';
const OUT = path.resolve('prototypes/chrome-measure');

async function measureChrome(page, label) {
  const header = page.locator('header').first();
  const footer = page.locator('footer').first();

  await header.waitFor({ state: 'visible', timeout: 15000 }).catch(() => {});

  const data = await page.evaluate(() => {
    const header = document.querySelector('header');
    const footer = document.querySelector('footer');
    if (!header || !footer) {
      return { found: false };
    }

    const headerRect = header.getBoundingClientRect();
    const headerCs = getComputedStyle(header);
    const navLinks = [...header.querySelectorAll('a')].map((a) => ({
      text: a.textContent?.trim().slice(0, 40),
      href: a.getAttribute('href')?.slice(0, 60),
    }));
    const footerLinks = [...footer.querySelectorAll('a')].map((a) => ({
      text: a.textContent?.trim(),
      href: a.getAttribute('href')?.slice(0, 60),
    }));
    const social = footer.querySelectorAll('a svg, footer [class*="social"] a, footer a img').length;

    const loginBtn = [...header.querySelectorAll('a, button')].find((el) =>
      /log in/i.test(el.textContent || ''),
    );
    const loginCs = loginBtn ? getComputedStyle(loginBtn) : null;

    return {
      found: true,
      headerHeight: Math.round(headerRect.height),
      headerBg: headerCs.backgroundColor,
      headerBorder: headerCs.borderBottomWidth,
      navLinkCount: navLinks.length,
      navLinks: navLinks.slice(0, 12),
      footerLinkCount: footerLinks.length,
      footerLinks,
      socialIconCount: social,
      loginBorderRadius: loginCs?.borderRadius || null,
      loginBg: loginCs?.backgroundColor || null,
      copyright: footer.querySelector('h6, p, small')?.textContent?.trim().slice(0, 60) || null,
    };
  });

  await mkdir(OUT, { recursive: true });
  const shot = path.join(OUT, `${label}-chrome.png`);
  await page.screenshot({ path: shot, fullPage: false });

  return { ...data, screenshot: shot };
}

async function run(browser, url, label) {
  const page = await browser.newPage({ viewport: { width: 1280, height: 800 } });
  try {
    await page.goto(url, { waitUntil: 'networkidle', timeout: 60000 });
  } catch {
    await page.goto(url, { waitUntil: 'domcontentloaded', timeout: 60000 });
  }
  const result = await measureChrome(page, label);
  await page.close();
  return { label, ...result };
}

const browser = await chromium.launch({ headless: true });
try {
  const reports = [await run(browser, LIVE, 'live'), await run(browser, LOCAL, 'local')];
  console.log(JSON.stringify(reports, null, 2));
} finally {
  await browser.close();
}
