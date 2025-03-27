<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Laporan Distribusi Bantuan';

        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from('tb_pengiriman');
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $data['distribusi'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/laporan/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($id_pengiriman) {
        $data['title'] = 'Detail Distribusi Bantuan';

        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from('tb_pengiriman');
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $this->db->where('tb_pengiriman.id_pengiriman', $id_pengiriman);
        $data['distribusi'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/laporan/detail', $data);
        $this->load->view('template/footer');
    }

    public function cetak() {
        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from('tb_pengiriman');
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $this->db->where('tb_pengiriman.status_pengiriman', 'Diterima');
        $data['distribusi'] = $this->db->get()->result();

        $this->db->select('tb_user.*');
        $this->db->from('tb_user');
        $this->db->where('tb_user.level', 'PIMPINAN');
        $data['user'] = $this->db->get()->result();

        $this->load->view('print/distribusi', $data);
    }
}