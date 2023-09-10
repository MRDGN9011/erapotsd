<div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1><?= $pesantren_id->nama_pesantren?></h1>
            <span>Kabupaten Cilacap</span>
          </div>
        </div>
      </div>
    </div>

    <div class="single-services">
      <div class="container">
        <div class="row" id="tabs">
          <div class="col-md-4">
            <ul>
              <li><a href='#tabs-1'>Profil Pesantren <i class="fa fa-angle-right"></i></a></li>
              <li><a href='#tabs-2'>Data Fasilitas <i class="fa fa-angle-right"></i></a></li>
              <li><a href='#tabs-3'>Data Santri <i class="fa fa-angle-right"></i></a></li>
              <li><a href='#tabs-4'>Data Pengajar <i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div>
          <div class="col-md-8">
            <section class='tabs-content'>
              <article id='tabs-1'>
                <img src="<?= base_url('assets/image/gambar_pes/'.$pesantren_id->gambar)?>" alt="">
                <h4><?= $pesantren_id->nama_pesantren?></h4>
                <p><?= $pesantren_id->profil_pesantren?></p>
              </article>
              <article id='tabs-2'>
                <h4>Data Fasilitas</h4>
                <table class="table">
                    <thead>
                        <tr>
                        <th>Fasilitas Digital</th>
                        <th>Ketersediaan</th>
                        <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fasilitas as $key): ?>
                        <tr>
                        <td><?php echo $key->nama_fasilitas;?></td>
                        <td><?php echo $key->ketersediaan;?></td>
                        <td><a target="_blank" href="<?= base_url('assets/image/foto/'.$key->foto)?>"><img src="<?= base_url('assets/image/foto/'.$key->foto)?>?>"></a></td>
                        <td>
                        </tr>    
                        <?php endforeach ?>
                        
                    </tbody>
                </table>
              </article>
              <article id='tabs-3'>
                <h4>Data Santri</h4>
                <p class="alert alert-success">Jumlah Santriwan : <?= $santri_id->jumlah_santriwan.'/'.' Santri'?><br>
                   Jumlah Santriwati : <?= $santri_id->jumlah_santriwati.'/'.' Santri'?>
                <br>
                   Jumlah Lulusan : <?= $santri_id->jumlah_lulusan.'/'.' Santri'?>
                </p>
              </article>
              <article id='tabs-4'>
                <h4>Data Pengajar</h4>
                <p class="alert alert-primary">Jumlah Pengajar : <?= $pengajar_id->jumlah_pengajar.'/'.' Pengajar'?></p>
              </article>
            </section>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid tm-mt-60">
        <div class="row tm-mb-50">
            <div class="col-lg-6 col-12 mb-5" style="padding-left: 50px;">
                <div class="tm-address-col">
                    <h2 class="tm-text-primary mb-5">Alamat Kami</h2>
                    <p class="tm-mb-50">Untuk kerjasama atau kemitraan, dan pertanyaan lainnya silakan hubungi kami melalui</p>
                    <address class="tm-text-gray tm-mb-50">
                       Alamat : <?= $profil->alamat?>
                    </address>
                    <ul class="tm-contacts">
                        <li>
                            <a href="#" class="tm-text-gray">
                                <i class="fa fa-envelope"></i>
                                Email: <?= $profil->email?>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tm-text-gray">
                                <i class="fa fa-phone"></i>
                                Tel: <?= $profil->no_telp?>
                            </a>
                        </li>
                       <!--  <li>
                            <a href="#" class="tm-text-gray">
                                <i class="fas fa-globe"></i>
                                URL: www.company.com
                            </a>
                        </li> -->
                    </ul>
                </div>                
            </div>
            <div class="col-lg-6 col-12">
                <h2 class="tm-text-primary mb-5">Lokasi Kami</h2>
                <!-- Map -->
                <div class="mapouter mb-4">
                    <div class="gmap-canvas">
                        <div id='map' style='width: 100%; height: 300px;'></div>
                        <script>
                        mapboxgl.accessToken = 'pk.eyJ1IjoiZG9uaXNlbmRpcmkiLCJhIjoiY2tweGc4djF4MDA2NDJ2dDg4MDJpb21oZiJ9.my4bD4or59OQaD-1Q3fl9w';
                        var map = new mapboxgl.Map({
                        container: 'map', // container id
                        style: 'mapbox://styles/mapbox/streets-v11',
                        center: [<?= $pesantren_id->maps?>], // starting position
                        zoom: 12 // starting zoom
                        });
                        new mapboxgl.Marker().setLngLat([<?= $pesantren_id->maps?>])
                        .addTo(map)
                        // Add zoom and rotation controls to the map.
                        map.addControl(new mapboxgl.NavigationControl());
                        </script>
                    </div>
                </div>               
            </div>
        </div>
        
    </div>