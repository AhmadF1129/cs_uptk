<?php

class mKetinggalan extends CI_Model
{
    public function addItem()
    {
        $data = [
            "nama_barang" => $this->input->post('txt-barang'),
            "lokasi" => $this->input->post('txt-lokasi'),
            "keterangan" => $this->input->post('txt-keterangan'),
            "tanggal" => gmdate('Y-m-d H:i:s'),
        ];
        return $this->db->insert('tb_ketinggalan', $data);
    }

    public function loadData($query)
    {
        $this->db->select("*");
        $this->db->from("tb_ketinggalan");
        if ($query != '') {
            $this->db->like('nama_barang', $query);
            $this->db->or_like('lokasi', $query);
            $this->db->or_like('keterangan', $query);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }

    public function getItem($id)
    {
        return $this->db->select('Keterangan')->get_where('tb_ketinggalan', ['id' => $id])->row_array();
    }

    public function getExportData($filterBy, $filterBy_Value, $timeLine, $timeLine_Value)
    {
        $query = '';
        if ($timeLine == 'Bulan') {
            $query = "SELECT * FROM tb_ketinggalan WHERE $filterBy = '$filterBy_Value' AND SUBSTR(Tanggal, 1, 7) = '$timeLine_Value'";
        } else {
            $query = "SELECT * FROM tb_ketinggalan WHERE $filterBy = '$filterBy_Value' AND SUBSTR(Tanggal, 1, 4) = '$timeLine_Value'";
        }

        return $this->db->query($query)->result_array();
    }
}
