<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get_user()
    {
        return $this->db->count_all('user');
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

    public function ubah_data($table, $data, $where) 
    { 
        // Fungsi untuk mengubah data dalam tabel 
        $this->db->where($where); 
        return $this->db->update($table, $data); 
    }
    
    public function get_item_count()
    {
        return $this->db->count_all('item');
    }

    public function get_all_data_user()
    {
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }

    public function hapus_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('user'); 
    } 

    public function get_all_data_item() 
    {
        $query = $this->db->get('item');
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }

    public function get_data_by_month($bulan) 
    {
        $this->db->where('MONTH(date)', $bulan);
        $query = $this->db->get('item'); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function get_admin_data()
    {
        $query = $this->db->get('admin');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; 
        }
    }

    public function getDataAdmin($id)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id_admin', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function tambah_nomor_telepon($nomor_telepon, $id_user)
    {
        $data = array(
            'nomor_telepon' => $nomor_telepon,
            'id_user' => $id_user,
        );

        $this->db->insert('komunikasi', $data);
    }

    public function getBulanan($bulan)
    {
        $this->db->select('user.username, item.nama_barang, item.kategori, item.date');
        $this->db->from('item');
        $this->db->join('user', 'user.id_user = item.id_user', 'left');
        $this->db->where('MONTH(item.date)', $bulan);
        $query = $this->db->get();
    
        return $query->result();
    }
}
?>