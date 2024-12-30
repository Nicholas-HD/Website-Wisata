<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $kode =  $_POST['inputkode'];
    $nama =  $_POST['inputnama'];
    $alamat =  $_POST['inputalamat'];
    $keterangan =  $_POST['inputketerangan'];
    $kabupaten =  $_POST['inputkabupaten'];
    $kategori =  $_POST['inputkategori'];

    $gambardestinasi = $_FILES['gambardestinasi']['name'];
    $tmp_name = $_FILES['gambardestinasi']['tmp_name'];
    $upload_dir = "images/"; 
    move_uploaded_file($tmp_name, $upload_dir . $gambardestinasi);

    mysqli_query($conn, "INSERT INTO destinasiwisata (kode_destinasi, nama_destinasi, alamat_destinasi, keterangan_destinasi, kode_kabupaten, kategori_id, gambardestinasi) 
    VALUES ('$kode', '$nama', '$alamat', '$keterangan', '$kabupaten', '$kategori', '$gambardestinasi')");
    header('Location: index.php'); 
}


    $query = mysqli_query($conn, "SELECT destinasiwisata.*, 
    kabupaten.nama_kabupaten, 
    kategori.kategori_nama
    FROM destinasiwisata
    JOIN kabupaten ON destinasiwisata.kode_kabupaten = kabupaten.kode_kabupaten
    JOIN kategori ON destinasiwisata.kategori_id = kategori.kategori_id");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}


$query_kabupaten = mysqli_query($conn, "SELECT * FROM kabupaten");

$query_kategori = mysqli_query($conn, "SELECT * FROM kategori");
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
    <title>Tambah Destinasi Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/59bd5f9969.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
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
    <h2 class="fs-1">Input Destinasi Wisata</h2>
    <h5 class="mb-5">Formulir untuk menambah destinasi wisata baru</h5>

    <form method="POST" enctype="multipart/form-data">
    <label class="form-label">Kode:</label>
    <input class="form-control" type="text" name="inputkode" required><br>

    <label class="form-label">Nama Destinasi:</label>
    <input class="form-control" type="text" name="inputnama" required><br>

    <label class="form-label">Alamat:</label>
    <input class="form-control" type="text" name="inputalamat" required><br>

    <label class="form-label">Keterangan:</label>
    <textarea class="form-control" name="inputketerangan" required></textarea><br>

    <label for="form-file">Input foto wisata:</label>
    <input type="file" class="form-control" id="file" name="gambardestinasi">

    <label class="form-label mt-4">Kabupaten:</label>
    <select class="form-control" name="inputkabupaten" required>
    <option value="">Pilih Kabupaten</option>
    <?php
    if (mysqli_num_rows($query_kabupaten) > 0) {
        while ($row = mysqli_fetch_assoc($query_kabupaten)) {
            echo '<option value="' . $row['kode_kabupaten'] . '">' . $row['nama_kabupaten'] . '</option>';
        }
    } else {
        echo '<option value="">Data kabupaten tidak tersedia</option>';
    }
    ?>
</select>


    <label class="form-label mt-4">Kategori:</label>
    <select class="form-control" name="inputkategori" required>
    <option value="">Pilih Kategori</option>
    <?php
    if (mysqli_num_rows($query_kategori) > 0) {
        while ($row = mysqli_fetch_assoc($query_kategori)) {
            echo '<option value="' . $row['kategori_id'] . '">' . $row['kategori_nama'] . '</option>';
        }
    } else {
        echo '<option value="">Data kategori tidak tersedia</option>';
    }
    ?>
</select>


    <input class="btn btn-success button" type="submit" name="submit" value="Simpan">
    <input class="btn btn-secondary button" type="reset" value="Batal">
</form>

    </div>

    <!-- output -->
    <div class="container mt-5 mb-5">
    <h2 class="mb-4">Daftar Destinasi Wisata</h2>
    
    <form method="POST">
        <label for="search" class="col-sm-2 mb-2">Cari Nama Destinasi</label>
        <div class="form-group row">
            <div class="col-sm-6">
                <input type="text" name="search" class="form-control" id="search" 
                    value="<?php if(isset($_POST['search'])) { echo $_POST['search']; } ?>" placeholder="Cari nama destinasi">
            </div>
            <input type="submit" name="kirim" value="Cari" class="btn btn-info col-sm-1">
        </div>
    </form>

    <table class="table table-success mt-5">
        <thead>
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Foto Destinasi</th>
                <th scope="col">Kabupaten</th>
                <th scope="col">Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $row['kode_destinasi']; ?></td>
                <td><?= $row['nama_destinasi']; ?></td>
                <td><?= $row['alamat_destinasi']; ?></td>
                <td><?= $row['keterangan_destinasi']; ?></td>
                <td><img src="images/<?= $row['gambardestinasi']; ?>" width="80"></td> <!-- Foto -->
                <td><?= $row['nama_kabupaten']; ?></td> <!-- Nama Kabupaten -->
                <td><?= $row['kategori_nama']; ?></td> <!-- Nama Kategori -->
                <td>
                    <a class="btn btn-success button" href="edit.php?kode=<?= $row['kode_destinasi']; ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-danger button" href="hapus.php?kode=<?= $row['kode_destinasi']; ?>" 
                        onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
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
