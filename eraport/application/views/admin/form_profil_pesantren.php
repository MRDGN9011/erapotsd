<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form <?= $title?> Pesantren</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <?php echo $this->session->flashdata('suces')?>
                <div class="col-md-8">
                    <form class="form" action="<?= $action?>" method="post" enctype="multipart/form-data">
                        <label>Nama Pesantren</label>
                        <input class="form-control" placeholder="Nama Pesantren" value="<?php echo $nama_pesantren;?>" name="nama_pesantren" required reqdonly><br>
                        <label>Profil Pesantren</label>
                        <textarea rows="4" class="form-control" placeholder="Profil" name="profil_pesantren" required><?php echo $profil_pesantren;?></textarea><br>
                        <label>Alamat Kantor</label>
                        <textarea rows="4" class="form-control" placeholder="Alamat" name="alamat" required><?php echo $alamat;?></textarea><br>
                        <label>Maps</label>
                        <input rows="4" class="form-control" placeholder="Maps" name="maps" value="<?php echo $maps;?>" required><br>
                        
                        <hr>
                        <input type="hidden" name="id_profil_pesantren" value="<?= $id_profil_pesantren?>">
                        <input type="hidden" name="id_pesantren" value="<?= $id_pesantren?>">
                        <button type="submit" class="btn btn-primary"><?= $button?></button>
                        <a class="btn btn-danger" href="<?= site_url('admin/detail_pesantren/'.$id_pesantren)?>">Kembali</a>
                    </form>
                </div>
                <div class="col-md-4">
                    <form class="form" action="<?= site_url('admin/update_gambar_pesantren/'.$id_profil_pesantren)?>" method="post" enctype="multipart/form-data">
                        <label>gambar</label>
                        <?php if($gambar){?>
                            <a target="_blank" href="<?= base_url('assets/image/gambar_pes/'.$gambar)?>"><?= $gambar?></a>
                        <?php } ?>
                        <input class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif"  name="gambar">
                        <input type="hidden" name="old" value="<?php echo $gambar;?>"><br>
                        <input type="hidden" name="id_pesantren" value="<?= $id_pesantren?>">
                        <button type="submit" class="btn btn-warning"><?= $button?></button>
                    </form>
                    <hr>
                    <form class="form" action="<?= site_url('admin/update_logo_pesantren/'.$id_profil_pesantren)?>" method="post" enctype="multipart/form-data">
                        <label>Logo</label>
                        <?php if($logo){?>
                            <a target="_blank" href="<?= base_url('assets/image/logo_pes/'.$logo)?>"><?= $logo?></a>
                        <?php } ?>
                        <input class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif"  name="logo">
                        <input type="hidden" name="old" value="<?php echo $logo;?>"><br>
                        <input type="hidden" name="id_pesantren" value="<?= $id_pesantren?>">
                        <button type="submit" class="btn btn-warning"><?= $button?></button>
                    </form>
                </div>
            </div>
              
            </div>
        </div>
</div>



       