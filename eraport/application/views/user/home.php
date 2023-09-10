<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="main-banner header-text" id="top">
  <div class="Modern-Slider">
    <!-- Item -->
    <div class="item" style="background: url(<?= base_url('assets/image/' . $profile->gambar) ?>); background-size: cover;">
      <div class="img-fill">
        <div class="text-content">
          <h6>Selamat Datang</h6>
          <h4><?= $profile->title_web ?></h4>
          <p>Berintegritas, mencerdaskan dan menumbuh kembangkan moral budi pekerti dan cinta tanah air untuk Siswa Berprestasi</p>
          <a href="<?= site_url('siswa') ?>" class="filled-button">RUANG SISWA</a>
          <a href="<?= site_url('guru') ?>" class="filled-button">RUANG GURU</a>
          <a href="<?= site_url('user/data_guru') ?>" class="filled-button">DATA GURU</a>
          <a href="<?= site_url('user/kontak') ?>" class="filled-button">KONTAK KAMI</a>
        </div>
      </div>
    </div>
    <!-- // Item -->

  </div>
</div>
<!-- Banner Ends Here -->

<div class="request-form">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h4>Membutuhkan Informasi ?</h4>
        <span>Tanyakan tentang <?= $profile->title_web ?>.</span>
      </div>
      <div class="col-md-4">
        <a href="<?= site_url('user/kontak') ?>" class="border-button">Kontak</a>
      </div>
    </div>
  </div>
</div>

<div class="services">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <img width="25%" src="<?= base_url('assets/image/' . $profile->logo) ?>">
          <h2><em><?= $profile->title_web ?></em></h2>
          <span>Sejarah Singkat</span>
        </div>
        <p><?= $profile->keterangan ?></p>
      </div>
    </div>
  </div>
</div>

</div>