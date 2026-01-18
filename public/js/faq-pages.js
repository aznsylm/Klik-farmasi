/* FAQ Pages - External JavaScript Optimization */
/* Consistent with artikel-pages.js and berita-pages.js */

// FAQ Search Functionality
class FAQSearch {
    constructor() {
        this.searchInput = null;
        this.faqItems = [];
        this.debounceTimer = null;
        this.init();
    }

    init() {
        // Wait for DOM to be fully loaded
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.searchInput = document.getElementById("faqSearch");
        this.faqItems = Array.from(document.querySelectorAll(".faq-item"));

        if (this.searchInput && this.faqItems.length > 0) {
            this.storeOriginalNumbering();
            this.bindEvents();
            this.enhanceAccessibility();
        }
    }

    storeOriginalNumbering() {
        this.faqItems.forEach((item) => {
            const questionNumber = item.querySelector(".question-number");
            if (questionNumber) {
                const originalNumber = questionNumber.textContent;
                item.setAttribute("data-original-number", originalNumber);
            }
        });
    }

    bindEvents() {
        // Debounced search input
        this.searchInput.addEventListener("input", (e) => {
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => {
                this.performSearch(e.target.value.toLowerCase().trim());
            }, 300);
        });

        // Enter key search
        this.searchInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                clearTimeout(this.debounceTimer);
                this.performSearch(e.target.value.toLowerCase().trim());
            }
        });

        // Clear search with Escape key
        this.searchInput.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                this.clearSearch();
            }
        });
    }

    performSearch(searchTerm) {
        let visibleCount = 0;

        this.faqItems.forEach((item, index) => {
            const questionText =
                item
                    .querySelector(".question-text")
                    ?.textContent.toLowerCase() || "";
            const answerText =
                item.querySelector(".answer-text")?.textContent.toLowerCase() ||
                "";

            const isVisible =
                !searchTerm ||
                questionText.includes(searchTerm) ||
                answerText.includes(searchTerm);

            if (isVisible) {
                item.style.display = "block";
                item.style.animation = `fadeIn 0.3s ease ${index * 0.05}s both`;
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });

        // Re-number visible FAQ items
        this.renumberVisibleItems();
        this.updateSearchResults(searchTerm, visibleCount);
    }

    renumberVisibleItems() {
        const visibleItems = this.faqItems.filter(
            (item) => item.style.display !== "none",
        );

        visibleItems.forEach((item, index) => {
            const questionNumber = item.querySelector(".question-number");
            if (questionNumber) {
                questionNumber.textContent = index + 1;
            }
        });
    }

    updateSearchResults(searchTerm, count) {
        // Remove existing result message
        const existingMessage = document.querySelector(
            ".search-results-message",
        );
        if (existingMessage) {
            existingMessage.remove();
        }

        if (searchTerm) {
            const resultMessage = document.createElement("div");
            resultMessage.className =
                "search-results-message alert alert-info d-flex align-items-center mb-4";
            resultMessage.style.borderRadius = "15px";
            resultMessage.innerHTML = `
                <i class="bi bi-info-circle me-2"></i>
                <span>Menampilkan <strong>${count}</strong> hasil untuk "<em>${searchTerm}</em>"</span>
                <button type="button" class="btn-close ms-auto" aria-label="Clear search"></button>
            `;

            // Insert after search bar
            const searchContainer = document.querySelector(".faq-search");
            if (searchContainer) {
                searchContainer.insertAdjacentElement(
                    "afterend",
                    resultMessage,
                );

                // Bind clear button
                resultMessage
                    .querySelector(".btn-close")
                    ?.addEventListener("click", () => {
                        this.clearSearch();
                    });
            }
        }
    }

    clearSearch() {
        if (this.searchInput) {
            this.searchInput.value = "";
            this.performSearch("");
            this.restoreOriginalNumbering();
        }
    }

    restoreOriginalNumbering() {
        this.faqItems.forEach((item, index) => {
            const questionNumber = item.querySelector(".question-number");
            if (questionNumber) {
                // Restore original numbering based on data attribute or calculate from position
                const originalNumber = item.getAttribute(
                    "data-original-number",
                );
                if (originalNumber) {
                    questionNumber.textContent = originalNumber;
                } else {
                    // Fallback: use current index + 1
                    questionNumber.textContent = index + 1;
                }
            }
        });
    }

    enhanceAccessibility() {
        if (this.searchInput) {
            this.searchInput.setAttribute("aria-describedby", "search-help");

            // Add search help text
            const helpText = document.createElement("small");
            helpText.id = "search-help";
            helpText.className = "form-text text-muted";
            this.searchInput.parentNode.appendChild(helpText);
        }
    }
}

