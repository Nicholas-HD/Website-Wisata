<?php
include 'config.php';

// Proses mendapatkan data testimoni yang akan diedit
if (isset($_GET['kode'])) {
    $id = $_GET['kode'];
    $result = mysqli_query($conn, "SELECT * FROM testimoni WHERE id_testimoni = '$id'");
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "Data tidak ditemukan!";
        exit();
    }
}

// Proses update data testimoni
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $nama = $_POST['nama'];
    $kota = $_POST['kota'];

    // Proses upload gambar baru
    $gambartestimoni = $_FILES['gambartestimoni']['name'];
    $tmp_name = $_FILES['gambartestimoni']['tmp_name'];
    $upload_dir = "images/";

    if (!empty($gambartestimoni)) {
        move_uploaded_file($tmp_name, $upload_dir . $gambartestimoni);
        $gambar_query = ", gambartestimoni='$gambartestimoni'";
    } else {
        $gambar_query = "";
    }

    $query = "UPDATE testimoni 
              SET judul='$judul', isi_testimoni='$isi', nama='$nama', kota_negara='$kota' $gambar_query
              WHERE id_testimoni='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: indextestimoni.php'); // Redirect setelah update berhasil
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
    <title>Edit Testimoni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/59bd5f9969.js" crossorigin="anonymous"></script>
    <link href="../sbadmin/css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include("../sbadmin/menunav.php") ?>
    <div id="layoutSidenav">
        <?php include("../sbadmin/menu.php") ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Testimoni</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="indextestimoni.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Testimoni</li>
                    </ol>

                    <div class="container mt-5">
                        <form method="POST" enctype="multipart/form-data">
                            <label class="form-label">ID Testimoni:</label>
                            <input class="form-control" type="text" name="id" value="<?= htmlspecialchars($data['id_testimoni']) ?>" readonly><br>

                            <label class="form-label">Judul Testimoni:</label>
                            <input class="form-control" type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required><br>

                            <label class="form-label">Isi Testimoni:</label>
                            <textarea class="form-control" name="isi" required><?= htmlspecialchars($data['isi_testimoni']) ?></textarea><br>

                            <label class="form-label">Nama Pengguna:</label>
                            <input class="form-control" type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required><br>

                            <label class="form-label">Kota/Negara:</label>
                            <input class="form-control" type="text" name="kota" value="<?= htmlspecialchars($data['kota_negara']) ?>" required><br>

                            <label class="form-label">Unggah Gambar Baru (Opsional):</label>
                            <input class="form-control" type="file" name="gambartestimoni"><br>

                            <p>Gambar Saat Ini:</p>
                            <img src="images/<?= htmlspecialchars($data['gambartestimoni']) ?>" width="150"><br><br>

                            <input class="btn btn-primary" type="submit" name="update" value="Perbarui">
                            <a href="indextestimoni.php" class="btn btn-secondary">Batal</a>
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
