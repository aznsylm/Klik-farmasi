<!-- Modal Tambah Pasien -->
<div class="modal fade" id="tambahPasienModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.addPasien') }}" class="modal-content" data-toast="true">
            @csrf
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah Pasien Baru</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" class="form-control" name="name" pattern="[A-Za-z\s]{2,50}"
                                title="Nama hanya boleh huruf dan spasi, 2-50 karakter" required>
                        </div>
                        <div class="form-group">
                            <label>Email Pasien</label>
                            <input type="email" class="form-control" name="email" id="tambahEmail"
                                title="Masukkan alamat email yang valid" required>
                            <div class="invalid-feedback" id="tambahEmailError"></div>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control" name="nomor_hp" id="tambahNomorHp"
                                placeholder="Contoh: 6281234567890" title="Nomor HP wajib gunakan awalan 62"
                                oninput="formatPhoneInput(this)" required>
                            <div class="invalid-feedback" id="tambahNomorHpError"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" title="Pilih jenis kelamin" required>
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Usia</label>
                            <input type="number" class="form-control" name="usia" min="1" max="120"
                                title="Usia antara 1-120 tahun" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="passwordPasienInput"
                                    title="Password minimal 8 karakter" required minlength="8">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="togglePassword('passwordPasienInput')">
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
