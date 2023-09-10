<div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Laporan Data Pesantren</h6>
                        </div>
                        <div class="card-body">
                        <form style="padding-bottom:20px;" class="form-inline" method="get" action="<?php echo site_url('admin/laporan_pesantren');?>" style="padding-bottom:20px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                        <span>Dari Tanggal</span><br>
                                        <input type="date" name="tgl1" class="form-control" value="<?php echo $tgl1;?>">
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                        <span >Sampai Tanggal</span><br>
                                        <input type="date" name="tgl2" class="form-control" value="<?php echo $tgl2;?>">
                                    
                                </div>
                            </div>
                        
                           <div class="col-md-4">
                           <button type="submit" class="btn btn-info" style="margin-right:10px;">Pilih</button>
                           <a href="<?php echo site_url('admin/laporan_pesantren')?>" class="btn btn-success "><font color="white">Refresh</font></a>
                           <a href="<?php echo site_url('admin/cetak_laporan_pesantren?tgl1='.$tgl1.'&tgl2='.$tgl2);?>" target="_blank" class="btn btn-warning"><font color="white">Print PDF</font></a>
                           </div>        
                        </form> 
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Tgl Daftar</th>
                                        <th>ID Pesantren</th>
                                        <th>Nama Pesantren</th>
                                        <th>Nama Pemilik/PJ</th>
                                        <th>KTP</th>
                                        <th>No Telp</th>
                                        <th>Email</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php $no=1; foreach ($pesantren as $key) { if($key->status_pesantren=='Aktif'){
                                        ?>
                                    
                                    <tr>
                                    <td><?= $no++?></td>
                                    <td><?php echo $key->tgl_daftar;?></td>
                                    <td><?php echo $key->id_pesantren;?></td>
                                    <td><?php echo $key->nama_pesantren;?></td>
                                    <td><?php echo $key->pemilik;?></td>
                                    <td><a target="_blank" href="<?= base_url('assets/image/ktp/'.$key->ktp)?>"><?= $key->ktp?></a></td>
                                    <td><?php echo $key->no_telp;?></td>
                                    <td><?php echo $key->email;?></td>
                                    <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


       