<!-- MODAL - PENGADUAN - DETAIL KETERANGAN -->
<div id="modal-detail-keterangan" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="fetched-data"></div> <!-- DATA HERE -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- MODAL - PENGADUAN - FILTER DATA FOR EXPORT -->
<div id="modal-filter-data-export-pengaduan" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- HEADER -->
			<div style="float: left;" class="modal-header">
				<h4 id="modalHeaderTitle1" class="modal-title">FILTER BY</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<!-- BODY -->
			<div class="modal-body">
				<!-- FILTER BY -->
				<div id="divFilterBy" class="form-group">
					<!-- LOKASI -->
					<div class="form-group mt-3">
						<div class="form-row">
							<div class="col-3">
								<div class="custom-control custom-radio custom-control-inline filter-by">
									<input type="radio" id="rLokasi" class="custom-control-input" checked>
									<label for="rLokasi" class="custom-control-label">LOKASI</label>
								</div>
							</div>
							<select id="cmbLokasi" name="lokasi" class="form-control col-8">
								<option value="Lab UPT Komputer 1">Lab UPT Komputer 1</option>
								<option value="Lab UPT Komputer 2">Lab UPT Komputer 2</option>
								<option value="Lab UPT Komputer 3">Lab UPT Komputer 3</option>
								<option value="Lab UPT Komputer 4">Lab UPT Komputer 4</option>
								<option value="Lab UPT Komputer 5">Lab UPT Komputer 5</option>
								<option value="Lab UPT Komputer 6">Lab UPT Komputer 6</option>
								<option value="Lab UPT Komputer 8">Lab UPT Komputer 8</option>
							</select>
						</div>
					</div>
					<!-- KATEGORI -->
					<div class="form-group mt-3">
						<div class="form-row">
							<div class="col-3">
								<div class="custom-control custom-radio custom-control-inline filter-by">
									<input type="radio" id="rKategori" class="custom-control-input">
									<label for="rKategori" class="custom-control-label">KATEGORI</label>
								</div>
							</div>
							<select id="cmbKategori" name="kategori" class="form-control col-8" disabled>
								<option value="Koneksi Internet">Koneksi Internet</option>
								<option value="Furnitur">Furnitur</option>
								<option value="Kebersihan">Kebersihan</option>
								<option value="Perangkat Utama">Perangkat Utama (CPU, Monitor, dll)</option>
								<option value="Perangkat Tambahan">Perangkat Tambahan (AC, Infocus, dll)</option>
								<option value="Lainnya">Lainnya</option>
							</select>
						</div>
					</div>
				</div>

				<!-- TIME LINE -->
				<div id="divOnTimeLine" class="form-group">
					<h4 id="modalHeaderTitle2" class="modal-title">TIME LINE</h4>
					<hr>
					<!-- BULAN -->
					<div class="form-group mt-3">
						<div class="form-row">
							<div class="col-3">
								<div class="custom-control custom-radio custom-control-inline time-line">
									<input type="radio" id="rBulan" class="custom-control-input" checked>
									<label for="rBulan" class="custom-control-label">BULAN</label>
								</div>
							</div>
							<select id="cmbBulan" name="bulan" class="form-control col-8">
								<?php
								$currentYear = date('Y');
								$arrMonth = [
									'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
									'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
								];
								for ($i = 0; $i < 12; $i++) {
									echo '<option value="' . $currentYear . '-' . str_pad(($i + 1), 2, 0, STR_PAD_LEFT) . '"';
									echo ' >' . $arrMonth[$i] . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<!-- TAHUN -->
					<div class="form-group mt-3">
						<div class="form-row">
							<div class="col-3">
								<div class="custom-control custom-radio custom-control-inline time-line">
									<input type="radio" id="rTahun" class="custom-control-input">
									<label for="rTahun" class="custom-control-label">TAHUN</label>
								</div>
							</div>
							<select id="cmbTahun" name="tahun" class="form-control col-8" disabled>
								<?php
								$starting_year  = date('Y', strtotime('-3 year')); // 2016
								$ending_year  = date('Y'); // 2019
								$current_year = date('Y'); // 2019
								for ($ending_year; $ending_year >= $starting_year; $ending_year--) {
									echo '<option value="' . $ending_year . '"';
									if ($ending_year == $current_year) {
										echo ' selected="selected"';
									}
									echo ' >' . $ending_year . '</option>';
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>

			<!-- FOOTER -->
			<div class="modal-footer" style="display:inline !important">
				<div id="btnFilterBy">
					<div style="float:right">
						<div id="btnFilterBy">
							<div style="float:right">
								<button class="btn btn-outline-success" onclick="$(this).exportData('xls');"><i class="fas fa-file-excel"></i> EXCEL</button>
								<button class="btn btn-outline-danger" onclick="$(this).exportData('pdf');"><i class="fas fa-file-pdf"></i> PDF</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>