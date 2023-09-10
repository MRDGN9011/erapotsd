<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form <?= $title ?> Data Orang Tua</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <?php echo $this->session->flashdata('suces') ?>
                <br>
                <div class="col-md-6">
                    <form class="form" action="<?= $action ?>" method="post" enctype="multipart/form-data">
                        <label>NIK Ayah</label>
                        <input class="form-control" placeholder="NIK Ayah" value="<?php echo $nik_ayah; ?>" name="nik_ayah" required><br>
                        <label>Nama ayah</label>
                        <input class="form-control" placeholder="Nama Ayah" value="<?php echo $nama_ayah; ?>" name="nama_ayah" required><br>
                        <label>Tanggal Lahir Ayah</label>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir Ayah" value="<?php echo $tgl_lahir_ayah; ?>" name="tgl_lahir_ayah" required><br>
                        <label>Pekerjaan Ayah</label>
                        <select name="pekerjaan_ayah" class="form-control">
                            <?php if ($pekerjaan_ayah) { ?>
                                <option value="<?= $pekerjaan_ayah ?>"><?= $pekerjaan_ayah ?></option>
                            <?php } else { ?>
                                <option value="">Pilih Pekerjaan</option>
                            <?php } ?>
                            <option value="PNS">PNS</option>
                            <option value="ASN">ASN</option>
                            <option value="Polisi">Polisi</option>
                            <option value="TNI">TNI</option>
                            <option value="Karyawan">Karyawan</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Petani">Petani</option>
                        </select><br>
                        <label>NIK Ibu</label>
                        <input class="form-control" placeholder="NIK Ibu" value="<?php echo $nik_ibu; ?>" name="nik_ibu" required><br>
                        <label>Nama Ibu</label>
                        <input class="form-control" placeholder="Nama Ibu" value="<?php echo $nama_ibu; ?>" name="nama_ibu" required><br>
                        <label>Tanggal Lahir Ibu</label>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir Ibu" value="<?php echo $tgl_lahir_ibu; ?>" name="tgl_lahir_ibu" required><br>
                        <label>Pekerjaan Ibu</label>
                        <select name="pekerjaan_ibu" class="form-control">
                            <?php if ($pekerjaan_ibu) { ?>
                                <option value="<?= $pekerjaan_ibu ?>"><?= $pekerjaan_ibu ?></option>
                            <?php } else { ?>
                                <option value="">Pilih Pekerjaan</option>
                            <?php } ?>
                            <option value="PNS">PNS</option>
                            <option value="ASN">ASN</option>
                            <option value="Polisi">Polisi</option>
                            <option value="TNI">TNI</option>
                            <option value="Karyawan">Karyawan</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Petani">Petani</option>
                            <option value="IRT">IRT</option>
                        </select><br>
                        <label>Alamat</label>
                        <textarea class="form-control" placeholder="Alamat" rows="5" value="" name="alamat_orang_tua" required><?php echo $alamat_orang_tua; ?></textarea><br>
                        <label>No Telepon</label>
                        <input type="number" class="form-control" placeholder="No Telepon" value="<?php echo $telp_orang_tua; ?>" name="telp_orang_tua" required><br>
                        <input type="hidden" name="id_siswa" value="<?= $id_siswa ?>">
                        <button type="submit" class="btn btn-primary"><?= $button ?></button>
                        <a href="<?= site_url('admin/detailsiswa/' . $id_siswa) ?>" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form" action="<?= site_url('admin/upload_ktp_ayah/' . $id_siswa) ?>" method="post" enctype="multipart/form-data">
                        <label>Upload KTP Ayah</label><br>
                        <?php if ($ktp_ayah) { ?>
                            <a target="_blank" href="<?= base_url('assets/image/ktp/' . $ktp_ayah) ?>"><img width="65%" src="<?= base_url('assets/image/ktp/' . $ktp_ayah) ?>"></a>
                            <br><br>
                        <?php } else { ?>
                            <img src="" id="uploadPreview" width="65%"><br><br>
                        <?php } ?>
                        <input id="upload" onchange="PreviewImage()" class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="ktp_ayah">
                        <input type="hidden" name="old" value="<?php echo $ktp_ayah; ?>"><br>
                        <input type="hidden" name="id_siswa" value="<?= $id_siswa ?>">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <hr>
                    </form>
                    <form class="form" action="<?= site_url('admin/upload_ktp_ibu/' . $id_siswa) ?>" method="post" enctype="multipart/form-data">
                        <label>Upload KTP Ibu</label><br>
                        <?php if ($ktp_ibu) { ?>
                            <a target="_blank" href="<?= base_url('assets/image/ktp/' . $ktp_ibu) ?>"><img width="65%" src="<?= base_url('assets/image/ktp/' . $ktp_ibu) ?>"></a>
                            <br><br>
                        <?php } else { ?>
                            <img src="" id="uploadPreview2" width="65%"><br><br>
                        <?php } ?>
                        <input id="upload2" onchange="PreviewImage2()" class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="ktp_ibu">
                        <input type="hidden" name="old" value="<?php echo $ktp_ibu; ?>"><br>
                        <input type="hidden" name="id_siswa" value="<?= $id_siswa ?>">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <hr>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>