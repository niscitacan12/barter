<?php

class M_model extends CI_Model
{
    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    public function addAdmin($data)
    {
        $this->db->insert('admin', $data);
    }

    // Mendapatkan semua data dari tabel tertentu
    function get_data($table)
    {
        return $this->db->get($table);
    }

    public function create_superadmin(
        $email,
        $username,
        $nama_depan,
        $nama_belakang,
        $password_hash
    ) {
        // Data yang akan disimpan dalam tabel superadmin
        $data = [
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'password' => $password_hash,
            // Kolom lain yang Anda perlukan
        ];

        // Simpan data ke dalam tabel superadmin
        $this->db->insert('superadmin', $data);
    }

    public function get_user_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('superadmin'); // Gantilah 'superadmin' sesuai dengan tabel yang sesuai
        return $query->row(); // Mengembalikan satu baris hasil query
    }
}
?>