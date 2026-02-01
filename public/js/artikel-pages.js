/* Artikel Pages JavaScript - Optimized External JS */

document.addEventListener("DOMContentLoaded", function () {
    // Update modal image when modal is shown
    const imageModal = document.getElementById("imageModal");
    if (imageModal) {
        imageModal.addEventListener("show.bs.modal", function (event) {
            const trigger = event.relatedTarget;
            const modalImage = document.getElementById("modalImage");
            if (modalImage && trigger) {
                modalImage.src = trigger.src;
                modalImage.alt = trigger.alt;
            }
        });
    }

    // Lazy loading optimization for images
    const lazyImages = document.querySelectorAll(".lazy-image");
    if (lazyImages.length > 0) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove("lazy-image");
                        observer.unobserve(img);
                    }
                }
            });
        });

        lazyImages.forEach((img) => imageObserver.observe(img));
    }

    // Performance optimization: Preload next/previous article images
    const articleNavigation = document.querySelector(".article-navigation");
    if (articleNavigation) {
        const navigationLinks = articleNavigation.querySelectorAll("a");
        navigationLinks.forEach((link) => {
            link.addEventListener("mouseenter", function () {
                const linkElement = document.createElement("link");
                linkElement.rel = "prefetch";
                linkElement.href = this.href;
                document.head.appendChild(linkElement);
            });
        });
    }

    // Smooth scroll for internal links
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    internalLinks.forEach((link) => {
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

    // Contact item hover optimization for mobile
    if (window.innerWidth <= 768) {
        const contactItems = document.querySelectorAll(".contact-item");
        contactItems.forEach((item) => {
            item.addEventListener("touchstart", function () {
                this.style.backgroundColor = "#f8f9fa";
            });
            item.addEventListener("touchend", function () {
                setTimeout(() => {
                    this.style.backgroundColor = "";
                }, 200);
            });
        });
    }

    // Image error handling
    const allImages = document.querySelectorAll("img");
    allImages.forEach((img) => {
        img.addEventListener("error", function () {
            // Prevent infinite loop by checking if we already tried the fallback
            if (!this.dataset.errorHandled) {
                this.dataset.errorHandled = "true";
                // Fallback to existing sample image
                this.src = "/assets/sample-1.jpg";
                this.alt = "Image not available";
            }
        });
    });

    // Performance monitoring for mobile
    if ("connection" in navigator) {
        const connection = navigator.connection;
        if (
            connection.effectiveType === "slow-2g" ||
            connection.effectiveType === "2g"
        ) {
            // Disable animations on slow connections
            document.body.classList.add("reduce-motion");
        }
    }

    // Optimize carousel for touch devices
    const carousel = document.querySelector(".carousel");
    if (carousel && "ontouchstart" in window) {
        let startX = 0;
        let endX = 0;

        carousel.addEventListener("touchstart", function (e) {
            startX = e.touches[0].clientX;
        });

        carousel.addEventListener("touchend", function (e) {
            endX = e.changedTouches[0].clientX;
            const diffX = startX - endX;

            if (Math.abs(diffX) > 50) {
                // Minimum swipe distance
                if (diffX > 0) {
                    // Swipe left - next slide
                    const nextBtn = this.querySelector(
                        ".carousel-control-next",
                    );
                    if (nextBtn) nextBtn.click();
                } else {
                    // Swipe right - previous slide
                    const prevBtn = this.querySelector(
                        ".carousel-control-prev",
                    );
                    if (prevBtn) prevBtn.click();
                }
            }
        });
    }
});
