<div class="container">
    <form action="<?= base_url('cKetinggalan/addItem') ?>" method="post" enctype="multipart/form-data">
        <div class="mt-3">
            <?= $this->session->flashdata('flash') ?>
        </div>
        <div class="mt-5">
            <div class="form-group pt-3">
                <label><strong>NAMA BARANG</strong></label>
                <input name="Barang" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1"><strong>LOKASI DITEMUKAN</strong></label>
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
                <label for="exampleFormControlTextarea1"><strong>KETERANGAN</strong></label>
                <textarea name="Keterangan" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-info">SUBMIT</button>
            </div>
        </div>
    </form>
</div>