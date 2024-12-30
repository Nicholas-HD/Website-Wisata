<?php
include 'config.php';

// Ambil data booking berdasarkan ID yang diterima melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM booking WHERE id_booking = '$id'");
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "Data tidak ditemukan!";
        exit();
    }
}

// Proses update data booking
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $subjudul = $_POST['sub'];
    $keterangan = $_POST['ket'];
    $tujuan = $_POST['tujuan'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $oleh = $_POST['oleh'];
    $trip = $_POST['trip'];
    $totalorang = $_POST['totalorang'];
    $rating = $_POST['rating'];

    // Proses upload gambar baru (jika ada)
    $gambarbooking = $_FILES['gambarbooking']['name'];
    $tmp_name = $_FILES['gambarbooking']['tmp_name'];
    $upload_dir = "images/";

    if (!empty($gambarbooking)) {
        move_uploaded_file($tmp_name, $upload_dir . $gambarbooking);
        $gambar_query = ", gambarbooking='$gambarbooking'";
    } else {
        $gambar_query = "";
    }

    // Query update
    $query = "UPDATE booking 
              SET judul='$judul', subjudul='$subjudul', keterangan='$keterangan', 
                  tujuan='$tujuan', lokasi='$lokasi', tanggal='$tanggal', 
                  oleh='$oleh', trip='$trip', totalorang='$totalorang', 
                  rating='$rating' $gambar_query
              WHERE id_booking='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: indexbooking.php'); // Redirect ke halaman utama
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<?php
    ob_start();
    session_start();
    if (!isset($_SESSION['admin']))
        header("location:login.php");
?>
<head>
    <title>Edit Data Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../sbadmin/css/styles.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    <?php include("../sbadmin/menunav.php") ?>

    <div id="layoutSidenav">
        <?php include("../sbadmin/menu.php") ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Data Booking</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="indexbooking.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data Booking</li>
                    </ol>

                    <div class="container mt-5">
                        <form method="POST" enctype="multipart/form-data">
                            <label class="form-label">Kode Booking:</label>
                            <input class="form-control" type="text" name="id" value="<?= htmlspecialchars($data['id_booking']) ?>" readonly><br>

                            <label class="form-label">Judul Booking:</label>
                            <input class="form-control" type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required><br>

                            <label class="form-label">Subjudul:</label>
                            <input class="form-control" type="text" name="sub" value="<?= htmlspecialchars($data['subjudul']) ?>" required><br>

                            <label class="form-label">Keterangan:</label>
                            <textarea class="form-control" name="ket"><?= htmlspecialchars($data['keterangan']) ?></textarea><br>

                            <label class="form-label">Tujuan:</label>
                            <input class="form-control" type="text" name="tujuan" value="<?= htmlspecialchars($data['tujuan']) ?>" required><br>

                            <label class="form-label">Lokasi:</label>
                            <input class="form-control" type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi']) ?>" required><br>

                            <label class="form-label">Tanggal:</label>
                            <input class="form-control" type="date" name="tanggal" value="<?= htmlspecialchars($data['tanggal']) ?>" required><br>

                            <label class="form-label">Oleh:</label>
                            <input class="form-control" type="text" name="oleh" value="<?= htmlspecialchars($data['oleh']) ?>" required><br>

                            <label class="form-label">Jenis Trip:</label>
                            <input class="form-control" type="text" name="trip" value="<?= htmlspecialchars($data['trip']) ?>" required><br>

                            <label class="form-label">Total Orang:</label>
                            <input class="form-control" type="number" name="totalorang" value="<?= htmlspecialchars($data['totalorang']) ?>" required><br>

                            <label class="form-label">Rating:</label>
                            <input class="form-control" type="number" step="0.1" name="rating" value="<?= htmlspecialchars($data['rating']) ?>" required><br>

                            <label class="form-label">Unggah Gambar Baru (Opsional):</label>
                            <input class="form-control" type="file" name="gambarbooking"><br>

                            <p>Gambar Saat Ini:</p>
                            <img src="images/<?= htmlspecialchars($data['gambarbooking']) ?>" width="150"><br><br>

                            <input class="btn btn-primary" type="submit" name="update" value="Perbarui">
                            <a href="indexbooking.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </main>
            <?php include("../sbadmin/footer.php") ?>
        </div>
    </div>
    <?php include("../sbadmin/jsscript.php") ?>
</body>
</html>
