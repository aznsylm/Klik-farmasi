<!-- Modal Tambah {{ ucfirst($role) }} -->
<div class="modal fade" id="modalTambah{{ ucfirst($role) }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('superadmin.storeUser') }}" class="modal-content">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah {{ ucfirst($role) }} Baru</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama {{ ucfirst($role) }}</label>
                            <input type="text" class="form-control" name="name" 
                                pattern="[A-Za-z\s]{2,50}" 
                                title="Nama hanya boleh huruf dan spasi, 2-50 karakter" 
                                required>
                        </div>
                        <div class="form-group">
                            <label>Email {{ ucfirst($role) }}</label>
                            <input type="email" class="form-control" name="email" 
                                title="Masukkan alamat email yang valid"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control" name="nomor_hp" 
                                placeholder="Contoh: 6281234567890" 
                                title="Nomor HP wajib gunakan awalan 62" 
                                oninput="formatPhoneInput(this)"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Puskesmas</label>
                            <select class="form-control" name="puskesmas" 
                                title="Pilih salah satu puskesmas"
                                required>
                                <option value="">Pilih Puskesmas</option>
                                <option value="kalasan">Puskesmas Kalasan</option>
                                <option value="godean_2">Puskesmas Godean 2</option>
                                <option value="umbulharjo">Puskesmas Umbulharjo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" 
                                title="Pilih jenis kelamin"
                                required>
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Usia</label>
                            <input type="number" class="form-control" name="usia" 
                                min="{{ $role === 'admin' ? '18' : '1' }}" max="120" 
                                title="{{ $role === 'admin' ? 'Usia minimal 18 tahun untuk admin' : 'Usia antara 1-120 tahun' }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" 
                                    name="password" 
                                    id="password{{ ucfirst($role) }}Input" 
                                    title="Password minimal 8 karakter"
                                    required 
                                    minlength="8">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary" onclick="togglePassword('password{{ ucfirst($role) }}Input')">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Tambah
                </button>
            </div>
        </form>
    </div>
</div>