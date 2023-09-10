<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Nilai</h6>

        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>
            <h6>Keterangan</h6>
            <table>
                <tr>
                    <th>Nama Siswa</th>
                    <th>:</th>
                    <th><?= $nama_siswa ?></th>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <th>:</th>
                    <th><?= $kelas ?></th>
                </tr>
                <tr>
                    <th>Semester</th>
                    <th>:</th>
                    <th><?= $semester ?></th>
                </tr>
                <tr>
                    <th>Tahun Ajaran</th>
                    <th>:</th>
                    <th><?= $tahun_ajaran ?></th>
                </tr>
                <tr>
                    <th>Mapel</th>
                    <th>:</th>
                    <th><?= $namamapel ?></th>
                </tr>
            </table>
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
                            <th rowspan="2">No</th>
                            <th rowspan="2">Mapel</th>
                            <th colspan="3">Nilai Akhir</th>
                            <th rowspan="2">Total Nilai<br><span style="color: red;">(auto terisi setelah simpan)</span></th>
                            <th colspan="3">Absensi</th>
                            <th rowspan="2">Nilai Keterampilan</th>
                            <th rowspan="2">Opsi</th>
                        </tr>
                        <tr>
                            <th>Nilai Tugas (30%)</th>
                            <th>Nilai UTS (30%)</th>
                            <th>Nilai UAS (40%)</th>
                            <th>SAKIT</th>
                            <th>IZIN</th>
                            <th>ALFA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $jumlah_data = 0;
                        $total_keseluruhan_nilai = 0;
                        $total_keseluruhan_nilai_keterampilan = 0;
                        $total_nilai_gabungan = 0;
                        $rata_nilai = 0;
                        $rata_nilai_keterampilan = 0;
                        $rata_nilai_gabungan = 0;
                        foreach ($mapel as $key) {
                            if ($key->id_guru == $this->session->id_guru) {
                                $idmapel = $key->id_mapel;
                        ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?php echo $key->mapel . '<hr> Pengampu:' . $key->nama_guru; ?></td>
                                    <?php
                                    $nilai = $this->db->query("SELECT * FROM detail_nilai a, mapel b where a.id_mapel=b.id_mapel and a.id_mapel='$idmapel' and a.id_siswa='$id_siswa' and a.id_kelas='$id_kelas' and a.id_semester='$id_semester'");
                                    if ($nilai->num_rows() > 0) {
                                        foreach ($nilai->result() as $n) { ?>
                                            <form method="post" action="<?= site_url('guru/update_nilai_act') ?>">
                                                <td>
                                                    <input name="nilai_tugas" class="form-control" value="<?= $n->nilai_tugas ?>">
                                                </td>
                                                <td>
                                                    <input name="nilai_uts" class="form-control" value="<?= $n->nilai_uts ?>">
                                                </td>
                                                <td>
                                                    <input name="nilai_uas" class="form-control" value="<?= $n->nilai_uas ?>">
                                                </td>
                                                <td>
                                                    <input name="total_nilai" class="form-control" value="<?= $n->total_nilai ?>" readonly>
                                                    <hr>
                                                    <textarea class="form-control" placeholder="Deskripsi Nilai" name="deskripsi_nilai" title="Deskripsi Nilai"><?= $n->deskripsi_nilai ?></textarea><br>
                                                </td>
                                                <td>
                                                    <input name="absen_sakit" class="form-control" value="<?= $n->absen_sakit ?>">
                                                </td>
                                                <td>
                                                    <input name="absen_izin" class="form-control" value="<?= $n->absen_izin ?>">
                                                </td>
                                                <td>
                                                    <input name="absen_alfa" class="form-control" value="<?= $n->absen_alfa ?>">
                                                </td>
                                                <td>
                                                    <input name="nilai_keterampilan" class="form-control" value="<?= $n->nilai_keterampilan ?>">
                                                    <hr>
                                                    <textarea class="form-control" placeholder="Deskripsi Nilai Keterampilan" name="deskripsi_nilai_keterampilan" title="Deskripsi Nilai Keterampilan"><?= $n->deskripsi_nilai_keterampilan ?></textarea><br>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="id_mapel" value="<?= $key->id_mapel ?>">
                                                    <input type="hidden" name="id_guru" value="<?= $key->id_guru ?>">
                                                    <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                                                    <input type="hidden" name="id_semester" value="<?= $id_semester ?>">
                                                    <input type="hidden" name="id_detail_nilai" value="<?= $n->id_detail_nilai ?>">
                                                    <input type="hidden" name="id_siswa" value="<?= $n->id_siswa ?>">
                                                    <input type="submit" name="simpan" class="btn btn-primary btn-sm" title="Update" value="Update">
                                                </td>
                                            </form>
                                        <?php
                                        }
                                        $jumlah_data =  $no;
                                        $total_keseluruhan_nilai = $total_keseluruhan_nilai + $n->total_nilai;
                                        $total_keseluruhan_nilai_keterampilan = $total_keseluruhan_nilai_keterampilan + $n->nilai_keterampilan;
                                    } else { ?>
                                        <form method="post" action="<?= site_url('admin/tambah_nilai_act') ?>">
                                            <td>
                                                <input name="nilai_tugas" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input name="nilai_uts" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input name="nilai_uas" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input name="total_nilai" class="form-control" value="" readonly>
                                                <hr>
                                                <textarea class="form-control" placeholder="Deskripsi Nilai" name="deskripsi_nilai" title="Deskripsi Nilai"></textarea><br>
                                            <td>
                                                <input name="absen_sakit" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input name="absen_izin" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input name="absen_alfa" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input name="nilai_keterampilan" class="form-control" value="">
                                                <hr>
                                                <textarea class="form-control" placeholder="Deskripsi Nilai Keterampilan" name="deskripsi_nilai_keterampilan" title="Deskripsi Nilai Keterampilan"></textarea><br>
                                            </td>
                                            <td>
                                                <input type="hidden" name="id_mapel" value="<?= $key->id_mapel ?>">
                                                <input type="hidden" name="id_guru" value="<?= $key->id_guru ?>">
                                                <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                                                <input type="hidden" name="id_semester" value="<?= $id_semester ?>">
                                                <input type="hidden" name="id_siswa" value="<?= $id_siswa ?>">
                                                <input type="submit" name="simpan" class="btn btn-primary btn-sm" title="Simpan" value="Simpan">
                                            </td>
                                        </form>
                                    <?php } ?>
                                </tr>
                        <?php }
                            $no++;
                        } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>