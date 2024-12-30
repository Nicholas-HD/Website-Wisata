<?php
include 'config.php';

$kode = $_GET['kode'];
$query = "DELETE FROM kabupaten WHERE kode_kabupaten = '$kode'";
if (mysqli_query($conn, $query)) {
    header('Location: indexkabupaten.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
