<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>

            <a href="<?= site_url('admin/formtambahsiswa') ?>" class="btn btn-primary btn-icon-split">
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
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>TTL</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($siswa as $key) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><a target="_blank" href="<?= base_url('assets/image/fotosiswa/' . $key->foto) ?>"><img width="100%" src="<?= base_url('assets/image/fotosiswa/' . $key->foto) ?>"></a></td>
                                <td><?php echo $key->nis; ?></td>
                                <td><?php echo $key->nisn; ?></td>
                                <td><?php echo $key->nama_siswa; ?></td>
                                <td><?php echo $key->tempat_lahir . '/' . $key->tgl_lahir; ?></td>
                                <td style="text-align:center;">
                                    <?php $kelassiswa = $this->db->query("SELECT * FROM detail_kelas_siswa a, siswa b, kelas c, semester d where a.id_siswa=b.id_siswa and a.id_kelas=c.id_kelas and a.id_semester=d.id_semester and a.id_siswa='$key->id_siswa' order by a.id_detail_kelas_siswa desc limit 1")->row(); ?>
                                    <?php if ($kelassiswa) { ?>
                                        <button type="button" class="badge badge-success" data-toggle="modal" style="font-size: 20px; " data-target="#edit<?= $key->id_siswa ?>" title="Update Kelas"><?= $kelassiswa->kelas . '/' . $kelassiswa->semester . '/' . $kelassiswa->tahun_ajaran ?></button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#edit<?= $key->id_siswa ?>"><i class="fa fa-check"></i> Berikan Kelas</button>
                                    <?php } ?>
                                    <div id="edit<?= $key->id_siswa ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">Berikan Kelas</h4>

                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                </div>
                                                <?php $kelasnya = $this->db->query("select * from detail_kelas_siswa a, kelas b, semester c where a.id_kelas=b.id_kelas and a.id_semester=c.id_semester and a.id_siswa ='$key->id_siswa'");
                                                // if ($kelasnya->num_rows() == 0) {
                                                //     $act = site_url('admin/berikankelas/' . $key->id_siswa);
                                                // } else {
                                                //     $act = site_url('admin/berikankelasupdate/' . $key->id_siswa);
                                                // }
                                                ?>
                                                <form role="form" method="POST" action="<?= site_url('admin/berikankelas/' . $key->id_siswa) ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <span>Kelas</span>
                                                            <select class="form-control" placeholder="Kelas" value="" name="id_kelas" required><br>
                                                                <?php if ($kelasnya->row()->id_kelas) { ?>
                                                                    <option value="<?= $kelasnya->row()->id_kelas ?>"><?= $kelasnya->row()->kelas ?></option>
                                                                <?php } else { ?>
                                                                    <option value="">Pilih Kelas</option>
                                                                <?php } ?>
                                                                <?php foreach ($kelas as $k) { ?>
                                                                    <option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
                                                                <?php } ?>
                                                            </select><br>
                                                            <span>Keterangan</span>
                                                            <select class="form-control" name="keterangan" required><br>
                                                                <?php if ($kelasnya->row()->id_kelas) { ?>
                                                                    <option value="<?= $kelasnya->row()->keterangan ?>"><?= $kelasnya->row()->keterangan ?></option>
                                                                <?php } else { ?>
                                                                    <option value="">Pilih</option>
                                                                <?php } ?>
                                                                <option value="Kelas Awal">Kelas Awal</option>
                                                                <option value="Pindah Kelas">Pindah Kelas</option>
                                                                <option value="Naik Kelas">Naik Kelas</option>
                                                                <option value="Tinggal Kelas">Tinggal Kelas</option>
                                                            </select><br>
                                                            <span>Semester</span>
                                                            <select class="form-control" placeholder="Kelas" value="" name="id_semester" required><br>
                                                                <?php if ($kelasnya->row()->id_kelas) { ?>
                                                                    <option value="<?= $kelasnya->row()->id_semester ?>"><?= $kelasnya->row()->semester ?></option>
                                                                <?php } else { ?>
                                                                    <option value="">Pilih Semester</option>
                                                                <?php } ?>
                                                                <?php foreach ($semester as $s) { ?>
                                                                    <option value="<?= $s->id_semester ?>"><?= $s->semester . '/' . $s->tahun_ajaran ?></option>
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
                                <td><?php echo $key->status; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/detailsiswa/' . $key->id_siswa) ?>" class=" btn btn-primary btn-circle btn-sm" title="Lihat"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo site_url('admin/formeditsiswa/' . $key->id_siswa) ?>" class=" btn btn-info btn-circle btn-sm" title="Edit"><i class="fa fa-pen"></i></a>
                                    <a href="<?php echo site_url('admin/hapussiswa/' . $key->id_siswa) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')" class=" btn btn-danger btn-circle btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                                </td>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>