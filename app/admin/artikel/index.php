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
                        <h3 class="card-title">Data artikel</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <a href='artikel/create.php?page=artikel' class="btn btn-info"><i class="fas fa-plus"></i>Tambah artikel</a>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <table width='100%' id='tabel-simpel' class="table table-bordered">

                            <tr>
                                <th>No</th>
                                <th>Judul Artikel</th>
                                <th>Kategori Artikel</th>
                                <th>Penulis</th>
                                
                                <th>Aksi</th>
                                <th>Gambar</th>
                                
                            </tr>
                            <?php
                            $no = 1;
                            $result = mysqli_query($mysqli, "SELECT tb_artikel.*,
                            kategori_artikel.nama_kategori,
                            tb_admin.nama_operator
                            FROM tb_artikel
                            INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
                            INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id
                            
                            ORDER BY id DESC");

                            $artikel = mysqli_query($mysqli,"SELECT * from tb_artikel");

                            // while ($artikel = mysqli_fetch_array($result)) {
                                foreach($result as $art){
                            ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $art['judul_artikel'] ?></td>
                                    <td><?= $art['nama_kategori'] ?></td>
                                    <td><?= $art['nama_operator'] ?></td>
                                    <td>
                                    <div class="user-panel d-flex">
                                            <div class="image">
                                            <img src="../admin/artikel/image/<?= $art["cover"]; ?>" alt="Gambar" class="img-square elevation-1" style="width: 60px; height: 50px; margin-left: auto; margin-right: auto;">
                                            </div>
                                        </div>    
                                </td>
                                    <td>
                                        <a class="btn btn-success" href='artikel/edit.php?id=<?= $art['id'] ?>&page=artikel'>Edit</a>
                                        <a class="btn btn-danger" onclick='return confirmDelete()' href='artikel/delete.php?id=<?= $art['id'] ?>&page=artikel'>Hapus</a>
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