<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Data Guru</h1>
        <span><?= $profile->title_web ?></span>
      </div>
    </div>
  </div>
</div>

<div class="services">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Data Guru</h2>
          <span><?= $profile->title_web ?></span>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th width="15%">Foto</th>
            <th>NIP</th>
            <th>Nama Guru</th>
            <th>Mapel</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($guru as $key) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><img width="100%" src="<?= base_url('assets/image/fotoguru/' . $key->foto_guru) ?>"></td>
              <td><?= $key->nip ?></td>
              <td><?= $key->nama_guru ?></td>
              <td><?= $key->mapel ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>


    </div>
  </div>
</div>
<br>