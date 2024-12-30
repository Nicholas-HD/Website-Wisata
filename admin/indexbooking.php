<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $subjudul = $_POST['sub'];
    $keterangan = $_POST['ket'];
    $tujuan = $_POST['tujuan'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $oleh = $_POST['oleh'];
    $trip = $_POST['trip'];
    $totalorang = $_POST['totalorang'];
    $rating = $_POST['rating'];

    // Proses upload gambarbooking
    $gambarbooking = $_FILES['gambarbooking']['name'];
    $tmp_name = $_FILES['gambarbooking']['tmp_name'];
    $upload_dir = "images/"; // Direktori tempat penyimpanan gambarbooking
    move_uploaded_file($tmp_name, $upload_dir . $gambarbooking);

    // Query untuk memasukkan data ke tabel booking termasuk gambarbooking
    $query = "INSERT INTO booking (id_booking, judul, subjudul, keterangan, tujuan, lokasi, tanggal, oleh, trip, totalorang, rating, gambarbooking) 
              VALUES ('$id', '$judul', '$subjudul', '$keterangan', '$tujuan', '$lokasi', '$tanggal', '$oleh', '$trip', '$totalorang', '$rating', '$gambarbooking')";
    mysqli_query($conn, $query);

    header('Location: indexbooking.php');
}

// search
if (isset($_POST["kirim"])) {
    $search = $_POST["search"];
    $query = mysqli_query($conn, "SELECT * FROM booking WHERE judul LIKE '%" . $search . "%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM booking");
}
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
    <title>Tambah Data booking</title>
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
    <h2 class="fs-1">Input Data booking</h2>
    <form method="POST" enctype="multipart/form-data"> 
        <label class="form-label">Kode booking:</label>
        <input class="form-control" type="text" name="id" required><br>

        <label class="form-label">Judul booking:</label>
        <input class="form-control" type="text" name="judul" required><br>

        <label class="form-label">Subjudul:</label>
        <input class="form-control" type="text" name="sub" required><br>

        <label class="form-label">Keterangan:</label>
        <textarea class="form-control" name="ket"></textarea><br>

        <label class="form-label">Tujuan:</label>
        <input class="form-control" type="text" name="tujuan" required><br>

        <label class="form-label">Lokasi:</label>
        <input class="form-control" type="text" name="lokasi" required><br>

        <label class="form-label">Tanggal:</label>
        <input class="form-control" type="date" name="tanggal" required><br>

        <label class="form-label">Oleh:</label>
        <input class="form-control" type="text" name="oleh" required><br>

        <label class="form-label">Jenis Trip:</label>
        <input class="form-control" type="text" name="trip" required><br>

        <label class="form-label">Total Orang:</label>
        <input class="form-control" type="number" name="totalorang" required><br>

        <label class="form-label">Rating:</label>
        <input class="form-control" type="number" step="0.1" name="rating" required><br>

        <label class="form-label">Unggah Gambar:</label>
        <input class="form-control" type="file" name="gambarbooking" required><br>

        <input class="btn btn-success button" type="submit" name="submit" value="Simpan">
        <input class="btn btn-secondary button" type="reset" value="Batal">
    </form>
</div>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Daftar booking</h2>
    <form method="POST">
        <div class="form-group row">
        <div class="col-sm-6">
        <input type="text" name="search" class="form-control" placeholder="Cari judul booking">
        </div>
        <input type="submit" name="kirim" value="Cari" class="btn btn-info col-sm-1">
        </div>
    </form>

    <table class="table table-success mt-5">
        <tr>
            <th scope="col">Kode</th>
            <th scope="col">Judul</th>
            <th scope="col">Subjudul</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Tujuan</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Oleh</th>
            <th scope="col">Trip</th>
            <th scope="col">Total Orang</th>
            <th scope="col">Rating</th>
            <th scope="col">Gambar</th>
            <th scope="col">Aksi</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $row['id_booking']; ?></td>
            <td><?= $row['judul']; ?></td>
            <td><?= $row['subjudul']; ?></td>
            <td><?= $row['keterangan']; ?></td>
            <td><?= $row['tujuan']; ?></td>
            <td><?= $row['lokasi']; ?></td>
            <td><?= $row['tanggal']; ?></td>
            <td><?= $row['oleh']; ?></td>
            <td><?= $row['trip']; ?></td>
            <td><?= $row['totalorang']; ?></td>
            <td><?= $row['rating']; ?></td>
            <td><img src="images/<?= $row['gambarbooking']; ?>" width="100"></td>
            <td>
                <a class="btn btn-success button" href="editbooking.php?id=<?= $row['id_booking']; ?>">Edit</a>
                <a class="btn btn-danger button" href="hapusbooking.php?id=<?= $row['id_booking']; ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
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
