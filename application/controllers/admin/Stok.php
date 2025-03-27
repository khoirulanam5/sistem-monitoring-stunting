<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Stok FIFO';

        $this->db->select('tb_stok_fifo.*, tb_daftar_bantuan.*');
        $this->db->from('tb_stok_fifo');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan');
        $data['stok'] = $this->db->get()->result();

        $data['jenis'] = $this->db->get('tb_daftar_bantuan')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/stok/index', $data);
        $this->load->view('template/footer');
    }

    public function generateId() {
        $unik = 'SF';
        $kode = $this->db->query("SELECT MAX(id_stok_fifo) LAST_NO FROM tb_stok_fifo WHERE id_stok_fifo LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
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

            // Query ke database untuk mengambil nilai anggaran berdasarkan id_bantuan
            $this->db->select('anggaran'); // Hanya kolom 'anggaran' yang diambil
            $this->db->from('tb_daftar_bantuan'); // Nama tabel
            $this->db->where('id_bantuan', $id_bantuan); // Kondisi pencarian
            $anggaran = $this->db->get()->row()->anggaran;

            $total = $harga * $jml;

            if ($anggaran < $total) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Anggaran Tidak Mencukupi Total Biaya', icon:'warning'})</script>");
                redirect('admin/stok');
            } else {

                $jumlah = $anggaran - $harga * $jml;

                $data = [
                    'id_stok_fifo' => $this->generateId(),
                    'id_bantuan' => $id_bantuan,
                    'harga' => $harga,
                    'tgl_masuk' => date('Y-m-d'),
                    'tgl_kadaluarsa' => $this->input->post('tgl_kadaluarsa'),
                    'jml_stok' => $jml
                ];
                $this->db->insert('tb_stok_fifo', $data);

                $this->db->set('anggaran', $jumlah);
                $this->db->where('id_bantuan', $id_bantuan);
                $this->db->update('tb_daftar_bantuan');

                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data Stok FIFO berhasil ditambahkan', icon:'success'})</script>");
                redirect('admin/stok');
            }
        }
    }

    public function delete($id_stok_fifo) {
        $this->db->where('id_stok_fifo', $id_stok_fifo);
        $this->db->delete('tb_stok_fifo');
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data Stok FIFO berhasil dihapus', icon:'success'})</script>");
        redirect('admin/stok');
    }
}