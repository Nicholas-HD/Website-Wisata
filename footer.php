<?php
$queryfooter = mysqli_query($conn, "SELECT * FROM kategori");
?>

<section class="pb-0 pb-lg-4 bg-dark">
  <div class="container bg-dark text-light">
    <div class="row">
      <div class="col-lg-4 col-md-4 mb-4 mb-lg-0 order-lg-1 order-md-2">
        <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4 text-success"><u>Pesona jawa.com</u></h4>
        <ul class="list-unstyled mb-0">
            <li>wisata jawa mempesona</li>
        </ul>
        <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mt-4 mb-lg-4 text-success"><u>Pariwisata Solo</u></h4>
        <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mt-4 mb-lg-4 text-success"><u>Download SLPP-App</u></h4>
    </div>

      <div class="col-lg-4 col-md-4 mb-4 mb-lg-0 order-lg-2 order-md-3">
        <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4 text-success"><u>Travel hotel & information Kategori</u></h4>
        <ul class="list-unstyled mb-0">
        <?php 
          while ($row = mysqli_fetch_assoc($queryfooter)) { 
          ?>
            <li class="mb-2">
              <a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">
                <?php echo htmlspecialchars($row['kategori_nama']); ?>
              </a>
            </li>
          <?php 
          } 
          ?>
        </ul>
      </div>


      <div class="col-lg-4 col-md-4 mb-4 mb-lg-0 order-lg-3 order-md-4 ">
        <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4 text-success"><u>More</u></h4>
        <ul class="list-unstyled mb-0">
            <li>admin@pesonajawa.com</li>
        </ul>
      </div>
    </div>
  </div><!-- end of .container-->
</section>
