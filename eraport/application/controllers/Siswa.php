<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcrud');
		if ($this->session->userdata('level') != 'Siswa') {
			redirect('login_siswa');
		}
	}

	public function index()
	{
		$id_siswa = $this->session->id_siswa;
		$row = $this->db->query("SELECT * From siswa where status='Aktif' and id_siswa='$id_siswa'")->row();
		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'action' => site_url('siswa/update_siswa_act'),
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

			$this->load->view('siswa/header');
			$this->load->view('siswa/dashboard', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function dataguru()
	{
		$data['guru'] = $this->Mcrud->getguru()->result();
		$this->load->view('siswa/header');
		$this->load->view('siswa/data_guru', $data);
		$this->load->view('siswa/footer');
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
		redirect('siswa');
	}

	public function datajadwal()
	{
		$id_siswa = $this->session->id_siswa;
		$data['jadwal'] = $this->db->query("SELECT * From detail_jadwal_kelas a, detail_kelas_siswa b, jadwal c, kelas d, siswa e, mapel f, semester g where a.id_jadwal = c.id_jadwal and a.id_kelas=b.id_kelas and b.id_kelas=d.id_kelas and c.id_mapel=f.id_mapel and b.id_siswa=e.id_siswa and b.id_semester=g.id_semester and b.id_siswa='$id_siswa'")->result();
		foreach ($data['jadwal'] as $j) {
			$data['kelas'] = $j->kelas;
			$data['semester'] = $j->semester;
			$data['tahun_ajaran'] = $j->tahun_ajaran;
		}
		$this->load->view('siswa/header');
		$this->load->view('siswa/data_jadwal', $data);
		$this->load->view('siswa/footer');
	}

	public function detailsiswa()
	{
		$id = $this->session->id_siswa;
		$row = $this->Mcrud->getsiswa_id($id)->row();
		$row2 = $this->Mcrud->getdetailkelassiswa($id);
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

			$this->load->view('siswa/header');
			$this->load->view('siswa/detail_siswa', $data);
			$this->load->view('siswa/footer');
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
		redirect('siswa/detailsiswa/' . $id);
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
		redirect('siswa/detailsiswa/' . $id);
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
		redirect('siswa/detailsiswa/' . $id);
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
		redirect('siswa/detailsiswa/' . $id);
	}

	public function formeditorangtua()
	{
		$id = $this->session->id_siswa;
		$row = $this->Mcrud->getwali($id)->row();
		if ($row) {
			$data = array(
				'title' => 'Update',
				'button' => 'Update',
				'action' => site_url('siswa/update_orangtua_act'),
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

			$this->load->view('siswa/header');
			$this->load->view('siswa/form_orangtua', $data);
			$this->load->view('siswa/footer');
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
		redirect('siswa/formeditorangtua/' . $id_siswa);
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
		redirect('siswa/formeditorangtua');
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
		redirect('siswa/formeditorangtua');
	}

	public function datanilai($idsemester = null)
	{
		$id = $this->session->id_siswa;
		$data['semesternya'] = $this->db->query("select b.id_semester, b.semester, b.tahun_ajaran from nilai a, semester b, siswa c where a.id_semester=b.id_semester and a.id_siswa=c.id_siswa and a.id_siswa='$id'")->result();
		$data['mapel'] = $this->db->query("SELECT * FROM mapel WHERE id_mapel IN (SELECT id_mapel FROM detail_nilai)");
		$data['idsemester'] = $this->input->get('idsemester', true);


		if ($data['idsemester'] != '') {
			$semesterid = $this->db->query("Select * from detail_kelas_siswa a, kelas b, semester c, siswa d where a.id_kelas=b.id_kelas and a.id_semester=c.id_semester and a.id_siswa=d.id_siswa and a.id_siswa='$id' and a.id_semester=" . $data['idsemester'])->row();
			$data['idkelas'] = $semesterid->id_kelas;
			$whereClause = 'WHERE a.id_kelas="' . $semesterid->id_kelas . '"';
			$query = 'SELECT * FROM jadwal a
			LEFT JOIN detail_mapel_guru d ON a.id_detail_mapel_guru = d.id_detail_mapel_guru
			LEFT JOIN mapel b ON a.id_mapel = b.id_mapel
			LEFT JOIN kelas c ON a.id_kelas = c.id_kelas
			LEFT JOIN guru e ON d.id_guru = e.id_guru ' . $whereClause . '
			ORDER BY a.id_mapel ASC';
			$data['mapelnya'] = $this->db->query($query);
			
			$data['namakelas'] = $semesterid->kelas;
			$data['nissiswa'] = $semesterid->nis;
			$data['namasiswa'] = $semesterid->nama_siswa;
			$data['namasemester'] = $semesterid->semester;
			$data['tahunajaran'] = $semesterid->tahun_ajaran;
			$data['nilai'] = $this->db->query("SELECT * FROM nilai a, detail_nilai b, mapel c, kelas d, semester e, siswa f where b.id_mapel=c.id_mapel and b.id_kelas=d.id_kelas and b.id_semester=e.id_semester and b.id_siswa=f.id_siswa and a.id_siswa=b.id_siswa and a.id_siswa='$id' and a.id_semester='" . $data['idsemester'] . "' AND b.id_detail_nilai IN (SELECT MIN(id_detail_nilai) FROM detail_nilai GROUP BY id_siswa)")->result();
		} else {
			$data['notif'] = "tidak ada data !";
		}
		$this->load->view('siswa/header');
		$this->load->view('siswa/data_nilai', $data);
		$this->load->view('siswa/footer');
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

			$this->load->view('siswa/header');
			$this->load->view('siswa/raport', $data);
			$this->load->view('siswa/footer');
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
			$data['kepsek'] = $this->db->query("SELECT * FROM guru WHERE jabatan='Kepala Sekolah'")->result_array();
			$data['walikelas'] = $this->db->query("SELECT * FROM kelas a INNER JOIN guru b ON a.id_guru=b.id_guru WHERE a.id_kelas='$idkelas'")->result_array();

			$this->load->view('siswa/cetak_raport', $data);
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
			$data['kepsek'] = $this->db->query("SELECT * FROM guru WHERE jabatan='Kepala Sekolah'")->result_array();
			$data['walikelas'] = $this->db->query("SELECT * FROM kelas a INNER JOIN guru b ON a.id_guru=b.id_guru WHERE a.id_kelas='$idkelas'")->result_array();
			$this->load->view('siswa/header');
			$this->load->view('siswa/raport_sikap', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function cetakraportsikap($id, $idkelas, $idsemester)
	{

		$row2 = $this->Mcrud->getdetailmapel()->result();
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
				'nis' => set_value('nis', $row->nis),
				'nisn' => set_value('nisn', $row->nisn),
				'kelas' => set_value('kelas', $row->kelas),
				'semester' => set_value('semester', $row->semester),
				'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),

				'mapel' => $row2,

			);
			$data['kepsek'] = $this->db->query("SELECT * FROM guru WHERE jabatan='Kepala Sekolah'")->result_array();
			$data['walikelas'] = $this->db->query("SELECT * FROM kelas a INNER JOIN guru b ON a.id_guru=b.id_guru WHERE a.id_kelas='$idkelas'")->result_array();
			$this->load->view('siswa/cetak_raport_sikap', $data);
		}
	}
}
