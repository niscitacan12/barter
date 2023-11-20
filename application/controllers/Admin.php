<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
        $id_admin = $this->session->userdata('id');
        $data['user_count'] = $this->admin_model->get_user_count();
        $data['absensi'] = $this->admin_model->get_absensi_count();
        $data['cuti'] = $this->admin_model->get_cuti_count();
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

        // Data Jabatan
        $data['jabatan'] = $this->admin_model->pagination(
            'jabatan',
            $config['per_page'],
            $data['start']
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
        $this->load->view('page/admin/rekap/rekap_harian');
    }

    // Page rekap mingguan
    public function rekap_mingguan()
    {
        $this->load->view('page/admin/rekap/rekap_mingguan');
    }

    // Page rekap bulanan
    public function rekap_bulanan()
    {
        $this->load->view('page/admin/rekap/rekap_bulanan');
    }

    // Page Detail Organisasi
    public function detail_organisasi()
    {
        // Load your data here, assuming you have a method in Super_model to get the data
        $id_organisasi = $this->input->get('id');

        if ($id_organisasi !== null) {
            // Panggil model untuk mendapatkan data organisasi berdasarkan ID
            $this->load->model('admin_model');
            $data['organisasi'] = $this->admin_model->getOrganisasiData(
                $id_organisasi
            );

            if ($data['organisasi']) {
                // Load your view passing the data
                $this->load->view(
                    'page/admin/organisasi/detail_organisasi',
                    $data
                );
            } else {
                // Handle the case when data is not found
                echo 'Data organisasi tidak ditemukan.';
            }
        } else {
            // Handle the case when ID is not valid or not found
            echo 'ID tidak valid atau tidak ditemukan.';
        }
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
        $data['user'] = $this->admin_model->getUserId($id_user);
        $this->load->view('page/admin/user/update_user', $data);
    }

    // Page lokasi
    public function lokasi()
    {
        // Mengambil data lokasi dan pengguna dari model
        $this->load->model('admin_model');
        $data['lokasi'] = $this->admin_model->get_all_lokasi();
        $data['user'] = $this->admin_model->get_all_user();

        // Menampilkan view dengan data
        $this->load->view('page/admin/lokasi/lokasi', $data);
    }

    // page tambah lokasi
    public function tambah_lokasi()
    {
        $this->load->model('admin_model');
        $data['user'] = $this->admin_model->get_all_user(); // Ganti dengan metode yang sesuai di model

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form telah disubmit, lakukan logika penyimpanan data ke database atau tindakan lainnya
            $lokasi_data = [
                'nama_lokasi' => $this->input->post('nama_lokasi'),
                'alamat' => $this->input->post('alamat_kantor'),
                'id_user' => $this->input->post('custom_id'),
                // tambahkan kolom lainnya sesuai kebutuhan
            ];

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
            // Form belum disubmit, ambil data pengguna dan tampilkan view untuk mengisi form
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
        $this->admin_model->update_organisasi($id_organisasi, $data);
        $this->session->set_flashdata(
            'berhasil_update',
            'Berhasil mengubah data'
        );

        // Redirect ke halaman setelah pembaruan data
        redirect('admin/organisasi'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Admin
    }

    // aksi tambah organisasi
    public function aksi_tambah_organisasi()
    {
        $id_admin = $this->session->userdata('id');
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

    // 3. Lain-lain
    // upload image
    public function upload_image_admin($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/admin/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 30000;
        $config['file_name'] = $kode;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($value)) {
            return [false, ''];
        } else {
            $fn = $this->upload->data();
            $nama = $fn['file_name'];
            return [true, $nama];
        }
    }

     // Untuk Aksi Setuju & Tidak Cuti
     public function setujuCuti($cutiId) 
     {
         $this->admin_model->updateStatusCuti($cutiId, 'Disetujui');
         
         // Anda dapat memberikan respons JSON jika diperlukan.
         echo json_encode(array('status' => 'Disetujui'));
     }
 
     public function tidakSetujuCuti($cutiId) 
     {
         $this->admin_model->updateStatusCuti($cutiId, 'Tidak Disetujui');
         
         // Anda dapat memberikan respons JSON jika diperlukan.
         echo json_encode(array('status' => 'Tidak Disetujui'));
     }
}
?>
