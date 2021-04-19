<?php
require_once "_config/conn.php";
$show_buku = mysqli_query($conn, "SELECT * FROM tb_buku ORDER BY judul ASC");
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 mb-0 text-dark font-weight-bold">EXPORT DATA BUKU</h1>
    <a href="?pages=buku" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>


<div class="data-tables table-responsive mt-3">
    <table class="table table-striped text-dark" id="mauexport" width="100%" cellspacing="0">
        <thead class="table-bordered">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Judul</th>
                <th>Penulis</th>

                <th>Kategori</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>ISBN</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            foreach ($show_buku as $buku) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $buku['kdbuku'] ?></td>
                    <td><?= $buku['judul'] ?></td>
                    <td><?= $buku['penulis'] ?></td>
                    <td><?= $buku['asal'] ?></td>
                    <td><?= $buku['tahun'] ?></td>
                    <td><?= $buku['jumlah'] ?></td>
                    <td><?= $buku['isbn'] ?></td>

                </tr>
            <?php
                $no++;
            endforeach; ?>
        </tbody>
    </table>
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