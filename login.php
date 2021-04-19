<?php
ob_start();
session_start();
require_once "_config/conn.php";
$kelas = mysqli_query($conn, 'SELECT * FROM tb_kelas ORDER BY kelas ASC');

$tanggal = date('l,d-m-Y');
$jam = date('H:i:s');

// submit data pengunjung
if (isset($_POST["submit"])) {

    global $conn;
    $nama = htmlspecialchars($_POST["nama"]);
    $kelas = $_POST["kelas"];
    $keperluan = htmlspecialchars($_POST["keperluan"]);

    $query = "insert into tb_pengunjung values ( null,'$nama','$kelas',now(),'$keperluan')";
    mysqli_query($conn, $query);

    if ($_POST["submit"] > 0) {
        echo "
        <script>
        alert('Data Saved');
        window.location.href='login.php';
        </script>
        ";
    }
}

//Data Admin
if (@$_SESSION['admin']) {
    header("location:index.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <title>Login-system</title>
    </head>

    <body>
        <div class="container" style="margin-top: 100px;">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Buku Tamu</h6>
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <h6 class="mr-3 m-0 font-weight-bold text-primary"><?= $tanggal ?></h6>
                                <h6 class="m-0 font-weight-bold text-primary"><?= $jam ?></h6>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body border-bottom-info">
                            <form action="" method="post" class="navbar-form">
                                <div class="form-group">
                                    <label for="nama">Nama :</label>
                                    <input type="text" name="nama" class="form-control" placeholder="nama lengkap" autofocus autocomplete="off" required>
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
                                <div class="form-group">
                                    <textarea class="form-control" name="keperluan" rows="3" placeholder="tulis keperluan kunjungan..." required></textarea>
                                </div>
                                <div class="form-group d-grid">
                                    <button type="submit" name="submit" class="btn btn-primary" value="submit">Submit</button>
                                    <!-- <input type="submit" name="submit" class="btn btn-primary" value="Submit"> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Login Admin</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body border-bottom-primary ">
                            <form role="form" method="POST" class="navbar-form">

                                <h2 style="text-align: center;" class="mb-3">Login System</h2>
                                <div class="input-group mb-3">

                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" autocomplete="off" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" autocomplete="off" required>
                                </div>
                                <div class="input-group d-grid">
                                    <input type="submit" name="login" class="btn btn-primary" value="Login">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>

    </html>

    <?php

    if (isset($_POST['login'])) {
        $username = @$_POST['username'];
        $password = md5(@$_POST['password']);

        $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'");

        $data = $sql->fetch_assoc();
        $ketemu = $sql->num_rows;

        if ($ketemu >= 1) {

            session_start();
            if ($data['level'] == "admin") {
                $_SESSION['admin'] = $data['id_user'];
                header("location:index.php");
            } else if ($data['level'] == "user") {
                $_SESSION['admin'] = $data['id_user'];
                header("location:index.php");
            }
        } else {
    ?>

            <script type="text/javascript">
                alert("Login Gagal! \nUsername dan Password SALAH!");
            </script>

<?php
        }
    }
}

?>