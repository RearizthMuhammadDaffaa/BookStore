<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// include("config.php");
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


$no = 1;
$allArtikel = mysqli_query($mysqli, "SELECT data_buku.*, kategori.nama_kategori
FROM data_buku
INNER JOIN kategori ON data_buku.id_kategori = kategori.id
ORDER BY id DESC
 ");
$batas = 8;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;
$jumlah_data = $allArtikel->num_rows;
$total_halaman = ceil($jumlah_data / $batas);

$new_artikel = mysqli_query($mysqli, "SELECT data_buku.*, kategori.nama_kategori
FROM data_buku
INNER JOIN kategori ON data_buku.id_kategori = kategori.id
ORDER BY id DESC LIMIT $halaman_awal, $batas
                           ");

$kategori = mysqli_query($mysqli, "SELECT * from kategori");
// $menu = mysqli_query($mysqli, "SELECT * from tb_menu");

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Artikel Page</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/blog/">



  <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../blog.css">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .jumbotron-image {
      background-position: center center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    @media (max-width:720px) {
      h3 {
        font-size: 1.1rem;
      }
    }

    .message {
      position: sticky;
      top: 0;
      left: 0;
      right: 0;
      padding: 15px 10px;
      background-color: var(--white);
      text-align: center;
      z-index: 1000;
      box-shadow: var(--box-shadow);
      font-size: 20px;
      text-transform: capitalize;

    }
  </style>


  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="blog.css" rel="stylesheet">
</head>

<body>

  <?php
  if (isset($massage)) {
    foreach ($massage as $msg) {
      echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
    }
  }

  ?>

  <div class="container">
    <?php include "../header.php"; ?>





    <div class="container  mb-4 border-bottom ">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 col-6">
          <h3 class="-italic ">
            New Update Post
          </h3>
        </div>
        <div class="col-lg-3 col-3">
          <h3 class="text-kategori">filter by category</h3>
        </div>
        <div class="col-lg-3 col-3">
          <div class="btn-group mb-2">
            <button class="btn  btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
              pilih kategori
            </button>
            <div class="dropdown-menu">

              <ul>
                <li><a href="index.php">Semua kategori</a></li>
                <?php while ($data = mysqli_fetch_array($kategori)) : ?>
                  <li><a href="index2.php?kategori_id=<?= $data['id']; ?>"> <?= $data['nama_kategori']; ?></a></li>
                <?php endwhile ?>
              </ul>




            </div>
          </div>
        </div>
      </div>


    </div>
    <h3 class="text-center">semua kategori</h3>
    <div class="row mb-2 product-wrapper" id="product-wrapper">
      <div class="container text-right">
        <a href="../index.php" class="text-primary lg-mr-3">Kembali</a>
      </div>
      <?php

      while ($data = mysqli_fetch_array($new_artikel)) {
      ?>

        <div class="col-md-4 ">

          <div class="card mx-auto mt-3" style="width: 18rem;">
            <form action="" method="post">
              <img src="../admin/buku/image/<?= $data['gambar']; ?>" width="100px" height="200px" class="card-img-top " alt="...">
              <div class="card-body text-center">
                <h5 class="card-title"><?= $data['judul_buku']; ?></h5>
                <p class="card-text">deskripsi : <?= $data['deskripsi']; ?></p>
                <p class="card-text">harga : <?= number_format($data['harga']); ?></p>
                <div class="d-flex justify-content-center  flex-column">
                  <a href="detail.php?id_buku=<?= $data['id']; ?>" class="btn btn-primary">Detail</a>
                  <button type="submit" class="btn btn-success mt-2 " name="add_cart">ADD to chart</button>
                </div>

              </div>
          </div>

          <input type="hidden" name="judul_buku" value="<?= $data['judul_buku']; ?>">
          <input type="hidden" name="harga" value=" <?= $data['harga']; ?>">
          <input type="hidden" name="gambar_buku" value="<?= $data['gambar']; ?>">
          <input type="hidden" name="id_buku" value="<?= $data['id']; ?>">

          </form>
        </div>
      <?php } ?>

      <!-- filter data -->


      <!-- end filter data -->

    </div>
  </div>

  <main role="main" class="container">

    <div class="row">

      <div class="col-12 blog-main">


        <nav class="blog-pagination">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link" <?php if ($halaman > 1) {
                                      echo "href='?halaman=$previous'";
                                    } ?>>Sebelumnya</a>
            </li>
            <?php

            for ($x = 1; $x <= $total_halaman; $x++) {
            ?>
              <li class="page-item"><a class="page-link" href="?halaman=<?= $x ?>"><?= $x; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item">
              <a class="page-link" <?php if ($halaman < $total_halaman) {
                                      echo "href='?halaman=$next'";
                                    } ?>>Selanjutnya</a>
            </li>
          </ul>
        </nav>

      </div><!-- /.row -->


  </main><!-- /.container -->

  <footer class="blog-footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 col-6">
          <h2>social</h2>
          <table class="table table-borderless mt-2">
            <tr class="">
              <?php $social = mysqli_query($mysqli, "SELECT * FROM tb_social");
              while ($data = mysqli_fetch_array($social)) :
              ?>
                <td><img src="../admin/social/image/<?= $data['icon']; ?>" alt="" class="rounded-circle" width="30px" height="30"></td>
                <td class="ml-4"><?= $data['nama_sosmed']; ?></td>
            </tr>
          <?php endwhile ?>
          </table>
        </div>
        <div class="col-lg-8 col-6 d-flex align-items-center justify-content-center flex-wrap">
          <p class="text-break">Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>. <a href="#" class="text-break">Back to top</a></p>
          <p>

          </p>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>
  </footer>
  <script src="cari.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</body>

</html>