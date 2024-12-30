<?php
include 'config.php';

// Ambil kode kecamatan dari URL
$kode_kecamatan = $_GET['kode'];
$query = mysqli_query($conn, "SELECT * FROM kecamatan WHERE kode_kecamatan = '$kode_kecamatan'");
$row = mysqli_fetch_assoc($query);

$query_kabupaten = mysqli_query($conn, "SELECT * FROM kabupaten");

// Update data kecamatan ketika form disubmit
if (isset($_POST['update'])) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kode_kabupaten = mysqli_real_escape_string($conn, $_POST['kode_kabupaten']);

    // Handle file upload jika ada file baru yang diupload
    if ($_FILES['gambarkecamatans']['name']) {
        $gambarkecamatans = $_FILES['gambarkecamatans']['name'];
        $tmp_name = $_FILES['gambarkecamatans']['tmp_name'];
        $upload_dir = "images/";
        move_uploaded_file($tmp_name, $upload_dir . $gambarkecamatans);
    } else {
        // Jika tidak ada file baru, gunakan gambarkecamatans yang ada
        $gambarkecamatans = $row['gambarkecamatans'];
    }

    // Update data di database
    mysqli_query($conn, "UPDATE kecamatan SET 
        kode_kecamatan = '$kode', 
        nama_kecamatan = '$nama', 
        kode_kabupaten = '$kode_kabupaten', 
        gambarkecamatans = '$gambarkecamatans' 
        WHERE kode_kecamatan = '$kode_kecamatan'");

    // Redirect ke halaman utama setelah update
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
<head>
    <title>Edit Kecamatan</title>
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
                    <h1 class="mt-4">Edit Data kecamatan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="indexkecamatan.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data kecamatan</li>
                    </ol>

    <div class="container mt-5">
        <h2>Edit Kecamatan</h2>
        <form method="POST" enctype="multipart/form-data">
            <label class="form-label">Kode:</label>
            <input class="form-control" type="text" name="kode" value="<?= $row['kode_kecamatan'] ?>" required><br>

            <label class="form-label">Nama Kecamatan:</label>
            <input class="form-control" type="text" name="nama" value="<?= $row['nama_kecamatan'] ?>" required><br>

            
            <small>Foto saat ini:</small><br>
            <img src="images/<?= htmlspecialchars($row['gambarkecamatans']) ?>" width="100"><br><br>
            <label class="form-label">Ganti Foto (jika diperlukan):</label>
            <input type="file" class="form-control" name="gambarkecamatans"><br>

            <label class="form-label mt-4">Pilih Kabupaten:</label>
            <select class="form-control" name="kode_kabupaten" required>
                <option value="">Pilih Kabupaten</option>
                <?php while ($kabupaten = mysqli_fetch_assoc($query_kabupaten)) { ?>
                    <option value="<?= $kabupaten['kode_kabupaten'] ?>" 
                        <?= $kabupaten['kode_kabupaten'] == $row['kode_kabupaten'] ? 'selected' : '' ?>>
                        <?= $kabupaten['kode_kabupaten'] ?> - <?= $kabupaten['nama_kabupaten'] ?>
                    </option>
                <?php } ?>
            </select><br>

            <input class="btn btn-success" type="submit" name="update" value="Update">
            <a href="indexkecamatan.php" class="btn btn-secondary">Batal</a>
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
