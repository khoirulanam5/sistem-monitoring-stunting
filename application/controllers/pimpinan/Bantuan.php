<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bantuan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Bantuan Non Stunting';
        $data['bantuan'] = $this->db->get_where('tb_daftar_bantuan', ['status' => 'tidak stunting'])->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/bantuan', $data);
        $this->load->view('template/footer');
    }

    public function generateId() {
        $unik = 'DB';
        $kode = $this->db->query("SELECT MAX(id_bantuan) LAST_NO FROM tb_daftar_bantuan WHERE id_bantuan LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
      }

    public function add() {
        $this->form_validation->set_rules('nm_bantuan', 'Nama Bantuan', 'required');
        $this->form_validation->set_rules('jenis_bantuan', 'Jenis Bantuan', 'required');
        $this->form_validation->set_rules('anggaran', 'Anggaran Bantuan', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input bantuan non stunting', icon:'warning'})</script>");
            redirect('pimpinan/bantuan');
        } else {
            $data = [
                'id_bantuan' => $this->generateId(),
                'nm_bantuan' => $this->input->post('nm_bantuan'),
                'jenis_bantuan' => $this->input->post('jenis_bantuan'),
                'anggaran' => $this->input->post('anggaran'),
                'status' => 'tidak stunting'
            ];
            $this->db->insert('tb_daftar_bantuan', $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Bantuan non stunting berhasil ditambahkan', icon:'success'})</script>");
            redirect('pimpinan/bantuan');
        }
    }

    public function edit($id_bantuan) {
        $this->form_validation->set_rules('nm_bantuan', 'Nama Bantuan', 'required');
        $this->form_validation->set_rules('jenis_bantuan', 'Jenis Bantuan', 'required');
        $this->form_validation->set_rules('anggaran', 'Anggaran Bantuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input bantuan non stunting', icon:'warning'})</script>");
            redirect('pimpinan/bantuan');
        } else {
            $id = $this->input->post('id_bantuan');

            $data = [
                'id_bantuan' => $id,
                'nm_bantuan' => $this->input->post('nm_bantuan'),
                'jenis_bantuan' => $this->input->post('jenis_bantuan'),
                'anggaran' => $this->input->post('anggaran'),
                'status' => 'tidak stunting'
            ];
            $this->db->where('id_bantuan', $id);
            $this->db->update('tb_daftar_bantuan', $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Bantuan non stunting berhasil diupdate', icon:'success'})</script>");
            redirect('pimpinan/bantuan');
        }
    }

    public function delete($id_bantuan) {
        $this->db->where('id_bantuan', $id_bantuan);
        $this->db->delete('tb_daftar_bantuan');
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Bantuan non stunting berhasil di hapus', icon:'success'})</script>");
        redirect('pimpinan/bantuan');
    }
}