// FAQ Accordion Enhancement
class FAQAccordion {
    constructor() {
        this.accordionItems = [];
        this.init();
    }

    init() {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.accordionItems = Array.from(
            document.querySelectorAll(".faq-button"),
        );

        if (this.accordionItems.length > 0) {
            this.enhanceAccordion();
            this.addKeyboardNavigation();
            this.addSmoothScrolling();
        }
    }

    enhanceAccordion() {
        this.accordionItems.forEach((button, index) => {
            // Add click analytics (if needed)
            button.addEventListener("click", () => {
                this.trackFAQInteraction(button, index);
            });

            // Enhanced hover effects
            const questionNumber = button.querySelector(".question-number");
            if (questionNumber) {
                button.addEventListener("mouseenter", () => {
                    questionNumber.style.transform =
                        "scale(1.1) rotate(360deg)";
                    questionNumber.style.transition = "all 0.3s ease";
                });

                button.addEventListener("mouseleave", () => {
                    questionNumber.style.transform = "scale(1) rotate(0deg)";
                });
            }
        });
    }

    addKeyboardNavigation() {
        this.accordionItems.forEach((button, index) => {
            button.addEventListener("keydown", (e) => {
                switch (e.key) {
                    case "ArrowDown":
                        e.preventDefault();
                        this.focusNextItem(index);
                        break;
                    case "ArrowUp":
                        e.preventDefault();
                        this.focusPrevItem(index);
                        break;
                    case "Home":
                        e.preventDefault();
                        this.focusFirstItem();
                        break;
                    case "End":
                        e.preventDefault();
                        this.focusLastItem();
                        break;
                }
            });
        });
    }

    addSmoothScrolling() {
        this.accordionItems.forEach((button) => {
            button.addEventListener("click", () => {
                setTimeout(() => {
                    const targetCollapse = document.querySelector(
                        button.getAttribute("data-bs-target"),
                    );
                    if (
                        targetCollapse &&
                        targetCollapse.classList.contains("show")
                    ) {
                        targetCollapse.scrollIntoView({
                            behavior: "smooth",
                            block: "nearest",
                            inline: "nearest",
                        });
                    }
                }, 350); // Wait for Bootstrap animation
            });
        });
    }

    focusNextItem(currentIndex) {
        const nextIndex = (currentIndex + 1) % this.accordionItems.length;
        this.accordionItems[nextIndex]?.focus();
    }

    focusPrevItem(currentIndex) {
        const prevIndex =
            currentIndex === 0
                ? this.accordionItems.length - 1
                : currentIndex - 1;
        this.accordionItems[prevIndex]?.focus();
    }

    focusFirstItem() {
        this.accordionItems[0]?.focus();
    }

    focusLastItem() {
        this.accordionItems[this.accordionItems.length - 1]?.focus();
    }

    trackFAQInteraction(button, index) {
        const questionText =
            button.querySelector(".question-text")?.textContent || "";

        // Analytics tracking (implement as needed)
        if (typeof gtag !== "undefined") {
            gtag("event", "faq_interaction", {
                question_index: index + 1,
                question_preview: questionText.substring(0, 50),
                page_title: document.title,
            });
        }

        console.log("FAQ Interaction:", {
            index: index + 1,
            question: questionText,
            timestamp: new Date().toISOString(),
        });
    }
}

// Quick Links Enhancement
class QuickLinks {
    constructor() {
        this.init();
    }

    init() {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        const quickLinks = document.querySelectorAll(".quick-link");

        quickLinks.forEach((link) => {
            // Add smooth scrolling for anchor links
            if (link.getAttribute("href")?.startsWith("#")) {
                link.addEventListener("click", (e) => {
                    e.preventDefault();
                    const targetId = link.getAttribute("href");
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: "smooth",
                            block: "start",
                        });
                    }
                });
            }

            // Enhanced hover animation
            link.addEventListener("mouseenter", () => {
                link.style.transform = "translateX(8px) scale(1.02)";
            });

            link.addEventListener("mouseleave", () => {
                link.style.transform = "translateX(0) scale(1)";
            });
        });
    }
}

