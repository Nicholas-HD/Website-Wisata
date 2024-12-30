<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM berita WHERE berita_id = '$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        header('Location: indexberita.php');
        exit;
    }
}

if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $sumber = mysqli_real_escape_string($conn, $_POST['sumber']);
    $kategori_id = mysqli_real_escape_string($conn, $_POST['kategori_id']);
    $gambarberita = $data['gambarberita'];

    // Jika ada file gambar baru yang diunggah
    if (!empty($_FILES['gambarberita']['name'])) {
        $gambarberita = $_FILES['gambarberita']['name'];
        $tmp_name = $_FILES['gambarberita']['tmp_name'];
        $upload_dir = "images/";
        
        // Hapus gambar lama jika ada
        if (file_exists($upload_dir . $data['gambarberita'])) {
            unlink($upload_dir . $data['gambarberita']);
        }

        move_uploaded_file($tmp_name, $upload_dir . $gambarberita);
    }

    // Query untuk memperbarui data
    $query = "UPDATE berita SET 
                berita_judul = '$judul', 
                berita_isi = '$isi', 
                berita_sumber = '$sumber', 
                kategori_id = '$kategori_id', 
                gambarberita = '$gambarberita' 
              WHERE berita_id = '$id'";
    
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
<head>
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../sbadmin/css/styles.css" rel="stylesheet" />
</head>
<body>
<body class="sb-nav-fixed">
    <?php include("../sbadmin/menunav.php") ?>

    <div id="layoutSidenav">
        <?php include("../sbadmin/menu.php") ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Data Berita</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="indexberita.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data Berita</li>
                    </ol>
<div class="container mt-5">
    <h2 class="fs-1">Edit Berita Wisata</h2>
    <form method="POST" enctype="multipart/form-data">
    <label class="form-label">Kode berita:</label>
        <input class="form-control" type="text" name="id" value="<?= $data['berita_id']; ?>" readonly><br>

        <label class="form-label">Judul Berita Wisata:</label>
        <input class="form-control" type="text" name="judul" value="<?= $data['berita_judul']; ?>" required><br>

        <label class="form-label">Isi Berita Wisata:</label>
        <input class="form-control" type="text" name="isi" value="<?= $data['berita_isi']; ?>" required><br>

        <label class="form-label">Sumber Berita:</label>
        <textarea class="form-control" name="sumber"><?= $data['berita_sumber']; ?></textarea><br>

        <label class="form-label">Kategori:</label>
        <select class="form-control" name="kategori_id" required>
            <option value="">Pilih Kategori</option>
            <?php
            $query_kategori = mysqli_query($conn, "SELECT * FROM kategori") or die(mysqli_error($conn));
            while ($kategori = mysqli_fetch_assoc($query_kategori)) {
                $selected = $kategori['kategori_id'] == $data['kategori_id'] ? 'selected' : '';
                echo "<option value='{$kategori['kategori_id']}' $selected>{$kategori['kategori_nama']}</option>";
            }
            ?>
        </select><br>

        <p>Gambar Saat Ini: <br><img src="images/<?= $data['gambarberita']; ?>" width="100"></p><br>
        <label class="form-label">Unggah Gambar Berita:</label>
        <input class="form-control" type="file" name="gambarberita"><br>
       

        <input class="btn btn-success" type="submit" name="update" value="Update">
        <a class="btn btn-secondary" href="indexberita.php">Batal</a>
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
