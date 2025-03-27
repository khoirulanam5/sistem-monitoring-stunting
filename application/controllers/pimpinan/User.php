<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get('tb_user')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/user', $data);
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

    public function add() {
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Username sudah digunakan', icon:'warning'})</script>");
            redirect('pimpinan/user');
        } else {
            $user = [
                'id_user' => $this->generateIdUser(),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level')
            ];
            $this->db->insert('tb_user', $user);

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
            $id = $this->input->post('id_user');

            $user = [
                'id_user' => $id,
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level')
            ];
            $this->db->where('id_user', $id);
            $this->db->update('tb_user', $user);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data user berhasil diupdate', icon:'success'})</script>");
            redirect('pimpinan/user');
        }
    }

    public function delete($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data user berhasil dihapus', icon:'success'})</script>");
        redirect('pimpinan/user');
    }
}