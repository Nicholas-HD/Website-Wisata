<?php
include 'config.php';

$kode = $_GET['kode'];
$query = "DELETE FROM destinasiwisata WHERE kode_destinasi = '$kode'";
if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
