<?php
if(!defined('aktif')){
    die('anda tidak dapat akses langsung file');
}else{

?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="index.html"><img src="template/public/assets/img/logo.svg" height="34" alt="logo" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
            <li class="nav-item dropdown px-3 px-lg-0 mx-4"> <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:0.3rem;" aria-labelledby="navbarDropdown">
                <?php if (mysqli_num_rows($querykategori) > 0) {?>
                <?php while($row=mysqli_fetch_array($querykategori)) {?>
                <li><a class="dropdown-item" href="indexkategori.php?kategori_id=<?php echo $row["kategori_id"]?>">
                <?php echo $row["kategori_nama"] ?></a></li>
                <?php } ?>
                <?php } ?>
                </ul>
              </li>
              <li class="nav-item dropdown px-3 px-lg-0 mx-4"> <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Destination</a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:0.3rem;" aria-labelledby="navbarDropdown">
                <?php if (mysqli_num_rows($querydesti) > 0) {?>
                <?php while($row=mysqli_fetch_array($querydesti)) {?>
                <li><a class="dropdown-item" href="index.php?kode_destinasi=<?php echo $row["kode_destinasi"]?>">
                <?php echo $row["nama_destinasi"] ?></a></li>
                <?php } ?>
                <?php } ?>
                </ul>
              </li>
              <li class="nav-item dropdown px-3 px-lg-0 mx-4"> <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Booking</a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:0.3rem;" aria-labelledby="navbarDropdown">
                <?php if (mysqli_num_rows($querykabu) > 0) {?>
                <?php while($row=mysqli_fetch_array($querykabu)) {?>
                <li><a class="dropdown-item" href="index.php?kode_kabupaten=<?php echo $row["kode_kabupaten"]?>">
                <?php echo $row["nama_kabupaten"] ?></a></li>
                <?php } ?>
                <?php } ?>
                </ul>
              </li>
              <li class="nav-item dropdown px-3 px-lg-0 mx-4"> <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Testimonial</a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:0.3rem;" aria-labelledby="navbarDropdown">
                <?php if (mysqli_num_rows($queryTesti) > 0) {?>
                <?php while($row=mysqli_fetch_array($queryTesti)) {?>
                <li><a class="dropdown-item" href="indextestimoni.php?id_testimoni=<?php echo $row["id_testimoni"]?>">
                <?php echo $row["judul"] ?></a></li>
                <?php } ?>
                <?php } ?>
                </ul>
              </li>
              <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="admin/login.php">Login</a></li>
              <li class="nav-item px-3 px-xl-4"><a class="btn btn-outline-dark order-1 order-lg-0 fw-medium" href="admin/signup.php">Register</a></li>
              <li class="nav-item dropdown px-3 px-lg-0"> <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">En</a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:0.3rem;" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#!">EN</a></li>
                  <li><a class="dropdown-item" href="#!">BN</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
<?php }?>