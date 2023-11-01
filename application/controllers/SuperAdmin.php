<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_model');
    }

    public function index()
    {
        $this->load->view('page/super_admin/dashboard');
    }

    public function admin()
    {
        $data['admin'] = $this->m_model->get_data('admin')->result();
        $this->load->view('page/super_admin/admin', $data);
    }
    
    public function tambah_admin()
    {
        $this->load->view('page/super_admin/tambah_admin');
    }

    public function aksi_tambah_admin()
    {
        // Ambil data yang diperlukan dari form
        $data = [
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'nama_depan' => $this->input->post('nama_depan'),
            'nama_belakang' => $this->input->post('nama_belakang'),
            'password' => password_hash(
                $this->input->post('password'),
                PASSWORD_BCRYPT
            ),
            'image' => $this->input->post('image'),
            'id_organisasi' => $this->input->post('id_organisasi'),
            'id_superadmin' => $this->input->post('id_superadmin'),
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel "admin"
        $this->load->model('m_model'); // Load model
        $this->m_model->addAdmin($data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin');
    }
}