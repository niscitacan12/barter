<?php

class Super_model extends CI_Model
{
    // Menampilkan jumlah admin
    public function get_admin_count()
    {
        $this->db->where('role', 'admin');
        $query = $this->db->get('user');
        return $query->num_rows();
    }

    // Menampilkan jumlah user
    public function get_user_count()
    {
        $this->db->where('role', 'user');
        $query = $this->db->get('user');
        return $query->num_rows();
    }

    // Menampilkan role user
    public function get_user()
    {
        $this->db->where('role', 'user');
        $query = $this->db->get('user');
        return $query->result();
    }

    // Mendapatkan semua data dari tabel tertentu
    function get_data($table){
        return $this->db->get($table);
    }

    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getOrganisasiId($id_admin) {
        // Mengambil data organisasi dari basis data berdasarkan ID admin
        $this->db->where('id_admin', $id_admin);
        $query = $this->db->get('organisasi');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); // Mengembalikan array kosong jika tidak ada data yang ditemukan
        }
    }
}
?>