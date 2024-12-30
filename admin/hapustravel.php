<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM travel WHERE id_travel = '$id'";
if (mysqli_query($conn, $query)) {
    header('Location: indextravel.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
