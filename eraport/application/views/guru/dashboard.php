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
                  <h6 class="m-0 font-weight-bold text-primary">Jadwal Mengajar</h6>
                </div>
                <div class="card-body">
                  <?php echo $this->session->flashdata('suces') ?>
                  <br>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Mapel</th>
                          <th>Kelas</th>
                          <th>Hari</th>
                          <th>Jam Masuk</th>
                          <th>Jam Selesai</th>

                        </tr>
                      </thead>

                      <tbody>
                        <?php $no = 1;
                        foreach ($jadwal->result() as $key) {
                          if ($key->id_guru == $this->session->id_guru) {
                        ?>
                            <tr>
                              <th><?php echo $no++; ?></th>
                              <td><?php echo $key->mapel; ?></td>
                              <td><?php echo $key->kelas; ?></td>
                              <td><?php echo $key->hari; ?></td>
                              <td><?php echo $key->jam_masuk; ?></td>
                              <td><?php echo $key->jam_selesai; ?></td>

                            </tr>
                        <?php }
                        } ?>

                      </tbody>
                    </table>
                  </div>
                </div>

              </div>

            </div>

            <!-- Content Row -->

          </div>