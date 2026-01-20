<!-- Modal Edit User -->
<div class="modal fade" id="modalEditUser" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="editUserForm" class="modal-content">
            @csrf
            @method('PUT')
            <input type="hidden" name="role" id="editUserRoleInput">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit <span id="editUserRole"></span></h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" id="editUserName"
                                pattern="[A-Za-z\s]{2,50}" title="Nama hanya boleh huruf dan spasi, 2-50 karakter"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="editUserEmail"
                                title="Masukkan alamat email yang valid" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control" name="nomor_hp" id="editUserPhone"
                                placeholder="Contoh: 6281234567890" title="Nomor HP wajib gunakan awalan 62"
                                oninput="formatPhoneInput(this)" required>
                        </div>
                        <div class="form-group">
                            <label>Puskesmas</label>
                            <select class="form-control" name="puskesmas" id="editUserPuskesmas"
                                title="Pilih salah satu puskesmas" required>
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
                            <select class="form-control" name="jenis_kelamin" id="editUserGender"
                                title="Pilih jenis kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Usia</label>
                            <input type="number" class="form-control" name="usia" id="editUserAge" min="1"
                                max="120" title="Usia antara 1-120 tahun" required>
                        </div>
                        <div class="form-group">
                            <label>Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="editPasswordInput"
                                    title="Password minimal 8 karakter (kosongkan jika tidak ingin mengubah)"
                                    minlength="8">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="togglePassword('editPasswordInput')">
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
                    <i class="fas fa-save mr-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
