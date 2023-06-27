<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// include("config.php");
require '../config.php';


$id = $_GET['id'];

$artikel = mysqli_query($mysqli, "SELECT tb_artikel.*,
                            kategori_artikel.nama_kategori,
                            tb_admin.nama_operator
                            FROM tb_artikel
                            INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
                            INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id
                            WHERE tb_artikel.id = $id
                            ");

$data = mysqli_query($mysqli,"SELECT * FROM tb_artikel");


$kategori = mysqli_query($mysqli, "SELECT * from kategori_artikel WHERE id='$id'");
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
  <link href="../blog.css" rel="stylesheet">
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


    <main>
      <div class="container">
        <div class="row">
        <?php while($art = mysqli_fetch_array($artikel)): ?>  
          <div class="col-12 mt-2">
            <h1 class="text-center">
             <?= $art['judul_artikel']; ?>
            </h1>
          </div>
            <div class="col-12 mt-3">
              <div class="img-container ">
              <img src="../admin/artikel/image/<?= $art['cover']; ?>" class="img-fluid rounded mx-auto d-block" alt="...">
              </div>
            </div>
            <div class="col-12">
              <h1 class="text-center mt-3">

              </h1>
              <p class="blog-post-meta text-center"><?= date('d-M-Y', strtotime($art['created_time'])) ?> by <a href="#"><?= $art['nama_operator'] ?></a></p>
             
              <p class=" long-text text-break"><?= $art['content_artikel']; ?></p>
            </div>
            <?php endwhile ?>
        </div>
      </div>
    </main>


    <footer class="blog-footer">
      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>



</body>

</html>