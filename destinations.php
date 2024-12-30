<section class="pt-5" id="destination">
  <div class="container">
    <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4">
      <img src="template/public/assets/img/dest/shape.svg" alt="destination" />
    </div>
    <div class="mb-7 text-center">
      <h5 class="text-secondary">Top Selling</h5>
      <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Top Destinations</h3>
    </div>
    <div class="row g-4">
      <?php if (mysqli_num_rows($querydestinasi) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($querydestinasi)) { ?>
          <div class="col-md-4 col-sm-6">
            <div class="card h-100 overflow-hidden shadow border-0">
              <img class="card-img-top" src="admin/images/<?php echo $row['gambardestinasi']; ?>" alt="Foto tidak tersedia" style="height: 200px; object-fit: cover;" />
              <div class="card-body py-4 px-3">
                <h4 class="text-secondary fw-medium mb-3">
                  <a class="link-900 text-decoration-none stretched-link" href="#!"><?php echo $row['nama_destinasi']; ?></a>
                </h4>
                <span class="fs-2 text-muted d-block mb-2"><?php echo $row['nama_kabupaten']; ?></span>
                <div class="d-flex align-items-center">
                  <img src="template/public/assets/img/dest/navigation.svg" alt="navigation" width="20" class="me-2" />
                  <span class="fs-1 text-dark"><?php echo $row['alamat_destinasi']; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } else { ?>
        <div class="col-12 text-center">
          <p class="text-muted fs-5">Destinasi belum tersedia.</p>
        </div>
      <?php } ?>
    </div>
  </div><!-- end of .container -->
</section>