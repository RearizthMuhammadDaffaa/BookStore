<?php
function connect()
{
  require '../config.php';
  return $mysqli;
}



function getAllproducts()
{
  $mysqli = connect();
  $allArtikel =  $mysqli->query("SELECT tb_artikel.*,
  kategori_artikel.nama_kategori,
  tb_admin.nama_operator
  FROM tb_artikel
  INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
  INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id 
  ORDER BY id DESC
  ");

  $batas = 8;
  $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

  $previous = $halaman - 1;
  $next = $halaman + 1;
  $jumlah_data = $allArtikel->num_rows;
  $total_halaman = ceil($jumlah_data / $batas);

  


  
  $res = mysqli_query($mysqli, "SELECT tb_artikel.*,
  kategori_artikel.nama_kategori,
  tb_admin.nama_operator
  FROM tb_artikel
  INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
  INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id ORDER BY id DESC
  LIMIT $halaman_awal, $batas
 ");

  while ($row = mysqli_fetch_assoc($res)) {
    $products[] = $row;
  }
  return $products;
}

function getProductsByCategory($category)
{
  $mysqli = connect();
  $allArtikel =  $mysqli->query("SELECT tb_artikel.*,
  kategori_artikel.nama_kategori,
  tb_admin.nama_operator
  FROM tb_artikel
  INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
  INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id WHERE tb_artikel.id_kategori = '$category'
  ORDER BY id DESC
  ");

  $batas = 8;
  $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

  $previous = $halaman - 1;
  $next = $halaman + 1;
  $jumlah_data = $allArtikel->num_rows;
  $total_halaman = ceil($jumlah_data / $batas);
  $category = mysqli_real_escape_string($mysqli, $category);
  $res1 = $mysqli->query("SELECT tb_artikel.*,
  kategori_artikel.nama_kategori,
  tb_admin.nama_operator
  FROM tb_artikel
  INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
  INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id WHERE tb_artikel.id_kategori = '$category'
  ORDER BY id DESC LIMIT $halaman_awal, $batas");

  while ($row = mysqli_fetch_assoc($res1)) {
    $products[] = $row;
  }
  return $products;
}
