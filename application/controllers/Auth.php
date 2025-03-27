<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        
        $this->load->view('auth/login');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            redirect('auth');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->db->get_where("tb_user", array("username" => $username, "password" => $password))->row();

                if(!empty($cek)) {
                    $ses = [
                        'id_user' => $cek->id_user,
                        'nm_pengguna' => $cek->nm_pengguna,
                        'username' => $cek->username,
                        'password' => $cek->password,
                        'level' => $cek->level
                    ];
                    
                    $this->session->set_userdata($ses);

                    $penerima = $this->db->get_where('tb_penerima', ['id_user' => $cek->id_user, 'verify' => 'Terverifikasi'])->row();

                    if ($cek->level == 'PENERIMA' && !$penerima) {
                        $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Gagal', text:'Akun belum terverifikasi', icon:'error'})</script>");
                        redirect('auth');
                    }

                    if ($penerima) {
                        // Simpan data pegawai dalam session
                        $pen = [
                            'id_penerima' => $penerima->id_penerima,
                            'nama'    => $penerima->nama,
                            'umur'  => $penerima->umur,
                            'alamat'        => $penerima->alamat,
                            'no_hp' => $penerima->no_hp,
                            'jenis_pekerjaan' => $penerima->jenis_pekerjaan,
                            'status_penerima'     => $penerima->status_penerima
                        ];

                        $this->session->set_userdata($pen);
                    }

                    if ($cek->level == 'PIMPINAN') {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    } else if ($cek->level == 'ADMIN') {
                        $this->session->set_flashdata("pesan","<script>Swal.fire({title:'Berhasil', text:'Login Berhasil!', icon:'success'})</script>");
                        redirect('dashboard');
                    } else if ($cek->level == 'PETUGAS') {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    }
                } else {
                    $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Gagal', text:'username / password salah', icon:'error'})</script>");
                    redirect('auth');
                }
        }   
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

      public function generateIdStunting() {
        $unik = 'S';
        $kode = $this->db->query("SELECT MAX(id_stunting) LAST_NO FROM tb_stunting WHERE id_stunting LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
      }

    public function register() {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nm_pengguna', 'Nama Panggilan', 'required');
        $this->form_validation->set_rules('umur', 'Umur', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomer Hp', 'required');
        $this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'required');
        $this->form_validation->set_rules('status_penerima', 'Status Penerima', 'required');
        $this->form_validation->set_rules('nm_balita', 'Nama Balita', 'required');
        $this->form_validation->set_rules('umur_balita', 'Umur Balita', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tb', 'Tinggi Badan', 'required|numeric');
        $this->form_validation->set_rules('bb', 'Berat Badan', 'required|numeric');
        $this->form_validation->set_rules('tgl_pendataan', 'Tanggal Pendataan', 'required');
        $this->form_validation->set_rules('status_stunting', 'Status Stunting', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/registrasi');
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
                'status_penerima' => $this->input->post('status_penerima'),
                'verify' => 'Verifikasi'
            ];

            $this->db->insert('tb_penerima', $penerima);

            $id_penerima = $penerima['id_penerima'];

            $stunting = [
                'id_stunting' => $this->generateIdStunting(),
                'id_penerima' => $id_penerima,
                'nm_balita' => $this->input->post('nm_balita'),
                'umur_balita' => $this->input->post('umur_balita'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tb' => $this->input->post('tb'),
                'bb' => $this->input->post('bb'),
                'status_stunting' => $this->input->post('status_stunting'),
                'tgl_pendataan' => $this->input->post('tgl_pendataan')
            ];

            $this->db->insert('tb_stunting', $stunting);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Tunggu admin untuk memverifikasi akun anda', icon:'success'})</script>");
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}