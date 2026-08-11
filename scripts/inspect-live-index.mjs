import { chromium } from 'playwright';

const b = await chromium.launch({ headless: true });
const p = await b.newPage({ viewport: { width: 1280, height: 800 } });

for (const [name, url] of [
  ['programs', 'https://chloeting.com/program'],
  ['videos', 'https://chloeting.com/workout-video-library'],
  ['recipes', 'https://chloeting.com/recipes'],
]) {
  await p.goto(url, { waitUntil: 'domcontentloaded', timeout: 45000 });
  const d = await p.evaluate(() => {
    const main = document.querySelector('main') || document.body;
    const headings = [...main.querySelectorAll('h1,h2,h3')]
      .slice(0, 8)
      .map((h) => ({
        tag: h.tagName,
        text: h.textContent.trim().slice(0, 60),
        size: getComputedStyle(h).fontSize,
      }));
    const firstCard = main.querySelector('a img')?.closest('a');
    const cardImg = firstCard?.querySelector('img');
    const cardBox = firstCard?.getBoundingClientRect();
    const filters = [...main.querySelectorAll('button, [role="tab"]')]
      .slice(0, 10)
      .map((el) => el.textContent?.trim().slice(0, 30))
      .filter(Boolean);
    return {
      headings,
      card: cardBox
        ? {
            w: Math.round(cardBox.width),
            h: Math.round(cardBox.height),
            radius: cardImg ? getComputedStyle(cardImg).borderRadius : null,
          }
        : null,
      filters,
    };
  });
  console.log(name, JSON.stringify(d, null, 2));
}

await b.close();
