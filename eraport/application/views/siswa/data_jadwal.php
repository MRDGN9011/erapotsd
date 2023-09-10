<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jadwal</h6>
        </div>
        <div class="card-body">
            <?php
            if (empty($kelas) || empty($semester) || empty($tahun_ajaran)) {
                echo "Jadwal Belum Keluar";
            } else {
                echo 'Kelas: ' . $kelas . '<br>';
                echo 'Semester: ' . $semester . '<br>';
                echo 'Tahun Ajaran: ' . $tahun_ajaran . '<br>';
            }
            ?>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Hari</th>
                            <th>Jam Masuk</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($jadwal as $key) {
                            ?>
                            <tr>
                                <th><?php echo $no++; ?></th>
                                <td><?php echo $key->mapel; ?></td>
                                <td><?php echo $key->hari; ?></td>
                                <td><?php echo $key->jam_masuk; ?></td>
                                <td><?php echo $key->jam_selesai; ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<div id="tambah" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Tambah Data Jadwal</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <form role="form" method="POST" action="<?php echo site_url('admin/tambahjadwal') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <span>Mapel</span>
                        <select class="form-control" placeholder="Mapel" value="" name="id_mapel" required><br>
                            <option value="">Pilih Mapel</option>
                            <?php foreach ($mapel as $m) { ?>
                                <option value="<?= $m->id_mapel ?>"><?= $m->mapel ?></option>
                            <?php } ?>
                        </select><br>
                        <span>Kelas</span>
                        <select class="form-control" placeholder="Kelas" value="" name="id_kelas" required><br>
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($kelas as $k) { ?>
                                <option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
                            <?php } ?>
                        </select><br>
                        <span>Hari</span>
                        <select class="form-control" placeholder="Hari" value="" name="hari" required><br>
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select><br>
                        <span>Jam Masuk</span>
                        <input type="time" class="form-control" placeholder="Jam Masuk" value="" name="jam_masuk" required><br>
                        <span>Jam Selesai</span>
                        <input type="time" class="form-control" placeholder="Jam Selesai" value="" name="jam_selesai" required><br>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-light" data-dismiss="modal">Batal</button>
                            <input type="submit" class="btn btn-primary" value="Tambah">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>