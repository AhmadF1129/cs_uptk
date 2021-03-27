<?php
defined('BASEPATH') or exit('No direct script access allowed');
include($_SERVER['DOCUMENT_ROOT'] . '/cs_uptk/application/helpers/ChromePhp.php');

class cDosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ADMIN/mDosen');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'ADMIN PAGE';
        $data['pageTitle'] = 'DOSEN';
        $data['user'] = $this->session->userdata('name');

        $this->load->view('TEMPLATE/A_header', $data);
        $this->load->view('ADMIN/Dosen/list');
        $this->load->view('ADMIN/Dosen/list_script');
        $this->load->view('ADMIN/Dosen/modal');
        $this->load->view('ADMIN/Dosen/modal_script');
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
                            <th>NO</th>
                            <th>DOSEN</th>
                            <th colspan="2">ACTION</th>
                        </tr>
                    </thead>';

        // DATA
        $data = $this->mDosen->loadData($query);

        $i = 1;

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
                    <tbody>
                        <tr>
                            <td>' . $i++ . '</td>
                            <td>' . $row->name . '</td>

                            <td>
                                <button
                                    class="btn btn-warning fas fa-edit"
                                    title="EDIT" href="#modal-add-edit-dosen" data-toggle="modal"
                                    data-btn-show-modal-mode="EDIT-INIT"
                                    data-btn-show-modal-edit-row-id="' . $row->id . '">
                                </button>
                            </td>

                            <td>
                                <button
                                    class="btn btn-danger fas fa-trash-alt"
                                    title="DELETE" href="#modal-delete-dosen" data-toggle="modal"
                                    data-btn-show-modal-delete-info="' . $row->name . '"
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
                            <td colspan="4">Data Tidak Ditemukan!!</td>
                        </tr>
                    </tbody>';
        }
        $output .= '
                </table>
                </div>';

        echo $output;
    }

    public function addItem()
    {
        $queryResult = $this->mDosen->addItem();

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
        $this->session->set_flashdata('page-flash', '<div class="' . $alertClass . '" role="alert">' . $msg . '</div>');
        redirect('ADMIN/cDosen');
    }

    public function editItem()
    {
        $queryResult = $this->mDosen->editItem();

        // CHECK QUERY RESULT
        $msg = '';
        $alertClass = '';
        if ($queryResult) {
            $msg = 'DATA BERHASIL DIUBAH !';
            $alertClass = 'alert alert-success page-alert';
        } else {
            $msg = 'DATA TIDAK BERHASIL DIUBAH !';
            $alertClass = 'alert alert-danger page-alert';
        }
        $this->session->set_flashdata('page-flash', '<div class="' . $alertClass . '" role="alert">' . $msg . '</div>');
        redirect('ADMIN/cDosen');
    }

    public function getItemByID()
    {
        $data['item'] = $this->mDosen->getItemByID();

        echo json_encode($data);
    }

    public function deleteItem()
    {
        $queryResult = $this->mDosen->deleteItem();

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
        redirect('ADMIN/cDosen');
    }
}
