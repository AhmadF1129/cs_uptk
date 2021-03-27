<?php
defined('BASEPATH') or exit('No direct script access allowed');
include($_SERVER['DOCUMENT_ROOT'] . '/cs_uptk/application/helpers/ChromePhp.php');

class cHistory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ADMIN/mHistory');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
    }

    // ---------------------------------------------------------
    // ADMIN
    // ---------------------------------------------------------
    public function index()
    {
        $data['title'] = 'ADMIN PAGE';
        $data['pageTitle'] = 'HISTORY';
        $data['user'] = $this->session->userdata('name');

        $this->load->view('TEMPLATE/A_header', $data);
        $this->load->view('ADMIN/History/list');
        $this->load->view('ADMIN/History/list_script');
        $this->load->view('ADMIN/History/modal');
        $this->load->view('ADMIN/History/modal_script');
        $this->load->view('TEMPLATE/A_footer', $data);
    }

    public function loadData()
    {
        $query = '';
        $output = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }

        // HEADER
        $output .= '
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>TANGGAL</th>
                            <th>RUANGAN</th>
                            <th>KELAS</th>
                            <th colspan="2">ACTION</th>
                        </tr>
                    </thead>';

        // DATA
        $data = $this->mHistory->loadData($query);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '<tbody>
                                <tr>
                                    <td>' . $row->tanggal . '</td>
                                    <td>' . $row->ruangan_name . '</td>
                                    <td>' . $row->kelas . '</td>

                                    <td>
                                        <button
                                            class="btn btn-primary fas fa-eye"
                                            title="DETAIL" href="#modal-detail-history" data-toggle="modal"
                                            data-btn-show-modal-detail-row-id="' . $row->id . '">
                                        </button>
                                    </td>

                                    <td>
                                        <button
                                            class="btn btn-danger fas fa-trash-alt"
                                            title="DELETE" href="#modal-delete-history" data-toggle="modal"
                                            data-btn-show-modal-delete-info="' . $row->tanggal . ', Kelas : ' . $row->kelas . '"
                                            data-btn-show-modal-delete-row-id="' . $row->id . '">
                                        </button>
                                    </td>
                                </tr>
                            </tbody>';
            }
        } else {
            $output .= '
                        <tbody>
                            <tr>
                                <td colspan="12">Data Tidak Ditemukan!!</td>
                            </tr>
                        </tbody>';
        }
        $output .= '
                </table>
                </div>';

        echo $output;
    }

    public function getItemByID()
    {
        $data['item'] = $this->mHistory->getItemByID();

        echo json_encode($data);
    }

    public function deleteItem()
    {
        $queryResult = $this->mHistory->deleteItem();

        // CHECK QUERY RESULT
        $msg = '';
        $alertClass = '';
        if ($queryResult) {
            $msg = 'DATA BERHASIL DIHAPUS !';
            $alertClass = 'alert alert-success page-alert';
        } else {
            $msg = 'DATA TIDAK BERHASIL DIHAPUS !';
            $alertClass = 'alert alert-danger page-alert';
        }
        $this->session->set_flashdata('page-flash', '<div class="' . $alertClass . '" role="alert">' . $msg . '</div>');
        redirect('ADMIN/cHistory');
    }

    public function getExportData()
    {
        // GET POST REQUEST
        $mode = $_POST['checkMode']; // Export Format => pdf | xls

        $filterBy  = $_POST['whereFilterBy']; // jurusan_id | ruangan_id
        $filterBy_Value = $_POST['valueFilterBy'];
        $filterBy_Info_Name  = $_POST['filterBy_Info_Name']; // Jurusan | Ruangan
        $filterBy_Info_Value = $_POST['filterBy_Info_Value'];

        $timeLine = $_POST['whereTimeLine'];  // Bulan | Tahun
        $timeLine_Value = $_POST['valueTimeLine'];

        // PAGE INFO
        $data['jenisLayanan'] = 'RIWAYAT PEMAKAIAN LAB';
        $data['filterBy'] = $filterBy_Info_Name . ' @ ' . $filterBy_Info_Value; // Lokasi : Lab Komputer 1
        $data['padaWaktu'] = $timeLine . ' @ ' . $timeLine_Value; // Bulan : 2019-02 | Tahun = 2019

        // TABLE FIELDS
        $data['tableFields'] = [
            'pdf' => [
                ['Name' => 'NO', 'Width' => '3%'],
                ['Name' => 'JURUSAN', 'Width' => '10%'],
                ['Name' => 'PRODI', 'Width' => '5%'],
                ['Name' => 'KELAS', 'Width' => '7%'],
                ['Name' => 'RUANGAN', 'Width' => '10%'],
                ['Name' => 'DOSEN', 'Width' => '10%'],
                ['Name' => 'MATA KULIAH', 'Width' => '10%'],
                ['Name' => 'KONDISI AWAL', 'Width' => '10%'],
                ['Name' => 'KONDISI AKHIR', 'Width' => '10%'],
                ['Name' => 'HARI', 'Width' => '5%'],
                ['Name' => 'TANGGAL', 'Width' => '8%'],
                ['Name' => 'JAM MASUK', 'Width' => '6%'],
                ['Name' => 'JAM KELUAR', 'Width' => '6%'],
            ],
            'xls' => [
                ['Name' => 'NO', 'CellPos' => 'A10', 'ColPos' => 'A', 'ColWidth' => '4'],
                ['Name' => 'JURUSAN', 'CellPos' => 'B10', 'ColPos' => 'B', 'ColWidth' => '20'],
                ['Name' => 'PROGRAM STUDI', 'CellPos' => 'C10', 'ColPos' => 'C', 'ColWidth' => '35'],
                ['Name' => 'KELAS', 'CellPos' => 'D10', 'ColPos' => 'D', 'ColWidth' => '15'],
                ['Name' => 'RUANGAN', 'CellPos' => 'E10', 'ColPos' => 'E', 'ColWidth' => '20'],
                ['Name' => 'DOSEN', 'CellPos' => 'F10', 'ColPos' => 'F', 'ColWidth' => '15'],
                ['Name' => 'MATA KULIAH', 'CellPos' => 'G10', 'ColPos' => 'G', 'ColWidth' => '35'],
                ['Name' => 'KONDISI AWAL', 'CellPos' => 'H10', 'ColPos' => 'H', 'ColWidth' => '35'],
                ['Name' => 'KONDISI AKHIR', 'CellPos' => 'I10', 'ColPos' => 'I', 'ColWidth' => '35'],
                ['Name' => 'HARI', 'CellPos' => 'J10', 'ColPos' => 'J', 'ColWidth' => '15'],
                ['Name' => 'TANGGAL', 'CellPos' => 'K10', 'ColPos' => 'K', 'ColWidth' => '20'],
                ['Name' => 'JAM MASUK', 'CellPos' => 'L10', 'ColPos' => 'L', 'ColWidth' => '25'],
                ['Name' => 'JAM KELUAR', 'CellPos' => 'M10', 'ColPos' => 'M', 'ColWidth' => '25']
            ]
        ];

        // TABLE DATA
        $queryResult = $this->mHistory->getExportData($filterBy, $filterBy_Value, $timeLine, $timeLine_Value);

        $tableData = $mode == 'pdf' ? '' : [];

        // For XLS Init Only
        if ($mode == 'xls') {
            $colPos = [];
            $charStart = 'A'; // Column Start Init
            $charLen = count($data['tableFields']['xls']); // Qty of Column
            for ($i = 0; $i < $charLen; $i++) array_push($colPos, $charStart++);
            $rowPos = 11; // Row Start Init
        }

        $i = 1;
        foreach ($queryResult as $dt) {
            if ($mode == 'pdf') {
                $tableData .= '
                <tr  bgcolor="#fff" color="#000">
                    <td align="center">' . $i++ . '</td>
                    <td>' . $dt['jurusan_name'] . '</td>
                    <td>' . $dt['prodi_code'] . '</td>
                    <td>' . $dt['kelas'] . '</td>
                    <td>' . $dt['ruangan_name'] . '</td>
                    <td>' . $dt['dosen_name'] . '</td>
                    <td>' . $dt['mata_kuliah'] . '</td>
                    <td>' . $dt['kondisi_awal'] . '</td>
                    <td>' . $dt['kondisi_akhir'] . '</td>
                    <td>' . $dt['hari'] . '</td>
                    <td>' . $dt['tanggal'] . '</td>
                    <td>' . $dt['jam_masuk'] . '</td>
                    <td>' . $dt['jam_keluar'] . '</td>
                </tr>';
            } else {
                array_push($tableData, [
                    'colPos' => $colPos,
                    'rowPos' => $rowPos,
                    'contentData' => [
                        $i++,
                        $dt['jurusan_name'],
                        $dt['prodi_code'],
                        $dt['kelas'],
                        $dt['ruangan_name'],
                        $dt['dosen_name'],
                        $dt['mata_kuliah'],
                        $dt['kondisi_awal'],
                        $dt['kondisi_akhir'],
                        $dt['hari'],
                        date(
                            'j F Y',
                            strtotime($dt['tanggal'])
                        ),
                        $dt['jam_masuk'],
                        $dt['jam_keluar'],
                    ]
                ]);
            }
        }
        $data['tableData'] = $tableData;

        // SEND RESPONSE BACK
        echo json_encode($data);
    }

    // ---------------------------------------------------------
    // USER
    // ---------------------------------------------------------
    // HISTORY - FORM INPUT
    public function showHistory_FormInput()
    {
        $data['title'] = "FORM INPUT HISTORY";

        $this->load->view('TEMPLATE/header', $data);
        $this->load->view('USER/History/form');
        $this->load->view('USER/History/form_script');
        $this->load->view('TEMPLATE/footer');
    }

    // HISTORY - ADD - INIT VERIFIKASI DAN JAM MASUK (HISTORY PEMAKAIAN) => FROM LOGIN
    public function addItem_initHistoryPemakaian_FromLogin()
    {
        $queryResult = $this->mHistory->addItem_initHistoryPemakaian_FromLogin();

        $flashOn = '';
        $msg = '';
        $alertClass = '';
        $redirect = '';
        if ($queryResult) {
            $flashOn = 'history-form-page-flash';
            $msg = 'HAI <strong class="text-danger">' . strtoupper($this->session->userdata('name')) . '</strong>, SILAHKAN <strong class="text-danger">INPUT DATA</strong> SEBELUM MENGGUNAKAN LAB !!';
            $alertClass = 'alert alert-success history-form-page-flash';
            $redirect = 'ADMIN/cHistory/showHistory_FormInput';
        } else {
            $flashOn = 'login-page-flash';
            $msg = "[ SERVER ERROR ] LOGIN GAGAL !!";
            $alertClass = 'alert alert-danger login-page-flash';
            $redirect = 'cLogin';
        }

        $this->session->set_flashdata($flashOn, '<div class="' . $alertClass . '" role="alert">' . $msg . '</div>');
        redirect($redirect);
    }

    // HISTORY - DASHBOARD
    public function showHistory_Dashboard()
    {
        $data['title'] = "DASHBOARD HISTORY";
        // $data['img'] = $this->mHistory->getAllImg();

        $this->load->view('TEMPLATE/header', $data);
        $this->load->view('USER/History/dashboard');
        $this->load->view('USER/History/modal');
        $this->load->view('USER/History/modal_script');
        $this->load->view('TEMPLATE/footer');
    }

    // HISTORY - UPDATE - SET VERIFIKASI DAN JAM KELUAR (HISTORY PEMAKAIAN) => FROM HISTORY PEMAKAIAN | FROM LOGOUT
    public function editItem_updateHistoryPemakaian()
    {
        $flagFrom = $_GET['flagFrom'];

        $queryResult = $this->mHistory->editItem_updateHistoryPemakaian($flagFrom);

        $flashOn = '';
        $msg = '';
        $alertClass = '';
        $redirect = '';
        if ($flagFrom == 'fromHistoryPemakaian') { // fromHistoryPemakaian
            if ($queryResult) {
                $flashOn = 'history-dashboard-page-flash';
                $msg = 'HAI <strong class="text-danger">' . strtoupper($this->session->userdata('name')) . '</strong>, DATA BERHASIL DISIMPAN, SILAHKAN <strong class="text-danger">LOGOUT</strong> BILA TELAH SELESAI MENGGUNAKAN LAB !';
                $alertClass = 'alert alert-success history-dashboard-page-flash';
                $redirect = 'ADMIN/cHistory/showHistory_Dashboard';
            } else {
                $flashOn = 'history-form-page-flash';
                $msg = '[ SERVER ERROR ] DATA GAGAL DISIMPAN, SILAHKAN ULANGI <strong class="text-danger">INPUT DATA</strong> PENGGUNAAN LAB ANDA !';
                $alertClass = 'alert alert-danger history-form-page-flash';
                $redirect = 'ADMIN/cHistory/showHistory_FormInput';
            }
        } else { // fromLogout
            if ($queryResult) {
                $flashOn = 'login-page-flash';
                $msg = 'TERIMA KASIH';
                $alertClass = 'alert alert-success login-page-flash';
                $redirect = 'cLogin/logout';
            } else {
                $flashOn = 'history-dashboard-page-flash';
                $msg = '[ SERVER ERROR ] DATA GAGAL DISIMPAN, SILAHKAN ULANGI <strong class="text-danger">INPUT DATA</strong> PENGGUNAAN LAB ANDA !';
                $alertClass = 'alert alert-danger history-dashboard-page-flash';
                $redirect = 'ADMIN/cHistory/showHistory_Dashboard';
            }
        }
        $this->session->set_flashdata($flashOn, '<div class="' . $alertClass . '" role="alert">' . $msg . '</div>');
        redirect($redirect);
    }
}
