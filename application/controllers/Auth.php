<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->library('form_validation');
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
        redirect('login');
    }

}