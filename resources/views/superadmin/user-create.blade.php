@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-transparent py-3">
                        <h5 class="mb-0 fw-bold">Tambah User Baru</h5>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ $role === 'admin' ? route('superadmin.addAdmin') : route('superadmin.addPasien') }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password<span class="text-danger">*</span></label>
                                    <div class="password-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                        <input type="password" class="form-control" name="password" required minlength="8" id="password">
                                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('password', this)"></i>
                                    </div>
                                    @error('password')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                                    <div class="password-group {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                                        <input type="password" class="form-control" name="password_confirmation" required minlength="8" id="password_confirmation">
                                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('password_confirmation', this)"></i>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Puskesmas<span class="text-danger">*</span></label>
                                    <select class="form-select {{ $errors->has('puskesmas') ? 'is-invalid' : '' }}"
                                        name="puskesmas" required>
                                        <option value="" disabled hidden {{ !old('puskesmas') ? 'selected' : '' }}>Pilih Puskesmas *</option>
                                        <option value="kalasan" {{ old('puskesmas') == 'kalasan' ? 'selected' : '' }}>Puskesmas Kalasan</option>
                                        <option value="godean_2" {{ old('puskesmas') == 'godean_2' ? 'selected' : '' }}>Puskesmas Godean 2</option>
                                        <option value="umbulharjo" {{ old('puskesmas') == 'umbulharjo' ? 'selected' : '' }}>Puskesmas Umbulharjo</option>
                                    </select>
                                    @error('puskesmas')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor HP<span class="text-danger">*</span></label>
                                    <div class="phone-input-group {{ $errors->has('nomor_hp') ? 'is-invalid' : '' }}">
                                        <input type="tel" class="form-control phone-input" name="nomor_hp_display" id="nomorHP" placeholder="8xxxxxxxxx" required value="{{ old('nomor_hp') ? str_replace('62', '', old('nomor_hp')) : '' }}" pattern="[0-9]{8,13}" maxlength="13" minlength="8">
                                        <input type="hidden" name="nomor_hp" id="nomorHPHidden" value="{{ old('nomor_hp') }}">
                                    </div>
                                    @error('nomor_hp')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Usia<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control {{ $errors->has('usia') ? 'is-invalid' : '' }}"
                                        name="usia" value="{{ old('usia') }}" required min="1" max="120">
                                    @error('usia')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <select class="form-select {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}"
                                        name="jenis_kelamin" required>
                                        <option value="" disabled hidden {{ !old('jenis_kelamin') ? 'selected' : '' }}>Pilih Jenis Kelamin *</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('superadmin.users', ['role' => $role]) }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        <style>
            .error-message {
                color: #dc3545;
                font-size: 0.875rem;
                margin-top: 5px;
            }
            
            .phone-input-group {
                display: flex;
                border: 1px solid #ced4da;
                border-radius: 0.375rem;
                overflow: hidden;
            }
            
            .phone-input-group.is-invalid {
                border-color: #dc3545;
            }
            
            .phone-prefix {
                background: #f8f9fa;
                padding: 0.375rem 0.75rem;
                border-right: 1px solid #ced4da;
                color: #495057;
                font-weight: 500;
            }
            
            .phone-input {
                border: none !important;
                flex: 1;
            }
            
            .phone-input:focus {
                outline: none;
                box-shadow: none;
            }
            
            .phone-input-group:focus-within {
                border-color: #0B5E91;
                box-shadow: 0 0 0 0.25rem rgba(11, 94, 145, 0.25);
            }
            
            .password-group {
                position: relative;
            }
            
            .password-group .form-control {
                padding-right: 45px;
            }
            
            .password-group.is-invalid .form-control {
                border-color: #dc3545;
            }
            
            .password-toggle {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #6c757d;
                cursor: pointer;
                font-size: 1rem;
            }
            
            .password-toggle:hover {
                color: #0B5E91;
            }
            
            .btn-primary {
                background-color: #0B5E91;
                border-color: #0B5E91;
            }
            
            .btn-primary:hover {
                background-color: #094a73;
                border-color: #094a73;
            }
        </style>
    @endpush
    
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Password toggle function
                window.togglePassword = function(inputId, iconElement) {
                    const input = document.getElementById(inputId);
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        iconElement.classList.remove('fa-eye-slash');
                        iconElement.classList.add('fa-eye');
                    } else {
                        input.type = 'password';
                        iconElement.classList.remove('fa-eye');
                        iconElement.classList.add('fa-eye-slash');
                    }
                }

                // Nomor HP validation
                const phoneInput = document.getElementById('nomorHP');
                const phoneHidden = document.getElementById('nomorHPHidden');
                
                if (phoneInput && phoneHidden) {
                    function updatePhoneNumber() {
                        let value = phoneInput.value.replace(/\D/g, '');
                        
                        // Hapus awalan 0 atau 62 jika ada
                        if (value.startsWith('0')) {
                            value = value.substring(1);
                        }
                        if (value.startsWith('62')) {
                            value = value.substring(2);
                        }
                        
                        // Batasi panjang maksimal 13 digit
                        if (value.length > 13) {
                            value = value.substring(0, 13);
                        }
                        
                        phoneInput.value = value;
                        
                        // Update hidden field dengan prefix 62
                        if (value) {
                            phoneHidden.value = '62' + value;
                        } else {
                            phoneHidden.value = '';
                        }
                        
                        // Validasi panjang
                        if (value.length < 8) {
                            phoneInput.setCustomValidity('Nomor HP minimal 8 digit');
                        } else if (value.length > 13) {
                            phoneInput.setCustomValidity('Nomor HP maksimal 13 digit');
                        } else {
                            phoneInput.setCustomValidity('');
                        }
                    }
                    
                    phoneInput.addEventListener('input', updatePhoneNumber);
                    
                    // Cegah paste karakter non-digit
                    phoneInput.addEventListener('paste', function(e) {
                        e.preventDefault();
                        let paste = (e.clipboardData || window.clipboardData).getData('text');
                        let cleanPaste = paste.replace(/\D/g, '');
                        
                        // Hapus awalan 0 atau 62 jika ada
                        if (cleanPaste.startsWith('0')) {
                            cleanPaste = cleanPaste.substring(1);
                        }
                        if (cleanPaste.startsWith('62')) {
                            cleanPaste = cleanPaste.substring(2);
                        }
                        
                        cleanPaste = cleanPaste.substring(0, 13);
                        phoneInput.value = cleanPaste;
                        updatePhoneNumber();
                    });
                    
                    // Initialize on page load
                    updatePhoneNumber();
                }
            });
        </script>
    @endpush
@endsection
