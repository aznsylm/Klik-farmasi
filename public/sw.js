// const CACHE_NAME = 'klik-farmasi-public-v2';
// const OFFLINE_URL = '/offline';

// // Public pages cache
// const PUBLIC_CACHE_URLS = [
//   // Public pages only
//   '/',
//   '/artikel/hipertensi-kehamilan',
//   '/artikel/hipertensi-non-kehamilan', 
//   '/berita',
//   '/tanya-jawab/hipertensi-kehamilan',
//   '/tanya-jawab/hipertensi-non-kehamilan',
//   '/unduhan',
//   '/petunjuk',
//   '/tim-pengelola',
//   '/offline',
  
//   // Local assets
//   '/css/main.css',
//   '/js/pwa.js',
//   '/js/main.js',
  
//   // PWA assets
//   '/manifest.json',
//   '/icons/icon-192x192.png',
//   '/icons/icon-512x512.png'
// ];

// // External CSS/JS that need to be cached
// const EXTERNAL_RESOURCES = [
//   'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css',
//   'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css',
//   'https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap',
//   'https://unpkg.com/aos@2.3.1/dist/aos.css',
//   'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
//   'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
//   'https://unpkg.com/aos@2.3.1/dist/aos.js'
// ];

// // Install event - cache local and external resources
// self.addEventListener('install', event => {
//   console.log('PWA: Installing - Production Ready');
//   event.waitUntil(
//     Promise.all([
//       // Cache local resources
//       caches.open(CACHE_NAME).then(cache => {
//         console.log('PWA: Caching local resources');
//         return cache.addAll(PUBLIC_CACHE_URLS);
//       }),
//       // Cache external resources
//       caches.open(CACHE_NAME).then(cache => {
//         console.log('PWA: Caching external resources');
//         return Promise.all(
//           EXTERNAL_RESOURCES.map(url => {
//             return fetch(url, { mode: 'cors' })
//               .then(response => {
//                 if (response.ok) {
//                   return cache.put(url, response);
//                 }
//               })
//               .catch(error => {
//                 console.warn('PWA: Failed to cache external resource:', url, error);
//               });
//           })
//         );
//       })
//     ]).then(() => self.skipWaiting())
//   );
// });

// // Activate event - clean up old caches
// self.addEventListener('activate', event => {
//   console.log('PWA: Activating...');
//   event.waitUntil(
//     caches.keys().then(cacheNames => {
//       return Promise.all(
//         cacheNames.map(cacheName => {
//           if (cacheName !== CACHE_NAME) {
//             console.log('PWA: Deleting old cache:', cacheName);
//             return caches.delete(cacheName);
//           }
//         })
//       );
//     }).then(() => self.clients.claim())
//   );
// });

// // Fetch event - Enhanced caching strategy
// self.addEventListener('fetch', event => {
//   // Skip non-GET requests
//   if (event.request.method !== 'GET') return;

//   const requestUrl = new URL(event.request.url);
  
//   // FORCE ONLINE for authentication pages
//   if (requestUrl.pathname.includes('/login') ||
//       requestUrl.pathname.includes('/register') ||
//       requestUrl.pathname.includes('/dashboard') || 
//       requestUrl.pathname.includes('/admin') || 
//       requestUrl.pathname.includes('/superadmin') || 
//       requestUrl.pathname.includes('/user/') ||
//       requestUrl.pathname.includes('/api/')) {
    
//     console.log('PWA: Auth page - MUST BE ONLINE:', event.request.url);
//     event.respondWith(
//       fetch(event.request).catch(() => {
//         return new Response(
//           '<h1>Koneksi Internet Diperlukan</h1><p>Halaman ini memerlukan koneksi internet untuk keamanan data.</p>',
//           { headers: { 'Content-Type': 'text/html' } }
//         );
//       })
//     );
//     return;
//   }

//   // Handle external resources (CSS, JS, Fonts)
//   if (!requestUrl.origin.includes(self.location.hostname)) {
//     event.respondWith(
//       caches.match(event.request)
//         .then(response => {
//           if (response) {
//             console.log('PWA: Serving external resource from cache:', event.request.url);
//             return response;
//           }
          
//           // Try to fetch and cache external resource
//           return fetch(event.request, { mode: 'cors' })
//             .then(fetchResponse => {
//               if (fetchResponse.ok) {
//                 const responseClone = fetchResponse.clone();
//                 caches.open(CACHE_NAME)
//                   .then(cache => cache.put(event.request, responseClone));
//               }
//               return fetchResponse;
//             })
//             .catch(() => {
//               // Return cached version if network fails
//               return caches.match(event.request);
//             });
//         })
//     );
//     return;
//   }

//   // Handle local resources and pages
//   event.respondWith(
//     caches.match(event.request)
//       .then(response => {
//         if (response) {
//           console.log('PWA: Serving from cache:', event.request.url);
//           return response;
//         }
        
//         return fetch(event.request)
//           .then(fetchResponse => {
//             if (fetchResponse.status === 200) {
//               const responseClone = fetchResponse.clone();
              
//               // Cache public pages and assets
//               if (event.request.mode === 'navigate' || 
//                   requestUrl.pathname.includes('/css/') ||
//                   requestUrl.pathname.includes('/js/') ||
//                   requestUrl.pathname.includes('/icons/') ||
//                   requestUrl.pathname.includes('/assets/')) {
                
//                 caches.open(CACHE_NAME)
//                   .then(cache => cache.put(event.request, responseClone));
//               }
//             }
//             return fetchResponse;
//           })
//           .catch(() => {
//             // Return offline page for navigation requests
//             if (event.request.mode === 'navigate') {
//               console.log('PWA: Serving offline page');
//               return caches.match(OFFLINE_URL);
//             }
            
//             return caches.match(event.request);
//           });
//       })
//   );
// });

// // Message event - handle messages from main thread
// self.addEventListener('message', event => {
//   if (event.data && event.data.type === 'SKIP_WAITING') {
//     self.skipWaiting();
//   }
// });

// // Handle offline/online status
// self.addEventListener('online', () => {
//   console.log('Service Worker: Back online');
// });

// self.addEventListener('offline', () => {
//   console.log('Service Worker: Gone offline');
// });