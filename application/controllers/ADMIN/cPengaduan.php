<?php
include($_SERVER['DOCUMENT_ROOT'] . '\cs_uptk\application\helpers\ChromePhp.php');

class cPengaduan extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mPengaduan');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }

    public function showForm()
    {

        $data['title'] = "FORM PENGADUAN";

        $this->load->view('templates/header', $data);
        $this->load->view('Pengaduan/form');
        $this->load->view('Pengaduan/form_script');
        $this->load->view('templates/footer');
    }

    public function addItem()
    {
        $queryResult = $this->mPengaduan->addItem();

        // CHECK QUERY RESULT
        $msg = '';
        $alertClass = '';
        if ($queryResult) {
            $msg = 'DATA BERHASIL DITAMBAHKAN !';
            $alertClass = 'alert alert-success page-alert';
        } else {
            $msg = 'DATA TIDAK BERHASIL DITAMBAHKAN !';
            $alertClass = 'alert alert-danger page-alert';
        }
        $this->session->set_flashdata('flash', '<div class="' . $alertClass . ' fade show mt-3" role="alert">' . $msg . '</div>');
        redirect('cPengaduan/showForm');
    }

    public function showList()
    {
        $data['title'] = 'LIST PENGADUAN';

        $this->load->view('templates/header', $data);
        $this->load->view('Pengaduan/list');
        $this->load->view('Pengaduan/list_script');
        $this->load->view('Pengaduan/modal');
        $this->load->view('Pengaduan/modal_script');
        $this->load->view('templates/footer');
    }

    public function searchItem()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        // HEADER
        $output .= '
        <div class="table-responsive">
            <table class="table text-center">
				<thead class="thead-dark">
					<tr>
						<th>LOKASI</th>
						<th>KATEGORI</th>
						<th>IDENTITAS</th>
						<th>ACTION</th>
                    </tr>
                </thead>

        ';

        // DATA
        $data = $this->mPengaduan->searchItem($query);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
                <tbody>
                    <tr>
                        <td>' . $row->Lokasi . '</td>
                        <td>' . $row->Kategori . '</td>
                        <td>' . $row->Identitas . '</td>
                        <td>
                        <a href="#modal-detail-keterangan" class="btn btn-outline-info btn-light ml-2" data-toggle="modal" data-id="' . $row->id . '">KETERANGAN</a>
                        </td>
                    </tr>
                </tbody> ';
            }
        } else {
            $output .= '
                <tbody>
                    <tr>
                        <td colspan="4">Data Tidak Ditemukan!</td>
                    </tr>
                </tbody> ';
        }

        $output .= '
            </table>
        ';

        echo $output;
    }

    public function getItem()
    {
        $id = $_POST['rowID'];

        $data['Title'] = 'DETAIL PENGADUAN';
        $data['Item'] = $this->mPengaduan->getItem($id);

        echo json_encode($data);
    }

    public function getExportData()
    {
        // GET POST REQUEST
        $mode = $_POST['checkMode']; // Export Format => pdf | xls
        $filterBy  = $_POST['whereFilterBy']; // Lokasi | Kategori
        $filterBy_Value = $_POST['valueFilterBy'];
        $timeLine = $_POST['whereTimeLine'];  // Bulan | Tahun
        $timeLine_Value = $_POST['valueTimeLine'];

        // TABLE INFO
        $data['jenisLayanan'] = 'PENGADUAN';
        $data['filterBy'] = $filterBy . ' @ ' . $filterBy_Value; // Lokasi : Lab Komputer 1
        $data['padaWaktu'] = $timeLine . ' @ ' . $timeLine_Value; // Bulan : 2019-02 | Tahun = 2019

        // TABLE FIELDS
        $data['tableFields'] = [
            'pdf' => [
                ['Name' => 'NO', 'Width' => '6%'],
                ['Name' => 'LOKASI', 'Width' => '26%'],
                ['Name' => 'KATEGORI', 'Width' => '10%'],
                ['Name' => 'IDENTITAS', 'Width' => '16%'],
                ['Name' => 'KETERANGAN', 'Width' => '32%'],
                ['Name' => 'TANGGAL', 'Width' => '10%']
            ],
            'xls' => [
                ['Name' => 'NO', 'CellPos' => 'A10', 'ColPos' => 'A', 'ColWidth' => '5'],
                ['Name' => 'LOKASI', 'CellPos' => 'B10', 'ColPos' => 'B', 'ColWidth' => '20'],
                ['Name' => 'KATEGORI', 'CellPos' => 'C10', 'ColPos' => 'C', 'ColWidth' => '20'],
                ['Name' => 'IDENTITAS', 'CellPos' => 'D10', 'ColPos' => 'D', 'ColWidth' => '20'],
                ['Name' => 'KETERANGAN', 'CellPos' => 'E10', 'ColPos' => 'E', 'ColWidth' => '50'],
                ['Name' => 'TANGGAL', 'CellPos' => 'F10', 'ColPos' => 'F', 'ColWidth' => '20'],
            ]
        ];

        // TABLE DATA
        $queryResult = $this->mPengaduan->getExportData($filterBy, $filterBy_Value, $timeLine, $timeLine_Value);

        $tableData = $mode == 'pdf' ? '' : [];

        // For XLS Only
        $colPos = [];
        $charStart = 'A'; // Col Start Init
        $charLen = 6;
        for ($i = 0; $i < $charLen; $i++) array_push($colPos, $charStart++);
        $rowPos = 11; // Row Start Init

        $i = 1;
        foreach ($queryResult as $dt) {

            if ($mode == 'pdf') {
                $tableData .= '
                <tr  bgcolor="#fff" color="#000">
                    <td align="center">' . $i++ . '</td>
                    <td>' . $dt['Lokasi'] . '</td>
                    <td>' . $dt['Kategori'] . '</td>
                    <td>' . $dt['Identitas'] . '</td>
                    <td>' . $dt['Keterangan'] . '</td>
                    <td>' . $dt['Tanggal'] . '</td>
                </tr>';
            } else {
                array_push($tableData, [
                    'colPos' => $colPos,
                    'rowPos' => $rowPos,
                    'contentData' => [
                        $i++,
                        $dt['Lokasi'],
                        $dt['Kategori'],
                        $dt['Identitas'],
                        $dt['Keterangan'],
                        date(
                            'j F Y',
                            strtotime($dt['Tanggal'])
                        )
                    ]
                ]);
            }
        }
        $data['tableData'] = $tableData;

        // SEND RESPONSE BACK
        echo json_encode($data);
    }
}
