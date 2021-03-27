<?php
defined('BASEPATH') or exit('No direct script access allowed');
include($_SERVER['DOCUMENT_ROOT'] . '/cs_uptk/application/helpers/ChromePhp.php');

class cUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ADMIN/mUser');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data['title'] = 'ADMIN PAGE';
        $data['pageTitle'] = 'USERS';
        $data['user'] = $this->session->userdata('name');

        $this->load->view('TEMPLATE/A_header', $data);
        $this->load->view('ADMIN/User/list');
        $this->load->view('ADMIN/User/list_script');
        $this->load->view('ADMIN/User/modal');
        $this->load->view('ADMIN/User/modal_script');
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
                            <th>ROLE</th>
                            <th>USERNAME</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th colspan="4">ACTION</th>
                        </tr>
                    </thead>';

        // DATA
        $data = $this->mUser->loadData($query);

        $i = 1;

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
                    <tbody>
                        <tr>
                            <td>' . $i++ . '</td>
                            <td>' . $row->role_name . '</td>
                            <td>' . $row->username . '</td>
                            <td>' . $row->name . '</td>
                            <td>' . $row->email . '</td>

                            <td>
                                <button
                                    class="btn btn-primary fas fa-eye"
                                    title="DETAIL" href="#modal-detail-user" data-toggle="modal"
                                    data-btn-show-modal-detail-row-id="' . $row->id . '">
                                </button>
                            </td>

                            <td>
                                <button
                                    class="btn btn-warning fas fa-edit"
                                    title="EDIT" href="#modal-add-edit-user" data-toggle="modal"
                                    data-btn-show-modal-mode="EDIT-INIT"
                                    data-btn-show-modal-edit-row-id="' . $row->id . '">
                                </button>
                            </td>

                            <td>
                                <button
                                    class="btn btn-danger fas fa-trash-alt"
                                    title="DELETE" href="#modal-delete-user" data-toggle="modal"
                                    data-btn-show-modal-delete-info="' . $row->name . '"
                                    data-btn-show-modal-delete-row-id="' . $row->id . '">
                                </button>
                            </td>

                            <td>
                                <button
                                    class="btn btn-warning fas fa-address-card"
                                    title="CHANGE PASSWORD" href="#modal-change-password" data-toggle="modal"
                                    data-btn-show-modal-change-password-info="' . $row->name . '"
                                    data-btn-show-modal-change-password-row-id="' . $row->id . '">
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

    public function addItem()
    {
        $queryResult = $this->mUser->addItem();

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
        redirect('ADMIN/cUser');
    }

    public function editItem()
    {
        $queryResult = $this->mUser->editItem();

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
        redirect('ADMIN/cUser');
    }

    public function getItemByID()
    {
        $data['item'] = $this->mUser->getItemByID();

        echo json_encode($data);
    }

    public function deleteItem()
    {
        $queryResult = $this->mUser->deleteItem();

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
        redirect('ADMIN/cUser');
    }

    public function changePassword()
    {
        $queryResult = $this->mUser->changePassword();

        // CHECK QUERY RESULT
        $msg = '';
        $alertClass = '';
        if ($queryResult) {
            $msg = 'PASSWORD BERHASIL DIUBAH !';
            $alertClass = 'alert alert-success page-alert';
        } else {
            $msg = 'PASSWORD TIDAK BERHASIL DIUBAH !';
            $alertClass = 'alert alert-danger page-alert';
        }
        $this->session->set_flashdata('page-flash', '<div class="' . $alertClass . '" role="alert">' . $msg . '</div>');;
        redirect('ADMIN/cUser');
    }
}
