<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form <?= $title?> Pesantren</h6>
        </div>
        <div class="card-body">
        <form class="form" action="<?= $action?>" method="post" enctype="multipart/form-data">
            <label>Nama Web</label>
            <input class="form-control" placeholder="Nama Web" value="<?php echo $nama_web;?>" name="nama_web" required reqdonly><br>
            <label>Profil Web</label>
            <textarea rows="4" class="form-control" placeholder="Profil" name="profil_web" required><?php echo $profil_web;?></textarea><br>
            <label>Alamat Kantor</label>
            <textarea rows="4" class="form-control" placeholder="Alamat" name="alamat" required><?php echo $alamat;?></textarea><br>
            <label>No Telepon</label>
            <input type="number" class="form-control" placeholder="No Telepon" value="<?php echo $no_telp;?>" name="no_telp" required><br>
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Email" value="<?php echo $email;?>" name="email" required><br>
            <label>Logo</label>
            <?php if($logo){?>
                <a target="_blank" href="<?= base_url('assets/image/'.$logo)?>"><?= $logo?></a>
            <?php } ?>
            <input class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif"  name="logo">
            <input type="hidden" name="old" value="<?php echo $logo;?>"><br>
            
            <hr>
            <input type="hidden" name="id_profil" value="<?= $id_profil?>">
            <button type="submit" class="btn btn-primary"><?= $button?></button>
             
        </form>      
            </div>
        </div>
</div>



       