<?php
include 'config.php';

$kode = $_GET['kode'];
$query = "DELETE FROM kecamatan WHERE kode_kecamatan = '$kode'";
if (mysqli_query($conn, $query)) {
    header('Location: indexkecamatan.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
