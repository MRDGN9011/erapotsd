<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Semester</h6>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>

            <button type="button" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-600">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </button>
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
                        <?php $no = 1;
                        foreach ($semester->result() as $key) {
                        ?>
                            <tr>
                                <th><?php echo $no++; ?></th>
                                <td><?php echo $key->semester; ?></td>
                                <td><?php echo $key->tahun_ajaran; ?></td>
                                <!-- <td>
                        <label class="switch">
<input type="checkbox" <?php if ($key->status_admin == "aktif") echo "checked" ?> onclick="if (event.target.checked)return window.location = '<?= base_url('admin/aktifkan/' . $key->id_admin) ?>';else return window.location = '<?= base_url('admin/block/' . $key->id_admin) ?>';" >
<span class="slider round"></span>
</label>
                           
                            
                        </td> -->

                                <td>

                                    <button type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="modal" data-target="#edit<?= $key->id_semester ?>" title="Edit"><i class="fa fa-pen"></i></button>
                                    <div id="edit<?= $key->id_semester ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Edit Data Semester</h4>
                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                </div>
                                                <form role="form" method="POST" action="<?php echo site_url('admin/editsemester/' . $key->id_semester) ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <span>Semester</span>
                                                            <input class="form-control" placeholder="Semester" value="<?= $key->semester ?>" name="semester" required><br>
                                                            <span>Tahun Ajaran</span>
                                                            <input class="form-control" placeholder="Tahun Ajaran" value="<?= $key->tahun_ajaran ?>" name="tahun_ajaran" required><br>

                                                            <div class="modal-footer">
                                                                <button class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                <input type="submit" class="btn btn-primary" value="Update">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($this->session->id_user == 1) {
                                    } else { ?>
                                        <a href="<?php echo site_url('admin/hapussemester/' . $key->id_semester) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')" class=" btn btn-danger btn-circle btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </td>

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

                <h4 class="modal-title">Tambah Data Semester</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <form role="form" method="POST" action="<?php echo site_url('admin/tambahsemester') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <span>Semester</span>
                        <input class="form-control" placeholder="Semester" value="" name="semester" required><br>
                        <span>Tahun Ajaran</span>
                        <input class="form-control" placeholder="Tahun Ajaran" value="" name="tahun_ajaran" required><br>
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