/* Berita Pages JavaScript - Optimized External JS */

document.addEventListener("DOMContentLoaded", function () {
    // Initialize news page functionality
    initializeNewsPage();

    function initializeNewsPage() {
        // Performance monitoring
        monitorPagePerformance();

        // Initialize card interactions
        initializeCardInteractions();

        // Initialize external link handling
        initializeExternalLinks();

        // Initialize lazy loading for future enhancements
        initializeLazyLoading();

        // Initialize accessibility features
        initializeAccessibility();

        // Initialize touch optimizations
        initializeTouchOptimizations();
    }

    // Performance monitoring for mobile
    function monitorPagePerformance() {
        if ("connection" in navigator) {
            const connection = navigator.connection;
            if (
                connection.effectiveType === "slow-2g" ||
                connection.effectiveType === "2g"
            ) {
                // Disable animations on slow connections
                document.body.classList.add("reduce-motion");

                // Remove transition effects on slow connections
                const styleSheet = document.createElement("style");
                styleSheet.textContent = `
                    .news-card, .read-more-btn { transition: none !important; }
                    .news-card:hover { transform: none !important; }
                `;
                document.head.appendChild(styleSheet);
            }
        }
    }

    // Enhanced card interactions
    function initializeCardInteractions() {
        const newsCards = document.querySelectorAll(".news-card");

        newsCards.forEach((card) => {
            // Add click handler for better UX
            card.addEventListener("click", function (e) {
                // Don't trigger if clicking the read more button
                if (e.target.closest(".read-more-btn")) {
                    return;
                }

                const readMoreBtn = this.querySelector(".read-more-btn");
                if (readMoreBtn) {
                    // Add visual feedback
                    this.style.opacity = "0.8";
                    setTimeout(() => {
                        this.style.opacity = "";
                        readMoreBtn.click();
                    }, 150);
                }
            });

            // Add keyboard navigation
            card.addEventListener("keydown", function (e) {
                if (e.key === "Enter" || e.key === " ") {
                    e.preventDefault();
                    const readMoreBtn = this.querySelector(".read-more-btn");
                    if (readMoreBtn) {
                        readMoreBtn.click();
                    }
                }
            });

            // Make cards focusable for accessibility
            if (!card.hasAttribute("tabindex")) {
                card.setAttribute("tabindex", "0");
            }

            // Add ARIA label for better screen reader support
            const title = card.querySelector(".news-title");
            if (title && !card.hasAttribute("aria-label")) {
                card.setAttribute(
                    "aria-label",
                    `Berita: ${title.textContent.trim()}`,
                );
            }
        });
    }

    // External link handling with analytics and safety
    function initializeExternalLinks() {
        const externalLinks = document.querySelectorAll(
            '.read-more-btn[target="_blank"]',
        );

        externalLinks.forEach((link) => {
            // Add security attributes
            if (!link.hasAttribute("rel")) {
                link.setAttribute("rel", "noopener noreferrer");
            }

            // Add loading state
            link.addEventListener("click", function (e) {
                const card = this.closest(".news-card");
                if (card) {
                    card.classList.add("loading");

                    // Remove loading state after a short delay
                    setTimeout(() => {
                        card.classList.remove("loading");
                    }, 1000);
                }

                // Track analytics (if analytics is available)
                if (typeof gtag !== "undefined") {
                    gtag("event", "news_click", {
                        event_category: "engagement",
                        event_label: this.href,
                        transport_type: "beacon",
                    });
                }
            });

            // Add error handling for broken links
            link.addEventListener("error", function () {
                console.warn("Failed to open news link:", this.href);
                // Could show a user-friendly message here
            });
        });
    }

    // Lazy loading preparation for future image implementations
    function initializeLazyLoading() {
        // Create intersection observer for future image lazy loading
        if ("IntersectionObserver" in window) {
            const lazyImageObserver = new IntersectionObserver(
                (entries, observer) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.classList.remove("lazy");
                                observer.unobserve(img);
                            }
                        }
                    });
                },
            );

            // Store observer for future use
            window.newsLazyImageObserver = lazyImageObserver;
        }

        // Preload next page content if pagination exists
        const nextPageLink = document.querySelector(
            ".pagination .page-item:not(.disabled):last-child .page-link",
        );
        if (nextPageLink && "requestIdleCallback" in window) {
            requestIdleCallback(() => {
                const link = document.createElement("link");
                link.rel = "prefetch";
                link.href = nextPageLink.href;
                document.head.appendChild(link);
            });
        }
    }

    // Accessibility enhancements
    function initializeAccessibility() {
        // Add skip link for news content
        const newsSection = document.querySelector(".news-section");
        if (newsSection && !newsSection.hasAttribute("id")) {
            newsSection.setAttribute("id", "news-content");
        }

        // Improve pagination accessibility
        const pagination = document.querySelector(".pagination");
        if (pagination) {
            pagination.setAttribute("role", "navigation");
            pagination.setAttribute("aria-label", "Navigasi halaman berita");

            const pageLinks = pagination.querySelectorAll(".page-link");
            pageLinks.forEach((link, index) => {
                if (link.textContent.trim() === "«") {
                    link.setAttribute("aria-label", "Halaman sebelumnya");
                } else if (link.textContent.trim() === "»") {
                    link.setAttribute("aria-label", "Halaman berikutnya");
                } else if (
                    !link.closest(".page-item").classList.contains("active")
                ) {
                    link.setAttribute(
                        "aria-label",
                        `Ke halaman ${link.textContent.trim()}`,
                    );
                } else {
                    link.setAttribute(
                        "aria-label",
                        `Halaman ${link.textContent.trim()}, halaman saat ini`,
                    );
                    link.setAttribute("aria-current", "page");
                }
            });
        }

        // Announce content changes to screen readers
        const newsContainer = document.querySelector(".row.g-4");
        if (newsContainer) {
            newsContainer.setAttribute("aria-live", "polite");
            newsContainer.setAttribute("aria-label", "Daftar berita terbaru");
        }
    }

    // Touch optimizations for mobile devices
    function initializeTouchOptimizations() {
        if ("ontouchstart" in window) {
            const newsCards = document.querySelectorAll(".news-card");

            newsCards.forEach((card) => {
                let touchStartTime = 0;
                let touchStartPos = { x: 0, y: 0 };

                card.addEventListener(
                    "touchstart",
                    function (e) {
                        touchStartTime = Date.now();
                        touchStartPos = {
                            x: e.touches[0].clientX,
                            y: e.touches[0].clientY,
                        };

                        // Add visual feedback
                        this.style.backgroundColor = "#f8f9fa";
                    },
                    { passive: true },
                );

                card.addEventListener(
                    "touchend",
                    function (e) {
                        const touchEndTime = Date.now();
                        const touchDuration = touchEndTime - touchStartTime;

                        // Remove visual feedback
                        setTimeout(() => {
                            this.style.backgroundColor = "";
                        }, 150);

                        // Handle tap if it was quick and didn't move much
                        if (touchDuration < 300) {
                            const touchEndPos = {
                                x: e.changedTouches[0].clientX,
                                y: e.changedTouches[0].clientY,
                            };

                            const distance = Math.sqrt(
                                Math.pow(touchEndPos.x - touchStartPos.x, 2) +
                                    Math.pow(
                                        touchEndPos.y - touchStartPos.y,
                                        2,
                                    ),
                            );

                            if (distance < 10) {
                                // Minimal movement, treat as tap
                                const readMoreBtn =
                                    this.querySelector(".read-more-btn");
                                if (
                                    readMoreBtn &&
                                    !e.target.closest(".read-more-btn")
                                ) {
                                    setTimeout(() => readMoreBtn.click(), 50);
                                }
                            }
                        }
                    },
                    { passive: true },
                );

                card.addEventListener(
                    "touchcancel",
                    function () {
                        this.style.backgroundColor = "";
                    },
                    { passive: true },
                );
            });
        }
    }

    // Utility function for debouncing
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                timeout = null;
                if (!immediate) func(...args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func(...args);
        };
    }

    // Handle window resize for responsive adjustments
    const handleResize = debounce(() => {
        // Could add dynamic layout adjustments here if needed
        const newsCards = document.querySelectorAll(".news-card");
        newsCards.forEach((card) => {
            // Reset any inline styles that might interfere with responsive CSS
            card.style.height = "";
        });
    }, 250);

    window.addEventListener("resize", handleResize);

    // Handle page visibility change for performance
    document.addEventListener("visibilitychange", function () {
        if (document.hidden) {
            // Pause any ongoing animations or processes
            document.querySelectorAll(".news-card").forEach((card) => {
                card.style.animationPlayState = "paused";
            });
        } else {
            // Resume animations when page becomes visible
            document.querySelectorAll(".news-card").forEach((card) => {
                card.style.animationPlayState = "running";
            });
        }
    });

    // Error handling for the entire module
    window.addEventListener("error", function (e) {
        if (e.filename && e.filename.includes("berita-pages.js")) {
            console.error("Berita page error:", e.message);
            // Could send error to monitoring service
        }
    });

    // Initialize smooth scrolling for any anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href");
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });
});
