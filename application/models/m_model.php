<?php

class M_model extends CI_Model
{
    public function addAdmin($data)
    {
        $this->db->insert('admin', $data);
    }
}
?>
