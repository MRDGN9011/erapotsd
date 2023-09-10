<!DOCTYPE html>
<html>

<head>
    <title>Cetak Raport Sikap</title>
</head>
<link href="<?php echo base_url("assets/admin/vendor/fontawesome-free/css/all.min.css"); ?>" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="<?php echo base_url("assets/admin/css/sb-admin-2.min.css"); ?>" rel="stylesheet">

<link href="<?php echo base_url("assets/admin/vendor/datatables/dataTables.bootstrap4.min.css"); ?>" rel="stylesheet">

<body>

    <table class="table table-bordered" cellspacing="0" width="100%" style="text-size-adjust: 20px; border-collapse: collapse;">
        <tr style="text-align: center;">
            <td width="20%"><img width="50%" src="<?= base_url('assets/image/logo.png') ?>"></td>'
            <td>
             <h3>PEMERINTAH KABUPATEN BOGOR<br>
                DINAS PENDIDIKAN <br>
            SMK GEMA BHAKTI 1 JASINGA</h3>
            <h5>Jl. Letnan Sayuti No.Km. 6, Setu, Kec. Jasinga, Kabupaten Bogor</h5>
        </td>
        <td width="20%"><img width="40%" src="<?= base_url('assets/image/bogor.png') ?>"></td>'
    </tr>
</table>
<div style="text-align: center;">
    <h3>LAPORAN ONLINE</h3>
    <h3>PENCAPAIAN PENILAIAN SIKAP SPIRITUAL DAN SOSIAL <br>PENCAPAIAN KOMPETENSI PESERTA DIDIK</h3>
    <h3>SEMESTER <?= $semester ?></h3>
    <h3>TAHUN PELAJARAN <?= $tahun_ajaran ?></h3>
</div>
<table style=" text-size-adjust: 20px; border-collapse: collapse; text-align: left; " width=" 50%">
    <tr>
        <th>Nama Siswa</th>
        <th>:</th>
        <th><?= $nama_siswa ?></th>
    </tr>
    <tr>
        <th>No. Induk</th>
        <th>:</th>
        <th><?= $nis ?></th>
    </tr>
    <tr>
        <th>NISN</th>
        <th>:</th>
        <th><?= $nisn ?></th>
    </tr>
    <tr>
        <th>Kelas</th>
        <th>:</th>
        <th><?= $kelas ?></th>
    </tr>
</table>
<hr>
<div>
 <h4>KARAKTER YANG DIBANGUN</h4>
 <table class="table table-bordered" width="100%" cellspacing="0" style="text-align: ;">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th width="10%">Karakter</th>
            <th width="30%">Deskripsi</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $sikap = $this->db->query("SELECT * FROM nilai_sikap where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_semester='$id_semester'");
        if ($sikap->num_rows() > 0) {
            foreach ($sikap->result() as $key) {?>
                <tr>
                    <td>1</td>
                    <td>Integritas</td>
                    <td><?= $key->integritas ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Religius</td>
                    <td><?= $key->religius ?></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nasionalis</td>
                    <td><?= $key->nasionalis ?></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Mandiri</td>
                    <td><?= $key->mandiri ?></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Gotong Royong</td>
                    <td><?= $key->gotongroyong ?></td>
                </tr>
            <?php  }
        } ?>

    </tbody>

</table>

</div>

<table style="border-collapse: collapse; text-align: center;" width="100%">
    <thead>
        <tr>
            <th colspan="2">
                Orang Tua Siswa,
            </th>
            <th colspan="2">
            </th>
            <th colspan="2">
                    <?php
                    $tanggal = date("d");
                    $bulan = date("m");
                    $tahun = date("Y");
                    $daftarBulan = array(
                        "01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni",
                        "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"
                    );
                    $bulanTeks = $daftarBulan[$bulan];
                    $tanggalTeks = $tanggal . " " . $bulanTeks . " " . $tahun;
                    ?>

                    Bogor, <?= $tanggalTeks ?><br>
                    Wali Kelas <?= $kelas ?>
                </th>
        </tr>
        <tr>
            <th colspan="6">
                <br>
                <br>
                <br>
            </th>
        </tr>
        <tr>
            <th colspan="6">
                <br>
                <br>
                <br>
            </th>
        </tr>
        <tr>
            <th colspan="2">
                ...............
            </th>
            <th colspan="2">
            </th>
            <th colspan="2">
             <?php foreach($walikelas as $wk) : ?>
                <?= $wk['nama_guru'] ?><br>
                NIP. <?= $wk['nip'] ?>
            <?php endforeach ?>
        </th>
    </tr>

</thead>

<thead>
    <tr>
        <td colspan="6">
            <br><br>
        </td>
    </tr>
    <tr>
        <th colspan="6">
            Mengetahui,<br>
            Kepala SMK Gema Bhakti 1 Jasinga
        </th>
    </tr>
    <tr>
        <th colspan="6">
            <br>
            <br>
            <br>
        </th>
    </tr>
    <tr>
        <th colspan="6">
            <br>
            <br>
            <br>
        </th>
    </tr>
    <tr>
        <th colspan="6">
         <?php foreach($kepsek as $kep) : ?>
            <?= $kep['nama_guru'] ?><br>
            NIP. <?= $kep['nip'] ?>
        <?php endforeach ?>
    </th>
</tr>

</thead>
</table>
<script type="text/javascript">
    window.print();
</script>

<script src="<?php echo base_url("assets/admin/vendor/jquery/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url("assets/admin/vendor/jquery-easing/jquery.easing.min.js"); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url("assets/admin/js/sb-admin-2.min.js"); ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url("assets/admin/vendor/chart.js/Chart.min.js"); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url("assets/admin/js/demo/chart-area-demo.js"); ?>"></script>
<script src="<?php echo base_url("assets/admin/js/demo/chart-pie-demo.js"); ?>"></script>

<script src="<?= base_url() ?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url("assets/admin/js/demo/datatables-demo.js"); ?>"></script>



</body>

</html>