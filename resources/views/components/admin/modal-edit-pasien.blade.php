<!-- Modal Edit Pasien -->
<div class="modal fade" id="editPasienModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Data Pasien</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editPasienForm" action="{{ $action ?? '' }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="editNama"
                                    value="{{ $user->name ?? '' }}" required>
                                <div class="invalid-feedback" id="editNamaError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="editEmail"
                                    value="{{ $user->email ?? '' }}" required>
                                <div class="invalid-feedback" id="editEmailError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" name="nomor_hp" id="editNomorHp"
                                    value="{{ $user->nomor_hp ?? '' }}" placeholder="Contoh: 6281234567890"
                                    title="Nomor HP wajib gunakan awalan 62" oninput="formatPhoneInput(this)" required>
                                <div class="invalid-feedback" id="editNomorHpError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" id="editJenisKelamin" required>
                                    <option value="">-- Pilih jenis kelamin --</option>
                                    <option value="Laki-laki"
                                        {{ ($user->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="Perempuan"
                                        {{ ($user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="editJenisKelaminError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Usia</label>
                                <input type="number" class="form-control" name="usia" id="editUsia"
                                    value="{{ $user->usia ?? '' }}" min="1" max="120" required>
                                <div class="invalid-feedback" id="editUsiaError"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning" id="editPasienBtn">
                        <i class="fas fa-save mr-1"></i>Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
