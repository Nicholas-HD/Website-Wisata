<?php
include 'config.php';

// Ambil kode provinsi dari URL
$kode_provinsi = $_GET['kode'];
$query = mysqli_query($conn, "SELECT * FROM provinsi WHERE kode_provinsi = '$kode_provinsi'");
$row = mysqli_fetch_assoc($query);

// Update data provinsi ketika form disubmit
if (isset($_POST['update'])) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);

    // Handle file upload jika ada file baru yang diupload
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $upload_dir = "images/";

        // Hapus gambar lama jika ada
        if (file_exists($upload_dir . $row['gambarprovinsi'])) {
            unlink($upload_dir . $row['gambarprovinsi']);
        }

        // Upload gambar baru
        move_uploaded_file($tmp_name, $upload_dir . $gambar);
    } else {
        // Jika tidak ada file baru, gunakan gambar yang ada
        $gambar = $row['gambarprovinsi'];
    }

    // Update data di database
    mysqli_query($conn, "UPDATE provinsi SET 
        kode_provinsi = '$kode', 
        nama_provinsi = '$nama', 
        gambarprovinsi = '$gambar' 
        WHERE kode_provinsi = '$kode_provinsi'");

    // Redirect ke halaman utama setelah update
    header('Location: indexprovinsi.php');
    exit;
}
// Pencarian data provinsi
if (isset($_POST["kirim"])) {
    $search = mysqli_real_escape_string($conn, $_POST["search"]);
    $query = mysqli_query($conn, "SELECT * FROM provinsi WHERE nama_provinsi LIKE '%$search%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM provinsi");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Provinsi</title>
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
                    <h1 class="mt-4">Edit Data provinsi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="indexprovinsi.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data provinsi</li>
                    </ol>

    <div class="container mt-5">
        <h2>Edit Provinsi</h2>
        <form method="POST" enctype="multipart/form-data">
            <label class="form-label">Kode Provinsi:</label>
            <input class="form-control" type="text" name="kode" value="<?= htmlspecialchars($row['kode_provinsi']) ?>" required readonly><br>

            <label class="form-label">Nama Provinsi:</label>
            <input class="form-control" type="text" name="nama" value="<?= htmlspecialchars($row['nama_provinsi']) ?>" required><br>

            <small>Foto saat ini:</small><br>
            <img src="images/<?= htmlspecialchars($row['gambarprovinsi']) ?>" width="100"><br><br>
            <label class="form-label">Ganti Foto (jika diperlukan):</label>
            <input type="file" class="form-control" name="gambar"><br>

            <input class="btn btn-success" type="submit" name="update" value="Update">
            <a href="indexprovinsi.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

       <!-- output -->
       <div class="container mt-5 mb-5">
        <h2 class="mb-4">Daftar Provinsi</h2>
        <form method="POST">
            <label for="search" class="col-sm-2 mb-2">Cari Provinsi:</label>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="search" class="form-control" id="search" value="<?php if(isset($_POST["search"])) { echo $_POST["search"]; } ?>" placeholder="Cari Provinsi">
                </div>
                <input type="submit" name="kirim" value="Cari" class="btn btn-info col-sm-1">
    	    </div>
        </form>

        <table class="table table-success mt-5">
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama Provinsi</th>
                <th scope="col">Gambar</th>
                <th scope="col">Aksi</th>
            </tr>

            <?php
            // Loop untuk menampilkan setiap baris data provinsi
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= htmlspecialchars($row['kode_provinsi']); ?></td>
                <td><?= htmlspecialchars($row['nama_provinsi']); ?></td>
                <td><img src="images/<?= htmlspecialchars($row['gambarprovinsi']); ?>" width="100"></td> <!-- Menampilkan gambarprovinsi -->
                <td>
                    <a class="btn btn-success button" href="editprovinsi.php?kode=<?= $row['kode_provinsi']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger button" href="hapusprovinsi.php?kode=<?= $row['kode_provinsi']; ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    </main>
                <?php include ("../sbadmin/footer.php") ?>
              
            </div>
        </div>
       <?php include ("../sbadmin/jsscript.php") ?>
    </body>
</html>
