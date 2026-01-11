// class KlikFarmasiPWA {
//     constructor() {
//         console.log('PWA: Production Ready - Enhanced Caching');
//         this.init();
//     }
    
//     async init() {
//         // Register service worker
//         if ('serviceWorker' in navigator) {
//             try {
//                 const registration = await navigator.serviceWorker.register('/sw.js');
//                 console.log('PWA: Service Worker registered (Production Ready):', registration);
                
//                 // Handle updates
//                 registration.addEventListener('updatefound', () => {
//                     console.log('PWA: New version available');
//                 });
//             } catch (error) {
//                 console.error('PWA: Service Worker registration failed:', error);
//             }
//         }
        
//         // Setup offline detection
//         this.setupOfflineDetection();
        
//         // Setup auth page protection
//         this.setupAuthProtection();
        
//         // Monitor cache status
//         this.monitorCacheStatus();
//     }
    
//     async monitorCacheStatus() {
//         if ('caches' in window) {
//             try {
//                 const cacheNames = await caches.keys();
//                 console.log('PWA: Available caches:', cacheNames);
//             } catch (error) {
//                 console.error('PWA: Cache monitoring failed:', error);
//             }
//         }
//     }
    
//     setupAuthProtection() {
//         // Warn users when trying to access auth pages offline
//         if (!navigator.onLine) {
//             const currentPath = window.location.pathname;
//             if (currentPath.includes('/login') ||
//                 currentPath.includes('/register') ||
//                 currentPath.includes('/dashboard') ||
//                 currentPath.includes('/admin') ||
//                 currentPath.includes('/superadmin') ||
//                 currentPath.includes('/user/')) {
                
//                 this.showAuthOfflineWarning();
//             }
//         }
//     }
    
//     showAuthOfflineWarning() {
//         const warning = document.createElement('div');
//         warning.className = 'alert alert-danger';
//         warning.innerHTML = `
//             <strong>Koneksi Internet Diperlukan</strong><br>
//             Halaman ini memerlukan koneksi internet untuk keamanan data Anda.
//         `;
        
//         warning.style.cssText = `
//             position: fixed;
//             top: 20px;
//             left: 20px;
//             right: 20px;
//             z-index: 1002;
//             text-align: center;
//         `;
        
//         document.body.appendChild(warning);
//     }
    
//     setupOfflineDetection() {
//         // Show offline status and prevent auth access
//         this.updateOnlineStatus();
//         window.addEventListener('online', () => this.updateOnlineStatus());
//         window.addEventListener('offline', () => this.updateOnlineStatus());
        
//         // Prevent form submissions when offline (except public forms)
//         document.addEventListener('submit', (e) => {
//             if (!navigator.onLine) {
//                 const currentPath = window.location.pathname;
//                 // Allow public forms (like contact, pengingat) when offline
//                 if (!currentPath.includes('/login') && 
//                     !currentPath.includes('/register') &&
//                     !currentPath.includes('/dashboard') &&
//                     !currentPath.includes('/admin') &&
//                     !currentPath.includes('/superadmin') &&
//                     !currentPath.includes('/user/')) {
//                     return; // Allow public forms
//                 }
                
//                 e.preventDefault();
//                 this.showOfflineWarning();
//             }
//         });
//     }
    
//     updateOnlineStatus() {
//         const isOnline = navigator.onLine;
//         console.log('PWA: Online status:', isOnline);
        
//         if (!isOnline) {
//             this.showOfflineStatus();
//             this.setupAuthProtection(); // Check if on auth page
//         } else {
//             this.hideOfflineStatus();
//         }
//     }
    
//     showOfflineStatus() {
//         // Remove existing status
//         const existingStatus = document.getElementById('offline-status');
//         if (existingStatus) return;
        
//         // Create offline status bar
//         const status = document.createElement('div');
//         status.id = 'offline-status';
//         status.className = 'alert alert-info';
//         status.innerHTML = `
//             <strong>Mode Offline</strong> - Halaman publik tersedia dengan styling lengkap. Login/Dashboard memerlukan koneksi.
//         `;
        
//         status.style.cssText = `
//             position: fixed;
//             top: 0;
//             left: 0;
//             right: 0;
//             z-index: 1001;
//             margin: 0;
//             border-radius: 0;
//             text-align: center;
//         `;
        
//         document.body.appendChild(status);
//     }
    
//     hideOfflineStatus() {
//         const existingStatus = document.getElementById('offline-status');
//         if (existingStatus) {
//             existingStatus.remove();
//         }
//     }
    
//     showOfflineWarning() {
//         const alert = document.createElement('div');
//         alert.className = 'alert alert-warning alert-dismissible';
//         alert.innerHTML = `
//             <strong>Koneksi Internet Diperlukan</strong><br>
//             Fitur login dan dashboard memerlukan koneksi internet untuk keamanan data Anda.
//             <button type="button" class="close" onclick="this.parentElement.remove()">
//                 <span>&times;</span>
//             </button>
//         `;
        
//         alert.style.cssText = `
//             position: fixed;
//             top: 20px;
//             right: 20px;
//             z-index: 1002;
//             max-width: 350px;
//         `;
        
//         document.body.appendChild(alert);
        
//         // Auto hide after 5 seconds
//         setTimeout(() => {
//             if (alert.parentElement) {
//                 alert.remove();
//             }
//         }, 5000);
//     }
// }

// // Initialize PWA when DOM is loaded
// document.addEventListener('DOMContentLoaded', () => {
//     window.klikFarmasiPWA = new KlikFarmasiPWA();
// });

// // Export for use in other scripts
// if (typeof module !== 'undefined' && module.exports) {
//     module.exports = KlikFarmasiPWA;
// }