Superadmin.php:

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('super_helper');
        $this->load->model('super_model');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->library('pagination');
        if (
            $this->session->userdata('logged_in') != true ||
            $this->session->userdata('role') != 'superadmin'
        ) {
            redirect(base_url() . 'auth');
        }
    }

    // 1. Page
    // Page Dashboard / Utama
    public function index()
    {
        $id_superadmin = $this->session->userdata('id');
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->num_rows();
        $data['admin'] = $this->super_model->get_admin_count();
        $data['user'] = $this->super_model->get_user_count();
        $data['tokens'] = $this->super_model->get_token_data();
        $data['users'] = $this->super_model->get_user();
        $this->load->view('page/super_admin/dashboard', $data);
    }

    // Page Organisasi
    public function organisasi()
    {
        // Config
        $config['base_url'] = base_url('superadmin/organisasi');
        $config['total_rows'] = $this->super_model->count_all('organisasi'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
        $config['per_page'] = 10;

        // Styling pagination
        $config['full_tag_open'] =
            '<nav class="flowbite-nav" aria-label="Page navigation example"><ul class="flowbite-pagination flex items-center -space-x-px h-8 text-sm">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] =
            '<li aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</li>';

        // Applying Tailwind Classes
        $config['num_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        // Data Organisasi
        $data['organisasi'] = $this->super_model->pagination(
            'organisasi',
            $config['per_page'],
            $data['start']
        );
        $this->load->view('page/super_admin/organisasi/organisasi', $data);
    }

    // Page Tambah Organisasi
    public function tambah_organisasi()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $this->load->view(
            'page/super_admin/organisasi/tambah_organisasi',
            $data
        );
    }

    // Page Update Organisasi
    public function update_organisasi($id_organisasi)
    {
        $data['organisasi'] = $this->super_model->getOrganisasiById(
            $id_organisasi
        );
        $this->load->view(
            'page/super_admin/organisasi/update_organisasi',
            $data
        );
    }

    // Page Detail Organisasi
    public function detail_organisasi($organisasi_id)
    {
        // Mendefinisikan data yang akan digunakan dalam tampilan
        $user_id = $this->session->userdata('id');
        $data['organisasi'] = $this->super_model->getOrganisasiDetails(
            $organisasi_id
        );
        $this->load->view(
            'page/super_admin/organisasi/detail_organisasi',
            $data
        );
    }

    // Page Admin
    public function admin()
    {
        // Config
        $config['base_url'] = base_url('superadmin/admin');
        $config['total_rows'] = $this->super_model->count_all('admin'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
        $config['per_page'] = 10;

        // Styling pagination
        $config['full_tag_open'] =
            '<nav class="flowbite-nav" aria-label="Page navigation example"><ul class="flowbite-pagination flex items-center -space-x-px h-8 text-sm">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] =
            '<li aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</li>';

        // Applying Tailwind Classes
        $config['num_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        // Data User
        $data['user'] = $this->super_model->pagination(
            'admin',
            $config['per_page'],
            $data['start']
        );
        $this->load->view('page/super_admin/admin/admin', $data);
    }

    // Page Tambah Admin
    public function tambah_admin()
    {
        // $data['id_superadmin'] = $this->session->userdata('id');
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->result();
        $this->load->view('page/super_admin/admin/tambah_admin', $data);
    }

    // Page Edit Admin
    public function update_admin($id_admin)
    {
        // $id_admin = $this->session->userdata('id_admin');
        $data['admin'] = $this->super_model->getAdminById($id_admin);
        $this->load->view('page/super_admin/admin/update_admin', $data);
    }

    // Page Detail admin
    public function detail_admin($admin_id)
    {
        // $data['id_superadmin'] = $this->session->userdata('id');
        $user_id = $this->session->userdata('id');
        $data['admin'] = $this->super_model->getAdminDetails($admin_id);
        $this->load->view('page/super_admin/admin/detail_admin', $data);
    }

    // Page User
    public function user()
    {
        // Config
        $config['base_url'] = base_url('superadmin/user');
        $config['total_rows'] = $this->super_model->count_all('user'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
        $config['per_page'] = 10;

        // Styling pagination
        $config['full_tag_open'] =
            '<nav class="flowbite-nav" aria-label="Page navigation example"><ul class="flowbite-pagination flex items-center -space-x-px h-8 text-sm">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] =
            '<li aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</li>';

        // Applying Tailwind Classes
        $config['num_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        // Data User
        $user_id = $this->session->userdata('id');
        $data['user'] = $this->super_model->pagination(
            'user',
            $config['per_page'],
            $data['start']
        );
        $this->load->view('page/super_admin/user/user', $data);
    }

    // Page Tambah User
    public function tambah_user()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->result();
        $data['shift'] = $this->super_model->get_data('shift')->result();
        $data['jabatan'] = $this->super_model->get_data('jabatan')->result();
        $this->load->view('page/super_admin/user/tambah_user', $data);
    }

    // Page Update User
    public function update_user($id_user)
    {
        $data['user'] = $this->super_model->getUserId($id_user);
        $this->load->view('page/super_admin/user/update_user', $data);
    }

    // Page Detail User
    public function detail_user($user_id)
    {
        $data['user'] = $this->super_model->getUserDetails($user_id);

        // Mengirim data pengguna ke view
        $this->load->view('page/super_admin/user/detail_user', $data);
    }

    // Page Absensi
    public function absensi()
    {
        // Config
        $config['base_url'] = base_url('superadmin/absensi');
        $config['total_rows'] = $this->super_model->count_all('absensi'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
        $config['per_page'] = 10;

        // Styling pagination
        $config['full_tag_open'] =
            '<nav class="flowbite-nav" aria-label="Page navigation example"><ul class="flowbite-pagination flex items-center -space-x-px h-8 text-sm">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] =
            '<li aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</li>';

        // Applying Tailwind Classes
        $config['num_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        // Data absensi
        $data['absensi'] = $this->super_model->pagination(
            'absensi',
            $config['per_page'],
            $data['start']
        );
        $this->load->view('page/super_admin/absen/absensi', $data);
    }

    // Page Jabatan
    public function jabatan()
    {
        // Config
        $config['base_url'] = base_url('superadmin/jabatan');
        $config['total_rows'] = $this->super_model->count_all('jabatan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
        $config['per_page'] = 10;

        // Styling pagination
        $config['full_tag_open'] =
            '<nav class="flowbite-nav" aria-label="Page navigation example"><ul class="flowbite-pagination flex items-center -space-x-px h-8 text-sm">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] =
            '<li aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</li>';

        // Applying Tailwind Classes
        $config['num_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        // Data n
        $data['jabatan'] = $this->super_model->pagination(
            'jabatan',
            $config['per_page'],
            $data['start']
        );
        $this->load->view('page/super_admin/jabatan/jabatan', $data);
    }

    // Page Tambah Jabatan
    public function tambah_jabatan()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $this->load->view('page/super_admin/jabatan/tambah_jabatan', $data);
    }

    // Page Update Jabatan
    public function update_jabatan($id_jabatan)
    {
        $data['jabatan'] = $this->super_model->getJabatanId($id_jabatan);
        $this->load->view('page/super_admin/jabatan/update_jabatan', $data);
    }

    // Page Shift
    public function shift()
    {
        // Config
        $config['base_url'] = base_url('superadmin/shift');
        $config['total_rows'] = $this->super_model->count_all('shift'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
        $config['per_page'] = 10;

        // Styling pagination
        $config['full_tag_open'] =
            '<nav class="flowbite-nav" aria-label="Page navigation example"><ul class="flowbite-pagination flex items-center -space-x-px h-8 text-sm">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] =
            '<li aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</li>';

        // Applying Tailwind Classes
        $config['num_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        // Data Shift
        $data['shift'] = $this->super_model->pagination(
            'shift',
            $config['per_page'],
            $data['start']
        );
        // $data['shift'] = $this->super_model->get_data('shift')->result();
        $this->load->view('page/super_admin/shift/shift', $data);
    }

    // Page Tambah Shift
    public function tambah_shift()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $this->load->view('page/super_admin/shift/tambah_shift', $data);
    }

    // Page Update Shift
    public function update_shift($id_shift)
    {
        $data['shift'] = $this->super_model->getShiftId($id_shift);
        $this->load->view('page/super_admin/shift/update_shift', $data);
    }

    // Page Profile
    public function profile()
    {
        if ($this->session->userdata('id')) {
            $user_id = $this->session->userdata('id');
            $data['superadmin'] = $this->super_model->getSuperAdminByID(
                $user_id
            );

            $this->load->view('page/super_admin/profile/profile', $data);
        } else {
            redirect('auth');
        }
    }

    // page detail absen
    public function detail_absen($id_absensi)
    {
        $data['absensi'] = $this->super_model->getAbsensiDetails($id_absensi);
        // Menampilkan view update_jabatan dengan data jabatan
        $this->load->view('page/super_admin/absen/detail_absensi', $data);
    }

    // page detail jabatan
    public function detail_jabatan($id_jabatan)
    {
        $data['jabatan'] = $this->super_model->getJabatanDetails($id_jabatan);

        // Mengirim data pengguna ke view
        $this->load->view('page/super_admin/jabatan/detail_jabatan', $data);
    }

    public function detail_shift($id_shift)
    {
        // Memanggil method getShiftDetails untuk mendapatkan data shift berdasarkan ID
        $data['shift'] = $this->super_model->getShiftDetails($id_shift);

        if ($data['shift']) {
            // Jika data shift ditemukan, tambahkan informasi lain yang dibutuhkan ke dalam data
            $data['judul'] = 'Detail Shift - Superadmin';
            $data['deskripsi'] =
                'Ini adalah halaman detail shift untuk superadmin.';
            $this->load->view('page/super_admin/shift/detail_shift', $data);
        } else {
            // Jika data shift tidak ditemukan, lakukan sesuai kebutuhan aplikasi Anda
            // Misalnya, tampilkan pesan error atau lakukan redirect ke halaman lain
            // Contoh: $this->load->view('page/error/not_found');
            // atau: redirect('superadmin/shift_not_found');
        }
    }

    public function lokasi()
    {
        // Config
        $config['base_url'] = base_url('superadmin/lokasi');
        $config['total_rows'] = $this->super_model->count_all('lokasi'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
        $config['per_page'] = 10;

        // Styling pagination
        $config['full_tag_open'] =
            '<nav class="flowbite-nav" aria-label="Page navigation example"><ul class="flowbite-pagination flex items-center -space-x-px h-8 text-sm">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] =
            '<li aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</li>';

        // Applying Tailwind Classes
        $config['num_tag_open'] =
            '<li class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        // Data lokasi
        $data['lokasi'] = $this->super_model->pagination(
            'lokasi',
            $config['per_page'],
            $data['start']
        );
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->result();

        // Menampilkan view dengan data
        $this->load->view('page/super_admin/lokasi/lokasi', $data);
    }

    // page tambah lokasi
    public function tambah_lokasi()
    {
        $this->load->model('super_model');

        // Get organizational data
        $data['organisasi'] = $this->super_model->get_all_organisasi();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form telah disubmit, lakukan logika penyimpanan data ke database atau tindakan lainnya
            $lokasi_data = [
                'nama_lokasi' => $this->input->post('nama_lokasi'),
                'alamat' => $this->input->post('alamat_kantor'),
                'id_organisasi' => $this->input->post('id_organisasi'), // Fix the input field name
                // tambahkan kolom lainnya sesuai kebutuhan
            ];

            // Check if 'id_organisasi' is set and not null
            if ($lokasi_data['id_organisasi']) {
                // Tidak perlu menggunakan $this->db->set($data);
                // Setelah mendapatkan data, baru Anda bisa menggunakan metode set untuk operasi insert
                // Anda perlu mengatur setiap kolom yang ingin diinsert
                foreach ($lokasi_data as $key => $value) {
                    $this->db->set($key, $value);
                }

                $this->db->insert('lokasi');

                // Redirect ke halaman admin/lokasi setelah menambahkan data
                redirect('superadmin/lokasi');
            } else {
                // Handle the case where 'id_organisasi' is not set or null
                // You might want to show an error message or redirect to the form page with an error
                echo 'Error: ID Organisasi cannot be null.';
            }
        } else {
            // Form belum disubmit, ambil data organisasi dan tampilkan view untuk mengisi form
            $this->load->view('page/super_admin/lokasi/tambah_lokasi', $data);
        }
    }

    // page detail lokasi
    public function detail_lokasi($lokasi_id)
    {
        $data['lokasi'] = $this->super_model->getLokasiData($lokasi_id);

        // Mengirim data lokasi ke view
        $this->load->view('page/super_admin/lokasi/detail_lokasi', $data);
    }

    // page update lokasi
    public function update_lokasi($id_lokasi)
    {
        // Load necessary models or helpers here
        $this->load->model('super_model');

        // Assuming you have a method in your model to get location details by ID
        $data['lokasi'] = $this->super_model->getLokasiById($id_lokasi);

        // Load the view for updating location details
        $this->load->view('page/super_admin/lokasi/update_lokasi', $data);
    }

    public function aksi_edit_lokasi()
    {
        // Mendapatkan data dari form
        $id_lokasi = $this->input->post('id_lokasi');
        $nama_lokasi = $this->input->post('nama_lokasi');
        $alamat = $this->input->post('alamat');

        // Buat data yang akan diupdate
        $data = [
            'nama_lokasi' => $nama_lokasi,
            'alamat' => $alamat,
            // Tambahkan field lain jika ada
        ];

        // Lakukan pembaruan data Lokasi
        $this->super_model->update_lokasi($id_lokasi, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('superadmin/lokasi'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Lokasi
    }

    public function hapus_lokasi($id_lokasi)
    {
        $this->super_model->hapus_lokasi($id_lokasi); // Assuming you have a method 'hapus_lokasi' in the model
        redirect('superadmin/lokasi');
    }

    // ini page buat ubah password nya
    public function aksi_ubah_password()
    {
        $user_id = $this->session->userdata('id');
        $password_baru = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');

        // Check if new password is provided
        if (!empty($password_baru)) {
            // Check if the new password matches the confirmation
            if ($password_baru === $konfirmasi_password) {
                $data_password = [
                    'password' => md5($password_baru),
                ];

                // Update password di database
                $this->super_model->updateSuperAdminPassword(
                    $user_id,
                    $data_password
                );
            } else {
                $this->session->set_flashdata(
                    'message',
                    'Password baru dan Konfirmasi password harus sama'
                );
                redirect(base_url('superadmin/profile'));
            }
        }

        // Redirect ke halaman profile
        redirect(base_url('superadmin/profile'));
    }

    // 2. Aksi

    // aksi tambah admin
    public function aksi_tambah_admin()
    {
        $id_superadmin = $this->session->userdata('id');
        // Ambil data yang diperlukan dari form
        $password = $this->input->post('password');
        if (strlen($password) < 8) {
            // Password kurang dari 8 karakter, berikan pesan kesalahan
            $this->session->set_flashdata(
                'gagal_tambah',
                'Password harus memiliki panjang minimal 8 karakter'
            );
            redirect('superadmin/admin'); // Redirect kembali ke halaman sebelumnya
            return; // Hentikan eksekusi jika validasi gagal
        }

        // Ambil data yang diperlukan dari form
        $data = [
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'nama_depan' => $this->input->post('nama_depan'),
            'nama_belakang' => $this->input->post('nama_belakang'),
            'password' => md5($password), // Simpan kata sandi yang telah di-MD5
            'image' => 'User.png',
            'id_superadmin' => $id_superadmin,
            'role' => 'admin',
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('admin', $data); // Panggil method pada model
        $this->session->set_flashdata(
            'berhasil_tambah',
            'Berhasil Menambahkan Data'
        );

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
            'status' => 'pusat',
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('organisasi', $data); // Panggil method pada model
        $this->session->set_flashdata(
            'berhasil_tambah',
            'Berhasil Menambahkan Data'
        );

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/organisasi');
    }

    // aksi tambah user
    public function aksi_tambah_user()
    {
        // Ambil data yang diperlukan dari form
        $password = $this->input->post('password');
        if (strlen($password) < 8) {
            // Password kurang dari 8 karakter, berikan pesan kesalahan
            $this->session->set_flashdata(
                'gagal_tambah',
                'Password harus memiliki panjang minimal 8 karakter'
            );
            redirect('superadmin/user'); // Redirect kembali ke halaman sebelumnya
            return; // Hentikan eksekusi jika validasi gagal
        }

        // Ambil data yang diperlukan dari form
        $data = [
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'nama_depan' => $this->input->post('nama_depan'),
            'nama_belakang' => $this->input->post('nama_belakang'),
            'password' => md5($password),
            'id_admin' => '', // Untuk menampung id_admin yang akan diambil
            'id_organisasi' => $this->input->post('id_organisasi'),
            'id_shift' => $this->input->post('id_shift'),
            'id_jabatan' => $this->input->post('id_jabatan'),
            'image' => 'User.png',
            'role' => 'user',
        ];

        // Ambil id_admin berdasarkan id_organisasi yang dipilih
        $id_admin = $this->super_model->get_id_admin_by_organisasi(
            $data['id_organisasi']
        ); // Ganti dengan model dan method yang sesuai

        if ($id_admin) {
            $data['id_admin'] = $id_admin; // Jika berhasil, set id_admin
            $this->super_model->tambah_data('user', $data); // Simpan data ke tabel
            $this->session->set_flashdata(
                'berhasil_tambah',
                'Berhasil Menambahkan Data'
            );
            redirect('superadmin/user');
        } else {
            $this->session->set_flashdata(
                'gagal_tambah',
                'Tidak ada admin yang terkait dengan organisasi ini'
            );
            redirect('superadmin/tambah_user'); // Redirect kembali ke halaman formulir tambah user
        }
    }

    // aksi tambah jabatan
    public function aksi_tambah_jabatan()
    {
        $id_superadmin = $this->session->userdata('id');
        // Ambil data yang diperlukan dari form
        $data = [
            'nama_jabatan' => $this->input->post('nama_jabatan'),
            'id_admin' => $this->input->post('id_admin'),
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('jabatan', $data); // Panggil method pada model
        $this->session->set_flashdata(
            'berhasil_tambah',
            'Berhasil Menambahkan Data'
        );

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/jabatan');
    }

    // aksi tambah shift
    public function aksi_tambah_shift()
    {
        $id_superadmin = $this->session->userdata('id');
        // Ambil data yang diperlukan dari form
        $data = [
            'nama_shift' => $this->input->post('nama_shift'),
            'jam_masuk' => $this->input->post('jam_masuk'),
            'jam_pulang' => $this->input->post('jam_pulang'),
            'id_admin' => $this->input->post('id_admin'),
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('shift', $data); // Panggil method pada model
        $this->session->set_flashdata(
            'berhasil_tambah',
            'Berhasil Menambahkan Data'
        );

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/shift');
    }

    // Aksi Update Organisasi
    public function aksi_edit_organisasi()
    {
        // Mendapatkan data dari form
        $id_organisasi = $this->input->post('id_organisasi');
        $nama_organisasi = $this->input->post('nama_organisasi');
        $nomor_telepon = $this->input->post('nomor_telepon');
        $email_organisasi = $this->input->post('email_organisasi');
        $kecamatan = $this->input->post('kecamatan');
        $alamat = $this->input->post('alamat');
        $kabupaten = $this->input->post('kabupaten');
        $provinsi = $this->input->post('provinsi');

        // Buat data yang akan diupdate
        $data = [
            'nama_organisasi' => $nama_organisasi,
            'email_organisasi' => $email_organisasi,
            'nomor_telepon' => $nomor_telepon,
            'kecamatan' => $kecamatan,
            'alamat' => $alamat,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
            // Tambahkan field lain jika ada
        ];

        // Lakukan pembaruan data Admin
        $eksekusi = $this->super_model->update_organisasi(
            $id_organisasi,
            $data
        );
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect(base_url('superadmin/organisasi')); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Admin
    }

    // Aksi Update User
    public function aksi_edit_user()
    {
        // Mendapatkan data dari form
        $id_user = $this->input->post('id_user');
        $username = $this->input->post('username');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');

        // Buat data yang akan diupdate
        $data = [
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            // Tambahkan field lain jika ada
        ];

        // Lakukan pembaruan data Admin
        $this->super_model->update_user($id_user, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('superadmin/user'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Admin
    }

    // aksi Update jabatan
    public function aksi_edit_jabatan()
    {
        // Mendapatkan data dari form
        $id_jabatan = $this->input->post('id_jabatan');
        $nama_jabatan = $this->input->post('nama_jabatan');

        // Buat data yang akan diupdate
        $data = [
            'nama_jabatan' => $this->input->post('nama_jabatan'),
            // Tambahkan field lain jika ada
        ];

        // Lakukan pembaruan data Admin
        $this->super_model->update_jabatan($id_jabatan, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/jabatan');
    }

    // aksi Update jabatan
    public function aksi_edit_shift()
    {
        // Mendapatkan data dari form
        $id_shift = $this->input->post('id_shift');
        $nama_shift = $this->input->post('nama_shift');
        $jam_masuk = $this->input->post('jam_masuk');
        $jam_pulang = $this->input->post('jam_pulang');

        // Buat data yang akan diupdate
        $data = [
            'nama_shift' => $this->input->post('nama_shift'),
            'jam_masuk' => $this->input->post('jam_masuk'),
            'jam_pulang' => $this->input->post('jam_pulang'),
            // Tambahkan field lain jika ada
        ];

        // Lakukan pembaruan data Admin
        $this->super_model->update_shift($id_shift, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/shift');
    }

    // aksi Update admin
    public function aksi_edit_admin()
    {
        // Mendapatkan data dari form
        $id_admin = $this->input->post('id_admin');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');

        // Buat data yang akan diupdate
        $data = [
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            // Tambahkan field lain jika ada
        ];

        // Lakukan pembaruan data Admin
        $this->super_model->update_admin($id_admin, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('superadmin/admin'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Admin
    }

    // aksi hapus admin
    public function hapus_admin($id_admin)
    {
        $this->super_model->hapus_admin($id_admin);
        redirect('superadmin/admin');
    }

    // aksi hapus organisasi
    public function hapus_organisasi($id_organisasi)
    {
        $this->super_model->hapus_organisasi($id_organisasi);
        redirect('superadmin/organisasi');
    }

    // aksi hapus jabatan
    public function hapus_jabatan($id_jabatan)
    {
        $this->super_model->hapus_jabatan($id_jabatan);
        redirect('superadmin/jabatan');
    }

    // aksi hapus shift
    public function hapus_shift($id_shift)
    {
        $this->super_model->hapus_shift($id_shift);
        redirect('superadmin/shift');
    }

    // aksi hapus user
    public function hapus_user($id_user)
    {
        $this->super_model->hapus_user($id_user);
        redirect('superadmin/user');
    }

    // aksi ubah akun
    public function aksi_ubah_detail_akun()
    {
        $image = $this->upload_image_superadmin('image');

        $user_id = $this->session->userdata('id');
        $admin = $this->super_model->getSuperAdminByID($user_id);

        if ($image[0] == true) {
            $admin->image = $image[1];
        }

        $password_baru = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');
        $email = $this->input->post('email');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');
        $username = $this->input->post('username');

        $data = [
            'image' => $image[1],
            'email' => $email,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'username' => $username,
        ];

        // Check if new password is provided
        if (!empty($password_baru)) {
            // Check if the new password matches the confirmation
            if ($password_baru === $konfirmasi_password) {
                $data['password'] = md5($password_baru);
            } else {
                $this->session->set_flashdata(
                    'message',
                    'Password baru dan Konfirmasi password harus sama'
                );
                redirect(base_url('superadmin/profile'));
            }
        }

        // Update the superadmin data in the database
        $update_result = $this->super_model->update('superadmin', $data, [
            'id_superadmin' => $user_id,
        ]);

        if ($update_result) {
            $this->session->set_flashdata('message', 'Profil berhasil diubah');
        } else {
            $this->session->set_flashdata('message', 'Gagal mengubah profil');
        }

        redirect(base_url('superadmin/profile'));
    }

    // 3. Lain-lain
    public function get_realtime_absensi()
    {
        // Panggil metode di dalam model untuk mendapatkan data absensi real-time
        $realtime_absensi = $this->super_model->get_realtime_absensi();

        // Mengirim data dalam format JSON
        echo json_encode($realtime_absensi);
    }

    // 3. Lain-lain
    // untuk ubah foto
    public function aksi_ubah_foto()
    {
        $image = $this->upload_image_superadmin('image');
        $user_id = $this->session->userdata('id');
        $admin = $this->super_model->getSuperAdminByID($user_id);

        if ($image[0] == true) {
            $admin->image = $image[1];
        }

        $data = [
            'image' => $image[1],
        ];

        // Update foto di database
        $this->super_model->updateSuperAdminPhoto($user_id, $data);

        // Set flash data untuk memberi tahu user tentang hasil pembaruan foto
        if ($update_result) {
            $this->session->set_flashdata(
                'gagal_update',
                'Gagal mengubah foto'
            );
        } else {
            $this->session->set_flashdata(
                'berhasil_ubah_foto',
                'Berhasil mengubah foto'
            );
        }

        // Redirect ke halaman profile
        redirect(base_url('superadmin/profile'));
    }

    public function update_password()
    {
        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');

        $stored_password = $this->super_model->getPasswordById(
            $this->session->userdata('id')
        );

        if (md5($password_lama) != $stored_password) {
            $this->session->set_flashdata(
                'kesalahan_password_lama',
                'Password lama yang dimasukkan salah'
            );
        } else {
            if ($password_baru === $konfirmasi_password) {
                $update_result = $this->super_model->update_password(
                    $this->session->userdata('id'),
                    md5($password_baru)
                );
                if ($update_result) {
                    $this->session->set_flashdata(
                        'ubah_password',
                        'Berhasil mengubah password'
                    );
                } else {
                    $this->session->set_flashdata(
                        'gagal_update',
                        'Gagal memperbarui password'
                    );
                }
            } else {
                $this->session->set_flashdata(
                    'kesalahan_password',
                    'Password baru dan Konfirmasi password tidak sama'
                );
            }
        }
        redirect(base_url('superadmin/profile'));
    }

    // Pembaruan profil admin
    public function edit_profile()
    {
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');

        $data = [
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
        ];

        $update_result = $this->super_model->update_data('superadmin', $data, [
            'id_superadmin' => $this->session->userdata('id'),
        ]);

        if ($update_result) {
            $this->session->set_flashdata(
                'berhasil_ubah_foto',
                'Data berhasil diperbarui'
            );
        } else {
            $this->session->set_flashdata(
                'gagal_update',
                'Gagal memperbarui data'
            );
        }

        redirect(base_url('superadmin/profile'));
    }

    public function upload_image_superadmin($value)
    {
        // Mendapatkan ID pengguna dari sesi
        $user_id = $this->session->userdata('id');

        // Mendapatkan nama file foto saat ini
        $superadmin = $this->super_model->getSuperAdminByID($user_id);
        $current_image = $superadmin->image;

        // Generate kode unik untuk nama file baru
        $kode = round(microtime(true) * 1000);

        // Konfigurasi upload
        $config['upload_path'] = './images/superadmin/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 30000;
        $config['file_name'] = $kode;
        $this->upload->initialize($config);

        // Lakukan proses upload
        if (!$this->upload->do_upload($value)) {
            return [false, ''];
        } else {
            // Jika upload berhasil, dapatkan informasi file baru
            $fn = $this->upload->data();
            $new_image = $fn['file_name'];

            // Hapus foto sebelumnya jika ada
            if (!empty($current_image)) {
                $image_path = './images/superadmin/' . $current_image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            // Kembalikan hasil upload baru
            return [true, $new_image];
        }
    }

    public function tampil_admin()
    {
        $this->load->model('nama_model_anda'); // Ganti 'nama_model_anda' dengan nama model yang sesuai
        $data['user'] = $this->nama_model_anda->get_all_admin(); // Mengambil data admin
        $data['total_admin'] = $this->nama_model_anda->get_admin_count(); // Menghitung jumlah admin

        // Lainnya seperti pengaturan tampilan flashdata

        $this->load->view('page/super_admin/dashboard', $data);
    }

    public function token()
    {
        $this->load->model('super_model');
        $data['user'] = $this->super_model->get_user();

        // Lainnya seperti pengaturan tampilan flashdata

        $this->load->view('page/super_admin/token/token', $data);
    }
}