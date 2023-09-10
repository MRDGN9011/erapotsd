<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>

            <a href="<?= site_url('admin/formtambahguru') ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-600">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="8%">Foto</th>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Berikan Mapel</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($guru as $key) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><a target="_blank" href="<?= base_url('assets/image/fotoguru/' . $key->foto_guru) ?>"><img width="100%" src="<?= base_url('assets/image/fotoguru/' . $key->foto_guru) ?>"></a></td>
                                <td><?php echo $key->nip; ?></td>
                                <td><?php echo $key->nama_guru; ?></td>

                                <td style="text-align:center;">
                                    <?php $mapelguru = $this->db->query("SELECT * FROM detail_mapel_guru a, mapel b, guru c where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and a.id_guru='$key->id_guru' order by a.id_detail_mapel_guru desc limit 1")->row(); ?>
                                    <?php if ($mapelguru) { ?>
                                        <button type="button" class="badge badge-info" data-toggle="modal" style="font-size: 20px; " data-target="#edit<?= $key->id_guru ?>" title="Update Mapel"><?= $mapelguru->mapel ?></button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#edit<?= $key->id_guru ?>"><i class="fa fa-check"></i> Berikan Mapel</button>
                                    <?php } ?>
                                    <div id="edit<?= $key->id_guru ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Berikan Mapel</h4>

                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                </div>
                                                <form role="form" method="POST" action="<?php echo site_url('admin/berikanmapel/' . $key->id_guru) ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <span>Mapel</span>
                                                            <select class="form-control" placeholder="mapel" value="" name="id_mapel" required><br>
                                                                <option value="">Pilih Mapel</option>
                                                                <?php foreach ($mapel as $k) { ?>
                                                                    <option value="<?= $k->id_mapel ?>"><?= $k->mapel ?></option>
                                                                <?php } ?>
                                                            </select><br>
                                                      <div class="modal-footer">
                                                        <button class="btn btn-light" data-dismiss="modal">Batal</button>
                                                        <input type="submit" class="btn btn-primary" value="Proses">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?= $key->jabatan ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/detailguru/' . $key->id_guru) ?>" class=" btn btn-primary btn-circle btn-sm" title="Lihat"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo site_url('admin/formeditguru/' . $key->id_guru) ?>" class=" btn btn-info btn-circle btn-sm" title="Edit"><i class="fa fa-pen"></i></a>
                                <a href="<?php echo site_url('admin/hapusguru/' . $key->id_guru) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')" class=" btn btn-danger btn-circle btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                            </td>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>