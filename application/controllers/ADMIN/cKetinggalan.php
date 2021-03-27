<?php
defined('BASEPATH') or exit('No direct script access allowed');
include($_SERVER['DOCUMENT_ROOT'] . '\cs_uptk\application\helpers\ChromePhp.php');

class cKetinggalan extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ADMIN/mKetinggalan');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }


    public function index()
    {
        $data['title'] = 'ADMIN PAGE';
        $data['pageTitle'] = 'BARANG KETINGGALAN';
        $data['user'] = $this->session->userdata('name');

        $this->load->view('TEMPLATE/A_header', $data);
        $this->load->view('ADMIN/Ketinggalan/list');
        $this->load->view('ADMIN/Ketinggalan/list_script');
        $this->load->view('ADMIN/Ketinggalan/modal');
        $this->load->view('ADMIN/Ketinggalan/modal_script');
        $this->load->view('TEMPLATE/A_footer');
    }

    public function loadData()
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
				<thead class="thead-light">
					<tr>
						<th>BARANG</th>
						<th>LOKASI</th>
						<th>TANGGAL</th>
						<th>JAM</th>
						<th colspan="2">ACTION</th>
                    </tr>
                </thead>

        ';

        // DATA
        $data = $this->mKetinggalan->loadData($query);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
                <tbody>
                    <tr>
                        <td>' . $row->nama_barang . '</td>
                        <td>' . $row->lokasi . '</td>
                        <td>' . $row->tanggal . '</td>
                        <td>' . $row->jam . '</td>

                        <td>
                            <button
                                class="btn btn-primary fas fa-eye"
                                title="DETAIL" href="#modal-detail-ketinggalan" data-toggle="modal"
                                data-btn-show-modal-detail-row-id="' . $row->id . '">
                            </button>
                        </td>

                        <td>
                            <button
                                class="btn btn-danger fas fa-trash-alt"
                                title="DELETE" href="#modal-delete-ketinggalan" data-toggle="modal"
                                data-btn-show-modal-delete-info="' . $row->tanggal . ', Kelas : ' . $row->nama_barang . '"
                                data-btn-show-modal-delete-row-id="' . $row->id . '">
                            </button>
                        </td>
                    </tr>
                </tbody> ';
            }
        } else {
            $output .= '
                <tbody>
                    <tr>
                        <td colspan="6">Data Tidak Ditemukan!</td>
                    </tr>
                </tbody> ';
        }

        $output .= '
            </table>
        ';

        echo $output;
    }

    // public function showForm()
    // {

    //     $data['title'] = "FORM KETINGGALAN";

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('Ketinggalan/form');
    //     $this->load->view('Ketinggalan/form_script');
    //     $this->load->view('templates/footer');
    // }

    public function addItem()
    {
        $queryResult = $this->mKetinggalan->addItem();

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
        redirect('cKetinggalan/showForm');
    }

    public function getItem()
    {
        $id = $_POST['rowID'];

        $data['Title'] = 'DETAIL KETINGGALAN';
        $data['Item'] = $this->mKetinggalan->getItem($id);

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
        $data['jenisLayanan'] = 'KETINGGALAN';
        $data['filterBy'] = $filterBy . ' @ ' . $filterBy_Value; // Lokasi : Lab Komputer 1
        $data['padaWaktu'] = $timeLine . ' @ ' . $timeLine_Value; // Bulan : 2019-02 | Tahun = 2019

        // TABLE FIELDS
        $data['tableFields'] = [
            'pdf' => [
                ['Name' => 'NO', 'Width' => '6%'],
                ['Name' => 'BARANG', 'Width' => '20%'],
                ['Name' => 'LOKASI', 'Width' => '14%'],
                ['Name' => 'KETERANGAN', 'Width' => '36%'],
                ['Name' => 'TANGGAL', 'Width' => '24%']
            ],
            'xls' => [
                ['Name' => 'NO', 'CellPos' => 'A10', 'ColPos' => 'A', 'ColWidth' => '4'],
                ['Name' => 'BARANG', 'CellPos' => 'B10', 'ColPos' => 'B', 'ColWidth' => '20'],
                ['Name' => 'LOKASI', 'CellPos' => 'C10', 'ColPos' => 'C', 'ColWidth' => '20'],
                ['Name' => 'KETERANGAN', 'CellPos' => 'D10', 'ColPos' => 'D', 'ColWidth' => '50'],
                ['Name' => 'TANGGAL', 'CellPos' => 'E10', 'ColPos' => 'E', 'ColWidth' => '20'],
            ]
        ];

        // TABLE DATA
        $queryResult = $this->mKetinggalan->getExportData($filterBy, $filterBy_Value, $timeLine, $timeLine_Value);

        $tableData = $mode == 'pdf' ? '' : [];

        // For XLS Only
        $colPos = [];
        $charStart = 'A'; // Col Start Init
        $charLen = 5;
        for ($i = 0; $i < $charLen; $i++) array_push($colPos, $charStart++);
        $rowPos = 11; // Row Start Init

        $i = 1;
        foreach ($queryResult as $dt) {

            if ($mode == 'pdf') {
                $tableData .= '
                <tr  bgcolor="#fff" color="#000">
                    <td align="center">' . $i++ . '</td>
                    <td>' . $dt['Barang'] . '</td>
                    <td>' . $dt['Lokasi'] . '</td>
                    <td>' . $dt['Keterangan'] . '</td>
                    <td>' . $dt['Tanggal'] . '</td>
                </tr>';
            } else {
                array_push($tableData, [
                    'colPos' => $colPos,
                    'rowPos' => $rowPos,
                    'contentData' => [
                        $i++,
                        $dt['Barang'],
                        $dt['Lokasi'],
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
