

// Scroll reveal animation (repeatable — re-triggers every time element enters viewport)
document.addEventListener('DOMContentLoaded', function () {
    const fadeElements = document.querySelectorAll('.fade-up');

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            } else {
                // Remove visible class so animation replays on next scroll
                entry.target.classList.remove('visible');
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -30px 0px'
    });

    fadeElements.forEach(function (el) {
        observer.observe(el);
    });
});

// Active nav link highlight on scroll
document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    function setActiveNav() {
        let current = '';
        sections.forEach(function (section) {
            const top = section.offsetTop - 100;
            if (window.scrollY >= top) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(function (link) {
            const href = link.getAttribute('href');
            // Hanya jalankan scroll-spy jika section 'current' ditemukan
            if (current && href && href.includes('#' + current)) {
                link.classList.remove('active'); // Reset first to avoid duplicates
                link.classList.add('active');
            } else if (current && href && href.includes('#')) {
                // Jika sedang menyorot section lain, pastikan menu ber-anchor lain tidak active
                link.classList.remove('active');
            }
        });
    }

    window.addEventListener('scroll', setActiveNav);
    setActiveNav();
});
