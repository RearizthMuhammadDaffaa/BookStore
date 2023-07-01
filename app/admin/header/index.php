<?php
include_once("../config.php");
$usertype = $_SESSION['usertype'];
$username = $_SESSION['username'];



if (empty($username) || ($usertype == '1')) {
    echo "
  <script>alert('silahkan logout dan login terlebih dahulu sebagai admin')</script>
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
                        <h3 class="card-title">Data Header</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <a href='header/create.php?page=header' class="btn btn-info"><i class="fas fa-plus"></i>Tambah Header</a>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <table width='100%' id='tabel-simpel' class="table table-bordered">

                            <tr>
                                <th>No</th>
                                <th>Nama Header</th>
                                <th>gambar</th>
                                
                                
                                <th>Aksi</th>
                               
                                
                            </tr>
                            <?php
                            $no = 1;
                            $result = mysqli_query($mysqli, "SELECT * from tb_slider
                            ORDER BY id DESC");

                            $artikel = mysqli_query($mysqli,"SELECT * from tb_artikel");

                            // while ($artikel = mysqli_fetch_array($result)) {
                                foreach($result as $art){
                            ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $art['nama'] ?></td>
    
                                    <td>
                                    <div class="user-panel d-flex">
                                            <div class="image">
                                            <img src="../admin/header/image/<?= $art["gambar"]; ?>" alt="Gambar" class="img-square elevation-1" style="width: 60px; height: 50px; margin-left: auto; margin-right: auto;">
                                            </div>
                                        </div>    
                                </td>
                                    <td>
                                        <a class="btn btn-success" href='header/edit.php?id=<?= $art['id'] ?>&page=header'>Edit</a>
                                        <a class="btn btn-danger" onclick='return confirmDelete()' href='header/delete.php?id=<?= $art['id'] ?>&page=header'>Hapus</a>
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