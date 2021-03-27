<div class="container">
    <form action="<?= base_url('cPengaduan/addItem') ?>" method="post" enctype="multipart/form-data">
        <div class="mt-3">
            <?= $this->session->flashdata('flash') ?>
        </div>
        <div class="mt-5">
            <div class="form-group pt-3">
                <label><strong>LOKASI</strong></label>
                <select name="Lokasi" class="form-control">
                    <option>Lab UPT Komputer 1</option>
                    <option>Lab UPT Komputer 2</option>
                    <option>Lab UPT Komputer 3</option>
                    <option>Lab UPT Komputer 4</option>
                    <option>Lab UPT Komputer 5</option>
                    <option>Lab UPT Komputer 6</option>
                    <option>Lab UPT Komputer 8</option>
                </select>
            </div>

            <div class="form-group">
                <label><strong>KATEGORI</strong></label>
                <select name="Kategori" class="form-control">
                    <option>Koneksi Internet</option>
                    <option>Furnitur</option>
                    <option>Kebersihan</option>
                    <option>Perangkat Utama (CPU, Monitor, dll)</option>
                    <option>Perangkat Tambahan (AC, Infocus, dll)</option>
                    <option>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label><strong>KETERANGAN</strong></label>
                <textarea name="Keterangan" class="form-control" rows="3" placeholder="Jelaskan detail pengaduan anda"></textarea>
            </div>
            <div class="form-group">
                <label><strong>IDENTITAS</strong></label>
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline btn-rad">
                        <input type="radio" id="Radio1" class="custom-control-input" checked>
                        <label class="custom-control-label" for="Radio1">ANONYMOUS</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline btn-rad">
                        <input type="radio" id="Radio2" class="custom-control-input">
                        <label class="custom-control-label" for="Radio2">BY NAMA</label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" id="txtPelapor" name="Identitas" class="form-control" value="ANONYMOUS" placeholder="Isi dengan nama anda" readonly>
                </div>
            </div>

            <div class="form-group" style="float:right">
                <a href="<?= base_url('cPengaduan/index'); ?>" class="btn btn-outline-danger mr-10">CANCEL</a>
                <button type="submit" class="btn btn-outline-info">SUBMIT</button>
            </div>
        </div>
    </form>
</div>