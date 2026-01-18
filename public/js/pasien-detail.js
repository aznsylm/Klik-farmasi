/*
==================================================
PATIENT DETAIL PAGE SCRIPTS
==================================================
File: pasien-detail.js
Purpose: External JavaScript untuk halaman detail pasien admin
Author: Klik Farmasi Development Team
==================================================
*/

// ========================================
// GLOBAL VARIABLES
// ========================================

let currentEditId = null;
let currentPage = 1;
let existingDates = [];
let originalEditDate = null;

// Indonesian validation messages
const validationMessages = {
    sistol: {
        required: "Sistol harus diisi",
        min: "Sistol minimal 70 mmHg",
        max: "Sistol maksimal 250 mmHg",
        invalid: "Sistol harus berupa angka",
    },
    diastol: {
        required: "Diastol harus diisi",
        min: "Diastol minimal 40 mmHg",
        max: "Diastol maksimal 150 mmHg",
        invalid: "Diastol harus berupa angka",
    },
};

// ========================================
// UTILITY FUNCTIONS
// ========================================

/**
 * Load existing dates for validation
 */
function loadExistingDates() {
    fetch(`/admin/pasien/${window.currentUserId}/tekanan-darah/dates`)
        .then((response) => response.json())
        .then((data) => {
            existingDates = data.dates || [];
        })
        .catch((error) => console.error("Error loading dates:", error));
}

/**
 * Get blood pressure category
 */
function getBloodPressureCategory(sistol, diastol) {
    if (sistol < 120 && diastol < 80) {
        return {
            text: "NORMAL",
            color: "text-success",
        };
    } else if (sistol >= 120 && sistol <= 129 && diastol < 80) {
        return {
            text: "PRE HIPERTENSI",
            color: "text-info",
        };
    } else if (
        (sistol >= 130 && sistol <= 139) ||
        (diastol >= 80 && diastol <= 89)
    ) {
        return {
            text: "HIPERTENSI STAGE 1",
            color: "text-warning",
        };
    } else {
        return {
            text: "HIPERTENSI STAGE 2",
            color: "text-danger",
        };
    }
}

/**
 * Format date to Indonesian locale
 */
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
}

/**
 * Generate pagination HTML
 */
function generatePagination(data) {
    if (data.last_page <= 1) return "";

    let html = '<nav><ul class="pagination pagination-sm">';

    // Previous button
    if (data.current_page > 1) {
        html += `<li class="page-item"><a class="page-link" href="#" onclick="loadModalData(${data.current_page - 1})">‹</a></li>`;
    }

    // Page numbers
    const start = Math.max(1, data.current_page - 2);
    const end = Math.min(data.last_page, data.current_page + 2);

    for (let i = start; i <= end; i++) {
        const active = i === data.current_page ? "active" : "";
        html += `<li class="page-item ${active}"><a class="page-link" href="#" onclick="loadModalData(${i})">${i}</a></li>`;
    }

    // Next button
    if (data.current_page < data.last_page) {
        html += `<li class="page-item"><a class="page-link" href="#" onclick="loadModalData(${data.current_page + 1})">›</a></li>`;
    }

    html += "</ul></nav>";
    return html;
}

// ========================================
// VALIDATION FUNCTIONS
// ========================================

/**
 * Validate tekanan darah for add modal
 */
