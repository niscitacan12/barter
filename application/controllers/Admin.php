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
        if (
            $this->session->userdata('logged_in') != true ||
            $this->session->userdata('role') != 'admin'
        ) {
            redirect(base_url() . 'auth');
        }
    }

    // Page Dashboard
    public function index()
    {
        $data['user'] = $this->admin_model->get_user_count();
        $data['absensi'] = $this->admin_model->get_absensi_count();
        // $data['cuti'] = $this->Admin_model->get_cuti_count();
        $this->load->view('page/admin/dashboard');
    }

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

    // Page Organisasi
    public function organisasi()
    {
        $id_admin = $this->session->userdata('id');
        $data['user'] = $this->admin_model->get_data('user')->result();
        $data['organisasi'] = $this->admin_model
            ->get_data('organisasi')
            ->result();
        $this->load->view('page/admin/organisasi', $data);
    }

    // Page Jabatan
    public function jabatan()
    {
        $id_admin = $this->session->userdata('id');
        $id_jabatan = $this->session->userdata('id');
        $data['jabatan'] = $this->admin_model->get_jabatan_by_id_admin(
            $id_admin
        );
        $data[
            'employee_counts'
        ] = $this->admin_model->get_employee_count_by_jabatan_and_admin(
            $id_admin
        );
        $this->load->view('page/admin/jabatan', $data); // Memuat view dengan variabel $data
    }

    public function jam_kerja()
    {
        $id_admin = $this->session->userdata('id');
        $data['shift'] = $this->admin_model->get_shift_by_id_admin($id_admin);
        $data['employee_counts'] = $this->admin_model->get_employee_count_by_shift();
        $this->load->view('page/admin/jam_kerja', $data);
    }

    // Page Permohonan Cuti
    public function cuti()
    {
        $keyword = $this->input->get('keyword'); // Mendapatkan kata kunci dari form

        // Jika ada kata kunci, lakukan pencarian
        if ($keyword !== null && $keyword !== '') {
            $data['cuti'] = $this->admin_model
                ->search_data('cuti', $keyword)
                ->result();
        } else {
            // Jika tidak ada kata kunci, ambil semua data cuti
            $data['cuti'] = $this->admin_model->get_data('cuti')->result();
        }

        $this->load->view('page/admin/cuti', $data);
    }

    // Page User
    public function user()
    {
        $id_admin = $this->session->userdata('id');
        $data['user'] = $this->admin_model->get_user_by_id_admin($id_admin);
        $this->load->view('page/admin/user', $data);
    }

    // Page Absensi
    public function absensi()
    {
        $id_admin = $this->session->userdata('id');
        $data['absensi'] = $this->admin_model
            ->get_absen_by_admin($id_admin)
            ->result();
        $this->load->view('page/admin/absensi', $data);
    }
    // Page Pengaturan
    public function pengaturan()
    {
        $this->load->view('page/admin/pengaturan');
    }
    // Page Pengaturan Profile
    public function profile_pengaturan()
    {
        $this->load->view('page/admin/profile_pengaturan');
    }

    // Page Profile
    public function profile()
    {
        if ($this->session->userdata('id')) {
            $user_id = $this->session->userdata('id');
            $data['admin'] = $this->admin_model->getAdminByID($user_id);

            $this->load->view('page/admin/profile', $data);
        } else {
            redirect('auth');
        }
    }

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

    // Page Tambah Organisasi
    public function tambah_organisasi()
    {
        $this->load->view('page/admin/tambah_organisasi');
    }

    // Page rekap harian
    public function rekap_harian()
    {
        $this->load->view('page/admin/rekap_harian');
    }

    // Page rekap mingguan
    public function rekap_mingguan()
    {
        $this->load->view('page/admin/rekap_mingguan');
    }

    // Page rekap bulanan
    public function rekap_bulanan()
    {
        $this->load->view('page/admin/rekap_bulanan');
    }

    public function hapus_organisasi($id_organisasi)
    {
        $this->admin_model->hapus_organisasi($id_organisasi);
        redirect('admin/organisasi');
    }

    public function update_organisasi($id_organisasi)
    {
        $data['organisasi'] = $this->admin_model->getOrganisasiById(
            $id_organisasi
        );
        $this->load->view('page/admin/update_organisasi', $data);
    }

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

        // Redirect ke halaman setelah pembaruan data
        redirect('admin/organisasi'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Admin
    }

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
            'id_admin' => $this->input->post('id_admin'),
            // sesuaikan dengan kolom lainnya
        ];

        // Simpan data ke tabel
        $this->admin_model->tambah_data('organisasi', $data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard admin
        redirect('admin/organisasi');
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
        $this->load->view('page/admin/tambah_user', $data);
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

        // Redirect kembali ke halaman dashboard superadmin
        redirect('admin/user');
    }

    // Page tambah shift
    public function tambah_shift()
    {
        $data['admin'] = $this->admin_model->get_data('admin')->result();
        $this->load->view('page/admin/tambah_shift', $data);
    }

    // Page tambah jabatan
    public function tambah_jabatan()
    {
        $this->load->view('page/admin/tambah_jabatan');
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

        // Redirect kembali ke halaman dashboard superadmin
        redirect('admin/jabatan');
    }

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
                $this->load->view('page/admin/detail_organisasi', $data);
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
        $this->load->view('page/admin/detail_user', $data);
    }
    // Hapus User
    public function hapus_user($id_user)
    {
        $this->admin_model->hapus_user($id_user);
        redirect('admin/user');
    }
    // Page Update User
    public function update_user($id_user)
    {
        $data['user'] = $this->admin_model->getUserId($id_user);
        $this->load->view('page/admin/update_user', $data);
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
        $this->admin_model->tambah_data('shift', $data); // Panggil method pada model

        // Redirect kembali ke halaman dashboard superadmin
        redirect('admin/jam_kerja');
    }
   
   // Page Detail Shift
   public function detail_shift() 
   {
       // Mendefinisikan data yang akan digunakan dalam tampilan
       $data = array(
           'judul' => 'Detail Shift',
           'deskripsi' => 'Ini adalah halaman detail shift.'
       );
       $this->load->view('page/admin/detail_shift', $data);
   }

   // Page Update Shift
   public function update_shift($id_shift)                                                                                                                                         
   {
       $data['shift'] = $this->admin_model->getShiftId($id_shift);
       $this->load->view('page/admin/update_shift', $data);
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

       // Redirect ke halaman setelah pembaruan data
       redirect('admin/jam_kerja'); 
   }

   // Hapus Shift
   public function hapus_shift($id_shift)
   {
       $this->admin_model->hapus_shift($id_shift);
       redirect('admin/jam_kerja');
   }

   public function lokasi() {
    // Mengambil data lokasi dan pengguna dari model
    $this->load->model('admin_model');
    $data['lokasi'] = $this->admin_model->get_all_lokasi();
    $data['user'] = $this->admin_model->get_all_user();

    // Menampilkan view dengan data
    $this->load->view('page/admin/lokasi', $data);
}

