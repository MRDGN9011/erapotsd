<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Nilai Raport</h6>

        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>
            <h6>Keterangan</h6>
            <table>
    <?php foreach ($kelas as $key => $k) { ?>
        <tr>
            <th>Kelas</th>
            <th>:</th>
            <th><?= $k->kelas ?></th>
        </tr>
        <tr>
            <th>Semester</th>
            <th>:</th>
            <th><?= $k->semester ?></th>
        </tr>
        <tr>
            <th>Tahun Ajaran</th>
            <th>:</th>
            <th><?= $k->tahun_ajaran ?></th>
        </tr>
        <?php break; ?>
    <?php } ?>
</table>
            <font color='red'>*penting: pada kolom nilai teradpat P = 'Pengetahuan' dan K = 'Keterampilan'</font>
            <hr>
            <!-- <a href="<?= site_url('admin/formtambahsiswa') ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-600">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
            <br><br> -->
            <div>
                <table class="table table-bordered" width="100%" cellspacing="0" style="text-align: center;">
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
                            <th rowspan="3">Opsi</th>
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
                        <form method="post" action="<?= site_url('admin/konfirmasi_rangking/' . $k->id_kelas . '/' . $k->id_semester) ?>">

                            <?php
                            $no = 1;
                            foreach ($nilai as $key) {
                                $sakit = $this->db->query("select sum(absen_sakit) as sakit from detail_nilai where id_siswa='$key->id_siswa'")->row();
                                $izin = $this->db->query("select sum(absen_izin) as izin from detail_nilai where id_siswa='$key->id_siswa'")->row();
                                $alfa = $this->db->query("select sum(absen_alfa) as alfa from detail_nilai where id_siswa='$key->id_siswa'")->row();
                                $rangking = $this->db->query("select * from nilai where id_kelas = '$k->id_kelas' and id_semester = '$k->id_semester' order by rata_rata_gabungan desc")->result();
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
                                    <td>
                                        <a href="<?= site_url('admin/detailraport/' . $key->id_siswa . '/' . $k->id_kelas . '/' . $k->id_semester) ?>" class="btn btn-success btn-sm" title="Lihat">Raport Kompetensi</a>
                                        <a href="<?= site_url('admin/detailraportsikap/' . $key->id_siswa . '/' . $k->id_kelas . '/' . $k->id_semester) ?>" class="btn btn-warning btn-sm" title="Lihat">Raport Sikap</a>
                                    </td>
                                </tr>

                            <?php
                                $no++;
                            } ?>

                    </tbody>
                </table>
                <input type="submit" name="" class="btn btn-primary btn-block" title="Konfirmasi" value="Konfirm Ranking">
                </form>
            </div>
        </div>
    </div>

</div>