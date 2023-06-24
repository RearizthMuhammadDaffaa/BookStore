<?php
// include_once("../config.php");
require_once(__DIR__ . "../../../config.php");

?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Kategori Buku</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <a href='kategori_buku/create.php?page=kategori_buku' class="btn btn-info"><i class="fas fa-plus"></i>Tambah kategori</a>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <table width='100%' id='tabel-simpel' class="table table-bordered">

                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1;
                            $result = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY id DESC");

                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['nama_kategori'] ?></td>
                                    <td>
                                        <a class="btn btn-success" href='kategori_buku/edit.php?id=<?= $data['id'] ?>&page=kategori_buku'>Edit</a>
                                        <a class="btn btn-danger" onclick='return confirmDelete()' href='kategori_buku/delete.php?id=<?= $data['id'] ?>&page=kategori_buku'>Hapus</a>
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