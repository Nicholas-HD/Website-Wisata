<?php
include('admin/config.php');

$querykategori = mysqli_query($conn, "SELECT * FROM kategori");

$queryTestimoni = mysqli_query($conn, "SELECT * FROM testimoni");

$queryTesti = mysqli_query($conn, "SELECT * FROM testimoni");

$querykabu = mysqli_query($conn, "SELECT * FROM kabupaten");

$querydesti = mysqli_query($conn, "SELECT * FROM destinasiwisata");

$querydestinasi = mysqli_query($conn, "SELECT destinasiwisata.*, 
kabupaten.nama_kabupaten, 
kategori.kategori_nama
FROM destinasiwisata
JOIN kabupaten ON destinasiwisata.kode_kabupaten = kabupaten.kode_kabupaten
JOIN kategori ON destinasiwisata.kategori_id = kategori.kategori_id");

?>


<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title--> 
    <!-- ===============================================-->
    <title>Jadoo | Travel Agency Landing Page UI</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="template/public/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="template/public/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="template/public/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="template/public/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="template/public/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="template/public/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="template/public/assets/css/theme.css" rel="stylesheet" />

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <?php define('aktif', TRUE);?>
      <?php include("menu.php");?>
      <?php include("travel.php");?>



      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <?php include("kategori.php");?>
     
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
        <?php include("destinations.php");?>
     

      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
    <?php include("booking.php");?>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <?php include("trip.php");?>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <?php include("testimoni.php");?>

      <!-- <section> close ============================-->
      <!-- ============================================-->

      <?php include("identitas.php");?>


      <?php include ("footer.php");?>


      <div class="py-5 text-center">
        <p class="mb-0 text-secondary fs--1 fw-medium">All rights reserved@jadoo.co </p>
      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="template/public/vendors/@popperjs/popper.min.js"></script>
    <script src="template/public/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="template/public/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="template/public/vendors/fontawesome/all.min.js"></script>
    <script src="template/public/public/assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
  </body>

</html>