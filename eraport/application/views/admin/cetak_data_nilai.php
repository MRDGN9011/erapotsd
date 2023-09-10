<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table style="border-collapse: collapse;" width="100%">
    <thead>
        <tr>
            <th colspan="20">
                <h2>DAFTAR NILAI RAPORT SEMESTER <?= $namasemester ?></h2>
            </th>
        </tr>
        <tr>
            <th colspan="20">
                <h1>KELAS <?= $namakelas ?></h1>
            </th>
        </tr>
        <tr>
            <th colspan="20">
                <h4>TAHUN PELAJARAN <?= $tahunajaran ?></h4>
            </th>
        </tr>
    </thead>
</table>
<table border="1" width="100%">
    <thead>
        <tr>
            <th rowspan="3">No</th>
            <th rowspan="3">Nama Siswa</th>
            <th colspan="<?= $mapel->num_rows() ?>">Nilai</th>
            <th rowspan="3">Total Nilai Gabungan</th>
            <th rowspan="3">Rata-rata Nilai Gabungan</th>
            <th colspan="3">Ketidakhadiran</th>
            <th rowspan="3">Pramuka</th>
            <th rowspan="3">Ekskul</th>
            <th rowspan="3">Ranking</th>

        </tr>
        <tr>
            <?php
            $mapela = $this->db->query("select * from detail_mapel_guru a, mapel b, guru c where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and b.golongan='Wajib A'");
            $mapelb = $this->db->query("select * from detail_mapel_guru a, mapel b, guru c where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and b.golongan='Wajib B'");
            ?>
            <?php foreach($mapel->result() as $nil) : ?>
                <th colspan=""><?= $nil->kode_mapel ?></th>
            <?php endforeach ?>
            <th>S</th>
            <th>I</th>
            <th>A</th>
        </tr>
        <tr>
            <?php foreach ($mapela->result() as $map) { ?>
                <th><?php echo $map->kode_mapel; ?></th>
            <?php } ?>

            <?php foreach ($mapelb->result() as $mapb) { ?>
                <th><?php echo $mapb->kode_mapel; ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($nilai as $key) {
            $sakit = $this->db->query("select sum(absen_sakit) as sakit from detail_nilai where id_siswa='$key->id_siswa'")->row();
            $izin = $this->db->query("select sum(absen_izin) as izin from detail_nilai where id_siswa='$key->id_siswa'")->row();
            $alfa = $this->db->query("select sum(absen_alfa) as alfa from detail_nilai where id_siswa='$key->id_siswa'")->row();
            $rangking = $this->db->query("select * from nilai where id_kelas = '$idkelas' and id_semester = '$idsemester' order by rata_rata_gabungan desc")->result();
            $i = 1;
            foreach ($rangking as $rank) {
                if ($rank->id_nilai == $key->id_nilai) {
                    $ran = $i;
                }
                $i++;
            }
            ?>

            <tr>
                <td><?= $no ?></td>
                <td><?php echo 'Nis:' . $key->nis . '<hr>' . $key->nama_siswa; ?></td>
                <?php
                foreach ($mapelnya->result() as $map) {
                    $detnil = $this->db->query("select * from detail_nilai where id_mapel='$map->id_mapel' and id_kelas='$key->id_kelas' and id_semester='$key->id_semester' and id_siswa='$key->id_siswa'")->result();
                    foreach ($detnil as $ni) { ?>
                        <td>
                            <?= 'P: ' . $ni->total_nilai ?><br>
                            <?= 'K: ' . $ni->nilai_keterampilan ?>
                        </td>
                    <?php }
                } ?>
                <td>
                    <?= $key->nilai_gabungan ?>
                </td>
                <td>
                    <?= $rata2 = $key->rata_rata_gabungan ?>
                </td>
                <td>
                    <?= $sakit->sakit ?>
                </td>
                <td>
                    <?= $izin->izin ?>
                </td>
                <td>
                    <?= $alfa->alfa ?>
                </td>
                <td>
                    <?= $key->pramuka ?>
                </td>
                <td>
                    <?= $key->ekskul . ': ' . $key->nilai_ekskul ?>
                </td>
                <td>
                    <?= $ran ?>
                    <input type="hidden" name="rangking<?= $no ?>" value="<?= $ran ?>">
                </td>
            </tr>

            <?php
            $no++;
        } ?>
    </tbody>
</table>

<table style="border-collapse: collapse;" width="100%">
    <thead>
        <tr>
            <th colspan="5">
                Mengetahui,<br>
                Kepala SMK Gema Bhakti 1 Jasinga
            </th>
            <th colspan="10">
            </th>
            <th colspan="5">
                Bogor, 18 Desember 2022<br>
                Wali Kelas <?= $namakelas ?>
            </th>
        </tr>
        <tr>
            <th colspan="20">
            </th>
        </tr>
        <tr>
            <th colspan="20">
            </th>
        </tr>
        <tr>
            <th colspan="5">
               <?php foreach($kepsek as $kep) : ?>
                <?= $kep['nama_guru'] ?><br>
                NIP. <?= $kep['nip'] ?>
                <?php endforeach ?>
            </th>
            <th colspan="10">
            </th>
            <th colspan="5">
             <?php foreach($walikelas as $wk) : ?>
                <?= $wk['nama_guru'] ?><br>
                NIP. <?= $wk['nip'] ?>
            <?php endforeach ?>
        </th>
    </tr>

</thead>
</table>