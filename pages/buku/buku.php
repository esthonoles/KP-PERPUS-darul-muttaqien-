<?php
require_once "_config/conn.php";
require "libs/vendor/autoload.php";



$show_buku = mysqli_query($conn, "SELECT * FROM tb_buku ORDER BY judul ASC");

?>


<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-dark font-weight-bold">MASTER DATA BUKU</h1>

    </div>

    <div class="row m-auto">
        <div class="mb-3">
            <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambahbuku">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>

        </div>
        <div class="ml-2">
            <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#import">
                <span class="icon text-white-50">
                    <i class="fas fa-upload"></i>
                </span>
                <span class="text">Import Data </span>
            </a>
        </div>
        <div class="ml-2">
            <a href="?pages=export&aksi=buku" class="btn btn-success btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-file-export"></i>
                </span>
                <span class="text">Export Data</span>
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="data-tables table-responsive">
                <table class="table table-striped text-dark" id="mauexport" width="100%" cellspacing="0">
                    <thead class="table-bordered">
                        <tr>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th>ISBN</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($show_buku as $buku) : ?>
                            <tr>

                                <td><?= $buku['kdbuku'] ?></td>
                                <td><?= $buku['judul'] ?></td>
                                <td><?= $buku['penulis'] ?></td>
                                <td><?= $buku['penerbit'] ?></td>
                                <td><?= $buku['tahun'] ?></td>
                                <td><?= $buku['jumlah'] ?></td>
                                <td><?= $buku['isbn'] ?></td>
                                <td class="d-sm-inline-flex ">

                                    <a href="" class="btn btn-sm btn-warning ml-1" id="btn_edit" data-toggle="modal" data-target="#modal_edit" data-id="<?= $buku['id']; ?>" data-judul="<?= $buku['judul'] ?>" data-penulis="<?= $buku['penulis'] ?>" data-penerbit="<?= $buku['penerbit'] ?>" data-kategori="<?= $buku['asal'] ?>" data-tahun="<?= $buku['tahun'] ?>" data-jumlah="<?= $buku['jumlah'] ?>" data-isbn="<?= $buku['isbn'] ?>">

                                        <i class=" far fa-edit"></i></a>
                                    <a href="?pages=buku&aksi=hapus&id=<?= $buku['id']; ?>" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="far fa-trash-alt">
                                        </i></a>

                                </td>
                            </tr>
                        <?php

                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Form tambah buku -->
    <div class="modal fade " id="tambahbuku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Buku Baru</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="judul">Kode Buku</label>
                            <input class="form-control" name="kd_buku" type="text" placeholder="Kode Buku" required autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul Buku </label>
                            <input class="form-control" name="judul" type="text" placeholder="judul buku" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis </label>
                            <input class="form-control" name="penulis" type="text" placeholder="penulis" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input class="form-control" name="penerbit" type="text" placeholder="penerbit" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="kategori">
                                <option value="">-- Pilih --</option>
                                <option value="hibah">Buku Hibah</option>
                                <option value="beli">Pembelian</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="tahunTerbit">Tahun Terbit</label>
                            <input class="form-control" name="tahun" type="number" placeholder="tahun terbit" required>
                        </div> -->
                        <div class="form-group">
                            <label for="tahun">Tahun Terbit</label>
                            <select class="form-control" name="tahun" id="tahun_terbit" required>
                                <option value="">-- Pilih --</option>
                                <?php
                                for ($tahun = date('Y'); $tahun >= 1990; $tahun--) {
                                    echo '<option value="' . $tahun . '">' . $tahun . '</option>';
                                }
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah </label>
                            <input class="form-control" name="jumlah" type="number" placeholder="jumlah" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="isbn">Kode ISBN </label>
                            <input class="form-control" name="isbn" type="text" placeholder="kode isbn" autocomplete="off" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                        </div>
                    </form>
                </div>

                <?php

                //  fungsi tambah data buku
                use Ramsey\Uuid\Uuid;


                if (isset($_POST['simpan'])) {
                    $uuid = Uuid::uuid4()->toString();
                    $kdbuku = htmlspecialchars($_POST["kd_buku"]);
                    $judul = htmlspecialchars($_POST["judul"]);
                    $penulis = htmlspecialchars($_POST["penulis"]);
                    $penerbit = htmlspecialchars($_POST["penerbit"]);
                    $kategori = ($_POST["kategori"]);
                    $tahun = htmlspecialchars($_POST["tahun"]);
                    $jumlah = htmlspecialchars($_POST["jumlah"]);
                    $isbn = htmlspecialchars($_POST["isbn"]);

                    // var_dump($_POST);

                    $query = "insert into tb_buku values ('$uuid','$kdbuku','$judul','$penulis','$penerbit','$kategori','$jumlah','$tahun','$isbn')";

                    if (mysqli_query($conn, $query)) {
                        echo " 
                            <script>alert('data berhasil ditambahkan!');
                            document.location.href= '?pages=buku';
                            </script>
                            ";

                        header('Location: anggota.php');
                    } else {
                        echo "Err:" . $query . "" . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                }
                ?>

            </div>
        </div>
    </div>



    <!-- Modal Form edit buku -->
    <div class="modal fade " id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Buku Baru</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_edit">
                    <form action="" method="POST">
                        <input type="hidden" id="fid_buku" name="fid_buku">
                        <div class="form-group">
                            <label for="judul">Judul Buku </label>
                            <input class="form-control" name="fjudul" id="fjudul" type="text" placeholder="judul buku" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis </label>
                            <input class="form-control" name="fpenulis" id="fpenulis" type="text" placeholder="penulis" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input class="form-control" name="fpenerbit" id="fpenerbit" type="text" placeholder="penerbit" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="fkategori" id="fkategori">
                                <option value="">-- Pilih --</option>
                                <option value="hibah">Buku Hibah</option>
                                <option value="beli">Pembelian</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="tahunTerbit">Tahun Terbit</label>
                            <input class="form-control" name="ftahun" id="ftahun" type="number" placeholder="tahun terbit" required>
                        </div> -->
                        <div class="form-group">
                            <label for="tahun">Tahun Terbit</label>
                            <select class="form-control" name="ftahun" id="ftahun" required>
                                <option value="">-- Pilih --</option>
                                <?php
                                for ($tahun = date('Y'); $tahun >= 1990; $tahun--) {
                                    echo '<option value="' . $tahun . '">' . $tahun . '</option>';
                                }
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah </label>
                            <input class="form-control" name="fjumlah" id="fjumlah" type="number" placeholder="jumlah" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="isbn">Kode ISBN </label>
                            <input class="form-control" name="fisbn" id="fisbn" type="text" placeholder="kode isbn" autocomplete="off" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit" name="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- fungsi modal import php -->

<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['import'])) {
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $ext_file = end($ekstensi);
    $file_name = "file-" . round(microtime(true)) . "." . end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];

    $target_dir = "pages/buku/import/";
    $target_file = $target_dir . $file_name;
    move_uploaded_file($sumber, $target_file);

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($target_file);
    $data = $spreadsheet->getActiveSheet()->toArray();

    for ($i = 2; $i < count($data); $i++) {
        $uuid = Uuid::uuid4()->toString();

        $kdbuku = $data[$i]['0'];
        $judul = $data[$i]['1'];
        $penulis = $data[$i]['2'];
        $penerbit = $data[$i]['3'];
        $asal = $data[$i]['4'];
        $jumlah = $data[$i]['5'];
        $tahun = $data[$i]['6'];
        $isbn = $data[$i]['7'];

        mysqli_query($conn, "insert into tb_buku values('$uuid','$kdbuku','$judul','$penulis',
                            '$penerbit','$asal','$jumlah','$tahun','$isbn')");
    }

    unlink($target_file);
    header("location:?pages=buku");
}
?>





