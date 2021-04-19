<?php
require_once "_config/conn.php";

$select_data = "SELECT * FROM tb_pinjam
INNER JOIN tb_buku on tb_pinjam.id_buku = tb_buku.id
INNER JOIN tb_anggota on tb_pinjam.id_anggota = tb_anggota.id where status = 'pinjam'";
$run = mysqli_query($conn, $select_data);

// $tampil_pinjam = mysqli_query($conn, "SELECT * FROM tb_sirkulasi where status = 'pinjam'");

?>

<div class="d-sm-flex align-items-center justify-content-between">
    <div class="mb-3">
        <h1 class="h5 mb-0 text-dark font-weight-bold">DATA PEMINJAMAN</h1>
    </div>
</div>

<div class=" m-auto row">
    <div class="mb-3">
        <a href="?pages=peminjaman&aksi=tambah"" class=" btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data Baru</span>
        </a>
    </div>

    <div class="ml-2">
        <a href="?pages=export&aksi=peminjaman" class=" btn btn-warning btn-icon-split btn-sm">
            <span class="icon text-white-40">
                <i class="fas fa-file-export"></i>
            </span>
            <span class="text">Export Data</span>
        </a>
    </div>
</div>

<div class="card shadow ">
    <div class="card-body">
        <div class="data-tables table-responsive">
            <table class="table text-dark" id="mauexport" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <!-- <th>Keterangan</th> -->
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>


                    <?php

                    $no = 1;
                    foreach ($run as $pinjam) :
                        // hitung keterlambatan pengembalian buku
                        $date1 = date_create($pinjam['tgl_kembali']);
                        $date2 = date_create(date("Y-m-d"));

                        // $tgl = date("Y-m-d");

                        $diff = date_diff($date1, $date2);

                        $selisih = $diff->format('Terlambat %R%a hari');


                        // $date_kembali = date_create($pinjam['tgl_kembali']);
                        // $terlambat = abs(strtotime($date_kembali) - strtotime($tgl));
                        // $hitung_hari = floor($terlambat / (60 * 60 * 24));

                        // echo $hitung_hari


                    ?>
                        <tr>

                            <td><?= $pinjam['nama'] ?></td>
                            <td><?= $pinjam['judul'] ?></td>
                            <td><?= $pinjam['tgl_pinjam'] ?></td>
                            <td><?= $pinjam['tgl_kembali'] ?></td>
                            <!-- <td class="text-danger"><?php echo $selisih; ?></td> -->
                            <td>
                                <a class="btn btn-sm btn-danger"><?= $pinjam['status'] ?></a>
                            </td>
                            <td>
                                <a href="?pages=peminjaman&aksi=kembalikan&id=<?= $pinjam['id_pinjam']; ?>" class="btn btn-sm btn-primary" data-placement="bottom" title="kembalikan"><i class="fas fa-undo-alt"></i></a>
                                <a href="?pages=peminjaman&aksi=perpanjang&id=<?= $pinjam['id_pinjam']; ?>&tgl=<?= $pinjam['tgl_kembali'] ?>
                                " class="btn btn-sm btn-success" data-placement="bottom" title="perpanjang"><i class="fas fa-clock">
                                    </i></a>
                            </td>
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


<!-- menampilkan data tables tombol export -->
<script>
    $(document).ready(function() {
        $('#mauexport').DataTable({
            // untuk menampilkan tombol export data
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
        });
    });
</script>