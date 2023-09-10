-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2023 at 10:43 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eraport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Si Admin', 'admin', 'admin'),
(3, 'Dadang Kurniawan', 'dadang', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `berkas_siswa`
--

CREATE TABLE `berkas_siswa` (
  `id_berkas` int(11) NOT NULL,
  `kk` varchar(25) DEFAULT NULL,
  `akta_lahir` varchar(25) DEFAULT NULL,
  `ijazah_sd` varchar(25) DEFAULT NULL,
  `form_daftar` varchar(25) DEFAULT NULL,
  `id_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berkas_siswa`
--

INSERT INTO `berkas_siswa` (`id_berkas`, `kk`, `akta_lahir`, `ijazah_sd`, `form_daftar`, `id_siswa`) VALUES
(1, '', '', '', '', 1),
(2, '', '', '', '', 2),
(3, '', '', '', '', 3),
(4, '', '', '', '', 4),
(5, '', '', '', '', 5),
(6, '', '', '', '', 6),
(7, '', '', '', '', 7),
(8, '', '', '', '', 8),
(9, '', '', '', '', 9),
(10, '', '', '', '', 10),
(11, '', '', '', '', 11),
(12, '', '', '', '', 12),
(13, '', '', '', '', 13),
(14, '', '', '', '', 14),
(15, '', '', '', '', 15),
(16, '', '', '', '', 16),
(17, '', '', '', '', 17),
(18, '', '', '', '', 18),
(19, '', '', '', '', 19),
(20, '', '', '', '', 20),
(21, '', '', '', '', 21),
(22, '', '', '', '', 22),
(23, '', '', '', '', 23),
(24, '', '', '', '', 24),
(25, '', '', '', '', 25),
(26, '', '', '', '', 26),
(27, '', '', '', '', 27),
(28, '', '', '', '', 28),
(29, '', '', '', '', 29),
(30, '', '', '', '', 30),
(31, '', '', '', '', 31),
(32, '', '', '', '', 32),
(33, '', '', '', '', 33),
(34, '', '', '', '', 34),
(35, '', '', '', '', 35),
(36, '', '', '', '', 36),
(37, '', '', '', '', 37),
(38, '', '', '', '', 38),
(39, '', '', '', '', 39),
(40, NULL, NULL, NULL, NULL, 46);

-- --------------------------------------------------------

--
-- Table structure for table `detail_jadwal_kelas`
--

CREATE TABLE `detail_jadwal_kelas` (
  `id_detail_jadwal_kelas` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_jadwal_kelas`
--

INSERT INTO `detail_jadwal_kelas` (`id_detail_jadwal_kelas`, `id_jadwal`, `id_kelas`) VALUES
(4, 5, 13),
(5, 6, 13),
(6, 7, 13),
(7, 8, 13),
(8, 9, 13),
(9, 10, 12),
(10, 11, 12),
(11, 12, 12),
(15, 17, 12),
(16, 18, 12),
(17, 19, 13),
(18, 20, 13),
(19, 21, 12),
(20, 22, 12),
(21, 23, 12),
(22, 24, 12),
(23, 25, 12),
(24, 26, 13),
(25, 27, 12),
(26, 28, 13),
(27, 30, 12),
(28, 31, 13),
(29, 32, 14),
(30, 34, 12);

-- --------------------------------------------------------

--
-- Table structure for table `detail_kelas_siswa`
--

CREATE TABLE `detail_kelas_siswa` (
  `id_detail_kelas_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `id_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_kelas_siswa`
--

INSERT INTO `detail_kelas_siswa` (`id_detail_kelas_siswa`, `id_siswa`, `id_kelas`, `keterangan`, `id_semester`) VALUES
(24, 1, 13, 'Kelas Awal', 1),
(25, 2, 13, 'Kelas Awal', 1),
(26, 3, 13, 'Kelas Awal', 1),
(27, 36, 13, 'Kelas Awal', 1),
(28, 34, 13, 'Kelas Awal', 1),
(29, 39, 12, 'Kelas Awal', 1),
(30, 38, 12, 'Kelas Awal', 1),
(31, 37, 12, 'Kelas Awal', 1),
(32, 33, 14, 'Kelas Awal', 1),
(33, 46, 12, 'Kelas Awal', 1),
(34, 1, 17, 'Kelas Awal', 9),
(35, 1, 17, 'Kelas Awal', 9);

-- --------------------------------------------------------

--
-- Table structure for table `detail_mapel_guru`
--

CREATE TABLE `detail_mapel_guru` (
  `id_detail_mapel_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_mapel_guru`
--

INSERT INTO `detail_mapel_guru` (`id_detail_mapel_guru`, `id_mapel`, `id_guru`) VALUES
(9, 10, 5),
(10, 15, 6),
(11, 19, 7),
(15, 6, 11),
(17, 11, 13),
(18, 4, 14),
(19, 9, 15),
(20, 7, 17),
(21, 1, 18),
(22, 14, 19),
(23, 22, 21),
(25, 3, 24),
(26, 8, 25),
(27, 17, 4),
(28, 23, 12),
(33, 2, 8),
(37, 5, 10),
(38, 7, 9),
(39, 20, 20),
(40, 24, 9),
(41, 27, 28);

-- --------------------------------------------------------

--
-- Table structure for table `detail_nilai`
--

CREATE TABLE `detail_nilai` (
  `id_detail_nilai` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `nilai_tugas` float NOT NULL,
  `nilai_uts` float NOT NULL,
  `nilai_uas` float NOT NULL,
  `total_nilai` float NOT NULL,
  `deskripsi_nilai` text NOT NULL,
  `absen_sakit` int(11) NOT NULL,
  `absen_izin` int(11) NOT NULL,
  `absen_alfa` int(11) NOT NULL,
  `nilai_keterampilan` float NOT NULL,
  `deskripsi_nilai_keterampilan` text NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl_buat` date NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_nilai`
--

INSERT INTO `detail_nilai` (`id_detail_nilai`, `id_kelas`, `id_mapel`, `id_guru`, `id_semester`, `nilai_tugas`, `nilai_uts`, `nilai_uas`, `total_nilai`, `deskripsi_nilai`, `absen_sakit`, `absen_izin`, `absen_alfa`, `nilai_keterampilan`, `deskripsi_nilai_keterampilan`, `id_siswa`, `tgl_buat`, `tgl_update`) VALUES
(200, 12, 2, 8, 1, 80, 87, 82, 82.9, '', 1, 1, 1, 85, '', 39, '2023-07-29', '2023-07-29 14:50:31'),
(201, 13, 2, 8, 1, 80, 80, 80, 80, '', 0, 0, 0, 80, '', 1, '2023-07-29', '2023-07-29 14:51:00'),
(202, 13, 1, 18, 1, 80, 83, 86, 83.3, '', 0, 0, 0, 82, '', 1, '2023-07-29', '2023-07-29 14:54:52'),
(203, 14, 20, 20, 1, 80, 90, 100, 91, '', 0, 0, 0, 95, '', 33, '2023-07-30', '2023-07-30 15:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama_guru` varchar(155) NOT NULL,
  `jk_guru` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir_guru` date NOT NULL,
  `alamat_guru` text NOT NULL,
  `telp_guru` varchar(15) NOT NULL,
  `pend_terakhir` varchar(25) NOT NULL,
  `gol` varchar(15) NOT NULL,
  `foto_guru` varchar(25) NOT NULL,
  `jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama_guru`, `jk_guru`, `tgl_lahir_guru`, `alamat_guru`, `telp_guru`, `pend_terakhir`, `gol`, `foto_guru`, `jabatan`) VALUES
(27, '90119011', 'DADANG KURNIAWAN. Spd.Skom.', 'Laki-laki', '2000-11-29', 'Jalan Harapan Indah', '085781718498', 'Universitas Nusa Mandiri', 'IIA', 'foto1694335190.jpg', 'Kepala Sekolah'),
(28, '90119012', 'NIKEN', 'Perempuan', '1998-07-15', 'Depok', '0847424', 'Universitas Nusa Mandiri', 'IIA', 'foto1694335283.jpg', 'Guru Mapel');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_detail_mapel_guru` int(11) DEFAULT NULL,
  `hari` varchar(25) NOT NULL,
  `jam_masuk` varchar(15) NOT NULL,
  `jam_selesai` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_mapel`, `id_kelas`, `id_detail_mapel_guru`, `hari`, `jam_masuk`, `jam_selesai`) VALUES
(25, 1, 12, 21, 'Senin', '10:00', '12:00'),
(26, 1, 13, 21, 'Senin', '08:00', '10:00'),
(27, 2, 12, 33, 'Selasa', '13:00', '15:00'),
(28, 2, 13, 33, 'Selasa', '10:00', '12:00'),
(30, 3, 12, 25, 'Senin', '10:00', '12:00'),
(31, 3, 13, 25, 'Selasa', '10:00', '12:00'),
(32, 20, 14, 39, 'Sabtu', '10:00', '11:00'),
(33, 24, 12, NULL, 'Senin', '07:00', '13:19'),
(34, 24, 12, NULL, 'Senin', '07:00', '13:19');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(25) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`, `id_guru`) VALUES
(12, 'XI.A', 12),
(13, 'XI.B', 18),
(14, 'XI.C', 13),
(15, 'x11', 15),
(16, 'x11', 2),
(17, '1 A', 28);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `mapel` varchar(55) NOT NULL,
  `kkm` int(11) NOT NULL,
  `kode_mapel` varchar(25) NOT NULL,
  `golongan` varchar(25) NOT NULL,
  `sub_muatan` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `mapel`, `kkm`, `kode_mapel`, `golongan`, `sub_muatan`) VALUES
(24, 'Pendidikan Agama dan Budi Pekerti', 75, '1', 'A', ''),
(25, 'Pendidikan Pancasila dan Warganegara', 75, '2', 'A', ''),
(26, 'Bahasa Indonesia', 75, '3', 'A', ''),
(27, 'Matematika', 75, '4', 'A', ''),
(28, 'Ilmu Pengetahuan Alam', 75, '5', 'A', ''),
(29, 'Ilmu Pengetahuan Sosial ', 75, '6', 'A', ''),
(30, 'Seni Budaya dan Prakarya', 75, '6', 'B', ''),
(31, 'Pendidikan Jasmani, Olahraga dan Kesehatan', 75, '7', 'B', '');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `pramuka` char(4) NOT NULL,
  `total_keseluruhan_nilai` float NOT NULL,
  `nilai_rata_rata` float NOT NULL,
  `total_keseluruhan_nilai_keterampilan` float NOT NULL,
  `nilai_keterampilan_rata_rata` float NOT NULL,
  `nilai_gabungan` float NOT NULL,
  `rata_rata_gabungan` float NOT NULL,
  `rangking` int(11) NOT NULL,
  `ekskul` varchar(100) NOT NULL,
  `nilai_ekskul` char(4) NOT NULL,
  `tgl_update_raport` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_kelas`, `id_semester`, `id_siswa`, `pramuka`, `total_keseluruhan_nilai`, `nilai_rata_rata`, `total_keseluruhan_nilai_keterampilan`, `nilai_keterampilan_rata_rata`, `nilai_gabungan`, `rata_rata_gabungan`, `rangking`, `ekskul`, `nilai_ekskul`, `tgl_update_raport`) VALUES
(12, 13, 1, 1, 'B', 1399.7, 82.3353, 1417, 83.3529, 2816.7, 82.8441, 0, 'Olahraga', 'A', '2023-06-28 06:46:25'),
(13, 13, 1, 2, 'B', 1390.4, 81.7882, 1311, 77.1176, 2701.4, 79.4529, 0, 'Olahraga', 'B', '2023-06-28 06:55:17'),
(14, 13, 1, 34, 'A', 1428.4, 84.0235, 1457, 85.7059, 2885.4, 84.8647, 0, 'Kesenian', 'A', '2023-06-28 06:58:55'),
(15, 12, 1, 39, 'C', 496.2, 82.7, 495, 82.5, 991.2, 82.6, 0, 'Olahraga', 'C', '2023-07-29 14:31:59'),
(16, 14, 1, 33, 'B', 91, 91, 95, 95, 186, 93, 0, 'Teknik', 'A', '2023-07-30 15:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_sikap`
--

CREATE TABLE `nilai_sikap` (
  `id_nilai_sikap` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `integritas` varchar(100) NOT NULL,
  `religius` varchar(100) NOT NULL,
  `nasionalis` varchar(100) NOT NULL,
  `mandiri` varchar(100) NOT NULL,
  `gotongroyong` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_sikap`
--

INSERT INTO `nilai_sikap` (`id_nilai_sikap`, `id_siswa`, `id_kelas`, `id_semester`, `integritas`, `religius`, `nasionalis`, `mandiri`, `gotongroyong`) VALUES
(4, 39, 12, 1, 'Ananda perlu menunjukkan integritas yang baik', 'Ananda dapat menghargai perbedaan agama', 'Ananda selalu mengikuti kegiatan upacara rutin di sekolah', 'Ananda mampu membebaskan diri dari keterikatan yang tidak perlu', 'Ananda harus aktif dalam kegiatan membersihkan lingkungan hidup'),
(5, 1, 13, 1, 'Ananda perlu menunjukkan integritas yang baik', 'Ananda dapat menghargai perbedaan agama', 'Ananda selalu mengikuti kegiatan upacara rutin di sekolah', 'Ananda mampu membebaskan diri dari keterikatan yang tidak perlu', 'Ananda harus aktif dalam kegiatan membersihkan lingkungan hidup'),
(6, 33, 14, 1, 'sela perlu menunjukkan integritas yang baik', 'sela menjalankan ibadah', 'sela selalu mengikuti kegiatan upacara rutin di sekolah', 'sela mampu membebaskan diri dari keterikatan yang tidak perlu', 'selalu mangikuti jumat bersih');

-- --------------------------------------------------------

--
-- Table structure for table `profile_website`
--

CREATE TABLE `profile_website` (
  `id_profile` int(11) NOT NULL,
  `title_web` varchar(155) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(25) NOT NULL,
  `logo` varchar(25) NOT NULL,
  `email` varchar(55) NOT NULL,
  `maps` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_website`
--

INSERT INTO `profile_website` (`id_profile`, `title_web`, `keterangan`, `gambar`, `logo`, `email`, `maps`, `alamat`, `telp`) VALUES
(1, 'SD ', 'SD', 'gambar1690774160.jpeg', 'logo1694327025.png', 'dadangk938@gmail.com', '-6.230726232729814, 107.06869297116461', 'SD', '085781718498');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(11) NOT NULL,
  `semester` varchar(25) NOT NULL,
  `tahun_ajaran` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `semester`, `tahun_ajaran`) VALUES
(9, 'GANJIL', '2023 - 2024');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(25) NOT NULL,
  `nisn` varchar(25) NOT NULL,
  `nama_siswa` varchar(155) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(155) NOT NULL,
  `agama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `asal_sekolah` varchar(150) NOT NULL,
  `tgl_diterima` date NOT NULL,
  `status_anak` varchar(55) NOT NULL,
  `anak_ke` int(11) NOT NULL,
  `foto` varchar(25) NOT NULL,
  `status` enum('Aktif','Alumni','Keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nisn`, `nama_siswa`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `alamat`, `no_telp`, `asal_sekolah`, `tgl_diterima`, `status_anak`, `anak_ke`, `foto`, `status`) VALUES
(1, '0068639185', '0043210449', 'Dadang Kurniawan', 'Laki-laki', '2000-11-30', 'PAJAR BULAN', 'Islam', 'Jl harapan indah', '085781718498', 'SMA', '2023-02-10', 'Anak Kandung', 2, 'foto1694324106.jpg', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `wali`
--

CREATE TABLE `wali` (
  `id_wali` int(11) NOT NULL,
  `nik_ayah` varchar(25) DEFAULT NULL,
  `ktp_ayah` varchar(25) DEFAULT NULL,
  `nama_ayah` varchar(155) DEFAULT NULL,
  `tgl_lahir_ayah` date DEFAULT NULL,
  `pekerjaan_ayah` varchar(55) DEFAULT NULL,
  `nik_ibu` varbinary(25) DEFAULT NULL,
  `ktp_ibu` varchar(25) DEFAULT NULL,
  `nama_ibu` varbinary(155) DEFAULT NULL,
  `tgl_lahir_ibu` date DEFAULT NULL,
  `pekerjaan_ibu` varchar(55) DEFAULT NULL,
  `alamat_orang_tua` text DEFAULT NULL,
  `telp_orang_tua` varchar(15) DEFAULT NULL,
  `id_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wali`
--

INSERT INTO `wali` (`id_wali`, `nik_ayah`, `ktp_ayah`, `nama_ayah`, `tgl_lahir_ayah`, `pekerjaan_ayah`, `nik_ibu`, `ktp_ibu`, `nama_ibu`, `tgl_lahir_ibu`, `pekerjaan_ibu`, `alamat_orang_tua`, `telp_orang_tua`, `id_siswa`) VALUES
(1, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 1),
(2, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 2),
(3, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 3),
(4, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 4),
(5, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 5),
(6, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 6),
(7, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 7),
(8, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 8),
(9, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 9),
(10, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 10),
(11, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 11),
(12, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 12),
(13, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 13),
(14, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 14),
(15, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 15),
(16, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 16),
(17, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 17),
(18, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 18),
(19, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 19),
(20, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 20),
(21, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 21),
(22, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 22),
(23, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 23),
(24, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 24),
(25, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 25),
(26, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 26),
(27, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 27),
(28, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 28),
(29, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 29),
(30, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 30),
(31, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 31),
(32, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 32),
(33, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 33),
(34, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 34),
(35, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 35),
(36, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 36),
(37, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 37),
(38, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 38),
(39, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', 39),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `berkas_siswa`
--
ALTER TABLE `berkas_siswa`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `detail_jadwal_kelas`
--
ALTER TABLE `detail_jadwal_kelas`
  ADD PRIMARY KEY (`id_detail_jadwal_kelas`);

--
-- Indexes for table `detail_kelas_siswa`
--
ALTER TABLE `detail_kelas_siswa`
  ADD PRIMARY KEY (`id_detail_kelas_siswa`);

--
-- Indexes for table `detail_mapel_guru`
--
ALTER TABLE `detail_mapel_guru`
  ADD PRIMARY KEY (`id_detail_mapel_guru`);

--
-- Indexes for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  ADD PRIMARY KEY (`id_detail_nilai`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `nilai_sikap`
--
ALTER TABLE `nilai_sikap`
  ADD PRIMARY KEY (`id_nilai_sikap`);

--
-- Indexes for table `profile_website`
--
ALTER TABLE `profile_website`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `wali`
--
ALTER TABLE `wali`
  ADD PRIMARY KEY (`id_wali`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `berkas_siswa`
--
ALTER TABLE `berkas_siswa`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `detail_jadwal_kelas`
--
ALTER TABLE `detail_jadwal_kelas`
  MODIFY `id_detail_jadwal_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `detail_kelas_siswa`
--
ALTER TABLE `detail_kelas_siswa`
  MODIFY `id_detail_kelas_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `detail_mapel_guru`
--
ALTER TABLE `detail_mapel_guru`
  MODIFY `id_detail_mapel_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  MODIFY `id_detail_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nilai_sikap`
--
ALTER TABLE `nilai_sikap`
  MODIFY `id_nilai_sikap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profile_website`
--
ALTER TABLE `profile_website`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `wali`
--
ALTER TABLE `wali`
  MODIFY `id_wali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
