<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['StokModel', 'DaftarBantuanModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Stok FIFO';
        $data['stok'] = $this->StokModel->getAll()->result();
        $data['jenis'] = $this->DaftarBantuanModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/stok/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('harga', 'Harga Jenis Bantuan', 'required');
        $this->form_validation->set_rules('tgl_kadaluarsa', 'Tanggal Kadaluarsa', 'required');
        $this->form_validation->set_rules('jml_stok', 'Jumlah Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data stok fifo', icon:'warning'})</script>");
            redirect('admin/stok');
        } else {
            $id_bantuan = $this->input->post('id_bantuan');
            $harga = $this->input->post('harga');
            $jml = $this->input->post('jml_stok');

            // Mengambil nilai anggaran berdasarkan id_bantuan
            $anggaran = $this->DaftarBantuanModel->getById($id_bantuan)->row()->anggaran;
            $total = $harga * $jml;

            if ($anggaran < $total) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Anggaran Tidak Mencukupi Total Biaya', icon:'warning'})</script>");
                redirect('admin/stok');
            } else {

                $jumlah = $anggaran - $harga * $jml;

                $data = [
                    'id_stok_fifo' => $this->StokModel->generateId(),
                    'id_bantuan' => $id_bantuan,
                    'harga' => $harga,
                    'tgl_masuk' => date('Y-m-d'),
                    'tgl_kadaluarsa' => $this->input->post('tgl_kadaluarsa'),
                    'jml_stok' => $jml
                ];
                $this->StokModel->save($data);

                // update daftar bantuan
                $this->DaftarBantuanModel->update($jumlah, $id_bantuan);

                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data Stok FIFO berhasil ditambahkan', icon:'success'})</script>");
                redirect('admin/stok');
            }
        }
    }

    public function delete($id_stok_fifo) {
        $this->StokModel->delete($id_stok_fifo);

        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data Stok FIFO berhasil dihapus', icon:'success'})</script>");
        redirect('admin/stok');
    }
}