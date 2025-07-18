// Service Worker for Klik Farmasi
const CACHE_NAME = 'klik-farmasi-v1';
const urlsToCache = [
    '/',
    '/css/pages.css',
    '/css/responsive.css',
    '/css/performance.css',
    '/js/pages.js',
    '/js/performance.js',
    '/assets/LOGO KLIKFARMASI VEKTOR MIRING.png',
    '/assets/SlidePertama1.webp',
    '/assets/Slidekedua.webp',
    '/assets/Slideketiga.webp',
    '/assets/Favicon.png',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css',
    'https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap'
];

// Install event
self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                return cache.addAll(urlsToCache);
            })
    );
});

// Fetch event
self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                // Return cached version or fetch from network
                if (response) {
                    return response;
                }
                return fetch(event.request);
            }
        )
    );
});

// Activate event
self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.map(function(cacheName) {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});