<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['UserModel']);
        ispimpinan();
    }

    public function index() {
        $data['title'] = 'Data User';
        $data['user'] = $this->UserModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/user', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Username sudah digunakan', icon:'warning'})</script>");
            redirect('pimpinan/user');
        } else {
            $data = [
                'id_user' => $this->UserModel->generateId(),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level')
            ];
            $this->UserModel->save($data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data user berhasil ditambahkan', icon:'success'})</script>");
            redirect('pimpinan/user');
        }
    }

    public function edit($id_user) {
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Jabatan pengguna', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Username sudah digunakan', icon:'warning'})</script>");
            redirect('pimpinan/user');
        } else {
            $data = [
                'id_user' => $id_user,
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level')
            ];
            $this->UserModel->edit($id_user, $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data user berhasil diupdate', icon:'success'})</script>");
            redirect('pimpinan/user');
        }
    }

    public function delete($id_user) {
        $this->UserModel->delete($id_user);
        
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data user berhasil dihapus', icon:'success'})</script>");
        redirect('pimpinan/user');
    }
}