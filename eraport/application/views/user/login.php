<div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Login</h1>
            <span>Silakan login bagi pesantren yang telah terdaftar</span>
          </div>
        </div>
      </div>
</div>

<div class="callback-form">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Login <em>Pesantren</em></h2>
              <span>Silakan isi form dibawah ini dengan benar</span>
              <?= $this->session->flashdata('suces');;?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="contact-form">
              <form id="contact" action="<?= site_url('loginpes/do_login')?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <label>Username</label>
                      <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </fieldset>
                    
                    <fieldset>
                      <label>Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </fieldset>
                  
                    <fieldset>
                      <?= $this->session->flashdata('gagal');?>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="border-button">Login</button><br>
                      Jika belum memiliki akun silakan klik <a href="<?= site_url('user/daftar')?>">daftar</a>
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