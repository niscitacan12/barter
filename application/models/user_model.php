<?php

class User_model extends CI_Model
{
    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function set_flash_data($key, $value)
    {
        $this->session->set_flashdata($key, $value);
    }

    function get_data($table)
    {
        return $this->db->get($table);
    }

    // Metode untuk mengambil data absensi
    public function GetDataAbsensi(
        $bulan = null,
        $tanggal = null,
        $tahun = null
    ) {
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

    public function get_cuti_data()
    {
        // Assuming you have a table named 'absensi'
        $query = $this->db->get('cuti');

        // Assuming 'absensi' is the name of the table
        return $query->result(); // This assumes you want to get multiple rows as a result
    }

    public function get_absensi_data()
    {
        // Assuming you have a table named 'absensi'
        $query = $this->db->get('absensi');

        // Assuming 'absensi' is the name of the table
        return $query->result(); // This assumes you want to get multiple rows as a result
    }

    public function getAbsensiById($id_absensi) {
        $this->db->where('id_absensi', $id_absensi);
        $query = $this->db->get('absensi');

        return $query->result(); // Assuming you want to get a single result
    }

    public function get_all_user()
    {
        // Replace 'user' with your actual table name
        $query = $this->db->get('user');

        return $query->result();
    }

    // Menampilkan Jumlah Cuti
    public function get_cuti_count()
    {
        $this->db->select('COUNT(*) as cuti_count');
        $query = $this->db->get('cuti');

        return $query->row()->cuti_count;
    }

    // Menampilkan Jumlah Izin
    public function get_izin_count()
    {
        $this->db->select('COUNT(*) as izin_count');
        $query = $this->db->get('absensi');

        return $query->row()->izin_count;
    }

    // Menampilkan Jumlah Absen
    public function get_absensi_count()
    {
        $this->db->select('COUNT(*) as absensi_count');
        $query = $this->db->get('absensi');

        return $query->row()->absensi_count;
    }

    public function getUserByID($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($tabel, $data, $where)
    {
        $data = $this->db->update($tabel, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_absensi_count_by_date($date)
    {
        // Gantilah 'nama_tabel_absensi' dengan nama tabel absensi di database Anda
        $this->db->select('COUNT(*) as absensi_count');
        $this->db->from('absensi');
        $this->db->where('tanggal_absen', $date); // Gantilah 'tanggal_absen' dengan nama kolom tanggal di tabel absensi

        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan jumlah absen pada tanggal tertentu
        return isset($result->absensi_count) ? $result->absensi_count : 0;
    }

    public function get_realtime_absensi()
    {
        // Gantilah 'nama_tabel_absensi' dengan nama tabel absensi di database Anda
        $this->db->select('tanggal_absen, COUNT(*) as absensi_count');
        $this->db->from('absensi');
        $this->db->where('keterangan_izin', 'Masuk'); // Gantilah 'keterangan_izin' dengan nama kolom yang sesuai di tabel absensi
        $this->db->group_by('tanggal_absen');
        $this->db->order_by('tanggal_absen', 'DESC');
        $this->db->limit(6); // Sesuaikan dengan jumlah label yang ingin ditampilkan

        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    // Aksi Butoon Pulang Absen & Izin
    public function setAbsensiPulang($id_absensi)
    {
        $data = [
            'jam_pulang' => date('H:i:s'),
            'status' => 'DONE',
        ];

        $this->db->where('id_absensi', $id_absensi);
        $this->db->update('absensi', $data);
    }

    public function batalPulang($id_absensi)
    {
        $data = [
            'jam_pulang' => null,
            'status' => 'NOT',
        ];

        $this->db->where('id_absensi', $id_absensi);
        $this->db->update('absensi', $data);
    }

    public function updateUserPassword($user_id, $data_password)
    {
        $update_result = $this->db->update('user', $data_password, [
            'id_user' => $user_id,
        ]);

        return $update_result ? true : false;
    }

    public function updateUserPhoto($user_id, $data)
    {
        $update_result = $this->db->update('user', $data, [
            'id_user' => $user_id,
        ]);

        return $update_result ? true : false;
    }

    public function get_id_organisasi($id_user)
    {
        $this->db->select('id_organisasi');
        $this->db->where('id_user', $id_user);
        $result = $this->db->get('user')->row();

        return $result ? $result->id_organisasi : null;
    }
    
    public function id_organisasi()
    {
        // Gantilah dengan logika aplikasi yang sesuai
        // Contoh: Mendapatkan ID organisasi dari session atau tabel lain
        $id_organisasi = $this->session->userdata('id_organisasi');

        return $id_organisasi;
    }

    public function get_absen_data($id_user = NULL) {
        if ($id_user !== NULL) {
            $this->db->select('*');
            $this->db->from('absensi');
            $this->db->where('id_user', $id_user);
            return $this->db->get()->result();
        } else {
            // Jika $id_user kosong, dapatkan semua data absensi
            return $this->db->get('absensi')->result();
        }
    }

    public function get($table, $where)
    {
        return $this->db->get_where($table, $where)->row();
    }

    public function get_user_by_email($email)
    {
        $query = $this->db->get_where('user', ['email' => $email]);
        return $query->row_array();
    }

    public function getAbsensiDetail($id_absensi) {
        $this->db->where('id_absensi', $id_absensi);
        $query = $this->db->get('absensi');
        return $query->row(); 
    }


    public function cek_absen($id_user, $tanggal) {
        $this->db->where('id_user', $id_user);
        $this->db->where('tanggal_absen', $tanggal);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0 ? true : false;
    }

    public function cek_izin($id_user, $tanggal) {
        $this->db->where('id_user', $id_user);
        $this->db->where('tanggal_absen', $tanggal);
        $query = $this->db->get_where('absensi', ['status' => 'true']); // Ganti dengan status izin jika ada

        return $query->num_rows() > 0 ? true : false;
    }

    public function hitung_cuti_setahun_ini($id_user)
    {
        $tahun_ini = date('Y');

        $this->db->where('id_user', $id_user);
        $this->db->where('YEAR(awal_cuti)', $tahun_ini);
        $this->db->from('cuti');
        return $this->db->count_all_results();
    }

    public function get_shift_data_by_id($id_shift)
    {
        // Gantilah 'nama_tabel_shift' dengan nama tabel yang sesuai di database Anda
        $this->db->where('id_shift', $id_shift);
        $query = $this->db->get('nama_tabel_shift');

        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris data shift
        } else {
            return false; // Mengembalikan false jika tidak ditemukan data
        }
    }
}
?>