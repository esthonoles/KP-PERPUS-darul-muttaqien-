<?php
// include "_config/conn.php";

$kunjung = "SELECT * FROM tb_pengunjung INNER JOIN tb_kelas on tb_pengunjung.id_kelas = tb_kelas.id_kelas
            ";

$run = mysqli_query($conn, $kunjung);

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 text-dark font-weight-bold">DATA PENGUNJUNG PERPUS</h1>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-dark" id="mauexport" width="100%" cellspacing="0">
                        <thead class="table-bordered">
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tgl Kunjung</th>
                                <th>Keperluan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($run as $tampil) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $tampil['nama'] ?></td>
                                    <td style="width: 10px;"><?= $tampil['kelas'] ?></td>
                                    <td><?= $tampil['tgl_kunjung'] ?></td>
                                    <td><?= $tampil['keperluan'] ?></td>
                                </tr>
                            <?php $no++;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#mauexport').DataTable({
            // untuk menampilkan tombol export data
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>