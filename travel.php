<?php
$query = mysqli_query($conn, "SELECT * FROM travel ORDER BY id_travel DESC LIMIT 1");
$travel = mysqli_fetch_assoc($query);
if ($travel) {?>

<section style="padding-top: 7rem;">
    <div class="bg-holder" style="background-image:url(template/public/assets/img/hero/hero-bg.svg);"></div>
    <!--/.bg-holder-->

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end">
                <!-- Gambar Travel -->
                <img class="pt-7 pt-md-0 hero-img" src="admin/images/<?php echo htmlspecialchars($travel['gambartravel']); ?>" alt="Foto tidak tersedia" alt="hero-header" />
            </div>
            <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
                    <h4 class="fw-bold text-danger mb-3"><?= htmlspecialchars($travel['subjudul']); ?></h4>
                    <h1 class="hero-title"><?= htmlspecialchars($travel['judul']); ?></h1>
                    <p class="mb-4 fw-medium">
                        <?= nl2br(htmlspecialchars($travel['keterangan'])); ?>
                        <br class="d-none d-xl-block" />
                    </p>
                    <div class="text-center text-md-start">
                        <a class="btn btn-primary btn-lg me-md-4 mb-3 mb-md-0 border-0 primary-btn-shadow" href="#!" role="button">Find out more</a>
                        <div class="w-100 d-block d-md-none"></div>
                        <a href="#!" role="button" data-bs-toggle="modal" data-bs-target="#popupVideo">
                            <span class="btn btn-danger round-btn-lg rounded-circle me-3 danger-btn-shadow">
                                <img src="template/public/assets/img/hero/play.svg" width="15" alt="play" />
                            </span>
                        </a>
                    <span class="fw-medium"><a href="<?= htmlspecialchars($travel['linkvideo']); ?>" target="_blank">Watch Video</a>
                    </span>
            </div>
        </div>
    </div>
</section>
<?php
} else {
}
?>