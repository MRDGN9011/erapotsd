<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcrud');
	}

	public function index()
	{
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('user/header', $data);
		$this->load->view('user/home', $data);
		$this->load->view('user/footer', $data);
	}

	public function tentang()
	{
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('user/header', $data);
		$this->load->view('user/tentang', $data);
		$this->load->view('user/footer', $data);
	}

	public function kontak()
	{
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('user/header', $data);
		$this->load->view('user/kontak', $data);
		$this->load->view('user/footer', $data);
	}

	public function data_guru()
	{
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$data['guru'] = $this->db->query("select * from detail_mapel_guru a, mapel b, guru c where a.id_mapel = b.id_mapel and a.id_guru=c.id_guru")->result();
		$this->load->view('user/header', $data);
		$this->load->view('user/data_guru', $data);
		$this->load->view('user/footer', $data);
	}
}
