<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="8%">Foto</th>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Mapel</th>
                            <th>Keterangan</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($guru as $key) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><a target="_blank" href="<?= base_url('assets/image/fotoguru/' . $key->foto_guru) ?>"><img width="100%" src="<?= base_url('assets/image/fotoguru/' . $key->foto_guru) ?>"></a></td>
                                <td><?php echo $key->nip; ?></td>
                                <td><?php echo $key->nama_guru; ?></td>
                                <td style="text-align:center;">
                                    <?php $mapelguru = $this->db->query("SELECT * FROM detail_mapel_guru a, mapel b, guru c where a.id_mapel=b.id_mapel and a.id_guru=c.id_guru and a.id_guru='$key->id_guru' order by a.id_detail_mapel_guru desc limit 1")->row(); ?>
                                    <?php if(empty($mapelguru)) {
                                        echo "";
                                    }else{
                                        echo $mapelguru->mapel; 
                                    } ?>
                                    
                                </td>
                                <td>
                                    <?php $jabatan = $this->db->query("SELECT * FROM guru where id_guru = '$key->id_guru'")->result_array() ?>
                                    <?php foreach ($jabatan as $jab) : ?>
                                        <?= $jab['jabatan'] ?>
                                    <?php endforeach ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>