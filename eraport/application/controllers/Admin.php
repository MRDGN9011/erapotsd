<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcrud');
		if ($this->session->userdata('level') != 'Admin') {
			redirect('login');
		}
	}

	public function index()
	{
		$data['siswa'] = $this->db->query("SELECT * From siswa where status='Aktif'")->num_rows();
		$data['alumni'] = $this->db->query("SELECT * From siswa where status='Alumni'")->num_rows();
		$data['guru'] = $this->Mcrud->getguru()->num_rows();
		$data['kelas'] = $this->Mcrud->getkelas()->num_rows();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer');
	}
	public function update_profile_act()
	{

		$id = $_POST['id_profile'];
		$title_web = $_POST['title_web'];
		$keterangan = $_POST['keterangan'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];
		$email = $_POST['email'];
		$maps = $_POST['maps'];

		$data = 'title_web="' . $title_web . '", keterangan="' . $keterangan . '", telp="' . $telp . '", email="' . $email . '", alamat="' . $alamat . '", maps="' . $maps . '"';
		$this->Mcrud->update('profile_website', $data, "id_profile='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin');
	}

	public function update_gambar()
	{

		$id = $_POST['id_profile'];
		if ($_FILES['gambar']['name'] == '') {
			$gambar = $_POST['oldg'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '70%';
			// $config['width'] = 600;
			// $config['height'] = 400;
			$config['upload_path'] = './assets/image/';
			$config['file_name'] = 'gambar' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('gambar');
			$img = $this->upload->data();
			$gambar = $img['file_name'];
		}
		$data = 'gambar="' . $gambar . '"';
		$this->Mcrud->update('profile_website', $data, "id_profile='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin');
	}

	public function update_logo()
	{

		$id = $_POST['id_profile'];
		if ($_FILES['logo']['name'] == '') {
			$logo = $_POST['oldg'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '2000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '50%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['upload_path'] = './assets/image/';
			$config['file_name'] = 'logo' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('logo');
			$img = $this->upload->data();
			$logo = $img['file_name'];
		}
		$data = 'logo="' . $logo . '"';
		$this->Mcrud->update('profile_website', $data, "id_profile='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin');
	}

	public function user()
	{
		$data['user'] = $this->Mcrud->getuser();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_user', $data);
		$this->load->view('admin/footer');
	}

	public function tambahuser()
	{

		$nama_lengkap = $_POST['nama_lengkap'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		// $level = $_POST['level'];

		$data = array('nama_lengkap' => $nama_lengkap, 'username' => $username, 'password' => $password);
		$add = $this->Mcrud->tambah('user', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/user');
		} else {
		}
	}

	public function edituser($id)
	{

		$nama_lengkap = $_POST['nama_lengkap'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		// $level = $_POST['level'];

		$data = 'nama_lengkap="' . $nama_lengkap . '", username="' . $username . '", password="' . $password . '"';
		$edit = $this->Mcrud->update('admin', $data, "id_admin='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diedit !</div></div>');
		redirect('admin/user');
	}

	public function hapususer($id)
	{
		$data = "id_admin='$id'";
		$hapus = $this->Mcrud->hapus('admin', $data);

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Data Berhasil Dihapus !</div></div>');
		redirect('admin/user');
	}

	public function kelas()
	{
		$data['kelas'] = $this->Mcrud->getwkelas();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$data['guru'] = $this->Mcrud->ambil('guru');
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_kelas', $data);
		$this->load->view('admin/footer');
	}

	public function tambahkelas()
	{

		$kelas = $_POST['kelas'];
		$guru = $_POST['id_guru'];
		$data = array('kelas' => $kelas,'id_guru' => $guru);
		$add = $this->Mcrud->tambah('kelas', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/kelas');
		} else {
		}
	}

	public function editkelas($id)
	{

		
		$kelas = $_POST['kelas'];
		$guru = $_POST['id_guru'];
		$data = '"kelas="' . $kelas . '", id_guru="' . $guru . '"';
		$edit = $this->Mcrud->update('kelas', $data, "id_kelas='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diedit !</div></div>');
		redirect('admin/kelas');
	}

	public function hapuskelas($id)
	{
		$data = "id_kelas='$id'";
		$hapus = $this->Mcrud->hapus('kelas', $data);

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Data Berhasil Dihapus !</div></div>');
		redirect('admin/kelas');
	}

	public function semester()
	{
		$data['semester'] = $this->Mcrud->getsemester();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_semester', $data);
		$this->load->view('admin/footer');
	}

	public function tambahsemester()
	{

		$semester = $_POST['semester'];
		$tahun_ajaran = $_POST['tahun_ajaran'];

		$data = array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);
		$add = $this->Mcrud->tambah('semester', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/semester');
		} else {
		}
	}

	public function editsemester($id)
	{

		$semester = $_POST['semester'];
		$tahun_ajaran = $_POST['tahun_ajaran'];

		$data = 'semester="' . $semester . '", tahun_ajaran="' . $tahun_ajaran . '"';
		$edit = $this->Mcrud->update('semester', $data, "id_semester='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diedit !</div></div>');
		redirect('admin/semester');
	}

	public function hapussemester($id)
	{
		$data = "id_semester='$id'";
		$hapus = $this->Mcrud->hapus('semester', $data);

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Data Berhasil Dihapus !</div></div>');
		redirect('admin/semester');
	}

	public function mapel()
	{
		$data['mapel'] = $this->Mcrud->getmapel();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_mapel', $data);
		$this->load->view('admin/footer');
	}

	public function tambahmapel()
	{

		$mapel = $_POST['mapel'];
		$kkm = $_POST['kkm'];
		$kode_mapel = $_POST['kode_mapel'];
		$golongan = $_POST['golongan'];
		$sub_muatan = $_POST['sub_muatan'];

		$data = array('mapel' => $mapel, 'kkm' => $kkm, 'kode_mapel' => $kode_mapel, 'golongan' => $golongan, 'sub_muatan' => $sub_muatan);
		$add = $this->Mcrud->tambah('mapel', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/mapel');
		} else {
		}
	}

	public function editmapel($id)
	{

		$mapel = $_POST['mapel'];
		$kkm = $_POST['kkm'];
		$kode_mapel = $_POST['kode_mapel'];
		$golongan = $_POST['golongan'];
		$sub_muatan = $_POST['sub_muatan'];

		$data = 'mapel="' . $mapel . '", kkm="' . $kkm . '", kode_mapel="' . $kode_mapel . '", golongan="' . $golongan . '", sub_muatan="' . $sub_muatan . '"';
		$edit = $this->Mcrud->update('mapel', $data, "id_mapel='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diedit !</div></div>');
		redirect('admin/mapel');
	}

	public function hapusmapel($id)
	{
		$data = "id_mapel='$id'";
		$hapus = $this->Mcrud->hapus('mapel', $data);

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Data Berhasil Dihapus !</div></div>');
		redirect('admin/mapel');
	}


	public function jadwal()
	{
		$data['jadwal'] = $this->Mcrud->getjadwal();
		$data['mapel'] = $this->Mcrud->getmapel()->result();
		$data['kelas'] = $this->Mcrud->getkelas()->result();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_jadwal', $data);
		$this->load->view('admin/footer');
	}

	public function tambahjadwal()
	{

		$id_mapel = $_POST['id_mapel'];
		$id_kelas = $_POST['id_kelas'];
		$hari = $_POST['hari'];
		$jam_masuk = $_POST['jam_masuk'];
		$jam_selesai = $_POST['jam_selesai'];

		$data = array('id_mapel' => $id_mapel, 'id_kelas' => $id_kelas, 'hari' => $hari, 'jam_masuk' => $jam_masuk, 'jam_selesai' => $jam_selesai);
		$add = $this->Mcrud->tambah('jadwal', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/jadwal');
		} else {
		}
	}

	public function terapkanjadwal($id)
	{

		$id_jadwal = $id;
		$jadwalid = $this->Mcrud->getjadwalid($id)->row();
		$id_kelas = $jadwalid->id_kelas;
		$data = array('id_jadwal' => $id_jadwal, 'id_kelas' => $id_kelas);
		$add = $this->Mcrud->tambah('detail_jadwal_kelas', $data);
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Jadwal Berhasil Diterapkan !</div></div>');
		redirect('admin/jadwal');
	}

	public function tidakterapkanjadwal($id)
	{
		$data = "id_jadwal='$id'";
		$hapus = $this->Mcrud->hapus('detail_jadwal_kelas', $data);
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Jadwal Tidak Diterapkan !</div></div>');
		redirect('admin/jadwal');
	}

	public function editjadwal($id)
	{

		$id_mapel = $_POST['id_mapel'];
		$id_kelas = $_POST['id_kelas'];
		$hari = $_POST['hari'];
		$jam_masuk = $_POST['jam_masuk'];
		$jam_selesai = $_POST['jam_selesai'];

		$data = 'id_mapel="' . $id_mapel . '", id_kelas="' . $id_kelas . '", hari="' . $hari . '", jam_masuk="' . $jam_masuk . '", jam_selesai="' . $jam_selesai . '"';
		$edit = $this->Mcrud->update('jadwal', $data, "id_jadwal='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diedit !</div></div>');
		redirect('admin/jadwal');
	}

	public function editgurujadwal($id)
	{

		$id_detail_mapel_guru = $_POST['id_detail_mapel_guru'];

		$data = 'id_detail_mapel_guru="' . $id_detail_mapel_guru . '"';
		$edit = $this->Mcrud->update('jadwal', $data, "id_jadwal='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diedit !</div></div>');
		redirect('admin/jadwal');
	}

	public function hapusjadwal($id)
	{
		$data = "id_jadwal='$id'";
		$hapus = $this->Mcrud->hapus('jadwal', $data);

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Data Berhasil Dihapus !</div></div>');
		redirect('admin/jadwal');
	}

	public function data_guru()
	{
		$data['guru'] = $this->Mcrud->getguru()->result();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_guru', $data);
		$this->load->view('admin/footer');
	}

	public function tambahfasilitas()
	{

		$id_fasilitas_digital = $_POST['id_fasilitas_digital'];
		$nama_fasilitas = $_POST['nama_fasilitas'];
		$icon = $_POST['icon'];
		$keterangan = $_POST['keterangan'];
		$id_admin = $this->session->id_admin;

		$data = array('id_fasilitas_digital' => $id_fasilitas_digital, 'nama_fasilitas' => $nama_fasilitas, 'icon' => $icon, 'keterangan' => $keterangan, 'id_admin' => $id_admin);
		$add = $this->Mcrud->tambah('fasilitas_digital', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/data_fasilitas');
		} else {
		}
	}

	public function editfasilitas($id)
	{

		$id_fasilitas_digital = $_POST['id_fasilitas_digital'];
		$nama_fasilitas = $_POST['nama_fasilitas'];
		$icon = $_POST['icon'];
		$keterangan = $_POST['keterangan'];
		$id_admin = $this->session->id_admin;

		$data = 'id_fasilitas_digital="' . $id_fasilitas_digital . '", nama_fasilitas="' . $nama_fasilitas . '", icon="' . $icon . '", keterangan="' . $keterangan . '",  id_admin="' . $id_admin . '"';
		$edit = $this->Mcrud->update('fasilitas_digital', $data, "id_fasilitas_digital='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diedit !</div></div>');
		redirect('admin/data_fasilitas');
	}

	public function hapusfasilitas($id)
	{
		$data = "id_fasilitas_digital='$id'";
		$hapus = $this->Mcrud->hapus('fasilitas_digital', $data);

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-danger alert-message" align="center">Data Berhasil Dihapus !</div></div>');
		redirect('admin/data_fasilitas');
	}

	//Siswa

	public function siswa()
	{
		$data['siswa'] = $this->Mcrud->getsiswa()->result();
		$data['kelas'] = $this->Mcrud->getkelas()->result();
		$data['semester'] = $this->Mcrud->getsemester()->result();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_siswa', $data);
		$this->load->view('admin/footer');
	}

	public function berikankelas($id)
	{
		$id_kelas = $_POST['id_kelas'];
		$keterangan = $_POST['keterangan'];
		$id_semester = $_POST['id_semester'];
		$data = array('id_siswa' => $id, 'id_kelas' => $id_kelas, 'keterangan' => $keterangan, 'id_semester' => $id_semester);
		$add = $this->Mcrud->tambah('detail_kelas_siswa', $data);
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Pemberian Kelas Berhasil !</div></div>');
		redirect('admin/siswa');
	}

	public function berikankelasupdate($id)
	{
		$id_kelas = $_POST['id_kelas'];
		$keterangan = $_POST['keterangan'];
		$id_semester = $_POST['id_semester'];
		$data = 'id_kelas="' . $id_kelas . '", keterangan="' . $keterangan . '", id_semester="' . $id_semester . '"';
		$this->Mcrud->update('detail_kelas_siswa', $data, "id_siswa='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Pemberian Kelas Berhasil Diupdate !</div></div>');
		redirect('admin/siswa');
	}

	public function detailsiswa($id)
	{
		$row = $this->Mcrud->getsiswa_id($id)->row();
		$row2 = $this->Mcrud->getdetailkelassiswa($id)->row();
		// $row3 = $this->Mcrud->getberkas($id)->row();
		$row4 = $this->Mcrud->getberkas($id)->result();
		$row5 = $this->Mcrud->getwali($id)->num_rows();
		if ($row) {
			$data = array(
				'id_siswa' => set_value('id_siswa', $row->id_siswa),
				'nis' => set_value('nis', $row->nis),
				'nisn' => set_value('nisn', $row->nisn),
				'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
				'foto' => set_value('foto', $row->foto),
				'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
				'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
				'alamat' => set_value('alamat', $row->alamat),
				'agama' => set_value('agama', $row->agama),
				'no_telp' => set_value('no_telp', $row->no_telp),
				// 'email' => set_value('email', $row->email),
				'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
				'asal_sekolah' => set_value('asal_sekolah', $row->asal_sekolah),
				'tgl_diterima' => set_value('tgl_diterima', $row->tgl_diterima),
				'anak_ke' => set_value('anak_ke', $row->anak_ke),
				'status_anak' => set_value('status_anak', $row->status_anak),
				'status' => set_value('status', $row->status),

				'kelas' => set_value('kelas', $row2->kelas),

				// 'kk' => set_value('kk', $row3->kk),
				// 'akta_lahir' => set_value('akta_lahir', $row3->akta_lahir),
				// 'ijazah_sd' => set_value('ijazah_sd', $row3->ijazah_sd),
				// 'form_daftar' => set_value('form_daftar', $row3->form_daftar),

				'berkas' => $row4,
				'orangtua' => $row5,

			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/detail_siswa', $data);
			$this->load->view('admin/footer');
		}
	}
	public function isiberkas($id)
	{
		$data = array(
			'id_siswa' => $id
		);
		$add = $this->Mcrud->tambah('berkas_siswa', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Silakan Isi Berkas</div></div>');
			redirect('admin/detailsiswa/' . $id);
		} else {
			$this->session->set_flashdata('error', 'ulangi beberapa saat lagi');
		}
	}
	public function upload_kk($id)
	{
		if ($_FILES['kk']['name'] == '') {
			$kk = $_POST['old'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '60%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['upload_path'] = './assets/image/berkassiswa/';
			$config['file_name'] = 'kk' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('kk');
			$img = $this->upload->data();
			$kk = $img['file_name'];
		}
		$data = 'kk="' . $kk . '"';
		$this->Mcrud->update('berkas_siswa', $data, "id_siswa='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/detailsiswa/' . $id);
	}

	public function upload_akta_lahir($id)
	{
		if ($_FILES['akta_lahir']['name'] == '') {
			$akta_lahir = $_POST['old'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '60%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['upload_path'] = './assets/image/berkassiswa/';
			$config['file_name'] = 'akta_lahir' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('akta_lahir');
			$img = $this->upload->data();
			$akta_lahir = $img['file_name'];
		}
		$data = 'akta_lahir="' . $akta_lahir . '"';
		$this->Mcrud->update('berkas_siswa', $data, "id_siswa='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/detailsiswa/' . $id);
	}

	public function upload_ijazah_sd($id)
	{
		if ($_FILES['ijazah_sd']['name'] == '') {
			$ijazah_sd = $_POST['old'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '60%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['upload_path'] = './assets/image/berkassiswa/';
			$config['file_name'] = 'ijazah_sd' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('ijazah_sd');
			$img = $this->upload->data();
			$ijazah_sd = $img['file_name'];
		}
		$data = 'ijazah_sd="' . $ijazah_sd . '"';
		$this->Mcrud->update('berkas_siswa', $data, "id_siswa='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/detailsiswa/' . $id);
	}

	public function upload_form_daftar($id)
	{
		if ($_FILES['form_daftar']['name'] == '') {
			$form_daftar = $_POST['old'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '60%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['upload_path'] = './assets/image/berkassiswa/';
			$config['file_name'] = 'form_daftar' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('form_daftar');
			$img = $this->upload->data();
			$form_daftar = $img['file_name'];
		}
		$data = 'form_daftar="' . $form_daftar . '"';
		$this->Mcrud->update('berkas_siswa', $data, "id_siswa='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/detailsiswa/' . $id);
	}

	public function formtambahsiswa()
	{
		$data = array(
			'title' => 'Tambah',
			'button' => 'Simpan',
			'action' => site_url('admin/tambah_siswa_act'),
			'id_siswa' => set_value('id_siswa'),
			'nis' => set_value('nis'),
			'nisn' => set_value('nisn'),
			'nama_siswa' => set_value('nama_siswa'),
			'foto' => set_value('foto'),
			'tgl_lahir' => set_value('tgl_lahir'),
			'tempat_lahir' => set_value('tempat_lahir'),
			'alamat' => set_value('alamat'),
			'agama' => set_value('agama'),
			'no_telp' => set_value('no_telp'),
			// 'email' => set_value('email'),
			'jenis_kelamin' => set_value('jenis_kelamin'),
			'asal_sekolah' => set_value('asal_sekolah'),
			'tgl_diterima' => set_value('tgl_diterima'),
			'anak_ke' => set_value('anak_ke'),
			'status_anak' => set_value('status_anak'),
			'status' => set_value('status'),
		);

		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/form_siswa', $data);
		$this->load->view('admin/footer');
	}

	public function tambah_siswa_act()
	{
		$nis = $_POST['nis'];
		$nisn = $_POST['nisn'];
		$nama_siswa = $_POST['nama_siswa'];
		$tgl_lahir = $_POST['tgl_lahir'];
		$tempat_lahir = $_POST['tempat_lahir'];
		// $email = $_POST['email'];
		$agama = $_POST['agama'];
		$alamat = $_POST['alamat'];
		$no_telp = $_POST['no_telp'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$asal_sekolah = $_POST['asal_sekolah'];
		$tgl_diterima = $_POST['tgl_diterima'];
		$anak_ke = $_POST['anak_ke'];
		$status_anak = $_POST['status_anak'];
		$status = $_POST['status'];

		$config['allowed_types'] = 'jpg|png|jpeg|jfif';
		$config['max_size'] = '3000';
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['quality'] = '50%';
		$config['width'] = 400;
		$config['height'] = 300;
		$config['upload_path'] = './assets/image/fotosiswa';
		$config['file_name'] = 'foto' . time();
		$this->load->library('upload', $config);


		$this->upload->do_upload('foto');
		$img = $this->upload->data();
		$foto = $img['file_name'];

		$data = array(
			'nis' => $nis, 'nisn' => $nisn, 'nama_siswa' => $nama_siswa, 'tgl_lahir' => $tgl_lahir, 'tempat_lahir' => $tempat_lahir,
			'foto' => $foto, 'agama' => $agama, 'alamat' => $alamat,
			'no_telp' => $no_telp, 'jenis_kelamin' => $jenis_kelamin, 'asal_sekolah' => $asal_sekolah, 'tgl_diterima' => $tgl_diterima, 'anak_ke' => $anak_ke, 'status_anak' => $status_anak, 'status' => $status
		);
		$add = $this->Mcrud->tambah('siswa', $data);
		$siswa_id = $this->db->insert_id();
		$berkas_siswa = array(
			'id_siswa' => $siswa_id,
            // tambahkan field lain yang diperlukan dari input $_POST
		);
		$this->Mcrud->tambah('berkas_siswa', $berkas_siswa);

        // Simpan data wali
		$wali = array(
			'id_siswa' => $siswa_id,
            // tambahkan field lain yang diperlukan dari input $_POST
		);
		$this->Mcrud->tambah('wali', $wali);
		if ($add > 0) {
        // Simpan data berkas siswa


			$this->session->set_flashdata('suces', '<div class="col-md-12"><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan!</div></div>');
			redirect('admin/siswa');
		} else {
			$this->session->set_flashdata('error', 'ulangi beberapa saat lagi');
		}
	}

	public function formeditsiswa($id)
	{
		$row = $this->Mcrud->getsiswa_id($id)->row();
		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'action' => site_url('admin/update_siswa_act'),
				'id_siswa' => set_value('id_siswa', $row->id_siswa),
				'nis' => set_value('nis', $row->nis),
				'nisn' => set_value('nisn', $row->nisn),
				'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
				'foto' => set_value('foto', $row->foto),
				'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
				'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
				'alamat' => set_value('alamat', $row->alamat),
				'agama' => set_value('agama', $row->agama),
				'no_telp' => set_value('no_telp', $row->no_telp),
				// 'email' => set_value('email', $row->email),
				'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
				'asal_sekolah' => set_value('asal_sekolah', $row->asal_sekolah),
				'tgl_diterima' => set_value('tgl_diterima', $row->tgl_diterima),
				'anak_ke' => set_value('anak_ke', $row->anak_ke),
				'status_anak' => set_value('status_anak', $row->status_anak),
				'status' => set_value('status', $row->status),
			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/form_siswa', $data);
			$this->load->view('admin/footer');
		}
	}

	public function update_siswa_act()
	{
		$id_siswa = $_POST['id_siswa'];
		$nis = $_POST['nis'];
		$nisn = $_POST['nisn'];
		$nama_siswa = $_POST['nama_siswa'];
		$tgl_lahir = $_POST['tgl_lahir'];
		$tempat_lahir = $_POST['tempat_lahir'];
		// $email = $_POST['email'];
		$agama = $_POST['agama'];
		$alamat = $_POST['alamat'];
		$no_telp = $_POST['no_telp'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$asal_sekolah = $_POST['asal_sekolah'];
		$tgl_diterima = $_POST['tgl_diterima'];
		$anak_ke = $_POST['anak_ke'];
		$status_anak = $_POST['status_anak'];
		$status = $_POST['status'];

		if ($_FILES['foto']['name'] == '') {
			$foto = $_POST['old'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '50%';
			$config['width'] = 400;
			$config['height'] = 300;
			$config['upload_path'] = './assets/image/fotosiswa';
			$config['file_name'] = 'foto' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('foto');
			$img = $this->upload->data();
			$foto = $img['file_name'];
		}


		$data = 'nis="' . $nis . '", nisn="' . $nisn . '", nama_siswa="' . $nama_siswa . '", foto="' . $foto . '", tgl_lahir="' . $tgl_lahir . '", 
		tempat_lahir="' . $tempat_lahir . '", agama="' . $agama . '", alamat="' . $alamat . '", 
		no_telp="' . $no_telp . '", jenis_kelamin="' . $jenis_kelamin . '", asal_sekolah="' . $asal_sekolah . '", 
		tgl_diterima="' . $tgl_diterima . '", anak_ke="' . $anak_ke . '", status_anak="' . $status_anak . '", status="' . $status . '"';
		$this->Mcrud->update('siswa', $data, "id_siswa='$id_siswa'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/siswa');
	}
	public function hapussiswa($id)
	{
		$data = "id_siswa='$id'";
		$hapus = $this->Mcrud->hapus('siswa', $data);
		if ($hapus > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Dihapus !</div></div>');
			redirect('admin/siswa');
		} else {
			$this->session->set_flashdata('error', 'ulangi beberapa saat lagi');
		}
	}

	public function formtambahorangtua($id)
	{
		$data = array(
			'title' => 'Tambah',
			'button' => 'Simpan',
			'action' => site_url('admin/tambah_orangtua_act'),
			'id_siswa' => set_value('id_siswa', $id),
			'nik_ayah' => set_value('nik_ayah'),
			'ktp_ayah' => set_value('ktp_ayah'),
			'nama_ayah' => set_value('nama_ayah'),
			'tgl_lahir_ayah' => set_value('tgl_lahir_ayah'),
			'pekerjaan_ayah' => set_value('pekerjaan_ayah'),
			'nik_ibu' => set_value('nik_ibu'),
			'ktp_ibu' => set_value('ktp_ibu'),
			'nama_ibu' => set_value('nama_ibu'),
			'tgl_lahir_ibu' => set_value('tgl_lahir_ibu'),
			'pekerjaan_ibu' => set_value('pekerjaan_ibu'),
			'alamat_orang_tua' => set_value('alamat_orang_tua'),
			'telp_orang_tua' => set_value('telp_orang_tua'),
		);

		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/form_orangtua', $data);
		$this->load->view('admin/footer');
	}

	public function tambah_orangtua_act()
	{
		$id_siswa = $_POST['id_siswa'];
		$nik_ayah = $_POST['nik_ayah'];
		$nama_ayah = $_POST['nama_ayah'];
		$tgl_lahir_ayah = $_POST['tgl_lahir_ayah'];
		$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
		$nik_ibu = $_POST['nik_ibu'];
		$nama_ibu = $_POST['nama_ibu'];
		$tgl_lahir_ibu = $_POST['tgl_lahir_ibu'];
		$pekerjaan_ibu = $_POST['pekerjaan_ibu'];
		$alamat_orang_tua = $_POST['alamat_orang_tua'];
		$telp_orang_tua = $_POST['telp_orang_tua'];

		$data = array(
			'id_siswa' => $id_siswa, 'nik_ayah' => $nik_ayah, 'nama_ayah' => $nama_ayah, 'tgl_lahir_ayah' => $tgl_lahir_ayah, 'pekerjaan_ayah' => $pekerjaan_ayah,
			'nik_ibu' => $nik_ibu, 'nama_ibu' => $nama_ibu, 'tgl_lahir_ibu' => $tgl_lahir_ibu, 'pekerjaan_ibu' => $pekerjaan_ibu,
			'telp_orang_tua' => $telp_orang_tua, 'alamat_orang_tua' => $alamat_orang_tua
		);
		$add = $this->Mcrud->tambah('wali', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/formeditorangtua/' . $id_siswa);
		} else {
			$this->session->set_flashdata('error', 'ulangi beberapa saat lagi');
		}
	}

	public function formeditorangtua($id)
	{
		$row = $this->Mcrud->getwali($id)->row();
		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'action' => site_url('admin/update_orangtua_act'),
				'id_siswa' => set_value('id_siswa', $row->id_siswa),
				'nik_ayah' => set_value('nik_ayah', $row->nik_ayah),
				'ktp_ayah' => set_value('ktp_ayah', $row->ktp_ayah),
				'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
				'tgl_lahir_ayah' => set_value('tgl_lahir_ayah', $row->tgl_lahir_ayah),
				'pekerjaan_ayah' => set_value('pekerjaan_ayah', $row->pekerjaan_ayah),
				'nik_ibu' => set_value('nik_ibu', $row->nik_ibu),
				'ktp_ibu' => set_value('ktp_ibu', $row->ktp_ibu),
				'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
				'tgl_lahir_ibu' => set_value('tgl_lahir_ibu', $row->tgl_lahir_ibu),
				'pekerjaan_ibu' => set_value('pekerjaan_ibu', $row->pekerjaan_ibu),
				'alamat_orang_tua' => set_value('alamat_orang_tua', $row->alamat_orang_tua),
				'telp_orang_tua' => set_value('telp_orang_tua', $row->telp_orang_tua),
			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/form_orangtua', $data);
			$this->load->view('admin/footer');
		}
	}

	public function update_orangtua_act()
	{
		$id_siswa = $_POST['id_siswa'];
		$nik_ayah = $_POST['nik_ayah'];
		$nama_ayah = $_POST['nama_ayah'];
		$tgl_lahir_ayah = $_POST['tgl_lahir_ayah'];
		$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
		$nik_ibu = $_POST['nik_ibu'];
		$nama_ibu = $_POST['nama_ibu'];
		$tgl_lahir_ibu = $_POST['tgl_lahir_ibu'];
		$pekerjaan_ibu = $_POST['pekerjaan_ibu'];
		$alamat_orang_tua = $_POST['alamat_orang_tua'];
		$telp_orang_tua = $_POST['telp_orang_tua'];


		$data = 'id_siswa="' . $id_siswa . '", nik_ayah="' . $nik_ayah . '", nama_ayah="' . $nama_ayah . '", tgl_lahir_ayah="' . $tgl_lahir_ayah . '", 
		pekerjaan_ayah="' . $pekerjaan_ayah . '", nik_ibu="' . $nik_ibu . '", nama_ibu="' . $nama_ibu . '", tgl_lahir_ibu="' . $tgl_lahir_ibu . '", 
		pekerjaan_ibu="' . $pekerjaan_ibu . '", alamat_orang_tua="' . $alamat_orang_tua . '", telp_orang_tua="' . $telp_orang_tua . '"';
		$this->Mcrud->update('wali', $data, "id_siswa='$id_siswa'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/detailsiswa/' . $id_siswa);
	}

	public function upload_ktp_ayah($id)
	{
		if ($_FILES['ktp_ayah']['name'] == '') {
			$ktp_ayah = $_POST['old'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '60%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['upload_path'] = './assets/image/ktp/';
			$config['file_name'] = 'ktp_ayah' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('ktp_ayah');
			$img = $this->upload->data();
			$ktp_ayah = $img['file_name'];
		}
		$data = 'ktp_ayah="' . $ktp_ayah . '"';
		$this->Mcrud->update('wali', $data, "id_siswa='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/formeditorangtua/' . $id);
	}

	public function upload_ktp_ibu($id)
	{
		if ($_FILES['ktp_ibu']['name'] == '') {
			$ktp_ibu = $_POST['old'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '60%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['upload_path'] = './assets/image/ktp/';
			$config['file_name'] = 'ktp_ibu' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('ktp_ibu');
			$img = $this->upload->data();
			$ktp_ibu = $img['file_name'];
		}
		$data = 'ktp_ibu="' . $ktp_ibu . '"';
		$this->Mcrud->update('wali', $data, "id_siswa='$id'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/formeditorangtua/' . $id);
	}

	public function guru()
	{
		$data['guru'] = $this->Mcrud->getguru()->result();
		$data['mapel'] = $this->Mcrud->getmapel()->result();
		$data['kelas'] = $this->Mcrud->getkelas()->result();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_guru', $data);
		$this->load->view('admin/footer');
	}

	public function detailguru($id)
	{
		$row = $this->Mcrud->getguru_id($id)->row();
		$row2 = $this->Mcrud->getdetailmapelguru($id)->row();
		if ($row) {
			$data = array(
				'id_guru' => set_value('id_guru', $row->id_guru),
				'nip' => set_value('nip', $row->nip),
				'nama_guru' => set_value('nama_guru', $row->nama_guru),
				'jk_guru' => set_value('jk_guru', $row->jk_guru),
				'tgl_lahir_guru' => set_value('tgl_lahir_guru', $row->tgl_lahir_guru),
				'alamat_guru' => set_value('alamat_guru', $row->alamat_guru),
				'pend_terakhir' => set_value('pend_terakhir', $row->pend_terakhir),
				'gol' => set_value('gol', $row->gol),
				'telp_guru' => set_value('telp_guru', $row->telp_guru),
				'foto_guru' => set_value('foto_guru', $row->foto_guru),

				'mapel' => set_value('mapel', $row2->mapel),

			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/detail_guru', $data);
			$this->load->view('admin/footer');
		}
	}
	public function berikanmapel($id)
	{
		$id_mapel = $_POST['id_mapel'];
		$data = array('id_guru' => $id, 'id_mapel' => $id_mapel);
		$add = $this->Mcrud->tambah('detail_mapel_guru', $data);
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Pemberian Mapel Berhasil !</div></div>');
		redirect('admin/guru');
	}

	public function formtambahguru()
	{
		$data = array(
			'title' => 'Tambah',
			'button' => 'Simpan',
			'action' => site_url('admin/tambah_guru_act'),
			'id_guru' => set_value('id_guru'),
			'nip' => set_value('nip'),
			'nama_guru' => set_value('nama_guru'),
			'jk_guru' => set_value('jk_guru'),
			'tgl_lahir_guru' => set_value('tgl_lahir_guru'),
			'alamat_guru' => set_value('alamat_guru'),
			'pend_terakhir' => set_value('pend_terakhir'),
			'gol' => set_value('gol'),
			'telp_guru' => set_value('telp_guru'),
			'foto_guru' => set_value('foto_guru'),
			'jabatan' => set_value('jabatan'),
		);

		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/form_guru', $data);
		$this->load->view('admin/footer');
	}

	public function tambah_guru_act()
	{
		$nip = $_POST['nip'];
		$nama_guru = $_POST['nama_guru'];
		$jk_guru = $_POST['jk_guru'];
		$tgl_lahir_guru = $_POST['tgl_lahir_guru'];
		$alamat_guru = $_POST['alamat_guru'];
		$pend_terakhir = $_POST['pend_terakhir'];
		$gol = $_POST['gol'];
		$telp_guru = $_POST['telp_guru'];
		$jabatan = $_POST['jabatan'];

		$config['allowed_types'] = 'jpg|png|jpeg|jfif';
		$config['max_size'] = '3000';
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['quality'] = '50%';
		$config['width'] = 400;
		$config['height'] = 300;
		$config['upload_path'] = './assets/image/fotoguru';
		$config['file_name'] = 'foto' . time();
		$this->load->library('upload', $config);


		$this->upload->do_upload('foto_guru');
		$img = $this->upload->data();
		$foto_guru = $img['file_name'];

		$data = array('nip' => $nip, 'nama_guru' => $nama_guru, 'jk_guru' => $jk_guru, 'tgl_lahir_guru' => $tgl_lahir_guru, 'gol' => $gol, 'alamat_guru' => $alamat_guru, 'pend_terakhir' => $pend_terakhir, 'telp_guru' => $telp_guru, 'foto_guru' => $foto_guru,'jabatan' => $jabatan);
		$add = $this->Mcrud->tambah('guru', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/guru');
		} else {
			$this->session->set_flashdata('error', 'ulangi beberapa saat lagi');
		}
	}

	public function formeditguru($id)
	{
		$row = $this->Mcrud->getguru_id($id)->row();
		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'action' => site_url('admin/update_guru_act'),
				'id_guru' => set_value('id_guru', $row->id_guru),
				'nip' => set_value('nip', $row->nip),
				'nama_guru' => set_value('nama_guru', $row->nama_guru),
				'jk_guru' => set_value('jk_guru', $row->jk_guru),
				'tgl_lahir_guru' => set_value('tgl_lahir_guru', $row->tgl_lahir_guru),
				'alamat_guru' => set_value('alamat_guru', $row->alamat_guru),
				'pend_terakhir' => set_value('pend_terakhir', $row->pend_terakhir),
				'gol' => set_value('gol', $row->gol),
				'telp_guru' => set_value('telp_guru', $row->telp_guru),
				'foto_guru' => set_value('foto_guru', $row->foto_guru),
				'jabatan' => set_value('jabatan', $row->jabatan),

			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/form_guru', $data);
			$this->load->view('admin/footer');
		}
	}

	public function update_guru_act()
	{
		$id_guru = $_POST['id_guru'];
		$nip = $_POST['nip'];
		$nama_guru = $_POST['nama_guru'];
		$jk_guru = $_POST['jk_guru'];
		$tgl_lahir_guru = $_POST['tgl_lahir_guru'];
		$alamat_guru = $_POST['alamat_guru'];
		$pend_terakhir = $_POST['pend_terakhir'];
		$gol = $_POST['gol'];
		$telp_guru = $_POST['telp_guru'];
		$jabatan = $_POST['jabatan'];

		if ($_FILES['foto_guru']['name'] == '') {
			$foto_guru = $_POST['old'];
		} else {
			$config['allowed_types'] = 'jpg|png|jpeg|jfif';
			$config['max_size'] = '3000';
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '50%';
			$config['width'] = 400;
			$config['height'] = 300;
			$config['upload_path'] = './assets/image/fotoguru';
			$config['file_name'] = 'foto' . time();
			$this->load->library('upload', $config);


			$this->upload->do_upload('foto_guru');
			$img = $this->upload->data();
			$foto_guru = $img['file_name'];
		}


		$data = 'nip="' . $nip . '",nama_guru="' . $nama_guru . '", jk_guru="' . $jk_guru . '", tgl_lahir_guru="' . $tgl_lahir_guru . '", alamat_guru="' . $alamat_guru . '", pend_terakhir="' . $pend_terakhir . '", telp_guru="' . $telp_guru . '", gol="' . $gol . '", foto_guru="' . $foto_guru . '",jabatan="' . $jabatan . '"';
		$this->Mcrud->update('guru', $data, "id_guru='$id_guru'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/guru');
	}

	public function hapusguru($id)
	{
		$data = "id_guru='$id'";
		$hapus = $this->Mcrud->hapus('guru', $data);
		if ($hapus > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Dihapus !</div></div>');
			redirect('admin/guru');
		} else {
			$this->session->set_flashdata('error', 'ulangi beberapa saat lagi');
		}
	}

	public function datasemestersiswa()
	{
		$data['semester'] = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d WHERE a.id_siswa = b.id_siswa AND a.id_kelas = c.id_kelas AND a.id_semester = d.id_semester AND a.id_detail_kelas_siswa IN (SELECT MIN(id_detail_kelas_siswa) FROM detail_kelas_siswa GROUP BY id_semester)")->result();
		$data['kelas'] = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester AND a.id_detail_kelas_siswa IN (SELECT MIN(id_detail_kelas_siswa) FROM detail_kelas_siswa GROUP BY id_kelas) ORDER BY c.kelas ASC")->result();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_semester_siswa', $data);
		$this->load->view('admin/footer');
	}

	public function siswakelas($id)
	{
		$data['siswa'] = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester and a.id_kelas = '$id'")->result();
		$data['kelas'] = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester and a.id_kelas = '$id' group by a.id_detail_kelas_siswa,a.id_kelas")->row();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_siswakelas', $data);
		$this->load->view('admin/footer');
	}

	public function formtambahnilai($id, $idkelas, $idsemester)
	{
		$row = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester and a.id_siswa='$id' and a.id_kelas='$idkelas' and a.id_semester='$idsemester'")->row();
		$whereClause = 'WHERE a.id_kelas="' . $idkelas . '"';
		$query = 'SELECT * FROM jadwal a
		LEFT JOIN detail_mapel_guru d ON a.id_detail_mapel_guru = d.id_detail_mapel_guru
		LEFT JOIN mapel b ON a.id_mapel = b.id_mapel
		LEFT JOIN kelas c ON a.id_kelas = c.id_kelas
		LEFT JOIN guru e ON d.id_guru = e.id_guru ' . $whereClause . '
		ORDER BY a.id_jadwal ASC';
		$row2 = $this->db->query($query)->result();
		$data = array(
			'title' => 'Tambah',
			'button' => 'Simpan',
			'id_detail_nilai' => set_value('id_detail_nilai'),
			'id_kelas' => set_value('id_kelas', $row->id_kelas),
			'id_semester' => set_value('id_semester', $row->id_semester),
			'id_guru' => set_value('id_guru'),
			'id_mapel' => set_value('id_mapel'),
			'nilai_tugas' => set_value('nilai_tugas'),
			'nilai_uts' => set_value('nilai_uts'),
			'nilai_uas' => set_value('nilai_uas'),
			'total_nilai' => set_value('total_nilai'),
			'deskripsi_nilai' => set_value('deskripsi_nilai'),
			'absen_sakit' => set_value('absen_sakit'),
			'absen_izin' => set_value('absen_izin'),
			'absen_alfa' => set_value('absen_alfa'),
			'nilai_keterampilan' => set_value('nilai_keterampilan'),
			'deskripsi_nilai_keterampilan' => set_value('deskripsi_nilai_keterampilan'),
			'id_siswa' => set_value('id_siswa', $id),

			'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
			'kelas' => set_value('kelas', $row->kelas),
			'semester' => set_value('semester', $row->semester),
			'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),

			'mapel' => $row2,
		);

		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/form_nilai', $data);
		$this->load->view('admin/footer');
	}

	public function formtambahsikap($id, $idkelas, $idsemester)
	{
		$row = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester and a.id_siswa='$id' and a.id_kelas='$idkelas' and a.id_semester='$idsemester'")->row();
		$data = array(
			

			'title' => 'Tambah',
			'button' => 'Simpan',
			'action' => site_url('admin/tambah_sikap_act'),
			'integritas' => set_value('integritas'),
			'religius' => set_value('religius'),
			'nasionalis' => set_value('nasionalis'),
			'mandiri' => set_value('mandiri'),
			'gotongroyong' => set_value('gotongroyong'),
			'id_kelas' => set_value('id_kelas', $row->id_kelas),
			'id_semester' => set_value('id_semester', $row->id_semester),
			'id_siswa' => set_value('id_siswa', $id),
			'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
			'kelas' => set_value('kelas', $row->kelas),
			'semester' => set_value('semester', $row->semester),
			'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
		);
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/form_sikap', $data);
		$this->load->view('admin/footer');
	}

	public function tambah_nilai_act()
	{
		// $row = $this->Mcrud->getdetailmapel()->result();
		// foreach ($row as $r) {
		// echo $idma = $r->id_mapel;

		$id_siswa = $_POST['id_siswa'];

		$id_kelas = $_POST['id_kelas'];
		$id_mapel = $_POST['id_mapel'];
		$id_guru = $_POST['id_guru'];
		$id_semester = $_POST['id_semester'];
		$nilai_tugas = $_POST['nilai_tugas'];
		$nilai_uts = $_POST['nilai_uts'];
		$nilai_uas = $_POST['nilai_uas'];
		//perhitungan total nilai
		$persen_tugas = $nilai_tugas * 0.3;
		$persen_uts = $nilai_uts * 0.3;
		$persen_uas = $nilai_uas * 0.4;

		$total_nilai = $persen_tugas + $persen_uts + $persen_uas;
		$deskripsi_nilai = $_POST['deskripsi_nilai'];

		$absen_sakit = $_POST['absen_sakit'];
		$absen_izin = $_POST['absen_izin'];
		$absen_alfa = $_POST['absen_alfa'];
		$nilai_keterampilan = $_POST['nilai_keterampilan'];
		$deskripsi_nilai_keterampilan = $_POST['deskripsi_nilai_keterampilan'];
		$tgl_buat = date('Y-m-d');

		$data = array(
			'id_siswa' => $id_siswa, 'id_kelas' => $id_kelas, 'id_mapel' => $id_mapel, 'id_guru' => $id_guru, 'id_semester' => $id_semester, 'nilai_uas' => $nilai_uas, 'nilai_tugas' => $nilai_tugas, 'nilai_uts' => $nilai_uts,
			'total_nilai' => $total_nilai, 'deskripsi_nilai' => $deskripsi_nilai, 'absen_sakit' => $absen_sakit, 'absen_izin' => $absen_izin, 'absen_alfa' => $absen_alfa, 'nilai_keterampilan' => $nilai_keterampilan, 'deskripsi_nilai_keterampilan' => $deskripsi_nilai_keterampilan, 'tgl_buat' => $tgl_buat
		);
		$add = $this->Mcrud->tambah('detail_nilai', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/formeditnilai/' . $id_siswa . '/' . $id_kelas . '/' . $id_semester);
		} else {
			$this->session->set_flashdata('error', 'ulangi beberapa saat lagi');
		}
		// }
	}

	public function tambah_sikap_act()
	{
		// $row = $this->Mcrud->getdetailmapel()->result();
		// foreach ($row as $r) {
		// echo $idma = $r->id_mapel;

		$id_siswa = $_POST['id_siswa'];
		$id_kelas = $_POST['id_kelas'];
		$id_semester = $_POST['id_semester'];
		$integritas = $_POST['integritas'];
		$religius = $_POST['religius'];
		$nasionalis = $_POST['nasionalis'];
		$mandiri = $_POST['mandiri'];
		$gotongroyong = $_POST['gotongroyong'];

		$data = array(
			'id_siswa' => $id_siswa, 'id_kelas' => $id_kelas, 'id_semester' => $id_semester, 'integritas' => $integritas, 'religius' => $religius, 'nasionalis' => $nasionalis, 'mandiri' => $mandiri, 'gotongroyong' => $gotongroyong, 
		);
		$add = $this->Mcrud->tambah('nilai_sikap', $data);
		if ($add > 0) {
			$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Disimpan !</div></div>');
			redirect('admin/formeditsikap/' . $id_siswa . '/' . $id_kelas . '/' . $id_semester);
		} else {
			$this->session->set_flashdata('error', 'ulangi beberapa saat lagi');
		}
		// }
	}

	public function formeditnilai($id, $idkelas, $idsemester)
	{

		$whereClause = 'WHERE a.id_kelas="' . $idkelas . '"';
		$query = 'SELECT * FROM jadwal a
		LEFT JOIN detail_mapel_guru d ON a.id_detail_mapel_guru = d.id_detail_mapel_guru
		LEFT JOIN mapel b ON a.id_mapel = b.id_mapel
		LEFT JOIN kelas c ON a.id_kelas = c.id_kelas
		LEFT JOIN guru e ON d.id_guru = e.id_guru ' . $whereClause . '
		ORDER BY a.id_jadwal ASC';
		$row2 = $this->db->query($query)->result();
		$row = $this->Mcrud->getnilai($id, $idkelas, $idsemester)->row();

		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'id_detail_nilai' => set_value('id_detail_nilai', $row->id_detail_nilai),
				'id_kelas' => set_value('id_kelas', $row->id_kelas),
				'id_semester' => set_value('id_semester', $row->id_semester),
				'id_guru' => set_value('id_guru', $row->id_guru),
				'id_mapel' => set_value('id_mapel', $row->id_mapel),

				'nilai_tugas' => set_value('nilai_tugas', $row->nilai_tugas),
				'nilai_uts' => set_value('nilai_uts', $row->nilai_uts),
				'nilai_uas' => set_value('nilai_uas', $row->nilai_uas),
				'total_nilai' => set_value('total_nilai', $row->total_nilai),
				'deskripsi_nilai' => set_value('deskripsi_nilai', $row->deskripsi_nilai),
				'absen_sakit' => set_value('absen_sakit', $row->absen_sakit),
				'absen_izin' => set_value('absen_izin', $row->absen_izin),
				'absen_alfa' => set_value('absen_alfa', $row->absen_alfa),
				'nilai_keterampilan' => set_value('nilai_keterampilan', $row->nilai_keterampilan),
				'deskripsi_nilai_keterampilan' => set_value('deskripsi_nilai_keterampilan', $row->deskripsi_nilai_keterampilan),

				'id_siswa' => set_value('id_siswa', $id),

				'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
				'kelas' => set_value('kelas', $row->kelas),
				'semester' => set_value('semester', $row->semester),
				'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),

				'mapel' => $row2,

			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/form_nilai', $data);
			$this->load->view('admin/footer');
		}
	}

	public function formeditsikap($id, $idkelas, $idsemester)
	{
		$row = $this->Mcrud->getsikap($id, $idkelas, $idsemester)->row();

		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'action' => site_url('admin/update_sikap_act'),
				'id_nilai_sikap' => set_value('id_nilai_sikap', $row->id_nilai_sikap),
				'id_kelas' => set_value('id_kelas', $row->id_kelas),
				'id_semester' => set_value('id_semester', $row->id_semester),
				'id_siswa' => set_value('id_siswa', $row->id_siswa),

				'integritas' => set_value('integritas', $row->integritas),
				'religius' => set_value('religius', $row->religius),
				'nasionalis' => set_value('nasionalis', $row->nasionalis),
				'mandiri' => set_value('mandiri', $row->mandiri),
				'gotongroyong' => set_value('gotongroyong', $row->gotongroyong),

				'id_siswa' => set_value('id_siswa', $id),
				'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
				'kelas' => set_value('kelas', $row->kelas),
				'semester' => set_value('semester', $row->semester),
				'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/form_sikap', $data);
			$this->load->view('admin/footer');
		}
	}

	public function update_nilai_act()
	{
		$id_detail_nilai = $_POST['id_detail_nilai'];
		$id_siswa = $_POST['id_siswa'];
		$id_kelas = $_POST['id_kelas'];
		$id_semester = $_POST['id_semester'];
		$nilai_tugas = $_POST['nilai_tugas'];
		$nilai_uts = $_POST['nilai_uts'];
		$nilai_uas = $_POST['nilai_uas'];
		//perhitungan total nilai
		$persen_tugas = $nilai_tugas * 0.3;
		$persen_uts = $nilai_uts * 0.3;
		$persen_uas = $nilai_uas * 0.4;

		$total_nilai = $persen_tugas + $persen_uts + $persen_uas;
		$deskripsi_nilai = $_POST['deskripsi_nilai'];

		$absen_sakit = $_POST['absen_sakit'];
		$absen_izin = $_POST['absen_izin'];
		$absen_alfa = $_POST['absen_alfa'];
		$nilai_keterampilan = $_POST['nilai_keterampilan'];
		$deskripsi_nilai_keterampilan = $_POST['deskripsi_nilai_keterampilan'];

		$data = 'nilai_tugas="' . $nilai_tugas . '", nilai_uts="' . $nilai_uts . '", nilai_uas="' . $nilai_uas . '", total_nilai="' . $total_nilai . '", deskripsi_nilai="' . $deskripsi_nilai . '",
		absen_sakit="' . $absen_sakit . '", absen_izin="' . $absen_izin . '", absen_alfa="' . $absen_alfa . '", nilai_keterampilan="' . $nilai_keterampilan . '", deskripsi_nilai_keterampilan="' . $deskripsi_nilai_keterampilan . '"';
		$this->Mcrud->update('detail_nilai', $data, "id_detail_nilai='$id_detail_nilai'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/formeditnilai/' . $id_siswa . '/' . $id_kelas . '/' . $id_semester);
	}
	public function update_sikap_act()
	{
		$id_nilai_sikap = $_POST['id_nilai_sikap'];
		$id_siswa = $_POST['id_siswa'];
		$id_kelas = $_POST['id_kelas'];
		$id_semester = $_POST['id_semester'];
		//perhitungan total nilai
		$integritas = $_POST['integritas'];
		$religius = $_POST['religius'];
		$nasionalis = $_POST['nasionalis'];
		$mandiri = $_POST['mandiri'];
		$gotongroyong = $_POST['gotongroyong'];

		$data = 'integritas="' . $integritas . '", religius="' . $religius . '", nasionalis="' . $nasionalis . '", mandiri="' . $mandiri . '", gotongroyong="' . $gotongroyong . '"';
		$this->Mcrud->update('nilai_sikap', $data, "id_nilai_sikap='$id_nilai_sikap'");

		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Data Berhasil Diupdate !</div></div>');
		redirect('admin/formeditsikap/' . $id_siswa . '/' . $id_kelas . '/' . $id_semester);
	}


	public function konfirmasi_nilai($id)
	{
		// $dataid['id_detail_nilai'] = $id;
		$id_kelas = $_POST['id_kelas'];
		$id_semester = $_POST['id_semester'];
		$pramuka = $_POST['pramuka'];
		$total_keseluruhan_nilai = $_POST['total_keseluruhan_nilai'];
		$nilai_rata_rata = $_POST['nilai_rata_rata'];
		$total_keseluruhan_nilai_keterampilan = $_POST['total_keseluruhan_nilai_keterampilan'];
		$nilai_keterampilan_rata_rata = $_POST['nilai_keterampilan_rata_rata'];
		$nilai_gabungan = $_POST['nilai_gabungan'];
		$rata_rata_gabungan = $_POST['rata_rata_gabungan'];
		$ekskul = $_POST['ekskul'];
		$nilai_ekskul = $_POST['nilai_ekskul'];

		$data = array(
			'id_siswa' => $id, 'id_kelas' => $id_kelas, 'id_semester' => $id_semester, 'pramuka' => $pramuka, 'total_keseluruhan_nilai' => $total_keseluruhan_nilai, 'nilai_rata_rata' => $nilai_rata_rata, 'total_keseluruhan_nilai_keterampilan' => $total_keseluruhan_nilai_keterampilan, 'nilai_keterampilan_rata_rata' => $nilai_keterampilan_rata_rata,
			'ekskul' => $ekskul, 'nilai_ekskul' => $nilai_ekskul, 'nilai_gabungan' => $nilai_gabungan, 'rata_rata_gabungan' => $rata_rata_gabungan
		);
		$add = $this->Mcrud->tambah('nilai', $data);
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Nilai Sudah Dikonfirmasi !</div></div>');
		redirect('admin/datanilairaport/' . $id_kelas . '/' . $id_semester);
	}

	public function update_nilai($id)
	{
		$id_kelas = $_POST['id_kelas'];
		$id_semester = $_POST['id_semester'];
		$pramuka = $_POST['pramuka'];
		$total_keseluruhan_nilai = $_POST['total_keseluruhan_nilai'];
		$nilai_rata_rata = $_POST['nilai_rata_rata'];
		$total_keseluruhan_nilai_keterampilan = $_POST['total_keseluruhan_nilai_keterampilan'];
		$nilai_keterampilan_rata_rata = $_POST['nilai_keterampilan_rata_rata'];
		$nilai_gabungan = $_POST['nilai_gabungan'];
		$rata_rata_gabungan = $_POST['rata_rata_gabungan'];
		$ekskul = $_POST['ekskul'];
		$nilai_ekskul = $_POST['nilai_ekskul'];

		$data = 'id_kelas="' . $id_kelas . '", id_semester="' . $id_semester . '", pramuka="' . $pramuka . '", total_keseluruhan_nilai="' . $total_keseluruhan_nilai . '", nilai_rata_rata="' . $nilai_rata_rata . '", total_keseluruhan_nilai_keterampilan="' . $total_keseluruhan_nilai_keterampilan . '", nilai_keterampilan_rata_rata="' . $nilai_keterampilan_rata_rata . '",
		ekskul="' . $ekskul . '", nilai_ekskul="' . $nilai_ekskul . '", nilai_gabungan="' . $nilai_gabungan . '", rata_rata_gabungan="' . $rata_rata_gabungan . '"';
		$this->Mcrud->update('nilai', $data, "id_nilai='$id'");
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Nilai Sudah Diupdate !</div></div>');
		redirect('admin/datanilairaport/' . $id_kelas . '/' . $id_semester);
	}

	public function datanilai($idkelas = null, $idsemester = null)
	{
		$data['kelasnya'] = $this->Mcrud->getkelas()->result();
		$data['semesternya'] = $this->Mcrud->getsemester()->result();
		$idkelas = $this->input->get('idkelas', true);
		
		$data['idkelas'] = $this->input->get('idkelas', true);
		$data['idsemester'] = $this->input->get('idsemester', true);


		if ($data['idkelas'] != '' && $data['idsemester'] != '') {
			$kelasid = $this->db->query("Select * from kelas where id_kelas=" . $data['idkelas'])->row();
			$semesterid = $this->db->query("Select * from semester where id_semester=" . $data['idsemester'])->row();
			$whereClause = 'WHERE a.id_kelas="' . $idkelas . '"';
			$query = 'SELECT * FROM jadwal a
			LEFT JOIN detail_mapel_guru d ON a.id_detail_mapel_guru = d.id_detail_mapel_guru
			LEFT JOIN mapel b ON a.id_mapel = b.id_mapel
			LEFT JOIN kelas c ON a.id_kelas = c.id_kelas
			LEFT JOIN guru e ON d.id_guru = e.id_guru ' . $whereClause . '
			ORDER BY a.id_mapel ASC';
			$data['mapelnya'] = $this->db->query($query);
			$data['namakelas'] = $kelasid->kelas;
			$data['namasemester'] = $semesterid->semester;
			$data['tahunajaran'] = $semesterid->tahun_ajaran;
			$data['mapel'] = $this->db->query("SELECT * FROM mapel WHERE id_mapel IN (SELECT id_mapel FROM detail_nilai)");
			$data['nilai'] = $this->db->query("SELECT * FROM nilai a, detail_nilai b, mapel c, kelas d, semester e, siswa f 
				WHERE b.id_mapel=c.id_mapel AND b.id_kelas=d.id_kelas AND b.id_semester=e.id_semester 
				AND b.id_siswa=f.id_siswa AND a.id_siswa=b.id_siswa 
				AND a.id_kelas='" . $data['idkelas'] . "' AND a.id_semester='" . $data['idsemester'] . "' 
				AND b.id_detail_nilai IN (SELECT MIN(id_detail_nilai) FROM detail_nilai GROUP BY id_siswa)ORDER BY a.rangking")
			->result();
		} else {
			$data['notif'] = "tidak ada data !";
		}
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_nilai', $data);
		$this->load->view('admin/footer');
	}

	public function exceldatanilai($idkelas, $idsemester)
	{
		$data['title'] = 'Datanilai/kls' . $idkelas . '/smt' . $idsemester;
		$data['mapelnya'] = $this->Mcrud->getdetailmapel();

		$data['idkelas'] = $idkelas;
		$data['idsemester'] = $idsemester;

		if ($data['idkelas'] != '' && $data['idsemester'] != '') {
			$kelasid = $this->db->query("Select * from kelas where id_kelas=" . $data['idkelas'])->row();
			$semesterid = $this->db->query("Select * from semester where id_semester=" . $data['idsemester'])->row();
			$data['namakelas'] = $kelasid->kelas;
			$data['namasemester'] = $semesterid->semester;
			$data['tahunajaran'] = $semesterid->tahun_ajaran;
			$data['mapel'] = $this->db->query("SELECT * FROM mapel WHERE id_mapel IN (SELECT id_mapel FROM detail_nilai)");
			$data['nilai'] = $this->db->query("SELECT * FROM nilai a, detail_nilai b, mapel c, kelas d, semester e, siswa f 
				WHERE b.id_mapel=c.id_mapel AND b.id_kelas=d.id_kelas AND b.id_semester=e.id_semester 
				AND b.id_siswa=f.id_siswa AND a.id_siswa=b.id_siswa 
				AND a.id_kelas='" . $data['idkelas'] . "' AND a.id_semester='" . $data['idsemester'] . "' 
				AND b.id_detail_nilai IN (SELECT MIN(id_detail_nilai) FROM detail_nilai GROUP BY id_siswa)ORDER BY a.rangking")
			->result();
			$data['kepsek'] = $this->db->query("SELECT * FROM guru WHERE jabatan='Kepala Sekolah'")->result_array();
			$data['walikelas'] = $this->db->query("SELECT * FROM kelas a INNER JOIN guru b ON a.id_guru=b.id_guru WHERE a.id_kelas='$idkelas'")->result_array();
		} else {
			$data['notif'] = "tidak ada data !";
		}
		$this->load->view('admin/cetak_data_nilai', $data);
	}

	public function datanilairaport($idkelas, $idsemester)
	{
		$data['mapelnya'] = $this->Mcrud->getdetailmapel();
		$data['mapel'] = $this->db->query("SELECT * FROM mapel WHERE id_mapel IN (SELECT id_mapel FROM detail_nilai)");
		$data['nilai'] = $this->db->query("SELECT * FROM nilai a, detail_nilai b, mapel c, kelas d, semester e, siswa f where b.id_mapel=c.id_mapel and b.id_kelas=d.id_kelas and b.id_semester=e.id_semester and b.id_siswa=f.id_siswa and a.id_siswa=b.id_siswa and a.id_kelas='$idkelas' and a.id_semester='$idsemester' AND b.id_detail_nilai IN (SELECT MIN(id_detail_nilai) FROM detail_nilai GROUP BY id_siswa)ORDER BY a.rangking")->result();
		$data['kelas'] = $this->db->query("SELECT * FROM nilai a, kelas b, semester c where a.id_kelas=b.id_kelas and a.id_semester=c.id_semester and  a.id_kelas='$idkelas' and a.id_semester='$idsemester' group by  a.id_nilai,b.id_kelas")->result();
		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/data_nilai_raport', $data);
		$this->load->view('admin/footer');
	}

	public function konfirmasi_rangking($idkelas, $idsemester)
	{
		$id_kelas = $idkelas;
		$id_semester = $idsemester;
		$no = 1;
		$nilai = $this->db->query("SELECT * FROM nilai a, detail_nilai b, mapel c, kelas d, semester e, siswa f where b.id_mapel=c.id_mapel and b.id_kelas=d.id_kelas and b.id_semester=e.id_semester and b.id_siswa=f.id_siswa and a.id_siswa=b.id_siswa and a.id_kelas='$idkelas' and a.id_semester='$idsemester' AND b.id_detail_nilai IN (SELECT MIN(id_detail_nilai) FROM detail_nilai GROUP BY id_siswa)")->result();
		foreach ($nilai as $n) {
			$rangking = $_POST['rangking' . $no++];
			$ids = $n->id_siswa;
			$idk = $n->id_kelas;
			$idse = $n->id_semester;
			$data = 'rangking="' . $rangking . '"';
			$this->Mcrud->update('nilai', $data, "id_siswa='$ids' and id_kelas='$idk' and id_semester='$idse'");
		}
		$this->session->set_flashdata('suces', '<div class="col-md-12" ><div class="alert alert-success alert-message" align="center">Nilai Sudah Diupdate !</div></div>');
		redirect('admin/datanilairaport/' . $id_kelas . '/' . $id_semester);
	}

	public function nilaisikap()
	{

	}

	public function detailraport($id, $idkelas, $idsemester)
	{

		$row = $this->Mcrud->getnilai($id, $idkelas, $idsemester)->row();
		$whereClause = 'WHERE a.id_kelas="' . $idkelas . '"';
		$query = 'SELECT * FROM jadwal a
		LEFT JOIN detail_mapel_guru d ON a.id_detail_mapel_guru = d.id_detail_mapel_guru
		LEFT JOIN mapel b ON a.id_mapel = b.id_mapel
		LEFT JOIN kelas c ON a.id_kelas = c.id_kelas
		LEFT JOIN guru e ON d.id_guru = e.id_guru ' . $whereClause . '
		ORDER BY a.id_jadwal ASC';
		$row2 = $this->db->query($query)->result();
		if ($row) {

			usort($row2, function ($a, $b) {
    // Menentukan urutan golongan
				$orderGolongan = ['Muatan Nasional', 'Muatan Kewilayahan', 'Muatan Peminatan Kejuruan'];

    // Menentukan urutan sub_muatan
				$orderSubMuatan = ['Dasar Bidang Keahlian', 'Dasar Program Keahlian'];

				$aGolonganIndex = array_search($a->golongan, $orderGolongan);
				$bGolonganIndex = array_search($b->golongan, $orderGolongan);

    // Jika golongan berbeda, urutkan berdasarkan golongan
				if ($aGolonganIndex !== $bGolonganIndex) {
					return $aGolonganIndex <=> $bGolonganIndex;
				}

    // Jika golongan sama, urutkan berdasarkan sub_muatan
				$aSubMuatanIndex = array_search($a->sub_muatan, $orderSubMuatan);
				$bSubMuatanIndex = array_search($b->sub_muatan, $orderSubMuatan);

				return $aSubMuatanIndex <=> $bSubMuatanIndex;
			});
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'id_detail_nilai' => set_value('id_detail_nilai', $row->id_detail_nilai),
				'id_kelas' => set_value('id_kelas', $row->id_kelas),
				'id_semester' => set_value('id_semester', $row->id_semester),
				'id_guru' => set_value('id_guru', $row->id_guru),
				'id_mapel' => set_value('id_mapel', $row->id_mapel),

				'nilai_tugas' => set_value('nilai_tugas', $row->nilai_tugas),
				'nilai_uts' => set_value('nilai_uts', $row->nilai_uts),
				'nilai_uas' => set_value('nilai_uas', $row->nilai_uas),
				'total_nilai' => set_value('total_nilai', $row->total_nilai),
				'deskripsi_nilai' => set_value('deskripsi_nilai', $row->deskripsi_nilai),
				'absen_sakit' => set_value('absen_sakit', $row->absen_sakit),
				'absen_izin' => set_value('absen_izin', $row->absen_izin),
				'absen_alfa' => set_value('absen_alfa', $row->absen_alfa),
				'nilai_keterampilan' => set_value('nilai_keterampilan', $row->nilai_keterampilan),
				'deskripsi_nilai_keterampilan' => set_value('deskripsi_nilai_keterampilan', $row->deskripsi_nilai_keterampilan),

				'id_siswa' => set_value('id_siswa', $id),

				'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
				'nis' => set_value('nis', $row->nis),
				'nisn' => set_value('nisn', $row->nisn),
				'kelas' => set_value('kelas', $row->kelas),
				'semester' => set_value('semester', $row->semester),
				'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),

				'mapel' => $row2,

			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/raport', $data);
			$this->load->view('admin/footer');
		}
	}

	public function cetakraport($id, $idkelas, $idsemester)
	{

		$row = $this->Mcrud->getnilai($id, $idkelas, $idsemester)->row();
		$whereClause = 'WHERE a.id_kelas="' . $idkelas . '"';
		$query = 'SELECT * FROM jadwal a
		LEFT JOIN detail_mapel_guru d ON a.id_detail_mapel_guru = d.id_detail_mapel_guru
		LEFT JOIN mapel b ON a.id_mapel = b.id_mapel
		LEFT JOIN kelas c ON a.id_kelas = c.id_kelas
		LEFT JOIN guru e ON d.id_guru = e.id_guru ' . $whereClause . '
		ORDER BY a.id_jadwal ASC';
		$row2 = $this->db->query($query)->result();
		usort($row2, function ($a, $b) {
    // Menentukan urutan golongan
			$orderGolongan = ['Muatan Nasional', 'Muatan Kewilayahan', 'Muatan Peminatan Kejuruan'];

    // Menentukan urutan sub_muatan
			$orderSubMuatan = ['Dasar Bidang Keahlian', 'Dasar Program Keahlian'];

			$aGolonganIndex = array_search($a->golongan, $orderGolongan);
			$bGolonganIndex = array_search($b->golongan, $orderGolongan);

    // Jika golongan berbeda, urutkan berdasarkan golongan
			if ($aGolonganIndex !== $bGolonganIndex) {
				return $aGolonganIndex <=> $bGolonganIndex;
			}

    // Jika golongan sama, urutkan berdasarkan sub_muatan
			$aSubMuatanIndex = array_search($a->sub_muatan, $orderSubMuatan);
			$bSubMuatanIndex = array_search($b->sub_muatan, $orderSubMuatan);

			return $aSubMuatanIndex <=> $bSubMuatanIndex;
		});
		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'id_detail_nilai' => set_value('id_detail_nilai', $row->id_detail_nilai),
				'id_kelas' => set_value('id_kelas', $row->id_kelas),
				'id_semester' => set_value('id_semester', $row->id_semester),
				'id_guru' => set_value('id_guru', $row->id_guru),
				'id_mapel' => set_value('id_mapel', $row->id_mapel),

				'nilai_tugas' => set_value('nilai_tugas', $row->nilai_tugas),
				'nilai_uts' => set_value('nilai_uts', $row->nilai_uts),
				'nilai_uas' => set_value('nilai_uas', $row->nilai_uas),
				'total_nilai' => set_value('total_nilai', $row->total_nilai),
				'deskripsi_nilai' => set_value('deskripsi_nilai', $row->deskripsi_nilai),
				'absen_sakit' => set_value('absen_sakit', $row->absen_sakit),
				'absen_izin' => set_value('absen_izin', $row->absen_izin),
				'absen_alfa' => set_value('absen_alfa', $row->absen_alfa),
				'nilai_keterampilan' => set_value('nilai_keterampilan', $row->nilai_keterampilan),
				'deskripsi_nilai_keterampilan' => set_value('deskripsi_nilai_keterampilan', $row->deskripsi_nilai_keterampilan),

				'id_siswa' => set_value('id_siswa', $id),

				'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
				'nis' => set_value('nis', $row->nis),
				'nisn' => set_value('nisn', $row->nisn),
				'kelas' => set_value('kelas', $row->kelas),
				'semester' => set_value('semester', $row->semester),
				'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
				'mapel' => $row2,

			);
			$data['kepsek'] = $this->db->query("SELECT * FROM guru WHERE jabatan='Kepala Sekolah'")->result_array();
			$data['walikelas'] = $this->db->query("SELECT * FROM kelas a INNER JOIN guru b ON a.id_guru=b.id_guru WHERE a.id_kelas='$idkelas'")->result_array();
			$this->load->view('admin/cetak_raport', $data);
		}
	}

	public function detailraportsikap($id, $idkelas, $idsemester)
	{
		$row = $this->Mcrud->getsikap($id, $idkelas, $idsemester)->row();

		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'id_nilai_sikap' => set_value('id_nilai_sikap', $row->id_nilai_sikap),
				'id_kelas' => set_value('id_kelas', $row->id_kelas),
				'id_semester' => set_value('id_semester', $row->id_semester),

				'integritas' => set_value('integritas', $row->integritas),
				'religius' => set_value('religius', $row->religius),
				'nasionalis' => set_value('nasionalis', $row->nasionalis),
				'mandiri' => set_value('mandiri', $row->mandiri),
				'gotongroyong' => set_value('gotongroyong', $row->gotongroyong),

				'id_siswa' => set_value('id_siswa', $id),

				'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
				'nis' => set_value('nis', $row->nis),
				'nisn' => set_value('nisn', $row->nisn),
				'kelas' => set_value('kelas', $row->kelas),
				'semester' => set_value('semester', $row->semester),
				'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
			);

			$data['profile'] = $this->Mcrud->getprofilweb()->row();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/raport_sikap', $data);
			$this->load->view('admin/footer');
		}
	}

	public function cetakraportsikap($id, $idkelas, $idsemester)
	{

		$row = $this->Mcrud->getsikap($id, $idkelas, $idsemester)->row();

		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'id_nilai_sikap' => set_value('id_nilai_sikap', $row->id_nilai_sikap),
				'id_kelas' => set_value('id_kelas', $row->id_kelas),
				'id_semester' => set_value('id_semester', $row->id_semester),

				'integritas' => set_value('integritas', $row->integritas),
				'religius' => set_value('religius', $row->religius),
				'nasionalis' => set_value('nasionalis', $row->nasionalis),
				'mandiri' => set_value('mandiri', $row->mandiri),
				'gotongroyong' => set_value('gotongroyong', $row->gotongroyong),

				'id_siswa' => set_value('id_siswa', $id),

				'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
				'nis' => set_value('nis', $row->nis),
				'nisn' => set_value('nisn', $row->nisn),
				'kelas' => set_value('kelas', $row->kelas),
				'semester' => set_value('semester', $row->semester),
				'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
			);
			$data['kepsek'] = $this->db->query("SELECT * FROM guru WHERE jabatan='Kepala Sekolah'")->result_array();
			$data['walikelas'] = $this->db->query("SELECT * FROM kelas a INNER JOIN guru b ON a.id_guru=b.id_guru WHERE a.id_kelas='$idkelas'")->result_array();
			$this->load->view('admin/cetak_raport_sikap', $data);
		}
	}

	public function gantipassword()
	{

		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/ganti_password');
		$this->load->view('admin/footer');
	}

	function gantipassword_act()
	{
		//data yang terekam pada method post atau yang kita ketikan pada inputan
		$id_admin = $this->session->id_admin;
		$username = $this->input->post('username');
		$pass_baru = $this->input->post('pass_baru');
		$ulang_pass = $this->input->post('ulang_pass');
		//proses validasi ganti dan ulangi password password
		$this->form_validation->set_rules('pass_baru', 'Password Baru', 'required|matches[ulang_pass]');
		$this->form_validation->set_rules('ulang_pass', 'Ulangi Password Baru', 'required');

		if ($this->form_validation->run() != false) {
			$data = 'username="' . $username . '", password="' . $pass_baru . '"';
			$this->Mcrud->update('admin', $data, "id_admin='$id_admin'");
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">Password telah diupdate!</div>');
			redirect('admin/gantipassword');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal, terjadi kesalahan! pastikan ulangi password benar</div>');
			redirect('admin/gantipassword');
		}
	}

	public function laporan_pesantren()
	{
		$data['tgl1'] = $this->input->get('tgl1', true);
		$data['tgl2'] = $this->input->get('tgl2', true);

		if ($data['tgl1'] != "" && $data['tgl2'] != "") {
			$data['pesantren'] = $this->db->query('SELECT * FROM  pesantren where tgl_daftar >= "' . $data['tgl1'] . '" and tgl_daftar <= "' . $data['tgl2'] . '"')->result();
		} elseif ($data['tgl1'] != "") {
			$data['pesantren'] = $this->db->query('SELECT * FROM  pesantren where tgl_daftar >= "' . $data['tgl1'] . '"')->result();
		} elseif ($data['tgl2'] != "") {
			$data['pesantren'] = $this->db->query('SELECT * FROM  pesantren where tgl_daftar <= "' . $data['tgl2'] . '"')->result();
		} else {
			$data['pesantren'] = $this->db->query('SELECT * FROM  pesantren')->result();
		}


		$data['profile'] = $this->Mcrud->getprofilweb()->row();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/laporan_pesantren', $data);
		$this->load->view('admin/footer');
	}

	public function cetak_laporan_pesantren()
	{
		$data['tgl1'] = $this->input->get('tgl1', true);
		$data['tgl2'] = $this->input->get('tgl2', true);

		if ($data['tgl1'] != "" && $data['tgl2'] != "") {
			$data['pesantren'] = $this->db->query('SELECT * FROM  pesantren where tgl_daftar >= "' . $data['tgl1'] . '" and tgl_daftar <= "' . $data['tgl2'] . '"')->result();
		} elseif ($data['tgl1'] != "") {
			$data['pesantren'] = $this->db->query('SELECT * FROM  pesantren where tgl_daftar >= "' . $data['tgl1'] . '"')->result();
		} elseif ($data['tgl2'] != "") {
			$data['pesantren'] = $this->db->query('SELECT * FROM  pesantren where tgl_daftar <= "' . $data['tgl2'] . '"')->result();
		} else {
			$data['pesantren'] = $this->db->query('SELECT * FROM  pesantren')->result();
		}

		$this->load->view('admin/cetak_laporan_pesantren', $data);
	}
}
