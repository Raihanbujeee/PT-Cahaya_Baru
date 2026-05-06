

// Scroll reveal animation (repeatable — re-triggers every time element enters viewport)
document.addEventListener('DOMContentLoaded', function () {
    const fadeElements = document.querySelectorAll('.fade-up');
    const counters = document.querySelectorAll('.counter');

    // Function for counter animation
    const runCounter = (el) => {
        if (el.isAnimating) return;
        el.isAnimating = true;

        const target = +el.getAttribute('data-target');
        const suffix = el.getAttribute('data-suffix') || '';
        const duration = 2000; // Animation duration in ms
        const stepTime = 20; // Update interval
        const totalSteps = duration / stepTime;
        const increment = target / totalSteps;
        
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                el.innerText = target + suffix;
                clearInterval(timer);
                el.isAnimating = false;
            } else {
                el.innerText = Math.floor(current) + suffix;
            }
        }, stepTime);
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                
                // If the intersecting element is or contains a counter
                if (entry.target.classList.contains('stats-grid')) {
                    counters.forEach(counter => {
                        // Reset to 0 before starting
                        counter.innerText = '0' + (counter.getAttribute('data-suffix') || '');
                        runCounter(counter);
                    });
                }
            } else {
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
