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

    public function get_absensi_data() {
        // Assuming you have a table named 'absensi'
        $query = $this->db->get('absensi');

        // Assuming 'absensi' is the name of the table
        return $query->result(); // This assumes you want to get multiple rows as a result
    }
    public function get_all_user() {
        
        // Replace 'user' with your actual table name
                $query = $this->db->get('user');
        
        return $query->result();
            }

}
?>