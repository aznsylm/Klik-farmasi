class KlikFarmasiBeranda {
    constructor() {
        console.log('PWA: Beranda Only Mode');
        this.init();
    }
    
    async init() {
        // Only register service worker on homepage
        if (window.location.pathname === '/') {
            if ('serviceWorker' in navigator) {
                try {
                    const registration = await navigator.serviceWorker.register('/sw.js');
                    console.log('PWA: Service Worker registered for homepage:', registration);
                } catch (error) {
                    console.error('PWA: Service Worker registration failed:', error);
                }
            }
        }
        
        this.setupOfflineDetection();
    }
    
    setupOfflineDetection() {
        window.addEventListener('online', () => console.log('PWA: Back online'));
        window.addEventListener('offline', () => {
            // Only show offline message on homepage
            if (window.location.pathname === '/') {
                this.showOfflineStatus();
            }
        });
    }
    
    showOfflineStatus() {
        const existingStatus = document.getElementById('offline-status');
        if (existingStatus) return;
        
        const status = document.createElement('div');
        status.id = 'offline-status';
        status.className = 'alert alert-info';
        status.innerHTML = 'Mode Offline - Halaman beranda tersedia tanpa internet';
        status.style.cssText = 'position:fixed;top:0;left:0;right:0;z-index:1001;margin:0;text-align:center;';
        document.body.appendChild(status);
    }
}

// Initialize only on homepage
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname === '/') {
        window.klikFarmasiBeranda = new KlikFarmasiBeranda();
    }
});