<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_model');
    }

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function register()
    {
        $data['organisasi'] = $this->m_model->get_data('organisasi')->result();
        $this->load->view('auth/register', $data);
    }

    public function register_user()
    {
        $data['organisasi'] = $this->m_model->get_data('organisasi')->result();
        $this->load->view('auth/register_user', $data);
    }

    // Aksi register untuk registrasi superadmin
    public function aksi_register_superadmin()
    {
        $username = $this->input->post('username', true);
        $email = $this->input->post('email', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $password = $this->input->post('password', true);

        // Validasi input
        if (empty($username) || empty($nama_depan) || empty($password)) {
            // Tampilkan pesan error jika ada input yang kosong
            $this->session->set_flashdata('error', 'Semua field harus diisi.');
            redirect(base_url() . 'auth/register'); // sesuaikan dengan URL halaman registrasi .
        } elseif (strlen($password) < 8) {
            $this->session->set_flashdata(
                'register_error',
                'Password minimal 8 huruf.'
            );
            redirect(base_url('auth/register'));
        } else {
            // dengan menggunakan model untuk menyimpan data pengguna
            $data = [
                'username' => $username,
                'email' => $email,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'image' => 'User.png',
                'password' => md5($password), // Simpan kata sandi yang telah di-MD5
                'role' => 'superadmin', // Atur peran menjadi superadmin
            ];

            // memanggil model untuk menyimpan data pengguna
            $this->m_model->tambah_data('superadmin', $data);
            $this->session->set_flashdata(
                'register_success',
                'Registrasi berhasil, Silakan login.'
            );

            // Setelah data pengguna berhasil disimpan, dapat mengarahkan pengguna
            // ke halaman login atau halaman lain yang sesuai.
            redirect(base_url() . ''); // sesuaikan dengan URL halaman login
        }
    }

    // Aksi register untuk registrasi user
    public function aksi_register_user()
    {
        $username = $this->input->post('username', true);
        $email = $this->input->post('email', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $password = $this->input->post('password', true);
        $id_organisasi = $this->input->post('id_organisasi', true);
        // $id_admin = $this->m_model->get_admin_id($id_organisasi);

        // Validasi input
        if (empty($username) || empty($nama_depan) || empty($password)) {
            // Tampilkan pesan error jika ada input yang kosong
            $this->session->set_flashdata('error', 'Semua field harus diisi.');
            redirect(base_url() . 'auth/register'); // sesuaikan dengan URL halaman registrasi .
        } elseif (strlen($password) < 8) {
            $this->session->set_flashdata(
                'register_error',
                'Password minimal 8 huruf.'
            );
            redirect(base_url('auth/register'));
        } else {
            // dengan menggunakan model untuk menyimpan data pengguna
            $data = [
                'username' => $username,
                'email' => $email,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'image' => 'User.png',
                'password' => md5($password), // Simpan kata sandi yang telah di-MD5
                'id_organisasi' => $id_organisasi,
                'id_admin' => $this->m_model->get_admin_id($id_organisasi),
                // 'id_shift' => '0',
                // 'id_jabatan' => '0',
                'image' => 'User.png',
                'role' => 'user',
            ];

            // memanggil model untuk menyimpan data pengguna
            $this->m_model->tambah_data('user', $data);
            $this->session->set_flashdata(
                'register_success',
                'Registrasi berhasil, Silakan login.'
            );

            // Setelah data pengguna berhasil disimpan, dapat mengarahkan pengguna
            // ke halaman login atau halaman lain yang sesuai.
            redirect(base_url() . ''); // sesuaikan dengan URL halaman login
        }
    }

    public function aksi_login()
    {
        // Mengambil data email dan password yang dikirimkan melalui form login.
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        // Mencari data pengguna di tiga tabel yang mungkin memiliki pengguna dengan alamat email yang sesuai.
        $tables = ['superadmin', 'admin', 'user'];

        foreach ($tables as $table) {
            // Membuat array $data untuk mencari pengguna berdasarkan alamat email.
            $data = [
                'email' => $email,
            ];

            // Mencari data pengguna dengan alamat email yang sesuai dalam database.
            $query = $this->m_model->getwhere($table, $data);
            // Mengambil hasil pencarian dalam bentuk array asosiatif.
            $result = $query->row_array();

            // Memeriksa apakah hasil pencarian tidak kosong dan kata sandi cocok.
            if (!empty($result) && md5($password) === $result['password']) {
                // Jika berhasil login:

                // Membuat array $data_sess untuk sesi pengguna.
                $data_sess = [
                    'logged_in' => true, // Menandakan bahwa pengguna sudah login.
                    'email' => $result['email'],
                    'username' => $result['username'],
                    'role' => $result['role'], // Menyimpan peran pengguna (admin/karyawan).
                    'image' => $result['image'],
                    'id' => $result['id_' . $table], // Mendapatkan ID pengguna dari tabel yang tepat.
                    'id_organisasi' => $result['id_organisasi'],
                    'id_shift' => $result['id_shift'],
                    'id_jabatan' => $result['id_jabatan'],
                    'id_admin' => $result['id_admin'],
                ];
                // Mengatur data sesi pengguna dengan informasi di atas.
                $this->session->set_userdata($data_sess);
                $this->session->set_flashdata(
                    'login_success',
                    'Selamat Datang Di Absensi.'
                );

                // Mengarahkan pengguna ke halaman berdasarkan peran mereka.
                redirect(base_url() . $table);
            }
        }

        // Jika tidak ada pengguna yang cocok dengan email dan kata sandi yang diberikan.
        $this->session->set_flashdata('login_error', 'Silahkan coba kembali.');
        redirect(base_url() . ''); // Mengarahkan pengguna kembali ke halaman login.
    }

    // Aksi logout
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(''));
    }

    public function lupa_password()
    {
        $this->load->view('auth/lupa_password');
    }

    public function send_reset_email()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email'
        );

        if ($this->form_validation->run() == false) {
            // Handle validation errors
            $response = [
                'status' => 'error',
                'message' => validation_errors(),
            ];
            echo json_encode($response);
        } else {
            $email = $this->input->post('email');
            $user = $this->m_model->get_user_by_email($email);

            if ($user) {
                // Generate and save reset token
                $token = bin2hex(random_bytes(32));
                $this->m_model->set_reset_token($user['id_user'], $token);

                // Send email with reset link
                $this->load->library('email');

                $config = [
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'mingave11@gmail.com', // Ganti dengan alamat email Anda
                    'smtp_pass' => 'aveceenaintifadhafirdausming', // Ganti dengan kata sandi email Anda
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n",
                ];

                $this->email->initialize($config);

                $this->email->from('mingave11@gmail.com', 'Absensi App');
                $this->email->to($email);
                $this->email->subject('Reset Password');
                $this->email->message(
                    'Click the following link to reset your password: ' .
                        base_url('auth/reset_password/' . $token)
                );

                if ($this->email->send()) {
                    // Email sent successfully
                    $response = [
                        'status' => 'success',
                        'message' => 'Email sent successfully!',
                    ];
                } else {
                    // Email failed to send
                    $response = [
                        'status' => 'error',
                        'message' =>
                            'Failed to send email. ' .
                            $this->email->print_debugger(),
                    ];
                }

                echo json_encode($response);
            } else {
                // User not found
                $response = [
                    'status' => 'error',
                    'message' => 'User not found.',
                ];
                echo json_encode($response);
            }
        }
    }

    public function reset_password($token)
    {
        // Check if token is valid and not expired
        $user = $this->m_model->get_user_by_reset_token($token);

        if ($user && strtotime($user['token_expiration']) > time()) {
            // Token is valid, load reset password view
            $this->load->view('reset_password', ['token' => $token]);
        } else {
            // Token is invalid or expired
            echo 'Invalid or expired token';
        }
    }

    public function update_password()
    {
        // Handle form submission to update password
    }
}
?>