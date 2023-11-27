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

    public function get_absensi_data()
    {
        // Assuming you have a table named 'absensi'
        $query = $this->db->get('absensi');

        // Assuming 'absensi' is the name of the table
        return $query->result(); // This assumes you want to get multiple rows as a result
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
        $update_result = $this->db->update('user', $data_password, ['id_user' => $user_id]);

        return $update_result ? true : false;
    }

    public function updateUserPhoto($user_id, $data)
    {
        $update_result = $this->db->update('user', $data, ['id_user' => $user_id]);

        return $update_result ? true : false;
    }
}
?>