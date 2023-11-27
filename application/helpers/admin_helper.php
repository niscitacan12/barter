<?php

function organisasi($id_organisasi)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db
        ->where('id_organisasi', $id_organisasi)
        ->get('organisasi');
    foreach ($result->result() as $c) {
        $tmt = $c->nama_organisasi;
        return $tmt;
    }
}

function get_organisasi($id_organisasi)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db->where('id_organisasi', $id_organisasi)->get('user');
    foreach ($result->result() as $c) {
        $tmt = $c->username;
        return $tmt;
    }
}

function nama_admin($id_admin)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db->where('id_admin', $id_admin)->get('admin');
    foreach ($result->result() as $c) {
        $tmt = $c->username;
        return $tmt;
    }
}

function get_jabatan_by_cuti_id($cuti_id)
{
    // Ambil instance CI
    $ci = &get_instance();

    // Load database
    $ci->load->database();

    // Query untuk mengambil data jabatan berdasarkan cuti_id
    $query = $ci->db
        ->select('jabatan.nama_jabatan')
        ->from('cuti')
        ->join('user', 'cuti.id_user = user.id_user')
        ->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan')
        ->where('cuti.id_cuti', $cuti_id)
        ->get();

    // Periksa apakah query berhasil dan hasilnya ada
    if ($query && $query->num_rows() > 0) {
        // Ambil nama jabatan dari hasil query
        $result = $query->row();
        return $result->nama_jabatan;
    }

    // Kembalikan nilai default jika tidak ada data yang ditemukan
    return 'Nama Jabatan Tidak Ditemukan';
}

function get_nama_jabatan_from_cuti($id_cuti)
{
    $ci = &get_instance();
    $ci->load->database();

    // Menggunakan JOIN untuk mengambil data dari tabel cuti, user, dan jabatan
    $result = $ci->db
        ->select('jabatan.nama_jabatan as nama_jabatan')
        ->from('cuti')
        ->join('user', 'cuti.id_user = user.id_user')
        ->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan')
        ->where('cuti.id_cuti', $id_cuti)
        ->get();

    if ($result->num_rows() > 0) {
        $row = $result->row();
        return $row->nama_jabatan;
    }

    // Jika tidak ada informasi yang ditemukan, kembalikan nilai null atau sesuai kebutuhan
    return null;
}

function nama_user($id_user)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db->where('id_user', $id_user)->get('user');
    foreach ($result->result() as $c) {
        $tmt = $c->username;
        return $tmt;
    }
}
function jumlah_karyawan($id_jabatan)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db->where('id_jabatan', $id_jabatan)->get('user');
    foreach ($result->result() as $c) {
        $tmt = $c->username;
        return $result->num_rows();
    }
}
function jumlah_karyawan_lokasi($id_lokasi)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db->where('id_lokasi', $id_lokasi)->get('lokasi');
    return $result->num_rows();
}

// Format tanggal Indonesia
function convDate($date)
{
    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $tanggal = date('d', strtotime($date)); // Mengambil tanggal dari timestamp
    $bulan = $bulan[date('n', strtotime($date))]; // Mengambil bulan dalam bentuk string
    $tahun = date('Y', strtotime($date)); // Mengambil tahun dari timestamp

    return $tanggal . ' ' . $bulan . ' ' . $tahun; // Mengembalikan tanggal yang diformat
}

// function jumlah_karyawan($id_jabatan)
// {
//     $ci = &get_instance();
//     $ci->load->database();
//     $result = $ci->db->where('id_jabatan', $id_jabatan)->get('user');
//     foreach ($result->result() as $c) {
//         $tmt = $c->username;
//         return $result->num_rows();
//     }
// }

// function jumlah_karyawan_lokasi($id_lokasi)
// {
//     $ci = &get_instance();
//     $ci->load->database();
//     $result = $ci->db->where('id_lokasi', $id_lokasi)->get('lokasi');
//     return $result->num_rows();
// }

?>