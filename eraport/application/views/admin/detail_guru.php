<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Guru</h6>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Biodata Guru</h4>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Foto </th>
                                    <th> : </th>
                                    <td><a target="_blank" href="<?= base_url('assets/image/fotoguru/' . $foto_guru) ?>"><img width="20%" src="<?= base_url('assets/image/fotoguru/' . $foto_guru) ?>"></a></td>
                                </tr>
                                <tr>
                                    <th>NIP </th>
                                    <th> : </th>
                                    <td><?php echo $nip; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Guru</th>
                                    <th> : </th>
                                    <td><?php echo $nama_guru; ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <th> : </th>
                                    <td><?php echo $jk_guru; ?></td>
                                </tr>
                                <tr>
                                    <th>Tgl Lahir</th>
                                    <th> : </th>
                                    <td><?php echo $tgl_lahir_guru; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th> : </th>
                                    <td><?php echo $alamat_guru; ?></td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <th> : </th>
                                    <td><?php echo $telp_guru; ?></td>
                                </tr>
                            </thead>
                        </table>

                    </div>
                    <div class="col-md-6">
                        <h4>Informasi Kedinasan</h4>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mengampu Mapel</th>
                                    <th> : </th>
                                    <td><?php echo $mapel; ?></td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Terakhir</th>
                                    <th> : </th>
                                    <td><?php echo $pend_terakhir; ?></td>
                                </tr>
                                <tr>
                                    <th>Golongan</th>
                                    <th> : </th>
                                    <td><?php echo $gol; ?></td>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <!-- <?php
                                        if ($orangtua == 0) { ?>
                                    <a href="<?= site_url('admin/formtambahorangtua/' . $id_siswa) ?>" class="btn btn-info">Tambah Data Orang Tua/Wali</a> |
                                <?php } else { ?>
                                    <a href="<?= site_url('admin/formeditorangtua/' . $id_siswa) ?>" class="btn btn-info">Data Orang Tua/Wali</a> |
                                <?php } ?> -->

                                <a href="<?= site_url('admin/guru') ?>" class="btn btn-danger">Kembali</a>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>