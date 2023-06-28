<?php
include_once("../config.php");

?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data social</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <a href='social/create.php?page=social' class="btn btn-info"><i class="fas fa-plus"></i>Tambah social</a>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <table width='100%' id='tabel-simpel' class="table table-bordered">

                            <tr>
                                <th>No</th>
                                <th>Nama social</th>
                                <th>gambar</th>
                                
                                
                                <th>Aksi</th>
                               
                                
                            </tr>
                            <?php
                            $no = 1;
                            $result = mysqli_query($mysqli, "SELECT * from tb_social
                            ORDER BY id DESC");

                           

                            // while ($artikel = mysqli_fetch_array($result)) {
                                foreach($result as $art){
                            ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $art['nama_sosmed'] ?></td>
    
                                    <td>
                                    <div class="user-panel d-flex">
                                            <div class="image">
                                            <img src="../admin/social/image/<?= $art["icon"]; ?>" alt="Gambar" class="img-square elevation-1" style="width: 60px; height: 50px; margin-left: auto; margin-right: auto;">
                                            </div>
                                        </div>    
                                </td>
                                    <td>
                                        <a class="btn btn-success" href='social/edit.php?id=<?= $art['id'] ?>&page=social'>Edit</a>
                                        <a class="btn btn-danger" onclick='return confirmDelete()' href='social/delete.php?id=<?= $art['id'] ?>&page=social'>Hapus</a>
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