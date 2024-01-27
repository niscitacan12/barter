<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('admin_model'); 
        $this->load->helper('admin_helper'); 
    }

    // Dashboard
    public function index()
    {
        $data = array();
        
        $data['user'] = $this->admin_model->get_user();
        $data['item_count'] = $this->admin_model->get_item_count();
        $data['data_items'] = $this->admin_model->get_all_data(); 

        $this->load->view('page/admin/dashboard_barter', $data);
    }

    // Profile admin
    public function profile_barter()
    {
        $data = array(); 
        $data['admin'] = $this->admin_model->get_admin_data();

        $this->load->view('page/admin/profile/profile_barter', $data);
    }

    // Pengguna Atau User
    public function user_barter()
    {
        $data = array();

        $data['data_user'] = $this->admin_model->get_all_data_user(); 

        $this->load->view('page/admin/user/user_barter', $data);
    }

    // aksi hapus user
    public function aksi_hapus_user($id_user)
    {
        $deleted_rows = $this->admin_model->hapus_user($id_user);

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

        redirect(base_url('admin/user_barter')); 
    }

    // page tambah nomor telepon
    public function tambah_nomor_telepon()
    {
        $data = array();

        $this->load->view('page/admin/user/tambah_nomor_telepon', $data);
    }

    // aksi tambah nomor telepon
    public function aksi_tambah_nomor_telepon()
    {
        if ($this->input->post('nomor_telepon')) {
            $nomor_telepon = $this->input->post('nomor_telepon');
            
            $id_user = $this->session->userdata('id_user'); 
            
            if ($id_user) {
                $this->admin_model->tambah_nomor_telepon($nomor_telepon, $id_user);
                
                // Tambahkan pesan sukses
                $this->session->set_flashdata('success', 'Nomor telepon berhasil ditambahkan.');
                
                redirect('admin/user_barter');
            } else {
                redirect('admin/tambah_nomor_telepon');
            }
        } else {
            redirect('admin/tambah_nomor_telepon');
        }
    }

    // aksi setuju
    public function aksi_setuju($id_item) 
    { 
        $status = [ 
        'status' => 'DSisetujui' 
        ]; 
 
        $update_status = $this->admin_model->ubah_data('item', $status, array('id_item' => $id_item)); 
       
        if ($update_status) { 
        redirect(base_url('admin/permohonan_barter')); 
        } else { 
        echo 'error'; 
        redirect(base_url('admin/error')); 
        } 
    }

    // page permohonan pertukaran barter
    public function permohonan_barter()
    {
        $id_admin = $this->session->userdata('id_admin');

        $id_item = $this->input->post('id_item');
        $data['item'] = $this->admin_model->get_all_data(); 

        $this->load->view('page/admin/pertukaran/permohonan_barter', $data);
    }

    // rekap bulanan
    public function rekap_bulanan_barter()
    {
        $data = array(); 
        $bulan = $this->input->post('bulan');

        $data['item'] = $this->admin_model->get_data_by_month($bulan);

        $this->load->view('page/admin/rekap/rekap_bulanan_barter', $data);
    }

    // aksi edit profile
    public function edit_data() 
    {
        if($this->session->userdata('id')) {
            $admin_id = $this->session->userdata('id');

            $data['admin'] = $this->admin_model->getDataAdmin($admin_id);
            $this->load->view('page/admin/profile/profile_barter', $data);
        } else {
            redirect('admin/profile_barter');
        }his->load->view('admin/profile_barter', $data);
    }

    // export bulanan
    // public function export_rekap_bulanan()
    // {
    //     $bulan = $this->session->flashdata('bulan');
    //     $data = $this->admin_model->get_bulanan($bulan);
    
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $style_col = [
    //         'font' => ['bold' => true],
    //         'alignment' => [
    //             'horizontal' =>
    //                 \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //             'vertical' =>
    //                 \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    //         ],
    //         'borders' => [
    //             'top' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'right' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'bottom' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'left' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //         ],
    //     ];

    //     $style_row = [
    //         'font' => ['bold' => true],
    //         'alignment' => [
    //             'vertical' =>
    //                 \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    //         ],
    //         'borders' => [
    //             'top' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'right' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'bottom' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'left' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //         ],
    //     ];

    //     $sheet->setCellValue('A1', 'REKAP BULANAN');
    //     $sheet->mergeCells('A1:G1');
    //     $sheet
    //         ->getStyle('A1')
    //         ->getFont()
    //         ->setBold(true);

    //     $sheet->setCellValue('A3', 'NO');
    //     $sheet->setCellValue('B3', 'NAMA BARANG');
    //     $sheet->setCellValue('C3', 'KATEGORI');
    //     $sheet->setCellValue('D3', 'STATUS');
    //     $sheet->setCellValue('E3', 'TANGGAL');
        
    //     $sheet->getStyle('A3')->applyFromArray($style_col);
    //     $sheet->getStyle('B3')->applyFromArray($style_col);
    //     $sheet->getStyle('C3')->applyFromArray($style_col);
    //     $sheet->getStyle('D3')->applyFromArray($style_col);
    //     $sheet->getStyle('E3')->applyFromArray($style_col);
       
    //     $data = $this->admin_model->get_bulanan($bulan);

    //     $no = 1;
    //     $numrow = 4;
    //     foreach ($item as $row) {
    //         $sheet->setCellValue('A' . $numrow, $no);
    //         $sheet->setCellValue('B' . $numrow, $row->nama_barang);
    //         $sheet->setCellValue('C' . $numrow, $row->kategori);
    //         $sheet->setCellValue('D' . $numrow, $row->status);
    //         $sheet->setCellValue('E' . $numrow, $row->date);
           
    //         $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
           
    //         $no++;
    //         $numrow++;
    //     }

    //     $sheet->getColumnDimension('A')->setWidth(5);
    //     $sheet->getColumnDimension('B')->setWidth(25);
    //     $sheet->getColumnDimension('C')->setWidth(25);
    //     $sheet->getColumnDimension('D')->setWidth(20);
    //     $sheet->getColumnDimension('E')->setWidth(30);
       
    //     $sheet->getDefaultRowDimension()->setRowHeight(-1);

    //     $sheet
    //         ->getPageSetup()
    //         ->setOrientation(
    //             \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
    //         );

    //     $sheet->setTitle('REKAP BULANAN');

    //     header(
    //         'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    //     );
    //     header('Content-Disposition: attachment; filename="REKAP BULANAN.xlsx"');
    //     header('Cache-Control: max-age=0');

    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save('php://output');
    // } 
    public function export_rekap_bulanan()
    {
        $bulan = $this->input->get('bulan');
		$item = $this->admin_model->GetBulanan($bulan);
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
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
        $sheet->mergeCells('A1:G1');
        $sheet
        ->getStyle('A1')
        ->getFont()
        ->setBold(true);

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'USERNAME');
        $sheet->setCellValue('C3', 'NAMA BARANG');
        $sheet->setCellValue('D3', 'KATEGORI');
        $sheet->setCellValue('E3', 'TANGGAL');
        
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        
        $item = $this->admin_model->getBulanan($bulan);
        
        $no = 1;
        $numrow = 4;
        foreach ($item as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data->username);
			$sheet->setCellValue('C' . $numrow, $data->nama_barang);
			$sheet->setCellValue('D' . $numrow, $data->kategori);
			$sheet->setCellValue('E' . $numrow, $data->date);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);

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
        header('Content-Disposition: attachment; filename="REKAP BULANAN.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
?>