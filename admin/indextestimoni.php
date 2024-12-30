<?php
include 'config.php';

// Proses tambah data testimoni
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $nama = $_POST['nama'];
    $kota = $_POST['kota'];

    // Proses upload gambar
    $gambartestimoni = $_FILES['gambartestimoni']['name'];
    $tmp_name = $_FILES['gambartestimoni']['tmp_name'];
    $upload_dir = "images/"; // Direktori tempat penyimpanan gambar
    $uploaded = move_uploaded_file($tmp_name, $upload_dir . $gambartestimoni);

    if ($uploaded) {
        $query = "INSERT INTO testimoni (id_testimoni, judul, isi_testimoni, nama, kota_negara, gambartestimoni) 
                  VALUES ('$id', '$judul', '$isi', '$nama', '$kota', '$gambartestimoni')";

        if (mysqli_query($conn, $query)) {
            header('Location: indextestimoni.php'); // Redirect setelah sukses
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal mengunggah gambar.";
    }
}

// Pencarian data testimoni
if (isset($_POST["kirim"])) {
    $search = mysqli_real_escape_string($conn, $_POST["search"]);
    $query = mysqli_query($conn, "SELECT * FROM testimoni WHERE judul LIKE '%$search%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM testimoni");
}
?>

<!DOCTYPE html>
<html>
<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['admin']))
    header("location:login.php");
?>
<head>
    <title>Input Testimoni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/59bd5f9969.js" crossorigin="anonymous"></script>
    <link href="../sbadmin/css/styles.css" rel="stylesheet" />

</head>
<body class="sb-nav-fixed">
       <?php include ("../sbadmin/menunav.php")?>

        <div id="layoutSidenav">
            <?php include ("../sbadmin/menu.php")?>


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>        

    <div class="container mt-5">
        <h2 class="fs-1">Input Testimoni</h2>
        <h5 class="mb-5">Form untuk menambahkan testimoni pengguna</h5>
        <form method="POST" enctype="multipart/form-data">
            <label class="form-label">ID Testimoni:</label>
            <input class="form-control" type="text" name="id" required><br>

            <label class="form-label">Judul Testimoni:</label>
            <input class="form-control" type="text" name="judul" required><br>

            <label class="form-label">Isi Testimoni:</label>
            <textarea class="form-control" name="isi" required></textarea><br>

            <label class="form-label">Nama Pengguna:</label>
            <input class="form-control" type="text" name="nama" required><br>

            <label class="form-label">Kota/Negara:</label>
            <input class="form-control" type="text" name="kota" required><br>

            <label class="form-label">Unggah Gambar:</label>
            <input class="form-control" type="file" name="gambartestimoni" required><br>

            <input class="btn btn-success" type="submit" name="submit" value="Simpan">
            <input class="btn btn-secondary" type="reset" value="Batal">
        </form>
    </div>

    <!-- Output -->
    <div class="container mt-5 mb-5">
        <h2 class="mb-4">Daftar Testimoni</h2>

        <form method="POST">
            <label for="search" class="form-label">Cari Testimoni</label>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci">
                </div>
                <input type="submit" name="kirim" value="Cari" class="btn btn-info col-sm-1">
            </div>
        </form>

        <table class="table table-success mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Nama</th>
                    <th>Kota</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_testimoni']); ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars($row['isi_testimoni']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['kota_negara']); ?></td>
                    <td><img src="images/<?= htmlspecialchars($row['gambartestimoni']); ?>" width="100"></td>
                    <td>
                    <a class="btn btn-success button" href="edittestimoni.php?kode=<?= $row['id_testimoni']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger button" href="hapustestimonial.php?kode=<?= $row['id_testimoni']; ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
                </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    </main>
                <?php include ("../sbadmin/footer.php") ?>
              
            </div>
        </div>
       <?php include ("../sbadmin/jsscript.php") ?>
    </body>
</html>
