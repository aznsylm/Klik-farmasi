<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

function formatPhoneInput(input) {
    let value = input.value;
    
    // Hanya angka
    value = value.replace(/[^0-9]/g, '');
    
    // Auto convert 0 ke 62
    if (value.startsWith('0')) {
        value = '62' + value.substring(1);
    }
    
    // Auto convert 8 ke 62 (jika tidak dimulai 62)
    if (value.length > 0 && value.startsWith('8') && !value.startsWith('62')) {
        value = '62' + value;
    }
    
    // Batasi 15 digit
    if (value.length > 15) {
        value = value.substring(0, 15);
    }
    
    input.value = value;
}

function showDetailModal(id, name, email, phone, gender, age, puskesmas, created, role) {
    document.getElementById('detailUserInitial').textContent = name.charAt(0);
    document.getElementById('detailUserName').textContent = name;
    document.getElementById('detailUserRole').textContent = role === 'admin' ? 'Admin' : 'Pasien';
    document.getElementById('detailUserRoleBadge').textContent = role === 'admin' ? 'Administrator' : 'Pasien';
    document.getElementById('detailUserEmail').textContent = email;
    document.getElementById('detailUserPhone').textContent = phone;
    document.getElementById('detailUserGender').textContent = gender;
    document.getElementById('detailUserAge').textContent = age + ' tahun';
    
    let puskesmasName = puskesmas;
    if (puskesmas === 'kalasan') puskesmasName = 'Puskesmas Kalasan';
    else if (puskesmas === 'godean_2') puskesmasName = 'Puskesmas Godean 2';
    else if (puskesmas === 'umbulharjo') puskesmasName = 'Puskesmas Umbulharjo';
    document.getElementById('detailUserPuskesmas').textContent = puskesmasName || '-';
    
    document.getElementById('detailUserCreated').textContent = created;
    $('#modalDetailUser').modal('show');
}

function showEditModal(id, name, email, phone, gender, age, puskesmas, role) {
    document.getElementById('editUserRole').textContent = role === 'admin' ? 'Admin' : 'Pasien';
    document.getElementById('editUserRoleInput').value = role;
    document.getElementById('editUserName').value = name;
    document.getElementById('editUserEmail').value = email;
    document.getElementById('editUserPhone').value = phone;
    document.getElementById('editUserGender').value = gender;
    document.getElementById('editUserAge').value = age;
    document.getElementById('editUserPuskesmas').value = puskesmas || '';
    
    document.getElementById('editUserForm').action = '/superadmin/users/' + id;
    $('#modalEditUser').modal('show');
}

// Close modal and show notification after successful form submission
@if(session('success'))
    $(document).ready(function() {
        $('.modal').modal('hide');
        // Auto hide success alert after 5 seconds
        setTimeout(function() {
            $('.alert-success').fadeOut();
        }, 5000);
    });
@endif

@if(session('error'))
    $(document).ready(function() {
        $('.modal').modal('hide');
        // Auto hide error alert after 5 seconds
        setTimeout(function() {
            $('.alert-danger').fadeOut();
        }, 5000);
    });
@endif

// Custom validation messages
document.addEventListener('DOMContentLoaded', function() {
    // Use event delegation for dynamically loaded content
    document.addEventListener('invalid', function(e) {
        const input = e.target;
        
        if (input.validity.valueMissing) {
            if (input.type === 'email') {
                input.setCustomValidity('Email wajib diisi');
            } else if (input.name === 'name') {
                input.setCustomValidity('Nama wajib diisi');
            } else if (input.name === 'nomor_hp') {
                input.setCustomValidity('Nomor HP wajib diisi');
            } else if (input.name === 'puskesmas') {
                input.setCustomValidity('Puskesmas wajib dipilih');
            } else if (input.name === 'jenis_kelamin') {
                input.setCustomValidity('Jenis kelamin wajib dipilih');
            } else if (input.name === 'usia') {
                input.setCustomValidity('Usia wajib diisi');
            } else if (input.name === 'password') {
                input.setCustomValidity('Password wajib diisi');
            } else {
                input.setCustomValidity('Field ini wajib diisi');
            }
        } else if (input.validity.typeMismatch) {
            if (input.type === 'email') {
                input.setCustomValidity('Format email tidak valid');
            }
        } else if (input.validity.patternMismatch) {
            if (input.name === 'name') {
                input.setCustomValidity('Nama hanya boleh huruf dan spasi, 2-50 karakter');
            }
        } else if (input.validity.tooShort) {
            if (input.name === 'password') {
                input.setCustomValidity('Password minimal 8 karakter');
            }
        } else if (input.validity.rangeUnderflow) {
            if (input.name === 'usia') {
                input.setCustomValidity('Usia terlalu kecil');
            }
        } else if (input.validity.rangeOverflow) {
            if (input.name === 'usia') {
                input.setCustomValidity('Usia terlalu besar (maksimal 120 tahun)');
            }
        }
    }, true);
    
    // Clear custom validity on input
    document.addEventListener('input', function(e) {
        if (e.target.matches('input, select')) {
            e.target.setCustomValidity('');
        }
    });
});
</script>