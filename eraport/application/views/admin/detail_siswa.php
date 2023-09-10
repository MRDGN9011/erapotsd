<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Siswa</h6>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Biodata Siswa</h4>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Foto </th>
                                    <th> : </th>
                                    <td><a target="_blank" href="<?= base_url('assets/image/fotosiswa/' . $foto) ?>"><img width="20%" src="<?= base_url('assets/image/fotosiswa/' . $foto) ?>"></a></td>
                                </tr>
                                <tr>
                                    <th>NIS </th>
                                    <th> : </th>
                                    <td><?php echo $nis; ?></td>
                                </tr>
                                <tr>
                                    <th>NISN </th>
                                    <th> : </th>
                                    <td><?php echo $nisn; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th> : </th>
                                    <td><?php echo $nama_siswa; ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <th> : </th>
                                    <td><?php echo $jenis_kelamin; ?></td>
                                </tr>
                                <tr>
                                    <th>TTL</th>
                                    <th> : </th>
                                    <td><?php echo $tempat_lahir . '/' . $tgl_lahir; ?></td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <th> : </th>
                                    <td><?php echo $agama; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th> : </th>
                                    <td><?php echo $alamat; ?></td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <th> : </th>
                                    <td><?php echo $no_telp; ?></td>
                                </tr>
                                <!-- <tr>
                                    <th>Email</th>
                                    <th> : </th>
                                    <td><?php echo $email; ?></td>
                                </tr> -->
                                <tr>
                                    <th>Status Dalam Keluarga</th>
                                    <th> : </th>
                                    <td><?php echo $status_anak; ?></td>
                                </tr>
                                <tr>
                                    <th>Anak Ke</th>
                                    <th> : </th>
                                    <td><?php echo $anak_ke; ?></td>
                                </tr>
                            </thead>
                        </table>
                        <h4>Informasi Akademis</h4>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Asal Sekolah</th>
                                    <th> : </th>
                                    <td><?php echo $asal_sekolah; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Diterima</th>
                                    <th> : </th>
                                    <td><?php echo $tgl_diterima; ?></td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <th> : </th>
                                    <td><?php echo $kelas; ?></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6">

                        <h4>Berkas Siswa</h4>
                        <?php
                        if ($berkas) { ?>
                            <?php foreach ($berkas as $ber) {
                                $kk = $ber->kk;
                                $akta_lahir = $ber->akta_lahir;
                                $ijazah_sd = $ber->ijazah_sd;
                                $form_daftar = $ber->form_daftar;
                            } ?>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Kartu Keluarga</th>
                                        <th> : </th>
                                        <td>
                                            <form class="form" action="<?= site_url('admin/upload_kk/' . $id_siswa) ?>" method="post" enctype="multipart/form-data">
                                                <?php if ($kk) { ?>
                                                    <a target="_blank" href="<?= base_url('assets/image/berkassiswa/' . $kk) ?>"><img id="uploadPreview" width="15%" src="<?= base_url('assets/image/berkassiswa/' . $kk) ?>"></a>
                                                    <br><br>
                                                <?php } else { ?>
                                                    <img src="" id="uploadPreview" width="15%"><br><br>
                                                <?php } ?>
                                                <input id="upload" onchange="PreviewImage()" class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="kk">
                                                <input type="hidden" name="old" value="<?php echo $kk; ?>"><br>
                                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Akta Lahir</th>
                                        <th> : </th>
                                        <td>
                                            <form class="form" action="<?= site_url('admin/upload_akta_lahir/' . $id_siswa) ?>" method="post" enctype="multipart/form-data">
                                                <?php if ($akta_lahir) { ?>
                                                    <a target="_blank" href="<?= base_url('assets/image/berkassiswa/' . $akta_lahir) ?>"><img id="uploadPreview2" width="15%" src="<?= base_url('assets/image/berkassiswa/' . $akta_lahir) ?>"></a>
                                                    <br><br>
                                                <?php } else { ?>
                                                    <img src="" id="uploadPreview2" width="15%"><br><br>
                                                <?php } ?>
                                                <input id="upload2" onchange="PreviewImage2()" class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="akta_lahir">
                                                <input type="hidden" name="old" value="<?php echo $akta_lahir; ?>"><br>
                                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ijazah SD</th>
                                        <th> : </th>
                                        <td>
                                            <form class="form" action="<?= site_url('admin/upload_ijazah_sd/' . $id_siswa) ?>" method="post" enctype="multipart/form-data">
                                                <?php if ($ijazah_sd) { ?>
                                                    <a target="_blank" href="<?= base_url('assets/image/berkassiswa/' . $ijazah_sd) ?>"><img id="uploadPreview3" width="15%" src="<?= base_url('assets/image/berkassiswa/' . $ijazah_sd) ?>"></a>
                                                    <br><br>
                                                <?php } else { ?>
                                                    <img src="" id="uploadPreview3" width="15%"><br><br>
                                                <?php } ?>
                                                <input id="upload3" onchange="PreviewImage3()" class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="ijazah_sd">
                                                <input type="hidden" name="old" value="<?php echo $ijazah_sd; ?>"><br>
                                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Formulir Pendaftaran</th>
                                        <th> : </th>
                                        <td>
                                            <form class="form" action="<?= site_url('admin/upload_form_daftar/' . $id_siswa) ?>" method="post" enctype="multipart/form-data">
                                                <?php if ($form_daftar) { ?>
                                                    <a target="_blank" href="<?= base_url('assets/image/berkassiswa/' . $form_daftar) ?>"><img id="uploadPreview4" width="15%" src="<?= base_url('assets/image/berkassiswa/' . $form_daftar) ?>"></a>
                                                    <br><br>
                                                <?php } else { ?>
                                                    <img src="" id="uploadPreview4" width="15%"><br><br>
                                                <?php } ?>
                                                <input id="upload4" onchange="PreviewImage4()" class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="form_daftar">
                                                <input type="hidden" name="old" value="<?php echo $form_daftar; ?>"><br>
                                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                </thead>
                            </table>

                        <?php } else { ?>
                            <a href="<?= site_url('admin/isiberkas/' . $id_siswa) ?>" class="btn btn-primary btn-lg btn-block">Masukan Berkas</a>
                        <?php } ?>
                    </div>
                </div>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <?php
                                if ($orangtua == 0) { ?>
                                    <a href="<?= site_url('admin/formtambahorangtua/' . $id_siswa) ?>" class="btn btn-info">Tambah Data Orang Tua/Wali</a> |
                                <?php } else { ?>
                                    <a href="<?= site_url('admin/formeditorangtua/' . $id_siswa) ?>" class="btn btn-info">Data Orang Tua/Wali</a> |
                                <?php } ?>

                                <a href="<?= site_url('admin/siswa') ?>" class="btn btn-danger">Kembali</a>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>