<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mLogin extends CI_Model
{
  public function getUserData($username)
  {
    $query = "SELECT a.*, b.name as jurusan_name, c.name as prodi_name
              FROM tb_users a
              JOIN m_jurusan b
                ON a.jurusan_id = b.id
              JOIN m_program_studi c
                ON a.prodi_id = c.id
              WHERE a.username = '" . $username . "'";
    return $this->db->query($query)->result_array();
  }
}
