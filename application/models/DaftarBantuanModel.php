<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarBantuanModel extends CI_Model {

    private $_table = 'tb_daftar_bantuan';

    public function generateId() {
        $unik = 'DB';
        $kode = $this->db->query("SELECT MAX(id_bantuan) LAST_NO FROM tb_daftar_bantuan WHERE id_bantuan LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        return $this->db->get($this->_table);
    }

    public function getById($id_bantuan) {
        $this->db->select('anggaran');
        $this->db->from($this->_table);
        $this->db->where('id_bantuan', $id_bantuan);
        return $this->db->get();
    }

    public function update($jumlah, $id_bantuan) {
        $this->db->set('anggaran', $jumlah);
        $this->db->where('id_bantuan', $id_bantuan);
        return $this->db->update($this->_table);
    }

    public function getStunting() {
        return $this->db->get_where($this->_table, ['status' => 'stunting']);
    }

    public function getNonStunting() {
        return $this->db->get_where($this->_table, ['status' => 'tidak stunting']);
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_bantuan, $data) {
        $this->db->where('id_bantuan', $id_bantuan);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_bantuan) {
        $this->db->where('id_bantuan', $id_bantuan);
        return $this->db->delete($this->_table);
    }
}