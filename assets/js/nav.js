document.addEventListener('DOMContentLoaded', () => {
    const nav = document.getElementById('main-nav');
    const hamburger = document.getElementById('nav-hamburger');
    const navLinks = document.getElementById('nav-links');

    // Scroll — add .scrolled class for solid background
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        if (scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
        lastScroll = scrollY;
    }, { passive: true });

    // Trigger on load in case page is already scrolled
    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    }

    // Hamburger toggle
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
            // Accessibility
            const expanded = hamburger.classList.contains('active');
            hamburger.setAttribute('aria-expanded', expanded);
        });

        // Close menu when clicking a link
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navLinks.classList.remove('active');
            });
        });

        // Close menu on outside click
        document.addEventListener('click', (e) => {
            if (!nav.contains(e.target)) {
                hamburger.classList.remove('active');
                navLinks.classList.remove('active');
            }
        });
    }

    // Smooth scroll for same-page anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});

// FAQ accordion
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const item = button.parentElement;
            const wasActive = item.classList.contains('active');

            // Close all
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));

            // Toggle clicked
            if (!wasActive) {
                item.classList.add('active');
            }
        });
    });
});
