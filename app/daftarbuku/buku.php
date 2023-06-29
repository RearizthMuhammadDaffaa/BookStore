<?php
require '../config.php';
$keywoard = $_GET['keywoard'];
$buku = mysqli_query($mysqli, "SELECT * FROM data_buku WHERE judul_buku LIKE '%$keywoard%'");

session_start();
require '../config.php';
if (!isset($_SESSION['username'])) {
  header('Location: admin/login.php');
  exit;
}
$user_id = $_SESSION['id'];
if (isset($_POST['add_cart'])) {
  $judul_buku = $_POST['judul_buku'];
  $harga = $_POST['harga'];
  $gambar_buku = $_POST['gambar_buku'];
  $id_buku = $_POST['id_buku'];

  $select = mysqli_query($mysqli, "SELECT * FROM cart WHERE id_buku = $id_buku AND user_id = $user_id");
  if (mysqli_num_rows($select) > 0) {
    $massage[] = 'product sudah ada di keranjang';
  } else {

    mysqli_query($mysqli, "INSERT INTO cart(user_id,judul_buku,gambar,quantity,id_buku,harga) VALUES('$user_id','$judul_buku','$gambar_buku',1,$id_buku,'$harga')") or die('query failed');
    $massage[] = 'product sudah dimasukkan kedalam ekeranjang';
  }
}


?>

<?php

while ($data = mysqli_fetch_array($buku)) {
?>

  <div class="col-md-4 ">
    <div class="card mx-auto mt-2" style="width: 18rem;">
      <form action="" method="post">
        <img src="../admin/buku/image/<?= $data['gambar']; ?>" class="card-img-top img-fluid" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title"><?= $data['judul_buku']; ?></h5>
          <p class="card-text">deskripsi : <?= $data['deskripsi']; ?></p>
          <p class="card-text">harga : <?= number_format($data['harga']); ?></p>
          <div class="d-flex justify-content-center  flex-column">
            <a href="detail.php?id_buku=<?= $data['id']; ?>" class="btn btn-primary">Detail</a>
            <button type="submit" class="btn btn-success mt-2 "  name="add_cart">ADD to chart</button>
          </div>

        </div>
        <input type="hidden" name="judul_buku" value="<?= $data['judul_buku']; ?>">
        <input type="hidden" name="harga" value=" <?= $data['harga']; ?>">
        <input type="hidden" name="gambar_buku" value="<?= $data['gambar']; ?>">
        <input type="hidden" name="id_buku" value="<?= $data['id']; ?>">
      </form>
    </div>
  </div>
<?php } ?>