// Contact Links Enhancement
class ContactLinks {
    constructor() {
        this.init();
    }

    init() {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        const whatsappLinks = document.querySelectorAll('a[href*="wa.me"]');

        whatsappLinks.forEach((link) => {
            // Track WhatsApp clicks
            link.addEventListener("click", () => {
                const phoneNumber = link.href.match(/\+\d+/)?.[0] || "unknown";

                if (typeof gtag !== "undefined") {
                    gtag("event", "whatsapp_contact", {
                        phone_number: phoneNumber,
                        page_type: "faq",
                        page_title: document.title,
                    });
                }

                console.log("WhatsApp Contact:", phoneNumber);
            });

            // Enhanced animation
            link.addEventListener("mouseenter", () => {
                const icon = link.querySelector(".bg-success");
                if (icon) {
                    icon.style.transform = "scale(1.1) rotate(5deg)";
                    icon.style.transition = "all 0.3s ease";
                }
            });

            link.addEventListener("mouseleave", () => {
                const icon = link.querySelector(".bg-success");
                if (icon) {
                    icon.style.transform = "scale(1) rotate(0deg)";
                }
            });
        });

        // Social media links
        const socialLinks = document.querySelectorAll(".social-icon");
        socialLinks.forEach((link) => {
            link.addEventListener("click", () => {
                const platform = link.href.includes("instagram")
                    ? "instagram"
                    : link.href.includes("tiktok")
                      ? "tiktok"
                      : link.href.includes("wa.me")
                        ? "whatsapp"
                        : link.href.includes("mailto")
                          ? "email"
                          : "unknown";

                if (typeof gtag !== "undefined") {
                    gtag("event", "social_media_click", {
                        platform: platform,
                        page_type: "faq",
                    });
                }
            });
        });
    }
}

// Performance Monitoring
class PerformanceMonitor {
    constructor() {
        this.init();
    }

    init() {
        // Monitor page load performance
        window.addEventListener("load", () => {
            if ("performance" in window) {
                setTimeout(() => {
                    const perfData =
                        performance.getEntriesByType("navigation")[0];
                    this.logPerformance(perfData);
                }, 1000);
            }
        });
    }

    logPerformance(perfData) {
        const metrics = {
            pageLoadTime: Math.round(
                perfData.loadEventEnd - perfData.fetchStart,
            ),
            domContentLoaded: Math.round(
                perfData.domContentLoadedEventEnd - perfData.fetchStart,
            ),
            firstPaint: this.getFirstPaint(),
            pageType: "faq",
        };

        console.log("FAQ Page Performance:", metrics);

        // Send to analytics if needed
        if (typeof gtag !== "undefined") {
            gtag("event", "page_performance", metrics);
        }
    }

    getFirstPaint() {
        const paintEntries = performance.getEntriesByType("paint");
        const firstPaint = paintEntries.find(
            (entry) => entry.name === "first-paint",
        );
        return firstPaint ? Math.round(firstPaint.startTime) : null;
    }
}

// CSS Animation Styles (inject if needed)
const injectAnimationStyles = () => {
    if (!document.querySelector("#faq-animations")) {
        const style = document.createElement("style");
        style.id = "faq-animations";
        style.textContent = `
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
            
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
        `;
        document.head.appendChild(style);
    }
};

// Initialize all components
const initFAQPage = () => {
    // Inject animations
    injectAnimationStyles();

    // Initialize components
    new FAQSearch();
    new FAQAccordion();
    new QuickLinks();
    new ContactLinks();
    new PerformanceMonitor();

    console.log("FAQ Page initialized successfully");
};

// Auto-initialize
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initFAQPage);
} else {
    initFAQPage();
}

// Expose global functions if needed
window.FAQPageUtils = {
    search: (term) => {
        const searchInput = document.getElementById("faqSearch");
        if (searchInput) {
            searchInput.value = term;
            searchInput.dispatchEvent(new Event("input"));
        }
    },

    clearSearch: () => {
        const searchInput = document.getElementById("faqSearch");
        if (searchInput) {
            searchInput.value = "";
            searchInput.dispatchEvent(new Event("input"));
        }
    },
};

// Error handling
window.addEventListener("error", (e) => {
    console.error("FAQ Page Error:", e.error);
});

window.addEventListener("unhandledrejection", (e) => {
    console.error("FAQ Page Promise Rejection:", e.reason);
});
