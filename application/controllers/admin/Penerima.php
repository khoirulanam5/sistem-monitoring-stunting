<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerima extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PenerimaModel', 'UserModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Penerima';
        $data['penerima'] = $this->PenerimaModel->getAdmin()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/penerima/index', $data);
        $this->load->view('template/footer');
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
            $data = [
                'id_user' => $this->UserModel->generateId(),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => 'PENERIMA'
            ];
            $this->UserModel->save($data);
            $id_user = $data['id_user'];

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
                'id_penerima' => $this->PenerimaModel->generateId(),
                'id_user' => $id_user,
                'nama' => $this->input->post('nama'),
                'umur' => $this->input->post('umur'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'ktp' => $ktp,
                'kk' => $kk,
                'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
                'status_penerima' => $this->input->post('status_penerima'),
                'verify' => 'Terverifikasi'
            ];
            $this->PenerimaModel->save($penerima);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data penerima berhasil ditambahkan', icon:'success'})</script>");
            redirect('admin/penerima');
        }
    }

    public function edit($id_user) {
        $data['title'] = 'Data Penerima';
        // mengambil data penerima berdasarkan id_user
        $data['value'] = $this->PenerimaModel->getById($id_user)->row();
    
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
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/penerima/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_user' => $id_user,
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => 'PENERIMA'
            ];
            $this->UserModel->edit($id_user, $data);
    
            // Data untuk tb_penerima
            $penerima = [
                'id_user' => $id_user,
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
            $this->load->library('upload', $config);
    
            // Upload file KTP
            if (!empty($_FILES['ktp']['name'])) {
                $config['file_name'] = 'ktp_' . time(); // Rename file
                $this->upload->initialize($config); 
    
                if ($this->upload->do_upload('ktp')) {
                    $penerima['ktp'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/penerima/edit/' . $id_user);
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
                    redirect('admin/penerima/edit/' . $id_user);
                }
            }
    
            // Update tb_penerima
            $this->PenerimaModel->edit($id_user, $penerima);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data penerima berhasil diupdate', icon:'success'})</script>");
            redirect('admin/penerima');
        }
    }
    
    public function verifikasi($id_penerima) {
        $this->PenerimaModel->verify($id_penerima);

        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Akun penerima berhasil diverifikasi', icon:'success'})</script>");
        redirect('admin/penerima');
    }

    public function delete($id_user) {
        $this->PenerimaModel->delete($id_user);

        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data penerima berhasil dihapus', icon:'success'})</script>");
        redirect('admin/penerima');
    }
}