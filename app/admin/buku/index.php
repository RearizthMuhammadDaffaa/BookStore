<?php
include_once("../config.php");




$usertype = $_SESSION['usertype'];
$username = $_SESSION['username'];

session_start();

if (!isset($_SESSION['usertype']) == "1") {
    echo "
    <script>alert('login terlebih dahulu')</script>
    ";
    header('Location: ../sign.php');
  
    exit;
  }

if (empty($username) || ($usertype == '1')) {
  echo "
  <script>alert('login terlebih dahulu')</script>
  ";
  header('Location: ../sign.php');

  exit;
}




?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Buku</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <a href='buku/create.php?page=buku' class="btn btn-info"><i class="fas fa-plus"></i>Tambah Buku</a>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <table width='100%' id='tabel-simpel' class="table table-bordered">

                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Gambar</th>
                                <th>Kategori Buku</th>
                                <th>Jumlah</th>
                                
                                <th>Aksi</th>
                                
                                
                            </tr>
                            <?php
                            $no = 1;
                            $result = mysqli_query($mysqli, "SELECT data_buku.*,
                            kategori.nama_kategori
                            FROM data_buku
                            INNER JOIN kategori ON data_buku.id_kategori = kategori.id                
                            ORDER BY id DESC");

                            // $artikel = mysqli_query($mysqli,"SELECT * from tb_artikel");

                            // while ($artikel = mysqli_fetch_array($result)) {
                                foreach($result as $art){
                            ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $art['judul_buku'] ?></td>
                                    <td><?= $art['deskripsi'] ?></td>
                                    <td><?= $art['harga'] ?></td>
                                    <td>
                                    <div class="user-panel d-flex">
                                            <div class="image">
                                            <img src="../admin/buku/image/<?= $art["gambar"]; ?>" alt="Gambar" class="img-square elevation-1" style="width: 60px; height: 50px; margin-left: auto; margin-right: auto;">
                                            </div>
                                        </div>    
                                </td>
                                <td><?= $art['nama_kategori'] ?></td>
                                <td><?= $art['jumlah_buku'] ?></td>
                                    <td>
                                        <a class="btn btn-success" href='buku/edit.php?id=<?= $art['id'] ?>&page=buku'>Edit</a>
                                        <a class="btn btn-danger" onclick='return confirmDelete()' href='buku/delete.php?id=<?= $art['id'] ?>&page=buku'>Hapus</a>
                                    </td>
                                </tr><?php } ?>
                        </table>
                    </div>
                </div><!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>