<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
        $this->load->model('super_model');
        if($this->session->userdata('logged_in')!=true || $this->session->userdata('role') != 'superadmin') {
            redirect(base_url().'auth/login');
        }
    }

    // Page Dashboard / Utama
    public function index()
    {
        $id_superadmin = $this->session->userdata('id');
        $data['organisasi'] = $this->super_model->get_data('organisasi')->num_rows();
        $data['admin'] = $this->super_model->get_admin_count();
        $data['user'] = $this->super_model->get_user_count();
        $this->load->view('page/super_admin/dashboard', $data);
    }

    // Page Organisasi
    public function organisasi()
    {
        $data['organisasi'] = $this->super_model->get_data('organisasi')->result();
        $this->load->view('page/super_admin/organisasi', $data);
    }
    
    // Page Admin
    public function admin()
    {
        $data['user'] = $this->super_model->get_admin();
        $this->load->view('page/super_admin/admin', $data);
    }

    // Page User
    public function user()
    {
        $data['user'] = $this->super_model->get_user();
        $this->load->view('page/super_admin/user', $data);
    }

    // Page Absensi
    public function absensi()
    {
        $data['absensi'] = $this->super_model->get_data('absensi')->result();
        $this->load->view('page/super_admin/absensi', $data);
    }

    // Page Tambah Organisasi
    public function tambah_admin()
    {
        $data['organisasi'] = $this->super_model->get_data('organisasi')->result();
        $this->load->view('page/super_admin/tambah_admin', $data);
    }

    public function aksi_tambah_admin()
    {
        $id_superadmin = $this->session->userdata('id');
        // Ambil data yang diperlukan dari form
        $data = [
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'nama_depan' => $this->input->post('nama_depan'),
            'nama_belakang' => $this->input->post('nama_belakang'),
            'password' => md5($this->input->post('password')), // Simpan kata sandi yang telah di-MD5
            'image' => 'User.png',
            'id_organisasi' => $this->input->post('id_organisasi'),
            'id_superadmin' => $id_superadmin,
            'role' => 'admin',
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('user', $data); // Panggil method pada model
         
        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/admin');
    }

    public function tambah_organisasi()
    {
        $data['organisasi'] = $this->super_model->get_data('organisasi')->result();
        $this->load->view('page/super_admin/tambah_organisasi', $data);
    }

    public function aksi_tambah_organisasi()
    {
        // Ambil data yang diperlukan dari form
        $data = [
            'nama_organisasi' => $this->input->post('nama_organisasi'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon'),
            'email_organisasi' => $this->input->post('email_organisasi'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kabupaten' => $this->input->post('kabupaten'),
            'provinsi' => $this->input->post('provinsi'),
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('organisasi', $data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/organisasi');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }

    public function profile()
    {
        if ($this->session->userdata('id_superadmin')) {
            $id = $this->session->userdata('id_superadmin');
            $data['superadmin'] = $this->m_model->getUserById($id); // Perbaiki ini dari $user_id menjadi $id_superadmin

            $this->load->view('page/super_admin/profile', $data);
        } else {
            redirect('auth/login');
        }
    }
}