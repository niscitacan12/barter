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
        $data['absensi'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('page/admin/absensi', $data);
    }
    public function profile()
    {
       
        $this->load->view('page/admin/profile');
    }
}
