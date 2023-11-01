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
    
    public function register_superadmin() {
        // Ambil data dari formulir pendaftaran (form POST)
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');
        $password = $this->input->post('password');
        // Enkripsi password dengan MD5
        $password_hash = md5($password);

        // Load model untuk berinteraksi dengan database
        $this->load->model('m_model');

        // Panggil method di model untuk menambahkan data superadmin
        $this->m_model->create_superadmin($email, $username, $nama_depan, $nama_belakang, $password_hash);

        // Redirect ke halaman setelah pendaftaran (misalnya, halaman login)
        redirect('auth/login');
    }

    public function login(){
        $this->load->view('auth/login');
    }

    public function cccccccc()
    {
        // Ambil data email dan password dari form login
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Load model untuk berinteraksi dengan database
        $this->load->model('M_model');

        // Panggil method di model untuk mencari pengguna berdasarkan email
        $user = $this->M_model->get_user_by_email($email);

        if ($user) {
            // Jika pengguna ditemukan, periksa password
            if (md5($password) === $user->password) {
                // Password cocok, beri tanda bahwa pengguna sudah login (misalnya, dengan menggunakan session)
                $data = [
                    'user_id' => $user->id, // Gantilah ini sesuai dengan struktur tabel
                    'username' => $user->username, // Gantilah ini sesuai dengan struktur tabel
                    // Tambahkan data lain yang perlu Anda simpan dalam session
                ];

                $this->session->set_userdata($data);

                // Redirect ke halaman setelah login (misalnya, dashboard)
                redirect('superadmin');
            } else {
                // Password tidak cocok, tampilkan pesan kesalahan
                echo 'Password salah';
            }
        } else {
            // Pengguna tidak ditemukan, tampilkan pesan kesalahan
            echo 'Email tidak ditemukan';
        }
    }

}
?>