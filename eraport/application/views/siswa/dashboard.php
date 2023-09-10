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
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Selamat Datang</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $nama_siswa ?>
                        <hr>
                        <?= 'NIS ' . $nis ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
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
                  <h6 class="m-0 font-weight-bold text-primary">Perbaharui Profil</h6>
                </div>
                <div class="card-body">
                  <?php echo $this->session->flashdata('suces') ?>
                  <br>

                  <div class="row">
                    <div class="col-md-6">
                      <form class="form" action="<?= $action ?>" method="post" enctype="multipart/form-data">
                        <label>NIS</label>
                        <input class="form-control" placeholder="NIS" value="<?php echo $nis; ?>" name="nis" required><br>
                        <label>NISN</label>
                        <input class="form-control" placeholder="NISN" value="<?php echo $nisn; ?>" name="nisn" required><br>
                        <label>Nama Siswa</label>
                        <input class="form-control" placeholder="Nama Siswa" value="<?php echo $nama_siswa; ?>" name="nama_siswa" required><br>
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $tgl_lahir; ?>" name="tgl_lahir" required><br>
                        <label>Tempat Lahir</label>
                        <input class="form-control" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" name="tempat_lahir" required><br>
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                          <?php if ($jenis_kelamin) { ?>
                            <option value="<?= $jenis_kelamin ?>"><?= $jenis_kelamin ?></option>
                          <?php } else { ?>
                            <option value="">Pilih Jenis Kelamin</option>
                          <?php } ?>

                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select><br>
                        <label>Agama</label>
                        <select name="agama" class="form-control">
                          <?php if ($agama) { ?>
                            <option value="<?= $agama ?>"><?= $agama ?></option>
                          <?php } else { ?>
                            <option value="">Pilih Agama</option>
                          <?php } ?>

                          <option value="Islam">Islam</option>
                          <option value="Kristen">Kristen</option>
                          <option value="Katolik">Katolik</option>
                          <option value="Budha">Budha</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Konghucu">Konghucu</option>
                        </select><br>
                        <label>Alamat</label>
                        <textarea class="form-control" placeholder="Alamat" rows="5" value="" name="alamat" required><?php echo $alamat; ?></textarea><br>
                        <label>Status Dalam Keluarga</label>
                        <select name="status_anak" class="form-control">
                          <?php if ($status_anak) { ?>
                            <option value="<?= $status_anak ?>"><?= $status_anak ?></option>
                          <?php } else { ?>
                            <option value="">Pilih Status</option>
                          <?php } ?>

                          <option value="Anak Kandung">Anak Kandung</option>
                          <option value="Anak Angkat">Anak Angkat</option>
                        </select><br>
                        <label>Anak Ke</label>
                        <input class="form-control" placeholder="Anak Ke" value="<?php echo $anak_ke; ?>" name="anak_ke" required><br>

                    </div>
                    <div class="col-md-6">
                      <label>Foto</label><br>
                      <?php if ($foto) { ?>
                        <a target="_blank" href="<?= base_url('assets/image/fotosiswa/' . $foto) ?>"><img id="uploadPreview" width="15%" src="<?= base_url('assets/image/fotosiswa/' . $foto) ?>"></a>
                        <br><br>
                      <?php } else { ?>
                        <img src="" id="uploadPreview" width="15%"><br><br>
                      <?php } ?>
                      <input id="upload" onchange="PreviewImage()" class="form-control" type="file" accept=".jpg,.png,.jpeg,.jfif" name="foto">
                      <input type="hidden" name="old" value="<?php echo $foto; ?>"><br>
                      <!-- <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" name="email" required><br> -->
                      <label>No Telepon</label>
                      <input type="number" class="form-control" placeholder="No Telepon" value="<?php echo $no_telp; ?>" name="no_telp" required><br>
                      <label>Asal Sekolah</label>
                      <input class="form-control" placeholder="Asal Sekolah" value="<?php echo $asal_sekolah; ?>" name="asal_sekolah" required><br>
                      <label>Tanggal Diterima</label>
                      <input type="date" class="form-control" placeholder="Tanggal Diterima" value="<?php echo $tgl_diterima; ?>" name="tgl_diterima" required><br>
                      <label>Status</label>
                      <select name="status" class="form-control">
                        <?php if ($status) { ?>
                          <option value="<?= $status ?>"><?= $status ?></option>
                        <?php } else { ?>
                          <option value="">Pilih Status</option>
                        <?php } ?>
                        <option value="Aktif">Aktif</option>
                        <option value="Alumni">Alumni</option>
                        <option value="Keluar">Keluar</option>
                      </select>
                      <hr>
                      <input type="hidden" name="id_siswa" value="<?= $id_siswa ?>">
                      <button type="submit" class="btn btn-primary"><?= $button ?></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

        </div>