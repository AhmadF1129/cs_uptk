<?php

class mPengaduan extends CI_Model
{
    public function addItem()
    {
        $data = [

            "Lokasi" => $this->input->post('Lokasi', true),
            "Keterangan" => $this->input->post('Keterangan', true),
            "Kategori" => $this->input->post('Kategori', true),
            "Identitas" => $this->input->post('Identitas'),
            "Tanggal" => gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7),
        ];
        return $this->db->insert('tb_pengaduan', $data);
    }

    public function searchItem($query)
    {
        $this->db->select("*");
        $this->db->from("tb_pengaduan");
        if ($query != '') {
            $this->db->like('Lokasi', $query);
            $this->db->or_like('Keterangan', $query);
            $this->db->or_like('Kategori', $query);
            $this->db->or_like('Identitas', $query);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }

    public function getItem($id)
    {
        return $this->db->select('Keterangan')->get_where('tb_pengaduan', ['id' => $id])->row_array();
    }

    public function getExportData($filterBy, $filterBy_Value, $timeLine, $timeLine_Value)
    {
        $query = '';
        if ($timeLine == 'Bulan') {
            $query = "SELECT * FROM tb_pengaduan WHERE $filterBy = '$filterBy_Value' AND SUBSTR(Tanggal, 1, 7) = '$timeLine_Value'";
        } else {
            $query = "SELECT * FROM tb_pengaduan WHERE $filterBy = '$filterBy_Value' AND SUBSTR(Tanggal, 1, 4) = '$timeLine_Value'";
        }
        $get_data = $this->db->query($query)->result_array();
        return $get_data;
    }
}
