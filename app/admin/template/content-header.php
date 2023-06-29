  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
          <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                switch ($page) {
                    case 'users_admin':
                        include "users_admin/content-header.php";
                        break;
                    case 'artikel':
                        include "artikel/content-header.php";
                        break;
                    case 'buku':
                        include "buku/content-header.php";
                        break;
                    case 'gallery':
                        include "buku/content-header.php";
                        break;
                    case 'kategori_buku':
                        include "kategori_buku/content-header.php";
                        break;
                    case 'kategori_artikel':
                        include "kategori_artikel/content-header.php";
                        break;
                    case 'header':
                        include "header/content-header.php";
                        break;
                    case 'about':
                        include "about/content-header.php";
                        break;
                    case 'social':
                        include "social/content-header.php";
                        break;
                    case 'menu':
                        include "menu/content-header.php";
                        break;
                    case 'home':
                        include "home/content-header.php";
                        break;
                    default:
                        echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                        break;
                }
            } else {
                require '../index.php';
            }

            ?>

      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->