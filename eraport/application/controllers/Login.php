<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcrud');
	}

	public function index()
	{
		if ($this->session->userdata('level') == 'Admin') {
			redirect('admin');
		} else {
			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/view_login', $data);
		}
	}

	function do_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->db->query('SELECT * FROM admin where username= "' . $username . '" AND password = "' . $password . '"');
		$p = $data->row();
		$cek = $data->num_rows();
		if ($cek > 0) {
			$this->session->set_userdata(array(
				'level' => "Admin",
				'id_admin' => $p->id_admin,
				'username' => $p->username,
				
			));
			redirect('admin');
		} else {
			$this->session->set_flashdata('gagal', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Username/Password salah !</div></div>');
			redirect('login');
		}
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
}
