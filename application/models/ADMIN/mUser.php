<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mUser extends CI_Model
{
    public function loadData($query)
    {
        $this->db->select('a.*, b.role as role_name, c.name as jurusan_name, d.name as prodi_name');
        $this->db->from('tb_users a');
        $this->db->join('m_role b', 'a.role_id = b.id');
        $this->db->join('m_jurusan c', 'a.jurusan_id = c.id');
        $this->db->join('m_program_studi d', 'a.prodi_id = d.id');
        if ($query != '') {
            $this->db->like('b.role', $query);
            $this->db->or_like('a.username', $query);
            $this->db->or_like('a.name', $query);
            $this->db->or_like('a.email', $query);
            $this->db->or_like('a.phone_no', $query);
            $this->db->or_like('a.nim', $query);
            $this->db->or_like('a.kelas', $query);
            $this->db->or_like('c.name', $query);
            $this->db->or_like('d.name', $query);
        }
        $this->db->order_by('a.id', 'DESC');
        return $this->db->get();
    }

    public function addItem()
    {
        $role_id = $this->input->post('cmb-role');
        $data = [];
        if ($role_id == 1) {
            $data = [
                'role_id' => $this->input->post('cmb-role'),
                'username' => $this->input->post('txt-username'),
                'password' => password_hash($this->input->post('txt-password'), PASSWORD_DEFAULT),
                'name' => $this->input->post('txt-name'),
                'email' => strval($this->input->post('txt-email')),
                'phone_no' => $this->input->post('txt-phone-no'),
                'nim' => 0,
                'jurusan_id' => 1,
                'prodi_id' => 1,
                'kelas' => '-',
                'is_active' => 1
            ];
        } else {
            $data = [
                'role_id' => $this->input->post('cmb-role'),
                'username' => $this->input->post('txt-username'),
                'password' => password_hash($this->input->post('txt-password'), PASSWORD_DEFAULT),
                'name' => $this->input->post('txt-name'),
                'email' => strval($this->input->post('txt-email')),
                'phone_no' => $this->input->post('txt-phone-no'),
                'nim' => $this->input->post('txt-nim'),
                'jurusan_id' => $this->input->post('cmb-jurusan'),
                'prodi_id' => $this->input->post('cmb-prodi'),
                'kelas' => $this->input->post('txt-kelas'),
                'is_active' => 1
            ];
        }

        return $this->db->insert('tb_users', $data);
    }

    public function editItem()
    {
        $role_id = $this->input->post('cmb-role');
        $data = [];
        if ($role_id == 1) {
            $data = [
                'username' => $this->input->post('txt-username'),
                'name' => $this->input->post('txt-name'),
                'email' => strval($this->input->post('txt-email')),
                'phone_no' => $this->input->post('txt-phone-no'),
            ];
        } else {
            $data = [
                'username' => $this->input->post('txt-username'),
                'name' => $this->input->post('txt-name'),
                'email' => strval($this->input->post('txt-email')),
                'phone_no' => $this->input->post('txt-phone-no'),
                'nim' => $this->input->post('txt-nim'),
                'jurusan_id' => $this->input->post('cmb-jurusan'),
                'prodi_id' => $this->input->post('cmb-prodi'),
                'kelas' => $this->input->post('txt-kelas'),
            ];
        }

        return $this->db->where('id', $this->input->get('rowID'))->update('tb_users', $data);
    }

    public function getItemByID()
    {
        $query = "SELECT a.*,
                         b.role as role_name,
                         c.name as jurusan_name,
                         d.name as prodi_name
                    FROM tb_users `a`
                    JOIN m_role `b`
                      ON a.role_id = b.id
                    JOIN m_jurusan `c`
                      ON a.jurusan_id = c.id
                    JOIN m_program_studi `d`
                      ON a.prodi_id = d.id
                   WHERE a.id = " . $this->input->post('rowID');

        return $this->db->query($query)->row_array();
    }

    public function deleteItem()
    {
        $rowID = $this->input->get('rowID');

        return $this->db->delete('tb_users', ['id' => $rowID]);
    }

    public function changePassword()
    {
        $rowID = $this->input->get('rowID');

        $data = ['password' => password_hash($this->input->post('repeat-password'), PASSWORD_DEFAULT)];
        return $this->db->where('id', $rowID)->update('tb_users', $data);
    }
}
