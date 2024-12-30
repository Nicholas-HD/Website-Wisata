<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $sumber = $_POST['sumber'];
    $kategori_id = $_POST['kategori_id'];

    // Proses upload gambarberita
    $gambarberita = $_FILES['gambarberita']['name'];
    $tmp_name = $_FILES['gambarberita']['tmp_name'];
    $upload_dir = "images/"; // Direktori tempat penyimpanan gambarberita
    move_uploaded_file($tmp_name, $upload_dir . $gambarberita);

    // Query untuk memasukkan data ke tabel berita termasuk gambarberita
    $query = "INSERT INTO berita(berita_id, berita_judul, berita_isi, berita_sumber, kategori_id, gambarberita) VALUES ('$id', '$judul', '$isi', '$sumber', '$kategori_id', '$gambarberita')";
    mysqli_query($conn, $query);

    header('Location: indexberita.php');
}


// search
if(isset($_POST["kirim"])){
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM berita, kategori where berita.kategori_id = kategori.kategori_id  and berita_judul like '%" .$search."%'");
    }else{
    $query = mysqli_query($conn, "SELECT * FROM berita, kategori where berita.kategori_id = kategori.kategori_id");
}

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
    <title>Tambah berita</title>
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
    <h2 class="fs-1">Input berita wisata</h2>
    <h5 class="mb-5">Berita tentang wisata di jawa</h5>
        <form method="POST" enctype="multipart/form-data"> 
            <label class="form-label">Kode berita:</label>
            <input class="form-control" type="text" name="id" required><br>

            <label class="form-label">Judul berita wisata:</label>
            <input class="form-control" type="text" name="judul" required><br>

            <label class="form-label">Isi berita wisata:</label>
            <input class="form-control" type="text" name="isi" required><br>

            <label class="form-label">Sumber berita:</label>
            <textarea class="form-control" name="sumber"></textarea><br>

            <label class="form-label">Kategori:</label>
            <select class="form-control" name="kategori_id" required>
             <option value="">Pilih Kategori</option>
             <?php
             while ($data = mysqli_fetch_assoc($query_kategori)) {
            echo "<option value='{$data['kategori_id']}'>{$data['kategori_nama']}</option>";
             }
             ?>
            </select>

            <label class="form-label">Unggah Gambarberita:</label>
            <input class="form-control" type="file" name="gambarberita" required><br>

            <input class="btn btn-success button" type="submit" name="submit" value="Simpan">
            <input class="btn btn-secondary button" type="reset" value="Batal">
        </form>
    </div>

    <!-- output -->
    <div class="container mt-5 mb-5">
    <h2 class="mb-4">Output Berita</h2>

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
            <th scope="col">Judul Berita</th>
            <th scope="col">Isi Berita</th>
            <th scope="col">Sumber Berita</th>
            <th scope="col">Kategori</th>
            <th scope="col">Gambarberita</th>
            <th scope="col">Aksi</th>
        </tr>

        <?php
        
        // Loop untuk menampilkan setiap baris data berita dan kategori
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $row['berita_id']; ?></td>
            <td><?= $row['berita_judul']; ?></td>
            <td><?= $row['berita_isi']; ?></td>
            <td><?= $row['berita_sumber']; ?></td>
            <td><?= $row['kategori_nama']; ?></td>
            <td><img src="images/<?= $row['gambarberita']; ?>" width="100"></td> <!-- Menampilkan gambarberita -->
            <td>
                <a class="btn btn-success button" href="editberita.php?id=<?= $row['berita_id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger button" href="hapusberita.php?id=<?= $row['berita_id']; ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
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
