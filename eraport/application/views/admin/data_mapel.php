<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mapel</h6>
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
                            <th>Mapel</th>
                            <th>KKM</th>
                            <th>Kode</th>
                            <th>Golongan</th>
                            <th>Sub Muatan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($mapel->result() as $key) {
                        ?>
                            <tr>
                                <th><?php echo $no++; ?></th>
                                <td><?php echo $key->mapel; ?></td>
                                <td><?php echo $key->kkm; ?></td>
                                <td><?php echo $key->kode_mapel; ?></td>
                                <td><?php echo $key->golongan; ?></td>
                                <td><?php echo $key->sub_muatan; ?></td>
                                <!-- <td>
                                <label class="switch">
                                <input type="checkbox" <?php if ($key->status_admin == "aktif") echo "checked" ?> onclick="if (event.target.checked)return window.location = '<?= base_url('admin/aktifkan/' . $key->id_admin) ?>';else return window.location = '<?= base_url('admin/block/' . $key->id_admin) ?>';" >
                                <span class="slider round"></span>
                                </label>          
                                </td> -->

                                <td>

                                    <button type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="modal" data-target="#edit<?= $key->id_mapel ?>" title="Edit"><i class="fa fa-pen"></i></button>
                                    <div id="edit<?= $key->id_mapel ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Edit Data Mapel</h4>
                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                </div>
                                                <form role="form" method="POST" action="<?php echo site_url('admin/editMapel/' . $key->id_mapel) ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <span>Mapel</span>
                                                            <input class="form-control" placeholder="Mapel" value="<?= $key->mapel ?>" name="mapel" required><br>
                                                            <span>KKM</span>
                                                            <input class="form-control" placeholder="KKM" value="<?= $key->kkm ?>" name="kkm" required><br>
                                                            <span>Kode</span>
                                                            <input class="form-control" placeholder="Kode" value="<?= $key->kode_mapel ?>" name="kode_mapel" required><br>
                                                            <span>Golongan</span>
                                                            <input class="form-control" placeholder="Golongan" value="<?= $key->golongan ?>" name="golongan" required><br>
                                                            <span>Sub Muatan <font color="red">*kosongi jika tidak ada</font></span>
                                                            <input class="form-control" placeholder="Sub Muatan" value="<?= $key->sub_muatan ?>" name="sub_muatan"><br>

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
                                        <a href="<?php echo site_url('admin/hapusMapel/' . $key->id_mapel) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')" class=" btn btn-danger btn-circle btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
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

                <h4 class="modal-title">Tambah Data Mapel</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <form role="form" method="POST" action="<?php echo site_url('admin/tambahMapel') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <span>Mapel</span>
                        <input class="form-control" placeholder="Mapel" value="" name="mapel" required><br>
                        <span>KKM</span>
                        <input class="form-control" placeholder="KKM" value="" name="kkm" required><br>
                        <span>Kode</span>
                        <input class="form-control" placeholder="Kode" value="" name="kode_mapel" required><br>
                        <span>Golongan</span>
                        <input class="form-control" placeholder="Golongan" value="" name="golongan" required><br>
                        <span>Sub Muatan <font color="red">*kosongi jika tidak ada</font></span>
                        <input class="form-control" placeholder="Sub Muatan" value="" name="sub_muatan"><br>
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