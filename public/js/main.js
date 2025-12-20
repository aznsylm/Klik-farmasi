/**
 * Klik Farmasi - Main JavaScript
 * File JavaScript utama yang menggabungkan semua fungsi untuk optimasi
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== LAZY LOADING SYSTEM =====
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy-image');
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            }
        });
    }, {
        rootMargin: '50px 0px',
        threshold: 0.01
    });

    document.querySelectorAll('.lazy-image').forEach(img => {
        imageObserver.observe(img);
    });

    // ===== CAROUSEL OPTIMIZATION =====
    const cleanCarousel = document.getElementById('cleanCarousel');
    if (cleanCarousel) {
        new bootstrap.Carousel(cleanCarousel, {
            interval: 6000,
            wrap: true,
            touch: true
        });

        cleanCarousel.addEventListener('mouseenter', function() {
            const carouselInstance = bootstrap.Carousel.getInstance(this);
            if (carouselInstance) carouselInstance.pause();
        });
        
        cleanCarousel.addEventListener('mouseleave', function() {
            const carouselInstance = bootstrap.Carousel.getInstance(this);
            if (carouselInstance) carouselInstance.cycle();
        });

        cleanCarousel.addEventListener('slide.bs.carousel', function() {
            const lazyImages = cleanCarousel.querySelectorAll('.lazy-image[data-src]');
            lazyImages.forEach(img => {
                if (!img.src || img.src === window.location.href) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy-image');
                    img.classList.add('loaded');
                }
            });
        });
    }

    // ===== BACK TO TOP BUTTON =====
    const backToTopButton = document.getElementById('backToTop');
    if (backToTopButton) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });
    
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        });
    }

    // ===== FAQ SEARCH =====
    const faqSearch = document.getElementById('faqSearch');
    if (faqSearch) {
        let searchTimeout;
        faqSearch.addEventListener('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = this.value.toLowerCase();
                const accordionItems = document.querySelectorAll('.accordion-item');

                accordionItems.forEach((item) => {
                    const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                    const answer = item.querySelector('.accordion-body').textContent.toLowerCase();

                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }, 300);
        });
    }

    // ===== SMOOTH SCROLL =====
    const categoryLinks = document.querySelectorAll('.nav-link, .quick-link');
    categoryLinks.forEach((link) => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                const targetElement = document.querySelector(href);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth',
                    });
                    if (this.classList.contains('nav-link')) {
                        document.querySelectorAll('.nav-link').forEach((navLink) => {
                            navLink.classList.remove('active');
                        });
                        this.classList.add('active');
                    }
                }
            }
        });
    });

    // ===== PENGINGAT OBAT FUNCTIONALITY =====
    const diagnosa = document.getElementById('diagnosa');
    const tambahObat = document.getElementById('tambahObat');
    const obatContainer = document.getElementById('obatContainer');
    const formPengingat = document.getElementById('formPengingat');

    if (diagnosa && tambahObat && obatContainer) {
        let totalObat = 0;
        let obatItems = [];

        const daftarObat = [
            "Verapamil tab 80 mg",
            "Verapamil tab lepas lambat 240 mg",
            "Valsartan tab 80 mg",
            "Valsartan tab 160 mg",
            "Telmisartan tab 40 mg",
            "Telmisartan tab 80 mg",
            "Ramipril tab 2,5 mg",
            "Ramipril tab 5 mg",
            "Amlodipin tab 5 mg",
            "Amlodipin tab 10 mg",
            "Atenolol tab 50 mg",
            "Atenolol tab 100 mg",
            "Bisoprolol tab 2,5 mg",
            "Bisoprolol tab 5 mg",
            "Bisoprolol tab 10 mg",
            "Diltiazem kapsul lepas lambat 100 mg",
            "Diltiazem kapsul lepas lambat 200 mg",
            "Hidroklorotiazid tab 25 mg",
            "Imidapril tab 5 mg",
            "Imidapril tab 10 mg",
            "Irbesartan tab 150 mg",
            "Irbesartan tab 300 mg",
            "Kandesartan tab 8 mg",
            "Kandesartan tab 16 mg",
            "Kaptopril tab 12,5 mg",
            "Kaptopril tab 25 mg",
            "Kaptopril tab 50 mg",
            "Klonidin tab 0,15 mg",
            "Lisinopril tab 5 mg",
            "Lisinopril tab 10 mg",
            "Metildopa tab 250 mg",
            "Nifedipin tab 10 mg",
            "Furosemid tab 20 mg",
            "Furosemid tab 40 mg",
        ];

        diagnosa.addEventListener('change', function() {
            totalObat = 0;
            obatItems = [];
            obatContainer.innerHTML = '';
            tambahObat.disabled = false;

            // Semua kategori: minimal 1, maksimal 5
            tambahObat.dataset.maxObat = 5;
            tambahObat.dataset.minObat = 1;
            tambahObat.dataset.isKehamilan = diagnosa.value === 'Kehamilan';

            const maxObat = parseInt(tambahObat.dataset.maxObat || 0);
            const minObat = parseInt(tambahObat.dataset.minObat || 0);
            const isKehamilan = tambahObat.dataset.isKehamilan === 'true';

            if (maxObat > 0) {
                const infoMsg = document.createElement('div');
                infoMsg.className = 'alert alert-info d-flex align-items-center p-4 mb-4';
                infoMsg.style.fontSize = '1.1rem';
                const itemType = isKehamilan ? 'suplemen' : 'obat';
                infoMsg.innerHTML = `
                    <i class="bi bi-info-circle-fill me-3" style="font-size: 1.5rem;"></i>
                    <div><strong>Informasi:</strong> Untuk kondisi ini, Anda perlu menambahkan minimal ${minObat} ${itemType} dan maksimal ${maxObat} ${itemType}.</div>
                `;
                obatContainer.appendChild(infoMsg);
                
                if (totalObat === 0) {
                    tambahObat.innerHTML = isKehamilan ? 'TAMBAH SUPLEMEN PERTAMA' : 'TAMBAH OBAT PERTAMA';
                } else {
                    tambahObat.innerHTML = isKehamilan ? `TAMBAH SUPLEMEN KE-${totalObat + 1}` : `TAMBAH OBAT KE-${totalObat + 1}`;
                }
            }
        });

        tambahObat.addEventListener('click', function() {
            // Validasi: pastikan diagnosa sudah dipilih
            if (!diagnosa.value) {
                showValidationPopup('Silakan pilih jenis hipertensi terlebih dahulu sebelum menambah obat.');
                return;
            }

            const maxObat = parseInt(tambahObat.dataset.maxObat || 0);
            const isKehamilan = tambahObat.dataset.isKehamilan === 'true';

            if (totalObat < maxObat) {
                totalObat++;
                const obatDiv = document.createElement('div');
                obatDiv.className = 'obat-card card border-2 shadow-lg mb-4';
                obatDiv.dataset.obatId = totalObat;
                obatDiv.style.borderColor = '#0B5E91';
                
                const itemType = isKehamilan ? 'SUPLEMEN' : 'OBAT';
                const namaObatSection = isKehamilan ? '' : `
                    <div class="col-12">
                        <label for="namaObat${totalObat}" class="form-label">
                            Nama Obat:
                        </label>
                        <select class="form-select" id="namaObat${totalObat}" name="namaObat[]" required>
                            <option value="">-- Pilih nama obat --</option>
                            ${daftarObat.map(obat => `<option value="${obat}">${obat}</option>`).join('')}
                        </select>
                    </div>`;
                
                const suplemenSection = isKehamilan ? `
                    <div class="col-12">
                        <label for="suplemen${totalObat}" class="form-label">
                            Jenis Suplemen:
                        </label>
                        <select class="form-select" id="suplemen${totalObat}" name="suplemen[]" required>
                            <option value="">-- Pilih suplemen --</option>
                            <option value="Asam folat">Asam Folat</option>
                            <option value="Zat besi">Zat Besi</option>
                            <option value="Kalsium">Kalsium</option>
                            <option value="Suplemen Multivitamin">Multivitamin untuk Ibu Hamil</option>
                        </select>
                    </div>` : `
                    <div class="col-12">
                        <label for="suplemen${totalObat}" class="form-label">
                            Suplemen Tambahan (Opsional):
                        </label>
                        <select class="form-select" id="suplemen${totalObat}" name="suplemen[]">
                            <option value="">-- Pilih suplemen jika ada --</option>
                            <option value="Asam folat">Asam Folat</option>
                            <option value="Zat besi">Zat Besi</option>
                            <option value="Kalsium">Kalsium</option>
                            <option value="Suplemen Multivitamin">Multivitamin untuk Ibu Hamil</option>
                        </select>
                    </div>`;
                
                obatDiv.innerHTML = `
                    <div class="card-header text-white d-flex justify-content-between align-items-center py-3" style="background-color: #0B5E91;">
                        <h5 class="mb-0 fw-bold text-white">
                            ${itemType} KE-<span class="obat-number">${totalObat}</span>
                        </h5>
                        <button type="button" class="btn btn-outline-light remove-obat" data-obat-id="${totalObat}">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            ${namaObatSection}
                            <div class="col-md-6">
                                <label for="jumlahObat${totalObat}" class="form-label">
                                    Jumlah ${isKehamilan ? 'Suplemen' : 'Obat'}:
                                </label>
                                <select class="form-select" id="jumlahObat${totalObat}" name="jumlahObat[]" required>
                                    <option value="30 tablet/bulan">30 tablet (1 bulan)</option>
                                    <option value="60 tablet/bulan">60 tablet (2 bulan)</option>
                                    <option value="90 tablet/bulan">90 tablet (3 bulan)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="waktuMinum${totalObat}" class="form-label">
                                    Jam Minum ${isKehamilan ? 'Suplemen' : 'Obat'}:
                                </label>
                                <select class="form-select" id="waktuMinum${totalObat}" name="waktuMinum[]" required>
                                    <option value="">-- Pilih jam --</option>
                                    <option value="06:00">06.00 (Pagi)</option>
                                    <option value="07:00">07.00 (Pagi)</option>
                                    <option value="09:00">09.00 (Pagi)</option>
                                    <option value="12:00">12.00 (Siang)</option>
                                    <option value="13:00">13.00 (Siang)</option>
                                    <option value="15:00">15.00 (Sore)</option>
                                    <option value="18:00">18.00 (Sore)</option>
                                    <option value="19:00">19.00 (Malam)</option>
                                    <option value="21:00">21.00 (Malam)</option>
                                </select>
                            </div>
                            ${suplemenSection}
                        </div>
                    </div>
                `;

                obatContainer.appendChild(obatDiv);
                obatItems.push(totalObat);

                const removeButton = obatDiv.querySelector('.remove-obat');
                removeButton.addEventListener('click', function() {
                    const obatId = this.dataset.obatId;
                    removeObat(obatId);
                });
            }

            if (totalObat < maxObat) {
                const itemType = isKehamilan ? 'Suplemen' : 'Obat';
                tambahObat.innerHTML = `<i class="bi bi-plus-circle me-2"></i>Tambah ${itemType} Ke-${totalObat + 1}`;
            }
            
            if (totalObat === maxObat) {
                tambahObat.disabled = true;
                const itemType = isKehamilan ? 'Suplemen' : 'Obat';
                tambahObat.innerHTML = `<i class="bi bi-check-circle me-2"></i>Semua ${itemType} Ditambahkan`;
            }
        });

        function removeObat(obatId) {
            const obatElement = document.querySelector(`.obat-card[data-obat-id="${obatId}"]`);
            if (obatElement) {
                obatElement.remove();
                const index = obatItems.indexOf(parseInt(obatId));
                if (index > -1) {
                    obatItems.splice(index, 1);
                }
                totalObat--;
                tambahObat.disabled = false;
                updateObatNumbers();
            }
        }

        function updateObatNumbers() {
            const obatCards = document.querySelectorAll('.obat-card');
            obatCards.forEach((card, index) => {
                const numberElement = card.querySelector('.obat-number');
                if (numberElement) {
                    numberElement.textContent = index + 1;
                }
            });
            
            const maxObat = parseInt(tambahObat.dataset.maxObat || 0);
            const isKehamilan = tambahObat.dataset.isKehamilan === 'true';
            if (totalObat < maxObat) {
                const itemType = isKehamilan ? 'Suplemen' : 'Obat';
                tambahObat.innerHTML = `<i class="bi bi-plus-circle me-2"></i>Tambah ${itemType} Ke-${totalObat + 1}`;
            }
        }

        if (formPengingat) {
            formPengingat.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!formPengingat.checkValidity()) {
                    e.stopPropagation();
                    formPengingat.classList.add('was-validated');
                    return;
                }

                const minObat = parseInt(tambahObat.dataset.minObat || 0);

                if (totalObat < minObat) {
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'alert alert-danger alert-dismissible fade show mt-3';
                    errorMsg.innerHTML = `
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Silakan tambahkan minimal ${minObat} obat/suplemen.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

                    const existingError = formPengingat.querySelector('.alert-danger');
                    if (existingError) {
                        existingError.remove();
                    }

                    formPengingat.prepend(errorMsg);
                    formPengingat.scrollIntoView({ behavior: 'smooth' });
                } else {
                    const submitBtn = formPengingat.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memproses...';
                        submitBtn.disabled = true;

                        setTimeout(() => {
                            formPengingat.submit();
                        }, 500);
                    } else {
                        formPengingat.submit();
                    }
                }
            });
        }

        // Guest popup
        const submitButton = document.getElementById('submitButton');
        const popupOverlay = document.getElementById('popupOverlay');
        const closePopup = document.getElementById('closePopup');

        if (submitButton && popupOverlay) {
            submitButton.addEventListener('click', function() {
                popupOverlay.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        }

        if (closePopup && popupOverlay) {
            closePopup.addEventListener('click', function() {
                popupOverlay.style.display = 'none';
                document.body.style.overflow = '';
            });
        }
    }

    // ===== PERFORMANCE OPTIMIZATIONS =====
    
    // Font loading optimization
    if (sessionStorage.fontsLoaded) {
        document.documentElement.classList.add('fonts-loaded');
    } else if ('fonts' in document) {
        Promise.all([
            document.fonts.load('1rem "El Messiri"'),
            document.fonts.load('1rem "Open Sans"')
        ]).then(function() {
            document.documentElement.classList.add('fonts-loaded');
            sessionStorage.fontsLoaded = true;
        });
    }

    // Preload critical resources after page load
    window.addEventListener('load', function() {
        if ('requestIdleCallback' in window) {
            requestIdleCallback(function() {
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

    // Optimize images for better performance
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(function(img) {
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.3s ease-in-out';
        
        img.onload = function() {
            img.style.opacity = '1';
        };
    });

    // AOS initialization with performance optimization
    if (window.requestIdleCallback) {
        window.requestIdleCallback(function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true,
                    offset: 100,
                    disable: 'mobile'
                });
            }
        });
    }
});