<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribusi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PengirimanModel']);
        ispenerima();
    }

    public function index() {
        $data['title'] = 'Distribusi Bantuan';
        $data['pengiriman'] = $this->PengirimanModel->getPenerima()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('penerima/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($id_pengiriman) {
        $data['title'] = 'Detail Distribusi Bantuan';
        $data['distribusi'] = $this->PengirimanModel->getDetail($id_pengiriman)->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('penerima/detail', $data);
        $this->load->view('template/footer');
    }

    public function konfirmasi($id_pengiriman) {
        $this->PengirimanModel->verify($id_pengiriman);
    
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Bantuan telah terdistribusi', icon:'success'})</script>");
        redirect('penerima/distribusi/detail/' . $id_pengiriman);
    }    
}