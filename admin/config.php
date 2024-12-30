<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "uas";

$conn = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
