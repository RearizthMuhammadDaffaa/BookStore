<header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="text-muted" href="#"></a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="#">Farmer</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <div class="dropdown mr-4">
            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              <img src="../uploads/no-photo.jpg" class="img-fluid rounded-circle" height="30" width="30" alt="">
              <span><?= $_SESSION['username']; ?></span>
            </a>

            <div class="dropdown-menu">
              <a class="dropdown-item" href="../profile.php">Edit Profile</a>
              <a class="dropdown-item" href="../order.php">order</a>
              <a class="dropdown-item" href="../logout.php">Logout</a>
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
        <a class="p-2 text-muted" href="../Gallery/index.php">Gallery</a>
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
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" id="keywoard" class="form-control" placeholder="search" aria-label="Recipient's username">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btn-cari">Cari</button>
          </div>
        </div>
      </form>
      <script src="cari.js"></script>
      <script src="cariArtikel.js"></script>
    </div>
   
