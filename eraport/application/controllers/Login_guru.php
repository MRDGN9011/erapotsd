<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_guru extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcrud');
	}

	public function index()
	{
		if ($this->session->userdata('level') == 'Guru') {
			redirect('guru');
		} else {
			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('guru/view_login', $data);
		}
	}

	function do_login()
	{
		$nip = $this->input->post('nip');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$data = $this->db->query('SELECT * FROM guru where nip= "' . $nip . '" AND tgl_lahir_guru = "' . $tgl_lahir . '" AND jabatan != "Kepala Sekolah"');
		$p = $data->row();
		$cek = $data->num_rows();
		if ($cek > 0) {
			$this->session->set_userdata(array(
				'level' => "Guru",
				'id_guru' => $p->id_guru,
				'nip' => $p->nip,
				'nama_guru' => $p->nama_guru,
				'foto_guru' => $p->foto_guru,
			));
			redirect('guru');
		} else {
			$this->session->set_flashdata('gagal', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Username/Password salah !</div></div>');
			redirect('login_guru');
		}
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login_guru', 'refresh');
	}
}
