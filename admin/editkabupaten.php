<?php
include 'config.php';

// Ambil kode kabupaten dari URL
$kode_kabupaten = $_GET['kode'];
$query = mysqli_query($conn, "SELECT * FROM kabupaten WHERE kode_kabupaten = '$kode_kabupaten'");
$row = mysqli_fetch_assoc($query);

$query_provinsi = mysqli_query($conn, "SELECT * FROM provinsi");

// Update data kabupaten ketika form disubmit
if (isset($_POST['update'])) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kode_provinsi = mysqli_real_escape_string($conn, $_POST['kode_provinsi']);

    // Handle file upload jika ada file baru yang diupload
    if ($_FILES['gambarkabupaten']['name']) {
        $gambarkabupaten = $_FILES['gambarkabupaten']['name'];
        $tmp_name = $_FILES['gambarkabupaten']['tmp_name'];
        $upload_dir = "images/";
        move_uploaded_file($tmp_name, $upload_dir . $gambarkabupaten);
    } else {
        // Jika tidak ada file baru, gunakan gambarkabupaten yang ada
        $gambarkabupaten = $row['gambarkabupaten'];
    }

    // Update data di database
    mysqli_query($conn, "UPDATE kabupaten SET 
        kode_kabupaten = '$kode', 
        nama_kabupaten = '$nama', 
        kode_provinsi = '$kode_provinsi', 
        gambarkabupaten = '$gambarkabupaten' 
        WHERE kode_kabupaten = '$kode_kabupaten'");

    // Redirect ke halaman utama setelah update
    header('Location: indexkabupaten.php');
}

// search
if(isset($_POST["kirim"])){
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM kabupaten, provinsi where kabupaten.kode_provinsi = provinsi.kode_provinsi  and nama_kabupaten like '%" .$search."%'");
    }else{
    $query = mysqli_query($conn, "SELECT * FROM kabupaten, provinsi where kabupaten.kode_provinsi = provinsi.kode_provinsi");
}

$query_provinsi = mysqli_query($conn, "SELECT * FROM provinsi");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit kabupaten</title>
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
                    <h1 class="mt-4">Edit Data kabupaten</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="indexkabupaten.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data kabupaten</li>
                    </ol>

    <div class="container mt-5">
        <h2>Edit kabupaten</h2>
        <form method="POST" enctype="multipart/form-data">
            <label class="form-label">Kode:</label>
            <input class="form-control" type="text" name="kode" value="<?= $row['kode_kabupaten'] ?>" readonly><br>

            <label class="form-label">Nama kabupaten:</label>
            <input class="form-control" type="text" name="nama" value="<?= $row['nama_kabupaten'] ?>" required><br>

            
            <small>Foto saat ini:</small><br>
            <img src="images/<?= htmlspecialchars($row['gambarkabupaten']) ?>" width="100"><br><br>
            <label class="form-label">Ganti Foto (jika diperlukan):</label>
            <input type="file" class="form-control" name="gambarkabupaten"><br>

            <label class="form-label mt-4">Pilih Kabupaten:</label>
            <select class="form-control" name="kode_provinsi" required>
                <option value="">Pilih Kabupaten</option>
                <?php while ($provinsi = mysqli_fetch_assoc($query_provinsi)) { ?>
                    <option value="<?= $provinsi['kode_provinsi'] ?>" 
                        <?= $provinsi['kode_provinsi'] == $row['kode_provinsi'] ? 'selected' : '' ?>>
                        <?= $provinsi['kode_provinsi'] ?> - <?= $provinsi['nama_provinsi'] ?>
                    </option>
                <?php } ?>
            </select><br>

            <input class="btn btn-success" type="submit" name="update" value="Update">
            <a href="indexkabupaten.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

      <!-- output -->
      <div class="container mt-5 mb-5">
        <h2 class="mb-4">Daftar Kabupaten</h2>
        
        <form method="POST">
        <label for="search" class="col-sm-2 mb-2">Cari judul kabupaten</label>
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
                <th scope="col">Nama kabupaten</th>
                <th scope="col">Foto kabupaten</th>
                <th scope="col">kode provinsi</th>
                <th scope="col">Nama Provinsi</th>
                <th scope="col">Aksi</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $row['kode_kabupaten']; ?></td>
                <td><?= $row['nama_kabupaten']; ?></td>
                <td><img src="images/<?= $row['gambarkabupaten']; ?>" width="100"></td> <!-- Menampilkan gambarkabupaten -->
                <td><?= $row['kode_provinsi']; ?></td>
                <td><?= $row['nama_provinsi']; ?></td>
                <td>
                    <a class="btn btn-success button" href="editkabupaten.php?kode=<?= $row['kode_kabupaten']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger button" href="hapuskabupaten.php?kode=<?= $row['kode_kabupaten']; ?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
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
