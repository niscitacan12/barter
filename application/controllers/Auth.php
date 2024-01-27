<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    // register admin
    public function index()
    {
        $this->load->view('auth/register_admin_barter');
    }

     // register user
     public function register_user_barter()
     {
         $this->load->view('auth/register_user_barter');
     }

    // login
    public function login_barter()
    {
        $this->load->view('auth/login_barter');
    }

    // aksi regsiter admin
    public function aksi_register()
    {
        $email = $this->input->post('email', true);
        $username = $this->input->post('username', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $password = md5($this->input->post('password', true));
        $role = 'admin'; 

        $data = [
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'password' => $password,
            'role' => $role,
        ];

        $table = 'admin'; 
        $this->db->insert($table, $data);

        if ($this->db->affected_rows() > 0) {
            // Registrasi berhasil
            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect(base_url('auth/login_barter'));
        } else {
            $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi.');
            redirect(base_url('auth'));
        }
    }

    // aksi register user
    public function aksi_register_user()
    {
        $email = $this->input->post('email', true);
        $username = $this->input->post('username', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $password = md5($this->input->post('password', true));
        $role = 'user'; 

        $data = [
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'password' => $password,
            'role' => $role,
        ];

        $table = 'user'; 
        $this->db->insert($table, $data);

        if ($this->db->affected_rows() > 0) {
            // Registrasi berhasil
            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect(base_url('auth/login_barter'));
        } else {
            $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi.');
            redirect(base_url('auth'));
        }
    }

    // aksi login
    public function aksi_login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $tables = ['admin', 'user'];

        foreach ($tables as $table) {
            $data = [
                'email' => $email,
            ];

            $query = $this->m_model->getwhere($table, $data);
            $result = $query->row_array();

            if (!empty($result) && md5($password) === $result['password']) {
                $data_sess = [
                    'logged_in' => TRUE,
                    'email' => $result['email'],
                    'username' => $result['username'],
                    'role' => $result['role'],
                    'id' => $result['id'],
                ];

                $this->session->set_userdata($data_sess);
                $this->session->set_flashdata(
                    'login_success',
                    'Selamat Datang Di Absensi.'
                );

                redirect(base_url() . $table);
            }
        }

         $this->session->set_flashdata('login_error', 'Silahkan coba kembali.');
         redirect(base_url() . 'auth/login_barter'); 
     }

    // aksi logout
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth/login_barter'));
    }
}
?>