public function tambah_lokasi()
{
    $this->load->model('admin_model');
    $data['user'] = $this->admin_model->get_all_user(); // Ganti dengan metode yang sesuai di model

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Form telah disubmit, lakukan logika penyimpanan data ke database atau tindakan lainnya
        $lokasi_data = array(
            'nama_lokasi' => $this->input->post('nama_lokasi'),
            'alamat' => $this->input->post('alamat_kantor'),
            'id_user' => $this->input->post('custom_id'),
            // tambahkan kolom lainnya sesuai kebutuhan
        );

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
        $this->load->view('page/admin/tambah_lokasi', $data);
    }
}

    public function detail_lokasi($lokasi_id)
    {
        $data['lokasi'] = $this->admin_model->getLokasiData($lokasi_id);
    
        // Mengirim data lokasi ke view
        $this->load->view('page/admin/detail_lokasi', $data);
    }
    
   
    public function update_lokasi($id_lokasi)
    {
        // Load necessary models or helpers here
        $this->load->model('admin_model');
    
        // Assuming you have a method in your model to get location details by ID
        $data['lokasi'] = $this->admin_model->getLokasiById($id_lokasi);
    
        // Load the view for updating location details
        $this->load->view('page/admin/update_lokasi', $data);
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
        $this->admin_model->update_lokasi($id_lokasi, $data);
    
        // Redirect ke halaman setelah pembaruan data
        redirect('admin/lokasi'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Lokasi
    }
    
    public function hapus_lokasi($id_lokasi)
    {
        $this->admin_model->hapus_lokasi($id_lokasi); // Assuming you have a method 'hapus_lokasi' in the model
        redirect('admin/lokasi');

}

public function detail_jabatan($id_jabatan)
    {
        $data['jabatan'] = $this->admin_model->getJabatanDetails($id_jabatan);

        // Mengirim data pengguna ke view
        $this->load->view('page/admin/detail_jabatan', $data);
    }

    public function update_jabatan($id_jabatan) 
{   
    $data['jabatan'] = $this->admin_model->getJabatanId($id_jabatan);

    // Menampilkan view update_jabatan dengan data jabatan
    $this->load->view('page/admin/update_jabatan', $data);
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

    // Redirect ke halaman setelah pembaruan data
    redirect('admin/jabatan'); // Sesuaikan dengan halaman yang diinginkan setelah pembaruan data Jabatan
}



public function edit_jabatan($id_jabatan, $data) {
    // Gantilah 'jabatan' dengan nama tabel yang sesuai di database Anda
    $this->db->where('id_jabatan', $id_jabatan);
    $this->db->update('jabatan', $data);
}
    
    // Hapus Jabatan
    public function hapus_jabatan($id_jabatan)
    {
        $this->admin_model->hapus_jabatan($id_jabatan);
        redirect('admin/jabatan');
    }
 


}
?>