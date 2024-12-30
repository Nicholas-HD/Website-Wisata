<?php
include 'config.php';

// Periksa apakah ada parameter `id` yang dikirimkan
if (!isset($_GET['id'])) {
    header('Location: indextravel.php');
    exit();
}

$id = $_GET['id'];

// Ambil data travel berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM travel WHERE id_travel = '$id'");
$travel = mysqli_fetch_assoc($query);

if (!$travel) {
    echo "Data tidak ditemukan!";
    exit();
}

// Periksa apakah form disubmit
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $subjudul = $_POST['subjudul'];
    $keterangan = $_POST['keterangan'];
    $linkvideo = $_POST['linkvideo'];

    // Proses upload gambar baru jika ada
    if ($_FILES['gambartravel']['name']) {
        $gambartravel = $_FILES['gambartravel']['name'];
        $tmp_name = $_FILES['gambartravel']['tmp_name'];
        $upload_dir = "images/";

        // Pindahkan file baru ke direktori
        move_uploaded_file($tmp_name, $upload_dir . $gambartravel);
    } else {
        // Jika tidak ada file baru, gunakan gambar lama
        $gambartravel = $travel['gambartravel'];
    }

    // Update data ke database
    $updateQuery = "
        UPDATE travel
        SET judul = '$judul',
            subjudul = '$subjudul',
            keterangan = '$keterangan',
            linkvideo = '$linkvideo',
            gambartravel = '$gambartravel'
        WHERE id_travel = '$id'
    ";
    if (mysqli_query($conn, $updateQuery)) {
        header('Location: indextravel.php');
        exit();
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
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
                    <h1 class="mt-4">Edit Data travel</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="indextravel.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data travel</li>
                    </ol>

<div class="container mt-5">
    <h2 class="fs-1">Edit Data Travel</h2>
    <form method="POST" enctype="multipart/form-data">
        <label class="form-label">Kode Travel:</label>
        <input class="form-control" type="text" name="id" value="<?= $travel['id_travel']; ?>" readonly><br>

        <label class="form-label">Judul Travel:</label>
        <input class="form-control" type="text" name="judul" value="<?= $travel['judul']; ?>" required><br>

        <label class="form-label">Subjudul:</label>
        <input class="form-control" type="text" name="subjudul" value="<?= $travel['subjudul']; ?>" required><br>

        <label class="form-label">Keterangan:</label>
        <textarea class="form-control" name="keterangan" required><?= $travel['keterangan']; ?></textarea><br>

        <label class="form-label">Link Video (Opsional):</label>
        <input class="form-control" type="text" name="linkvideo" value="<?= $travel['linkvideo']; ?>"><br>

        <label class="form-label">Unggah Gambar Baru:</label>
        <input class="form-control" type="file" name="gambartravel"><br>

        <p>Gambar Saat Ini:</p>
        <img src="images/<?= $travel['gambartravel']; ?>" width="200" class="mb-3" alt="Gambar Tidak Tersedia"><br>

        <input class="btn btn-primary" type="submit" name="submit" value="Update">
        <a class="btn btn-secondary" href="indextravel.php">Kembali</a>
    </form>
</div>

 </main>
                <?php include ("../sbadmin/footer.php") ?>
              
            </div>
        </div>
       <?php include ("../sbadmin/jsscript.php") ?>
    </body>
</html>
