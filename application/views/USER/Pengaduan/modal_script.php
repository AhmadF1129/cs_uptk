<script>
	$(document).ready(function() {

		// BEGIN - SHOW MODAL DETAIL KETERANGAN PENGADUAN ========================
		$('#modal-detail-keterangan').on('show.bs.modal', function(e) {
			var rowID = $(e.relatedTarget).data('id');
			$.ajax({
				type: 'POST',
				url: 'getItem',
				dataType: 'JSON',
				data: {
					rowID: rowID
				},
				success: function(res) {
					$('.modal-title').html(res.Title);
					$('.fetched-data').html(res.Item.Keterangan);
				},
				error: function(err) {
					console.log(err);
				}
			});
		});
		// END - SHOW MODAL DETAIL KETERANGAN PENGADUAN

		// BEGIN - INPUT EVENT OF MODAL FILTER DATA EXPORT ========================
		document.querySelectorAll('.filter-by').forEach((radio, id) => {
			radio.addEventListener('click', () => {
				radio.childNodes[1].checked = true
				let select = id == 0 ? 'Kategori' : 'Lokasi';
				let disabled = id == 0 ? 'Lokasi' : 'Kategori';
				document.querySelector(`#r${select}`).checked = false
				radioFilterByIsDisabled(`#r${select}`, `#r${disabled}`, 3)
			})
		})

		radioFilterByIsDisabled = (param1, param2, child) => {
			document.querySelectorAll(param1).forEach(() => {
				document.querySelector(param1).parentNode.parentNode.parentNode.childNodes[child].disabled = true
				document.querySelector(param2).parentNode.parentNode.parentNode.childNodes[child].disabled = false
			})
		}

		document.querySelectorAll('.time-line').forEach((radio, id) => {
			radio.addEventListener('click', () => {
				radio.childNodes[1].checked = true
				let select = id == 0 ? 'Bulan' : 'Tahun';
				let disabled = id == 0 ? 'Tahun' : 'Bulan';
				radio.parentNode.nextSibling.nextSibling.disabled = false
				radioTimeLineIsDisabled(`r${disabled}`)
			})
		})

		radioTimeLineIsDisabled = (selector) => {
			let el = document.getElementById(selector)
			el.parentNode.parentNode.nextSibling.nextSibling.disabled = true
			el.checked = false
		}
		// END - INPUT EVENT OF MODAL FILTER DATA EXPORT

		// BEGIN - GET EXPORT DATA AND SHOW RESULT ========================
		$.fn.exportData = function(format) {
			// FILTER BY
			const radioLokasi = document.querySelector('#rLokasi');
			let whereFilterBy = '',
				valueFilterBy = '';
			if (radioLokasi.checked) {
				whereFilterBy = 'Lokasi';
				valueFilterBy = $('#cmbLokasi').children("option:selected").val();
			} else {
				whereFilterBy = 'Kategori';
				valueFilterBy = $('#cmbKategori').children("option:selected").val();
			}

			// TIME LINE
			const radioBulan = document.querySelector('#rBulan');
			let whereTimeLine = '',
				valueTimeLine = '';
			if (radioBulan.checked) { // BULAN
				whereTimeLine = 'Bulan';
				valueTimeLine = $('#cmbBulan').children("option:selected").val();
			} else { // TAHUN
				whereTimeLine = 'Tahun';
				valueTimeLine = $('#cmbTahun').children("option:selected").val();
			}

			// EXECUTE
			$.ajax({ // AJAX 1 => GET DATA
				type: 'POST',
				url: 'getExportData', // cPengaduan
				dataType: 'JSON',
				async: false,
				data: { // REQUEST_1
					checkMode: format,
					whereFilterBy: whereFilterBy,
					valueFilterBy: valueFilterBy,
					whereTimeLine: whereTimeLine,
					valueTimeLine: valueTimeLine
				},
				success: function(res1) { // RESPONSE_1
					// console.log(res1);

					let pathURL = format == 'pdf' ? '<?= base_url('cExport/export_PDF'); ?>' : '<?= base_url('cExport/export_XLS'); ?>'

					$.ajax({ // AJAX 2 => CREATE REPORT
						type: 'POST',
						url: pathURL, // cExport
						dataType: 'JSON',
						async: false,
						data: { // REQUEST_2
							tableFields: res1.tableFields,
							jenisLayanan: res1.jenisLayanan,
							filterBy: res1.filterBy,
							padaWaktu: res1.padaWaktu,
							tableData: res1.tableData
						},
						success: function(res2) { // RESPONSE_2
							// console.log(res2);
							if (res2.mode == 'pdf') { // PDF
								if (res2.url) window.open(res2.url);
							} else { // XLS
								if (res2.file) window.open(res2.file);
							}
						},
						error: function(err) {
							console.log(err);
						}
					});

				},
				error: function(err) {
					console.log(err);
				}
			});
		}
		// });
		// END - GET EXPORT DATA AND SHOW RESULT
	});
</script>