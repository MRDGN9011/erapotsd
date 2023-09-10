<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>
            <div class="text-center">
                <h1>LAPORAN ONLINE</h1>
                <h1>PENCAPAIAN PENILAIAN SIKAP SPIRITUAL DAN SOSIAL <br>PENCAPAIAN KOMPETENSI PESERTA DIDIK</h1>
                <h1>SEMESTER <?= $semester ?></h1>
                <h1>TAHUN PELAJARAN <?= $tahun_ajaran ?></h1>
            </div>
            <table style="text-size-adjust: 20px;">
                <tr>
                    <th>Nama Siswa</th>
                    <th>:</th>
                    <th><?= $nama_siswa ?></th>
                </tr>
                <tr>
                    <th>No. Induk</th>
                    <th>:</th>
                    <th><?= $nis ?></th>
                </tr>
                <tr>
                    <th>NISN</th>
                    <th>:</th>
                    <th><?= $nisn ?></th>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <th>:</th>
                    <th><?= $kelas ?></th>
                </tr>
            </table>
            <hr>
            <div>
                <h4>KARAKTER YANG DIBANGUN</h4>
                <table class="table table-bordered" width="100%" cellspacing="0" style="text-align: ;">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th width="10%">Karakter</th>
                            <th width="30%">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sikap = $this->db->query("SELECT * FROM nilai_sikap where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_semester='$id_semester'");
                        if ($sikap->num_rows() > 0) {
                            foreach ($sikap->result() as $key) {?>
                                <tr>
                                    <td>1</td>
                                    <td>Integritas</td>
                                    <td><?= $key->integritas ?></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Religius</td>
                                    <td><?= $key->religius ?></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Nasionalis</td>
                                    <td><?= $key->nasionalis ?></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Mandiri</td>
                                    <td><?= $key->mandiri ?></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Gotong Royong</td>
                                    <td><?= $key->gotongroyong ?></td>
                                </tr>
                            <?php  }
                        } ?>

                    </tbody>

                </table>
                

                <a target="_blank" href="<?= site_url('siswa/cetakraportsikap/' . $id_siswa . '/' . $id_kelas . '/' . $id_semester) ?>" class="btn btn-primary btn-block">Cetak Raport</a>
            </div>
        </div>
    </div>

</div>