<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_bantuan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['DaftarBantuanModel']);
        ispimpinan();
    }

    public function index() {
        $data['title'] = 'Bantuan Stunting';
        $data['daftar_bantuan'] = $this->DaftarBantuanModel->getStunting()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/daftar_bantuan', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('nm_bantuan', 'Nama Bantuan', 'required');
        $this->form_validation->set_rules('jenis_bantuan', 'Jenis Bantuan', 'required');
        $this->form_validation->set_rules('anggaran', 'Anggaran Bantuan', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data daftar bantuan', icon:'warning'})</script>");
            redirect('pimpinan/daftar_bantuan');
        } else {
            $data = [
                'id_bantuan' => $this->DaftarBantuanModel->generateId(),
                'nm_bantuan' => $this->input->post('nm_bantuan'),
                'jenis_bantuan' => $this->input->post('jenis_bantuan'),
                'anggaran' => $this->input->post('anggaran'),
                'status' => 'stunting'
            ];
            $this->DaftarBantuanModel->save($data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Daftar Bantuan berhasil ditambahkan', icon:'success'})</script>");
            redirect('pimpinan/daftar_bantuan');
        }
    }

    public function edit($id_bantuan) {
        $this->form_validation->set_rules('nm_bantuan', 'Nama Bantuan', 'required');
        $this->form_validation->set_rules('jenis_bantuan', 'Jenis Bantuan', 'required');
        $this->form_validation->set_rules('anggaran', 'Anggaran Bantuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input daftar bantuan', icon:'warning'})</script>");
            redirect('pimpinan/daftar_bantuan');
        } else {
            $data = [
                'id_bantuan' => $id_bantuan,
                'nm_bantuan' => $this->input->post('nm_bantuan'),
                'jenis_bantuan' => $this->input->post('jenis_bantuan'),
                'anggaran' => $this->input->post('anggaran'),
                'status' => 'stunting'
            ];
            $this->DaftarBantuanModel->edit($id_bantuan, $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Daftar bantuan berhasil diupdate', icon:'success'})</script>");
            redirect('pimpinan/daftar_bantuan');
        }
    }

    public function delete($id_bantuan) {
        $this->DaftarBantuanModel->delete($id_bantuan);
        
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Daftar bantuan berhasil di hapus', icon:'success'})</script>");
        redirect('pimpinan/daftar_bantuan');
    }
}