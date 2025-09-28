<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['PengirimanModel', 'UserModel']);
        ispimpinan();
    }

    public function index() {
        $data['title'] = 'Laporan Distribusi Bantuan';
        $data['distribusi'] = $this->PengirimanModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/laporan/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($id_pengiriman) {
        $data['title'] = 'Detail Distribusi Bantuan';
        $data['distribusi'] = $this->PengirimanModel->getDetail($id_pengiriman)->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/laporan/detail', $data);
        $this->load->view('template/footer');
    }

    public function cetak() {
        $data['distribusi'] = $this->PengirimanModel->print()->result();
        $data['user'] = $this->UserModel->getByPimpinan()->result();

        $this->load->view('print/distribusi', $data);
    }
}