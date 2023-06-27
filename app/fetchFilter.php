<?php 
include("config.php");

if(isset($_POST['request'])){
  $request = $_POST['request'];
  $query = "SELECT tb_artikel.*,
  kategori_artikel.nama_kategori,
  tb_admin.nama_operator
  FROM tb_artikel
  INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
  INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id WHERE tb_artikel.id_kategori = '$request'
  ORDER BY id DESC ";
  $result = mysqli_query($mysqli,$query);
  $count = mysqli_num_rows($result);

?>



<div class="row mb-2">
<?php 
if($count){
  while ($data = mysqli_fetch_array($result)) {
}
?>
  <div class="col-md-6">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary"><?= $data['nama_kategori'] ?></strong>
        <h3 class="mb-0">New post</h3>
        <div class="mb-1 text-muted"><?= date('d-M-Y', strtotime($data['created_time'])) ?></div>
        <p class="card-text mb-auto text-justify"><?= substr($data['content_artikel'], 0, 30) . '...' ?></p>
        <a href="artikelDetail.php?id=<?= $data['id']; ?>" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto  d-lg-block">
        <!-- <div class="user-panel d-flex">
          <div class="image">
                 <img src="./admin/artikel/image/ <?= $data["cover"]; ?>" alt="Gambar" class="img-square elevation-1" style="width: 60px; height: 50px; margin-left: auto; margin-right: auto;">
                                </div>
                                  </div>     -->
        <img width="200px" class="img-thumbnail " src="admin/artikel/image/<?= $data['cover']; ?>" alt="">
      </div>
    </div>
  </div>
<?php } else{
  echo"tidak ada data";
} ?>

</div>

<?php } ?>

