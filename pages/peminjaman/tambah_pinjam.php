<?php
$tanggal = date("Y-m-d");

$tgl2 = date('Y-m-d', strtotime('+7 days', strtotime($tanggal)));

$query = mysqli_query($conn, "SELECT max(id_pinjam) as maxkode from tb_pinjam");
$data = mysqli_fetch_array($query);
$id = $data['maxkode'];
$no = substr($id, 5, 4);

$no = (int) $no;
$no++;
$str = 'TRX-P';
$id_pinjam = $str . sprintf("%04s", $no);

// echo $id_pinjam;



// action tambah pinjaman
if (isset($_POST['btn_pinjam'])) {
    $id_anggota = $_POST["id_anggota"];

    $id_buku = $_POST["idbuku"];

    $pinjam = "insert into tb_pinjam values ('$id_pinjam','$id_anggota','$id_buku','$tanggal', '$tgl2','pinjam',1);";

    if (mysqli_query($conn, $pinjam)) {
        echo " 
            <script>alert('data berhasil ditambahkan!');
            document.location.href= '?pages=peminjaman';
            </script>
            ";

        // header('Location: anggota.php');
    } else {
        echo "Err:" . $pinjam . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> -->
<style>
    div.dataTables_wrapper {
        margin-bottom: 3em;
    }
</style>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 text-dark font-weight-bold">TRANSAKSI PEMINJAMAN BUKU</h1>
    <a href="?pages=peminjaman" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-md-6 mx-auto">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form method="POST">
                    <div class="input-group mb-3">
                        <input type="hidden" name="id_anggota" id="id_anggota">
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="id anggota" autofocus autocomplete="off" required>
                        <div class="input-group-append">
                            <button class="btn btn-success" data-toggle="modal" data-target="#kd_anggota"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="nama">No Induk</label>
                            <input type="text" name="nis" id="nis" class="form-control" placeholder="No Induk" disabled>

                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="kelas">Kelas</label>
                            <input type="text" name="kelas" id="kelas" class="form-control" placeholder="kelas" disabled>

                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="hidden" name="id_buku" id="id_buku">
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Buku" autocomplete="off" required>
                        <div class="input-group-append">
                            <button class="btn btn-success" data-toggle="modal" data-target="#cari_buku"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="form-row">
                        <input type="hidden" name="idbuku" id="idbuku">
                        <div class="col-md-6">
                            <label for="judul">Kode Buku</label>
                            <input type="text" name="kdbuku" id="kdbuku" class="form-control" placeholder="Kode Buku" disabled>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="penulis">Penulis</label>
                            <input type="text" name="penulis" id="penulis" class="form-control" placeholder="penulis" disabled>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                        <input type="text" name="tgl_pinjam" class="form-control" placeholder="tanggal_pinjam" value="<?= $tanggal ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input type="text" name="tgl_kembali" class="form-control" placeholder="tanggal_kembali" value="<?= $tgl2 ?>" disabled>
                    </div>

                    <button type="submit" name="btn_pinjam" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan</button>

                    <a href="" type="reset" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-eraser fa-sm text-white-50"></i> Reset</a>

                </form>
            </div>
        </div>
    </div>

    <!-- modal cari anggota -->
    <div class="modal fade" id="kd_anggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Nama Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php
                    $select_data = "SELECT * FROM tb_anggota INNER JOIN tb_kelas on tb_anggota.id_kelas = tb_kelas.id_kelas";
                    $query = mysqli_query($conn, $select_data);
                    ?>

                    <div class="table-responsive">
                        <table class="table table-striped text-dark" id="mauexport" width="100%" cellspacing="0">
                            <thead class="table-bordered">
                                <tr>
                                    <td>No Induk</td>
                                    <td>Nama</td>
                                    <td>Kelas</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $anggota) : ?>
                                    <tr>
                                        <td><?= $anggota['nis'] ?></td>
                                        <td><?= $anggota['nama'] ?></td>
                                        <td><?= $anggota['kelas'] ?></td>
                                        <td><button id="select_id" class="btn btn-sm btn-info" data-id="<?= $anggota['id']; ?>" data-nama="<?= $anggota['nama']; ?> " data-kelas="<?= $anggota['kelas']; ?>" data-nis="<?= $anggota['nis']; ?>">select</button></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="cari_buku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Judul Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php
                    $buku = "SELECT * FROM tb_buku";
                    $sql = mysqli_query($conn, $buku);

                    ?>

                    <div class="table-responsive">
                        <table class="table display table-striped text-dark" id="mauexport" width="100%" cellspacing="0">
                            <thead class="table-bordered ">
                                <tr>
                                    <td>Kode</td>
                                    <td>Judul</td>
                                    <td>Penulis</td>
                                    <td>Keterangan</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST["cari_judul"])) {
                                }

                                ?>

                                <?php foreach ($sql as $buku) : ?>
                                    <tr>
                                        <td><?= $buku['kdbuku'] ?></td>
                                        <td><?= $buku['judul'] ?></td>
                                        <td><?= $buku['penulis'] ?></td>

                                        <?php
                                        if ($buku['jumlah'] == 0) { ?>

                                            <td class="text-danger font-weight-bold">dipinjam</td>
                                            <td><button id="buku_id" class="btn btn-sm btn-danger" disabled>select</button></td>
                                        <?php } else { ?>

                                            <td class="text-success font-weight-bold">tersedia</td>
                                            <td><button id="buku_id" class="btn btn-sm btn-success" data-id="<?= $buku['id']; ?>" data-judul="<?= $buku['judul']; ?> " data-penulis="<?= $buku['penulis']; ?>" data-kd="<?= $buku['kdbuku']; ?>">select</button></td>
                                        <?php } ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function() {
        $('table.display').DataTable();
    });
</script>

<!-- live search judul buku -->

<script>
    $(document).on("click", "#select_id", function() {
        var id = $(this).data('id');
        var nis = $(this).data('nis');
        var nama = $(this).data('nama');
        var kelas = $(this).data('kelas');
        // console.log(id);

        $("#nis").val(nis);
        $("#id_anggota").val(id);
        $("#nama").val(nama);
        $("#kelas").val(kelas);

        $("#kd_anggota").modal("hide");
    })
</script>

<script>
    $(document).on("click", "#buku_id", function() {
        var idbk = $(this).data('id');
        var kdbk = $(this).data('kd');
        var judul = $(this).data('judul');
        var penulis = $(this).data('penulis');
        // console.log(id);

        $("#idbuku").val(idbk);
        $("#kdbuku").val(kdbk);
        $("#judul").val(judul);
        $("#penulis").val(penulis);

        $("#cari_buku").modal("hide");
    })
</script>


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