/**
 * Klik Farmasi - Pages JavaScript
 * Kumpulan fungsi JavaScript untuk halaman-halaman website
 */

document.addEventListener("DOMContentLoaded", function () {
    // Tombol Kembali ke Atas
    const backToTopButton = document.getElementById("backToTop");
    if (backToTopButton) {
        // Tampilkan tombol setelah scroll 300px
        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.add("show");
            } else {
                backToTopButton.classList.remove("show");
            }
        });
    
        // Scroll ke atas ketika tombol diklik
        backToTopButton.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }

    // ===== TANYA JAWAB PAGE =====
    // Search functionality
    const faqSearch = document.getElementById("faqSearch");
    if (faqSearch) {
        faqSearch.addEventListener("keyup", function () {
            const searchTerm = this.value.toLowerCase();
            const accordionItems = document.querySelectorAll(".accordion-item");

            accordionItems.forEach((item) => {
                const question = item
                    .querySelector(".accordion-button")
                    .textContent.toLowerCase();
                const answer = item
                    .querySelector(".accordion-body")
                    .textContent.toLowerCase();

                if (
                    question.includes(searchTerm) ||
                    answer.includes(searchTerm)
                ) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
    }

    // Smooth scroll for category links
    const categoryLinks = document.querySelectorAll(".nav-link, .quick-link");
    if (categoryLinks.length > 0) {
        categoryLinks.forEach((link) => {
            link.addEventListener("click", function (e) {
                const href = this.getAttribute("href");
                // Hanya preventDefault jika href diawali dengan #
                if (href && href.startsWith("#")) {
                    e.preventDefault();
                    const targetElement = document.querySelector(href);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: "smooth",
                        });
                        // Update active class for nav pills
                        if (this.classList.contains("nav-link")) {
                            document
                                .querySelectorAll(".nav-link")
                                .forEach((navLink) => {
                                    navLink.classList.remove("active");
                                });
                            this.classList.add("active");
                        }
                    }
                }
                // Jika bukan anchor (#), biarkan link berjalan normal
            });
        });
    }

    // ===== PENGINGAT PAGE =====
    // Pengingat Obat Functionality
    const diagnosa = document.getElementById("diagnosa");
    const tambahObat = document.getElementById("tambahObat");
    const obatContainer = document.getElementById("obatContainer");
    const formPengingat = document.getElementById("formPengingat");

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

        // Atur jumlah maksimal obat berdasarkan diagnosa
        if (diagnosa) {
            diagnosa.addEventListener("change", function () {
                totalObat = 0;
                obatItems = [];
                obatContainer.innerHTML = "";
                tambahObat.disabled = false;

                if (diagnosa.value === "Hipertensi-Non-Kehamilan") {
                    tambahObat.dataset.maxObat = 2;
                    tambahObat.dataset.minObat = 1; // Minimal 1 obat
                } else if (diagnosa.value === "Hipertensi-Kehamilan") {
                    tambahObat.dataset.maxObat = 5;
                    tambahObat.dataset.minObat = 2; // Minimal 2 obat
                }

                // Tampilkan pesan informasi
                const maxObat = parseInt(tambahObat.dataset.maxObat || 0);
                const minObat = parseInt(tambahObat.dataset.minObat || 0);

                if (maxObat > 0) {
                    const infoMsg = document.createElement("div");
                    infoMsg.className =
                        "alert alert-info d-flex align-items-center";
                    infoMsg.innerHTML = `
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <div>
                            Untuk diagnosa ini, Anda perlu menambahkan minimal ${minObat} dan maksimal ${maxObat} obat.
                        </div>
                    `;
                    obatContainer.appendChild(infoMsg);
                }
            });
        }

        // Tambah obat
        if (tambahObat) {
            tambahObat.addEventListener("click", function () {
                const maxObat = parseInt(tambahObat.dataset.maxObat || 0);

                if (totalObat < maxObat) {
                    totalObat++;

                    const obatDiv = document.createElement("div");
                    obatDiv.classList.add("obat-card");
                    obatDiv.dataset.obatId = totalObat;

                    obatDiv.innerHTML = `
                        <div class="obat-number">${totalObat}</div>
                        <button type="button" class="remove-obat" data-obat-id="${totalObat}">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="namaObat${totalObat}" class="form-label fw-bold">
                                    <i class="bi bi-capsule me-2"></i>Pilih Obat
                                </label>
                                <select class="form-select shadow-sm" id="namaObat${totalObat}" name="namaObat[]" required>
                                    <option value="">Pilih Obat</option>
                                    ${daftarObat
                                        .map(
                                            (obat) =>
                                                `<option value="${obat}">${obat}</option>`
                                        )
                                        .join("")}
                                </select>
                                <div class="invalid-feedback">Pilih obat</div>
                            </div>
                            <div class="col-md-6">
                                <label for="jumlahObat${totalObat}" class="form-label fw-bold">
                                    <i class="bi bi-123 me-2"></i>Jumlah Obat
                                </label>
                                <select class="form-select shadow-sm" id="jumlahObat${totalObat}" name="jumlahObat[]" required>
                                    <option value="30 tablet/bulan">30 tablet/bulan</option>
                                    <option value="60 tablet/bulan">60 tablet/bulan</option>
                                    <option value="90 tablet/bulan">90 tablet/bulan</option>
                                </select>
                                <div class="invalid-feedback">Pilih jumlah obat</div>
                            </div>
                            <div class="col-md-6">
                                <label for="waktuMinum${totalObat}" class="form-label fw-bold">
                                    <i class="bi bi-clock me-2"></i>Waktu Minum Obat
                                </label>
                                <select class="form-select shadow-sm" id="waktuMinum${totalObat}" name="waktuMinum[]" required>
                                    <option value="">Pilih Waktu</option>
                                    <option value="06:00">06.00</option>
                                    <option value="07:00">07.00</option>
                                    <option value="09:00">09.00</option>
                                    <option value="12:00">12.00</option>
                                    <option value="13:00">13.00</option>
                                    <option value="15:00">15.00</option>
                                    <option value="18:00">18.00</option>
                                    <option value="19:00">19.00</option>
                                    <option value="21:00">21.00</option>
                                </select>
                                <div class="invalid-feedback">Pilih waktu minum obat</div>
                            </div>
                            <!-- Pilihan Suplemen Opsional -->
                            <div class="col-12">
                                <label for="suplemen${totalObat}" class="form-label fw-bold">
                                    <i class="bi bi-capsule me-2"></i>Tambah Suplemen (Opsional)
                                </label>
                                <select class="form-select shadow-sm" id="suplemen${totalObat}" name="suplemen[]" >
                                    <option value="" hidden>Pilih Suplemen (jika ada)</option>
                                    <option value="Asam folat">Asam folat</option>
                                    <option value="Zat besi">Zat besi</option>
                                    <option value="Kalsium">Kalsium</option>
                                    <option value="Suplemen Multivitamin">Suplemen multivitamin dan mineral selama masa kehamilan</option>
                                </select>
                            </div>
                        </div>
                    `;

                    // Tambahkan ke container
                    obatContainer.appendChild(obatDiv);
                    obatItems.push(totalObat);

                    // Tambahkan event listener untuk tombol hapus
                    const removeButton = obatDiv.querySelector(".remove-obat");
                    removeButton.addEventListener("click", function () {
                        const obatId = this.dataset.obatId;
                        removeObat(obatId);
                    });
                }

                if (totalObat === maxObat) {
                    tambahObat.disabled = true;
                }
            });
        }

        // Fungsi untuk menghapus obat
        function removeObat(obatId) {
            const obatElement = document.querySelector(
                `.obat-card[data-obat-id="${obatId}"]`
            );
            if (obatElement) {
                obatElement.remove();

                // Update array obatItems
                const index = obatItems.indexOf(parseInt(obatId));
                if (index > -1) {
                    obatItems.splice(index, 1);
                }

                totalObat--;
                tambahObat.disabled = false;

                // Perbarui nomor urut obat yang tersisa
                updateObatNumbers();
            }
        }

        // Fungsi untuk memperbarui nomor urut obat
        function updateObatNumbers() {
            const obatCards = document.querySelectorAll(".obat-card");
            obatCards.forEach((card, index) => {
                const numberElement = card.querySelector(".obat-number");
                if (numberElement) {
                    numberElement.textContent = index + 1;
                }
            });
        }

        // Validasi sebelum submit
        if (formPengingat) {
            formPengingat.addEventListener("submit", function (e) {
                e.preventDefault();

                if (!formPengingat.checkValidity()) {
                    e.stopPropagation();
                    formPengingat.classList.add("was-validated");
                    return;
                }

                const minObat = parseInt(tambahObat.dataset.minObat || 0);

                if (totalObat < minObat) {
                    // Tampilkan pesan error
                    const errorMsg = document.createElement("div");
                    errorMsg.className =
                        "alert alert-danger alert-dismissible fade show mt-3";
                    errorMsg.innerHTML = `
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Silakan tambahkan minimal ${minObat} obat.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

                    // Cek apakah sudah ada pesan error
                    const existingError =
                        formPengingat.querySelector(".alert-danger");
                    if (existingError) {
                        existingError.remove();
                    }

                    formPengingat.prepend(errorMsg);

                    // Scroll ke atas form
                    formPengingat.scrollIntoView({ behavior: "smooth" });
                } else {
                    // Tampilkan loading state pada tombol submit
                    const submitBtn = formPengingat.querySelector(
                        'button[type="submit"]'
                    );
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...';
                        submitBtn.disabled = true;

                        // Simulasi submit (bisa dihapus pada implementasi sebenarnya)
                        setTimeout(() => {
                            formPengingat.submit();
                        }, 500);
                    } else {
                        formPengingat.submit();
                    }
                }
            });
        }

        // Popup untuk guest user
        const submitButton = document.getElementById("submitButton");
        const popupOverlay = document.getElementById("popupOverlay");
        const closePopup = document.getElementById("closePopup");

        if (submitButton && popupOverlay) {
            submitButton.addEventListener("click", function () {
                popupOverlay.style.display = "flex";
                document.body.style.overflow = "hidden"; // Prevent scrolling when popup is open
            });
        }

        if (closePopup && popupOverlay) {
            closePopup.addEventListener("click", function () {
                popupOverlay.style.display = "none";
                document.body.style.overflow = ""; // Restore scrolling
            });
        }

        // Form validation styling
        const inputs = document.querySelectorAll(".form-control, .form-select");
        inputs.forEach((input) => {
            input.addEventListener("blur", function () {
                if (this.checkValidity()) {
                    this.classList.add("is-valid");
                    this.classList.remove("is-invalid");
                } else if (this.value !== "") {
                    this.classList.add("is-invalid");
                    this.classList.remove("is-valid");
                }
            });
        });
    }
});
