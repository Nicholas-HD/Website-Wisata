<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
  
    $query = "INSERT INTO kategori(kategori_id, kategori_nama, kategori_keterangan) VALUES ('$id', '$nama', '$keterangan')";
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
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}
?>
<head>
    <title>Tambah kategori</title>
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
    <h2 class="fs-1">Input kategori wisata</h2>
    <h5 class="mb-5">kategori tentang wisata di jawa</h5>
        <form method="POST">
            <label class="form-label">Kode kategori:</label>
            <input class="form-control" type="text" name="id" required><br>

            <label class="form-label">Nama kategori wisata:</label>
            <input class="form-control" type="text" name="nama" required><br>

            <label class="form-label">keterangan kategori wisata:</label>
            <input class="form-control" type="text" name="keterangan" required><br>

            <input class="btn btn-success button" type="submit" name="submit" value="Simpan">
            <input class="btn btn-secondary button" type="reset" value="Batal">
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
                <input type="submit" name="kirim" value="Cari" class="btn btn-info col-sm-1">
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
</div>
</main>
                <?php include ("../sbadmin/footer.php") ?>
              
            </div>
        </div>
       <?php include ("../sbadmin/jsscript.php") ?>
    </body>
</html>


