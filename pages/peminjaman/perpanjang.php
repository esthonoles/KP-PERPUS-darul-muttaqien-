
<?php
$id = $_GET['id'];
$tgl1 = $_GET['tgl'];

echo $id, $tgl1;
$tgl2 = date('Y-m-d', strtotime('+7 days', strtotime($tgl1)));

$result = mysqli_query($conn, "UPDATE tb_pinjam SET tgl_kembali = '$tgl2' 
                                                        WHERE id_pinjam = '$id'");
if ($result) {
    echo "
<script>
alert('Perpanjang Peminjaman Berhasil!');
    document.location.href = '?pages=peminjaman';
</script>
";

    // header('Location: anggota.php');
} else {
    echo "Err:" . $result . "" . mysqli_error($conn);
}

?>