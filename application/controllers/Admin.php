<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('page/admin/dashboard');
    }

    public function karyawan()
    {
        $data['user'] = $this->m_model->get_data('user')->result();
        $this->load->view('page/admin/karyawan', $data);
    }

    public function absensi()
    {
        // Dapatkan id_admin pengguna yang sedang masuk, misalkan dari session atau dari data pengguna saat login.
        $id_admin_pengguna = $this->session->userdata('id_admin'); // Gantilah ini sesuai dengan session Anda.

        // Panggil model untuk mengambil data absen berdasarkan id_admin yang sesuai.
        $data['absensi'] = $this->m_model
            ->get_absensi_by_id_admin($id_admin_pengguna)
            ->result();

        $this->load->view('page/admin/absensi', $data);
    }

    public function profile()
    {
        $this->load->view('page/admin/profile');
    }

    public function tambah_karyawan()
    {
        $data['admin'] = $this->m_model->get_data('admin')->result();
        $this->load->view('page/admin/tambah_karyawan', $data);
    }
    public function rekap_harian()
    {
        $this->load->view('page/admin/rekap_harian');
    }

    public function aksi_tambah_karyawan() {
        // Ambil data yang diperlukan dari form, termasuk admin_id yang dipilih
        $data = [
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'nama_depan' => $this->input->post('nama_depan'),
            'nama_belakang' => $this->input->post('nama_belakang'),
            'id_admin' =>'4', // Mengambil admin_id dari dropdown
            'password' => password_hash(
                $this->input->post('password'),
                PASSWORD_BCRYPT
            ),
            'image' => 'User.png',
            // sesuaikan dengan kolom lainnya
        ];

        // Load model
        $this->load->model('M_model');

        // Panggil function addUser pada model
        $this->M_model->addUser($data);

        // Redirect kembali ke halaman yang sesuai
        redirect('admin/karyawan');
    }

    public function rekap_bulanan()
    {
        $data['title'] = 'Rekap Bulanan';
        $this->load->view('page/admin/rekap_bulanan', $data); 
    }
    public function rekap_mingguan()
    {
        $this->load->view('page/admin/rekap_mingguan');
    }

}
?>