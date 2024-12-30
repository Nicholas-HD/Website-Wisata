<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM booking WHERE id_booking = '$id'";
if (mysqli_query($conn, $query)) {
    header('Location: indexbooking.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
