<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengambilan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PengambilanModel', 'StokModel']);
        ispetugas();
    }

    public function index() {
        $data['title'] = 'Pengambilan Bantuan dari Stok FIFO';
        $data['pengambilan_bantuan'] = $this->PengambilanModel->getAll()->result();
        $data['stok'] = $this->StokModel->getSelect()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('petugas/pengambilan/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('id_stok_fifo', 'ID Stok FIFO', 'required');
        $this->form_validation->set_rules('jml_pengambilan', 'Jumlah Pengambilan', 'required|numeric');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('petugas/pengambilan');
        } else {
            $stok = $this->input->post('id_stok_fifo');
            $jumlah_pengambilan = $this->input->post('jml_pengambilan');
    
            // Ambil jumlah stok dari tabel tb_stok_fifo
            $jumlah_stok = $this->StokModel->getById($stok)->row()->jml_stok;
    
            // Cek apakah jumlah stok cukup untuk pengambilan
            if ($jumlah_stok < $jumlah_pengambilan) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Stok Tidak Cukup', text:'Stok barang distribusi kurang', icon:'warning'})</script>");
                redirect('petugas/pengambilan');
            } else {
                // Jika stok cukup, lakukan proses pengurangan stok dan penyimpanan data
                $hasil = $jumlah_stok - $jumlah_pengambilan;
    
                $data = [
                    'id_pengambilan' => $this->PengambilanModel->generateId(),
                    'id_stok_fifo' => $stok,
                    'tgl_pengambilan' => date('Y-m-d'),
                    'jml_pengambilan' => $jumlah_pengambilan
                ];
                $this->PengambilanModel->save($data);
    
                // update stok
                $this->StokModel->update($hasil, $stok);
    
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data pengambilan bantuan berhasil ditambah', icon:'success'})</script>");
                redirect('petugas/pengambilan');
            }
        }
    }    

    public function detail($id_pengambilan) {
        $data['title'] = 'Detail Bantuan';
        $data['pengambilan_bantuan'] = $this->PengambilanModel->getDetail($id_pengambilan)->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('petugas/pengambilan/detail', $data);
        $this->load->view('template/footer');
    }

    public function delete($id_pengambilan) {
        $this->PengambilanModel->delete($id_pengambilan);
        
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data pengambilan bantuan berhasil dihapus', icon:'success'})</script>");
        redirect('petugas/pengambilan');
    }
}