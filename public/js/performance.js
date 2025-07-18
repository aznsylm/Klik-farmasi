/**
 * Klik Farmasi - Performance JavaScript
 * Kumpulan fungsi untuk meningkatkan performa website
 */

// Lazy load gambar
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk lazy load gambar
    const lazyLoadImages = function() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        if (lazyImage.dataset.srcset) {
                            lazyImage.srcset = lazyImage.dataset.srcset;
                        }
                        lazyImage.classList.remove('lazy');
                        imageObserver.unobserve(lazyImage);
                    }
                });
            });
            
            lazyImages.forEach(function(lazyImage) {
                imageObserver.observe(lazyImage);
            });
        } else {
            // Fallback untuk browser yang tidak mendukung Intersection Observer
            let lazyLoadThrottleTimeout;
            
            function lazyLoad() {
                if (lazyLoadThrottleTimeout) {
                    clearTimeout(lazyLoadThrottleTimeout);
                }
                
                lazyLoadThrottleTimeout = setTimeout(function() {
                    const scrollTop = window.pageYOffset;
                    lazyImages.forEach(function(lazyImage) {
                        if (lazyImage.offsetTop < (window.innerHeight + scrollTop)) {
                            lazyImage.src = lazyImage.dataset.src;
                            if (lazyImage.dataset.srcset) {
                                lazyImage.srcset = lazyImage.dataset.srcset;
                            }
                            lazyImage.classList.remove('lazy');
                        }
                    });
                    
                    if (lazyImages.length == 0) {
                        document.removeEventListener('scroll', lazyLoad);
                        window.removeEventListener('resize', lazyLoad);
                        window.removeEventListener('orientationChange', lazyLoad);
                    }
                }, 20);
            }
            
            document.addEventListener('scroll', lazyLoad);
            window.addEventListener('resize', lazyLoad);
            window.addEventListener('orientationChange', lazyLoad);
        }
    };
    
    // Jalankan lazy load
    lazyLoadImages();
});

// Preload halaman yang mungkin dikunjungi
document.addEventListener('DOMContentLoaded', function() {
    // Tunggu sampai halaman selesai loading
    window.addEventListener('load', function() {
        // Preload halaman setelah idle
        if ('requestIdleCallback' in window) {
            requestIdleCallback(function() {
                // Preload halaman utama
                const preloadLinks = [
                    '/artikel-kehamilan',
                    '/artikel-non-kehamilan',
                    '/tanya-jawab-kehamilan',
                    '/tanya-jawab-non-kehamilan'
                ];
                
                preloadLinks.forEach(function(url) {
                    const link = document.createElement('link');
                    link.rel = 'prefetch';
                    link.href = url;
                    document.head.appendChild(link);
                });
            });
        }
    });
});

// Optimasi font loading
document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah font sudah di-cache
    if (sessionStorage.fontsLoaded) {
        document.documentElement.classList.add('fonts-loaded');
        return;
    }
    
    // Font loading API
    if ('fonts' in document) {
        Promise.all([
            document.fonts.load('1rem "El Messiri"'),
            document.fonts.load('1rem "Open Sans"')
        ]).then(function() {
            document.documentElement.classList.add('fonts-loaded');
            sessionStorage.fontsLoaded = true;
        });
    }
});