<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Pengiriman Bantuan';

        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from('tb_pengiriman');
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan');
        $data['pengiriman'] = $this->db->get()->result();

        $data['penerima'] = $this->db->get('tb_penerima')->result();

        $this->db->select('tb_pengambilan.*, tb_stok_fifo.*, tb_daftar_bantuan.*');
        $this->db->from('tb_pengambilan');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan');
        $data['pengambilan'] = $this->db->get()->result(); 

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('petugas/pengiriman/index', $data);
        $this->load->view('template/footer');
    }

    public function generateId() {
        $unik = 'PGB';
        $kode = $this->db->query("SELECT MAX(id_pengiriman) LAST_NO FROM tb_pengiriman WHERE id_pengiriman LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
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

            $this->db->select('jml_pengambilan');
            $this->db->from('tb_pengambilan');
            $this->db->where('id_pengambilan', $id_pengambilan);
            $jml_pengambilan = $this->db->get()->row()->jml_pengambilan;

            if ($jml_pengambilan < $jml_pengiriman) {
                // Jika stok kurang, munculkan pesan error
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Stok Tidak Cukup', text:'Stok barang distribusi kurang', icon:'warning'})</script>");
                redirect('petugas/pengiriman');
            } else {
                $hasil = $jml_pengambilan - $jml_pengiriman;
                $data = [
                    'id_pengiriman' => $this->generateId(),
                    'id_penerima' => $this->input->post('id_penerima'),
                    'id_pengambilan' => $id_pengambilan,
                    'tgl_pengiriman' => date('Y-m-d'),
                    'status_pengiriman' => 'Dikirim',
                    'lokasi_pengiriman' => $this->input->post('lokasi_pengiriman'),
                    'jml_pengiriman' => $jml_pengiriman
                ];
                $result = $this->db->insert('tb_pengiriman', $data);

                $this->db->set('jml_pengambilan', $hasil);
                $this->db->where('id_pengambilan', $id_pengambilan);
                $this->db->update('tb_pengambilan');

                $this->sendNotif($data['id_pengiriman']);

                if ($result) {
                    // Insert berhasil
                    $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil disimpan', icon:'success'})</script>");
                } else {
                    // Insert gagal
                    $error = $this->db->error(); // Tangkap error dari database
                    log_message('error', 'Insert Error: ' . print_r($error, true));
                    $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Error', text:'Data gagal disimpan: " . $error['message'] . "', icon:'error'})</script>");
                }
                redirect('petugas/pengiriman');
            }
        }
    }

    public function sendNotif($id_pengiriman) {
        $data = $this->db->query("SELECT * FROM tb_penerima
        INNER JOIN tb_pengiriman ON tb_penerima.id_penerima = tb_pengiriman.id_penerima
        WHERE tb_pengiriman.id_pengiriman = '".$id_pengiriman."'")->result_array();

        $no_hp = $data[0]['no_hp'];
        $nama = $data[0]['nama'];
        $status_penerima = $data[0]['status_penerima'];
        $lokasi_pengiriman = $data[0]['lokasi_pengiriman'];
        $tgl_pengiriman = $data[0]['tgl_pengiriman'];

        $this->db->query("UPDATE tb_pengiriman SET notif='Terkirim' WHERE id_pengiriman = '".$id_pengiriman."'");

        $userkey = "a859631d94df";
        $passkey = "3f109df052a53eaa3237060a";
        $url = "https://console.zenziva.net/wareguler/api/sendWA/";

        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $no_hp,
            'message' => "Kepada Saudara ".$nama.",\nSelaku ".$status_penerima." Balita. Kami menginformasikan bahwa bantuan balita stanting dapat diambil di ".$lokasi_pengiriman.", Pada Tanggal ".do_formal_date($tgl_pengiriman).". Demikian informasi yang dapat kita berikan.\nTerimakasih"
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
    }
}