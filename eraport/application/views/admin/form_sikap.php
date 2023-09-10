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
                <table class="" width="100%" cellspacing="0" style="text-align: center;">
                    <thead>

                    </thead>
                    <tbody>
                       <form action="<?= $action ?>" method="post">
                        <tr><th>Integritas</th></tr>
                        <tr><th><input type="text" value="<?= $integritas ?>" class="form-control" name="integritas"></th></tr>
                        <tr><th>Religius</th></tr>
                        <tr><th><input type="text" value="<?= $religius ?>" class="form-control" name="religius"></th></tr>
                        <tr><th>Nasionalis</th></tr>
                        <tr><th><input type="text" value="<?= $nasionalis ?>" class="form-control" name="nasionalis"></th></tr>
                        <tr><th>Mandiri</th></tr>
                        <tr><th><input type="text" value="<?= $mandiri ?>" class="form-control" name="mandiri"></th></tr>
                        <tr><th>Gotong Royong</th></tr>
                        <tr><th><input type="text" value="<?= $gotongroyong ?>" class="form-control"  name="gotongroyong"></th></tr>
                        <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                        <input type="hidden" name="id_semester" value="<?= $id_semester ?>">
                        <?php 
                        $sikap = $this->db->query("SELECT * FROM nilai_sikap where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_semester='$id_semester'");
                        if ($sikap->num_rows() > 0) {?>
                            <input type="hidden" name="id_nilai_sikap" value="<?= $id_nilai_sikap ?>">
                        <?php } ?>
                            <input type="hidden" name="id_siswa" value="<?= $id_siswa ?>">
                            <tr><th> <button type="submit" class="btn btn-primary mt-2 btn-block"><?= $button ?></button></th></tr>
                        </form>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>