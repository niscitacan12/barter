<?php
function organisasi($id_organisasi)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db->where('id_organisasi', $id_organisasi)->get('organisasi');
    foreach ($result->result() as $c) {
        $tmt = $c->nama_organisasi;
        return $tmt;
    }
}
?>