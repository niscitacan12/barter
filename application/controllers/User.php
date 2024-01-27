<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('user_helper'); 
        $this->load->model('user_model'); 
    }

    // dashboard
    public function index()
    {
        $data = array();

        $data['data_items'] = $this->user_model->get_all_data(); 
        $data['item'] = $this->user_model->get_data_all();
        $data['item_count'] = $this->user_model->get_item_count();
    
        $this->load->view('page/user/dashboard_barter', $data);
    }

    // gambar barang atau barang
    public function barter()
    {
        $this->load->view('page/user/barang/barter');
    }

    // permohonan pertukaran barang
    public function permohonan_barter()
    {
        $config['upload_path']   = './src/image_user/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = '2048'; 
    
        $this->load->library('upload', $config);
    
        // Menangani proses permohonan barter
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
            $this->form_validation->set_rules('date', 'Tanggal', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
    
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'nama_barang' => $this->input->post('nama_barang'),
                    'date' => $this->input->post('date'),
                    'status' => $this->input->post('status'),
                );
    
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $data['image'] = $upload_data['file_name'];
    
                    // Simpan data ke database
                    $result = $this->user_model->get_data('item', $data);
    
                    if ($result) {
                        redirect('user/permohonan_barter');
                    } else {
                        echo "Gagal menyimpan data ke database.";
                    }
                } else {
                    $error = $this->upload->display_errors();
                    echo $error;
                }
            }
        }
    
        // Mendapatkan data yang sudah ada dari database
        $queryResult = $this->user_model->get_data('item');
    
        if ($queryResult) {
            if (is_object($queryResult) && method_exists($queryResult, 'result')) {
                $data['item'] = $queryResult->result();
            } else {
                $data['item'] = $queryResult;
            }
    
            $this->load->view('page/user/pertukaran/permohonan_barter', $data);
        } else {
            echo "Tidak dapat mengambil data dari database.";
        }
    }

    // tukar barang
    public function tukar_barter()
    {
        $id_user = $this->session->userdata('id');
        $data['id_user'] = $id_user;
        
        $this->load->view('page/user/tukar/tukar_barter', $data);
    }

    // aksi tukar barang
    public function aksi_tukar_barter()
    {
        $id_user = $this->session->userdata('id');
    
        $data = [
            'id_user' => $id_user,
            'nama_barang' => $this->input->post('nama_barang'),
            'date' => $this->input->post('date'),
            'keterangan' => $this->input->post('keterangan'),
            'kategori' => $this->input->post('kategori'),
            'image' => $this->input->post('image'),
            'status' => 'Diajukan',
        ];
    
        // Pastikan data dari formulir atau input tersedia sebelum penggunaan
        if ($data['nama_barang'] !== null && $data['date'] !== null && $data['keterangan'] !== null &&
            $data['status'] !== null && $data['kategori'] !== null) {
            $this->user_model->tambah_data('item', $data);
            redirect('user/permohonan_barter');
        } else {
            // Handle kesalahan jika data tidak tersedia
            echo "Data yang diperlukan tidak lengkap.";
        }
    }

    // aksi ajukan barang
    public function aksi_ajukan_barang($id_item)
    {
        $id_item = $this->input->post('id_item');
        // Buat data yang akan diupdate
        $data = [
            'status' => 'Diajukan',
        ];

        $eksekusi = $this->user_model->update('item', $data, $id_item);
        $this->session->set_flashdata(
            'berhasil_ajukan',
            'Berhasil Mengajukan item kembali'
        );

        redirect(base_url('user/permohonan_barter')); 
    }

    // rating barang
    public function rating_barter()
    {
        $data = array();
        $id_user = $this->getUserId();
        $data['item'] = $this->user_model->getItems();

        $this->load->view('page/user/rating/rating_barter', $data);
    }

    public function getUserId() 
    {
        return $this->session->userdata('user_id');
    }

    // aksi batal pertukaran barang
    public function aksi_batal_permohonan_barter($id_item)
    {
        $deleted_rows = $this->user_model->hapus_barter($id_item);

        if ($deleted_rows > 0) {
            $this->session->set_flashdata(
                'gagal_batal',
                'Gagal membatalkan barter'
            );
        } else {
            $this->session->set_flashdata(
                'berhasil_batal',
                'Berhasil membatalkan barter'
            );
        }

        redirect(base_url('user/permohonan_barter')); 
    }

    // detail barang
    public function detail_barter($id_item)
    {
        $data['item'] = $this->user_model->get_ulasan_by_id($id_item);
    
        if ($data['item']) {
            $this->load->view('page/user/pertukaran/detail_barter', $data);
        } else {
            // Handle if the item is not found
            echo "Item not found";
        }
    }

    public function komunikasi_barter()
    {
        $this->load->view('page/user/komunikasi/komunikasi_barter');
    }

    // profile
    public function profile_barter()
    {
        $data = array(); 
        $data['user'] = $this->user_model->get_user_data();
    
        $this->load->view('page/user/profile/profile_barter', $data);
    }

    // akdi edit data profile
    public function edit_data()
    {
        $data = array();
        
        // Validasi form
        $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required');
        $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('page/user/profile/profile_barter', $data);
        } else {
            // Ambil data dari formulir
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $username = $this->input->post('username');
            $email = $this->input->post('email');

            $this->user_model->update_user_data($nama_depan, $nama_belakang, $username, $email);

            redirect('user/profile_barter');
        }
    }
}
?>