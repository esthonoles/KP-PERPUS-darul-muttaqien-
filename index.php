<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
require_once "_config/conn.php";
//load composer

if ($_SESSION['admin'] || @$_SESSION['user']) {
    $user = $_SESSION['admin'];
    $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user='$user'");
    $data = $sql->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PERPUS DM</title>
        <link rel="shortcut icon" href="img/logo.png">

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>




    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <!-- <div class="sidebar-brand-icon rotate-n-15"> -->
                    <img class="rounded-circle" src="img/logo.png" alt="" style="width: 50px;">
                    <!-- </div> -->
                    <div class="sidebar-brand-text mx-3">PERPUS DM</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-folder-open fa-cog"></i>
                        <span>Master Data</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">master data:</h6>
                            <a class="collapse-item" href="?pages=anggota">Data Anggota</a>
                            <a class="collapse-item" href="?pages=buku">Data Buku</a>
                            <a class="collapse-item" href="?pages=kelas">Data Kelas</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->

                <li class="nav-item">
                    <a class="nav-link" href="?pages=peminjaman">
                        <i class="fas fa-fw fa-random"></i>
                        <span>Transaksi Peminjaman</span></a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-random"></i>
                        <span>Transaksi</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">data transaksi:</h6>
                            <a class="collapse-item" href="?pages=peminjaman">Peminjaman</a>
                            <a class="collapse-item" href="?pages=kembali">Pengembalian</a>
                        </div>
                    </div>
                </li> -->

                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Logs
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-sticky-note"></i>
                        <span>Log Data</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">

                            <h6 class="collapse-header">Transaksi Log :</h6>
                            <a class="collapse-item" href="?pages=logs&aksi=pinjam">Peminjaman</a>
                            <a class="collapse-item" href="?pages=logs&aksi=kembali">Pengembalian</a>
                            <a class="collapse-item" href="?pages=logs&aksi=pengunjung">Pengunjung</a>
                        </div>
                    </div>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="?pages=logs&aksi=kembali">
                        <i class="fas fa-fw fa-undo-alt"></i>
                        <span>Logs Pengembalian</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?pages=logs&aksi=pengunjung"">
                        <i class=" fas fa-fw fa-person-booth"></i>
                        <span>Logs Pengunjung</span></a>
                </li>
                <!-- Nav Item - Tables -->

                <?php
                if ($data['level'] == 'admin') {
                ?>

                    <!-- belum terlalu penting -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="?pages=backup">
                            <i class="fas fa-fw fa-file-archive"></i>
                            <span>Backup Data</span></a>
                    </li> -->
                <?php } ?>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>


            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">

                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small font-weight-bold mb-1 text-uppercase"><?= $data['nama']; ?></span>
                                    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="?pages=user">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <?php
                                    if ($data['level'] == 'admin') {
                                    ?>
                                        <a class="dropdown-item" href="?pages=settings">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400 "></i>
                                            Settings
                                        </a>
                                    <?php } ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="bock-header">

                            <?php
                            $pages = $_GET['pages'];
                            $aksi = $_GET['aksi'];
                            if ($pages == "anggota") {
                                if ($aksi == "") {
                                    include "pages/anggota/anggota.php";
                                } elseif ($aksi == "tambah") {
                                    // include "pages/anggota/tambah.php";
                                } elseif ($aksi == "ubah") {
                                    // include "pages/anggota/ubah.php";
                                } elseif ($aksi == "hapus") {
                                    include "pages/anggota/hapus.php";
                                }
                            } elseif ($pages == "buku") {
                                if ($aksi == "hapus") {
                                    include "pages/buku/hapus.php";
                                } else {
                                    include "pages/buku/buku.php";
                                }
                            } elseif ($pages == "peminjaman") {
                                if ($aksi == "tambah") {
                                    include "pages/peminjaman/tambah_pinjam.php";
                                } elseif ($aksi == "kembalikan") {
                                    include "pages/peminjaman/kembalikan.php";
                                } elseif ($aksi == "perpanjang") {
                                    include "pages/peminjaman/perpanjang.php";
                                } elseif ($aksi == "cari") {
                                    include "pages/peminjaman/search.php";
                                } else {

                                    include "pages/peminjaman/peminjaman.php";
                                }
                            } elseif ($pages == "kembali") {
                                include "pages/kembali/kembali.php";
                            } elseif ($pages == "user") {
                                include "pages/user/profile.php";
                            } elseif ($pages == "settings") {
                                if ($aksi == "hapus") {
                                    include "pages/user/hapus.php";
                                }
                                include "pages/user/settings.php";
                            } elseif ($pages == "kelas") {
                                if ($aksi == "hapus") {
                                    include "pages/kelas/hapus.php";
                                }
                                include "pages/kelas/kelas.php";
                            } elseif ($pages == "logs") {
                                if ($aksi == "pinjam") {
                                    include "pages/logs/pinjam.php";
                                } else if ($aksi == "kembali") {
                                    include "pages/logs/kembali.php";
                                } else if ($aksi == "pengunjung") {
                                    include "pages/logs/pengunjung.php";
                                }
                            } elseif ($pages == "backup") {
                                include "pages/backup/backup.php";
                            } elseif ($pages == "import") {
                                include "pages/import/";
                            } elseif ($pages == "export") {
                                if ($aksi == "peminjaman") {
                                    include "pages/export/export_pinjam.php";
                                } elseif ($aksi == "buku") {
                                    include "pages/export/export_buku.php";
                                }
                            } else {
                                include "pages/dasboard/dasboard.php";
                            }

                            ?>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Kerja Praktek UNPAM 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>



        <!-- sricp asli bawaan template -->

        <!-- <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="vendor/datatables/jquery.dataTables.min.js"></script> <!-- coba tes-->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
        <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->
        <!-- <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
        <!-- <script src="js/demo/datatables-demo.js"></script> -->



        <!-- script pates oke -->
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>





    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
?>