<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form <?= $title ?> Guru</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="form" action="<?= $action ?>" method="post" enctype="multipart/form-data">
                        <label>NIP</label>
                        <input class="form-control" placeholder="NIP" value="<?php echo $nip; ?>" name="nip" required><br>
                        <label>Nama Guru</label>
                        <input class="form-control" placeholder="Nama Guru" value="<?php echo $nama_guru; ?>" name="nama_guru" required><br>
                        <label>Jenis Kelamin</label>
                        <select name="jk_guru" class="form-control">
                            <?php if ($jk_guru) { ?>
                                <option value="<?= $jk_guru ?>"><?= $jk_guru ?></option>
                            <?php } else { ?>
                                <option value="">Pilih Jenis Kelamin</option>
                            <?php } ?>

                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select><br><label>Tanggal Lahir</label>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $tgl_lahir_guru; ?>" name="tgl_lahir_guru" required><br>
                        <label>Alamat</label>
                        <textarea class="form-control" placeholder="Alamat" rows="5" value="" name="alamat_guru" required><?php echo $alamat_guru; ?></textarea><br>
                        <label>No Telepon</label>
                        <input type="number" class="form-control" placeholder="No Telepon" value="<?php echo $telp_guru; ?>" name="telp_guru" required><br>
                </div>
                <div class="col-md-6">
                    <label>Foto</label><br>
                    <?php if ($foto_guru) { ?>
                        <a target="_blank" href="<?= base_url('assets/image/fotoguru/' . $foto_guru) ?>"><img id="uploadPreview" width="15%" src="<?= base_url('assets/image/fotoguru/' . $foto_guru) ?>"></a>
                        <br><br>
                    <?php } else { ?>
                        <img src="" id="uploadPreview" width="15%"><br><br>
                    <?php } ?>
                    <input id="upload" onchange="PreviewImage()" class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="foto_guru">
                    <input type="hidden" name="old" value="<?php echo $foto_guru; ?>"><br>
                    <label>Pendidikan Terakhir</label>
                    <input class="form-control" placeholder="Pendidikan Terakhir" value="<?php echo $pend_terakhir; ?>" name="pend_terakhir" required><br>
                    <label>Golongan</label>
                    <select name="gol" class="form-control">
                        <?php if ($gol) { ?>
                            <option value="<?= $gol ?>"><?= $gol ?></option>
                        <?php } else { ?>
                            <option value="">Pilih Golongan</option>
                        <?php } ?>

                        <option value="IIA">IIA</option>
                        <option value="IIB">IIB</option>
                        <option value="IIC">IIC</option>
                        <option value="IIIA">IIIA</option>
                        <option value="IIIB">IIIB</option>
                        <option value="IIIC">IIIC</option>
                        <option value="IVA">IVA</option>
                        <option value="IVB">IVB</option>
                        <option value="IVC">IVC</option>
                        <option value="IVD">IVD</option>
                    </select><br>
                    <label>Jabatan</label>
                        <select name="jabatan" class="form-control">
                            <?php if ($jabatan) { ?>
                                <option value="<?= $jabatan ?>"><?= $jabatan ?></option>
                            <?php } else { ?>
                                <option value="">Pilih Jabatan</option>
                            <?php } ?>

                            <option value="Guru Mapel">Guru Mata Pelajaran</option>
                            <option value="Kepala Sekolah">Kepala Sekolah</option>
                        </select><br>
                    <hr>
                    <input type="hidden" name="id_guru" value="<?= $id_guru ?>">
                    <button type="submit" class="btn btn-primary"><?= $button ?></button>
                    <a href="<?= site_url('admin/guru') ?>" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>