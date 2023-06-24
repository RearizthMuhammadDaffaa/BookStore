 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">
         <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {
                    case 'users_admin':
                        include "users_admin/index.php";
                        break;
                    case 'artikel':
                        include "artikel/index.php";
                        break;

                    case 'kategori_artikel':
                        include "kategori_artikel/index.php";
                        break;
                    case 'about':
                        include "about/index.php";
                        break;
                    case 'menu':
                        include "menu/index.php";
                        break;
                    case 'home':
                        include "home/index.php";
                        break;
                    default:
                        echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                        break;
                }
            } else {
                require ('../home/index.php');
            }

            ?>
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content -->