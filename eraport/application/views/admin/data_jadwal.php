<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jadwal</h6>
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
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Jam Masuk</th>
                            <th>Jam Selesai</th>
                            <th>Terapkan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($jadwal->result() as $key) {
                            ?>
                            <tr>
                                <th><?php echo $no++; ?></th>
                                <td><?php echo $key->mapel; ?></td>
                                <td><?php echo $key->nama_guru; ?></td>
                                <td><?php echo $key->kelas; ?></td>
                                <td><?php echo $key->hari; ?></td>
                                <td><?php echo $key->jam_masuk; ?></td>
                                <td><?php echo $key->jam_selesai; ?></td>
                                <td>
                                    <label class="switch">
                                        <?php
                                        $detail = "";
                                        $detail = $this->db->query("SELECT a.id_jadwal FROM detail_jadwal_kelas a, jadwal b, kelas c where a.id_jadwal=b.id_jadwal and a.id_kelas=c.id_kelas and a.id_jadwal = '$key->id_jadwal'")->num_rows(); ?>
                                        <input type="checkbox" <?php if ($detail != 0) echo "checked" ?> onclick="if (event.target.checked)return window.location = '<?= base_url('admin/terapkanjadwal/' . $key->id_jadwal) ?>';else return window.location = '<?= base_url('admin/tidakterapkanjadwal/' . $key->id_jadwal) ?>';">
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <td>
                                    <?php $mapel = $key->id_mapel; ?>
                                    <?php $guru = $this->db->query("SELECT * FROM detail_mapel_guru a,guru b where id_mapel='$key->id_mapel' and a.id_guru=b.id_guru")->result_array() ?>
                                    <button type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="modal" data-target="#edit<?= $key->id_jadwal ?>" title="Edit"><i class="fa fa-pen"></i></button>
                                    <div id="edit<?= $key->id_jadwal ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Edit Data Jadwal</h4>
                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                </div>
                                                <form role="form" method="POST" action="<?php echo site_url('admin/editjadwal/' . $key->id_jadwal) ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <span>Mapel</span>
                                                            <select class="form-control" placeholder="Mapel" value="" name="id_mapel" required><br>
                                                                <?php if ($key->id_mapel) { ?>
                                                                    <option value="<?= $key->id_mapel ?>"><?= $key->mapel ?></option>
                                                                <?php } else { ?>
                                                                    <option value="">Pilih Mapel</option>
                                                                <?php } ?>
                                                                <?php foreach ($mapel as $m) { ?>
                                                                    <option value="<?= $m->id_mapel ?>"><?= $m->mapel ?></option>
                                                                <?php } ?>
                                                            </select><br>
                                                            <span>Kelas</span>
                                                            <select class="form-control" placeholder="Kelas" value="" name="id_kelas" required><br>
                                                                <?php if ($key->id_kelas) { ?>
                                                                    <option value="<?= $key->id_kelas ?>"><?= $key->kelas ?></option>
                                                                <?php } else { ?>
                                                                    <option value="">Pilih Kelas</option>
                                                                <?php } ?>
                                                                <?php foreach ($kelas as $k) { ?>
                                                                    <option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
                                                                <?php } ?>
                                                            </select><br>
                                                            <span>Hari</span>
                                                            <select class="form-control" placeholder="Hari" value="" name="hari" required><br>
                                                                <?php if ($key->hari) { ?>
                                                                    <option value="<?= $key->hari ?>"><?= $key->hari ?></option>
                                                                <?php } else { ?>
                                                                    <option value="">Pilih Hari</option>
                                                                <?php } ?>
                                                                <option value="Senin">Senin</option>
                                                                <option value="Selasa">Selasa</option>
                                                                <option value="Rabu">Rabu</option>
                                                                <option value="Kamis">Kamis</option>
                                                                <option value="Jumat">Jumat</option>
                                                                <option value="Sabtu">Sabtu</option>
                                                            </select><br>
                                                            <span>Jam Masuk</span>
                                                            <input type="time" class="form-control" placeholder="Jam Masuk" value="<?= $key->jam_masuk ?>" name="jam_masuk" required><br>
                                                            <span>Jam Selesai</span>
                                                            <input type="time" class="form-control" placeholder="Jam Selesai" value="<?= $key->jam_selesai ?>" name="jam_selesai" required><br>
                                                            <br>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-light" data-dismiss="modal">Batal</button>
                                                                <input type="submit" class="btn btn-primary" value="Update">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="modal" data-target="#guru<?= $key->id_jadwal ?>" title="Edit"><i class="fa fa-user"></i></button>
                                    <div id="guru<?= $key->id_jadwal ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Edit Guru Pengajar</h4>
                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                </div>
                                                <form role="form" method="POST" action="<?php echo site_url('admin/editgurujadwal/' . $key->id_jadwal) ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <span>Mapel</span>
                                                            <input type="text" readonly="" name="id_mapel" class="form-control" value="<?= $key->mapel ?>"><br>
                                                            <span>Kelas</span>
                                                            <input type="text" readonly="" name="id_kelas" class="form-control" value="<?= $key->kelas ?>"><br>
                                                            <span>Hari</span>
                                                            <input type="text" readonly="" name="hari" class="form-control" value="<?= $key->hari ?>"><br>
                                                            <span>Jam Masuk</span>
                                                            <input type="text" readonly="" name="jam_masuk" class="form-control" value="<?= $key->jam_masuk ?>"><br>
                                                            <span>Jam Selesai</span>
                                                            <input type="text" readonly="" name="jam_selesai" class="form-control" value="<?= $key->jam_selesai ?>"><br>
                                                            <span>Guru</span>
                                                            <select name="id_detail_mapel_guru" class="form-control" required="" id="">
                                                                <option value="">Pilih Guru</option>
                                                                <?php foreach ($guru as $g) { ?>
                                                                    <option value="<?= $g['id_detail_mapel_guru'] ?>"><?= $g['nama_guru'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <br>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-light" data-dismiss="modal">Batal</button>
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
                                        <a href="<?php echo site_url('admin/hapusjadwal/' . $key->id_jadwal) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')" class=" btn btn-danger btn-circle btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
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

                <h4 class="modal-title">Tambah Data Jadwal</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <form role="form" method="POST" action="<?php echo site_url('admin/tambahjadwal') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <span>Mapel</span>
                        <select class="form-control" placeholder="Mapel" value="" name="id_mapel" required><br>
                            <?php $mapel = $this->db->query('SELECT * FROM mapel order by id_mapel asc')->result(); ?>
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