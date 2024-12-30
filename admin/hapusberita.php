<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM berita WHERE berita_id = '$id'";
if (mysqli_query($conn, $query)) {
    header('Location: indexberita.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
