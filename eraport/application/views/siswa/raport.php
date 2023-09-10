<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php echo $this->session->flashdata('suces') ?>
            <br>
            <div class="text-center">
                <h1>LAPORAN ONLINE</h1>
                <h1>PENCAPAIAN KOMPETENSI PESERTA DIDIK</h1>
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
                <h4>A. PENGETAHUAN</h4>
                <table class="table table-bordered" width="100%" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Mata Pelajaran</th>
                            <th rowspan="2">KKM</th>
                            <th colspan="5">Nilai</th>
                        </tr>
                        <tr>
                            <th width="10%">Pengetahuan</th>
                            <th width="10%">Keterampilan</th>
                            <th width="10%">Nilai Akhir</th>
                            <th width="10%">Predikat</th>
                            <th width="20%">Deskripsi</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $noa = 1;
                        $nob = 1;
                        $noc = 1;
                        $nod = 1;
                        $rata_nilai = 0;
                        $rata_nilai_keterampilan = 0;
                        $nilai_akhira = 0;
                        $nilai_akhirb = 0;
                        $nilai_akhir = 0;
                        $idmapel = 0;
                        $muatanNasionalShown = false;
                        $muatanKewilayahanShown = false;
                        $muatanPeminatanShown = false;
                        $programShown = false;
                        $bidangShown = false;
                        foreach ($mapel as $key) {
                            $idmapel = $key->id_mapel;
                            if ($key->golongan == 'Muatan Nasional') { ?>
                                <?php 
                                if (!$muatanNasionalShown) {
                                // Tampilkan hanya jika belum ada yang ditampilkan sebelumnya
                                echo '
                                <thead>
                                    <tr>
                                        <th style="text-align: left;" colspan="8">A. Muatan Nasional</th>
                                    </tr>
                                </thead>';
                                $muatanNasionalShown = true; // Setel variabel penanda menjadi true setelah menampilkan satu baris
                            }
                            // Tampilkan baris data sesuai kebutuhan
                            echo '' ?>
                                <tr>
                                    <td><?= $noa++ ?></td>
                                    <td><?php echo $key->mapel . '<hr> Pengampu:' . $key->nama_guru; ?></td>
                                    <td><?= $key->kkm ?></td>
                                    <?php
                                    $nilai = $this->db->query("SELECT * FROM detail_nilai a, mapel b where a.id_mapel=b.id_mapel and b.id_mapel='$idmapel' and a.id_siswa='$id_siswa' and a.id_kelas='$id_kelas' and a.id_semester='$id_semester'");
                                    if ($nilai->num_rows() > 0) {
                                        foreach ($nilai->result() as $n) {?>
                                            <td>
                                                <?= $n->total_nilai ?>

                                            </td>
                                            <td>
                                                <?= $n->nilai_keterampilan ?>
                                            </td>
                                            <td>
                                                <?= $nilai_akhir = ($n->total_nilai+$n->nilai_keterampilan)/2 ?>
                                            </td>
                                            <td>
                                                <?php if ($n->total_nilai >= 80) {
                                                    echo 'A';
                                                } else if ($n->total_nilai >= 70 and $n->total_nilai <= 79) {
                                                    echo 'B';
                                                } else if ($n->total_nilai >= 60 and $n->total_nilai <= 69) {
                                                    echo 'C';
                                                } else if ($n->total_nilai >= 50 and $n->total_nilai <= 59) {
                                                    echo 'D';
                                                } else if ($n->total_nilai >= 0 and $n->total_nilai <= 49) {
                                                    echo 'E';
                                                } ?>

                                            </td>

                                            <td>
                                                <?= $n->deskripsi_nilai ?>
                                            </td>

                                            <?php
                                            
                                        }
                                    } ?>
                                </tr>

                            <?php } else if ($key->golongan == 'Muatan Kewilayahan') { ?>
                                <?php 
                                if (!$muatanKewilayahanShown) {
                                // Tampilkan hanya jika belum ada yang ditampilkan sebelumnya
                                echo '
                                <thead>
                                    <tr>
                                        <th style="text-align: left;" colspan="8">B. Muatan Kewilayahan</th>
                                    </tr>
                                </thead>';
                                $muatanKewilayahanShown = true; // Setel variabel penanda menjadi true setelah menampilkan satu baris
                            }
                            // Tampilkan baris data sesuai kebutuhan
                            echo '' ?>
                            <tr>
                                <td><?= $nob++ ?></td>
                                <td><?php echo $key->mapel . '<hr> Pengampu:' . $key->nama_guru; ?></td>
                                <td><?= $key->kkm ?></td>
                                <?php
                                $nilaib = $this->db->query("SELECT * FROM detail_nilai a, mapel b where a.id_mapel=b.id_mapel and b.id_mapel='$idmapel' and a.id_siswa='$id_siswa' and a.id_kelas='$id_kelas' and a.id_semester='$id_semester'");
                                if ($nilaib->num_rows() > 0) {
                                    foreach ($nilaib->result() as $b) { ?>
                                        <td>
                                            <?= $b->total_nilai ?>
                                        </td>
                                        <td>
                                            <?= $b->nilai_keterampilan ?>
                                        </td>
                                        <td>
                                            <?= $nilai_akhir = ($b->total_nilai+$b->nilai_keterampilan)/2 ?>
                                        </td>
                                        <td>
                                            <?php if ($b->total_nilai >= 80) {
                                                echo 'A';
                                            } else if ($b->total_nilai >= 70 and $b->total_nilai <= 79) {
                                                echo 'B';
                                            } else if ($b->total_nilai >= 60 and $b->total_nilai <= 69) {
                                                echo 'C';
                                            } else if ($b->total_nilai >= 50 and $b->total_nilai <= 59) {
                                                echo 'D';
                                            } else if ($b->total_nilai >= 0 and $b->total_nilai <= 49) {
                                                echo 'E';
                                            } ?>

                                        </td>

                                        <td>
                                            <?= $b->deskripsi_nilai ?>
                                        </td>

                                        <?php

                                    }

                                } ?>

                            <?php } else if ($key->golongan == 'Muatan Peminatan Kejuruan') { ?>
                                <?php 
                                if (!$muatanPeminatanShown) {
                                // Tampilkan hanya jika belum ada yang ditampilkan sebelumnya
                                echo '
                                <thead>
                                    <tr>
                                        <th style="text-align: left;" colspan="8">C. Muatan Peminatan Kejuruan</th>
                                    </tr>
                                </thead>';
                                $muatanPeminatanShown = true; // Setel variabel penanda menjadi true setelah menampilkan satu baris
                            }
                            // Tampilkan baris data sesuai kebutuhan
                            echo '' ?>
                                <?php if($key->sub_muatan == 'Dasar Bidang Keahlian'){?>
                                     <?php 
                                if (!$bidangShown) {
                                // Tampilkan hanya jika belum ada yang ditampilkan sebelumnya
                                echo '
                                <thead>
                                    <tr>
                                        <th style="text-align: left;" colspan="8">C1. Dasar Bidang Keahlian</th>
                                    </tr>
                                </thead>';
                                $bidangShown = true; // Setel variabel penanda menjadi true setelah menampilkan satu baris
                            }
                            // Tampilkan baris data sesuai kebutuhan
                            echo '' ?>

                                    <tr>
                                        <td><?= $noc++ ?></td>
                                        <td><?php echo $key->mapel . '<hr> Pengampu:' . $key->nama_guru; ?></td>
                                        <td><?= $key->kkm ?></td>
                                        <?php
                                        $nilaic = $this->db->query("SELECT * FROM detail_nilai a, mapel b where a.id_mapel=b.id_mapel and b.id_mapel='$idmapel' and a.id_siswa='$id_siswa' and a.id_kelas='$id_kelas' and a.id_semester='$id_semester'");
                                        if ($nilaic->num_rows() > 0) {
                                            foreach ($nilaic->result() as $c) { ?>
                                                <td>
                                                    <?= $c->total_nilai ?>
                                                </td>
                                                <td>
                                                    <?= $c->nilai_keterampilan ?>
                                                </td>
                                                <td>
                                                    <?= $nilai_akhir = ($c->total_nilai+$c->nilai_keterampilan)/2 ?>
                                                </td>
                                                <td>
                                                    <?php if ($c->total_nilai >= 80) {
                                                        echo 'A';
                                                    } else if ($c->total_nilai >= 70 and $c->total_nilai <= 79) {
                                                        echo 'B';
                                                    } else if ($c->total_nilai >= 60 and $c->total_nilai <= 69) {
                                                        echo 'C';
                                                    } else if ($c->total_nilai >= 50 and $c->total_nilai <= 59) {
                                                        echo 'D';
                                                    } else if ($c->total_nilai >= 0 and $c->total_nilai <= 49) {
                                                        echo 'E';
                                                    } ?>

                                                </td>
                                                
                                                <td>
                                                    <?= $c->deskripsi_nilai ?>
                                                </td>

                                                <?php

                                            }

                                        } ?>

                                    <?php }else if($key->sub_muatan == 'Dasar Program Keahlian'){ ?>
                                        <?php 
                                if (!$programShown) {
                                // Tampilkan hanya jika belum ada yang ditampilkan sebelumnya
                                echo '
                                <thead>
                                    <tr>
                                        <th style="text-align: left;" colspan="8">C2. Dasar Program Keahlian</th>
                                    </tr>
                                </thead>';
                                $programShown = true; // Setel variabel penanda menjadi true setelah menampilkan satu baris
                            }
                            // Tampilkan baris data sesuai kebutuhan
                            echo '' ?>

                                        <tr>
                                            <td><?= $nod++ ?></td>
                                            <td><?php echo $key->mapel . '<hr> Pengampu:' . $key->nama_guru; ?></td>
                                            <td><?= $key->kkm ?></td>
                                            <?php
                                            $nilaid = $this->db->query("SELECT * FROM detail_nilai a, mapel b where a.id_mapel=b.id_mapel and b.id_mapel='$idmapel' and a.id_siswa='$id_siswa' and a.id_kelas='$id_kelas' and a.id_semester='$id_semester'");
                                            if ($nilaid->num_rows() > 0) {
                                                foreach ($nilaid->result() as $d) { ?>
                                                    <td>
                                                        <?= $d->total_nilai ?>
                                                    </td>
                                                    <td>
                                                        <?= $d->nilai_keterampilan ?>
                                                    </td>
                                                    <td>
                                                        <?= $nilai_akhir = ($d->total_nilai+$d->nilai_keterampilan)/2 ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($d->total_nilai >= 80) {
                                                            echo 'A';
                                                        } else if ($d->total_nilai >= 70 and $d->total_nilai <= 79) {
                                                            echo 'B';
                                                        } else if ($d->total_nilai >= 60 and $d->total_nilai <= 69) {
                                                            echo 'C';
                                                        } else if ($d->total_nilai >= 50 and $d->total_nilai <= 59) {
                                                            echo 'D';
                                                        } else if ($d->total_nilai >= 0 and $d->total_nilai <= 49) {
                                                            echo 'E';
                                                        } ?>

                                                    </td>

                                                    <td>
                                                        <?= $d->deskripsi_nilai ?>
                                                    </td>

                                                    <?php

                                                }

                                            }?>

                                        <?php }
                                    }

                                    $nilai_akhira = $nilai_akhira+$nilai_akhir;
                                    $rata_nilai_akhir = $nilai_akhira/$no++;

                                } ?>
                                <tr>
                                    <th colspan="3">Rata-rata</th>
                                    <?php $fixnilai = $this->db->query("select * from nilai where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_semester='$id_semester'")->row(); ?>
                                    <th colspan=""><?= number_format($rata_nilai = $fixnilai->nilai_rata_rata, 2, '.', ''); ?></th>
                                    <th colspan=""><?= number_format($rata_nilai_keterampilan = $fixnilai->nilai_keterampilan_rata_rata, 2, '.', ''); ?></th>
                                    <th colspan=""><?= number_format($rata_nilai_akhir, 2, '.', ''); ?></th>

                                    <th colspan="">
                                        <?php if ($rata_nilai_akhir >= 80) {
                                            echo 'A';
                                        } else if ($rata_nilai_akhir >= 70 and $rata_nilai_akhir <= 79) {
                                            echo 'B';
                                        } else if ($rata_nilai_akhir >= 60 and $rata_nilai_akhir <= 69) {
                                            echo 'C';
                                        } else if ($rata_nilai_akhir >= 50 and $rata_nilai_akhir <= 59) {
                                            echo 'D';
                                        } else if ($rata_nilai_akhir >= 0 and $rata_nilai_akhir <= 49) {
                                            echo 'E';
                                        } ?>
                                    </th>
                                </tr>
                            </tbody>

                        </table>
                        <hr>
                        <h5>B. Catatan Akademik</h5>
                        <table class="table table-bordered" width="100%" cellspacing="0" style="text-align: center;">
                            <tbody>
                                <tr>
                                 <?php
                                 $nilaik = $this->db->query("SELECT * FROM detail_nilai a, mapel b where a.id_mapel=b.id_mapel and a.id_mapel='$idmapel' and a.id_siswa='$id_siswa' and a.id_kelas='$id_kelas' and a.id_semester='$id_semester'");
                                 if ($nilaik->num_rows() > 0) {
                                    foreach ($nilaik->result() as $n) { ?>
                                        <td>
                                            <?= $n->deskripsi_nilai ?>
                                            <br>
                                            <?= $n->deskripsi_nilai_keterampilan ?>
                                        </td>

                                        <?php
                                    }
                                } ?>
                            </tr>     
                        </tbody>

                    </table>

                <a target='_blank' href="<?= site_url('siswa/cetakraport/' . $id_siswa . '/' . $id_kelas . '/' . $id_semester) ?>" class="btn btn-primary btn-block">Cetak Raport</a>
            </div>
        </div>
    </div>

</div>