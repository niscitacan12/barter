<?php

class M_model extends CI_Model
{
    public function addAdmin($data)
    {
        $this->db->insert('admin', $data);
    }

    // Mendapatkan semua data dari tabel tertentu
    function get_data($table){
        return $this->db->get($table);
    }
}
?>