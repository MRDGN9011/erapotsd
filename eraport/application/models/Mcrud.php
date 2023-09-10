<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcrud extends CI_Model
{

	//GET
	//halaman admin
	public function getuser()
	{
		$user = $this->db->query('SELECT * FROM admin order by id_admin desc');
		return $user;
	}

	public function getprofilweb()
	{
		$profil = $this->db->query('SELECT * FROM profile_website where id_profile=1');
		return $profil;
	}

	public function getsemester()
	{
		$semester = $this->db->query('SELECT * FROM semester order by id_semester asc');
		return $semester;
	}

	public function getkelas()
	{
		$kelas = $this->db->query('SELECT * FROM kelas order by id_kelas asc');
		return $kelas;
	}

	public function getwkelas()
	{
		$kelas = $this->db->query('SELECT * FROM kelas a INNER JOIN guru b ON a.id_guru=b.id_guru order by id_kelas asc');
		return $kelas;
	}

	public function getmapel()
	{
		$mapel = $this->db->query('SELECT * FROM mapel order by id_mapel asc');
		return $mapel;
	}

	public function getjadwal()
	{
		$jadwal = $this->db->query('SELECT * FROM jadwal a
			LEFT JOIN detail_mapel_guru d ON a.id_detail_mapel_guru = d.id_detail_mapel_guru
			LEFT JOIN mapel b ON a.id_mapel = b.id_mapel
			LEFT JOIN kelas c ON a.id_kelas = c.id_kelas
			LEFT JOIN guru e ON d.id_guru = e.id_guru
			ORDER BY a.id_jadwal desc');

		return $jadwal;
	}

	public function getjadwalsiswa()
	{
		$jadwal = $this->db->query('SELECT * FROM jadwal a
			LEFT JOIN detail_mapel_guru d ON a.id_detail_mapel_guru = d.id_detail_mapel_guru
			LEFT JOIN mapel b ON a.id_mapel = b.id_mapel
			LEFT JOIN kelas c ON a.id_kelas = c.id_kelas
			LEFT JOIN guru e ON d.id_guru = e.id_guru where a.id_kelas="$idkelas"
			ORDER BY a.id_jadwal ASC');

		return $jadwal;
	}


	public function getjadwalid($id)
	{
		$jadwal = $this->db->query("SELECT * FROM jadwal a, mapel b, kelas c where a.id_mapel=b.id_mapel and a.id_kelas=c.id_kelas and a.id_jadwal='$id' order by a.id_jadwal asc");
		return $jadwal;
	}

	public function getdetailjadwalkelas($id)
	{
		$jadwalkelas = $this->db->query("SELECT * FROM detail_jadwal_kelas a, jadwal b, kelas c where a.id_jadwal=b.id_jadwal and a.id_kelas=c.id_kelas and a.id_jadwal = '$id'");
		return $jadwalkelas;
	}

	public function getjadwalguru()
	{
		$jadwalguru = $this->db->query("SELECT * FROM detail_mapel_guru a, jadwal b, kelas c, mapel d, guru e where a.id_mapel=b.id_mapel and a.id_mapel=d.id_mapel and b.id_kelas=c.id_kelas and a.id_guru=e.id_guru");
		return $jadwalguru;
	}

	//siswa
	public function getsiswa()
	{
		$siswa = $this->db->query('SELECT * FROM siswa order by id_siswa desc');
		return $siswa;
	}

	public function getsiswa_id($id)
	{
		$siswa = $this->db->query("SELECT * FROM siswa where id_siswa='$id' order by id_siswa desc");
		return $siswa;
	}

	public function getberkas($id)
	{
		$berkas = $this->db->query("SELECT * FROM siswa a, berkas_siswa b where a.id_siswa=b.id_siswa and a.id_siswa='$id'");
		return $berkas;
	}

	public function getwali($id)
	{
		$wali = $this->db->query("SELECT * FROM siswa a, wali b where a.id_siswa=b.id_siswa and b.id_siswa='$id'");
		return $wali;
	}

	public function getdetailkelassiswa($id)
	{
		$kelassiswa = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_siswa='$id'");

		if ($kelassiswa->num_rows() > 0) {
			return $kelassiswa->row();
		} else {
			$row = new stdClass();
			$row->kelas = "Kelas Belum Ditentukan";
			return $row;
		}
	}
	//guru
	public function getguru()
	{
		$guru = $this->db->query('SELECT * FROM guru');
		return $guru;
	}

	public function getguru_id($id)
	{
		$guru = $this->db->query("SELECT * FROM guru where id_guru='$id'");
		return $guru;
	}

	public function getdetailmapelguru($id)
	{
		$mapel = $this->db->query("SELECT * FROM detail_mapel_guru a, mapel b, guru c where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and a.id_guru='$id'");
		return $mapel;
	}

	public function getdetailmapel()
	{
		$mapel = $this->db->query("SELECT * FROM detail_mapel_guru a, mapel b, guru c where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru");
		return $mapel;
	}

	public function getnilai($id, $idkelas, $idsemester)
	{
		$nilai = $this->db->query("SELECT * FROM detail_nilai a, mapel b, guru c, siswa d, semester e, kelas f where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and a.id_siswa=d.id_siswa and a.id_semester=e.id_semester and a.id_kelas=f.id_kelas and a.id_siswa='$id' and a.id_kelas='$idkelas' and a.id_semester='$idsemester' ");
		return $nilai;
	}

	public function getsikap($id, $idkelas, $idsemester)
	{
		$sikap = $this->db->query("SELECT * FROM nilai_sikap a,siswa d, semester e, kelas f where a.id_siswa=d.id_siswa and a.id_semester=e.id_semester and a.id_kelas=f.id_kelas and a.id_siswa='$id' and a.id_kelas='$idkelas' and a.id_semester='$idsemester'");
		return $sikap;
	}

	public function getnilaiid($id)
	{
		$nilai = $this->db->query("SELECT * FROM detail_nilai a, mapel b, guru c, siswa d, semester e, kelas f where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and a.id_siswa=d.id_siswa and a.id_semester=e.id_semester and a.id_kelas=f.id_kelas and a.id_detail_nilai='$id' ");
		return $nilai;
	}

	public function getnilairaport($id)
	{
		$nilai = $this->db->query("SELECT * FROM detail_nilai a, mapel b, guru c, siswa d, semester e, kelas f where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and a.id_siswa=d.id_siswa and a.id_semester=e.id_semester and a.id_kelas=f.id_kelas and a.id_siswa='$id' ");
		return $nilai;
	}


	//halaman pesantren
	public function getfasdig_pesantren($id)
	{
		$fasilitas_digital = $this->db->query("SELECT * FROM fasilitas_digital_pesantren a, pesantren b, fasilitas_digital c where a.id_pesantren=b.id_pesantren and a.id_fasilitas_digital=c.id_fasilitas_digital and a.id_pesantren='$id'");
		return $fasilitas_digital;
	}

	public function getsantri_id($id)
	{
		$santri = $this->db->query("SELECT * FROM data_santri a, pesantren b where a.id_pesantren=b.id_pesantren and a.id_pesantren='$id'");
		return $santri;
	}

	public function getpengajar_id($id)
	{
		$pengajar = $this->db->query("SELECT * FROM data_pengajar a, pesantren b where a.id_pesantren=b.id_pesantren and a.id_pesantren='$id'");
		return $pengajar;
	}

	public function getprofil_pesantren_id($id)
	{
		$profil_pesantren = $this->db->query("SELECT * FROM profil_pesantren a, pesantren b where a.id_pesantren=b.id_pesantren and a.id_pesantren='$id'");
		return $profil_pesantren;
	}

	//OPERATION
	public function tambah($tabel, $data)
	{
		$add = $this->db->insert($tabel, $data);

		return $add;
	}

	public function hapus($tabel, $id)
	{
		$this->db->query("DELETE FROM $tabel where $id");
		return $this->db->affected_rows();
	}

	public function update($tabel, $data, $id)
	{
		$this->db->query("UPDATE $tabel set $data where $id");
		return $this->db->affected_rows();
	}

	function uploadGambar($nama_file = '', $folder = '')
	{
		$this->pathgambar = realpath(APPPATH . "../$folder");
		$config = array(
			'allowed_types' => 'jpg|png|gif|jpeg',
			'upload_path' => $this->pathgambar
		);
		$this->load->library('upload', $config);
		$this->upload->do_upload($nama_file);
		$file_data = $this->upload->data();
		$nama_file = $file_data['file_name'];
		return $nama_file;
	}

	function deleteFile($namagambar = '', $folder = '')
	{
		$this->pathgambar = realpath(APPPATH . "../$folder");
		unlink($this->pathgambar . "/" . $namagambar);
	}

	function kode_fasilitas_digital()
	{
		$this->db->select('right(id_fasilitas_digital,3) as kode', false);
		$this->db->order_by('id_fasilitas_digital', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('fasilitas_digital');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$kodejadi = 'FD' . $kodemax;

		return $kodejadi;
	}

	function kode_pesantren()
	{
		$this->db->select('right(id_pesantren,3) as kode', false);
		$this->db->order_by('id_pesantren', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('pesantren');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$kodejadi = 'TREN' . $kodemax;

		return $kodejadi;
	}

	public function ambil($table)
	{
		return $this->db->get($table)->result_array();
	}
}
