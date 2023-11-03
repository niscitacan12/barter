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
}
