<?php 
// Ambil kategori secara acak
$querykate = "SELECT kategori_id, kategori_nama FROM kategori ORDER BY RAND() LIMIT 1"; 
$resultkate = mysqli_query($conn, $querykate);

// Cek apakah query berhasil
if ($resultkate && mysqli_num_rows($resultkate) > 0) {
    // Ambil data kategori acak
    $row = mysqli_fetch_assoc($resultkate);
    $kategori_id = $row['kategori_id'];
    $kategori_nama = $row['kategori_nama'];
} else {
    // Jika query gagal, tampilkan pesan error
    $kategori_id = null;
    $kategori_nama = "Kategori tidak ditemukan";
}

// Ambil destinasi wisata berdasarkan kategori terpilih
if ($kategori_id) {
    $querydesti = mysqli_query($conn, "SELECT * FROM destinasiwisata WHERE kategori_id = '$kategori_id'");
}
?>

<section class="pt-5 pt-md-9" id="service">
    <div class="container">
        <div class="position-absolute z-index--1 end-0 d-none d-lg-block">
            <img src="template/public/assets/img/category/shape.svg" style="max-width: 200px" alt="service" />
        </div>
        <div class="mb-7 text-center">
            <h5 class="text-secondary">CATEGORY</h5>
            <h2>Our Specialization: <?= htmlspecialchars($kategori_nama); ?></h2>
            <p>Welcome to the best services in <?= htmlspecialchars($kategori_nama); ?>.</p>
        </div>

        <div class="row g-4">
            <?php if (isset($querydesti) && mysqli_num_rows($querydesti) > 0) { ?>
                <?php while ($destinasi = mysqli_fetch_assoc($querydesti)) { ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0">
                            <img 
                                src="admin/images/<?php echo htmlspecialchars($destinasi['gambardestinasi']); ?>" 
                                class="card-img-top rounded-top" 
                                alt="<?php echo htmlspecialchars($destinasi['nama_destinasi']); ?>" 
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-primary"><?php echo htmlspecialchars($destinasi['nama_destinasi']); ?></h5>
                                <p class="card-text text-truncate" title="<?php echo htmlspecialchars($destinasi['keterangan_destinasi']); ?>">
                                    <?php echo htmlspecialchars($destinasi['keterangan_destinasi']); ?>
                                </p>
                                <a href="#" class="btn btn-outline-primary btn-sm mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="text-center">
                    <p class="text-secondary">No destinations available in this category.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
