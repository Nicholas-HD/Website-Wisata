<?php
include 'config.php';
if (isset($_GET['kode'])) {
    $id_testimoni = mysqli_real_escape_string($conn, $_GET['kode']);
    $query = "DELETE FROM testimoni WHERE id_testimoni = '$id_testimoni'";
    if (mysqli_query($conn, $query)) {
        header("Location: indextestimoni.php?status=deleted");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: indextestimoni.php?status=error");
    exit();
}
mysqli_close($conn);
?>
