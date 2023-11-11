Superadmin.php:

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
        $this->load->model('super_model');
        $this->load->library('session');
        if (
            $this->session->userdata('logged_in') != true ||
            $this->session->userdata('role') != 'superadmin'
        ) {
            redirect(base_url() . 'auth');
        }
    }

    // Page Dashboard / Utama
    public function index()
    {
        $id_superadmin = $this->session->userdata('id');
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->num_rows();
        $data['admin'] = $this->super_model->get_admin_count();
        $data['user'] = $this->super_model->get_user_count();
        $this->load->view('page/super_admin/dashboard', $data);
    }

    // Page Organisasi
    public function organisasi()
    {
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->result();
        $this->load->view('page/super_admin/organisasi', $data);
    }

    // Page Admin
    public function admin()
    {
        $data['user'] = $this->super_model->get_data('admin')->result();
        // foreach ($data['user'] as $user) {
        //     $id_admin = $user->id_admin; // Menyimpan ID admin dari setiap elemen pengguna
        //     $organisasi = $this->super_model->getOrganisasiId($id_admin);
        //     // Lakukan operasi yang diperlukan dengan data organisasi yang diperoleh
        // }
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

    // Page Tambah Admin
    public function tambah_admin()
    {
        // $data['id_superadmin'] = $this->session->userdata('id');
        $data['organisasi'] = $this->super_model->get_data('organisasi')->result();
        $this->load->view('page/super_admin/tambah_admin', $data);
    }

    // Page Tambah Organisasi
    public function tambah_organisasi()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $this->load->view('page/super_admin/tambah_organisasi', $data);
    }
    
    // Page Tambah User
    public function tambah_user()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $data['organisasi'] = $this->super_model->get_data('organisasi')->result();
        $data['shift'] = $this->super_model->get_data('shift')->result();
        $data['jabatan'] = $this->super_model->get_data('jabatan')->result();
        $this->load->view('page/super_admin/tambah_user', $data);
    }

    // aksi tambah admin
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
            'id_superadmin' => $id_superadmin,
            'role' => 'admin',
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('admin', $data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/admin');
    }

    // aksi tambah organisasi
    public function aksi_tambah_organisasi()
    {
        $id_superadmin = $this->session->userdata('id');
        // Ambil data yang diperlukan dari form
        $data = [
            'nama_organisasi' => $this->input->post('nama_organisasi'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon'),
            'email_organisasi' => $this->input->post('email_organisasi'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kabupaten' => $this->input->post('kabupaten'),
            'provinsi' => $this->input->post('provinsi'),
            'id_admin' => $this->input->post('id_admin'),
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('organisasi', $data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/organisasi');
    }

    // aksi tambah user
    public function aksi_tambah_user()
    {
        // Ambil data yang diperlukan dari form
        $data = [
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'nama_depan' => $this->input->post('nama_depan'),
            'nama_belakang' => $this->input->post('nama_belakang'),
            'password' => md5($this->input->post('password')), // Simpan kata sandi yang telah di-MD5
            'id_admin' => $this->input->post('id_admin'),
            'id_organisasi' => $this->input->post('id_organisasi'),
            'id_shift' => $this->input->post('id_shift'),
            'id_jabatan' => $this->input->post('id_jabatan'),
            'image' => 'User.png',
            'role' => 'user',
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('user', $data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/admin');
    }

    public function profile()
    { // Perbaiki ini dari $user_id menjadi $id_superadmin
        $this->load->view('page/super_admin/profile');
    }

     // Page Detail Organisasi
     public function detail_organisasi()
     {
           // Mendefinisikan data yang akan digunakan dalam tampilan
         $data = array(
             'judul' => 'Detail Organisasi',
             'deskripsi' => 'Ini adalah halaman detail organisasi.'
         );
         $this->load->view('page/super_admin/detail_organisasi', $data);
     }
     // Page Detail User
     public function detail_user()
     {
       
         $this->load->view('page/super_admin/detail_user');
     }
}