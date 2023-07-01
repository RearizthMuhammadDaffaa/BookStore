<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// include_once("../../config.php");
// include('session.php');
require_once(__DIR__ . "../../../config.php");
require 'session.php';

$usertype = $_SESSION['usertype'];
$username = $_SESSION['username'];



if (empty($username) || ($usertype == '1')) {
    echo "
  <script>alert('silahkan logout dan login terlebih dahulu sebagai admin')</script>
  ";
    header('Location: ../sign.php');
    exit;
}





$kategori = mysqli_query($mysqli, 'SELECT count(*) jml FROM kategori_artikel');
$row_kategori = mysqli_fetch_assoc($kategori);
$artikel = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_artikel');
$row_artikel = mysqli_fetch_assoc($artikel);
$users = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_user');
$row_users = mysqli_fetch_assoc($users);
$buku = mysqli_query($mysqli, 'SELECT count(*) jml FROM data_buku');
$row_buku = mysqli_fetch_assoc($buku);


$test = mysqli_query($mysqli, "SELECT terjual FROM data_buku");
$judul_buku = mysqli_fetch_assoc($test);


?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $row_users['jml'] ?></h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $row_artikel['jml'] ?><sup style="font-size: 20px"></sup></h3>
                        <p>Artikel</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-pen"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>
                            <?= $row_kategori['jml'] ?>
                        </h3>
                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>
                            <?= $row_buku['jml'] ?>
                        </h3>
                        <p>Buku</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container">
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const user = <?php echo json_encode($judul_buku); ?>;
    const buku = <?php echo json_encode($row_buku); ?>;
    const data = {
        labels: [],
        datasets: [{
                label: '# of Votes',
                data: user,
                borderWidth: 1
            },
            {
                label: '# of Votes',
                data: buku,
                borderWidth: 1
            },

        ]
    }

    const config = {
        type: 'bar',
        data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    )
</script>