<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mGlobal extends CI_Model
{
    public function getUser_By_SessionUserID()
    {
        $query = "SELECT a.*,
                         b.name as jurusan_name,
                         c.name as prodi_name
                    FROM tb_users `a`
                    JOIN m_jurusan `b`
                      ON a.jurusan_id = b.id
                    JOIN m_program_studi `c`
                      ON a.prodi_id = c.id
                   WHERE a.id = " . $this->input->post('sessionUserID');

        return $this->db->query($query)->row_array();
    }

    public function getAll_Role()
    {
        $query = "SELECT id as role_id, `role` as role_name
                    FROM m_role
                ORDER BY `role` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getAll_Jurusan()
    {
        $query = "SELECT id as jurusan_id, `name` as jurusan_name
                    FROM m_jurusan
                ORDER BY `name` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getAll_Prody_By_JurusanID($JurusanID)
    {
        $query = "SELECT id as prodi_id, `name` as prodi_name
                    FROM m_program_studi
                    WHERE jurusan_id = $JurusanID
                ORDER BY `name` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getAll_Ruangan()
    {
        $query = "SELECT id as ruangan_id, `name` as ruangan_name FROM m_ruangan ORDER BY `name` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getAll_Dosen()
    {
        $query = "SELECT id as dosen_id, `name` as dosen_name FROM m_dosen ORDER BY `name` ASC";

        return $this->db->query($query)->result_array();
    }
}
