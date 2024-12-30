<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kode_kabupaten = mysqli_real_escape_string($conn, $_POST['kode_kabupaten']);
      
    $gambarkecamatans = $_FILES['gambarkecamatans']['name'];
    $tmp_name = $_FILES['gambarkecamatans']['tmp_name'];
    $upload_dir = "images/"; 
    move_uploaded_file($tmp_name, $upload_dir . $gambarkecamatans);
    
    mysqli_query($conn, "INSERT INTO kecamatan (kode_kecamatan, nama_kecamatan, kode_kabupaten, gambarkecamatans) 
    VALUES ('$kode', '$nama', '$kode_kabupaten', ' $gambarkecamatans')");
    
    header('Location: indexkecamatan.php');
}

// search
if(isset($_POST["kirim"])){
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM kecamatan, kabupaten where kecamatan.kode_kabupaten = kabupaten.kode_kabupaten and nama_kecamatan like '%" .$search."%'");
    }else{
    $query = mysqli_query($conn, "SELECT * FROM kecamatan, kabupaten where kecamatan.kode_kabupaten = kabupaten.kode_kabupaten");
}


// $query = mysqli_query($conn, "SELECT * FROM kecamatan, kabupaten where kecamatan.kode_kabupaten = kabupaten.kode_kabupaten");
$query_kabupaten = mysqli_query($conn, "SELECT * FROM kabupaten") or die(mysqli_error($conn));

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
    <title>Tambah Kecamatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/59bd5f9969.js" crossorigin="anonymous"></script>
    <link href="../sbadmin/css/styles.css" rel="stylesheet" />
</head>
<body>

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
        <h2 class="fs-1">Input Kecamatan</h2>
        <h5 class="mb-5">Formulir untuk menambah kecamatan baru</h5>
        <form method="POST" enctype="multipart/form-data">
            <label class="form-label">Kode:</label>
            <input class="form-control" type="text" name="kode" required><br>

            <label class="form-label">Nama Kecamatan:</label>
            <input class="form-control" type="text" name="nama" required><br>

            <label for="form-file">Input foto </label>
            <input type="file" class="form-control" id="file" name="gambarkecamatans">

            <label class="form-label mt-4">Pilih Kabupaten:</label>
            <select class="form-control" name="kode_kabupaten" required>
            <option value="">Pilih Kabupaten</option>
            <?php while ($row = mysqli_fetch_assoc($query_kabupaten)) {?>
                <option value="<?php echo $row['kode_kabupaten']?>">
                <?php echo $row["kode_kabupaten"]?>
                <?php echo $row["nama_kabupaten"]?>
             </option>
             <?php } ?>   
            </select><br>

            <input class="btn btn-success button" type="submit" name="submit" value="Simpan">
            <input class="btn btn-secondary button" type="reset" value="Batal">
        </form>
    </div>

    <!-- output -->
    <div class="container mt-5 mb-5">
        <h2 class="mb-4">Daftar Kecamatan</h2>
        <form method="POST">
        <label for="search" class="col-sm-2 mb-2">Cari judul berita</label>
        <div class="form-group row">
            <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search" value="<?php if(isset($_POST["search"]))
           {echo $_POST["search"];}?>" placeholder="Cari judul berita">
           </div>
            <input type="submit" name="kirim" value="search" class="btn btn-info col-sm-1">
    	</div>
        </form>

        <table class="table table-success mt-5">
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama Kecamatan</th>
                <th scope="col">Foto Kecamatan</th>
                <th scope="col">kode kabupaten</th>
                <th scope="col">Nama Kabupaten</th>
                <th scope="col">Aksi</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $row['kode_kecamatan']; ?></td>
                <td><?= $row['nama_kecamatan']; ?></td>
                <td><img src="images/<?= $row['gambarkecamatans']; ?>" width="100"></td> <!-- Menampilkan gambarkecamatans -->
                <td><?= $row['kode_kabupaten']; ?></td>
                <td><?= $row['nama_kabupaten']; ?></td>
                <td>
                    <a class="btn btn-success button" href="editkecamatan.php?kode=<?= $row['kode_kecamatan']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger button" href="hapuskecamatan.php?kode=<?= $row['kode_kecamatan']; ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
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
