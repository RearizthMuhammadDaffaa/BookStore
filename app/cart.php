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

$userid = $_SESSION['id'];

if (isset($_POST['update_cart'])) {
  $updated_quantity = $_POST['updated_quantity'];
  $update_id = $_POST['cart_id'];
  mysqli_query($mysqli, "UPDATE cart set quantity = '$updated_quantity' WHERE id = '$update_id'") or die('queey failed');
}

if (isset($_GET['delete_all'])) {
  mysqli_query($mysqli, "DELETE FROM cart WHERE user_id = '$userid'") or die("wuawe");
  header('location: cart.php');
}
if (isset($_GET['remove'])) {
  $remove = $_GET['remove'];
  mysqli_query($mysqli, "DELETE FROM cart WHERE id = '$remove'") or die("wuawe");
  header('location: cart.php');
}


$kategori = mysqli_query($mysqli, "SELECT * from kategori_artikel");
$about = mysqli_query($mysqli, "SELECT * FROM tb_about");
$menu = mysqli_query($mysqli, "SELECT * from tb_menu");
$cart = mysqli_query($mysqli, "SELECT * from cart WHERE user_id ='$userid'");
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

    @media (max-width: 768px) {
      .table-container {
        overflow-x: scroll;
      }

      .btn-updated {
        width: 20px;
        font-size: 1rem;
      }

      .input-cart {
        width: 20px;
      }
    }

    .borderless {
      border: none !important;
    }

    .input-cart {
      width: 40px;
    }

    .btn-updated {
      width: 60px;
      margin-left: 10px;
      font-size: .8rem;

    }

    .delete-btn {
      background-color: #e74c3c;
      display: inline-block;
      padding: 10px 10px;
      cursor: pointer;
      font-size: 18px;
      color: #fff;
      border-radius: 5px;
      text-transform: capitalize;
    }

    .btn-checkout {
      padding: 10px 30px;
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
          <a class="blog-header-logo text-dark" href="#">Book Store</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <div class="dropdown mx-4">
            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              <img src="uploads/no-photo.jpg" class="img-fluid rounded-circle" height="30" width="30" alt="">
              <span><?= $_SESSION['username']; ?></span>
            </a>

            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Edit Profile</a>
              <a class="dropdown-item" href="#">Isi saldo</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </div>
          <a class="text-muted" href="#" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <span>0</span>
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
  </div>
  <h1 class="text-center mt-5">Shopping cart</h1>
  <div class="container mt-5">

    <div class="table-responsive ">
      <table class="table table-container">
        <thead class="thead-dark">
          <tr>
            <th>gambar</th>
            <th scope="col">judul buku</th>
            <th scope="col">harga</th>
            <th scope="col">jumlah</th>
            <th scope="col">total harga</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $grandtotal = 0;
          foreach ($cart as $ct) : ?>
            <tr>
              <td><img src="admin/buku/image/<?= $ct['gambar']; ?>" width="40" height="20" alt=""></td>
              <td><?= $ct['judul_buku']; ?></td>
              <td><?= $ct['harga']; ?></td>
              <td>
                <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?= $ct['id']; ?>">
                  <input type="number" name="updated_quantity" value="<?= $ct['quantity']; ?>" class="input-cart">
                  <button type="submit" name="update_cart" class="btn btn-warning btn-updated">updated</button>
                </form>
              </td>
              <td>Rp.<?= $sub_total = ($ct['harga'] * $ct['quantity']); ?></td>
              <td><a href="cart.php?remove=<?= $ct['id']; ?>" class="delete-btn" onclick="return confirm('are you sure')">Remove</a></td>
            </tr>
          <?php
            $grandtotal += $sub_total;
          endforeach ?>
          <tr class="table-bottom">
            <td colspan="4">grand total :</td>
            <td>$ <?= $grandtotal; ?></td>
            <td><a href="cart.php?delete_all" onclick="return confirm('delete all from cart?')" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">delete all</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-12  d-flex justify-content-center my-3">
      <button class="btn btn-primary btn-checkout">Checkout</button>
    </div>


  </div>



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
                <td><img src="admin/social/image/<?= $data['icon']; ?>" alt="" class="rounded-circle" width="40px" height="40"></td>
                <td class="ml-4"><?= $data['nama_sosmed']; ?></td>
            </tr>
          <?php endwhile ?>
          </table>

          <!-- <ul class="">
            <?php $social = mysqli_query($mysqli, "SELECT * FROM tb_social");
            while ($data = mysqli_fetch_array($social)) :
            ?>
              <li class=" lg-mt-2 mt-3 d-flex justify-content-lg-around align-items-center"><img src="admin/social/image/<?= $data['icon']; ?>" class="rounded-circle " width="40px" height="40px" alt="..."> <?= $data['nama_sosmed']; ?></li>

            <?php endwhile ?>
          </ul> -->
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