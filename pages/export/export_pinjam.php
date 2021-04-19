<?php
require_once "_config/conn.php";

$select_data = "SELECT * FROM tb_pinjam
INNER JOIN tb_buku on tb_pinjam.id_buku = tb_buku.id
INNER JOIN tb_anggota on tb_pinjam.id_anggota = tb_anggota.id where status = 'pinjam'";
$run = mysqli_query($conn, $select_data);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 mb-0 text-dark font-weight-bold">EXPORT DATA PEMINJAMAN</h1>
    <a href="?pages=peminjaman" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>


<div class="data-tables table-responsive">
    <table class="table text-dark" id="mauexport" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
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
                // hitung keterlambatan pengembalian buku
                $date1 = date_create($pinjam['tgl_kembali']);
                $date2 = date_create(date("Y-m-d"));

            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $pinjam['nis'] ?></td>
                    <td><?= $pinjam['nama'] ?></td>
                    <td><?= $pinjam['judul'] ?></td>
                    <td><?= $pinjam['tgl_pinjam'] ?></td>
                    <td><?= $pinjam['tgl_kembali'] ?></td>

                    <td>
                        <a class="btn btn-sm btn-danger"><?= $pinjam['status'] ?></a>
                    </td>

                </tr>
            <?php
                $no++;
            endforeach
            ?>

        </tbody>
    </table>
</div>


<script>
    $(document).ready(function() {
        $('#mauexport').DataTable({
            // untuk menampilkan tombol export data
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>