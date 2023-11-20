<?php
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
    $result = $ci->db->where('id_lokasi', $id_lokasi)->get('user');
    return $result->num_rows();
}


// Format tanggal Indonesia
function convDate($date) 
{
    $bulan = array(
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
        12 => 'Desember'
    );

    $tanggal = date('d', strtotime($date)); // Mengambil tanggal dari timestamp
    $bulan = $bulan[date('n', strtotime($date))]; // Mengambil bulan dalam bentuk string
    $tahun = date('Y', strtotime($date)); // Mengambil tahun dari timestamp

    return $tanggal . ' ' . $bulan . ' ' . $tahun; // Mengembalikan tanggal yang diformat
}

?>