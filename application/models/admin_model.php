<?php
class Admin_model extends CI_Model
{
    // Menampilkan role user
    public function get_user()
    {
        $this->db->where('id_user', 'user');
        $query = $this->db->get('user');
        return $query->result();
    }

    // Mendapatkan semua data dari tabel tertentu
    function get_data($table)
    {
        return $this->db->get($table);
    }

    // Menampilkan data absen per id admin
    public function get_absen_by_admin($id_admin)
    {
        $this->db->where('id_absensi', $id_admin);
        return $this->db->get('absensi');
    }

    public function get_user_by_id_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        return $this->db->get('user')->result();
    }

    public function get_jabatan_by_id_admin($id_jabatan)
    {
        $this->db->where('id_jabatan', $id_jabatan);
        return $this->db->get('jabatan')->result();
    }

    public function get_shift_by_id_admin($id_shift)
    {
        $this->db->where('id_shift', $id_shift);
        return $this->db->get('shift')->result();
    }

    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function tambah_jabatan($data)
    {
        $this->db->insert('jabatan', $data);
        // Jika Anda ingin mendapatkan ID jabatan yang baru ditambahkan, Anda bisa menggunakan $this->db->insert_id();
    }

    public function get_employee_count_by_jabatan_and_admin($id_admin)
    {
        $this->db->select(
            'jabatan.nama_jabatan, COUNT(user.id_user) as jumlah_karyawan'
        );
        $this->db->from('jabatan');
        $this->db->join('user', 'jabatan.id_jabatan = user.id_jabatan', 'left');
        $this->db->where('jabatan.id_admin', $id_admin); // Menambahkan filter berdasarkan id_admin
        $this->db->group_by('jabatan.nama_jabatan');
        return $this->db->get()->result();
    }

    public function get_employee_count_by_shift()
    {
        $this->db->select(
            'shift.nama_shift, COUNT(user.id_user) as jumlah_karyawan'
        );
        $this->db->from('shift');
        $this->db->join('user', 'shift.id_shift = user.id_shift', 'left');
        $this->db->group_by('shift.nama_shift');
        return $this->db->get()->result();
    }

    public function update($tabel, $data, $where)
    {
        $data = $this->db->update($tabel, $data, $where);
        return $this->db->affected_rows();
    }

    // Menampilkan jumlah user
    public function get_user_count()
    {
        $this->db->where('role', 'user');
        $query = $this->db->get('user');
        return $query->num_rows();
    }

     // Metode untuk menghitung jumlah data absensi
    public function get_absensi_count() 
    {
        $this->db->from('absensi');
        return $this->db->count_all_results();
    }

    public function hapus_organisasi($id_organisasi) {
        // Misalnya, menggunakan query database untuk menghapus data organisasi berdasarkan ID
        // Gantilah bagian ini sesuai dengan struktur tabel dan kebutuhan aplikasi Anda
        $this->db->where('id_organisasi', $id_organisasi);
        $this->db->delete('organisasi'); // Gantilah 'nama_tabel_organisasi' dengan nama tabel sebenarnya
    }
    public function get_superadmin_data() {
        // Replace 'your_superadmin_table' with your actual table name
            $query = $this->db->get('admin'); 
        if (!$query) {
           log_message('error', 'Database Error: ' . $this->db->error());
            return false;
        }
        return $query->row_array();
    }
    

    public function update_organisasi($id_organisasi, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_organisasi', $id_organisasi);
        $this->db->update('organisasi', $data);
    }

    public function getOrganisasiById($id_organisasi) {
        // Misalnya, menggunakan query database untuk mengambil data organisasi berdasarkan ID
        // Gantilah bagian ini sesuai dengan struktur tabel dan kebutuhan aplikasi Anda
        $this->db->select('*');
        $this->db->from('organisasi');
        $this->db->where('id_organisasi', $id_organisasi);
        $query = $this->db->get();

        // Mengembalikan satu baris hasil query sebagai objek
        return $query->row();
    }

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

    // Searching
    public function search_data($table, $keyword) {
        $this->db->like('nama_user', $keyword); // Sesuaikan field_name dengan field yang ingin dicari
        $query = $this->db->get($table); // Sesuaikan table_name dengan nama tabel yang ingin dicari

        return $query->result(); // Mengembalikan hasil pencarian
    }   
    public function edit_user($id_user, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $data);
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
    public function getUserId($id_user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();

        return $query->row();
    }
    
    public function hapus_user($id_user) {
        // Misalnya, menggunakan query database untuk menghapus data organisasi berdasarkan ID
        // Gantilah bagian ini sesuai dengan struktur tabel dan kebutuhan aplikasi Anda
        $this->db->where('id_user', $id_user);
        $this->db->delete('user'); // Gantilah 'nama_tabel_organisasi' dengan nama tabel sebenarnya
    }
   
}
?>