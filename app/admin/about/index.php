<?php
include_once("../config.php");
// require_once '../../config.php';


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
                        <h3 class="card-title">Data About</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <a href='about/create.php?page=about' class="btn btn-info"><i class="fas fa-plus"></i>Tambah About</a>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <table width='100%' id='tabel-simpel' class="table table-bordered">

                            <tr>
                                <th>No</th>
                                <th>judul</th>
                                <th>isi</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1;
                            $result = mysqli_query($mysqli, "SELECT * FROM tb_about ORDER BY id DESC");

                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['judul'] ?></td>
                                    <td><?= $data['isi'] ?></td>
                                    <td>
                                        <a class="btn btn-success" href='about/edit.php?id=<?= $data['id'] ?>&page=about'>Edit</a>
                                        
                                            <a class="btn btn-danger" onclick='return confirmDelete()' href='about/delete.php?id=<?= $data['id'] ?>&page=about'>Hapus</a>
                                        
                                    </td>
                                </tr><?php    } ?>
                        </table>
                    </div>
                </div><!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>