<?php
$queryindentitas = mysqli_query($conn, "SELECT * FROM nicholas");
$row = mysqli_fetch_assoc($queryindentitas);
?>

<section>
  <div class="row d-flex justify-content-center">
    <div class="col-md-10 col-xl-8 text-center">
    <p class="mb-4 pb-2 mb-md-5 pb-md-0">
    <h3 class="mb-4">Identitas diri</h3>
    </p>
    </div>
  </div>

  <div class="col-md-12 mb-0 text-center">
    <?php if ($row) { ?>
      <div class="justify-content-center">
        <img src="admin/images/users.jpg" class="rounded-circle shadow-1-strong" width="100" height="100" />
      </div>
      <p class="my-3 text-muted">
        <?php echo $row['keterangan']; ?>
      </p>
      <h1 class="font-italic font-weight-normal mb-3">
        <?php echo $row['Ynicholas']; ?>
    </h1>
      <h5 class="font-italic font-weight-normal mT-3">
        <?php echo $row['825230005nicholas']; ?>
    </h5>
    <?php } else { ?>
    <?php } ?>
  </div>
</section>
