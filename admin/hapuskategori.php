<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM kategori WHERE kategori_id = '$id'";
if (mysqli_query($conn, $query)) {
    header('Location: indexkategori.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
