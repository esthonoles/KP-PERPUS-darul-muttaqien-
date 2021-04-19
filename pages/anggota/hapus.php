<?php
// require_once ""
$kode = $_GET['id'];
$sql = mysqli_query($conn, "DELETE FROM tb_anggota WHERE id ='$kode'");

if ($sql) {
?>
    <script type="text/javascript">
        // alert("Data Berhasil Dihapus !");
        window.location.href = "?pages=anggota";
    </script>
<?php
}
?>