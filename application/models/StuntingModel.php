<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class StuntingModel extends CI_Model {

    private $_table = 'tb_stunting';

    public function generateId() {
        $unik = 'S';
        $kode = $this->db->query("SELECT MAX(id_stunting) LAST_NO FROM tb_stunting WHERE id_stunting LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function save($stunting) {
        return $this->db->insert($this->_table, $stunting);
    }

    public function edit($id_stunting, $stunting) {
        $this->db->where('id_stunting', $id_stunting);
        return $this->db->update($this->_table, $stunting);
    }

    public function delete($id_stunting) {
        $this->db->where('id_stunting', $id_stunting);
        return $this->db->delete($this->_table);
    }

    public function getAll() {
        $this->db->select('tb_stunting.*, tb_penerima.*');
        $this->db->from('tb_stunting');
        $this->db->join('tb_penerima', 'tb_stunting.id_penerima = tb_penerima.id_penerima');
        return $this->db->get();
    }
}