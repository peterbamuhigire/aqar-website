// Wait for DOM
document.addEventListener('DOMContentLoaded', () => {
    // Register GSAP plugins
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        initAnimations();
    }
});

function initAnimations() {
    // Make elements visible (they start as visibility:hidden in CSS)

    // Fade up reveals
    gsap.utils.toArray('.reveal').forEach(el => {
        gsap.fromTo(el,
            { autoAlpha: 0, y: 30 },
            {
                scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' },
                autoAlpha: 1, y: 0, duration: 0.8, ease: 'power2.out'
            }
        );
    });

    // Slide from left
    gsap.utils.toArray('.reveal-left').forEach(el => {
        gsap.fromTo(el,
            { autoAlpha: 0, x: -50 },
            {
                scrollTrigger: { trigger: el, start: 'top 88%' },
                autoAlpha: 1, x: 0, duration: 0.9, ease: 'power2.out'
            }
        );
    });

    // Slide from right
    gsap.utils.toArray('.reveal-right').forEach(el => {
        gsap.fromTo(el,
            { autoAlpha: 0, x: 50 },
            {
                scrollTrigger: { trigger: el, start: 'top 88%' },
                autoAlpha: 1, x: 0, duration: 0.9, ease: 'power2.out'
            }
        );
    });

    // Scale reveals
    gsap.utils.toArray('.reveal-scale').forEach(el => {
        gsap.fromTo(el,
            { autoAlpha: 0, scale: 0.92 },
            {
                scrollTrigger: { trigger: el, start: 'top 88%' },
                autoAlpha: 1, scale: 1, duration: 1, ease: 'power2.out'
            }
        );
    });

    // Stagger children (parent has .reveal-stagger class)
    gsap.utils.toArray('.reveal-stagger').forEach(parent => {
        gsap.fromTo(parent.children,
            { autoAlpha: 0, y: 30 },
            {
                scrollTrigger: { trigger: parent, start: 'top 88%' },
                autoAlpha: 1, y: 0, duration: 0.6, stagger: 0.12, ease: 'power2.out'
            }
        );
    });

    // Counter animation for trust stats
    gsap.utils.toArray('.trust-stat-number[data-count]').forEach(el => {
        const target = parseInt(el.dataset.count, 10);
        const obj = { val: 0 };
        gsap.to(obj, {
            scrollTrigger: { trigger: el, start: 'top 90%' },
            val: target,
            duration: 1.5,
            ease: 'power2.out',
            onUpdate: () => {
                el.textContent = Math.round(obj.val) + (el.dataset.suffix || '');
            }
        });
    });
}