function validateTekananDarah(sistol, diastol, tanggal) {
    let isValid = true;

    // Reset previous errors
    document.getElementById("tambahSistol").classList.remove("is-invalid");
    document.getElementById("tambahDiastol").classList.remove("is-invalid");
    document.getElementById("tambahTanggal").classList.remove("is-invalid");
    document.getElementById("tambahSistolError").textContent = "";
    document.getElementById("tambahDiastolError").textContent = "";
    document.getElementById("tambahTanggalError").textContent = "";

    // Validate tanggal for duplicates
    if (tanggal && existingDates.includes(tanggal)) {
        document.getElementById("tambahTanggal").classList.add("is-invalid");
        document.getElementById("tambahTanggalError").textContent =
            "Tanggal ini sudah ada data tekanan darah";
        isValid = false;
    }

    // Validate sistol
    if (!sistol) {
        document.getElementById("tambahSistol").classList.add("is-invalid");
        document.getElementById("tambahSistolError").textContent =
            validationMessages.sistol.required;
        isValid = false;
    } else if (isNaN(sistol)) {
        document.getElementById("tambahSistol").classList.add("is-invalid");
        document.getElementById("tambahSistolError").textContent =
            validationMessages.sistol.invalid;
        isValid = false;
    } else if (sistol < 70) {
        document.getElementById("tambahSistol").classList.add("is-invalid");
        document.getElementById("tambahSistolError").textContent =
            validationMessages.sistol.min;
        isValid = false;
    } else if (sistol > 250) {
        document.getElementById("tambahSistol").classList.add("is-invalid");
        document.getElementById("tambahSistolError").textContent =
            validationMessages.sistol.max;
        isValid = false;
    }

    // Validate diastol
    if (!diastol) {
        document.getElementById("tambahDiastol").classList.add("is-invalid");
        document.getElementById("tambahDiastolError").textContent =
            validationMessages.diastol.required;
        isValid = false;
    } else if (isNaN(diastol)) {
        document.getElementById("tambahDiastol").classList.add("is-invalid");
        document.getElementById("tambahDiastolError").textContent =
            validationMessages.diastol.invalid;
        isValid = false;
    } else if (diastol < 40) {
        document.getElementById("tambahDiastol").classList.add("is-invalid");
        document.getElementById("tambahDiastolError").textContent =
            validationMessages.diastol.min;
        isValid = false;
    } else if (diastol > 150) {
        document.getElementById("tambahDiastol").classList.add("is-invalid");
        document.getElementById("tambahDiastolError").textContent =
            validationMessages.diastol.max;
        isValid = false;
    }

    return isValid;
}

/**
 * Validate tekanan darah for edit modal
 */
function validateEditTekananDarah(sistol, diastol, tanggal) {
    let isValid = true;

    // Reset previous errors
    document.getElementById("editSistol").classList.remove("is-invalid");
    document.getElementById("editDiastol").classList.remove("is-invalid");
    document.getElementById("editTanggal").classList.remove("is-invalid");
    document.getElementById("editSistolError").textContent = "";
    document.getElementById("editDiastolError").textContent = "";
    document.getElementById("editTanggalError").textContent = "";

    // Validate tanggal for duplicates (exclude original date)
    if (
        tanggal &&
        tanggal !== originalEditDate &&
        existingDates.includes(tanggal)
    ) {
        document.getElementById("editTanggal").classList.add("is-invalid");
        document.getElementById("editTanggalError").textContent =
            "Tanggal ini sudah ada data tekanan darah";
        isValid = false;
    }

    // Validate sistol
    if (!sistol) {
        document.getElementById("editSistol").classList.add("is-invalid");
        document.getElementById("editSistolError").textContent =
            validationMessages.sistol.required;
        isValid = false;
    } else if (isNaN(sistol)) {
        document.getElementById("editSistol").classList.add("is-invalid");
        document.getElementById("editSistolError").textContent =
            validationMessages.sistol.invalid;
        isValid = false;
    } else if (sistol < 70) {
        document.getElementById("editSistol").classList.add("is-invalid");
        document.getElementById("editSistolError").textContent =
            validationMessages.sistol.min;
        isValid = false;
    } else if (sistol > 250) {
        document.getElementById("editSistol").classList.add("is-invalid");
        document.getElementById("editSistolError").textContent =
            validationMessages.sistol.max;
        isValid = false;
    }

    // Validate diastol
    if (!diastol) {
        document.getElementById("editDiastol").classList.add("is-invalid");
        document.getElementById("editDiastolError").textContent =
            validationMessages.diastol.required;
        isValid = false;
    } else if (isNaN(diastol)) {
        document.getElementById("editDiastol").classList.add("is-invalid");
        document.getElementById("editDiastolError").textContent =
            validationMessages.diastol.invalid;
        isValid = false;
    } else if (diastol < 40) {
        document.getElementById("editDiastol").classList.add("is-invalid");
        document.getElementById("editDiastolError").textContent =
            validationMessages.diastol.min;
        isValid = false;
    } else if (diastol > 150) {
        document.getElementById("editDiastol").classList.add("is-invalid");
        document.getElementById("editDiastolError").textContent =
            validationMessages.diastol.max;
        isValid = false;
    }

    return isValid;
}

