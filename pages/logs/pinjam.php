<?php
// include "_config/conn.php";
$select_data = "SELECT * FROM tb_pinjam
INNER JOIN tb_buku on tb_pinjam.id_buku = tb_buku.id
INNER JOIN tb_anggota on tb_pinjam.id_anggota = tb_anggota.id ";
$run = mysqli_query($conn, $select_data);

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data logs Peminjaman Buku</h1>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <!-- <h6 class="m-0 font-weight-bold text-primary">cetak per tanggal</h6> -->
                <div>

                    <a href="export_pinjam.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export Excel</a>
                    <a href="" type="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print fa-sm text-white-50"></i> Print </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-bordered">
                            <tr>

                                <th>Nama Siswa</th>
                                <th>Judul Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($run as $pinjam) :

                                if ($pinjam['status'] == 'pinjam') {
                                    $ket = 'class="text-danger font-weight-bold"';
                                } else {
                                    $ket = "";
                                }
                            ?>
                                <tr <?= $ket ?>>
                                    <td><?= $pinjam['nama'] ?></td>
                                    <td><?= $pinjam['judul'] ?></td>
                                    <td><?= $pinjam['tgl_pinjam'] ?></td>
                                    <td><?= $pinjam['tgl_kembali'] ?></td>
                                    <td><?= $pinjam['status'] ?></td>
                                </tr>
                            <?php
                                $no++;
                            endforeach
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>