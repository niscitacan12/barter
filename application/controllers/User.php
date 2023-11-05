<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    function __construct(){
		parent::__construct();
        $this->load->helper('my_helper');
		if($this->session->userdata('logged_in')!=true || $this->session->userdata('role') != 'user') {
            redirect(base_url().'auth/login');
        }
	}

	public function index()
	{
		$this->load->view('page/user/dashboard');
	}
}