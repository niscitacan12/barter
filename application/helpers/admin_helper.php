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
?>