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
                        <h5 id="detailUserName"></h5>
                        <span class="badge badge-primary" id="detailUserRoleBadge"></span>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> Email</label>
                                    <p id="detailUserEmail"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-phone mr-1"></i> Nomor HP</label>
                                    <p id="detailUserPhone"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</label>
                                    <p id="detailUserGender"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-birthday-cake mr-1"></i> Usia</label>
                                    <p id="detailUserAge"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-hospital mr-1"></i> Puskesmas</label>
                                    <p id="detailUserPuskesmas"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-calendar-plus mr-1"></i> Terdaftar</label>
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