// ========================================
// MODAL FUNCTIONS
// ========================================

/**
 * Show data modal with pagination
 */
function showDataModal() {
    loadModalData(1);
    $("#dataModal").modal("show");
}

/**
 * Load modal data with pagination
 */
function loadModalData(page = 1) {
    currentPage = page;

    // Use the correct API endpoint
    fetch(
        `/admin/pasien/${window.currentUserId}/tekanan-darah/records?page=${page}`,
    )
        .then((response) => response.json())
        .then((records) => {
            const tbody = document.getElementById("dataModalTableBody");
            const pagination = document.getElementById("modalPagination");

            // Clear existing data
            tbody.innerHTML = "";

            if (records && records.data && records.data.length > 0) {
                records.data.forEach((record, index) => {
                    const startIndex =
                        (records.current_page - 1) * records.per_page;
                    const category = getBloodPressureCategory(
                        record.sistol,
                        record.diastol,
                    );

                    tbody.innerHTML += `
                        <tr>
                            <td>${startIndex + index + 1}</td>
                            <td>${formatDate(record.created_at)}</td>
                            <td>${record.sistol}</td>
                            <td>${record.diastol}</td>
                            <td><span class="${category.color}">${category.text}</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm mr-1" onclick="editTekananDarah(${record.id}, '${record.created_at.split("T")[0]}', ${record.sistol}, ${record.diastol})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteTekananDarah(${record.id})" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });

                // Generate pagination
                pagination.innerHTML = generatePagination(records);
            } else {
                tbody.innerHTML =
                    '<tr><td colspan="6" class="text-center py-4"><i class="fas fa-chart-line fa-3x text-muted mb-3"></i><p class="text-muted">Belum ada data tekanan darah</p></td></tr>';
                pagination.innerHTML = "";
            }
        })
        .catch((error) => {
            console.error("Error loading records:", error);
            document.getElementById("dataModalTableBody").innerHTML =
                '<tr><td colspan="6" class="text-center py-4"><i class="fas fa-chart-line fa-3x text-muted mb-3"></i><p class="text-muted">Error loading data</p></td></tr>';
        });
}

/**
 * Show tambah data modal
 */
function showTambahDataModal() {
    loadExistingDates();
    document.getElementById("tambahTanggal").value = new Date()
        .toISOString()
        .split("T")[0];
    $("#tambahTekananDarahModal").modal("show");
}

// ========================================
// CRUD FUNCTIONS
// ========================================

/**
 * Edit tekanan darah
 */
function editTekananDarah(id, tanggal, sistol, diastol) {
    currentEditId = id;
    originalEditDate = tanggal;
    loadExistingDates();
    document.getElementById("editTanggal").value = tanggal;
    document.getElementById("editSistol").value = sistol;
    document.getElementById("editDiastol").value = diastol;
    $("#editTekananDarahModal").modal("show");
}

/**
 * Delete tekanan darah
 */
function deleteTekananDarah(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        fetch(`/admin/tekanan-darah/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": token,
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    loadModalData(currentPage);
                    loadChart();
                } else {
                    alert("Gagal menghapus data");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Terjadi kesalahan");
            });
    }
}

// ========================================
// CHART FUNCTIONS
// ========================================

/**
 * Load chart function
 */
function loadChart() {
    const ctx = document.getElementById("tekananDarahChart");

    if (!ctx) {
        console.error("Canvas element not found!");
        return;
    }

    fetch(`/admin/pasien/${window.currentUserId}/tekanan-darah/chart`)
        .then((response) => response.json())
        .then((data) => {
            if (
                window.tekananDarahChart &&
                typeof window.tekananDarahChart.destroy === "function"
            ) {
                window.tekananDarahChart.destroy();
            }

            if (data.labels && data.labels.length > 0) {
                window.tekananDarahChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: data.labels,
                        datasets: [
                            {
                                label: "Sistol",
                                data: data.sistol,
                                borderColor: "#dc3545",
                                backgroundColor: "rgba(220, 53, 69, 0.1)",
                                tension: 0.4,
                            },
                            {
                                label: "Diastol",
                                data: data.diastol,
                                borderColor: "#0b5e91",
                                backgroundColor: "rgba(11, 94, 145, 0.1)",
                                tension: 0.4,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 60,
                                max: 200,
                            },
                        },
                        plugins: {
                            legend: {
                                position: "top",
                            },
                        },
                    },
                });

                document.getElementById("chartPlaceholder").style.display =
                    "none";
            } else {
                document.getElementById("chartPlaceholder").style.display =
                    "block";
            }
        })
        .catch((error) => {
            console.error("Error loading chart:", error);
            document.getElementById("chartPlaceholder").style.display = "block";
        });
}

