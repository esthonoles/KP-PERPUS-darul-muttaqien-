
<?php
// require_once ""
$kode = $_GET['id'];
$tanggal = date("Y-m-d");

$result = mysqli_query($conn, "UPDATE tb_pinjam SET tgl_kembali = '$tanggal', 
                        status = 'kembali'  WHERE id_pinjam = '$kode'");

// insert ke table log_pinjam


if ($result) {
    echo "
<script>
alert('Pengembalian Buku Berhasil!');
    document.location.href = '?pages=peminjaman';
</script>
";

    // header('Location: anggota.php');
} else {
    echo "Err:" . $result . "" . mysqli_error($conn);
}

?>