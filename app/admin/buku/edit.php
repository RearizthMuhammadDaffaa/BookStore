<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once("../../config.php");
include('session.php');

define('SITE_ROOT', realpath(dirname(__FILE__)));
// Display selected user data based on id
// Getting id from url
$id = @$_GET['id'];
$usertype = $_SESSION['usertype'];
$username = $_SESSION['username'];



if (empty($username) || ($usertype == '1')) {
  echo "
  <script>alert('login terlebih dahulu')</script>
  ";
  header('Location: ../sign.php');

  exit;
}

// Fetech user data based on id
$res_artikel = mysqli_query($mysqli, "SELECT * FROM data_buku WHERE id= $id ");

while ($artikel = mysqli_fetch_array($res_artikel)) {
    $row_judul_buku = $artikel['judul_buku'];
    $row_deskripsi = $artikel['deskripsi'];
    $row_harga = $artikel['harga'];
    $row_jumlah = $artikel['jumlah_buku'];
    $row_kategori = $artikel['id_kategori'];
}
?>
<?php
// include config connection file
// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user_id = $_SESSION['id'];
    $kategori = @$_POST['kategori'];
    $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($_POST["judul_artikel"])));

    $judul_buku = @$_POST['judul_buku'];
    $deskripsi  = @$_POST['deskripsi'];
    $harga = @$_POST['harga'];
    $jumlah_buku = @$_POST['jumlah_buku'];
    var_dump($content_artikel);
    $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, SITE_ROOT . '/image/' . $nama);
            $file_name = $nama;
        } else {
            echo 'UKURAN FILE TERLALU BESAR';
        }
    } else {
        echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        $file_name = '';
    }

    $file_name = $nama;
    $result = mysqli_query($mysqli, "UPDATE data_buku SET judul_buku = '$judul_buku', gambar='$file_name',
    deskripsi='$deskripsi',id_kategori='$kategori',jumlah_buku='$jumlah_buku',harga='$harga'
    WHERE id=$id");


    // update user data

    // Redirect to homepage to display updated user in list
    header("Location:../dashboard.php?page=buku");
}
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once('../template/navbar.php'); ?>
        <?php include_once('../template/sidebar.php'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include_once('content-header.php'); ?>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Users</h3>

                                    <div class="card-tools">
                                        <!-- This will cause the card to maximize when clicked -->
                                        <a href="<?= $base_url_admin ?>/dashboard.php?page=buku" class="btn btn-info">Kembali</a>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>

                                <div class="card-body">

                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <div class="form-group">
                                            <label for="judul_artikel">Judul Buku</label>
                                            <input type="text" class="form-control" value="<?= $row_judul_buku ?>" name="judul_buku" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="content_artikel">Deskripsi</label>
                                            <textarea type="text" class="form-control" name="deskripsi" required><?= $row_deskripsi ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="judul_artikel">Harga</label>
                                            <input type="text" class="form-control" value="<?= $row_harga ?>" name="harga" required>
                                        </div>
                                        <?php
                                        $data_kategori = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY id = $id DESC");
                                        ?>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select class="form-control" name="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php while ($d_kategori = mysqli_fetch_array($data_kategori)) { ?>
                                                    <option value="<?= $d_kategori['id'] ?>" <?php if ($d_kategori['id'] == $row_kategori) { ?> <?= 'selected' ?> <?php } ?>><?= $d_kategori['nama_kategori'] ?></option>
                                                <?php } ?>
                                                <select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Gambar</label>

                                            <input type="file" name="file" class="form-control" value="gambar/<?= $icon; ?>" required>

                                        </div>
                                        <div class="form-group">
                                            <label for="judul_artikel">Jumlah buku</label>
                                            <input type="text" class="form-control" value="<?= $row_jumlah ?>" name="jumlah_buku" required>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="update">Simpan</button>

                                    </form>


                                </div>
                                <!-- /.content-wrapper -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('../template/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        function confirmDelete() {
            if (confirm('Anda yakin menghapus data?')) {
                //action confirmed
                alert('Data berhasil dihapus');
            } else {
                //action cancelled
                alert('Data batal di hapus');
                return false;

            }
        }
    </script>
</body>

</html>