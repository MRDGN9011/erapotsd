<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>

        </div>
        <div class="card-body">
            <h6>Cari Data</h6>
            <form method="get" action="<?= site_url('guru/datanilai') ?>">
                <table width="100%">
                    <tr>
                        <th width="15%">Kelas</th>
                        <th>:</th>
                        <th>
                            <select name="idkelas" class="form-control" required>
                                <?php if ($idkelas) { ?>
                                    <option value="<?= $idkelas ?>"><?= $namakelas ?></option>
                                <?php } else { ?>
                                    <option value="">Pilih</option>
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
                                    <option value="">Pilih</option>
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
                        <tr>
                            <th>Mapel</th>
                            <th>:</th>
                            <th><?= $namamapel ?></th>
                        </tr>
                    </table>
                    <hr>
                    <table class="table table-bordered" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Siswa</th>
                                <th colspan="3">Nilai Akhir</th>
                                <th rowspan="2">Total Nilai</th>
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
                            $nilai_tertinggi = 0;
                            $nilai_terendah = 0;
                            $rata_nilai = 0;
                            $total = 0;
                            $min = $this->db->query("SELECT min(a.total_nilai) as nilai_min FROM detail_nilai a, mapel b, siswa c where a.id_mapel=b.id_mapel and a.id_siswa=c.id_siswa and a.id_mapel='$idmapel' and a.id_kelas='$idkelas' and a.id_semester='$idsemester'")->row();
                            $max = $this->db->query("SELECT max(a.total_nilai) as nilai_max FROM detail_nilai a, mapel b, siswa c where a.id_mapel=b.id_mapel and a.id_siswa=c.id_siswa and a.id_mapel='$idmapel' and a.id_kelas='$idkelas' and a.id_semester='$idsemester'")->row();
                            $nilai = $this->db->query("SELECT * FROM detail_nilai a, mapel b, siswa c where a.id_mapel=b.id_mapel and a.id_siswa=c.id_siswa and a.id_mapel='$idmapel' and a.id_kelas='$idkelas' and a.id_semester='$idsemester'");
                            foreach ($nilai->result() as $n) {
                                $nilai_tertinggi =  $max->nilai_max;
                                $nilai_terendah =  $min->nilai_min;
                                $total = $total + $n->total_nilai;
                                $rata_nilai =  $total / $no; ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $n->nama_siswa ?></td>
                                    <td>
                                        <?= $n->nilai_tugas ?>
                                    </td>
                                    <td>
                                        <?= $n->nilai_uts ?>
                                    </td>
                                    <td>
                                        <?= $n->nilai_uas ?>
                                    </td>
                                    <td>
                                        <?= $n->total_nilai ?>
                                        <hr>
                                        <?= $n->deskripsi_nilai ?>
                                    </td>
                                    <td>
                                        <?= $n->absen_sakit ?>
                                    </td>
                                    <td>
                                        <?= $n->absen_izin ?>
                                    </td>
                                    <td>
                                        <?= $n->absen_alfa ?>
                                    </td>
                                    <td>
                                        <?= $n->nilai_keterampilan ?>
                                        <hr>
                                        <?= $n->deskripsi_nilai_keterampilan ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('guru/formeditnilai/' . $n->id_siswa . '/' . $idkelas . '/' . $idsemester) ?>" name="simpan" class="btn btn-primary btn-sm" title="Update">Update</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="11">Nilai Tertinggi : <?= $nilai_tertinggi ?></td>
                                </tr>
                                <tr>
                                    <td colspan="11">Nilai Terendah : <?= $nilai_terendah ?></td>
                                </tr>
                                <tr>
                                    <td colspan="11">Rata-rata : <?= $rata_nilai ?></td>
                                </tr>
                        <?php
                                $no++;
                            }
                        } ?>

                        </tbody>

                    </table>
                </div>
        </div>
    </div>