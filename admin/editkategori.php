<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM kategori WHERE kategori_id = '$id'";
    $result = mysqli_query($conn, $query);
    $kategori = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // Update query
    $query = "UPDATE kategori SET kategori_nama = '$nama', kategori_keterangan = '$keterangan' WHERE kategori_id = '$id'";
    mysqli_query($conn, $query);

    header('Location: indexkategori.php');
}

// Pencarian data kategori
if (isset($_POST["kirim"])) {
    $search = mysqli_real_escape_string($conn, $_POST["search"]);
    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_nama LIKE '%$search%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM kategori");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
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
                    <h1 class="mt-4">Edit Data kategori</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="indexkategori.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data kategori</li>
                    </ol>

<div class="container mt-5">
    <h2 class="fs-1">Edit Kategori Wisata</h2>
    <form method="POST">
    <label class="form-label">Kategori id:</label>
    <input class="form-control" type="text" name="id" value="<?= $kategori['kategori_id']; ?>" readonly><br>       

        <label class="form-label">Nama Kategori Wisata:</label>
        <input class="form-control" type="text" name="nama" value="<?= $kategori['kategori_nama']; ?>" required><br>

        <label class="form-label">Keterangan Kategori Wisata:</label>
        <input class="form-control" type="text" name="keterangan" value="<?= $kategori['kategori_keterangan']; ?>" required><br>

        <input class="btn btn-success button" type="submit" name="update" value="Perbarui">
        <a class="btn btn-secondary button" href="indexkategori.php">Batal</a>
    </form>
</div>

  <!-- output -->
  <div class="container mt-5 mb-5">
    <h2 class="mb-4">Output kategori</h2>
    <form method="POST">
            <label for="search" class="col-sm-2 mb-2">Cari Provinsi:</label>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="search" class="form-control" id="search" value="<?php if(isset($_POST["search"])) { echo $_POST["search"]; } ?>" placeholder="Cari Kategori">
                </div>
                <input type="update" name="kirim" value="Cari" class="btn btn-info col-sm-1">
    	    </div>
        </form>

    <table class="table table-success mt-5">
        <tr>
            <th scope="col">Kode</th>
            <th scope="col">Nama kategori</th>
            <th scope="col">kategori keterangan</th>
            <th scope="col">Aksi</th>
        </tr>

        <?php
        // Loop untuk menampilkan setiap baris data kategori dan kategori
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $row['kategori_id']; ?></td>
            <td><?= $row['kategori_nama']; ?></td>
            <td><?= $row['kategori_keterangan']; ?></td>
            <td>
                <a class="btn btn-success button" href="editkategori.php?id=<?= $row['kategori_id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger button" href="hapuskategori.php?id=<?= $row['kategori_id']; ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </table>
 </main>
                <?php include ("../sbadmin/footer.php") ?>
              
            </div>
        </div>
       <?php include ("../sbadmin/jsscript.php") ?>
    </body>
</html>
