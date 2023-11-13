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

    public function get_admin_by_id($id_admin)
    {
        // Ambil data admin dari database berdasarkan ID
        $query = $this->db->get_where('admin', ['id_admin' => $id_admin]);

        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris data
        } else {
            return null; // Return null jika tidak menemukan data
        }
    }

    public function getAdminById($id_admin)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id_admin', $id_admin);
        $query = $this->db->get();

        return $query->row();
    }

    public function getOrganisasiById($id_organisasi)
    {
        $this->db->select('*');
        $this->db->from('organisasi');
        $this->db->where('id_organisasi', $id_organisasi);
        $query = $this->db->get();

        return $query->row();
    }

    public function update_organisasi($id_organisasi, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_organisasi', $id_organisasi);
        $this->db->update('organisasi', $data);
    }

    public function update_admin($id_admin, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin', $data);
    }

    // Menampilkan role user
    public function get_user()
    {
        $this->db->where('role', 'user');
        $query = $this->db->get('user');
        return $query->result();
    }

    // Mendapatkan semua data dari tabel tertentu
    function get_data($table)
    {
        return $this->db->get($table);
    }

    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getOrganisasiId($id_admin)
    {
        // Mengambil data organisasi dari basis data berdasarkan ID admin
        $this->db->where('id_admin', $id_admin);
        $query = $this->db->get('organisasi');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return []; // Mengembalikan array kosong jika tidak ada data yang ditemukan
        }
    }

    public function hapus_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        $this->db->delete('admin');
    }
    public function hapus_organisasi($id_organisasi)
    {
        $this->db->where('id_organisasi', $id_organisasi);
        $this->db->delete('organisasi');
    }
}
?>