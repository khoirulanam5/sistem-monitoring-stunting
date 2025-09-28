<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stunting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['StuntingModel', 'PenerimaModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Balita Stunting';
        $data['stunting'] = $this->StuntingModel->getAll()->result();
        $data['penerima'] = $this->PenerimaModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/stunting/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('nm_balita', 'Nama Balita', 'required');
        $this->form_validation->set_rules('umur_balita', 'Umur Balita', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tb', 'Tinggi Badan', 'required|numeric');
        $this->form_validation->set_rules('bb', 'Berat Badan', 'required|numeric');
        $this->form_validation->set_rules('status_stunting', 'Status Stunting', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('admin/stunting');
        } else {
            $stunting = [
                'id_stunting' => $this->StuntingModel->generateId(),
                'id_penerima' => $this->input->post('id_penerima'),
                'nm_balita' => $this->input->post('nm_balita'),
                'umur_balita' => $this->input->post('umur_balita'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tb' => $this->input->post('tb'),
                'bb' => $this->input->post('bb'),
                'status_stunting' => $this->input->post('status_stunting'),
                'tgl_pendataan' => date('Y-m-d')
            ];
            $this->StuntingModel->save($stunting);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data stunting berhasil ditambahkan', icon:'success'})</script>");
            redirect('admin/stunting');
        }
    }

    public function edit($id_stunting) {
        $this->form_validation->set_rules('nm_balita', 'Nama Balita', 'required');
        $this->form_validation->set_rules('umur_balita', 'Umur Balita', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tb', 'Tinggi Badan', 'required|numeric');
        $this->form_validation->set_rules('bb', 'Berat Badan', 'required|numeric');
        $this->form_validation->set_rules('status_stunting', 'Status Stunting', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('admin/stunting');
        } else {
            $stunting = [
                'id_penerima' => $this->input->post('id_penerima'),
                'nm_balita' => $this->input->post('nm_balita'),
                'umur_balita' => $this->input->post('umur_balita'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tb' => $this->input->post('tb'),
                'bb' => $this->input->post('bb'),
                'status_stunting' => $this->input->post('status_stunting'),
                'tgl_pendataan' => date('Y-m-d')
            ];
            $this->StuntingModel->edit($id_stunting, $stunting);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data stunting berhasil diperbarui', icon:'success'})</script>");
            redirect('admin/stunting');
        }
    }

    public function delete($id_stunting) {
        $this->StuntingModel->delete($id_stunting);

        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data stunting berhasil dihapus', icon:'success'})</script>");
        redirect('admin/stunting');
    }
}