<section id="testimonial">
  <div class="container">
    <div class="row">
      <div class="col-lg-5">
        <div class="mb-8 text-start">
          <h5 class="text-secondary">Testimonials</h5>
          <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">What people say about Us.</h3>
        </div>
      </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-6">
    <div class="pe-7 ps-5 ps-lg-0">
        <div class="carousel slide carousel-fade position-static" id="testimonialIndicator" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                if (mysqli_num_rows($queryTestimoni) > 0) {
                    $i = 0;
                    while ($row = mysqli_fetch_array($queryTestimoni)) {
                        echo '<button class="' . ($i === 0 ? 'active' : '') . '" type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="' . $i . '" aria-current="true" aria-label="Testimonial ' . $i . '"></button>';
                        $i++;
                    }
                    // Reset pointer data
                    mysqli_data_seek($queryTestimoni, 0);
                }
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                if (mysqli_num_rows($queryTestimoni) > 0) {
                    $i = 0;
                    while ($row = mysqli_fetch_array($queryTestimoni)) { ?>
                        <div class="carousel-item position-relative <?php echo $i === 0 ? 'active' : ''; ?>">
                            <div class="card shadow" style="border-radius:10px;">
                                <div class="position-absolute start-0 top-0 translate-middle">
                                    <img class="rounded-circle fit-cover" src="admin/images/<?php echo $row['gambartestimoni']; ?>" height="65" width="65" alt="Foto <?php echo $row['nama']; ?>" />
                                </div>
                                <div class="card-body p-4">
                                    <h2><?php echo $row['judul']; ?></h2>
                                    <p class="fw-medium mb-4">"<?php echo $row['isi_testimoni']; ?>"</p>
                                    <h5 class="text-secondary"><?php echo $row['nama']; ?></h5>
                                    <p class="fw-medium fs--1 mb-0"><?php echo $row['kota_negara']; ?></p>
                                </div>
                            </div>
                            <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100" style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                        </div>
                    <?php
                        $i++;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
            <div class="carousel-navigation d-flex flex-column flex-between-center position-absolute end-0 top-lg-50 bottom-0 translate-middle-y z-index-1 me-3 me-lg-0" style="height:60px;width:20px;">
              <button class="carousel-control-prev position-static" type="button" data-bs-target="#testimonialIndicator" data-bs-slide="prev"><img src="template/public/assets/img/icons/up.svg" width="16" alt="icon" /></button>
              <button class="carousel-control-next position-static" type="button" data-bs-target="#testimonialIndicator" data-bs-slide="next"><img src="template/public/assets/img/icons/down.svg" width="16" alt="icon" /></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end of .container -->
</section>