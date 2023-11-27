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

    public function update_user($id_user, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $data);
    }

    public function update_admin($id_admin, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin', $data);
    }

    public function update_jabatan($id_jabatan, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_jabatan', $id_jabatan);
        $this->db->update('jabatan', $data);
    }

    public function update_shift($id_shift, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_shift', $id_shift);
        $this->db->update('shift', $data);
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

    public function getJabatanId($id_jabatan)
    {
        $this->db->select('*');
        $this->db->from('jabatan');
        $this->db->where('id_jabatan', $id_jabatan);
        $query = $this->db->get();

        return $query->row();
    }

    public function getShiftId($id_shift)
    {
        $this->db->select('*');
        $this->db->from('shift');
        $this->db->where('id_shift', $id_shift);
        $query = $this->db->get();

        return $query->row();
    }

    public function getUserId($id_user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();

        return $query->row();
    }

    public function hapus_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        $this->db->delete('admin');
    }

    public function hapus_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('user');
    }

    public function hapus_organisasi($id_organisasi)
    {
        $this->db->where('id_organisasi', $id_organisasi);
        $this->db->delete('organisasi');
    }

    public function getUserDetails($user_id)
    {
        $this->db->where('id_user', $user_id); // Sesuaikan kolom yang merepresentasikan ID pengguna
        $query = $this->db->get('user'); // Sesuaikan 'users' dengan nama tabel pengguna

        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris data user
        } else {
            return false; // Mengembalikan false jika tidak ada data ditemukan
        }
    }

    public function getAdminDetails($admin_id)
    {
        $this->db->where('id_admin', $admin_id); // Sesuaikan kolom yang merepresentasikan ID pengguna
        $query = $this->db->get('admin'); // Sesuaikan 'users' dengan nama tabel pengguna

        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris data user
        } else {
            return false; // Mengembalikan false jika tidak ada data ditemukan
        }
    }

    public function getUserData($id)
    {
        // Sesuaikan dengan struktur tabel di database Anda
        $this->db->select('*');
        $this->db->from('user'); // Ganti 'user' sesuai dengan nama tabel Anda
        $this->db->where('id_user', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function hapus_jabatan($id_jabatan)
    {
        $this->db->where('id_jabatan', $id_jabatan);
        $this->db->delete('jabatan');
    }

    public function hapus_shift($id_shift)
    {
        $this->db->where('id_shift', $id_shift);
        $this->db->delete('shift');
    }

    // Menghapus data dari tabel berdasarkan kondisi
    public function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, [$field => $id]);
        return $data;
    }

    public function get_superadmin_data()
    {
        // Replace 'your_superadmin_table' with your actual table name
        $query = $this->db->get('superadmin');
        if (!$query) {
            log_message('error', 'Database Error: ' . $this->db->error());
            return false;
        }
        return $query->row_array();
    }

    // Menampilkan Dan Mengget Data
    public function getOrganisasiData($id)
    {
        // Sesuaikan dengan struktur tabel di database Anda
        $this->db->select('*');
        $this->db->from('organisasi');
        $this->db->where('id_organisasi', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function pagination($table_name, $limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get($table_name);

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function count_all($table_name){
        return $this->db->get($table_name)->num_rows();
    }

    public function getSuperAdminByID($id)
    {
        $this->db->select('*');
        $this->db->from('superadmin');
        $this->db->where('id_superadmin', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($tabel, $data, $where)
    {
        $data = $this->db->update($tabel, $data, $where);
        return $this->db->affected_rows();
    }

    public function getJabatanDetails($id_jabatan)
    {
        // Gantilah 'nama_table' dengan nama tabel yang sesuai di database Anda
        $this->db->where('id_jabatan', $id_jabatan);
        $query = $this->db->get('jabatan'); // Gantilah 'jabatan' dengan nama tabel yang sesuai di database Anda

        // Jika query berhasil dan ada hasil
        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris hasil sebagai objek
        } else {
            return null; // Mengembalikan null jika tidak ada hasil
        }
    }
    public function getShiftDetails($id_shift)
    {
        $this->db->where('id_shift', $id_shift);
        $query = $this->db->get('shift'); // Sesuaikan dengan nama tabel untuk shift pada database Anda

        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris hasil sebagai objek
        } else {
            return null;
        }
    }

    public function get_all_lokasi()
    {
        // Ganti 'lokasi' dengan nama tabel yang sesuai di database Anda
        $query = $this->db->get('lokasi');

        // Mengembalikan hasil query sebagai array
        return $query->result_array();
    }

    public function get_all_user() {
        // Sesuaikan nama tabel dan field sesuai dengan struktur database Anda
        $query = $this->db->get('user');
        return $query->result();
    }
    public function getLokasiData($id_lokasi)
    {
        // Assuming 'lokasi' is your table name
        $this->db->where('id_lokasi', $id_lokasi);
        $query = $this->db->get('lokasi');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getLokasiById($id_lokasi)
    {
        // Assuming 'lokasi' is the table name in your database
        $query = $this->db->get_where('lokasi', ['id_lokasi' => $id_lokasi]);

        // Return the result as an object
        return $query->row();
    }

    public function update_lokasi($id_lokasi, $data)
    {
        // Update lokasi berdasarkan id_lokasi
        $this->db->where('id_lokasi', $id_lokasi);
        $this->db->update('lokasi', $data);
    }

       // In your Admin_model.php
       public function hapus_lokasi($id_lokasi)
       {
           // Your deletion logic here
           $this->db->where('id_lokasi', $id_lokasi);
           $this->db->delete('lokasi');
       }

       public function updateSuperAdminPassword($user_id, $data_password)
    {
        $update_result = $this->db->update('superadmin', $data_password, ['id_superadmin' => $user_id]);

        return $update_result ? true : false;
    }

    public function updateSuperAdminPhoto($user_id, $data)
    {
        $update_result = $this->db->update('superadmin', $data, ['id_superadmin' => $user_id]);

        return $update_result ? true : false;
    }


}
?>