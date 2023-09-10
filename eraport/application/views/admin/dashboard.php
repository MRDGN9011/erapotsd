        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Siswa Aktif</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $siswa ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Alumni</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $alumni ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas  fa-graduation-cap fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Guru</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $guru ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kelas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kelas ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-boxes fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->

          <div class="row">
            <div class="col-md-12">
              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Data Profil</h6>
                </div>
                <div class="card-body">
                  <?php echo $this->session->flashdata('suces') ?>
                  <br>

                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Perbaharui Profil</h6>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <form class="form" action="<?= site_url('admin/update_profile_act') ?>" method="post" enctype="multipart/form-data">
                            <label>Nama Web(Title)</label>
                            <input class="form-control" placeholder="Nama Web" value="<?php echo $profile->title_web; ?>" name="title_web" required reqdonly><br>
                            <label>Profil Web</label>
                            <textarea rows="5" class="form-control" placeholder="Profil" name="keterangan" required><?php echo $profile->keterangan; ?></textarea><br>
                            <label>Alamat</label>
                            <textarea rows="4" class="form-control" placeholder="Alamat" name="alamat" required><?php echo $profile->alamat; ?></textarea><br>
                            <label>No Telepon</label>
                            <input type="number" class="form-control" placeholder="No Telepon" value="<?php echo $profile->telp; ?>" name="telp" required><br>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" value="<?php echo $profile->email; ?>" name="email" required><br>
                            <label>Maps</label>
                            <input type="text" class="form-control" placeholder="Maps" value="<?php echo $profile->maps; ?>" name="maps" required><br>
                            <input type="hidden" name="id_profile" value="<?= $profile->id_profile ?>">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </form>
                        </div>

                        <div class="col-md-6">
                          <form class="form" action="<?= site_url('admin/update_logo') ?>" method="post" enctype="multipart/form-data">
                            <label>Logo</label><br>
                            <?php if ($profile->logo) { ?>
                              <a target="_blank" href="<?= base_url('assets/image/' . $profile->logo) ?>"><img width="15%" src="<?= base_url('assets/image/' . $profile->logo) ?>"></a>
                              <br><br>
                            <?php } else { ?>
                              <img src="" id="uploadPreview" width="15%"><br><br>
                            <?php } ?>
                            <input class="form-control" id="upload" onchange="PreviewImage()" type="file" accept=".jpg,.png,.jpeg,.jfif" name="logo">
                            <input type="hidden" name="old" value="<?php echo $profile->logo; ?>"><br>
                            <input type="hidden" name="id_profile" value="<?= $profile->id_profile ?>">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </form>
                          <hr>
                          <form class="form" action="<?= site_url('admin/update_gambar') ?>" method="post" enctype="multipart/form-data">
                            <label>Gambar</label><br>
                            <?php if ($profile->gambar) { ?>
                              <a target="_blank" href="<?= base_url('assets/image/' . $profile->gambar) ?>"><img width="55%" src="<?= base_url('assets/image/' . $profile->gambar) ?>"></a>
                              <br><br>
                            <?php } else { ?>
                              <img src="" id="uploadPreview2" width="55%"><br><br>
                            <?php } ?>
                            <input class="form-control" id="upload2" onchange="PreviewImage2()" type="file" accept=".jpg,.png,.jpeg,.jfif" name="gambar">
                            <input type="hidden" name="oldg" value="<?php echo $profile->gambar; ?>"><br>
                            <hr>
                            <input type="hidden" name="id_profile" value="<?= $profile->id_profile ?>">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>

            <!-- Content Row -->

          </div>