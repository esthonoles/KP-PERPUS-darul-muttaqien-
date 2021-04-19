<?php
require_once "_config/conn.php";

$kelas = mysqli_query($conn, "SELECT * FROM tb_kelas ORDER BY kelas ASC");

if (isset($_POST['tambah'])) {
    $kelas = htmlspecialchars($_POST['kelas']);

    $query = "INSERT INTO tb_kelas VALUES (null,'$kelas')";

    if (mysqli_query($conn, $query)) {
        echo " 
                <script>alert('data berhasil ditambahkan!');
                document.location.href= '?pages=kelas';
                </script>
                ";

        header('Location: kelas.php');
    } else {
        echo "Err:" . $query . "" . mysqli_error($conn);
    }
    // mysqli_close($conn);
}

?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-dark font-weight-bold">MASTER DATA KELAS</h1>

    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-xl-8 col-md-6">
                            <div class="table-responsive">
                                <table class="table table-striped text-dark" id="mauexport" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode Kelas</th>
                                            <th>Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kelas as $kls) :
                                        ?>
                                            <tr>
                                                <td><?= $kls['id_kelas'] ?></td>
                                                <td><?= $kls['kelas']; ?></td>
                                                <td style="width: 100px;"><a href="?pages=kelas&aksi=hapus&id=<?= $kls['id'] ?>" class="btn btn-sm btn-danger" name="hapus" onclick="return confirm('Hapus Kelas <?= $kls['kelas']; ?> ? ')"><i class="far fa-trash-alt">
                                                        </i> hapus</a></td>
                                            </tr>
                                        <?php $no++;
                                        endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-4">
                            <form action="" method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="kelas" placeholder="kelas" required autofocus autocomplete="off">

                                </div>
                                <div class="input-group d-grid">
                                    <button type="submit" name="tambah" class="btn btn-primary btn-sm" style="width: 100%;"><i class="fas fa-plus"></i> Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#mauexport').DataTable({
            // untuk menampilkan tombol export data
            // dom: 'Bfrtip',
            // buttons: [
            //     'csv', 'excel', 'pdf', 'print'
            // ]
        });
    });
</script>