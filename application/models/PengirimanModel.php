<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PengirimanModel extends CI_Model {

    private $_table = 'tb_pengiriman';

    public function generateId() {
        $unik = 'PGB';
        $kode = $this->db->query("SELECT MAX(id_pengiriman) LAST_NO FROM tb_pengiriman WHERE id_pengiriman LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function verify($id_pengiriman) {
        $this->db->set('status_pengiriman', 'Diterima');
        $this->db->set('tgl_diterima', date('Y-m-d'));
        $this->db->where('id_pengiriman', $id_pengiriman);
        return $this->db->update($this->_table);
    }

    public function getAll() {
        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from($this->_table);
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        return $this->db->get();
    }

    public function getDetail($id_pengiriman) {
        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from($this->_table);
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $this->db->where('tb_pengiriman.id_pengiriman', $id_pengiriman);
        return $this->db->get();
    }

    public function getPenerima() {
        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from($this->_table);
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $this->db->where('tb_penerima.id_penerima', $this->session->userdata('id_penerima'));
        return $this->db->get();
    }

    public function print() {
        $this->db->select('tb_pengiriman.*, tb_penerima.*, tb_pengambilan.*, tb_daftar_bantuan.*');
        $this->db->from($this->_table);
        $this->db->join('tb_penerima', 'tb_pengiriman.id_penerima = tb_penerima.id_penerima', 'left');
        $this->db->join('tb_pengambilan', 'tb_pengiriman.id_pengambilan = tb_pengambilan.id_pengambilan', 'left');
        $this->db->join('tb_stok_fifo', 'tb_pengambilan.id_stok_fifo = tb_stok_fifo.id_stok_fifo', 'left');
        $this->db->join('tb_daftar_bantuan', 'tb_stok_fifo.id_bantuan = tb_daftar_bantuan.id_bantuan', 'left');
        $this->db->where('tb_pengiriman.status_pengiriman', 'Diterima');
        return $this->db->get();
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

        $userkey = $this->config->item('userkey');
        $passkey = $this->config->item('passkey');
        $url     = $this->config->item('url');

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