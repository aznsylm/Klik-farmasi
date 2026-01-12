<script>
// Phone input formatting function
function formatPhoneInput(input) {
    let value = input.value.replace(/\D/g, '');
    
    if (value.startsWith('0')) {
        value = '62' + value.substring(1);
    } else if (value.startsWith('8')) {
        value = '62' + value;
    }
    
    if (value.length > 15) {
        value = value.substring(0, 15);
    }
    
    input.value = value;
}

// Password toggle function
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + 'Icon') || input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        if (icon) {
            icon.classList.remove('fa-eye', 'fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    } else {
        input.type = 'password';
        if (icon) {
            icon.classList.remove('fa-eye', 'fa-eye-slash');
            icon.classList.add('fa-eye-slash');
        }
    }
}

// Show edit modal function for index page
function showEditPasienModal(id, name, email, phone, gender, age, puskesmas) {
    document.getElementById('editNama').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editNomorHp').value = phone;
    document.getElementById('editJenisKelamin').value = gender;
    document.getElementById('editUsia').value = age;
    document.getElementById('editPuskesmas').value = puskesmas;
    
    document.getElementById('editPasienForm').action = '/admin/pasien/' + id;
    $('#editPasienModal').modal('show');
}

// Validate duplicate email/phone for tambah pasien
async function validateTambahPasien() {
    let isValid = true;
    
    // Reset errors
    document.getElementById('tambahEmail').classList.remove('is-invalid');
    document.getElementById('tambahNomorHp').classList.remove('is-invalid');
    document.getElementById('tambahEmailError').textContent = '';
    document.getElementById('tambahNomorHpError').textContent = '';
    
    const email = document.getElementById('tambahEmail').value.trim();
    const nomorHp = document.getElementById('tambahNomorHp').value.trim();
    
    // Check email duplicate
    if (email) {
        await fetch('/admin/check-duplicate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                document.getElementById('tambahEmail').classList.add('is-invalid');
                document.getElementById('tambahEmailError').textContent = 'Email sudah terdaftar';
                isValid = false;
            }
        })
        .catch(() => {});
    }
    
    // Check phone duplicate
    if (nomorHp) {
        await fetch('/admin/check-duplicate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ nomor_hp: nomorHp })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                document.getElementById('tambahNomorHp').classList.add('is-invalid');
                document.getElementById('tambahNomorHpError').textContent = 'Nomor HP sudah terdaftar';
                isValid = false;
            }
        })
        .catch(() => {});
    }
    
    return isValid;
}

// Patient validation messages
const patientValidationMessages = {
    nama: 'Nama wajib diisi',
    email: {
        required: 'Email wajib diisi',
        invalid: 'Format email tidak valid'
    },
    nomor_hp: {
        required: 'Nomor HP wajib diisi',
        invalid: 'Format nomor HP tidak valid (8-13 digit)'
    },
    jenis_kelamin: 'Jenis kelamin wajib dipilih',
    usia: {
        required: 'Usia wajib diisi',
        min: 'Usia minimal 1 tahun',
        max: 'Usia maksimal 120 tahun'
    },
    puskesmas: 'Puskesmas wajib dipilih'
};