// ========================================
// UTILITY FUNCTIONS
// ========================================

/**
 * Password toggle function (specific to detail page)
 */
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + "Icon");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

// ========================================
// FORM HANDLERS
// ========================================

/**
 * Initialize form handlers
 */
function initializeFormHandlers() {
    // Handle tambah form submit
    const tambahForm = document.getElementById("tambahTekananDarahForm");
    if (tambahForm) {
        tambahForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const sistol = parseInt(
                document.getElementById("tambahSistol").value,
            );
            const diastol = parseInt(
                document.getElementById("tambahDiastol").value,
            );
            const tanggal = document.getElementById("tambahTanggal").value;

            if (!tanggal) {
                showToast("warning", "Tanggal harus diisi");
                return;
            }

            if (!validateTekananDarah(sistol, diastol, tanggal)) {
                return;
            }

            const formData = {
                user_id: window.currentUserId,
                tanggal_input: tanggal,
                sistol: sistol,
                diastol: diastol,
            };

            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            fetch("/admin/tekanan-darah", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                body: JSON.stringify(formData),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        showToast(
                            "success",
                            data.message ||
                                "Data tekanan darah berhasil ditambahkan!",
                        );
                        $("#tambahTekananDarahModal").modal("hide");
                        loadModalData(currentPage);
                        loadChart();
                        this.reset();
                    } else {
                        showToast(
                            "error",
                            data.message || "Gagal menyimpan data",
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showToast("error", "Terjadi kesalahan sistem");
                });
        });

        // Disable browser validation
        tambahForm.setAttribute("novalidate", "novalidate");
    }

    // Handle edit form submit
    const editForm = document.getElementById("editTekananDarahForm");
    if (editForm) {
        editForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const sistol = parseInt(
                document.getElementById("editSistol").value,
            );
            const diastol = parseInt(
                document.getElementById("editDiastol").value,
            );
            const tanggal = document.getElementById("editTanggal").value;

            if (!tanggal) {
                showToast("warning", "Tanggal harus diisi");
                return;
            }

            if (!validateEditTekananDarah(sistol, diastol, tanggal)) {
                return;
            }

            const formData = {
                tanggal_input: tanggal,
                sistol: sistol,
                diastol: diastol,
            };

            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            fetch(`/admin/tekanan-darah/${currentEditId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                body: JSON.stringify(formData),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        showToast(
                            "success",
                            data.message ||
                                "Data tekanan darah berhasil diperbarui!",
                        );
                        $("#editTekananDarahModal").modal("hide");
                        loadModalData(currentPage);
                        loadChart();
                    } else {
                        showToast(
                            "error",
                            data.message || "Gagal mengupdate data",
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showToast("error", "Terjadi kesalahan sistem");
                });
        });

        // Disable browser validation
        editForm.setAttribute("novalidate", "novalidate");
    }
}

// ========================================
// INITIALIZATION
// ========================================

/**
 * Initialize page when DOM is ready
 */
document.addEventListener("DOMContentLoaded", function () {
    // Load chart on page load
    loadChart();

    // Initialize form handlers
    initializeFormHandlers();

    console.log("Patient detail page initialized successfully");
});
