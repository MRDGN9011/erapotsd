<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcrud');
		if ($this->session->userdata('level') != 'Guru') {
			redirect('login_guru');
		}
	}

	public function index()
	{
		$data['siswa'] = $this->db->query("SELECT * From siswa where status='Aktif'")->num_rows();
		$data['alumni'] = $this->db->query("SELECT * From siswa where status='Alumni'")->num_rows();
		$data['guru'] = $this->Mcrud->getguru()->num_rows();
		$data['kelas'] = $this->Mcrud->getkelas()->num_rows();
		$data['jadwal'] = $this->Mcrud->getjadwalguru();

		$this->load->view('guru/header');
		$this->load->view('guru/dashboard', $data);
		$this->load->view('guru/footer');
	}

	public function datasemestersiswa()
	{
		$data['semester'] = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d WHERE a.id_siswa = b.id_siswa AND a.id_kelas = c.id_kelas AND a.id_semester = d.id_semester AND a.id_detail_kelas_siswa IN (SELECT MIN(id_detail_kelas_siswa) FROM detail_kelas_siswa GROUP BY id_semester)")->result();
		$data['kelas'] = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester AND a.id_detail_kelas_siswa IN (SELECT MIN(id_detail_kelas_siswa) FROM detail_kelas_siswa GROUP BY id_kelas) ORDER BY c.kelas ASC")->result();
		$this->load->view('guru/header');
		$this->load->view('guru/data_semester_siswa', $data);
		$this->load->view('guru/footer');
	}

	public function siswakelas($id)
	{
		$data['siswa'] = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester and a.id_kelas = '$id'")->result();
		$data['kelas'] = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester and a.id_kelas = '$id' group by a.id_detail_kelas_siswa,a.id_kelas")->row();
		$this->load->view('guru/header');
		$this->load->view('guru/data_siswakelas', $data);
		$this->load->view('guru/footer');
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
		$namamapel = "Bukan Guru Pengampu";
		foreach ($row2 as $r) {
			if ($r->id_guru == $this->session->id_guru) {
				$namamapel = $r->mapel;
				break;
			}
		}
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
			'namamapel' => $namamapel,
		);

		$this->load->view('guru/header');
		$this->load->view('guru/form_nilai', $data);
		$this->load->view('guru/footer');
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
			redirect('guru/formeditnilai/' . $id_siswa . '/' . $id_kelas . '/' . $id_semester);
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
		$namamapel = "Bukan Guru Pengampu";
		foreach ($row2 as $r) {
			if ($r->id_guru == $this->session->id_guru) {
				$namamapel = $r->mapel;
				break;
			}
		}
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
				'namamapel' => $namamapel,

			);

			$this->load->view('guru/header');
			$this->load->view('guru/form_nilai', $data);
			$this->load->view('guru/footer');
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
		redirect('guru/formeditnilai/' . $id_siswa . '/' . $id_kelas . '/' . $id_semester);
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
		redirect('guru/datanilairaport/' . $id_kelas . '/' . $id_semester);
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
		redirect('guru/datanilairaport/' . $id_kelas . '/' . $id_semester);
	}

	public function datanilai($idkelas = null, $idsemester = null)
	{
		$id_guru = $this->session->userdata('id_guru');
		$data['kelasnya'] = $this->db->query("SELECT * FROM kelas")->result();
		$data['semesternya'] = $this->Mcrud->getsemester()->result();
		$row2 = $this->Mcrud->getjadwalguru()->result();
		$namamapel="Tidak Ditemukan";
		$idmapel=0;
		foreach ($row2 as $r) {
			if ($r->id_guru == $this->session->id_guru) {
				$namamapel = $r->mapel;
				$idmapel = $r->id_mapel;
				break;
			}
		}

		$data['idkelas'] = $this->input->get('idkelas', true);
		$data['idsemester'] = $this->input->get('idsemester', true);


		if ($data['idkelas'] != '' && $data['idsemester'] != '') {
			$kelasid = $this->db->query("Select * from kelas where id_kelas=" . $data['idkelas'])->row();
			$semesterid = $this->db->query("Select * from semester where id_semester=" . $data['idsemester'])->row();
			$data['namakelas'] = $kelasid->kelas;
			$data['namasemester'] = $semesterid->semester;
			$data['tahunajaran'] = $semesterid->tahun_ajaran;
			$data['namamapel'] = $namamapel;
			$data['idmapel'] = $idmapel;
			$data['nilai'] = $this->db->query("SELECT * FROM nilai a, detail_nilai b, mapel c, kelas d, semester e, siswa f where b.id_mapel=c.id_mapel and b.id_kelas=d.id_kelas and b.id_semester=e.id_semester and b.id_siswa=f.id_siswa and a.id_siswa=b.id_siswa and a.id_kelas='" . $data['idkelas'] . "' and a.id_semester='" . $data['idsemester'] . "' group by a.id_nilai,b.id_detail_nilai,a.id_siswa")->result();
		} else {
			$data['notif'] = "tidak ada data !";
		}
		$this->load->view('guru/header');
		$this->load->view('guru/data_nilai', $data);
		$this->load->view('guru/footer');
	}
}
