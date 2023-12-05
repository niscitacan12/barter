<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('upload');
        $this->load->helper('admin_helper');
        $this->load->library('pagination');
        if (
            $this->session->userdata('logged_in') != true ||
            $this->session->userdata('role') != 'admin'
        ) {
            redirect(base_url() . 'auth');
        }
    }

    // 1. Page
    // Page Dashboard
    public function index()
    {
        $data['cuti_count'] = $this->admin_model->get_cuti_count();
        $data['cuti'] = $this->admin_model->get_cuti_data();
        $id_admin = $this->session->userdata('id');
        $data['user_count'] = $this->admin_model->get_user_count();
        $data['absensi']['count'] = $this->admin_model->get_absensi_count();
        $data['absensi']['data'] = $this->admin_model->get_absen_data();
        $data['lokasi'] = $this->admin_model->get_lokasi_data();
        $data['organisasi'] = $this->admin_model->get_organisasi_data();
        $data['user'] = $this->admin_model->get_user_data();

        // Modifikasi baris di bawah untuk mendapatkan data absen berdasarkan tanggal
        $data[
            'absensi_by_date'
        ] = $this->admin_model->get_absensi_count_by_date('2023-11-21'); // Ganti '2023-11-21' dengan tanggal yang diinginkan

        $data['jabatan'] = $this->admin_model->get_jabatan_data();
        $this->load->view('page/admin/dashboard', $data);
    }

    // Page Organisasi
    public function organisasi()
    {
        $id_admin = $this->session->userdata('id');
        $data['user'] = $this->admin_model->get_data('user')->result();
        $data['organisasi'] = $this->admin_model->get_organisasi_pusat(
            $id_admin
        );
        $this->load->view('page/admin/organisasi/organisasi', $data);
    }

    // Page Tabel Organisasi
    public function all_organisasi()
    {
        $id_admin = $this->session->userdata('id');
        $data['user'] = $this->admin_model->get_data('user')->result();
        $data['organisasi'] = $this->admin_model->get_all_organisasi($id_admin);
        $this->load->view('page/admin/organisasi/all_organisasi', $data);
    }

    // Page Jabatan
    public function jabatan()
    {
        // Config
        $config['base_url'] = base_url('superadmin/jabatan');
        $config['total_rows'] = $this->admin_model->count_all('jabatan'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
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

        $id_admin = $this->session->userdata('id');
        // Data Jabatan
        $data['jabatan'] = $this->admin_model->pagination_by_id_admin(
            'jabatan',
            $config['per_page'],
            $data['start'],
            $id_admin
        );
        $this->load->view('page/admin/jabatan/jabatan', $data); // Memuat view dengan variabel $data
    }

    public function cuti()
    {
        $keyword = $this->input->get('keyword');

        if ($keyword !== null && $keyword !== '') {
            $data['cuti'] = $this->admin_model
                ->search_data('cuti', 'keperluan_cuti', $keyword)
                ->result();
        } else {
            $data['cuti'] = $this->admin_model->get_data('cuti')->result();
        }

        $this->load->view('page/admin/cuti/cuti', $data);
    }

    // Page User
    public function user()
    {
        // Config
        $config['base_url'] = base_url('admin/user');
        $config['total_rows'] = $this->admin_model->count_all('user'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
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

        $id_admin = $this->session->userdata('id');
        // Ambil data user untuk pagination berdasarkan id_admin
        $data['user'] = $this->admin_model->pagination_by_id_admin(
            'user',
            $config['per_page'],
            $data['start'],
            $id_admin
        );
        // Ambil data user berdasarkan id_admin
        $this->load->view('page/admin/user/user', $data);
    }

    // Page Absensi
    public function absensi()
    {
        $id_admin = $this->session->userdata('id');
        // Ambil data dari formulir
        $bulan = $this->input->get('bulan');
        $tanggal = $this->input->get('tanggal');
        $tahun = $this->input->get('tahun');
        $data['absensi'] = $this->admin_model->GetDataAbsensi(
            $bulan,
            $tanggal,
            $tahun
        );
        $keyword = $this->input->get('keyword');
        if ($keyword !== null && $keyword !== '') {
            $data['absensi'] = $this->admin_model
                ->search_data('absensi', 'keterangan', $keyword)
                ->result();
        } else {
            $data['absensi'] = $this->admin_model
                ->get_data('absensi')
                ->result();
        }
        $this->load->view('page/admin/absen/absensi', $data);
    }

    // Page Pengaturan
    public function pengaturan()
    {
        $this->load->view('page/admin/pengaturan/pengaturan');
    }

    // Page Pengaturan Profile
    public function profile_pengaturan()
    {
        $this->load->view('page/admin/profile/profile_pengaturan');
    }

    // Page Profile
    public function profile()
    {
        if ($this->session->userdata('id')) {
            $user_id = $this->session->userdata('id');
            $data['admin'] = $this->admin_model->getAdminByID($user_id);

            $this->load->view('page/admin/profile/profile', $data);
        } else {
            redirect('auth');
        }
    }

    // Page Detail Shift
    public function detail_shift()
    {
        // Mendefinisikan data yang akan digunakan dalam tampilan
        $data = [
            'judul' => 'Detail Shift',
            'deskripsi' => 'Ini adalah halaman detail shift.',
        ];
        $this->load->view('page/admin/shift/detail_shift', $data);
    }

    // Page Update Shift
    public function update_shift($id_shift)
    {
        $data['shift'] = $this->admin_model->getShiftId($id_shift);
        $this->load->view('page/admin/shift/update_shift', $data);
    }

    // Page Tambah Organisasi
    public function tambah_organisasi()
    {
        $this->load->view('page/admin/organisasi/tambah_organisasi');
    }

    // Page rekap harian
    public function rekap_harian()
    {
        $tanggal = $this->input->get('tanggal');
        $data['perhari'] = $this->admin_model->getRekapHarian($tanggal);
        $this->load->view('page/admin/rekap/rekap_harian', $data);
    }

    // Page rekap mingguan
    public function rekap_mingguan()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        if ($start_date) {
            $end_date = date('Y-m-d', strtotime($start_date . ' + 7 days'));
            $data['perminggu'] = $this->admin_model->RekapPerMinggu(
                $start_date,
                $end_date
            );
        } else {
            $data['perminggu'] = [];
        }

        $this->load->view('page/admin/rekap/rekap_mingguan', $data);
    }

    // Page rekap bulanan
    public function rekap_bulanan()
    {
        $bulan = $this->input->get('bulan');
        $data['perbulan'] = $this->admin_model->getRekapHarianByBulan($bulan);
        $this->load->view('page/admin/rekap/rekap_bulanan', $data);
    }

    // Page Detail Organisasi
    public function detail_organisasi($organisasi_id)
    {
        $data['organisasi'] = $this->admin_model->getOrganisasiDetails(
            $organisasi_id
        );

        $this->load->view('page/admin/organisasi/detail_organisasi', $data);
    }

    // Page Detail User
    public function detail_user($user_id)
    {
        $data['user'] = $this->admin_model->getUserDetails($user_id);

        // Mengirim data pengguna ke view
        $this->load->view('page/admin/user/detail_user', $data);
    }

    // Page tambah user
    public function tambah_user()
    {
        $data['admin'] = $this->admin_model->get_data('admin')->result();
        $data['organisasi'] = $this->admin_model
            ->get_data('organisasi')
            ->result();
        $data['shift'] = $this->admin_model->get_data('shift')->result();
        $data['jabatan'] = $this->admin_model->get_data('jabatan')->result();
        $this->load->view('page/admin/user/tambah_user', $data);
    }

    // Page tambah shift
    public function tambah_shift()
    {
        $data['admin'] = $this->admin_model->get_data('admin')->result();
        $this->load->view('page/admin/shift/tambah_shift', $data);
    }

    // Page tambah jabatan
    public function tambah_jabatan()
    {
        $this->load->view('page/admin/jabatan/tambah_jabatan');
    }

    // Page update organisasi
    public function update_organisasi($id_organisasi)
    {
        $data['organisasi'] = $this->admin_model->getOrganisasiById(
            $id_organisasi
        );
        $this->load->view('page/admin/organisasi/update_organisasi', $data);
    }

    // Page Update User
    public function update_user($id_user)
    {
        // Dapatkan data terkait pengguna dari sesi
        $id_admin = $this->session->userdata('id');
        $id_jabatan = $this->session->userdata('id_jabatan');
        $id_shift = $this->session->userdata('id_shift');
        $id_organisasi = $this->session->userdata('id_organisasi');

        // Dapatkan data pengguna berdasarkan ID
        $data['user'] = $this->admin_model->getUserId($id_user);

        // // Tetapkan data terkait pengguna ke array $data
        // $data['id_jabatan'] = $id_jabatan;
        // $data['id_shift'] = $id_shift;
        // $data['id_organisasi'] = $id_organisasi;

        // Dapatkan data shift, jabatan, dan organisasi
        $data['shift'] = $this->admin_model->get_shift_by_id_admin($id_admin);
        $data['jabatan'] = $this->admin_model->get_jabatan_by_id_admin(
            $id_admin
        );
        $data['organisasi'] = $this->admin_model
            ->get_data('organisasi')
            ->result();

        // Muat tampilan dengan data
        $this->load->view('page/admin/user/update_user', $data);
    }

    public function lokasi()
    {
        // Config
        $config['base_url'] = base_url('admin/lokasi');
        $config['total_rows'] = $this->admin_model->count_all('lokasi'); // Ganti 'nama_tabel' dengan nama tabel yang sesuai
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
        $data['lokasi'] = $this->admin_model->pagination(
            'lokasi',
            $config['per_page'],
            $data['start']
        );
        $data['organisasi'] = $this->admin_model
            ->get_data('organisasi')
            ->result();

        // Menampilkan view dengan data
        $this->load->view('page/admin/lokasi/lokasi', $data);
    }

    // page tambah lokasi
    public function tambah_lokasi()
    {
        $this->load->model('admin_model');

        // Get organizational data
        $data['organisasi'] = $this->admin_model->get_all_organisasii();

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
                redirect('admin/lokasi');
            } else {
                // Handle the case where 'id_organisasi' is not set or null
                // You might want to show an error message or redirect to the form page with an error
                echo 'Error: ID Organisasi cannot be null.';
            }
        } else {
            // Form belum disubmit, ambil data organisasi dan tampilkan view untuk mengisi form
            $this->load->view('page/admin/lokasi/tambah_lokasi', $data);
        }
    }

    // page detail lokasi
    public function detail_lokasi($lokasi_id)
    {
        $data['lokasi'] = $this->admin_model->getLokasiData($lokasi_id);

        // Mengirim data lokasi ke view
        $this->load->view('page/admin/lokasi/detail_lokasi', $data);
    }

    // page update lokasi
    public function update_lokasi($id_lokasi)
    {
        // Load necessary models or helpers here
        $this->load->model('admin_model');

        // Assuming you have a method in your model to get location details by ID
        $data['lokasi'] = $this->admin_model->getLokasiById($id_lokasi);

        // Load the view for updating location details
        $this->load->view('page/admin/lokasi/update_lokasi', $data);
    }

    // page detail jabatan
    public function detail_jabatan($id_jabatan)
    {
        $data['jabatan'] = $this->admin_model->getJabatanDetails($id_jabatan);

        // Mengirim data pengguna ke view
        $this->load->view('page/admin/jabatan/detail_jabatan', $data);
    }

    // page update jabatan
    public function update_jabatan($id_jabatan)
    {
        $data['jabatan'] = $this->admin_model->getJabatanId($id_jabatan);

        // Menampilkan view update_jabatan dengan data jabatan
        $this->load->view('page/admin/jabatan/update_jabatan', $data);
    }

    // page shift
    public function shift()
    {
        $id_admin = $this->session->userdata('id');
        $data['shift'] = $this->admin_model->get_shift_by_id_admin($id_admin);
        $data[
            'employee_counts'
        ] = $this->admin_model->get_employee_count_by_shift();
        $this->load->view('page/admin/shift/shift', $data);
    }

    // page detail absen
    public function detail_absen($id_absensi)
    {
        $data['absensi'] = $this->admin_model->getAbsensiDetails($id_absensi);
        // Menampilkan view update_jabatan dengan data jabatan
        $this->load->view('page/admin/absen/detail_absensi', $data);
    }

    // 2. Aksi
    // aksi hapus organisasi
    public function hapus_organisasi($id_organisasi)
    {
        $this->admin_model->hapus_organisasi($id_organisasi);
        redirect('admin/organisasi');
    }

    // aksi update organisasi
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

        // Ambil data organisasi dari model berdasarkan ID
        $organisasi = $this->admin_model->get_organisasi_by_id($id_organisasi);

        // Tambahkan ini untuk upload logo
        $image = $this->upload_image_logo('image', $organisasi->image);
        if ($image[0] == true) {
            // Set properti image pada objek $organisasi
            $organisasi->image = $image[1];
        }

        // Buat data yang akan diupdate
        $data = [
            'nama_organisasi' => $nama_organisasi,
            'email_organisasi' => $email_organisasi,
            'nomor_telepon' => $nomor_telepon,
            'kecamatan' => $kecamatan,
            'alamat' => $alamat,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
            'image' => $image[1],
            // Tambahkan field lain jika ada
        ];

        // Lakukan pembaruan data Organisasi
        $this->admin_model->update_organisasi($id_organisasi, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('admin/organisasi'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Organisasi
    }

    // aksi tambah organisasi
    public function aksi_tambah_organisasi()
    {
        $id_admin = $this->session->userdata('id');
        $status = 'pusat'; // Default status

        // Cek apakah ada data dengan id_admin yang diambil dari session
        $data_existing = $this->admin_model->get_organisasi_by_admin_id(
            $id_admin
        );

        if ($data_existing) {
            // Jika ada data dengan id_admin yang diambil dari session
            $status = 'cabang';
        }

        // Ambil data yang diperlukan dari form
        $data = [
            'nama_organisasi' => $this->input->post('nama_organisasi'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon'),
            'email_organisasi' => $this->input->post('email_organisasi'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kabupaten' => $this->input->post('kabupaten'),
            'provinsi' => $this->input->post('provinsi'),
            'id_admin' => $id_admin,
            'status' => $status,
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->admin_model->tambah_data('organisasi', $data); // Panggil method pada model
        $this->session->set_flashdata(
            'berhasil_tambah',
            'Berhasil Menambahkan Data'
        );

        // Redirect kembali ke halaman dashboard admin
        redirect('admin/organisasi');
    }

    // Aksi tambah user
    public function aksi_tambah_user()
    {
        $id_admin = $this->session->userdata('id');

        // Ambil data yang diperlukan dari form
        $password = $this->input->post('password');
        if (strlen($password) < 8) {
            // Password kurang dari 8 karakter, berikan pesan kesalahan
            $this->session->set_flashdata(
                'gagal_tambah',
                'Password harus memiliki panjang minimal 8 karakter'
            );
            redirect('admin/user'); // Redirect kembali ke halaman sebelumnya
            return; // Hentikan eksekusi jika validasi gagal
        }

        // Ambil data yang diperlukan dari form
        $data = [
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'nama_depan' => $this->input->post('nama_depan'),
            'nama_belakang' => $this->input->post('nama_belakang'),
            'password' => md5($password), // Simpan kata sandi yang telah di-MD5
            'id_admin' => $id_admin,
            'id_organisasi' => $this->input->post('id_organisasi'),
            'id_shift' => $this->input->post('id_shift'),
            'id_jabatan' => $this->input->post('id_jabatan'),
            'image' => 'User.png',
            'role' => 'user',
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->admin_model->tambah_data('user', $data); // Panggil method pada model
        $this->session->set_flashdata(
            'berhasil_tambah',
            'Berhasil Menambahkan Data'
        );

        // Redirect kembali ke halaman dashboard superadmin
        redirect('admin/user');
    }

    // Aksi Tambah Jabatan
    public function aksi_tambah_jabatan()
    {
        $id_admin = $this->session->userdata('id');

        // Ambil data yang diperlukan dari form
        $data = [
            'nama_jabatan' => $this->input->post('nama_jabatan'),
            'id_admin' => $id_admin,
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->admin_model->tambah_data('jabatan', $data); // Panggil method pada model
        $this->session->set_flashdata(
            'berhasil_tambah',
            'Berhasil Menambahkan Data'
        );

        // Redirect kembali ke halaman dashboard superadmin
        redirect('admin/jabatan');
    }

    public function aksi_ubah_foto()
    {
        $image = $this->upload_image_admin('image');
        $user_id = $this->session->userdata('id');
        $admin = $this->admin_model->getAdminByID($user_id);

        if ($image[0] == true) {
            $admin->image = $image[1];
        }

        $data = [
            'image' => $image[1],
        ];

        // Update foto di database
        $update_result = $this->admin_model->updateAdminPhoto($user_id, $data);

        // Set flash data untuk memberi tahu user tentang hasil pembaruan foto
        if ($update_result) {
            $this->session->set_flashdata(
                'berhasil_ubah_foto',
                'Berhasil mengubah foto'
            );
        } else {
            $this->session->set_flashdata(
                'gagal_update',
                'Gagal mengubah foto'
            );
        }

        // Redirect ke halaman profile
        redirect(base_url('admin/profile'));
    }

    // aksi ubah akun
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

        $update_result = $this->admin_model->update_data('admin', $data, [
            'id_admin' => $this->session->userdata('id'),
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

        redirect(base_url('admin/profile'));
    }

    // aksi ubah akun
    public function aksi_ubah_akun()
    {
        $image = $this->upload_image_admin('image');

        $user_id = $this->session->userdata('id');
        $admin = $this->admin_model->getAdminByID($user_id);

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
                redirect(base_url('admin/profile'));
            }
        }

        // Update the admin data in the database
        $update_result = $this->admin_model->update('admin', $data, [
            'id_admin' => $user_id,
        ]);

        if ($update_result) {
            $this->session->set_flashdata('message', 'Profil berhasil diubah');
        } else {
            $this->session->set_flashdata('message', 'Gagal mengubah profil');
        }

        redirect(base_url('admin/profile'));
    }

    // Hapus User
    public function hapus_user($id_user)
    {
        $this->admin_model->hapus_user($id_user);
        redirect('admin/user');
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
        $this->admin_model->edit_user($id_user, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('admin/user'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Admin
    }

    // aksi Tambah Shift
    public function aksi_tambah_shift()
    {
        // Ambil data yang diperlukan dari form
        $data = [
            'nama_shift' => $this->input->post('name'),
            'jam_masuk' => $this->input->post('time_masuk'),
            'jam_pulang' => $this->input->post('time_pulang'),
            'id_admin' => $this->session->userdata('id'),
        ];

        // Simpan data ke tabel
        $this->admin_model->tambah_data('shift', $data); // Panggil method pada
        $this->session->set_flashdata(
            'berhasil_tambah',
            'Berhasil Menambahkan Data'
        );

        // Redirect kembali ke halaman dashboard superadmin
        redirect('admin/shift');
    }

    // Aksi Update Shift
    public function aksi_edit_shift()
    {
        // Mendapatkan data dari form
        $id_shift = $this->input->post('id_shift');
        $nama_shift = $this->input->post('nama_shift');
        $jam_masuk = $this->input->post('jam_masuk');
        $jam_pulang = $this->input->post('jam_pulang');

        // Buat data yang akan diupdate
        $data = [
            'nama_shift' => $nama_shift,
            'jam_masuk' => $jam_masuk,
            'jam_pulang' => $jam_pulang,
        ];

        // Lakukan pembaruan data Admin
        $this->admin_model->update_shift($id_shift, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('admin/shift');
    }

    // Hapus Shift
    public function hapus_shift($id_shift)
    {
        $this->admin_model->hapus_shift($id_shift);
        redirect('admin/shift');
    }

    //    aksi update
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
        $this->admin_model->update_lokasi($id_lokasi, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('admin/lokasi'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Lokasi
    }

    // aksi hapus lokasi
    public function hapus_lokasi($id_lokasi)
    {
        $this->admin_model->hapus_lokasi($id_lokasi); // Assuming you have a method 'hapus_lokasi' in the model
        redirect('admin/lokasi');
    }

    // aksi ubah jabatan
    public function aksi_edit_jabatan()
    {
        // Mendapatkan data dari form
        $id_jabatan = $this->input->post('id_jabatan');
        $nama_jabatan = $this->input->post('nama_jabatan');

        // Buat data yang akan diupdate
        $data = [
            'nama_jabatan' => $nama_jabatan,
            // Tambahkan field lain jika ada
        ];

        // Lakukan pembaruan data Jabatan
        $this->admin_model->update_jabatan($id_jabatan, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('admin/jabatan'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Jabatan
    }

    // Hapus Jabatan
    public function hapus_jabatan($id_jabatan)
    {
        $this->admin_model->hapus_jabatan($id_jabatan);
        redirect('admin/jabatan');
    }

    // Untuk Aksi Setuju & Tidak Cuti
    public function setujuCuti($idCuti)
    {
        $this->load->model('admin_model'); // Pastikan model di-load
        $this->admin_model->updateStatusCuti($idCuti, 'Disetujui');

        // Anda dapat memberikan respons JSON jika diperlukan.
        echo json_encode(['status' => 'Disetujui']);
    }

    public function tidakSetujuCuti($cutiId)
    {
        $this->admin_model->updateStatusCuti($cutiId, 'Tidak Disetujui');

        // Anda dapat memberikan respons JSON jika diperlukan.
        echo json_encode(['status' => 'Tidak Disetujui']);
    }

    // 3. Lain-lain
    // Pembaruan password
    public function update_password()
    {
        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');

        $stored_password = $this->admin_model->getPasswordById(
            $this->session->userdata('id')
        );

        if (md5($password_lama) != $stored_password) {
            $this->session->set_flashdata(
                'kesalahan_password_lama',
                'Password lama yang dimasukkan salah'
            );
        } else {
            if ($password_baru === $konfirmasi_password) {
                $update_result = $this->admin_model->update_password(
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
        redirect(base_url('admin/profile'));
    }

    // upload image
    public function upload_image_admin($value)
    {
        // Mendapatkan ID pengguna dari sesi
        $user_id = $this->session->userdata('id');

        // Mendapatkan nama file foto saat ini
        $admin = $this->admin_model->getAdminByID($user_id);
        $current_image = $admin->image;

        // Generate kode unik untuk nama file baru
        $kode = round(microtime(true) * 1000);

        // Konfigurasi upload
        $config['upload_path'] = './images/admin/';
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
                $image_path = './images/admin/' . $current_image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            // Kembalikan hasil upload baru
            return [true, $new_image];
        }
    }

    // public function upload_image_admin($value)
    // {
    //     $kode = round(microtime(true) * 1000);
    //     $config['upload_path'] = './images/admin/';
    //     $config['allowed_types'] = 'jpg|png|jpeg';
    //     $config['max_size'] = 30000;
    //     $config['file_name'] = $kode;
    //     $this->upload->initialize($config);
    //     if (!$this->upload->do_upload($value)) {
    //         return [false, ''];
    //     } else {
    //         $fn = $this->upload->data();
    //         $nama = $fn['file_name'];
    //         return [true, $nama];
    //     }
    // }

    // Fungsi untuk menghapus file lama saat upload logo baru
    private function upload_image_logo($value, $old_image)
    {
        $kode = round(microtime(true) * 1000);

        // Konfigurasi upload
        $config['upload_path'] = './images/logo/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 30000;
        $config['file_name'] = $kode;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($value)) {
            return [false, ''];
        } else {
            // Jika upload berhasil, dapatkan informasi file baru
            $fn = $this->upload->data();
            $new_image = $fn['file_name'];

            // Hapus file lama
            $this->deleteOldImage($old_image);

            return [true, $new_image];
        }
    }

    // Fungsi untuk menghapus file lama
    private function deleteOldImage($old_image)
    {
        // Pastikan file lama tidak kosong sebelum menghapus
        if (!empty($old_image)) {
            $image_path = './images/logo/' . $old_image;

            // Hapus file lama jika ada
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }

    public function get_realtime_absensi()
    {
        // Panggil metode di dalam model untuk mendapatkan data absensi real-time
        $realtime_absensi = $this->admin_model->get_realtime_absensi();

        // Mengirim data dalam format JSON
        echo json_encode($realtime_absensi);
    }
    // Untuk mengexport data per bulanan
    public function export_bulanan()
    {
        $data['perbulan'] = $this->admin_model->getRekapPerBulan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'REKAP BULANAN');
        $sheet->mergeCells('A1:I1'); // Sesuaikan jumlah kolom dengan penambahan lokasi masuk dan lokasi pulang

        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'TANGGAL');
        $sheet->setCellValue('C3', 'KETERANGAN');
        $sheet->setCellValue('D3', 'JAM MASUK');
        $sheet->setCellValue('E3', 'LOKASI MASUK'); // Kolom baru
        $sheet->setCellValue('F3', 'JAM PULANG');
        $sheet->setCellValue('G3', 'LOKASI PULANG'); // Kolom baru
        $sheet->setCellValue('H3', 'STATUS');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);

        $no = 1;
        $numrow = 4;
        foreach ($data['perbulan'] as $row) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $row->tanggal_absen);
            $sheet->setCellValue('C' . $numrow, $row->keterangan_izin);
            $sheet->setCellValue('D' . $numrow, $row->jam_masuk);
            $sheet->setCellValue('E' . $numrow, $row->lokasi_masuk); // Kolom baru
            $sheet->setCellValue('F' . $numrow, $row->jam_pulang);
            $sheet->setCellValue('G' . $numrow, $row->lokasi_pulang); // Kolom baru
            $sheet->setCellValue('H' . $numrow, $row->status);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('REKAP BULANAN');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header(
            'Content-Disposition: attachment; filename="REKAP BULANAN.xlsx"'
        );
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    // Untuk mengexport data per minggu
    public function export_mingguan()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        if ($start_date) {
            $end_date = date('Y-m-d', strtotime($start_date . ' + 7 days'));
            $data['perminggu'] = $this->admin_model->getRekapPerMinggu(
                $start_date,
                $end_date
            );
        } else {
            $data['perminggu'] = [];
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'REKAP MINGGUAN');
        $sheet->mergeCells('A1:G1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'TANGGAL');
        $sheet->setCellValue('C3', 'KETERANGAN');
        $sheet->setCellValue('D3', 'JAM MASUK');
        $sheet->setCellValue('E3', 'JAM PULANG');
        $sheet->setCellValue('F3', 'STATUS');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);

        $data = $this->admin_model->getRekapPerMinggu();

        $no = 1;
        $numrow = 4;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $row->tanggal_absen);
            $sheet->setCellValue('C' . $numrow, $row->keterangan_izin);
            $sheet->setCellValue('D' . $numrow, $row->jam_masuk);
            $sheet->setCellValue('E' . $numrow, $row->jam_pulang);
            $sheet->setCellValue('F' . $numrow, $row->status);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('REKAP MINGGUAN');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header(
            'Content-Disposition: attachment; filename="REKAP MINGGUAN.xlsx"'
        );
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    // Untuk mengexport data per hari
    public function export_harian()
    {
        $data['perhari'] = $this->admin_model->exportRekapHarian();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'REKAP HARIAN');
        $sheet->mergeCells('A1:G1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'TANGGAL');
        $sheet->setCellValue('C3', 'KETERANGAN');
        $sheet->setCellValue('D3', 'JAM MASUK');
        $sheet->setCellValue('E3', 'JAM PULANG');
        $sheet->setCellValue('F3', 'STATUS');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);

        $no = 1;
        $numrow = 4;
        foreach ($data['perhari'] as $row) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $row->tanggal_absen);
            $sheet->setCellValue('C' . $numrow, $row->keterangan_izin);
            $sheet->setCellValue('D' . $numrow, $row->jam_masuk);
            $sheet->setCellValue('E' . $numrow, $row->jam_pulang);
            $sheet->setCellValue('F' . $numrow, $row->status);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('REKAP HARIAN');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="REKAP HARIAN.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function permohonan_pdf($id_cuti)
    {
        $this->load->library('mypdf');

        // Mendapatkan ID pengguna terkait dari model
        $id_user = $this->admin_model->get_user_id_admin(
            $this->session->userdata('id_admin')
        );

        $data['cuti'] = $this->admin_model->get_cuti_by_id('cuti', $id_cuti);
        $data['id_organisasi'] = $this->admin_model->get_id_organisasi();
        $data['id_user'] = $this->admin_model->get_user_id_admin($id_user);
        $this->mypdf->generate('/page/admin/laporan/dompdf', $data);
    }

    // Untuk Aksi Filter
    public function aksi_filter()
    {
        $this->load->model('admin_model');

        // Ambil nilai filter dari formulir
        $bulan = $this->input->post('bulan');
        $tanggal = $this->input->post('tanggal');
        $tahun = $this->input->post('tahun');

        // Panggil model untuk mendapatkan data absensi
        $dataAbsensi = $this->admin_model->filterAbsensi(
            $bulan,
            $tanggal,
            $tahun
        );

        // Kirim data yang sudah disaring ke view
        $data['absensi'] = $dataAbsensi;

        // Load view yang menampilkan hasil filter
        $this->load->view('page/admin/absen/absensi', $data);
    }

    // Export History Absensi
    public function export_absensi()
    {
        // Mengambil nilai filter dari query string URL
        $tanggal = $this->input->get('tanggal');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        // Filter data berdasarkan nilai yang ada
        $filter = [];
        if ($tanggal) {
            $filter['tanggal'] = $tanggal;
        }
        if ($bulan) {
            $filter['bulan'] = $bulan;
        }
        if ($tahun) {
            $filter['tahun'] = $tahun;
        }
        $absensiData = $this->admin_model->get_absensi_data($filter);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'HISTORY ABSENSI');
        $sheet->mergeCells('A1:G1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'TANGGAL');
        $sheet->setCellValue('C3', 'KETERANGAN');
        $sheet->setCellValue('D3', 'JAM MASUK');
        $sheet->setCellValue('E3', 'JAM PULANG');
        $sheet->setCellValue('F3', 'LOKASI');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);

        $no = 1;
        $numrow = 4;
        foreach ($absensiData as $row) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $row->tanggal_absen);
            $sheet->setCellValue('C' . $numrow, $row->keterangan_izin);
            $sheet->setCellValue('D' . $numrow, $row->jam_masuk);
            $sheet->setCellValue('E' . $numrow, $row->jam_pulang);
            $sheet->setCellValue('F' . $numrow, $row->lokasi);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(40);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('HISTORY ABSENSI');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header(
            'Content-Disposition: attachment; filename="HISTORY_ABSENSI.xlsx"'
        );
        header('Cache-Control: max-age=0');

        ob_clean();
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
?>