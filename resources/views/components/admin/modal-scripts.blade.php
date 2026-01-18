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

    // Check if email exists
    async function checkEmailExists(email, excludeId = null) {
        if (!email || !email.includes('@')) return;

        try {
            const response = await fetch('/api/check-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    email,
                    exclude_id: excludeId
                })
            });

            const result = await response.json();
            const emailField = document.getElementById('editEmail');
            const errorDiv = document.getElementById('editEmailError');

            if (result.exists) {
                emailField.classList.add('is-invalid');
                errorDiv.textContent = 'Email sudah terdaftar';
            } else {
                emailField.classList.remove('is-invalid');
                errorDiv.textContent = '';
            }
        } catch (error) {
            console.error('Error checking email:', error);
        }
    }

    // Check if phone exists
    async function checkPhoneExists(phone, excludeId = null) {
        if (!phone || phone.length < 10) return;

        try {
            const response = await fetch('/api/check-phone', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    phone,
                    exclude_id: excludeId
                })
            });

            const result = await response.json();
            const phoneField = document.getElementById('editNomorHp');
            const errorDiv = document.getElementById('editNomorHpError');

            if (result.exists) {
                phoneField.classList.add('is-invalid');
                errorDiv.textContent = 'Nomor HP sudah terdaftar';
            } else {
                phoneField.classList.remove('is-invalid');
                errorDiv.textContent = '';
            }
        } catch (error) {
            console.error('Error checking phone:', error);
        }
    }

    // Handle validation errors
    function handleValidationErrors(errors) {
        Object.keys(errors).forEach(field => {
            const inputField = document.getElementById('edit' + field.charAt(0).toUpperCase() + field.slice(1)
                .replace('_', ''));
            const errorDiv = document.getElementById('edit' + field.charAt(0).toUpperCase() + field.slice(1)
                .replace('_', '') + 'Error');

            if (inputField && errorDiv) {
                inputField.classList.add('is-invalid');
                errorDiv.textContent = errors[field][0];
            }
        });
    }

    // Global Toast Notification Function
    function showToast(type, message, duration = 5000) {
        const iconMap = {
            'success': 'fas fa-check-circle',
            'error': 'fas fa-times-circle',
            'warning': 'fas fa-exclamation-triangle',
            'info': 'fas fa-info-circle'
        };

        const colorMap = {
            'success': 'alert-success',
            'error': 'alert-danger',
            'warning': 'alert-warning',
            'info': 'alert-info'
        };

        const toastId = 'toast-' + Date.now();
        const alertHtml = `
            <div id="${toastId}" class="alert ${colorMap[type]} alert-dismissible" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; margin-bottom: 10px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="${iconMap[type]} mr-2"></i>
                ${message}
            </div>
        `;
        document.body.insertAdjacentHTML('afterbegin', alertHtml);

        // Auto hide
        setTimeout(() => {
            const alert = document.getElementById(toastId);
            if (alert) {
                $(alert).alert('close');
            }
        }, duration);
    }

    // Legacy function - deprecated, use showToast instead
    function showErrorAlert(message) {
        showToast('error', message);
    }

    // Show edit modal function for index page
    function showEditPasienModal(id, name, email, phone, gender, age, puskesmas) {
        document.getElementById('editNama').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editNomorHp').value = phone;
        document.getElementById('editJenisKelamin').value = gender;
        document.getElementById('editUsia').value = age;

        // Only set puskesmas if field exists (for SuperAdmin)
        const puskesmasField = document.getElementById('editPuskesmas');
        if (puskesmasField) {
            puskesmasField.value = puskesmas;
        }

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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        email: email
                    })
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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        nomor_hp: nomorHp
                    })
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
        const fields = ['Nama', 'Email', 'NomorHp', 'JenisKelamin', 'Usia'];
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

        // Validate email
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
        }

        // Validate nomor HP
        const nomorHp = document.getElementById('editNomorHp').value.trim();
        const phoneRegex = /^62[0-9]{8,13}$/;
        if (!nomorHp) {
            document.getElementById('editNomorHp').classList.add('is-invalid');
            document.getElementById('editNomorHpError').textContent = patientValidationMessages.nomor_hp.required;
            isValid = false;
        } else if (!phoneRegex.test(nomorHp)) {
            document.getElementById('editNomorHp').classList.add('is-invalid');
            document.getElementById('editNomorHpError').textContent =
                'Nomor HP harus diawali 62 dan 10-15 digit total';
            isValid = false;
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
        if (!usia || usia < 1) {
            document.getElementById('editUsia').classList.add('is-invalid');
            document.getElementById('editUsiaError').textContent = patientValidationMessages.usia.required;
            isValid = false;
        } else if (usia > 120) {
            document.getElementById('editUsia').classList.add('is-invalid');
            document.getElementById('editUsiaError').textContent = patientValidationMessages.usia.max;
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
        const fields = isGodeanAdmin ? ['Suplemen', 'JumlahObat', 'WaktuMinum'] : ['NamaObat', 'JumlahObat',
            'WaktuMinum'
        ];
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

            // Add real-time validation for email and phone
            const emailField = document.getElementById('editEmail');
            const phoneField = document.getElementById('editNomorHp');

            if (emailField) {
                emailField.addEventListener('blur', async function() {
                    await checkEmailExists(this.value, window.currentUserId);
                });
            }

            if (phoneField) {
                phoneField.addEventListener('blur', async function() {
                    await checkPhoneExists(this.value, window.currentUserId);
                });
            }

            editPasienForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = document.getElementById('editPasienBtn');
                const originalText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...';

                if (!(await validatePatientForm())) {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                    return;
                }

                const formData = new FormData(this);

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    let result;
                    const contentType = response.headers.get('content-type');

                    if (contentType && contentType.includes('application/json')) {
                        result = await response.json();
                    } else {
                        // If not JSON, treat as success if response is ok
                        result = {
                            success: response.ok
                        };
                    }

                    if (response.ok && (result.success !== false)) {
                        // Show success notification
                        showToast('success', 'Data pasien berhasil diperbarui!');

                        // Hide modal
                        $('#editPasienModal').modal('hide');

                        // Auto dismiss notification and reload
                        setTimeout(() => {
                            if (window.currentUserId) {
                                window.location.reload();
                            } else {
                                window.location.href = '/admin/pasien';
                            }
                        }, 1500);
                    } else {
                        // Handle validation errors
                        if (result.errors) {
                            handleValidationErrors(result.errors);
                        } else {
                            showErrorAlert(result.message || 'Gagal mengupdate data pasien');
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('error', 'Terjadi kesalahan saat menyimpan data');
                } finally {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
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

        // Handle reset password form
        const resetPasswordForms = document.querySelectorAll('form[action*="resetPassword"]');
        resetPasswordForms.forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const passwordField = this.querySelector('input[name="new_password"]');
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                // Basic validation
                if (!passwordField.value || passwordField.value.length < 6) {
                    showToast('warning', 'Password minimal 6 karakter');
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Reset...';

                const formData = new FormData(this);

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        // Show success notification
                        showToast('success', 'Password berhasil direset!');

                        // Clear password field
                        passwordField.value = '';

                        // Auto dismiss notification
                        setTimeout(() => {
                            const alert = document.querySelector('.alert-success');
                            if (alert) alert.remove();
                        }, 3000);
                    } else {
                        const result = await response.json().catch(() => ({}));
                        showErrorAlert(result.message || 'Gagal reset password');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showErrorAlert('Terjadi kesalahan saat reset password');
                } finally {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        });

        // Universal form handler dengan toast notifications
        document.querySelectorAll('form[data-toast="true"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                const action = this.action;

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Proses...';

                fetch(action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json().then(data => ({
                        status: response.status,
                        body: data
                    })))
                    .then(({
                        status,
                        body
                    }) => {
                        if (status >= 200 && status < 300) {
                            let message = 'Data berhasil disimpan!';
                            if (action.includes('tambah')) message =
                                'Data berhasil ditambahkan!';
                            else if (action.includes('update') || action.includes('edit'))
                                message = 'Data berhasil diperbarui!';
                            else if (action.includes('delete')) message =
                                'Data berhasil dihapus!';

                            showToast('success', body.message || message);
                            $('.modal').modal('hide');
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            throw new Error(body.message || 'Terjadi kesalahan');
                        }
                    })
                    .catch(error => {
                        showToast('error', error.message || 'Terjadi kesalahan sistem');
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    });
            });
        });
    });
</script>
