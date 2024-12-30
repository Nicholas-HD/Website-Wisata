<?php
include 'config.php';

$kode = $_GET['kode'];
$query = "DELETE FROM provinsi WHERE kode_provinsi = '$kode'";
if (mysqli_query($conn, $query)) {
    header('Location: indexprovinsi.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
