<?php
require_once "_config/conn.php";
require "libs/vendor/autoload.php";

$kelas = mysqli_query($conn, "SELECT * FROM tb_kelas ORDER BY kelas ASC");
$select_data = "SELECT * FROM tb_anggota INNER JOIN tb_kelas on tb_anggota.id_kelas = tb_kelas.id_kelas";
$query = mysqli_query($conn, $select_data);
?>


<div class="d-sm-flex align-items-center justify-content-between">
    <div class="mb-3">
        <h1 class="h5 mb-0 text-dark font-weight-bold">DATA ANGGOTA</h1>
    </div>

</div>

<div class="row m-auto">
    <div class="mb-3">
        <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#add">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a>
    </div>

    <div class="ml-2">
        <a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#import">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Import Data</span>
        </a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="data-tables table-responsive">
            <table class="table table-striped text-dark" id="mauexport" width="100%" cellspacing="0">
                <thead class="table-bordered">
                    <tr>

                        <th>No Induk</th>
                        <th>Nama Anggota</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    foreach ($query as $anggota) : ?>
                        <tr>

                            <td><?= $anggota['nis']; ?></td>
                            <td><?= $anggota['nama']; ?></td>
                            <td><?= $anggota['kelas']; ?></td>
                            <?php if ($anggota['jk'] == 'L') {
                                echo "<td>Laki-Laki</td>";
                            } else {
                                echo "<td>Perempuan</td>";
                            } ?>
                            <td class="d-flex justify-content-center">
                                <a class="btn btn-primary btn-sm " id="btn_edit" data-toggle="modal" data-target="#modal_ubah" data-id="<?= $anggota['id']; ?>" data-nis="<?= $anggota['nis'] ?>" data-nama="<?= $anggota['nama'] ?>" data-kelas="<?= $anggota['id_kelas']; ?>" data-jk="<?= $anggota['jk']; ?>"><i class=" far fa-edit"></i> edit</a>

                                <a class="btn btn-danger btn-sm ml-2" onclick="return confirm('Anda yakin mau menghapus item ini ?')" href="?pages=anggota&aksi=hapus&id=<?= $anggota['id']; ?>"><i class="far fa-trash-alt">
                                    </i> hapus</a>
                            </td>
                        </tr>

                    <?php $no++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ------------------------ modal tambah data -->
<div class="modal fade " id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Anggota </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">No Induk</label>
                        <input class="form-control" name="nis" type="text" autofocus autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Anggota</label>
                        <input class="form-control text-uppercase" name="nama" type="text" autofocus autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jk">
                            <option>-- Pilih --</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Pilih Kelas :</label>
                        <select class="form-control" name="kelas">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($kelas as $kls) : ?>
                                <option value="<?= $kls["id_kelas"]; ?>"><?= $kls["kelas"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" id="update" class="btn btn-primary" name="add" value="Simpan">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- modal import data anggota -->

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
                        <a href="pages/anggota/import/sample/anggota.xlsx" class="btn btn-success btn-icon-split btn-sm mb-3">

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



<!-- fungsi modal import php -->

<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Ramsey\Uuid\Uuid;

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

    echo $file_name;
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($target_file);
    $data = $spreadsheet->getActiveSheet()->toArray();

    for ($i = 2; $i < count($data); $i++) {
        $uuid = Uuid::uuid4()->toString();

        $nis = $data[$i]['0'];
        $nama = $data[$i]['1'];
        $id_kelas = $data[$i]['2'];
        $jk = $data[$i]['3'];

        mysqli_query($conn, "insert into tb_anggota values('$uuid','$nis','$nama','$id_kelas',
                            '$jk')");
    }

    unlink($target_file);
    header("location:?pages=anggota");
}
?>







<!-- end of modal import data anggota -->



<?php


