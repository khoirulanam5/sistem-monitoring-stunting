<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class StokModel extends CI_Model {

    private $_table = 'tb_stok_fifo';

    public function generateId() {
        $unik = 'SF';
        $kode = $this->db->query("SELECT MAX(id_stok_fifo) LAST_NO FROM tb_stok_fifo WHERE id_stok_fifo LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function update($hasil, $stok) {
        $this->db->set('tgl_keluar', date('Y-m-d'));
        $this->db->set('jml_stok', $hasil);
        $this->db->where('id_stok_fifo', $stok);
        return $this->db->update($this->_table);
    }

    public function delete($id_stok_fifo) {
        $this->db->where('id_stok_fifo', $id_stok_fifo);
        return $this->db->delete($this->_table);
    }

    public function getAll() {
        $this->db->select('tb_stok_fifo.*, tb_daftar_bantuan.*');
        $this->db->from($this->_table);
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan');
        return $this->db->get();
    }

    public function getById($stok) {
        $this->db->select('jml_stok');
        $this->db->from($this->_table);
        $this->db->where('id_stok_fifo', $stok);
        return $this->db->get();
    }

    public function getSelect() {
        $this->db->select('a.id_stok_fifo, a.tgl_kadaluarsa, b.jenis_bantuan, b.status');
        $this->db->from('tb_stok_fifo a');
        $this->db->join('tb_daftar_bantuan b', 'a.id_bantuan = b.id_bantuan');
        return $this->db->get();
    }
}