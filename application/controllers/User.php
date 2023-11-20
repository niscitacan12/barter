<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
        $this->load->model('user_model');
        if (
            $this->session->userdata('logged_in') != true ||
            $this->session->userdata('role') != 'user'
        ) {
            redirect(base_url() . 'auth');
        }
    }

    public function index()
    {
        $data['cuti_count'] = $this->user_model->get_cuti_count();
        $data['absensi'] = $this->user_model->get_izin_count();
        $data['absensi_count'] = $this->user_model->get_absensi_count();

        // Hitung total absen dan izin
        $data['total'] = $data['absensi'] + $data['absensi_count'];

        $this->load->view('page/user/dashboard', $data);
    }

    public function absen()
    {
        $this->load->view('page/user/absen');
    }

    public function cuti()
    {
        $this->load->view('page/user/cuti');
    }

    public function izin()
    {
        $this->load->view('page/user/izin');
    }

    public function history_absensi()
    {
        // Assuming $data is an array that you pass to the view
        $data['user'] = $this->user_model->get_all_user(); // Use the correct case
        $data['absensi'] = $this->user_model->get_absensi_data(); // You need to replace this with your actual data retrieval logic
        $this->load->view('page/user/history_absensi', $data);
    }

    // application/controllers/User.php
    public function aksi_absen()
    {
        $id_user = $this->session->userdata('id');
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_sekarang = date('Y-m-d H:i:s');
        $lokasi = $this->input->post('lokasi');
        $foto_masuk = $this->input->post('foto_masuk');

        // Rest of your code
        $data = [
            'id_user' => $id_user,
            'tanggal_absen' => $tanggal_sekarang,
            'keterangan_izin' => 'masuk',
            'jam_masuk' => $tanggal_sekarang,
            'foto_masuk' => $foto_masuk,
            'jam_pulang' => '00:00:00',
            'foto_pulang' => '-',
            'lokasi' => $lokasi,
            'status' => 'false',
        ];

        $this->user_model->tambah_data('absensi', $data);
        $this->session->set_flashdata('berhasil_absen', 'Berhasil Absen.');

        redirect(base_url('user/history_absensi'));
    }

    // Aksi Izin
    public function aksi_izin()
    {
        $id_user = $this->session->userdata('id');
        $tanggal_sekarang = date('Y-m-d');

        $keterangan_izin = $this->input->post('keterangan_izin');

        // Periksa apakah 'keterangan_izin' tidak kosong
        if (!empty($keterangan_izin)) {
            $data = [
                'id_user' => $id_user,
                'kegiatan' => '-',
                'tanggal_absen' => $tanggal_sekarang,
                'keterangan_izin' => $this->input->post('keterangan_izin'),
                'jam_masuk' => '00:00:00',
                // 'foto_masuk' => '-',
                'jam_pulang' => '00:00:00',
                // 'foto_pulang' => '-',
                'lokasi' => '-',
                'status' => 'true',
            ];

            $this->user_model->tambah_data('absensi', $data);
            $this->session->set_flashdata('berhasil_izin', 'Berhasil Izin.');

            redirect(base_url('user/history_absensi'));
        } else {
            // Tampilkan pesan kesalahan jika 'keterangan_izin' kosong
            $this->session->set_flashdata(
                'gagal_izin',
                'Gagal Izin. Keterangan Izin tidak boleh kosong.'
            );
            redirect(base_url('page/user/izin'));
        }
    }
    // Tambahkan fungsi ini dalam controller Anda, misalnya User.php
    public function aksi_cuti()
    {
        $id_user = $this->session->userdata('id');
        $tanggal_sekarang = date('Y-m-d');

        $awal_cuti = $this->input->post('awal_cuti');
        $akhir_cuti = $this->input->post('akhir_cuti');
        $masuk_kerja = $this->input->post('masuk_kerja');
        $keperluan_cuti = $this->input->post('keperluan_cuti');

        // Periksa apakah data tidak kosong
        if (
            !empty($awal_cuti) &&
            !empty($akhir_cuti) &&
            !empty($masuk_kerja) &&
            !empty($keperluan_cuti)
        ) {
            $data = [
                'id_user' => $id_user,
                'awal_cuti' => $awal_cuti,
                'akhir_cuti' => $akhir_cuti,
                'masuk_kerja' => $masuk_kerja,
                'keperluan_cuti' => $keperluan_cuti,
            ];

            // Panggil model untuk menyimpan data cuti
            $this->user_model->tambah_data('cuti', $data);
            $this->session->set_flashdata(
                'berhasil_cuti',
                'Berhasil mengajukan cuti.'
            );

            redirect(base_url('user/cuti')); // Mengasumsikan 'user/history_cuti' adalah halaman untuk melihat riwayat cuti
        } else {
            // Tampilkan pesan kesalahan jika ada data yang kosong
            $this->session->set_flashdata(
                'gagal_cuti',
                'Gagal mengajukan cuti. Semua field harus diisi.'
            );
            redirect(base_url('user/cuti'));
        }
    }
}
