<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PengirimanModel', 'PenerimaModel', 'PengambilanModel']);
        ispetugas();
    }

    public function index() {
        $data['title'] = 'Pengiriman Bantuan';
        $data['pengiriman'] = $this->PengirimanModel->getAll()->result();
        $data['penerima'] = $this->PenerimaModel->getAll()->result();
        $data['pengambilan'] = $this->PengambilanModel->getAll()->result(); 

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('petugas/pengiriman/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('id_penerima', 'ID Penerima', 'required');
        $this->form_validation->set_rules('id_pengambilan', 'ID Pengambilan', 'required');
        $this->form_validation->set_rules('lokasi_pengiriman', 'Lokasi Pengiriman', 'required');
        $this->form_validation->set_rules('jml_pengiriman', 'Jumlah Pengiriman', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('petugas/pengiriman');
        } else {
            $id_pengambilan = $this->input->post('id_pengambilan');
            $jml_pengiriman = $this->input->post('jml_pengiriman');

            // Ambil jumlah pada tabel pengambilan
            $jml_pengambilan = $this->PengambilanModel->getByJumlah($id_pengambilan)->row()->jml_pengambilan;

            if ($jml_pengambilan < $jml_pengiriman) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Stok Tidak Cukup', text:'Stok barang distribusi kurang', icon:'warning'})</script>");
                redirect('petugas/pengiriman');
            } else {

                $hasil = $jml_pengambilan - $jml_pengiriman;

                $data = [
                    'id_pengiriman' => $this->PengirimanModel->generateId(),
                    'id_penerima' => $this->input->post('id_penerima'),
                    'id_pengambilan' => $id_pengambilan,
                    'tgl_pengiriman' => date('Y-m-d'),
                    'status_pengiriman' => 'Dikirim',
                    'lokasi_pengiriman' => $this->input->post('lokasi_pengiriman'),
                    'jml_pengiriman' => $jml_pengiriman
                ];
                $this->PengirimanModel->save($data);

                // Update jumlah pada tabel pengambilan
                $this->PengambilanModel->update($hasil, $id_pengambilan);

                // Kirim Notifikasi
                $this->PengirimanModel->sendNotif($data['id_pengiriman']);

                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil disimpan', icon:'success'})</script>");
                redirect('petugas/pengiriman');
            }
        }
    }
}