if (isset($_POST['add'])) {
    $uuid = Uuid::uuid4()->toString();
    $nis = htmlspecialchars($_POST['nis']);
    $nama = htmlspecialchars($_POST['nama']);
    $kls = $_POST['kelas'];
    $jk = $_POST['jk'];

    $insert = "insert into tb_anggota values('$uuid', '$nis', '$nama', '$kls', '$jk')";
    $sql = mysqli_query($conn, $insert);

    if ($sql) {
        echo " 
        <script>alert('data berhasil ditambahkan!');
        document.location.href= '?pages=anggota';
        </script>
        ";

        header('Location: anggota.php');
    } else {
        echo "Err:" . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>




<!-- ------------------------End modal tambah data -->

<!-- ############## EDIT ANGGOTA ##################### -->

<div class="modal fade " id="modal_ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Data Anggota</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modal_edit">
                <form id="form_edit" method="post">
                    <input type="hidden" name="fid" id="fid">
                    <!-- <input type="hidden" name="fnis" id="fnis"> -->
                    <div class="form-group">
                        <label for="nama">No Induk</label>
                        <input class="form-control" name="fnis" id="fnis" type="text" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Anggota</label>
                        <input class="form-control" name="fnama" id="fnama" type="text" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="fjenis_kelamin" class="form-control" name="fjenis_kelamin">
                            <option>Pilih</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="fkelas" id="fkelas" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($kelas as $kls) : ?>
                                <option value="<?= $kls["id_kelas"]; ?>"><?= $kls["kelas"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn  btn-primary" name="update">Update</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- fungsi modal import php -->

<?php
if (isset($_POST['import'])) {
    $file = $_FILES['file']['nama'];
    $ekstensi = explode(".", $file);
    $file_name = "file-" . round(microtime(true)) . "." . end($ekstensi);
    $source = $_FILES['file']['tmp_name'];
    $target_dir = "../_file/";
    $target_file = $target_dir . $target_file;
    $upload = move_uploaded_file($source, $target_files);

    // if ($upload) {
    //     echo "Upload Success";
    // } else {
    //     echo "Upload Gagal!!";
    // }
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
            <div class="modal-body" method="post" action="" enctype="multipart/form-data">
                <form action="">
                    <div class="col">
                        <a href="" class="btn btn-success btn-icon-split btn-sm mb-3">

                            <span class="icon text-white-50">
                                <i class="fas fa-download"></i>
                            </span>
                            <span class="text">Download Format File Excel</span>
                        </a>
                        <div class="input-group mb-3">

                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">pilih file</label>
                            </div>
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

<!-- masih ada erro pas update -->
<?php
if (isset($_POST['update'])) {
    $id = $_POST['fid'];
    $nis = $_POST['fnis'];
    $nama = $_POST['fnama'];
    $kls = $_POST['fkelas'];
    $jk = $_POST['fjenis_kelamin'];

    $update_query = mysqli_query($conn, "UPDATE tb_anggota SET 
                                        nis ='$nis', 
                                        nama ='$nama',
                                        id_kelas ='$kls',
                                        jk = '$jk'
                                WHERE id='$id' ");

    if ($update_query) {
        echo $nis, $nama, $kls, $jk, $id;
        echo " 
            <script>alert('data berhasil diubah!');
            document.location.href= '?pages=anggota';
            </script>
            ";
    } else {
        echo "Err:" . $update_query . "" . mysqli_error($conn);
    }
}
?>



<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<script>
    $(document).on("click", "#btn_edit", function() {
        var id = $(this).data('id');
        var nis = $(this).data('nis');
        var nama = $(this).data('nama');
        var kelas = $(this).data('kelas');
        var jk = $(this).data('jk');

        $("#modal_edit #fid").val(id);
        $("#modal_edit #fnis").val(nis);
        $("#modal_edit #fnama").val(nama);
        $("#modal_edit #fkelas").val(kelas);
        $("#modal_edit #fjenis_kelamin").val(jk);
    })
</script>


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