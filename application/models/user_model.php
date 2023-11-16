<?php

class User_model extends CI_Model
{
    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
}
?>