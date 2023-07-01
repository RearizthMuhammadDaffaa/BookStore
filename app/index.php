<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();


// include("config.php");
require 'config.php';



if (!isset($_SESSION['username'])) {
  echo "
  <script>alert('login terlebih dahulu')</script>
  ";
  header('Location: admin/login.php');

  exit;
}



$no = 1;
$allArtikel = mysqli_query($mysqli, "SELECT tb_artikel.*,
                            kategori_artikel.nama_kategori,
                            tb_admin.nama_operator
                            FROM tb_artikel
                            INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
                            INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id
                            ORDER BY id DESC
                            ");
$batas = 2;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;
$jumlah_data = $allArtikel->num_rows;
$total_halaman = ceil($jumlah_data / $batas);

$new_artikel = mysqli_query($mysqli, "SELECT tb_artikel.*,
                            kategori_artikel.nama_kategori,
                            tb_admin.nama_operator
                            FROM tb_artikel
                            INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
                            INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id
                            LIMIT $halaman_awal, $batas
                           ");
$artikel = mysqli_query($mysqli, "SELECT tb_artikel.*,
                            kategori_artikel.nama_kategori,
                            tb_admin.nama_operator
                            FROM tb_artikel
                            INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
                            INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id
                            ORDER BY id DESC
                            limit 4
                            ");


$kategori = mysqli_query($mysqli, "SELECT * from kategori_artikel");
$about = mysqli_query($mysqli, "SELECT * FROM tb_about");
$menu = mysqli_query($mysqli, "SELECT * from tb_menu");
$header = mysqli_query($mysqli, "SELECT * from tb_slider");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Blog Website</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/blog/">



  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">



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

    .borderless {
      border: none !important;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="blog.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="text-muted" href="#"></a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="#">Book Store</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <div class="dropdown mr-5">
            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              <img src="uploads/no-photo.jpg" class="img-fluid rounded-circle" height="30" width="30" alt="">
              <span><?= $_SESSION['username']; ?></span>
            </a>

            <div class="dropdown-menu">
              <a class="dropdown-item" href="profile.php">Edit Profile</a>
              <a class="dropdown-item" href="order.php">Order</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </div>
          <a class="text-muted" href="cart.php" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>

          </a>
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="">Beranda</a>
        <a class="p-2 text-muted" href="artikel/index.php">Artikel</a>
        <a class="p-2 text-muted" href="daftarbuku/index.php">Daftar Buku</a>
        <a class="p-2 text-muted" href="Gallery/index.php">Gallery</a>
        <?php

        while ($data_menu = mysqli_fetch_array($menu)) {
        ?>
          <a class="p-2 text-muted" href="<?= $data['nama_menu']; ?>/index.php"> <?= $data_menu['nama_menu'] ?></a>

        <?php } ?>
      </nav>
    </div>

    <div class="container py-5">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
              <?php
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
                  <img src="admin/header/image/<?= $row['gambar']; ?>" alt="Los Angeles" width="100%" height="300">
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
    <!-- test -->

    <div class="container mt-2 ">
      <div class="row pt-5 m-auto">
        <div class="col-md-6 col-lg-4 pb-3">


          <div class="card card-custom bg-white border-white border-0">
            <div class="card-custom-img" style="background-image: url(uploads/bannerKomik.jpg);"></div>
            <div class="card-custom-avatar">
              <img class="img-fluid" src="uploads/buku.jpg" alt="Avatar" />
            </div>
            <div class="card-body" style="overflow-y: auto">
              <h4 class="card-title">Daftar Buku</h4>
            </div>
            <div class="card-footer" style="background: inherit; border-color: inherit;">

              <a href="daftarbuku/index.php" class="btn btn-outline-primary">Lihat daftar buku</a>
            </div>
          </div>
          <!-- Copy until here -->

        </div>

        <div class="col-md-6 col-lg-4 pb-3">

          <!-- Copy the content below until next comment -->
          <div class="card card-custom bg-white border-white border-0">
            <div class="card-custom-img" style="background-image: url(uploads/banner\ artikel.jpg);"></div>
            <div class="card-custom-avatar">
              <img class="img-fluid" src="uploads/istockphoto-1256458876-612x612.jpg" alt="Avatar" />
            </div>
            <div class="card-body" style="overflow-y: auto">
              <h4 class="card-title">Artikel</h4>
            </div>
            <div class="card-footer" style="background: inherit; border-color: inherit;">

              <a href="artikel/index.php" class="btn btn-outline-primary">lihat Semua Artikel</a>
            </div>
          </div>
          <!-- Copy until here -->

        </div>
        <div class="col-md-6 col-lg-4 pb-3">

          <!-- Copy the content below until next comment -->
          <div class="card card-custom bg-white border-white border-0">
            <div class="card-custom-img" style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);"></div>
            <div class="card-custom-avatar">
              <img class="img-fluid" src="uploads/download.png" alt="Avatar" />
            </div>
            <div class="card-body" style="overflow-y: auto">
              <h4 class="card-title">Gallery</h4>
            </div>
            <div class="card-footer" style="background: inherit; border-color: inherit;">
              <a href="#" class="btn btn-outline-primary">lihat Gallery</a>
            </div>
          </div>
          <!-- Copy until here -->

        </div>

      </div>
    </div>


    <!-- akhir test -->

    <!-- product show  -->

    



    <!-- akhir product show -->

  </div>

  <main role="main" class="container mt-5">

    <div class="row">

      <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
          New Artikel Post
        </h3>
        <?php
        while ($dataArtikel = mysqli_fetch_array($new_artikel)) {
        ?>


          <div class="blog-post">
            <h2 class="blog-post-title">
              <?= $dataArtikel['judul_artikel'] ?>

            </h2>
            <p class="blog-post-meta"><?= date('d-M-Y', strtotime($dataArtikel['created_time'])) ?> by <a href="#"><?= $dataArtikel['nama_operator'] ?></a></p>
            <p class="text-justify"><?= $dataArtikel['content_artikel'] ?></p>
          </div><!-- /.blog-post -->
        <?php } ?>
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
      <aside class="col-md-4 blog-sidebar">
        <div class="p-4 mb-3 bg-light rounded">
          <h4 class="font-italic">About</h4>
          <?php while ($abt = mysqli_fetch_array($about)) : ?>
            <h5 class="font-italic mt-2"><?= $abt['judul']; ?></h5>
            <p class="mb-0"><?= $abt['isi']; ?></p>
          <?php endwhile ?>
        </div>


      </aside><!-- /.blog-sidebar -->

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
                <td><img src="admin/social/image/<?= $data['icon']; ?>" alt="" class="rounded-circle" width="30px" height="30"></td>
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

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</body>

</html>