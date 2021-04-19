<?php

$kode = $_GET['id'];
$sql = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user ='$kode'");
if ($sql) {
    echo "
<script>
    document.location.href = '?pages=settings';
</script>
";

    // header('Location: anggota.php');
} else {
    echo "Err:" . $query . "" . mysqli_error($conn);
}
