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

    public function get_jabatan_by_id_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        return $this->db->get('jabatan')->result();
    }

    public function get_shift_by_id_admin($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
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

    public function update_admin($id_admin, $data)
    {
        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin', $data);
        return $this->db->affected_rows();
    }

    public function getAdminByID($id)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id_admin', $id);
        $query = $this->db->get();

        return $query->row();
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

    // Menampilkan Jumlah Cuti
    public function get_cuti_count()
    {
        $this->db->select('COUNT(*) as cuti_count');
        $query = $this->db->get('cuti');

        return $query->row()->cuti_count;
    }

    public function hapus_organisasi($id_organisasi)
    {
        // Misalnya, menggunakan query database untuk menghapus data organisasi berdasarkan ID
        // Gantilah bagian ini sesuai dengan struktur tabel dan kebutuhan aplikasi Anda
        $this->db->where('id_organisasi', $id_organisasi);
        $this->db->delete('organisasi'); // Gantilah 'nama_tabel_organisasi' dengan nama tabel sebenarnya
    }
    public function get_superadmin_data()
    {
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

    public function getOrganisasiById($id_organisasi)
    {
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

    public function hapus_user($id_user)
    {
        // Misalnya, menggunakan query database untuk menghapus data organisasi berdasarkan ID
        // Gantilah bagian ini sesuai dengan struktur tabel dan kebutuhan aplikasi Anda
        $this->db->where('id_user', $id_user);
        $this->db->delete('user'); // Gantilah 'nama_tabel_organisasi' dengan nama tabel sebenarnya
    }
    // Searching
    public function search_data($table, $column, $keyword)
    {
        $this->db->like($column, $keyword);
        return $this->db->get($table);
    }

    public function get_all_lokasi()
    {
        // Ganti 'lokasi' dengan nama tabel yang sesuai di database Anda
        $query = $this->db->get('lokasi');

        // Mengembalikan hasil query sebagai array
        return $query->result_array();
    }

    public function tambah_lokasi($data)
    {
        $this->db->insert('lokasi', $data);
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

    public function detail_lokasi($lokasi_id)
    {
        $data['lokasi'] = $this->admin_model->getLokasiData($lokasi_id);

        // Mengirim data lokasi ke view
        $this->load->view('page/admin/detail_lokasi', $data);
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

    public function get_all_user()
    {
        // Gantilah dengan metode yang sesuai untuk mengambil data pengguna dari database
        $query = $this->db->get('user');
        return $query->result();
    }

    // Menampilkan Dan Mengget Data
    public function getShiftData($id)
    {
        // Sesuaikan dengan struktur tabel di database Anda
        $this->db->select('*');
        $this->db->from('shift');
        $this->db->where('id_shift', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row(); // Menggunakan row() untuk mendapatkan satu baris
        } else {
            return false;
        }
    }

    //  GET ID Shift
    public function getShiftId($id_shift)
    {
        $this->db->select('*');
        $this->db->from('shift');
        $this->db->where('id_shift', $id_shift);
        $query = $this->db->get();

        return $query->row();
    }

    // Update
    public function update_shift($id_shift, $data)
    {
        // Lakukan pembaruan data Admin
        $this->db->where('id_shift', $id_shift);
        $this->db->update('shift', $data);
    }

    // GET Admin Shift
    public function get_admin_data()
    {
        $query = $this->db->get('admin');
        return $query->result();
    }

    public function get_last_shift()
    {
        // Ambil semua data shift
        $query = $this->db->get('shift');
        return $query->result();
    }

    // Hapus Shift
    public function hapus_shift($id_shift)
    {
        $this->db->where('id_shift', $id_shift);
        $this->db->delete('shift');
    }

    public function getJabatanId($id_jabatan)
    {
        $this->db->select('*');
        $this->db->from('jabatan');
        $this->db->where('id_jabatan', $id_jabatan);
        $query = $this->db->get();

        return $query->row();
    }

    // hapus jabatan
    public function hapus_jabatan($id_jabatan)
    {
        $this->db->where('id_jabatan', $id_jabatan);
        $this->db->delete('jabatan');
    }

    public function getJabatanDetails($id_jabatan)
    {
        // Gantilah 'nama_table' dengan nama tabel yang sesuai di database Anda
        $this->db->where('id_jabatan', $id_jabatan);
        $query = $this->db->get('jabatan'); // Gantilah 'nama_table' dengan nama tabel yang sesuai di database Anda

        // Jika query berhasil dan ada hasil
        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris hasil sebagai objek
        } else {
            return null; // Mengembalikan null jika tidak ada hasil
        }
    }
    public function update_jabatan($id_jabatan, $data)
    {
        // Gantilah 'jabatan' dengan nama tabel yang sesuai di database Anda
        $this->db->where('id_jabatan', $id_jabatan);
        $this->db->update('jabatan', $data);
    }

    public function pagination($table_name, $limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get($table_name);

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return [];
    }

    public function count_all($table_name)
    {
        return $this->db->get($table_name)->num_rows();
    }

    // Pagination by id_admin
    public function pagination_by_id_admin(
        $tableName,
        $perPage,
        $start,
        $id_admin
    ) {
        $this->db->where('id_admin', $id_admin);
        return $this->db->get($tableName, $perPage, $start)->result_array();
    }

    // Pagination absen per id_admin
    public function pagination_absen_by_admin(
        $tableName,
        $perPage,
        $start,
        $id_admin
    ) {
        $this->db->where('id_admin', $id_admin);
        return $this->db->get($tableName, $perPage, $start)->result_array();
    }

    // Pagination organisasi
    public function pagination_organisasi(
        $tableName,
        $perPage,
        $start,
        $id_admin
    ) {
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where('id_admin', $id_admin);
        $this->db->limit($perPage, $start);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_organisasi_pusat($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        $this->db->where('status', 'pusat');
        return $this->db->get('organisasi')->result();
    }

    function get_all_organisasi($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        return $this->db->get('organisasi')->result();
    }

    public function updateStatusCuti($cutiId, $newStatus)
    {
        $this->db->where('id_cuti', $cutiId);
        $this->db->update('cuti', ['status' => $newStatus]);
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

    // Mendapatkan data per hari berdasarkan tanggal
    public function getPerHari($tanggal)
    {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_user = user.id_user', 'left');
        $this->db->where('tanggal_absen', $tanggal);
        $query = $this->db->get();
        return $query->result();
    }

    // Mendapatkan Export   per minggu berdasarkan rentang tanggal
    public function getRekapPerMinggu($start_date, $end_date)
    {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_user = user.id_user', 'left');
        $this->db->where('tanggal_absen ', $start_date);
        $this->db->where('tanggal_absen ', $end_date);
        $query = $this->db->get();
        return $query->result();
    }
    // Mendapatkan rekap per minggu berdasarkan rentang tanggal
    public function RekapPerMinggu($start_date, $end_date)
    {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_user = user.id_user', 'left');
        $this->db->where('tanggal_absen >=', $start_date);
        $this->db->where('tanggal_absen <=', $end_date);
        $query = $this->db->get();
        return $query->result();
    }

    // Mendapatkan rekap harian berdasarkan bulan
    public function getRekapHarianByBulan($bulan)
    {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_user = user.id_user', 'left');
        $this->db->where('MONTH(absensi.tanggal_absen)', $bulan);
        $query = $this->db->get();
        return $query->result();
    }

    // Mendapatkan data bulanan berdasarkan bulan
    public function getBulanan($bulan)
    {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_user = user.id_user', 'left');
        $this->db->where("DATE_FORMAT(tanggal_absen, '%m') = ", $bulan);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_cuti_by_id($cutiId)
    {
        // Gantilah 'nama_tabel_cuti' dengan nama tabel cuti di database Anda
        $this->db->where('id_cuti', $cutiId);
        $query = $this->db->get('cuti');

        // Mengembalikan hasil dalam bentuk objek
        return $query->row();
    }

    public function get_user_id_admin($id_admin)
    {
        $this->db->select('id_user');
        $this->db->from('user');
        $this->db->where('id_admin', $id_admin);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Mengembalikan ID pengguna terkait
            return $query->row()->id_user;
        } else {
            return null; // Mengembalikan null jika tidak ada ID pengguna terkait
        }
    }

    public function get_id_organisasi()
    {
        $id_organisasi = $this->session->userdata('id_organisasi');

        return $id_organisasi;
    }
}
?>