// Validate patient form
async function validatePatientForm() {
    let isValid = true;
    
    // Reset previous errors
    const fields = ['Nama', 'Email', 'NomorHp', 'JenisKelamin', 'Usia', 'Puskesmas'];
    fields.forEach(field => {
        const element = document.getElementById('edit' + field);
        const errorElement = document.getElementById('edit' + field + 'Error');
        if (element && errorElement) {
            element.classList.remove('is-invalid');
            errorElement.textContent = '';
        }
    });
    
    // Validate nama
    const nama = document.getElementById('editNama').value.trim();
    if (!nama) {
        document.getElementById('editNama').classList.add('is-invalid');
        document.getElementById('editNamaError').textContent = patientValidationMessages.nama;
        isValid = false;
    }
    
    // Validate email (check for duplicates)
    const email = document.getElementById('editEmail').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        document.getElementById('editEmail').classList.add('is-invalid');
        document.getElementById('editEmailError').textContent = patientValidationMessages.email.required;
        isValid = false;
    } else if (!emailRegex.test(email)) {
        document.getElementById('editEmail').classList.add('is-invalid');
        document.getElementById('editEmailError').textContent = patientValidationMessages.email.invalid;
        isValid = false;
    } else {
        // Check for duplicate email via AJAX
        const currentUserId = window.currentUserId || null;
        await fetch('/admin/check-duplicate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email: email, user_id: currentUserId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                document.getElementById('editEmail').classList.add('is-invalid');
                document.getElementById('editEmailError').textContent = 'Email sudah terdaftar';
                isValid = false;
            }
        })
        .catch(() => {});
    }
    
    // Validate nomor HP (check for duplicates)
    const nomorHp = document.getElementById('editNomorHp').value.trim();
    const phoneRegex = /^62[0-9]{8,13}$/;
    if (!nomorHp) {
        document.getElementById('editNomorHp').classList.add('is-invalid');
        document.getElementById('editNomorHpError').textContent = patientValidationMessages.nomor_hp.required;
        isValid = false;
    } else if (!phoneRegex.test(nomorHp)) {
        document.getElementById('editNomorHp').classList.add('is-invalid');
        document.getElementById('editNomorHpError').textContent = 'Nomor HP harus diawali 62 dan 10-15 digit total';
        isValid = false;
    } else {
        // Check for duplicate phone via AJAX
        const currentUserId = window.currentUserId || null;
        await fetch('/admin/check-duplicate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ nomor_hp: nomorHp, user_id: currentUserId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                document.getElementById('editNomorHp').classList.add('is-invalid');
                document.getElementById('editNomorHpError').textContent = 'Nomor HP sudah terdaftar';
                isValid = false;
            }
        })
        .catch(() => {});
    }
    
    // Validate jenis kelamin
    const jenisKelamin = document.getElementById('editJenisKelamin').value;
    if (!jenisKelamin) {
        document.getElementById('editJenisKelamin').classList.add('is-invalid');
        document.getElementById('editJenisKelaminError').textContent = patientValidationMessages.jenis_kelamin;
        isValid = false;
    }
    
    // Validate usia
    const usia = parseInt(document.getElementById('editUsia').value);
    if (!usia) {
        document.getElementById('editUsia').classList.add('is-invalid');
        document.getElementById('editUsiaError').textContent = patientValidationMessages.usia.required;
        isValid = false;
    } else if (usia < 1) {
        document.getElementById('editUsia').classList.add('is-invalid');
        document.getElementById('editUsiaError').textContent = patientValidationMessages.usia.min;
        isValid = false;
    } else if (usia > 120) {
        document.getElementById('editUsia').classList.add('is-invalid');
        document.getElementById('editUsiaError').textContent = patientValidationMessages.usia.max;
        isValid = false;
    }
    
    // Validate puskesmas
    const puskesmas = document.getElementById('editPuskesmas').value;
    if (!puskesmas) {
        document.getElementById('editPuskesmas').classList.add('is-invalid');
        document.getElementById('editPuskesmasError').textContent = patientValidationMessages.puskesmas;
        isValid = false;
    }
    
    return isValid;
}

// Medication validation messages
const medicationValidationMessages = {
    nama_obat: 'Nama obat harus dipilih',
    jumlah_obat: 'Jumlah obat harus dipilih',
    waktu_minum: 'Waktu minum harus dipilih',
    suplemen: 'Suplemen harus dipilih'
};

// Check if user is from Godean puskesmas
const isGodeanAdmin = {{ auth()->user()->puskesmas === 'godean_2' ? 'true' : 'false' }};

