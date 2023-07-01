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



  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="text-muted" href="#"></a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="#">Farmer</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <div class="dropdown mx-4">
            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              <img src="../uploads/no-photo.jpg" class="img-fluid rounded-circle" height="30" width="30" alt="">
              <span><?= $_SESSION['username']; ?></span>
            </a>

            <div class="dropdown-menu">
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </div>
          <a class="text-muted" href="../cart.php" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
          </a>
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="../index.php">Beranda</a>
        <a class="p-2 text-muted" href="../artikel/index.php">Artikel</a>
        <a class="p-2 text-muted" href="../daftarbuku/index.php">Daftar Buku</a>
        <a class="p-2 text-muted" href="">Gallery</a>
        <?php
        $menu = mysqli_query($mysqli, "SELECT * from tb_menu");
        while ($data_menu = mysqli_fetch_array($menu)) {
        ?>
          <a class="p-2 text-muted" href="#"> <?= $data_menu['nama_menu'] ?></a>

        <?php }
        ?>
      </nav>
    </div>

    <div class="container py-5">

      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
              <?php
              $header = mysqli_query($mysqli, "SELECT * from tb_slider");
              $i = 0;
              foreach ($header as $row) {
                $actives = '';
                if ($i == 0) {
                  $actives = 'active';
                }


              ?>
                <li data-target="#demo" data-slide-to="<?= $i; ?>" class="active"></li>
              <?php $i++;
              } ?>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
              <?php

              $i = 0;
              foreach ($header as $row) {
                $actives = '';
                if ($i == 0) {
                  $actives = 'active';
                }


              ?>
                <div class="carousel-item <?= $actives; ?>">
                  <img src="../admin/header/image/<?= $row['gambar']; ?>" alt="Los Angeles" width="100%" height="300">
                </div>
              <?php $i++;
              } ?>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>

          </div>
        </div>

      </div>


    </div>





    <div class="container  mb-4 border-bottom ">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 col-6">
          <h3 class="-italic ">
            Gallery
          </h3>
        </div>


      </div>


    </div>

    <div class="row">
      <div class="container text-right">
        <a href="../index.php" class="text-primary lg-mr-3">Kembali</a>
      </div>
      <?php
      $gallery = mysqli_query($mysqli, "SELECT * FROM tb_gallery");
      while ($data = mysqli_fetch_array($gallery)) :
      ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4 mt-4">
          <div class="card">
            <img class="card-img-top" src="../admin/gallery/image/<?= $data['gambar']; ?>" width="200px" height="200" alt="Card image cap">
            <div class="card-body">
              <p class="card-text"><?= $data['nama']; ?></p>
            </div>
          </div>
        </div>
      <?php endwhile ?>
    </div>

    <main role="main" class="container">

      <div class="row">

        <div class="col-12 blog-main">




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