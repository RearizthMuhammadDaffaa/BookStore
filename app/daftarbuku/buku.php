<?php
require '../config.php';
$keywoard = $_GET['keywoard'];
$buku = mysqli_query($mysqli, "SELECT * FROM data_buku WHERE judul_buku LIKE '%$keywoard%'");



?>

<?php

while ($data = mysqli_fetch_array($buku)) {
?>

  <div class="col-md-4 ">
    <div class="card mx-auto mt-2" style="width: 18rem;">
      <img src="../admin/buku/image/<?= $data['gambar']; ?>" class="card-img-top img-fluid" alt="...">
      <div class="card-body text-center">
        <h5 class="card-title"><?= $data['judul_buku']; ?></h5>
        <p class="card-text">deskripsi : <?= $data['deskripsi']; ?></p>
        <p class="card-text">harga : <?= number_format($data['harga']); ?></p>
        <div class="d-flex justify-content-center  flex-column">
          <a href="detail.php?id_buku=<?= $data['id']; ?>" class="btn btn-primary">Detail</a>
          <button type="submit" class="btn btn-success mt-2 ">ADD to chart</button>
        </div>

      </div>
    </div>
  </div>
  <?php } ?>