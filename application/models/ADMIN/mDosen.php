<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mDosen extends CI_Model
{
    public function loadData($query)
    {
        $this->db->select('*');
        $this->db->from('m_dosen');
        if ($query != '') {
            $this->db->like('name', $query);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }

    public function addItem()
    {
        $data = [];
        $data = [
            'name' => $this->input->post('txt-name-dosen')
        ];

        return $this->db->insert('m_dosen', $data);
    }

    public function editItem()
    {
        $data = [];
        $data = [
            'name' => $this->input->post('txt-name-dosen')
        ];

        return $this->db->where('id', $this->input->get('rowID'))->update('m_dosen', $data);
    }

    public function getItemByID()
    {
        $query = "SELECT * FROM m_dosen
                   WHERE id = " . $this->input->post('rowID');

        return $this->db->query($query)->row_array();
    }

    public function deleteItem()
    {
        $rowID = $this->input->get('rowID');

        return $this->db->delete('m_dosen', ['id' => $rowID]);
    }
}
