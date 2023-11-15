<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('admin_model');
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
            $id_jabatan
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
        $id_shift = $this->session->userdata('id');
        $data['shift'] = $this->admin_model->get_shift_by_id_admin($id_shift);
        $data[
            'employee_counts'
        ] = $this->admin_model->get_employee_count_by_shift();
        $this->load->view('page/admin/jam_kerja', $data);
    }

    // Page Lokasi
    public function lokasi()
    {
        $this->load->view('page/admin/lokasi');
    }

    // Page Permohonan Cuti
    public function cuti()
    {
        $this->load->view('page/admin/cuti');
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
        $this->load->view('page/admin/profile');
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
        $data['organisasi'] = $this->admin_model->get_data('organisasi') ->result();
        $data['shift'] = $this->admin_model->get_data('shift')->result();
        $data['jabatan'] = $this->admin_model->get_data('jabatan')->result();
        $this->load->view('page/admin/tambah_user', $data);
    }
    
    // Page tambah lokasi
    public function tambah_lokasi()
    {
        $this->load->view('page/admin/tambah_lokasi');
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

    public function aksi_ubah_profile()
    {
        $foto = $_FILES['image']['name'];
        $foto_temp = $_FILES['image']['tmp_name'];
        $password_baru = $this->input->post('password');
        $konfirmasi_password = $this->input->post('con_pass');
        $username = $this->input->post('username');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');

        if ($foto) {
            $kode = round(microtime(true) * 1000);
            $file_name = $kode . '_' . $foto;
            $upload_path = './images/' . $file_name;
            $old_file = $this->m_model->get_foto_by_id(
                $this->session->userdata('id')
            );
            if ($old_file != 'User.png') {
                unlink('./images/' . $old_file);
            }
            if (move_uploaded_file($foto_temp, $upload_path)) {
                $data = [
                    'image' => $file_name,
                    'username' => $username,
                    'nama_depan' => $nama_depan,
                    'nama_belakang' => $nama_belakang,
                ];

                if (!empty($password_baru) && strlen($password_baru) >= 8) {
                    if ($password_baru === $konfirmasi_password) {
                        $data['password'] = md5($password_baru);
                    } else {
                        $this->session->set_flashdata(
                            'message',
                            'Password baru dan konfirmasi password harus sama'
                        );
                        redirect(base_url('admin/profile'));
                    }
                }

                $this->session->set_userdata($data);
                $update_result = $this->admin_model->update('user', $data, [
                    'id' => $this->session->userdata('id'),
                ]);
                redirect(base_url('admin/profile'));
            } else {
                // Gagal mengunggah foto baru
                redirect(base_url('admin/profile'));
            }
        } else {
            // Jika tidak ada foto yang diunggah
            $data = [
                'username' => $username,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
            ];

            if (!empty($password_baru) && strlen($password_baru) >= 8) {
                if ($password_baru === $konfirmasi_password) {
                    $data['password'] = md5($password_baru);
                } else {
                    $this->session->set_flashdata(
                        'message',
                        'Password baru dan konfirmasi password harus sama'
                    );
                    redirect(base_url('admin/profile'));
                }
            }

            $this->session->set_userdata($data);
            $update_result = $this->admin_model->update('user', $data, [
                'id' => $this->session->userdata('id'),
            ]);
            redirect(base_url('admin/profile'));
        }
    }

    // Page tambah shift
    public function tambah_shift()
    {
        $this->load->view('page/admin/tambah_shift');
    }

    // Page tambah jabatan
    public function tambah_jabatan()
    {
        $this->load->view('page/admin/tambah_jabatan');
    }

    // Aksi Tambah Jabatan
    public function aksi_tambah_jabatan()
    {
        $id_admin = $this->session->userdata('id_admin');

        // Pastikan $id_admin memiliki nilai yang valid
        if ($id_admin) {
            $data = [
                'nama_jabatan' => $this->input->post('nama_jabatan'),
                'id_admin' => $id_admin,
            ];

            // Panggil function pada model untuk menambahkan jabatan
            $this->admin_model->tambah_data('jabatan', $data);

            // Redirect kembali ke halaman yang sesuai
            redirect('admin/jabatan');
        } else {
            // Tampilkan pesan kesalahan atau arahkan kembali ke halaman yang sesuai
            echo 'Terjadi kesalahan. Silakan coba lagi atau hubungi administrator.';
        }
    }

    public function detail_organisasi() {
        // Load your data here, assuming you have a method in Super_model to get the data
        $id_organisasi = $this->input->get('id');
    
        if ($id_organisasi !== null) {
            // Panggil model untuk mendapatkan data organisasi berdasarkan ID
            $this->load->model('admin_model');
            $data['organisasi'] = $this->admin_model->getOrganisasiData($id_organisasi);
    
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
}    

?>