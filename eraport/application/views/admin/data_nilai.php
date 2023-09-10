<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Nilai Raport</h6>

        </div>
        <div class="card-body">
            <h6>Cari Data</h6>
            <form method="get" action="<?= site_url('admin/datanilai') ?>">
                <table width="100%">
                    <tr>
                        <th width="15%">Kelas</th>
                        <th>:</th>
                        <th>
                            <select name="idkelas" class="form-control" required>
                                <?php if ($idkelas) { ?>
                                    <option value="<?= $idkelas ?>"><?= $namakelas ?></option>
                                <?php } else { ?>
                                    <option value="">pilih</option>
                                <?php } ?>
                                <?php foreach ($kelasnya as $kel) { ?>
                                    <option value="<?= $kel->id_kelas ?>"><?= $kel->kelas ?></option>
                                <?php } ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <hr>
                        </th>
                    </tr>
                    <tr>
                        <th width="15%">Semester/Tahun Ajaran</th>
                        <th>:</th>
                        <th>
                            <select name="idsemester" class="form-control" required>
                                <?php if ($idsemester) { ?>
                                    <option value="<?= $idsemester ?>"><?= $namasemester . '/' . $tahunajaran ?></option>
                                <?php } else { ?>
                                    <option value="">pilih</option>
                                <?php } ?>
                                <?php foreach ($semesternya as $sm) { ?>
                                    <option value="<?= $sm->id_semester ?>"><?= $sm->semester . '/' . $sm->tahun_ajaran ?></option>
                                <?php } ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <hr>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3"><button type="submit" class="btn btn-primary btn-block">Cari</button></th>
                    </tr>
                </table>
            </form>
            <?php if ($idkelas != '' && $idsemester != '') { ?>
                <div class="card-body">
                    <?php echo $this->session->flashdata('suces') ?>
                    <br>
                    <h6>Keterangan</h6>
                    <table>
                        <tr>
                            <th>Kelas</th>
                            <th>:</th>
                            <th><?= $namakelas ?></th>
                        </tr>
                        <tr>
                            <th>Semester</th>
                            <th>:</th>
                            <th><?= $namasemester ?></th>
                        </tr>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <th>:</th>
                            <th><?= $tahunajaran ?></th>
                        </tr>
                    </table>
                    <hr>
                    <table class="table table-bordered" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                            <tr>
                                <th rowspan="3">No</th>
                                <th rowspan="3">Nama Siswa</th>
                                <th colspan="<?= $mapelnya->num_rows() ?>">Nilai</th>
                                <th rowspan="3">Total Nilai Gabungan</th>
                                <th rowspan="3">Rata-rata Nilai Gabungan</th>
                                <th colspan="3">Ketidakhadiran</th>
                                <th rowspan="3">Pramuka</th>
                                <th rowspan="3">Ekskul</th>
                                <th rowspan="3">Ranking</th>
                                <th rowspan="3">Opsi</th>
                            </tr>
                            <tr>
                                <?php
                                $mapela = $this->db->query("select * from detail_mapel_guru a, mapel b, guru c where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and b.golongan='Wajib A'");
                                $mapelb = $this->db->query("select * from detail_mapel_guru a, mapel b, guru c where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and b.golongan='Wajib B'");
                                ?>
                                <?php foreach($mapelnya->result() as $nil) : ?>
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
            $detnil = $this->db->query("SELECT * FROM detail_nilai WHERE id_siswa='$key->id_siswa'")->result();
            foreach ($detnil as $ni) {
                echo "<td>";
                echo 'P: ' . $ni->total_nilai . "<br>";
                echo 'K: ' . $ni->nilai_keterampilan;
                echo "</td>";
            }
            ?>
            <td><?= $key->nilai_gabungan ?></td>
            <td><?= $rata2 = $key->rata_rata_gabungan ?></td>
            <td><?= $sakit->sakit ?></td>
            <td><?= $izin->izin ?></td>
            <td><?= $alfa->alfa ?></td>
            <td><?= $key->pramuka ?></td>
            <td><?= $key->ekskul . ': ' . $key->nilai_ekskul ?></td>
            <td><?= $ran ?><input type="hidden" name="rangking<?= $no ?>" value="<?= $ran ?>"></td>
            <td>
                <a href="<?= site_url('admin/detailraport/' . $key->id_siswa . '/' . $idkelas . '/' . $idsemester) ?>" class="btn btn-success btn-sm" title="Lihat">Raport Kompetensi</a>
                <a href="<?= site_url('admin/detailraportsikap/' . $key->id_siswa . '/' . $idkelas . '/' . $idsemester) ?>" class="btn btn-warning btn-sm" title="Lihat">Raport Sikap</a>
            </td>
        </tr>

    <?php
        $no++;
    }
    ?>
</tbody>
                    </table>
                    <a href="<?= site_url('admin/exceldatanilai/' . $idkelas . '/' . $idsemester) ?>" class="btn btn-primary btn-block" title="Cetak">Cetak Data Nilai</a>
                </div>
            <?php } ?>
        </div>
    </div>

</div>