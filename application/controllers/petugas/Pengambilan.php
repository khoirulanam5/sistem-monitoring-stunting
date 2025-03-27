<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengambilan extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Pengambilan Bantuan dari Stok FIFO';

        $this->db->select('tb_pengambilan.*, tb_stok_fifo.*, tb_daftar_bantuan.*');
        $this->db->from('tb_pengambilan');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $data['pengambilan_bantuan'] = $this->db->get()->result();

        $this->db->select('a.id_stok_fifo, a.tgl_kadaluarsa, b.jenis_bantuan, b.status');
        $this->db->from('tb_stok_fifo a');
        $this->db->join('tb_daftar_bantuan b', 'a.id_bantuan = b.id_bantuan');
        $data['stok'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('petugas/pengambilan/index', $data);
        $this->load->view('template/footer');
    }

    public function generateId() {
        $unik = 'PB';
        $kode = $this->db->query("SELECT MAX(id_pengambilan) LAST_NO FROM tb_pengambilan WHERE id_pengambilan LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
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
            $this->db->select('jml_stok');
            $this->db->from('tb_stok_fifo');
            $this->db->where('id_stok_fifo', $stok);
            $jumlah_stok = $this->db->get()->row()->jml_stok;
    
            // Cek apakah jumlah stok cukup untuk pengambilan
            if ($jumlah_stok < $jumlah_pengambilan) {
                // Jika stok kurang, munculkan pesan error
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Stok Tidak Cukup', text:'Stok barang distribusi kurang', icon:'warning'})</script>");
                redirect('petugas/pengambilan');
            } else {
                // Jika stok cukup, lakukan proses pengurangan stok dan penyimpanan data
                $hasil = $jumlah_stok - $jumlah_pengambilan;
    
                $data = [
                    'id_pengambilan' => $this->generateId(),
                    'id_stok_fifo' => $stok,
                    'tgl_pengambilan' => date('Y-m-d'),
                    'jml_pengambilan' => $jumlah_pengambilan
                ];
                $this->db->insert('tb_pengambilan', $data);
    
                $this->db->set('tgl_keluar', date('Y-m-d'));
                $this->db->set('jml_stok', $hasil);
                $this->db->where('id_stok_fifo', $stok);
                $this->db->update('tb_stok_fifo');
    
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data pengambilan bantuan berhasil ditambah', icon:'success'})</script>");
                redirect('petugas/pengambilan');
            }
        }
    }    

    public function detail($id_pengambilan) {
        $data['title'] = 'Detail Bantuan';

        $this->db->select('tb_pengambilan.*, tb_stok_fifo.*, tb_daftar_bantuan.*');
        $this->db->from('tb_pengambilan');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $this->db->where('tb_pengambilan.id_pengambilan', $id_pengambilan);
        $data['pengambilan_bantuan'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('petugas/pengambilan/detail', $data);
        $this->load->view('template/footer');
    }

    public function delete($id_pengambilan) {
        $this->db->where('id_pengambilan', $id_pengambilan);
        $this->db->delete('tb_pengambilan');
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data pengambilan bantuan berhasil dihapus', icon:'success'})</script>");
        redirect('petugas/pengambilan');
    }
}