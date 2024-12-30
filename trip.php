<?php 
$querytrip = mysqli_query($conn, "SELECT destinasiwisata.*, 
kabupaten.nama_kabupaten, 
kategori.kategori_nama
FROM destinasiwisata
JOIN kabupaten ON destinasiwisata.kode_kabupaten = kabupaten.kode_kabupaten
JOIN kategori ON destinasiwisata.kategori_id = kategori.kategori_id");
?>

<div class="container">
<h1 class="text-center mb-5">PLAN YOUR TRIP NOW</h1>
<div class="row g-4">
      <?php if (mysqli_num_rows($querytrip) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($querytrip)) { ?>
          <div class="col-md-4 col-sm-6">
            <div class="card h-100 overflow-hidden shadow border-0">
              <img class="card-img-top" src="admin/images/<?php echo $row['gambardestinasi']; ?>" alt="Foto tidak tersedia" style="height: 200px; object-fit: cover;" />
              <div class="card-body py-4 px-3">

                <h5 class=" text-secondary text-center mb-3 fs-1"><?php echo $row['nama_kabupaten']; ?></h5>
                <h3 class="text-center fw-medium mb-3">
                  <a class="" href="#!"><?php echo $row['nama_destinasi']; ?></a>
                </h4>

                <div class="container">
                <div class="d-flex align-items-center text-muted mb-3 text-center">
                <div class="me-4 d-flex align-items-center">
                <i class="bi bi-person-fill text-warning"></i>
                <span class="ms-2">Nicholas</span>
                </div>
  
                <div class="me-4 d-flex align-items-center">
                  <i class="bi bi-eye-fill text-warning"></i>
                  <span class="ms-2">1000</span>
                 </div>
  
                <div class="d-flex align-items-center">
                  <i class="bi bi-chat-dots-fill text-warning"></i>
                 <span class="ms-3">7</span>
                 </div>
                </div>
                </div>

                <div class="d-flex align-items-center text-center mb-2">
                  <span class="fs-1 text-dark"><?php echo $row['keterangan_destinasi']; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } else { ?>
      <?php } ?>
    </div>
  </div>
</div>
</div>