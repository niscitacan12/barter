<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
        $this->load->model('m_model');
    }

    public function index()
    {
        $data['jumlah_organisasi'] = $this->m_model->countData('organisasi');
        $data['jumlah_admin'] = $this->m_model->countData('admin');
        $data['jumlah_user'] = $this->m_model->countData('user');
        $this->load->view('page/super_admin/dashboard', $data);
    }

    public function countOrganisasi()
    {
        $data['jumlah_organisasi'] = $this->m_model->countData('organisasi');
        $this->load->view('page/super_admin/dashboard', $data);
    }

    public function countAdmin()
    {
        $data['jumlah_admin'] = $this->m_model->countData('admin');
        $this->load->view('page/super_admin/dashboard', $data);
    }

    public function countUser()
    {
        $data['jumlah_user'] = $this->m_model->countData('user');
        $this->load->view('page/super_admin/dashboard', $data);
    }

    public function admin()
    {
        $data['admin'] = $this->m_model->get_data('admin')->result();
        $this->load->view('page/super_admin/admin', $data);
    }

    public function organisasi()
    {
        $data['organisasi'] = $this->m_model->get_data('organisasi')->result();
        $this->load->view('page/super_admin/organisasi', $data);
    }

    public function user()
    {
        $data['user'] = $this->m_model->get_data('user')->result();
        $this->load->view('page/super_admin/user', $data);
    }

    public function absensi()
    {
        $data['absensi'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('page/super_admin/absensi', $data);
    }

    public function tambah_admin()
    {
        $data['organisasi'] = $this->m_model->get_data('organisasi')->result();
        $this->load->view('page/super_admin/tambah_admin', $data);
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
            'image' => 'User.png',
            'id_organisasi' => $this->input->post('id_organisasi'),
            'id_superadmin' => '1',
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel "admin"
        $this->load->model('m_model'); // Load model
        $this->m_model->addAdmin($data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/admin');
    }

    public function tambah_organisasi()
    {
        $data['organisasi'] = $this->m_model->get_data('organisasi')->result();
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

        // Simpan data ke tabel "admin"
        $this->m_model->tambah_data('organisasi', $data); // Panggil method pada model

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
