<?php
include 'config.php';

// Menambah data provinsi
if (isset($_POST['submit'])) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    
    $gambarprovinsi = $_FILES['gambarprovinsi']['name'];
    $tmp_name = $_FILES['gambarprovinsi']['tmp_name'];
    $upload_dir = "images/"; 
    move_uploaded_file($tmp_name, $upload_dir . $gambarprovinsi);
 
    mysqli_query($conn, "INSERT INTO provinsi (kode_provinsi, nama_provinsi, gambarprovinsi) 
    VALUES ('$kode', '$nama', '$gambarprovinsi')");
    
    header('Location: indexprovinsi.php');
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
<?php
ob_start();
session_start();
if(!isset($_SESSION['admin'])){
    header("location:login.php");
}
?>
<head>
    <title>Tambah Provinsi</title>
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
        <h2 class="fs-1">Input Provinsi</h2>
        <h5 class="mb-5">Formulir untuk menambah provinsi baru</h5>
        <form method="POST" enctype="multipart/form-data">
            <label class="form-label">Kode:</label>
            <input class="form-control" type="text" name="kode" required><br>

            <label class="form-label">Nama Provinsi:</label>
            <input class="form-control" type="text" name="nama" required><br>

            <label for="form-file">Input Foto:</label>
            <input type="file" class="form-control" id="file" name="gambarprovinsi"><br>

            <input class="btn btn-success button" type="submit" name="submit" value="Simpan">
            <input class="btn btn-secondary button" type="reset" value="Batal">
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
