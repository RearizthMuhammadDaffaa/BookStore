<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require '../config.php';
$base_url_admin = "http://localhost/BOOKSTORE/app/admin";
$base_url = "http://localhost/BOOKSTORE/app";


if (isset($_POST['register'])) {
  $username = mysqli_real_escape_string($mysqli, $_POST['username']);
  $passwoard = mysqli_real_escape_string($mysqli, md5($_POST['password']));
  $select = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$passwoard'") or die('query failed');
  if (mysqli_num_rows($select) > 0) {
    echo "<script>
    alert('username sudah ada')
    </script>";
  } else {
    mysqli_query($mysqli, "INSERT INTO tb_user(username,password) VALUES('$username','$passwoard')") or die('query failed');
    echo "<script>
    alert('register berhasil')
    </script>";
    header('Location:login.php');
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="register.php" class="h1"><b>Register</b> Panel</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">register</p>

        <form action="register.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name='password' class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name='cpassword' class="form-control" placeholder="konfirmasi Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row aligns-item-center">

            <!-- /.col -->
            <div class="col-4 offset-1">
              <button type="submit" name="register" class="btn btn-primary btn-block">register</button>
            </div>
            <div class="col-6 text-center mt-1">
              <a href="<?= $base_url; ?>/login.php">Kembali</a>
            </div>
            <!-- /.col -->
          </div>

        </form>

        <div class="social-auth-links text-center mt-2 mb-3">
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>