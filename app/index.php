<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// include("config.php");
require 'config.php';

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
          <a class="text-muted" href="#" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false">
              <title>Search</title>
              <circle cx="10.5" cy="10.5" r="7.5" />
              <path d="M21 21l-5.2-5.2" />
            </svg>
          </a>
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <?php
        while ($data_menu = mysqli_fetch_array($menu)) {
        ?>
          <a class="p-2 text-muted" href="<?= $data['nama_menu']; ?>/index.php"> <?= $data_menu['nama_menu'] ?></a>

        <?php } ?>
      </nav>
    </div>

    <div class="container py-5">
      <div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(https://diperpa.badungkab.go.id/storage/olds/diperpa/Cara-Budidaya-Buah-Naga_649711.jpg);">
        <h2 class="mb-4">
          Join For The Best Experience
        </h2>
        <p class="mb-4">
          Hey, check this out.
        </p>
        <a href="https://bootstrapious.com/snippets" class="btn btn-primary">Find More</a>
      </div>
    </div>

    <div class="row mb-2">
      <?php
      while ($data = mysqli_fetch_array($artikel)) {
      ?>
        <div class="col-md-6">
          <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary"><?= $data['nama_kategori'] ?></strong>
              <h3 class="mb-0">New post</h3>
              <div class="mb-1 text-muted"><?= date('d-M-Y', strtotime($data['created_time'])) ?></div>
              <p class="card-text mb-auto text-justify"><?= substr($data['content_artikel'], 0, 100) . '...' ?></p>
              <a href="#" class="stretched-link">Continue reading</a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <!-- <div class="user-panel d-flex">
                <div class="image">
                       <img src="./admin/artikel/image/ <?= $data["cover"]; ?>" alt="Gambar" class="img-square elevation-1" style="width: 60px; height: 50px; margin-left: auto; margin-right: auto;">
                                      </div>
                                        </div>     -->
              <img width="200px" class="rounded float-right" src="./admin/artikel/image/ <?= $data['cover'] ?>" alt="">
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <main role="main" class="container">

    <div class="row">

      <div class="col-md-8 blog-main">
        <?php
        while ($dataArtikel = mysqli_fetch_array($new_artikel)) {
        ?>
          <h3 class="pb-4 mb-4 font-italic border-bottom">
            New Update Post
          </h3>

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
          <ul class="">
           <?php $social = mysqli_query($mysqli,"SELECT * FROM tb_social");
            while($data = mysqli_fetch_array($social)):
           ?>
            <li class=" lg-mt-2 mt-3 mx-3 d-flex lg-justify-content-between align-items-center"><img src="admin/social/image/<?= $data['icon']; ?>" class="img-thumbnail rounded-circle" width="50px" height="50px" alt="..."> <?= $data['nama_sosmed']; ?></li>
          
           <?php endwhile ?>
           </ul>
        </div>
        <div class="col-lg-8 col-6 d-flex align-items-center justify-content-center flex-wrap">
          <p class="text-break">Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.  <a href="#" class="text-break">Back to top</a></p>
          <p>
         
          </p>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>


  </footer>



</body>

</html>