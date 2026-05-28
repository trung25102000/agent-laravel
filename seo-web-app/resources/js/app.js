document.documentElement.classList.add('js');

const revealItems = document.querySelectorAll('[data-reveal]');

if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        },
        { rootMargin: '0px 0px -12% 0px', threshold: 0.12 },
    );

    revealItems.forEach((item) => revealObserver.observe(item));
} else {
    revealItems.forEach((item) => item.classList.add('is-visible'));
}

const storyCarousels = document.querySelectorAll('[data-story-carousel]');
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

storyCarousels.forEach((carousel) => {
    const slides = Array.from(carousel.querySelectorAll('[data-story-slide]'));
    const controls = Array.from(carousel.querySelectorAll('[data-story-control]'));
    const intervalMs = Number(carousel.dataset.storyInterval || 5500);
    let activeIndex = 0;
    let timer = null;

    if (slides.length === 0) {
        return;
    }

    const setActiveSlide = (nextIndex) => {
        activeIndex = (nextIndex + slides.length) % slides.length;

        slides.forEach((slide, index) => {
            const isActive = index === activeIndex;

            slide.classList.toggle('is-active', isActive);
            slide.toggleAttribute('hidden', !isActive);
            slide.setAttribute('aria-hidden', String(!isActive));
        });

        controls.forEach((control, index) => {
            const isActive = index === activeIndex;

            control.classList.toggle('is-active', isActive);
            control.setAttribute('aria-selected', String(isActive));
        });
    };

    const stop = () => {
        if (timer) {
            window.clearInterval(timer);
            timer = null;
        }
    };

    const start = () => {
        if (prefersReducedMotion || slides.length < 2 || timer) {
            return;
        }

        timer = window.setInterval(() => setActiveSlide(activeIndex + 1), intervalMs);
    };

    controls.forEach((control, index) => {
        control.addEventListener('click', () => {
            stop();
            setActiveSlide(index);
            start();
        });
    });

    carousel.addEventListener('mouseenter', stop);
    carousel.addEventListener('mouseleave', start);
    carousel.addEventListener('focusin', stop);
    carousel.addEventListener('focusout', start);

    setActiveSlide(0);
    start();
});
