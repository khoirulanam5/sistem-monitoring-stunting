<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PenerimaModel extends CI_Model {

    private $_table = 'tb_penerima';

    public function generateId() {
        $unik = 'P';
        $kode = $this->db->query("SELECT MAX(id_penerima) LAST_NO FROM tb_penerima WHERE id_penerima LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function save($penerima) {
        return $this->db->insert($this->_table, $penerima);
    }

    public function edit($id_user, $penerima) {
        $this->db->where('id_user', $id_user);
        return $this->db->update($this->_table, $penerima);
    }

    public function verify($id_penerima) {
        $this->db->set('verify', 'Terverifikasi');
        $this->db->where('id_penerima', $id_penerima);
        return $this->db->update($this->_table);
    }

    public function delete($id_user) {
        $this->db->trans_start();
        $this->db->where('id_penerima', $id_user);
        $this->db->delete($this->_table);
    
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        return $this->db->trans_complete();
    }

    public function getAll() {
        return $this->db->get($this->_table);
    }

    public function getAdmin() {
        $this->db->select('tb_penerima.*, tb_user.*');
        $this->db->from($this->_table);
        $this->db->join('tb_user', 'tb_penerima.id_user = tb_user.id_user', 'left');
        return $this->db->get();
    }

    public function getById($id_user) {
        $this->db->select('tb_penerima.*, tb_user.*');
        $this->db->from($this->_table);
        $this->db->join('tb_user', 'tb_penerima.id_user = tb_user.id_user');
        $this->db->where('tb_penerima.id_user', $id_user);
        return $this->db->get();
    }
}