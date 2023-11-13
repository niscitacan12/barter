Superadmin.php:

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
        $this->load->model('super_model');
        $this->load->library('session');
        if (
            $this->session->userdata('logged_in') != true ||
            $this->session->userdata('role') != 'superadmin'
        ) {
            redirect(base_url() . 'auth');
        }
    }

    // Page Dashboard / Utama
    public function index()
    {
        $id_superadmin = $this->session->userdata('id');
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->num_rows();
        $data['admin'] = $this->super_model->get_admin_count();
        $data['user'] = $this->super_model->get_user_count();
        $this->load->view('page/super_admin/dashboard', $data);
    }

    // Page Organisasi
    public function organisasi()
    {
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->result();
        $this->load->view('page/super_admin/organisasi', $data);
    }

    // Page Admin
    public function admin()
    {
        $data['user'] = $this->super_model->get_data('admin')->result();
        // foreach ($data['user'] as $user) {
        //     $id_admin = $user->id_admin; // Menyimpan ID admin dari setiap elemen pengguna
        //     $organisasi = $this->super_model->getOrganisasiId($id_admin);
        //     // Lakukan operasi yang diperlukan dengan data organisasi yang diperoleh
        // }
        $this->load->view('page/super_admin/admin', $data);
    }

    // Page User
    public function user()
    {
        $data['user'] = $this->super_model->get_user();
        $this->load->view('page/super_admin/user', $data);
    }

    // Page Absensi
    public function absensi()
    {
        $data['absensi'] = $this->super_model->get_data('absensi')->result();
        $this->load->view('page/super_admin/absensi', $data);
    }

    // Page Tambah Admin
    public function tambah_admin()
    {
        // $data['id_superadmin'] = $this->session->userdata('id');
        $data['organisasi'] = $this->super_model
            ->get_data('organisasi')
            ->result();
        $this->load->view('page/super_admin/tambah_admin', $data);
    }

    // Page Edit Admin
    public function update_admin($id_admin)
    {
        // $id_admin = $this->session->userdata('id_admin');
        $data['admin'] = $this->super_model->getAdminById($id_admin);
        $this->load->view('page/super_admin/update_admin', $data);
    }

    // Page Jabatan
    public function jabatan()
    {
        $data['jabatan'] = $this->super_model->get_data('jabatan')->result();
        $this->load->view('page/super_admin/jabatan', $data);
    }

    // Page Shift
    public function shift()
    {
        $data['shift'] = $this->super_model->get_data('shift')->result();
        $this->load->view('page/super_admin/shift', $data);
    }

    // Page Tambah Organisasi
    public function tambah_organisasi()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $this->load->view('page/super_admin/tambah_organisasi', $data);
    }

    // Page Update Organisasi
    public function update_organisasi($id_organisasi)
    {
        $data['organisasi'] = $this->super_model->getOrganisasiById(
            $id_organisasi
        );
        $this->load->view('page/super_admin/update_organisasi', $data);
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
        $this->super_model->update_organisasi($id_organisasi, $data);

        // Redirect ke halaman setelah pembaruan data
        redirect('superadmin/organisasi'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Admin
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
        $this->load->view('page/super_admin/tambah_user', $data);
    }

    // Page Tambah Jabatan
    public function tambah_jabatan()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $this->load->view('page/super_admin/tambah_jabatan', $data);
    }

    // Page Update Jabatan
    public function update_jabatan($id_jabatan)
    {
        $data['jabatan']=$this->super_model->getJabatanId($id_jabatan);
        $this->load->view('page/super_admin/update_jabatan', $data);
    }

    // Page Tambah Shift
    public function tambah_shift()
    {
        $data['admin'] = $this->super_model->get_data('admin')->result();
        $this->load->view('page/super_admin/tambah_shift', $data);
    }

    // Page Update Shift
    public function update_shift($id_shift)
    {
        $data['shift']=$this->super_model->getShiftId($id_shift);
        $this->load->view('page/super_admin/update_shift', $data);
    }

    // Page Profile
    public function profile()
    {
        // Perbaiki ini dari $user_id menjadi $id_superadmin
        $this->load->view('page/super_admin/profile');
    }

    // Page Detail Organisasi
    public function detail_organisasi()
    {
        // Mendefinisikan data yang akan digunakan dalam tampilan
        $data = [
            'judul' => 'Detail Organisasi',
            'deskripsi' => 'Ini adalah halaman detail organisasi.',
        ];
        $this->load->view('page/super_admin/detail_organisasi', $data);
    }

    // Page Detail User

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

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/shift');
    }
    
    // aksi edit admin
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

    // aksi tambah admin
    public function aksi_tambah_admin()
    {
        $id_superadmin = $this->session->userdata('id');
        // Ambil data yang diperlukan dari form
        $data = [
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'nama_depan' => $this->input->post('nama_depan'),
            'nama_belakang' => $this->input->post('nama_belakang'),
            'password' => md5($this->input->post('password')), // Simpan kata sandi yang telah di-MD5
            'image' => 'User.png',
            'id_superadmin' => $id_superadmin,
            'role' => 'admin',
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('admin', $data); // Panggil method pada model

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
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->super_model->tambah_data('organisasi', $data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/organisasi');
    }

    // aksi tambah user
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
        $this->super_model->tambah_data('user', $data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('superadmin/admin');
    }

    // Page Detail User
    public function detail_user() {
        // Fetch data from the model
        $superadmin_data = $this->super_model->get_superadmin_data();

        // Pass data to the view
        $data['superadmin'] = $superadmin_data;

        // Load the view  
       $this->load->view('page/super_admin/detail_user', $data);
    }
    
     public function your_method_name() {
    // Fetch data from your model
      // In your controller
    $superadmin_data = $this->super_model->get_superadmin_data();

    // Pass data to the view
    $this->load->view('superadmin', ['superadmin' => $superadmin_data]);
}
}