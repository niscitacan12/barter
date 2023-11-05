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
    
    // public function aksi_register_superadmin() {
    //     // Ambil data dari formulir pendaftaran (form POST)
    //     $email = $this->input->post('email');
    //     $username = $this->input->post('username');
    //     $nama_depan = $this->input->post('nama_depan');
    //     $nama_belakang = $this->input->post('nama_belakang');
    //     $password = $this->input->post('password');
    //     // Enkripsi password dengan MD5
    //     $password_hash = md5($password);

    //     // Load model untuk berinteraksi dengan database
    //     $this->load->model('m_model');

    //     // Panggil method di model untuk menambahkan data superadmin
    //     $this->m_model->create_superadmin($email, $username, $nama_depan, $nama_belakang, $password_hash);

    //     // Redirect ke halaman setelah pendaftaran (misalnya, halaman login)
    //     redirect('auth/login');
    // }

    public function index(){
        $this->load->view('auth/login');
    }

    // Aksi untuk login
	public function aksi_login()
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
            if ($this->session->userdata('role') == 'superadmin') {
               $this->session->set_flashdata('berhasil_login', 'Selamat datang diaplikasi absensi.');
               redirect(base_url() . 'superadmin');
           } elseif ($this->session->userdata('role') == 'admin') {
               $this->session->set_flashdata('berhasil_login', 'Selamat datang diaplikasi absensi.');
    		    redirect(base_url() . "admin");
           } elseif ($this->session->userdata('role') == 'user') {
               $this->session->set_flashdata('berhasil_login', 'Selamat datang diaplikasi absensi.');
    		    redirect(base_url() . "user");
           } else {
               redirect(base_url()."auth");
           }
        } else {
            // Jika login gagal, menampilkan pesan kesalahan kepada pengguna.
           $this->session->set_flashdata('gagal_login', 'Silahkan coba kembali.');
           redirect(base_url().'auth'); // Mengarahkan pengguna kembali ke halaman login.
        }
    }
}
?>