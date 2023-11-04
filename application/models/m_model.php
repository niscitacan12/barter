<?php

class M_model extends CI_Model
{
    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data)
    {
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

    public function countData($table)
    {
        return $this->db->count_all($table);
    }

    public function get_user_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('superadmin'); // Gantilah 'superadmin' sesuai dengan tabel yang sesuai
        return $query->row(); // Mengembalikan satu baris hasil query
    }

    public function get_absensi_by_id_admin($id_admin)
    {
        $this->db->where('id_absensi', $id_admin);
        return $this->db->get('absensi');
    }

    public function getUserByID($id)
    {
        $this->db->select('*');
        $this->db->from('superadmin');
        $this->db->where('id_superadmin', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function getAdminOptions() {
        $this->db->select('id_admin, username'); // Sesuaikan kolom yang sesuai
        $query = $this->db->get('admin'); // Gantilah 'admin' dengan nama tabel yang sesuai

        if ($query->num_rows() > 0) {
            $result = $query->result();
            $admin_options = array();

            foreach ($result as $admin) {
                $admin_options[$admin->id_admin] = $admin->username;
            }

            return $admin_options;
        } else {
            return array(); // Kembalikan array kosong jika tidak ada admin
        }
    }


    public function addUser($data) {
        // Simpan data ke dalam tabel "user"
        $this->db->insert('user', $data);

        // Ambil ID user yang baru saja ditambahkan
        $user_id = $this->db->insert_id();

        // Hubungkan user dengan admin berdasarkan ID admin (asumsikan ID admin yang digunakan adalah 1)
        $admin_id = 4; // Gantilah dengan ID admin yang sesuai
        $user_admin_data = array(
            'id_admin' => $admin_id
        );

        $this->db->where('id_user', $user_id);
        $this->db->update('user', $user_admin_data);
    }
}
?>