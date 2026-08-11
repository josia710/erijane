/** Assert home Embla carousels (merch + videos). Usage: node scripts/verify-merch-motion.mjs */
import { chromium } from 'playwright';

const LOCAL = process.argv[2] || 'http://127.0.0.1:8000/';
const browser = await chromium.launch({ headless: true });

async function measureMotion(page) {
    const section = page.locator('#merch-carousel');
    await section.scrollIntoViewIfNeeded();
    await page.waitForTimeout(500);

    const before = await section
        .locator('.embla__container')
        .evaluate((el) => el.style.transform || getComputedStyle(el).transform);
    await page.waitForTimeout(3500);
    const after = await section
        .locator('.embla__container')
        .evaluate((el) => el.style.transform || getComputedStyle(el).transform);

    const paddingLeft = await section
        .locator('.embla__viewport')
        .evaluate((el) => getComputedStyle(el).paddingLeft);
    const slide = await section.locator('.embla__slide').first().boundingBox();
    const toggleVisible = await page
        .locator('section:has(#merch-carousel) [data-home-autoplay-toggle]')
        .isVisible();

    return {
        moved: before !== after,
        before,
        after,
        paddingLeft,
        slideWidth: slide?.width ?? null,
        toggleVisible,
    };
}

async function pauseCarousel(page, carouselId) {
    const toggle = page.locator(`section:has(${carouselId}) [data-home-autoplay-toggle]`);
    if (await toggle.isVisible()) {
        const label = await toggle.textContent();
        if (label?.trim() === 'Pause') {
            await toggle.click();
            await page.waitForTimeout(600);
        }
    }
}

function countInView(root, extras = {}) {
    const vp = root.querySelector('.embla__viewport').getBoundingClientRect();
    const slides = [...root.querySelectorAll('.embla__slide')].map((el) => {
        const r = el.getBoundingClientRect();
        return { left: r.left, right: r.right, width: r.width };
    });
    const inView = slides.filter((s) => s.left < vp.right - 8 && s.right > vp.left + 8);
    return {
        viewportWidth: vp.width,
        slideWidth: inView[0]?.width ?? slides[0]?.width ?? null,
        inView: inView.length,
        ...extras,
    };
}

try {
    const page = await browser.newPage({ viewport: { width: 390, height: 844 } });
    await page.goto(LOCAL, { waitUntil: 'networkidle', timeout: 60000 }).catch(() =>
        page.goto(LOCAL, { waitUntil: 'domcontentloaded', timeout: 60000 }),
    );

    const motion = await measureMotion(page);
    const motionOk = motion.moved && parseFloat(motion.paddingLeft) > 50 && motion.toggleVisible;

    const reducedPage = await browser.newPage({
        viewport: { width: 390, height: 844 },
        reducedMotion: 'reduce',
    });
    await reducedPage.goto(LOCAL, { waitUntil: 'networkidle', timeout: 60000 }).catch(() =>
        reducedPage.goto(LOCAL, { waitUntil: 'domcontentloaded', timeout: 60000 }),
    );

    const reduced = await measureMotion(reducedPage);
    const reducedOk =
        !reduced.moved && parseFloat(reduced.paddingLeft) < 1 && !reduced.toggleVisible;

    const desktopPage = await browser.newPage({ viewport: { width: 1280, height: 800 } });
    await desktopPage.goto(LOCAL, { waitUntil: 'networkidle', timeout: 60000 }).catch(() =>
        desktopPage.goto(LOCAL, { waitUntil: 'domcontentloaded', timeout: 60000 }),
    );

    // Freeze autoplay so loop remaps can't flake the 4-up count mid-measure
    await pauseCarousel(desktopPage, '#merch-carousel');
    await pauseCarousel(desktopPage, '#videos-carousel');

    const desktopSection = desktopPage.locator('#merch-carousel');
    await desktopSection.scrollIntoViewIfNeeded();
    const desktop = await desktopSection.evaluate(countInView);
    const ratio = desktop.slideWidth / desktop.viewportWidth;
    // Live desktop: ~320px slides, 160px side gutters, ~3 full + peek (Playwright live-1280)
    const desktopOk =
        desktop.inView >= 3 &&
        desktop.slideWidth >= 300 &&
        desktop.slideWidth <= 330 &&
        ratio > 0.22 &&
        ratio < 0.28;

    const videosSection = desktopPage.locator('#videos-carousel');
    await videosSection.scrollIntoViewIfNeeded();
    const videos = await videosSection.evaluate((root) => {
        const thumb = root.querySelector('.videos-carousel__thumb');
        const radius = thumb ? getComputedStyle(thumb).borderRadius : null;
        const vp = root.querySelector('.embla__viewport').getBoundingClientRect();
        const slides = [...root.querySelectorAll('.embla__slide')].map((el) => {
            const r = el.getBoundingClientRect();
            return { left: r.left, right: r.right, width: r.width };
        });
        const inView = slides.filter((s) => s.left < vp.right - 8 && s.right > vp.left + 8);
        return {
            inView: inView.length,
            radius,
            slideWidth: inView[0]?.width ?? slides[0]?.width ?? null,
            viewportWidth: vp.width,
        };
    });
    const videosRatio = videos.slideWidth / videos.viewportWidth;
    const videosOk =
        videos.inView === 4 &&
        videosRatio > 0.22 &&
        videosRatio < 0.28 &&
        parseFloat(videos.radius) >= 16;

    const report = {
        motion,
        motionOk,
        reduced,
        reducedOk,
        desktop,
        desktopOk,
        videos,
        videosOk,
        ok: motionOk && reducedOk && desktopOk && videosOk,
    };
    console.log(JSON.stringify(report, null, 2));
    process.exit(report.ok ? 0 : 1);
} finally {
    await browser.close();
}
