<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mHistory extends CI_Model
{

    // ---------------------------------------------------------
    // ADMIN
    // ---------------------------------------------------------
    public function loadData($query)
    {
        $this->db->select('a.*, b.name as jurusan_name, c.name as prodi_name, d.name as ruangan_name, e.name as dosen_name');
        $this->db->from('tb_lab_history a');
        $this->db->join('m_jurusan b', 'a.jurusan_id = b.id');
        $this->db->join('m_program_studi c', 'a.prodi_id = c.id');
        $this->db->join('m_ruangan d', 'a.ruangan_id = d.id');
        $this->db->join('m_dosen e', 'a.dosen_id = e.id');
        if ($query != '') {
            $this->db->like('a.kelas', $query);
            $this->db->or_like('a.mata_kuliah', $query);
            $this->db->or_like('a.kondisi_awal', $query);
            $this->db->or_like('a.kondisi_akhir', $query);
            $this->db->or_like('a.hari', $query);
            $this->db->or_like('a.tanggal', $query);
            $this->db->or_like('a.jam_masuk', $query);
            $this->db->or_like('a.jam_keluar', $query);
            $this->db->or_like('b.name', $query);
            $this->db->or_like('c.name', $query);
            $this->db->or_like('d.name', $query);
            $this->db->or_like('e.name', $query);
        }
        $this->db->order_by('a.id', 'DESC');
        return $this->db->get();
    }

    public function getItemByID()
    {
        $query = "SELECT a.*,
                         b.name as jurusan_name,
                         c.name as prodi_name,
                         d.name as dosen_name
                    FROM tb_lab_history `a`
                    JOIN m_jurusan `b`
                      ON a.jurusan_id = b.id
                    JOIN m_program_studi `c`
                      ON a.prodi_id = c.id
                    JOIN m_dosen `d`
                      ON a.dosen_id = d.id
                   WHERE a.id = " . $this->input->post('rowID');

        return $this->db->query($query)->row_array();
    }

    public function deleteItem()
    {
        $rowID = $this->input->get('rowID');

        return $this->db->delete('tb_lab_history', ['id' => $rowID]);
    }

    public function getExportData($filterBy, $filterBy_Value, $timeLine, $timeLine_Value)
    {
        $query = '';
        if ($timeLine == 'Bulan') {
            $query =
                "SELECT a.*,
                        b.name as jurusan_name,
                        c.name as prodi_name,
                        c.code as prodi_code,
                        d.name as ruangan_name,
                        e.name as dosen_name
                FROM tb_lab_history `a`
                JOIN m_jurusan `b`
                    ON a.jurusan_id = b.id
                JOIN m_program_studi `c`
                    ON a.prodi_id = c.id
                JOIN m_ruangan `d`
                    ON a.ruangan_id = d.id
                JOIN m_dosen `e`
                    ON a.dosen_id = e.id
                WHERE a.$filterBy = '$filterBy_Value' AND SUBSTR(a.tanggal, 5, 6) = '$timeLine_Value'";
        } else {
            $query =
                "SELECT a.*,
                        b.name as jurusan_name,
                        c.name as prodi_name,
                        c.code as prodi_code,
                        d.name as ruangan_name,
                        e.name as dosen_name
                FROM tb_lab_history `a`
                JOIN m_jurusan `b`
                    ON a.jurusan_id = b.id
                JOIN m_program_studi `c`
                    ON a.prodi_id = c.id
                JOIN m_ruangan `d`
                    ON a.ruangan_id = d.id
                JOIN m_dosen `e`
                    ON a.dosen_id = e.id
                WHERE a.$filterBy = '$filterBy_Value' AND SUBSTR(a.tanggal, 1, 4) = '$timeLine_Value'";
        }

        return $this->db->query($query)->result_array();
    }

    // ---------------------------------------------------------
    // USER
    // ---------------------------------------------------------
    // HISTORY - ADD - INIT VERIFIKASI DAN JAM MASUK (HISTORY PEMAKAIAN) => FROM LOGIN
    public function addItem_initHistoryPemakaian_FromLogin()
    {
        $arrHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
        $hari = date('w');

        $tanggal = date('Y-m-d');
        $jam = gmdate("H:i:s", time() + 60 * 60 * 7);

        // Insert Data    
        $data = [
            'jurusan_id' => $this->session->userdata('jurusan_id'),
            'prodi_id' => $this->session->userdata('prodi_id'),
            'kelas' => $this->session->userdata('kelas'),
            'hari' => $arrHari[$hari],
            'tanggal' => $tanggal,
            'jam_masuk' => $jam
        ];

        if ($this->db->insert('tb_lab_history', $data)) {
            return true;
        }
        return false;
    }

    // HISTORY - UPDATE - SET VERIFIKASI DAN JAM KELUAR (HISTORY PEMAKAIAN) => FROM HISTORY PEMAKAIAN | FROM LOGOUT
    public function editItem_updateHistoryPemakaian($flagFrom) // $flagFrom = fromHistoryPemakaian | fromLogout
    {
        $kelas = $this->session->userdata('kelas');
        $query = "SELECT MAX(id) AS id FROM tb_lab_history WHERE kelas = '" . $kelas . "'";
        $lastData = $this->db->query($query)->result_array()[0];

        // Update Data
        $data = [];
        if ($flagFrom == 'fromHistoryPemakaian') { // fromHistoryPemakaian
            $data = [
                'ruangan_id'    => $this->input->post('cmb-ruangan'),
                'dosen_id'      => $this->input->post('cmb-dosen'),
                'mata_kuliah'   => $this->input->post('txt-matkul'),
                'kondisi_awal'  => $this->input->post('cmb-kondisi-awal')
            ];
        } else { // fromLogout
            $jam = gmdate("H:i:s", time() + 60 * 60 * 7);
            $data = [
                'kondisi_akhir' => $this->input->post('cmb-kondisi-akhir'),
                'jam_keluar' => $jam
            ];
        }

        if ($this->db->where('id', $lastData['id'])->update('tb_lab_history', $data)) {
            return true;
        }
        return false;
    }
}
