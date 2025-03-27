<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['penerima'] = count($this->db->get('tb_penerima')->result());
        $data['daftar_bantuan'] = count($this->db->get('tb_daftar_bantuan')->result());
        $data['stok'] = count($this->db->get('tb_stok_fifo')->result());
        $data['distribusi'] = count($this->db->get('tb_stunting')->result());

        $data['data_stunting'] = count($this->db->get('tb_stunting')->result());

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}