<?php

$kode = $_GET['id'];
$sql = mysqli_query($conn, "DELETE FROM tb_kelas WHERE id ='$kode'");
if ($sql) {
    echo "
<script>
alert('Data dihapus');
    document.location.href = '?pages=kelas';
</script>
";

    // header('Location: anggota.php');
} else {
    echo "Err:" . $query . "" . mysqli_error($conn);
}
