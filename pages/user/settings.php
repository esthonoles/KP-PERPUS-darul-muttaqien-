<?php
require_once "_config/conn.php";
$tampil = mysqli_query($conn, "SELECT * FROM tb_user");

// tambah data user
if (isset($_POST['simpan'])) {

    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);
    $level = $_POST['level'];

    $query = "INSERT INTO tb_user VALUES (null,'$nama','$username',md5('$pass'),'$level')";

    if (mysqli_query($conn, $query)) {
        echo " 
                                    <script>alert('data berhasil ditambahkan!');
                                    document.location.href= '?pages=settings';
                                    </script>
                                    ";

        // header('Location: anggota.php');
    } else {
        echo "Err:" . $query . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}

// ########### hapus user




?>
<div class="contaiern">
    <div class="col-xl-12 col-lg-6">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="mb-3">
                <h1 class="h3 mb-0 text-gray-800">Data Pengguna Sistem</h1>
            </div>
            <div class="mb-3">
                <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambah_user">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah User Baru</span>
                </a>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Hak Akses</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tampil as $user) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $user['nama']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['password']; ?></td>
                                    <td><?= $user['level']; ?></td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-primary" data-placement="bottom" title="kembalikan"><i class="fas fa-edit"></i> edit</a>

                                        <a href="?pages=settings&aksi=hapus&id=<?= $user['id_user'] ?>" class="btn btn-sm btn-danger" data-placement="bottom" title="perpanjang" onclick="return confirm('Hapus <?= $user['nama'] ?> ?')"><i class="far fa-trash-alt">
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
    </div>
</div>


<!-- Modal add user -->
<div class="modal fade" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama lengkap" autofocus autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Hak Akses</label>
                        <select class="form-control" id="level" name="level">
                            <option>-- pilih --</option>
                            <option value="admin">Administrator</option>
                            <option value="user">User</option>
                        </select>
                    </div </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal add user -->