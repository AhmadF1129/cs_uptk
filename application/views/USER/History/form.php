<div class="container">
    <div class="row mt-3">
        <div class="col">

            <?= $this->session->flashdata('history-form-page-flash') ?>

            <form id="form-input-history" action="editItem_updateHistoryPemakaian?flagFrom=fromHistoryPemakaian" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txt-jurusan">Jurusan</label>
                        <input type="text" id="txt-jurusan" class="form-control" readonly> <!-- can't send w/ name-->
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-prodi">Program Studi</label>
                        <input type="text" id="txt-prodi" class="form-control" readonly> <!-- can't send w/ name-->
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="txt-kelas">Kelas</label>
                        <input type="text" id="txt-kelas" class="form-control" readonly> <!-- can't send w/ name-->
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cmb-ruangan">Ruangan</label>
                        <select id="cmb-ruangan" name="cmb-ruangan" class="form-control">
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="cmb-dosen">Dosen</label>
                        <select id="cmb-dosen" name="cmb-dosen" class="form-control"></select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="txt-matkul">Mata Kuliah</label>
                        <input type="text" id="txt-matkul" name="txt-matkul" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cmb-kondisi-awal">Kondisi Awal Ruangan</label>
                        <select id="cmb-kondisi-awal" name="cmb-kondisi-awal" class="form-control">
                            <option value="default">Choose ...</option>
                            <option value="Rapi">Rapi</option>
                            <option value="Kurang Rapi">Kurang Rapi</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right col-md-3">NEXT</button>
            </form>
        </div>
    </div>
</div>