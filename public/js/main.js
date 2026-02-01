/**
 * Klik Farmasi - Main JavaScript
 * File JavaScript utama yang menggabungkan semua fungsi untuk optimasi
 */

document.addEventListener("DOMContentLoaded", function () {
    // ===== LAZY LOADING SYSTEM =====
    const imageObserver = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove("lazy-image");
                        img.classList.add("loaded");
                        observer.unobserve(img);
                    }
                }
            });
        },
        {
            rootMargin: "50px 0px",
            threshold: 0.01,
        },
    );

    document.querySelectorAll(".lazy-image").forEach((img) => {
        imageObserver.observe(img);
    });

    // ===== CAROUSEL OPTIMIZATION =====
    const cleanCarousel = document.getElementById("cleanCarousel");
    if (cleanCarousel) {
        new bootstrap.Carousel(cleanCarousel, {
            interval: 6000,
            wrap: true,
            touch: true,
        });

        cleanCarousel.addEventListener("mouseenter", function () {
            const carouselInstance = bootstrap.Carousel.getInstance(this);
            if (carouselInstance) carouselInstance.pause();
        });

        cleanCarousel.addEventListener("mouseleave", function () {
            const carouselInstance = bootstrap.Carousel.getInstance(this);
            if (carouselInstance) carouselInstance.cycle();
        });

        cleanCarousel.addEventListener("slide.bs.carousel", function () {
            const lazyImages = cleanCarousel.querySelectorAll(
                ".lazy-image[data-src]",
            );
            lazyImages.forEach((img) => {
                if (!img.src || img.src === window.location.href) {
                    img.src = img.dataset.src;
                    img.classList.remove("lazy-image");
                    img.classList.add("loaded");
                }
            });
        });
    }

    // ===== BACK TO TOP BUTTON =====
    const backToTopButton = document.getElementById("backToTop");
    if (backToTopButton) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.add("show");
            } else {
                backToTopButton.classList.remove("show");
            }
        });

        backToTopButton.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }

    // ===== FAQ SEARCH =====
    const faqSearch = document.getElementById("faqSearch");
    if (faqSearch) {
        let searchTimeout;
        faqSearch.addEventListener("keyup", function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = this.value.toLowerCase();
                const accordionItems =
                    document.querySelectorAll(".accordion-item");

                accordionItems.forEach((item) => {
                    const question = item
                        .querySelector(".accordion-button")
                        .textContent.toLowerCase();
                    const answer = item
                        .querySelector(".accordion-body")
                        .textContent.toLowerCase();

                    if (
                        question.includes(searchTerm) ||
                        answer.includes(searchTerm)
                    ) {
                        item.style.display = "";
                    } else {
                        item.style.display = "none";
                    }
                });
            }, 300);
        });
    }

    // ===== SMOOTH SCROLL =====
    const categoryLinks = document.querySelectorAll(".nav-link, .quick-link");
    categoryLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href && href.startsWith("#")) {
                e.preventDefault();
                const targetElement = document.querySelector(href);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: "smooth",
                    });
                    if (this.classList.contains("nav-link")) {
                        document
                            .querySelectorAll(".nav-link")
                            .forEach((navLink) => {
                                navLink.classList.remove("active");
                            });
                        this.classList.add("active");
                    }
                }
            }
        });
    });

    // ===== PERFORMANCE OPTIMIZATIONS =====

    // Font loading optimization
    if (sessionStorage.fontsLoaded) {
        document.documentElement.classList.add("fonts-loaded");
    } else if ("fonts" in document) {
        Promise.all([
            document.fonts.load('1rem "El Messiri"'),
            document.fonts.load('1rem "Open Sans"'),
        ]).then(function () {
            document.documentElement.classList.add("fonts-loaded");
            sessionStorage.fontsLoaded = true;
        });
    }

    // Preload critical resources after page load
    window.addEventListener("load", function () {
        if ("requestIdleCallback" in window) {
            requestIdleCallback(function () {
                const preloadLinks = [
                    "/artikel-kehamilan",
                    "/artikel-non-kehamilan",
                    "/tanya-jawab-kehamilan",
                    "/tanya-jawab-non-kehamilan",
                ];

                preloadLinks.forEach(function (url) {
                    const link = document.createElement("link");
                    link.rel = "prefetch";
                    link.href = url;
                    document.head.appendChild(link);
                });
            });
        }
    });

    // Optimize images for better performance
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(function (img) {
        img.style.opacity = "0";
        img.style.transition = "opacity 0.3s ease-in-out";

        img.onload = function () {
            img.style.opacity = "1";
        };
    });

    // AOS initialization with performance optimization
    if (window.requestIdleCallback) {
        window.requestIdleCallback(function () {
            if (
                typeof AOS !== "undefined" &&
                !document.getElementById("publicPreloader")
            ) {
                AOS.init({
                    duration: 600,
                    easing: "ease-in-out",
                    once: true,
                    offset: 80,
                    delay: 50,
                });
            }
        });
    }
});
