<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PengambilanModel extends CI_Model {

    private $_table = 'tb_pengambilan';

    public function generateId() {
        $unik = 'PB';
        $kode = $this->db->query("SELECT MAX(id_pengambilan) LAST_NO FROM tb_pengambilan WHERE id_pengambilan LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function update($hasil, $id_pengambilan) {
        $this->db->set('jml_pengambilan', $hasil);
        $this->db->where('id_pengambilan', $id_pengambilan);
        return $this->db->update($this->_table);
    }

    public function delete($id_pengambilan) {
        $this->db->where('id_pengambilan', $id_pengambilan);
        return $this->db->delete($this->_table);
    }

    public function getAll() {
        $this->db->select('tb_pengambilan.*, tb_stok_fifo.*, tb_daftar_bantuan.*');
        $this->db->from($this->_table);
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        return $this->db->get();
    }

    public function getDetail($id_pengambilan) {
        $this->db->select('tb_pengambilan.*, tb_stok_fifo.*, tb_daftar_bantuan.*');
        $this->db->from($this->_table);
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $this->db->where('tb_pengambilan.id_pengambilan', $id_pengambilan);
        return $this->db->get();
    }

    public function getByJumlah($id_pengambilan) {
        $this->db->select('jml_pengambilan');
        $this->db->from($this->_table);
        $this->db->where('id_pengambilan', $id_pengambilan);
        return $this->db->get();
    }
}