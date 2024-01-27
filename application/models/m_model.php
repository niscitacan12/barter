<?php
class M_model extends CI_Model
{
    function getwhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function get_data($table)
    {
        return $this->db->get($table);
    }    

    public function update_data($table, $data, $where)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }
}
?>