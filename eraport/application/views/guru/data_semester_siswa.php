<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kelola Nilai</h6>
            <h6 class="m-0 font-weight-bold text-primary">Pilih Semester</h6>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>

            <!-- <button type="button" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-600">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </button> -->
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($semester as $key) {
                        ?>
                            <tr>
                                <th><?php echo $i++; ?></th>
                                <td><?php echo $key->semester; ?></td>
                                <td><?php echo $key->tahun_ajaran; ?></td>

                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $key->id_semester ?>" title="Cari"><i class="fa fa-search"></i> Cari Kelas</button>
                                    <div id="edit<?= $key->id_semester ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Cari Kelas</h4>
                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                </div>

                                                <table>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kelas</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                    <tbody>
                                                        <?php $no = 1;
                                                        foreach ($kelas as $k) {
                                                            if ($k->semester == $key->semester) {
                                                        ?>
                                                                <tr>
                                                                    <th><?php echo $no++; ?></th>
                                                                    <td><?php echo $k->kelas; ?></td>
                                                                    <td><a href="<?= site_url('guru/siswakelas/' . $k->id_kelas) ?>" class="btn btn-success btn-xs">Pilih</a></td>
                                                                </tr>
                                                        <?php }
                                                        } ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>