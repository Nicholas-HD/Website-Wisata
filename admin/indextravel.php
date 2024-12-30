<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $sub = $_POST['sub'];
    $ket = $_POST['ket'];
    $link = $_POST['linkvideo'];

    // Proses upload gambartravel
    $gambartravel = $_FILES['gambartravel']['name'];
    $tmp_name = $_FILES['gambartravel']['tmp_name'];
    $upload_dir = "images/"; // Direktori tempat penyimpanan gambartravel
    move_uploaded_file($tmp_name, $upload_dir . $gambartravel);

    // Query untuk memasukkan data ke tabel travel termasuk gambartravel
    $query = "INSERT INTO travel(id_travel, judul, subjudul, keterangan, linkvideo, gambartravel) VALUES ('$id', '$judul', '$sub', '$ket', '$link', '$gambartravel')";
    mysqli_query($conn, $query);

    header('Location: indextravel.php');
}

// search
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM travel WHERE judul LIKE '%" . $search . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM travel");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <h2 class="fs-1">Input Data Travel</h2>
    <form method="POST" enctype="multipart/form-data"> 
        <label class="form-label">Kode Travel:</label>
        <input class="form-control" type="text" name="id" required><br>

        <label class="form-label">Judul Travel:</label>
        <input class="form-control" type="text" name="judul" required><br>

        <label class="form-label">Subjudul:</label>
        <input class="form-control" type="text" name="sub" required><br>

        <label class="form-label">Keterangan:</label>
        <textarea class="form-control" name="ket"></textarea><br>

        <label class="form-label">Link Video (Opsional):</label>
        <input class="form-control" type="text" name="linkvideo"><br>

        <label class="form-label">Unggah Gambar:</label>
        <input class="form-control" type="file" name="gambartravel" required><br>

        <input class="btn btn-success button" type="submit" name="submit" value="Simpan">
        <input class="btn btn-secondary button" type="reset" value="Batal">
    </form>
</div>

<!-- output -->
<div class="container mt-5 mb-5">
    <h2 class="mb-4">Daftar Travel</h2>

    <form method="POST">
        <label for="search" class="col-sm-2 mb-2">Cari Judul Travel</label>
        <div class="form-group row">
        <div class="col-sm-6">
        <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST["search"])) {echo $_POST["search"];} ?>" placeholder="Cari judul travel">
        </div>
        <input type="submit" name="kirim" value="Cari" class="btn btn-info col-sm-1">
        </div>
    </form>

    <table class="table table-success mt-5">
        <tr>
            <th scope="col">Kode</th>
            <th scope="col">Judul Travel</th>
            <th scope="col">Subjudul</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Link Video</th>
            <th scope="col">Gambar</th>
            <th scope="col">Aksi</th>
        </tr>

        <?php
        // Loop untuk menampilkan data travel
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $row['id_travel']; ?></td>
            <td><?= $row['judul']; ?></td>
            <td><?= $row['subjudul']; ?></td>
            <td><?= $row['keterangan']; ?></td>
            <td><?= $row['linkvideo']; ?></td>
            <td><img src="images/<?= $row['gambartravel']; ?>" width="100"></td>
            <td>
                <a class="btn btn-success button" href="edittravel.php?id=<?= $row['id_travel']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger button" href="hapustravel.php?id=<?= $row['id_travel']; ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
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
