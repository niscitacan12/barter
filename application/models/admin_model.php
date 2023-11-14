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
}
?>