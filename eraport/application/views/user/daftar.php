<div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Daftar</h1>
            <span>Daftarkan pesantren anda dan data semua fasilitas digital yang tersedia</span>
          </div>
        </div>
      </div>
</div>

<div class="callback-form">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Daftar <em>Sekarang</em></h2>
              <span>Silakan isi form dibawah ini dengan benar</span>
              <?= $this->session->flashdata('suces');;?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="contact-form">
              <form id="contact" action="<?= site_url('user/tambahpesantren')?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <label>ID Pesantren</label>
                      <input class="form-control" placeholder="ID Pesantren" value="<?php echo $id_pesantren;?>" name="id_pesantren" required readonly>
                    </fieldset>
                  
                    <fieldset>
                      <label>Nama Pesantren</label>
                      <input class="form-control" placeholder="Nama Pesantren" name="nama_pesantren" required>
                    </fieldset>
                    
                    <fieldset>
                      <label>Nama Pemilik</label>
                      <input class="form-control" placeholder="Nama Pemilik" name="pemilik" required>
                    </fieldset>

                    <fieldset>
                      <label>KTP</label>
                      <input class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="ktp" required>
                    </fieldset>
                    
                    <fieldset>
                      <label>No Telepon</label>
                      <input type="number" class="form-control" placeholder="No Telepon" name="no_telp" required>
                    </fieldset>
          
                    <fieldset>
                      <label>Email</label>
                      <input type="text" class="form-control" id="email" pattern="[^ @]*@[^ @]*" placeholder="Email" name="email" required>
                    </fieldset>
                  
                    <fieldset>
                      <label>Username</label>
                      <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </fieldset>
                    
                    <fieldset>
                      <label>Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </fieldset>
                  
                    <!-- <fieldset>
                      <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                    </fieldset> -->
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="border-button">Daftar</button><br>
                      Jika sudah memiliki akun silakan klik <a href="<?= site_url('loginpes')?>">login</a>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>