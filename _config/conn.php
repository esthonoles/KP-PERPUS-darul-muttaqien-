<?php
date_default_timezone_set('Asia/Jakarta');
// session_start();
$conn = mysqli_connect('localhost', 'root', 'allzero', 'perpus_db');
if (mysqli_connect_errno()) {
    echo mysqli_connect_errno();
}
