<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <h6>Keterangan</h6>
            <table>
                <tr>
                    <th>Kelas</th>
                    <th>:</th>
                    <th><?= $kelas->kelas ?></th>
                </tr>
                <tr>
                    <th>Semester</th>
                    <th>:</th>
                    <th><?= $kelas->semester ?></th>
                </tr>
                <tr>
                    <th>Tahun Ajaran</th>
                    <th>:</th>
                    <th><?= $kelas->tahun_ajaran ?></th>
                </tr>
            </table>
            <hr>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>TTL</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($siswa as $key) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?php echo $key->nis; ?></td>
                                <td><?php echo $key->nama_siswa; ?></td>
                                <td><?php echo $key->jenis_kelamin; ?></td>
                                <td><?php echo $key->tempat_lahir . '/' . $key->tgl_lahir; ?></td>
                                <td style="text-align:center;">
                                    <?php
                                    $nilaisiswa = $this->db->query("SELECT * FROM detail_nilai where id_siswa='$key->id_siswa' and id_kelas='$kelas->id_kelas' and id_semester='$kelas->id_semester'")->num_rows();
                                    $nilaisikap = $this->db->query("SELECT * FROM nilai_sikap where id_siswa='$key->id_siswa' and id_kelas='$kelas->id_kelas' and id_semester='$kelas->id_semester'")->num_rows();
                                    if ($nilaisiswa > 0) { ?>
                                        <a href="<?php echo site_url('admin/formeditnilai/' . $key->id_siswa . '/' . $kelas->id_kelas . '/' . $kelas->id_semester) ?>" class=" btn btn-primary btn-sm" title="Lihat Nilai"><i class="fa fa-eye"></i> Lihat Nilai</a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('admin/formtambahnilai/' . $key->id_siswa . '/' . $kelas->id_kelas . '/' . $kelas->id_semester) ?>" class=" btn btn-primary btn-sm" title="Berikan Nilai"><i class="fa fa-list"></i> Beri Nilai</a>
                                    <?php } ?>
                                    <?php if ($nilaisikap > 0) { ?>
                                        <a href="<?php echo site_url('admin/formeditsikap/' . $key->id_siswa . '/' . $kelas->id_kelas . '/' . $kelas->id_semester) ?>" class=" btn btn-secondary btn-sm" title="Lihat Nilai"><i class="fa fa-eye"></i> Lihat Sikap</a>
                                    <?php }else { ?>
                                        <a href="<?php echo site_url('admin/formtambahsikap/' . $key->id_siswa . '/' . $kelas->id_kelas . '/' . $kelas->id_semester) ?>" class=" btn btn-secondary btn-sm" title="Berikan Nilai"><i class="fa fa-plus"></i> Nilai Sikap</a>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>