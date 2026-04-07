const CACHE_VERSION = "klik-farmasi-home-v1";
const PRECACHE_URLS = [
    "/",
    "/manifest.webmanifest",
    "/assets/Favicon.png",
    "/assets/LOGO KLIKFARMASI VEKTOR MIRING.png",
    "/assets/Klik-Farmasi.webp",
    "/assets/hero1.webp",
    "/assets/hero2.webp",
    "/assets/hero3.webp",
    "/css/main.css",
    "/medicio/css/main.css",
    "/medicio/vendor/bootstrap/css/bootstrap.min.css",
    "/medicio/vendor/bootstrap-icons/bootstrap-icons.css",
    "/medicio/vendor/aos/aos.css",
    "/medicio/vendor/fontawesome-free/css/all.min.css",
    "/medicio/vendor/glightbox/css/glightbox.min.css",
    "/medicio/vendor/swiper/swiper-bundle.min.css",
    "/medicio/vendor/bootstrap/js/bootstrap.bundle.min.js",
    "/medicio/vendor/aos/aos.js",
    "/medicio/vendor/glightbox/js/glightbox.min.js",
    "/medicio/vendor/purecounter/purecounter_vanilla.js",
    "/medicio/vendor/swiper/swiper-bundle.min.js",
    "/medicio/js/main.js",
];

const STATIC_CACHE_PATHS = ["/assets/", "/css/", "/medicio/"];

self.addEventListener("install", (event) => {
    event.waitUntil(
        caches
            .open(CACHE_VERSION)
            .then((cache) => cache.addAll(PRECACHE_URLS))
            .then(() => self.skipWaiting()),
    );
});

self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches
            .keys()
            .then((cacheNames) =>
                Promise.all(
                    cacheNames
                        .filter((cacheName) => cacheName !== CACHE_VERSION)
                        .map((cacheName) => caches.delete(cacheName)),
                ),
            )
            .then(() => self.clients.claim()),
    );
});

self.addEventListener("fetch", (event) => {
    const requestUrl = new URL(event.request.url);

    if (event.request.method !== "GET") {
        return;
    }

    if (event.request.mode === "navigate") {
        if (requestUrl.pathname !== "/") {
            event.respondWith(fetch(event.request));
            return;
        }

        event.respondWith(
            fetch(event.request)
                .then((response) => {
                    const responseClone = response.clone();
                    caches
                        .open(CACHE_VERSION)
                        .then((cache) => cache.put("/", responseClone));
                    return response;
                })
                .catch(() => caches.match("/")),
        );
        return;
    }

    const shouldCacheStaticAsset =
        requestUrl.origin === self.location.origin &&
        STATIC_CACHE_PATHS.some((path) => requestUrl.pathname.startsWith(path));

    if (!shouldCacheStaticAsset) {
        return;
    }

    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            if (cachedResponse) {
                return cachedResponse;
            }

            return fetch(event.request).then((networkResponse) => {
                if (networkResponse && networkResponse.ok) {
                    const responseClone = networkResponse.clone();
                    caches
                        .open(CACHE_VERSION)
                        .then((cache) =>
                            cache.put(event.request, responseClone),
                        );
                }

                return networkResponse;
            });
        }),
    );
});