// Validate medication form
function validateMedicationForm(formType) {
    const prefix = formType === 'tambah' ? 'tambah' : 'edit';
    let isValid = true;
    
    // Reset previous errors
    const fields = isGodeanAdmin ? ['Suplemen', 'JumlahObat', 'WaktuMinum'] : ['NamaObat', 'JumlahObat', 'WaktuMinum'];
    fields.forEach(field => {
        const element = document.getElementById(prefix + field);
        const errorElement = document.getElementById(prefix + field + 'Error');
        if (element && errorElement) {
            element.classList.remove('is-invalid');
            errorElement.textContent = '';
        }
    });
    
    if (isGodeanAdmin) {
        // For Godean: Validate suplemen (required)
        const suplemen = document.getElementById(prefix + 'Suplemen').value;
        if (!suplemen) {
            document.getElementById(prefix + 'Suplemen').classList.add('is-invalid');
            document.getElementById(prefix + 'SuplemenError').textContent = medicationValidationMessages.suplemen;
            isValid = false;
        }
    } else {
        // For others: Validate nama obat (required)
        const namaObat = document.getElementById(prefix + 'NamaObat').value;
        if (!namaObat) {
            document.getElementById(prefix + 'NamaObat').classList.add('is-invalid');
            document.getElementById(prefix + 'NamaObatError').textContent = medicationValidationMessages.nama_obat;
            isValid = false;
        }
    }
    
    // Validate jumlah obat (always required)
    const jumlahObat = document.getElementById(prefix + 'JumlahObat').value;
    if (!jumlahObat) {
        document.getElementById(prefix + 'JumlahObat').classList.add('is-invalid');
        document.getElementById(prefix + 'JumlahObatError').textContent = medicationValidationMessages.jumlah_obat;
        isValid = false;
    }
    
    // Validate waktu minum (always required)
    const waktuMinum = document.getElementById(prefix + 'WaktuMinum').value;
    if (!waktuMinum) {
        document.getElementById(prefix + 'WaktuMinum').classList.add('is-invalid');
        document.getElementById(prefix + 'WaktuMinumError').textContent = medicationValidationMessages.waktu_minum;
        isValid = false;
    }
    
    return isValid;
}

// Edit obat function
function editObat(id, namaObat, jumlahObat, waktuMinum, suplemen) {
    // Set form action URL
    document.getElementById('editObatForm').action = `/admin/obat/${id}`;
    
    // Fill form fields
    document.getElementById('editNamaObat').value = namaObat;
    document.getElementById('editJumlahObat').value = jumlahObat;
    
    // Fix waktu_minum format - convert from HH:MM:SS to HH:MM
    const timeValue = waktuMinum.substring(0, 5); // Get only HH:MM part
    document.getElementById('editWaktuMinum').value = timeValue;
    
    document.getElementById('editSuplemen').value = suplemen || '';
    
    // Show modal
    $('#editObatModal').modal('show');
}

// Handle form submissions
document.addEventListener('DOMContentLoaded', function() {
    // Handle edit patient form submit
    const editPasienForm = document.getElementById('editPasienForm');
    if (editPasienForm) {
        editPasienForm.setAttribute('novalidate', 'novalidate');
        editPasienForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!(await validatePatientForm())) {
                return;
            }
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    // Check if we're on detail page by looking for currentUserId
                    if (window.currentUserId) {
                        // Redirect to detail page
                        window.location.href = `/admin/pasien/${window.currentUserId}`;
                    } else {
                        // Redirect to index page
                        window.location.href = '/admin/pasien';
                    }
                } else {
                    alert('Gagal mengupdate data pasien');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        });
    }
    
    // Handle tambah obat form submit
    const tambahObatForm = document.getElementById('tambahObatForm');
    if (tambahObatForm) {
        tambahObatForm.setAttribute('novalidate', 'novalidate');
        tambahObatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateMedicationForm('tambah')) {
                return;
            }
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Gagal menambah obat');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        });
    }
    
    // Handle edit obat form submit
    const editObatForm = document.getElementById('editObatForm');
    if (editObatForm) {
        editObatForm.setAttribute('novalidate', 'novalidate');
        editObatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateMedicationForm('edit')) {
                return;
            }
            
            const formData = new FormData(this);
            const actionUrl = this.action;
            
            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Gagal mengupdate obat');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        });
    }
});
</script>