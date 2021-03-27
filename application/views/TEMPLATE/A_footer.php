<!-- ADMIN - FOOTER -->

<!-- MODAL - LOGOUT => CONFIRMATION -->
<div class="modal fade" id="modal-logout-confirmation" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">KONFIRMASI !</h5>
            </div>
            <div class="modal-body">
                <div id="msg-modal-logout">
                    Hai <strong><?= strtoupper($user) ?></strong>, anda yakin ingin keluar dari aplikasi ?
                </div>
            </div>
            <div class="modal-footer">
                <a id="btn-modal-logout-process" class="btn btn-danger" href="<?= base_url('cLogin/logout') ?>">YA</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<!-- Theme | Bootstrap 4 -->
<script src="<?= base_url('assets/PLUGINS') ?>/Bootstrap_4.4.1/js/bootstrap.min.js"></script>

</body>

</html>