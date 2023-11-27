<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Pusher\Pusher;

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
        $this->load->model('user_model');
        $this->load->library('upload');
        if (
            $this->session->userdata('logged_in') != true ||
            $this->session->userdata('role') != 'user'
        ) {
            redirect(base_url() . 'auth');
        }
    }

    public function index()
    {
        $data['cuti_count'] = $this->user_model->get_cuti_count();
        $data['absensi'] = $this->user_model->get_izin_count();
        $data['absensi_count'] = $this->user_model->get_absensi_count();

        // Hitung total absen dan izin
        $data['total'] = $data['absensi'] + $data['absensi_count'];
        $data['absen'] = $this->user_model->get_absensi_data();
        $this->load->view('page/user/dashboard', $data);
    }

    public function absen()
    {
        setlocale(LC_TIME, 'id_ID');
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->session->userdata('username');
        $currentDateTime = date('d F Y H:i:s');
        $currentHour = date('H', strtotime($currentDateTime));
        $date = date('l, d F Y', strtotime($currentDateTime));
        $greeting = '';

        if ($currentHour >= 1 && $currentHour < 10) {
            $greeting = 'Selamat Pagi';
        } elseif ($currentHour >= 10 && $currentHour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($currentHour >= 15 && $currentHour < 19) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        // Melewatkan variabel ke view menggunakan array
        $data = [
            'username' => $username,
            'greeting' => $greeting,
            'date' => $date,
        ];

        $this->load->view('page/user/absen', $data);
    }

    public function pulang($id_absensi)
    {
        setlocale(LC_TIME, 'id_ID');
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->session->userdata('username');
        $currentDateTime = date('d F Y H:i:s');
        $currentHour = date('H', strtotime($currentDateTime));
        $date = date('l, d F Y', strtotime($currentDateTime));
        $greeting = '';

        if ($currentHour >= 1 && $currentHour < 10) {
            $greeting = 'Selamat Pagi';
        } elseif ($currentHour >= 10 && $currentHour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($currentHour >= 15 && $currentHour < 19) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        // Melewatkan variabel ke view menggunakan array
        $data = [
            'username' => $username,
            'greeting' => $greeting,
            'date' => $date,
        ];

        $this->load->view('page/user/pulang', $data);
    }

    public function profile()
    {
        if ($this->session->userdata('id')) {
            $user_id = $this->session->userdata('id');
            $data['user'] = $this->user_model->getUserByID($user_id);

            $this->load->view('page/user/profile', $data);
        } else {
            redirect('auth');
        }
    }

    public function cuti()
    {
        $this->load->view('page/user/cuti');
    }

    public function izin()
    {
        setlocale(LC_TIME, 'id_ID');
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->session->userdata('username');
        $currentDateTime = date('d F Y H:i:s');
        $currentHour = date('H', strtotime($currentDateTime));
        $date = date('l, d F Y', strtotime($currentDateTime));
        $time = date('H:i', strtotime($currentDateTime));
        $greeting = '';

        if ($currentHour >= 1 && $currentHour < 10) {
            $greeting = 'Selamat Pagi';
        } elseif ($currentHour >= 10 && $currentHour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($currentHour >= 15 && $currentHour < 19) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        // Melewatkan variabel ke view menggunakan array
        $data = [
            'username' => $username,
            'greeting' => $greeting,
            'date' => $date,
            'time' => $time,
        ];

        $this->load->view('page/user/izin', $data);
    }

    public function history_absensi()
    {
        // Assuming $data is an array that you pass to the view
        $data['user'] = $this->user_model->get_all_user();
        $data['absensi'] = $this->user_model->get_absensi_data();
        $this->load->view('page/user/history_absensi', $data);
    }

    // Aksi Absen
    public function aksi_absen()
    {
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $jam = date('H:i:s');

        // Rest of your code
        $data = [
            'id_user' => $id_user,
            'tanggal_absen' => $tanggal,
            'keterangan_izin' => '-',
            'jam_masuk' => $jam,
            'foto_masuk' => $this->input->post('foto_masuk'),
            'jam_pulang' => '00:00:00',
            'foto_pulang' => '-',
            'lokasi' => $this->input->post('lokasi'),
            'status' => 'false',
        ];

        // Menyisipkan data absen ke dalam database
        $inserted = $this->user_model->tambah_data('absensi', $data);

        if ($inserted) {
            // Jika berhasil disisipkan, tambahkan notifikasi berhasil
            $this->session->set_flashdata('berhasil_absen', 'Berhasil Absen.');

            $options = [
                'cluster' => 'ap1',
                'useTLS' => true,
            ];
            $pusher = new Pusher(
                '33407527b00e1d0ff775',
                '9fb7fb6f4c554ecba9fb',
                '1712968',
                $options
            );
            $message['message'] = $email . ' melakukan absen masuk';
            $pusher->trigger('ExcAbsensiVersi1', 'my-event', $message);

            redirect(base_url('user/history_absensi'));
        } else {
            // Jika gagal disisipkan, tambahkan notifikasi gagal
            $this->session->set_flashdata(
                'gagal_absen',
                'Gagal Absen. Silakan coba lagi.'
            );

            redirect(base_url('user/absen'));
        }
    }

    // Aksi Izin
    public function aksi_izin()
    {
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $tanggal = date('Y-m-d');

        $keterangan_izin = $this->input->post('keterangan_izin');

        // Periksa apakah 'keterangan_izin' tidak kosong
        if (!empty($keterangan_izin)) {
            $data = [
                'id_user' => $id_user,
                'tanggal_absen' => $tanggal,
                'keterangan_izin' => $this->input->post('keterangan_izin'),
                'jam_masuk' => '00:00:00',
                'foto_masuk' => '-',
                'jam_pulang' => '00:00:00',
                'foto_pulang' => '-',
                'lokasi' => '-',
                'status' => 'true',
            ];

            $this->user_model->tambah_data('absensi', $data);
            $this->session->set_flashdata('berhasil_izin', 'Berhasil Izin.');

            $options = [
                'cluster' => 'ap1',
                'useTLS' => true,
            ];
            $pusher = new Pusher(
                '33407527b00e1d0ff775',
                '9fb7fb6f4c554ecba9fb',
                '1712968',
                $options
            );
            $message['message'] = $email . ' mengajukan izin baru.';
            $pusher->trigger('ExcAbsensiVersi1', 'my-event', $message);

            redirect(base_url('user/history_absensi'));
        } else {
            // Tampilkan pesan kesalahan jika 'keterangan_izin' kosong
            $this->session->set_flashdata(
                'gagal_izin',
                'Gagal Izin. Keterangan Izin tidak boleh kosong.'
            );
            redirect(base_url('page/user/izin'));
        }
    }

    // Aksi Cuti
    public function aksi_cuti()
    {
        $id_user = $this->session->userdata('id');
        $tanggal_sekarang = date('Y-m-d');

        $awal_cuti = $this->input->post('awal_cuti');
        $akhir_cuti = $this->input->post('akhir_cuti');
        $masuk_kerja = $this->input->post('masuk_kerja');
        $keperluan_cuti = $this->input->post('keperluan_cuti');
        $id_organisasi = $this->user_model->get_id_organisasi($id_user);
        $this->session->set_userdata('id_organisasi', $id_organisasi);

        // Periksa apakah data tidak kosong
        if (
            !empty($awal_cuti) &&
            !empty($akhir_cuti) &&
            !empty($masuk_kerja) &&
            !empty($keperluan_cuti) &&
            !empty($id_organisasi)
        ) {
            $data = [
                'id_user' => $id_user,
                'awal_cuti' => $awal_cuti,
                'akhir_cuti' => $akhir_cuti,
                'masuk_kerja' => $masuk_kerja,
                'keperluan_cuti' => $keperluan_cuti,
                'id_organisasi' => $id_organisasi,
            ];

            // Panggil model untuk menyimpan data cuti
            $this->user_model->tambah_data('cuti', $data);
            $this->session->set_flashdata(
                'berhasil_cuti',
                'Berhasil mengajukan cuti.'
            );

            redirect(base_url('user/cuti')); // Mengasumsikan 'user/history_cuti' adalah halaman untuk melihat riwayat cuti
        } else {
            // Tampilkan pesan kesalahan jika ada data yang kosong
            $this->session->set_flashdata(
                'gagal_cuti',
                'Gagal mengajukan cuti. Semua field harus diisi.'
            );
            redirect(base_url('user/cuti'));
        }
    }

    public function aksi_ubah_detail_akun()
    {
        $image = $this->upload_image_user('image');

        $user_id = $this->session->userdata('id');
        $admin = $this->user_model->getUserByID($user_id);

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
                redirect(base_url('user/profile'));
            }
        }

        // Update the user data in the database
        $update_result = $this->user_model->update('user', $data, [
            'id_user' => $user_id,
        ]);

        if ($update_result) {
            $this->session->set_flashdata('message', 'Profil berhasil diubah');
        } else {
            $this->session->set_flashdata('message', 'Gagal mengubah profil');
        }

        redirect(base_url('user/profile'));
    }

    // Aksi Button Pulang
    public function aksi_pulang($id_absensi)
    {
        $email = $this->session->userdata('email');
        date_default_timezone_set('Asia/Jakarta');
        $waktu_sekarang = date('Y-m-d H:i:s');
        $data = [
            'jam_pulang' => $waktu_sekarang,
            'status' => 'true',
        ];
        $this->user_model->update('absensi', $data, [
            'id_absensi' => $id_absensi,
        ]);

        $options = [
            'cluster' => 'ap1',
            'useTLS' => true,
        ];
        $pusher = new Pusher(
            '33407527b00e1d0ff775',
            '9fb7fb6f4c554ecba9fb',
            '1712968',
            $options
        );
        $message['message'] = $email . ' melakukan absen pulang';
        $pusher->trigger('ExcAbsensiVersi1', 'my-event', $message);

        redirect(base_url('user/history_absensi'));
    }

    // 3. Lain-lain
    public function upload_image_user($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/user/';
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

    public function get_realtime_absensi()
    {
        // Panggil metode di dalam model untuk mendapatkan data absensi real-time
        $realtime_absensi = $this->user_model->get_realtime_absensi();

        // Mengirim data dalam format JSON
        echo json_encode($realtime_absensi);
    }

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
                $this->user_model->updateUserPassword($user_id, $data_password);
            } else {
                $this->session->set_flashdata(
                    'message',
                    'Password baru dan Konfirmasi password harus sama'
                );
                redirect(base_url('user/profile'));
            }
        }

        // Redirect ke halaman profile
        redirect(base_url('user/profile'));
    }

    // ubah foto
    public function aksi_ubah_foto()
    {
        $image = $this->upload_image_user('image');
        $user_id = $this->session->userdata('id');
        $admin = $this->user_model->getUserByID($user_id);

        if ($image[0] == true) {
            $admin->image = $image[1];
        }

        $data = [
            'image' => $image[1],
        ];

        // Update foto di database
        $this->user_model->updateUserPhoto($user_id, $data);

        // Redirect ke halaman profile
        redirect(base_url('user/profile'));
    }
}