<!-- modal inport excel -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post" enctype="multipart/form-data" class="mt-4">
                    <div class="col">
                        <a href="pages/buku/import/sample/buku.xlsx" class="btn btn-success btn-icon-split btn-sm mb-3">

                            <span class="icon text-white-50">
                                <i class="fas fa-download"></i>
                            </span>
                            <span class="text">Download Format File Excel</span>
                        </a>
                        <div class="input-group mb-3">

                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                <!-- <input type="file" name="file" /><br /><br /> -->
                            </div>
                            <!-- <input type="submit" name="import" value="Upload" /> -->
                            <button type="submit" class="btn btn-sm btn-primary ml-2" name="import"> <i class="fas fa-upload"></i> upload</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>



<?php
if (isset($_POST['update'])) {
    $id = $_POST['fid_buku'];
    $judul = $_POST['fjudul'];
    $penulis = $_POST['fpenulis'];
    $penerbit = $_POST['fpenerbit'];
    $kategori = $_POST['fkategori'];
    $tahun = $_POST['ftahun'];
    $jumlah = $_POST['fjumlah'];
    $isbn = $_POST['fisbn'];

    $update_query = mysqli_query($conn, "UPDATE tb_buku SET 
                                                       judul='$judul', 
                                                       penulis='$penulis',
                                                       penerbit='$penerbit',
                                                       asal='$kategori',
                                                       jumlah=$jumlah,
                                                       tahun='$tahun',
                                                       isbn=$isbn
                                                       WHERE id='$id' ");
    if ($update_query) {
        echo " 
            <script>alert('data berhasil diubah!');
            document.location.href= '?pages=buku';
            </script>
            ";

        header('Location: buku.php');
    } else {
        echo "Err:" . $update_query . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}


// var_dump($_POST);
?>



<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<script>
    $(document).on("click", "#btn_edit", function() {
        var id = $(this).data('id');
        var judul = $(this).data('judul');
        var penulis = $(this).data('penulis');
        var penerbit = $(this).data('penerbit');
        var kategori = $(this).data('kategori');
        var tahun = $(this).data('tahun');
        var jumlah = $(this).data('jumlah');
        var isbn = $(this).data('isbn');

        // console.log(id);

        $("#modal_edit #fid_buku").val(id);
        $("#modal_edit #fjudul").val(judul);
        $("#modal_edit #fpenulis").val(penulis);
        $("#modal_edit #fpenerbit").val(penerbit);
        $("#modal_edit #fkategori").val(kategori);
        $("#modal_edit #ftahun").val(tahun);
        $("#modal_edit #fjumlah").val(jumlah);
        $("#modal_edit #fisbn").val(isbn);
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