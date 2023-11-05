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

    // Menampilkan role admin
    public function get_admin()
    {
        $this->db->where('role', 'admin');
        $query = $this->db->get('user');
        return $query->result();
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
}
?>