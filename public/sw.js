// const CACHE_NAME = 'klik-farmasi-beranda-v1';
// const OFFLINE_URL = '/offline';

// // Only cache homepage and its assets
// const BERANDA_CACHE = [
//   '/',
//   '/css/main.css',
//   '/css/mobile-responsive.css',
//   '/js/main.js',
//   '/assets/welcome-hero.webp',
//   '/assets/prevalensi.webp',
//   '/assets/pencegahan.webp',
//   '/assets/Slideketiga.webp',
//   '/manifest.json',
//   '/icons/icon-192x192.png',
//   '/icons/icon-512x512.png'
// ];

// // External resources for homepage
// const EXTERNAL_RESOURCES = [
//   'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css',
//   'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css',
//   'https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap',
//   'https://unpkg.com/aos@2.3.1/dist/aos.css',
//   'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
//   'https://unpkg.com/aos@2.3.1/dist/aos.js'
// ];

// // Install - cache homepage resources only
// self.addEventListener('install', event => {
//   console.log('PWA: Installing - Homepage Only');
//   event.waitUntil(
//     Promise.all([
//       caches.open(CACHE_NAME).then(cache => cache.addAll(BERANDA_CACHE)),
//       caches.open(CACHE_NAME).then(cache => {
//         return Promise.all(
//           EXTERNAL_RESOURCES.map(url => {
//             return fetch(url, { mode: 'cors' })
//               .then(response => response.ok ? cache.put(url, response) : null)
//               .catch(() => null);
//           })
//         );
//       })
//     ]).then(() => self.skipWaiting())
//   );
// });

// // Activate - cleanup old caches
// self.addEventListener('activate', event => {
//   event.waitUntil(
//     caches.keys().then(cacheNames => {
//       return Promise.all(
//         cacheNames.map(cacheName => {
//           if (cacheName !== CACHE_NAME) {
//             return caches.delete(cacheName);
//           }
//         })
//       );
//     }).then(() => self.clients.claim())
//   );
// });

// // Fetch - minimal strategy
// self.addEventListener('fetch', event => {
//   if (event.request.method !== 'GET') return;

//   const requestUrl = new URL(event.request.url);
  
//   // FORCE ONLINE for non-homepage pages
//   if (requestUrl.pathname !== '/' && 
//       (requestUrl.pathname.includes('/login') ||
//        requestUrl.pathname.includes('/register') ||
//        requestUrl.pathname.includes('/dashboard') || 
//        requestUrl.pathname.includes('/admin') || 
//        requestUrl.pathname.includes('/user/') ||
//        requestUrl.pathname.includes('/api/') ||
//        requestUrl.pathname.includes('/artikel') ||
//        requestUrl.pathname.includes('/berita') ||
//        requestUrl.pathname.includes('/tanya-jawab') ||
//        requestUrl.pathname.includes('/unduhan') ||
//        requestUrl.pathname.includes('/pengingat'))) {
    
//     event.respondWith(fetch(event.request));
//     return;
//   }

//   // Handle homepage and its assets
//   event.respondWith(
//     caches.match(event.request)
//       .then(response => {
//         if (response) return response;
        
//         return fetch(event.request)
//           .then(fetchResponse => {
//             // Only cache homepage (/) and its assets
//             if (fetchResponse.ok && 
//                 (requestUrl.pathname === '/' || 
//                  requestUrl.pathname.includes('/css/') ||
//                  requestUrl.pathname.includes('/js/') ||
//                  requestUrl.pathname.includes('/assets/'))) {
              
//               const responseClone = fetchResponse.clone();
//               caches.open(CACHE_NAME)
//                 .then(cache => cache.put(event.request, responseClone));
//             }
//             return fetchResponse;
//           })
//           .catch(() => {
//             // Only serve offline page for homepage
//             if (requestUrl.pathname === '/') {
//               return caches.match(OFFLINE_URL) || 
//                      new Response('<h1>Offline</h1><p>Halaman beranda tidak tersedia offline.</p>', 
//                                  { headers: { 'Content-Type': 'text/html' } });
//             }
//             throw new Error('Network error');
//           });
//       })
//   );
// });