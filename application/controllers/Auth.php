<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->library('form_validation');
        $this->load->model('m_model');
    } 

    public function register(){
        $this->load->view('auth/register');
    }
    
    // Aksi register untuk registrasi karyawan
    public function aksi_register_superadmin()
    {
        $username = $this->input->post('username', true);
        $email = $this->input->post('email', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $password = $this->input->post('password', true);

        // Validasi input
        if (empty($username) || empty($nama_depan) || empty($password)) {
            // Tampilkan pesan error jika ada input yang kosong
            $this->session->set_flashdata('error', 'Semua field harus diisi.');
            redirect(base_url().'auth/register'); // sesuaikan dengan URL halaman registrasi .
        } elseif (strlen($password) < 8) {
            $this->session->set_flashdata('register_gagal' , 'Password minimal 8 huruf.');
            redirect(base_url('auth/register'));
        } else {
            // dengan menggunakan model untuk menyimpan data pengguna
            $data = array(
                'username' => $username,
                'email' => $email,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'image' => 'User.png',
                'password' => md5($password), // Simpan kata sandi yang telah di-MD5
                'role' => 'superadmin' // Atur peran menjadi superadmin
            );
        
            // memanggil model untuk menyimpan data pengguna
            $this->m_model->tambah_data('superadmin', $data);
            $this->session->set_flashdata('register_success', 'Registrasi berhasil. Silakan login.');
        
            // Setelah data pengguna berhasil disimpan, dapat mengarahkan pengguna
            // ke halaman login atau halaman lain yang sesuai.
            redirect(base_url().'auth'); // sesuaikan dengan URL halaman login
        }
    }

    public function index(){
        $this->load->view('auth/login');
    }

    // Aksi untuk login
	public function aksi_login_superadmin()
    {
        // Mengambil data email dan password yang dikirimkan melalui form login.
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        // Membuat array $data untuk mencari pengguna berdasarkan alamat email.
        $data = [
            'email' => $email,
        ];
        // Mencari data pengguna dengan alamat email yang sesuai dalam database.
        $query = $this->m_model->getwhere('superadmin', $data);
        // Mengambil hasil pencarian dalam bentuk array asosiatif.
        $result = $query->row_array();
 
        // Memeriksa apakah hasil pencarian tidak kosong dan kata sandi cocok.
        if (!empty($result) && md5($password) === $result['password']) {
            // Jika berhasil login:
 
            // Membuat array $data_sess untuk sesi pengguna.
            $data = [
                'logged_in' => TRUE, // Menandakan bahwa pengguna sudah login.
                'email' => $result['email'],
                'username' => $result['username'],
                'role' => $result['role'], // Menyimpan peran pengguna (admin/karyawan).
                'id_superadmin' => $result['id_superadmin'],
            ];
            // Mengatur data sesi pengguna dengan informasi di atas.
            $this->session->set_userdata($data);
            // Mengarahkan pengguna ke halaman berdasarkan peran mereka.
            redirect(base_url()."superadmin");
        } else {
            // Jika login gagal, menampilkan pesan kesalahan kepada pengguna.
           $this->session->set_flashdata('gagal_login', 'Silahkan coba kembali.');
           redirect(base_url().'auth'); // Mengarahkan pengguna kembali ke halaman login.
        }
    }
    
	public function aksi_login_admin()
    {
        // Mengambil data email dan password yang dikirimkan melalui form login.
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        // Membuat array $data untuk mencari pengguna berdasarkan alamat email.
        $data = [
            'email' => $email,
        ];
        // Mencari data pengguna dengan alamat email yang sesuai dalam database.
        $query = $this->m_model->getwhere('admin', $data);
        // Mengambil hasil pencarian dalam bentuk array asosiatif.
        $result = $query->row_array();
 
        // Memeriksa apakah hasil pencarian tidak kosong dan kata sandi cocok.
        if (!empty($result) && md5($password) === $result['password']) {
            // Jika berhasil login:
 
            // Membuat array $data_sess untuk sesi pengguna.
            $data = [
                'logged_in' => TRUE, // Menandakan bahwa pengguna sudah login.
                'email' => $result['email'],
                'username' => $result['username'],
                'role' => $result['role'], // Menyimpan peran pengguna (admin/karyawan).
                'id' => $result['id_admin'],
            ];
            // Mengatur data sesi pengguna dengan informasi di atas.
            $this->session->set_userdata($data);
            // Mengarahkan pengguna ke halaman berdasarkan peran mereka.
            redirect(base_url()."admin");
        } else {
            // Jika login gagal, menampilkan pesan kesalahan kepada pengguna.
           $this->session->set_flashdata('gagal_login', 'Silahkan coba kembali.');
           redirect(base_url().'auth'); // Mengarahkan pengguna kembali ke halaman login.
        }
    }

	public function aksi_login_user()
    {
        // Mengambil data email dan password yang dikirimkan melalui form login.
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        // Membuat array $data untuk mencari pengguna berdasarkan alamat email.
        $data = [
            'email' => $email,
        ];
        // Mencari data pengguna dengan alamat email yang sesuai dalam database.
        $query = $this->m_model->getwhere('user', $data);
        // Mengambil hasil pencarian dalam bentuk array asosiatif.
        $result = $query->row_array();
 
        // Memeriksa apakah hasil pencarian tidak kosong dan kata sandi cocok.
        if (!empty($result) && md5($password) === $result['password']) {
            // Jika berhasil login:
 
            // Membuat array $data_sess untuk sesi pengguna.
            $data = [
                'logged_in' => TRUE, // Menandakan bahwa pengguna sudah login.
                'email' => $result['email'],
                'username' => $result['username'],
                'role' => $result['role'], // Menyimpan peran pengguna (admin/karyawan).
                'id' => $result['id'],
            ];
            // Mengatur data sesi pengguna dengan informasi di atas.
            $this->session->set_userdata($data);
            // Mengarahkan pengguna ke halaman berdasarkan peran mereka.
            redirect(base_url()."user");
        } else {
            // Jika login gagal, menampilkan pesan kesalahan kepada pengguna.
           $this->session->set_flashdata('gagal_login', 'Silahkan coba kembali.');
           redirect(base_url().'auth'); // Mengarahkan pengguna kembali ke halaman login.
        }
    }

    // Aksi logout
	function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}
?>