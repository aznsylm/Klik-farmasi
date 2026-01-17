<!-- Modal Detail User -->
<div class="modal fade" id="modalDetailUser" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Detail <span id="detailUserRole"></span></h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 80px; height: 80px; font-size: 2rem; color: white;" id="detailUserInitial">
                        </div>
                        <h4 id="detailUserName"></h4>
                        <span class="badge" id="detailUserRoleBadge"></span>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Email</label>
                                    <p id="detailUserEmail"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Nomor HP</label>
                                    <p id="detailUserPhone"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Jenis Kelamin</label>
                                    <p id="detailUserGender"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Usia</label>
                                    <p id="detailUserAge"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Puskesmas</label>
                                    <p id="detailUserPuskesmas"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Terdaftar</label>
                                    <p id="detailUserCreated"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>