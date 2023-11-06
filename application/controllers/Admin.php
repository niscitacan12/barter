<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('my_helper');
        if($this->session->userdata('logged_in')!=true || $this->session->userdata('role') != 'admin') {
            redirect(base_url().'auth');
        }
    }

    // Page Dashboard
    public function index()
    {
        $this->load->view('page/admin/dashboard');
    }

    // Page Organisasi
    public function organisasi()
    {
        $id_admin = $this->session->userdata('id');
        $data['user'] = $this->admin_model->get_data('user')->result();
        $this->load->view('page/admin/organisasi', $data);
    }

    // Page Jabatan
    public function jabatan()
    {
        $this->load->view('page/admin/jabatan');
    }

     // Page Lokasi
     public function lokasi()
     {
         $this->load->view('page/admin/lokasi');
     }

    // Page Jam Kerja
    public function shift()
    {
        $this->load->view('page/admin/shift');
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
        $data['user'] = $this->admin_model->get_user();
        $this->load->view('page/admin/user', $data);
    }

    // Page Absensi
    public function absensi()
    {
        $id_admin = $this->session->userdata('id');
        $data['absensi'] = $this->admin_model->get_absen_by_admin($id_admin)->result();
        $this->load->view('page/admin/absensi', $data);
    }

    // Page Profile
    public function profile()
    {
        $this->load->view('page/admin/profile');
    }

    // Page tambah user
    public function tambah_user()
    {
        $this->load->view('page/admin/tambah_user');
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
    
    // Aksi tambah user
   
 public function aksi_tambah_user() {
    // Ambil data yang diperlukan dari form, termasuk admin_id yang dipilih
    $id_admin = $this->session->userdata('id');
    $data = [
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'nama_depan' => $this->input->post('nama_depan'),
        'nama_belakang' => $this->input->post('nama_belakang'),
        'id_admin' => $id_admin, // Set 'id_admin' to the value from the session
        'password' => md5($this->input->post('password')), // Simpan kata sandi yang telah di-MD5
        'image' => 'User.png',
        'role' => 'user',
        // sesuaikan dengan kolom lainnya
    ];

    // Panggil function pada model
    $this->admin_model->tambah_data('user', $data);

    // Redirect kembali ke halaman yang sesuai
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
        $old_file = $this->m_model->get_foto_by_id($this->session->userdata('id'));
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
                    $this->session->set_flashdata('message', 'Password baru dan konfirmasi password harus sama');
                    redirect(base_url('admin/profile'));
                }
            }
            
            $this->session->set_userdata($data);
            $update_result = $this->admin_model->update('user', $data, array('id' => $this->session->userdata('id')));
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
                $this->session->set_flashdata('message', 'Password baru dan konfirmasi password harus sama');
                redirect(base_url('admin/profile'));
            }
        }
        
        $this->session->set_userdata($data);
        $update_result = $this->admin_model->update('user', $data, array('id' => $this->session->userdata('id')));
        redirect(base_url('admin/profile'));
    }
  }

}
?>