<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribusi extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Distribusi Bantuan';

        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from('tb_pengiriman');
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $this->db->where('tb_penerima.id_penerima', $this->session->userdata('id_penerima'));
        $data['pengiriman'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('penerima/index', $data);
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
        $this->load->view('penerima/detail', $data);
        $this->load->view('template/footer');
    }

    public function konfirmasi($id_pengiriman) {
    
        // Update status_pengiriman di tb_pengiriman
        $this->db->set('status_pengiriman', 'Diterima');
        $this->db->set('tgl_diterima', date('Y-m-d'));
        $this->db->where('id_pengiriman', $id_pengiriman);
        $this->db->update('tb_pengiriman');
    
        // Notifikasi berhasil
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Bantuan telah terdistribusi', icon:'success'})</script>");
        redirect('penerima/distribusi/detail/' . $id_pengiriman);
    }    
}