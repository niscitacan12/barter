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

    public function get_cuti_data($id_user)
    {
        $this->db->select('*');
        $this->db->from('cuti');
        $this->db->where('id_user', $id_user);

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

    public function getAbsensiById($id_absensi)
    {
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

    public function get_absen_data($id_user = null)
    {
        if ($id_user !== null) {
            $this->db->select('*');
            $this->db->from('absensi');
            $this->db->where('id_user', $id_user);
            $absensi = $this->db->get()->result();

            // Tambahkan informasi jumlah terlambat ke setiap baris data
            foreach ($absensi as &$absen) {
                $absen->jumlah_terlambat = $this->get_jumlah_status_absen(
                    $absen->id_user,
                    'Terlambat'
                );
            }

            return $absensi;
        } else {
            // Jika $id_user kosong, dapatkan semua data absensi
            return $this->db->get('absensi')->result();
        }
    }

    public function get_jumlah_status_absen($id_user, $status)
    {
        return $this->db
            ->where('id_user', $id_user)
            ->where('status_absen', $status)
            ->from('absensi')
            ->count_all_results();
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

    public function getAbsensiDetail($id_absensi)
    {
        $this->db->where('id_absensi', $id_absensi);
        $query = $this->db->get('absensi');
        return $query->row();
    }

    public function cek_absen($id_user, $tanggal)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('tanggal_absen', $tanggal);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0 ? true : false;
    }

    public function cek_izin($id_user, $tanggal)
    {
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

    public function updateUserPhoto($user_id, $data)
    {
        $update_result = $this->db->update('user', $data, [
            'id_user' => $user_id,
        ]);

        return $update_result ? true : false;
    }

    // untuk uubah password
    public function getPasswordById($id_user)
    {
        $this->db->select('password');
        $this->db->from('user'); // Replace 'your_user_table' with the actual table name
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->password;
        } else {
            return false;
        }
    }

    public function update_password($id_user, $new_password)
    {
        $this->db->set('password', $new_password);
        $this->db->where('id_user', $id_user);
        $this->db->update('user'); // Replace 'your_user_table' with the actual table name

        return $this->db->affected_rows() > 0;
    }

    // Memperbarui data dalam tabel berdasarkan kondisi tertentu
    public function update_data($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    // Memperbarui gambar pengguna
    public function update_image($user_id, $new_image)
    {
        $data = [
            'image' => $new_image,
        ];

        $this->db->where('id_user', $user_id);
        $this->db->update('user', $data);

        return $this->db->affected_rows();
    }

    // Mendapatkan gambar saat ini berdasarkan ID pengguna
    public function get_current_image($user_id)
    {
        $this->db->select('image');
        $this->db->from('user');
        $this->db->where('id_user', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->image;
        }

        return null;
    }

    public function getJabatanByIdAdmin($id_admin)
    {
        // Sesuaikan dengan struktur tabel dan nama kolom pada database
        $this->db->select('*');
        $this->db->from('jabatan');
        $this->db->where('id_admin', $id_admin);

        $query = $this->db->get();

        return $query->result();
    }

    public function getShiftByIdAdmin($id_admin)
    {
        // Sesuaikan dengan struktur tabel dan nama kolom pada database
        $this->db->select('*');
        $this->db->from('shift');
        $this->db->where('id_admin', $id_admin);

        $query = $this->db->get();

        return $query->result();
    }

    public function getAbsensiBelumSelesai($tanggal)
    {
        $this->db->where('tanggal_absen', $tanggal);
        $this->db->where('status', false); // Filter absensi yang belum selesai
        $query = $this->db->get('absensi');

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return null;
    }

    public function updateStatusAbsenPulang($tanggal, $data)
    {
        $this->db->update('absensi', $data);
        return $this->db->affected_rows(); // Mengembalikan jumlah baris yang terpengaruh oleh query
    }

    public function getAbsensiByDate($tanggal)
    {
        $this->db->where('tanggal_absen', $tanggal);
        return $this->db->get('absensi')->result();
    }

    public function get_absensi_data_by_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->from('absensi'); // Ganti 'nama_tabel_absensi' dengan nama tabel Anda
        $query = $this->db->get();

        return $query->result();
    }

    public function get_absensi_by_id($id_absensi)
    {
        // Ganti 'nama_tabel_absensi' dengan nama tabel absensi yang sesuai dalam database Anda
        $this->db->where('id_absensi', $id_absensi);
        $query = $this->db->get('absensi');

        // Mengembalikan satu baris data absensi atau null jika tidak ditemukan
        return $query->row();
    }

    public function update_izin($table, $data, $id_absensi)
    {
        $this->db->where('id_absensi', $id_absensi);
        return $this->db->update($table, $data);
    }

    public function hapus_cuti($id_cuti)
    {
        // Misalnya, menggunakan query database untuk menghapus data cuti berdasarkan ID
        // Gantilah bagian ini sesuai dengan struktur tabel dan kebutuhan aplikasi Anda
        $this->db->where('id_cuti', $id_cuti);
        $this->db->delete('cuti'); // Gantilah 'nama_tabel_organisasi' dengan nama tabel sebenarnya
    }

    public function cancel_permission($id_absensi)
    {
        // Tambahkan logika pembatalan izin di sini
        // Misalnya, ubah status izin menjadi "batal" dan keterangan izin menjadi "masuk kembali" di database
        $this->db->where('id_absensi', $id_absensi);
        $this->db->update('absensi', [
            'status' => 'batal',
            'keterangan_izin' => 'masuk kembali',
        ]);

        return true; // Atau false jika ada kesalahan
    }
}
?>
