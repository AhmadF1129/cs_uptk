<!-- MODAL - ADD EDIT -->
<div class="modal fade" id="modal-add-edit-user" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title"></h5>
            </div>
            <div class="modal-body body-add-user">
                <form id="form-modal-add-edit-user" method="post" enctype="multipart/form-data">
                    <div id="select-role" hidden>
                        <label for="cmb-role">Role</label>
                        <select id="cmb-role" name="cmb-role" class="form-control"></select>
                    </div>

                    <label for="txt-username">Username</label>
                    <input type="text" id="txt-username" name="txt-username" class="form-control" required>

                    <div id="set-password" hidden>
                        <label for="txt-password">Password</label>
                        <input type="password" id="txt-password" name="txt-password" class="form-control" required>
                    </div>

                    <label for="txt-name">Nama</label>
                    <input type="text" id="txt-name" name="txt-name" class="form-control" required>

                    <label for="txt-email">Email</label>
                    <input type="email" id="txt-email" name="txt-email" class="form-control" required>

                    <label for="txt-phone-no">No Telp / HP</label>
                    <input type="number" id="txt-phone-no" name="txt-phone-no" class="form-control" required>

                    <div id="user-content-only" hidden>
                        <label for="txt-nim">NIM</label>
                        <input type="number" id="txt-nim" name="txt-nim" class="form-control" required>

                        <label for="cmb-jurusan">Jurusan</label>
                        <select id="cmb-jurusan" name="cmb-jurusan" class="form-control"></select>

                        <label for="cmb-prodi">Program Studi</label>
                        <select id="cmb-prodi" name="cmb-prodi" class="form-control"></select>

                        <label for="txt-kelas">Kelas</label>
                        <input type="text" id="txt-kelas" name="txt-kelas" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-modal-add-edit-process" class="btn btn-success"></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - DETAIL  -->
<div class="modal fade" id="modal-detail-user" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DETAIL</h5>
            </div>
            <div class="modal-body">
                <label for="d-txt-role">Role</label>
                <input type="text" id="d-txt-role" class="form-control" readonly>

                <label for="d-txt-username">Username</label>
                <input type="text" id="d-txt-username" class="form-control" readonly>

                <label for="d-txt-name">Nama</label>
                <input type="text" id="d-txt-name" class="form-control" readonly>

                <label for="d-txt-email">Email</label>
                <input type="text" id="d-txt-email" class="form-control" readonly>

                <label for="d-txt-phone-no">No Telp / HP</label>
                <input type="text" id="d-txt-phone-no" class="form-control" readonly>

                <div id="d-user-content-only" hidden>
                    <label for="d-txt-nim">NIM</label>
                    <input type="text" id="d-txt-nim" class="form-control" readonly>

                    <label for="d-txt-jurusan">Jurusan</label>
                    <input type="text" id="d-txt-jurusan" class="form-control" readonly>

                    <label for="d-txt-prodi">Program Studi</label>
                    <input type="text" id="d-txt-prodi" class="form-control" readonly>

                    <label for="d-txt-kelas">Kelas</label>
                    <input type="text" id="d-txt-kelas" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - DELETE => CONFIRMATION -->
<div class="modal fade" id="modal-delete-user" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">KONFIRMASI !</h5>
            </div>
            <div class="modal-body">
                <div id="msg-modal-delete"></div>
            </div>
            <div class="modal-footer">
                <a id="btn-modal-delete-process" class="btn btn-danger">YA</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - CHANGE PASSWORD -->
<div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UBAH PASSWORD</h5>
            </div>
            <form id="form-modal-change-password" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <center>
                        <strong><label for="cp-name" id="cp-name"></label></strong>
                    </center>
                    <hr>

                    <label for="new-password">New Password</label>
                    <input type="password" name="new-password" id="new-password" class="form-control">

                    <label for="repeat-password">Repeat Password</label>
                    <input type="password" name="repeat-password" id="repeat-password" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">UBAH PASSWORD</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>