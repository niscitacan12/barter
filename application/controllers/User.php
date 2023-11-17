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
        $this->load->view('page/user/dashboard');
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
		// Ambil data dari formulir
		$bulan = $this->input->get('bulan');
		$tanggal = $this->input->get('tanggal');
		$tahun = $this->input->get('tahun');

		// Kirim data ke model untuk mengambil data absensi
		$data['absensi'] = $this->user_model->GetDataAbsensi($bulan, $tanggal, $tahun);

		$this->load->view('page/user/history_absensi', $data);
	}

    // Aksi penambahan data absensi karyawan
	public function aksi_absen() {
		$id_user = $this->session->userdata('id');
		$tanggal_sekarang = date('Y-m-d');
        $current_time = date("H:i:s");
	
		$data = [
			'id_user' => $id_user,
			'kegiatan' => 'coba',
			'tanggal_absen' => $tanggal_sekarang,
			'keterangan_izin' => 'masuk',
			'jam_masuk' => $current_time,
			'foto_masuk' => $this->input->post('foto_masuk'),
			'jam_pulang' => '00:00:00',
			'foto_pulang' => '-',
			'lokasi' => $this->input->post('lokasi'),
			'status' => 'false',
		];
        
		$this->user_model->tambah_data('absensi', $data);
		$this->session->set_flashdata('berhasil_absen', 'Berhasil Absen.');
	
		redirect(base_url('page/user/absen'));
	}

    // Aksi Izin
	public function aksi_izin() {
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
			$this->session->set_flashdata('gagal_izin', 'Gagal Izin. Keterangan Izin tidak boleh kosong.');
			redirect(base_url('page/user/izin'));
		}
	}
}