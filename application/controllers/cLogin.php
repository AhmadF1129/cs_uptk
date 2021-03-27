<?php
defined('BASEPATH') or exit('No direct script access allowed');
include($_SERVER['DOCUMENT_ROOT'] . '/cs_uptk/application/helpers/ChromePhp.php');

class cLogin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('mLogin');
    $this->load->helper(array('url', 'form'));
  }

  public function index()
  {
    $data['title'] = "LOGIN PAGE";

    $this->load->view('TEMPLATE/header', $data);
    $this->load->view('login');
    $this->load->view('TEMPLATE/footer');
  }

  public function login()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    // Mengambil data dalam sebaris
    $cek = $this->mLogin->getUserData($username)[0];

    // Cek Is Available
    if ($cek) {
      $data = [
        'id'            => $cek['id'],
        'role_id'       => $cek['role_id'],
        'username'      => $cek['username'],
        'name'          => $cek['name'],
        'jurusan_id'    => $cek['jurusan_id'],
        'prodi_id'      => $cek['prodi_id'],
        'kelas'         => $cek['kelas']
      ];

      $flashOn = '';
      $msg = '';
      $alertClass = '';
      $redirect = '';

      // Cek Is Active
      if ($cek['is_active'] == 1) {

        if (password_verify($password, $cek['password'])) {
          $this->session->set_userdata($data);

          // Cek Role
          if ($cek['role_id'] == 1) {
            $flashOn = 'admin-page-flash';
            $msg = 'HAI <strong>' . strtoupper($cek['name']) . '</strong>, WELCOME ON ADMIN PAGE !!';
            $alertClass = 'alert alert-success admin-page-flash';
            $redirect = 'ADMIN/cUser';
          } else {
            // ADD - INIT VERIFIKASI DAN JAM MASUK (HISTORY PEMAKAIAN) => FROM LOGIN
            redirect('ADMIN/cHistory/addItem_initHistoryPemakaian_FromLogin');
          }
        } else {
          $flashOn = 'login-page-flash';
          $msg = 'PASSWORD SALAH !!';
          $alertClass = 'alert alert-danger login-page-flash';
          $redirect = 'cLogin';
        }
      } else {
        $flashOn = 'login-page-flash';
        $msg = 'AKUN TIDAK AKTIF !!';
        $alertClass = 'alert alert-danger login-page-flash';
        $redirect = 'cLogin';
      }
    } else {
      $flashOn = 'login-page-flash';
      $msg = 'AKUN TIDAK DITEMUKAN !!';
      $alertClass = 'alert alert-danger login-page-flash';
      $redirect = 'cLogin';
    }

    $this->session->set_flashdata($flashOn, '<div class="' . $alertClass . '" role="alert">' . $msg . '</div>');
    redirect($redirect);
  }

  public function logout()
  {
    // Clear Session - User Data
    $this->session->unset_userdata;

    $flashOn = 'login-page-flash';
    $msg = 'ANDA BERHASIL LOGOUT !';
    $alertClass = 'alert alert-success login-page-flash';
    $redirect = 'cLogin';

    $this->session->set_flashdata($flashOn, '<div class="' . $alertClass . ' alert-dismissible" role="alert">' . $msg . '</div>');
    redirect($redirect);
  }
}
