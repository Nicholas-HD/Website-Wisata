<?php
include 'config.php';

$kode = $_GET['kode'];

// Mengambil data destinasi berdasarkan kode destinasi
$query = mysqli_query($conn, "SELECT * FROM destinasiwisata WHERE kode_destinasi = '$kode'");
$row = mysqli_fetch_assoc($query);

// Proses Update
if (isset($_POST['update'])) {
    $kode = $_POST['inputkode'];
    $nama = $_POST['inputnama'];
    $alamat = $_POST['inputalamat'];
    $keterangan = $_POST['inputketerangan'];
    $kabupaten = $_POST['inputkabupaten'];
    $kategori = $_POST['inputkategori'];

    $gambardestinasi = $_FILES['gambardestinasi']['name'];
    $tmp_name = $_FILES['gambardestinasi']['tmp_name'];
    $upload_dir = "images/";

    // Jika gambar baru di-upload, maka upload dan ganti nama gambar
    if ($gambardestinasi) {
        move_uploaded_file($tmp_name, $upload_dir . $gambardestinasi);
    } else {
        // Jika tidak ada gambar baru, tetap gunakan gambar lama
        $gambardestinasi = $row['gambardestinasi'];
    }

    // Update data destinasi di database
    $query_update = mysqli_query($conn, "UPDATE destinasiwisata SET 
        nama_destinasi = '$nama',
        alamat_destinasi = '$alamat',
        keterangan_destinasi = '$keterangan',
        kode_kabupaten = '$kabupaten',
        kategori_id = '$kategori',
        gambardestinasi = '$gambardestinasi' 
        WHERE kode_destinasi = '$kode'");

    if ($query_update) {
        header('Location: index.php');
    } else {
        echo "Gagal mengupdate data destinasi!";
    }
}

$query_kabupaten = mysqli_query($conn, "SELECT * FROM kabupaten");
$query_kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Destinasi Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../sbadmin/css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <?php include("../sbadmin/menunav.php") ?>

    <div id="layoutSidenav">
        <?php include("../sbadmin/menu.php") ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Data destinasi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data Destinasi</li>
                    </ol>

<div class="container mt-5">
    <h2 class="fs-1">Edit Destinasi Wisata</h2>
    <h5 class="mb-5">Formulir untuk mengedit destinasi wisata</h5>

    <form method="POST" enctype="multipart/form-data">
        <label class="form-label">Kode:</label>
        <input class="form-control" type="text" name="inputkode" value="<?= $row['kode_destinasi']; ?>" required readonly><br>

        <label class="form-label">Nama Destinasi:</label>
        <input class="form-control" type="text" name="inputnama" value="<?= $row['nama_destinasi']; ?>" required><br>

        <label class="form-label">Alamat:</label>
        <input class="form-control" type="text" name="inputalamat" value="<?= $row['alamat_destinasi']; ?>" required><br>

        <label class="form-label">Keterangan:</label>
        <textarea class="form-control" name="inputketerangan" required><?= $row['keterangan_destinasi']; ?></textarea><br>

        <label for="form-file">Gambar Wisata:</label>
        <input type="file" class="form-control" name="gambardestinasi"><br>
        <small>Gambar saat ini: <img src="images/<?= $row['gambardestinasi']; ?>" width="100"></small><br>

        <label class="form-label mt-4">Kabupaten:</label>
        <select class="form-control" name="inputkabupaten" required>
            <option value="">Pilih Kabupaten</option>
            <?php
            if (mysqli_num_rows($query_kabupaten) > 0) {
                while ($kabupaten_row = mysqli_fetch_assoc($query_kabupaten)) {
                    $selected = $kabupaten_row['kode_kabupaten'] == $row['kode_kabupaten'] ? 'selected' : '';
                    echo '<option value="' . $kabupaten_row['kode_kabupaten'] . '" ' . $selected . '>' . $kabupaten_row['nama_kabupaten'] . '</option>';
                }
            } else {
                echo '<option value="">Data kabupaten tidak tersedia</option>';
            }
            ?>
        </select><br>

        <label class="form-label mt-4">Kategori:</label>
        <select class="form-control" name="inputkategori" required>
            <option value="">Pilih Kategori</option>
            <?php
            if (mysqli_num_rows($query_kategori) > 0) {
                while ($kategori_row = mysqli_fetch_assoc($query_kategori)) {
                    $selected = $kategori_row['kategori_id'] == $row['kategori_id'] ? 'selected' : '';
                    echo '<option value="' . $kategori_row['kategori_id'] . '" ' . $selected . '>' . $kategori_row['kategori_nama'] . '</option>';
                }
            } else {
                echo '<option value="">Data kategori tidak tersedia</option>';
            }
            ?>
        </select><br>

        <input class="btn btn-success button" type="submit" name="update" value="Update">
        <a class="btn btn-secondary button" href="index.php">Batal</a>
    </form>

</div>

</main>
                <?php include ("../sbadmin/footer.php") ?>
              
            </div>
        </div>
       <?php include ("../sbadmin/jsscript.php") ?>
    </body>
</html>

