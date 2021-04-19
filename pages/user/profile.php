<?php if ($_SESSION['admin'] || @$_SESSION['user']) {
    $user = $_SESSION['admin'];
    $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user='$user'");
    $data = $sql->fetch_assoc();
} ?>

<link rel="stylesheet" href="css/style.css">
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-md-4 mx-auto">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-white">Profile User</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body bg-light">
                <div class="d-flex flex-column align-items-center text-center">
                    <img class="img-profile rounded-circle mx-auto" src="img/undraw_profile.svg" width="150px">

                    <div class="mt-3">
                        <h3 class="text-uppercase text-dark font-weight-bold"><?= $data['nama'] ?></h3>
                        <p class="text-secondary mb-1 font-weight-bold">
                            <i class="fas fa-check-circle" style="font-size: 12px; color:#32a852;"></i>
                            <?= $data['level'] ?>
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>