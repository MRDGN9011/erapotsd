<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_siswa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcrud');
	}

	public function index()
	{
		if ($this->session->userdata('level') == 'Siswa') {
			redirect('siswa');
		} else {
			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('siswa/view_login', $data);
		}
	}

	function do_login()
	{
		$nis = $this->input->post('nis');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$data = $this->db->query('SELECT * FROM siswa where nis= "' . $nis . '" AND tgl_lahir = "' . $tgl_lahir . '"');
		$p = $data->row();
		$cek = $data->num_rows();
		if ($cek > 0) {
			$this->session->set_userdata(array(
				'level' => "Siswa",
				'id_siswa' => $p->id_siswa,
				'nis' => $p->nis,
				'nama_siswa' => $p->nama_siswa,
				'foto' => $p->foto,
			));
			redirect('siswa');
		} else {
			$this->session->set_flashdata('gagal', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Username/Password salah !</div></div>');
			redirect('login_siswa');
		}
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login_siswa', 'refresh');
	}
}
