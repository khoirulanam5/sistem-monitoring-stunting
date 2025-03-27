<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerima extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Penerima';
        
        $this->db->select('tb_penerima.*, tb_user.*');
        $this->db->from('tb_penerima');
        $this->db->join('tb_user', 'tb_penerima.id_user = tb_user.id_user', 'left');
        $data['penerima'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/penerima/index', $data);
        $this->load->view('template/footer');
    }

    public function generateIdUser() {
        $unik = 'U';
        $kode = $this->db->query("SELECT MAX(id_user) LAST_NO FROM tb_user WHERE id_user LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
      }

    public function generateIdPenerima() {
        $unik = 'P';
        $kode = $this->db->query("SELECT MAX(id_penerima) LAST_NO FROM tb_penerima WHERE id_penerima LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
      }

    public function add() {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('umur', 'Umur', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomer Handphone', 'required|numeric');
        $this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'required');
        $this->form_validation->set_rules('status_penerima', 'Status Penerima', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('admin/penerima');
        } else {
            $user = [
                'id_user' => $this->generateIdUser(),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => 'PENERIMA'
            ];
            $this->db->insert('tb_user', $user);

            $id_user = $user['id_user'];

            // Konfigurasi upload
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/images/';
            $this->load->library('upload', $config);
            $this->upload->do_upload('ktp');
            $ktp = $this->upload->data('file_name');

            // Konfigurasi upload
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/images/';
            $this->load->library('upload', $config);
            $this->upload->do_upload('kk');
            $kk = $this->upload->data('file_name');

            $penerima = [
                'id_penerima' => $this->generateIdPenerima(),
                'id_user' => $id_user,
                'nama' => $this->input->post('nama'),
                'umur' => $this->input->post('umur'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'ktp' => $ktp,
                'kk' => $kk,
                'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
                'status_penerima' => $this->input->post('status_penerima')
            ];
            $this->db->insert('tb_penerima', $penerima);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data penerima berhasil ditambahkan', icon:'success'})</script>");
            redirect('admin/penerima');
        }
    }

    public function edit($id_user) {
        $data['title'] = 'Data Penerima';
        
        // Query untuk mengambil data penerima berdasarkan id_user
        $this->db->select('tb_penerima.*, tb_user.*');
        $this->db->from('tb_penerima');
        $this->db->join('tb_user', 'tb_penerima.id_user = tb_user.id_user');
        $this->db->where('tb_penerima.id_user', $id_user);
        $data['value'] = $this->db->get()->row();
    
        // Validasi Form
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('umur', 'Umur', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomer Handphone', 'required|numeric');
        $this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'required');
        $this->form_validation->set_rules('status_penerima', 'Status Penerima', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Tampilkan form edit
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/penerima/edit', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->input->post('id_user');
    
            // Data untuk tb_user
            $user = [
                'id_user' => $id,
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => 'PENERIMA'
            ];
            $this->db->where('id_user', $id);
            $this->db->update('tb_user', $user);
    
            // Data untuk tb_penerima
            $penerima = [
                'id_user' => $id,
                'nama' => $this->input->post('nama'),
                'umur' => $this->input->post('umur'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
                'status_penerima' => $this->input->post('status_penerima'),
                'verify' => 'Terverifikasi'
            ];
    
            // Konfigurasi file upload
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // Maksimum 2MB
            
            // Load Library Upload
            $this->load->library('upload', $config);
    
            // Upload file KTP
            if (!empty($_FILES['ktp']['name'])) {
                $config['file_name'] = 'ktp_' . time(); // Rename file
                $this->upload->initialize($config); 
    
                if ($this->upload->do_upload('ktp')) {
                    $penerima['ktp'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/penerima/edit/'.$id);
                }
            }
    
            // Upload file KK
            if (!empty($_FILES['kk']['name'])) {
                $config['file_name'] = 'kk_' . time(); // Rename file
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload('kk')) {
                    $penerima['kk'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/penerima/edit/'.$id);
                }
            }
    
            // Update tb_penerima
            $this->db->where('id_user', $id);
            $this->db->update('tb_penerima', $penerima);
    
            // Set Flashdata Success
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data penerima berhasil diupdate', icon:'success'})</script>");
            redirect('admin/penerima');
        }
    }
    
    public function verifikasi($id_penerima) {

        $this->db->set('verify', 'Terverifikasi');
        $this->db->where('id_penerima', $id_penerima);
        $this->db->update('tb_penerima');

        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Akun penerima berhasil diverifikasi', icon:'success'})</script>");
        redirect('admin/penerima');
    }

    public function delete($id_user) {
        $this->db->trans_start();
        $this->db->where('id_penerima', $id_user);
        $this->db->delete('tb_penerima');
    
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        $this->db->trans_complete();
    
        if ($this->db->trans_status() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data penerima gagal dihapus', icon:'error'})</script>");
        } else {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data penerima berhasil dihapus', icon:'success'})</script>");
        }
        redirect('admin/penerima');
    }
}