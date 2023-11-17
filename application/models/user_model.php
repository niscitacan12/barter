<?php

class User_model extends CI_Model
{
    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function set_flash_data($key, $value)
    {
        $this->session->set_flashdata($key, $value);
    }

    // Metode untuk mengambil data absensi
    public function GetDataAbsensi($bulan = null, $tanggal = null, $tahun = null) {
        $this->db->select('*');
        $this->db->from('absensi');
    
        // Tambahkan filter berdasarkan bulan, tanggal, dan tahun jika ada
        if ($bulan !== null) {
            $this->db->where('MONTH(tanggal_absen)', $bulan);
        }
        if ($tanggal !== null) {
            $this->db->where('DATE(tanggal_absen)', $tanggal);
        }
        if ($tahun !== null) {
            $this->db->where('YEAR(tanggal_absen)', $tahun);
        }
    
        $query = $this->db->get();
    
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
}
?>