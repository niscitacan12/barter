<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get_data_all() {
        $this->db->select('nama_barang, date, kategori');
        $this->db->from('item');
        $query = $this->db->get();
        
        return $query->result(); 
    }

    public function get_all_data()
    {
        $query = $this->db->get('item');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }

    function get_data($table)
    {
        return $this->db->get($table);
    }

    public function hapus_barter($id_item)
    {
        $this->db->where('id_item', $id_item);
        $this->db->delete('item'); 
    } 

    public function getItemById($id_item)
    {
        $this->db->select('*');
        $this->db->from('item');
        $this->db->where('id_item', $id_item);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; 
        }
    }

    public function getItems()
    {
        $this->db->select('*');
        $this->db->from('item');
        $query = $this->db->get();

        return $query->result();
    }

    public function tambah_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function get_item_by_id($id_item)
    {
        $this->db->select('nama_barang');
        $this->db->from('item');
        $this->db->where('id_item', $id_item);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ulasan_by_id($id_item)
    {
        $this->db->select('nama_barang, date, status, keterangan');
        $this->db->from('item');
        $this->db->where('id_item', $id_item);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_item_count()
    {
        return $this->db->count_all('item');
    }

    public function get_user_data()
    {
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; 
        }
    }

    public function update_user_data($nama_depan, $nama_belakang, $username, $email)
    {
        $data = array(
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'username' => $username,
            'email' => $email
        );

        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('user', $data);
    }

    public function update($tabel, $data, $where)
    {
        $data = $this->db->update($tabel, $data, $where);
        return $this->db->affected_rows();
    }
}
?>
