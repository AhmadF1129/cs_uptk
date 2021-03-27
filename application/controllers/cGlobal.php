<?php
defined('BASEPATH') or exit('No direct script access allowed');
include($_SERVER['DOCUMENT_ROOT'] . '/cs_uptk/application/helpers/ChromePhp.php');

class cGlobal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mGlobal');
        $this->load->helper(array('url'));
    }

    // ---------------------------------------------------------
    // GENERAL
    // ---------------------------------------------------------
    public function getUser_By_SessionUserID() // FORM - INPUT HISTORY
    {
        $data['item'] = $this->mGlobal->getUser_By_SessionUserID();

        echo json_encode($data);
    }

    // ---------------------------------------------------------
    // ADMIN
    // ---------------------------------------------------------
    public function getAddEditModalInit() // MODAL - ADD EDIT
    {
        $data['btnProcessMode'] = $_POST['btnShowModalMode'] == 'ADD-INIT' ? 'ADD' : 'EDIT';
        $data['title'] = $_POST['btnShowModalMode'] == 'ADD-INIT' ? 'TAMBAH DATA' : 'UBAH DATA';

        $data['allRole'] = $this->mGlobal->getAll_Role();
        $data['allJurusan'] = $this->mGlobal->getAll_Jurusan();

        echo json_encode($data);
    }

    public function getAddEditModalInit_getAllProdiByJurusanID() // MODAL - ADD EDIT
    {
        $JurusanID = $_POST['JurusanID'];

        $data['allProdiByJurusanID'] = $this->mGlobal->getAll_Prody_By_JurusanID($JurusanID);

        echo json_encode($data);
    }

    public function getExportModalInit() // MODAL - EXPORT
    {
        $data['allJurusan'] = $this->mGlobal->getAll_Jurusan();
        $data['allRuangan'] = $this->mGlobal->getAll_Ruangan();

        echo json_encode($data);
    }

    // ---------------------------------------------------------
    // USER
    // ---------------------------------------------------------
    public function getInputHistoryFormInit() // FORM - INPUT HISTORY
    {
        $data['allRuangan'] = $this->mGlobal->getAll_Ruangan();
        $data['allDosen'] = $this->mGlobal->getAll_Dosen();

        echo json_encode($data);
    }
}
