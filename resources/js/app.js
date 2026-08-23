import EmblaCarousel from 'embla-carousel';
import Autoplay from 'embla-carousel-autoplay';

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

/**
 * Home Embla carousels (merch + recent videos).
 * Roots: [data-home-carousel]
 * Optional pause: [data-home-autoplay-toggle] inside [data-home-carousel-section]
 * Merch: 4 visible (CSS) + autoplay scrolls one slide at a time through catalog.
 */
function initHomeCarousels() {
    document.querySelectorAll('[data-home-carousel]').forEach((root) => {
        const viewport = root.querySelector('.embla__viewport');
        if (!viewport || root.dataset.emblaReady === '1') {
            return;
        }

        const reduced = prefersReducedMotion();
        const isMerch = root.classList.contains('merch-carousel');
        const plugins = [];

        if (!reduced) {
            plugins.push(
                Autoplay({
                    delay: isMerch ? 3000 : 3200,
                    stopOnInteraction: false,
                    stopOnMouseEnter: true,
                    playOnInit: true,
                }),
            );
        }

        const embla = EmblaCarousel(
            viewport,
            {
                align: 'start',
                loop: !reduced,
                duration: reduced ? 0 : 28,
                slidesToScroll: 1,
                containScroll: false,
                skipSnaps: false,
            },
            plugins,
        );

        const autoplay = embla.plugins()?.autoplay;
        if (autoplay && !reduced) {
            // Ensure play after layout — 4-up merch needs measured snaps first
            const kick = () => {
                embla.reInit();
                if (!autoplay.isPlaying()) {
                    autoplay.play();
                }
            };
            requestAnimationFrame(() => requestAnimationFrame(kick));
        }

        const toggle = root
            .closest('[data-home-carousel-section]')
            ?.querySelector('[data-home-autoplay-toggle]');

        if (toggle && autoplay) {
            const syncToggle = (playing) => {
                toggle.textContent = playing ? 'Pause' : 'Play';
                const label = toggle.getAttribute('aria-label');
                if (label) {
                    toggle.setAttribute(
                        'aria-label',
                        playing ? label.replace(/^Play\b/, 'Pause') : label.replace(/^Pause\b/, 'Play'),
                    );
                }
            };

            toggle.hidden = false;
            syncToggle(true);

            toggle.addEventListener('click', () => {
                if (autoplay.isPlaying()) {
                    autoplay.stop();
                    syncToggle(false);
                } else {
                    autoplay.play();
                    syncToggle(true);
                }
            });
        }

        root.dataset.emblaReady = '1';
    });
}

function initHeroBannerParallax() {
    const banner = document.querySelector('[data-hero-banner]');
    const stage = document.querySelector('[data-hero-collage]');
    if (!banner || !stage || prefersReducedMotion()) {
        return;
    }

    const max = 10;
    window.addEventListener(
        'mousemove',
        (event) => {
            const box = stage.getBoundingClientRect();
            if (box.height === 0) {
                return;
            }
            const y = ((event.clientY - box.top) / box.height - 0.5) * -max;
            banner.style.transform = `translateY(${y.toFixed(3)}px) translateZ(0)`;
        },
        { passive: true },
    );
}

function initHomeReveals() {
    if (prefersReducedMotion()) {
        document.querySelectorAll('.home-reveal').forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const nodes = document.querySelectorAll('.home-reveal');
    if (!nodes.length) {
        return;
    }

    if (!('IntersectionObserver' in window)) {
        nodes.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15 },
    );

    nodes.forEach((el) => io.observe(el));
}

document.addEventListener('DOMContentLoaded', () => {
    initHomeCarousels();
    initHomeReveals();
    initHeroBannerParallax();
});
