<?php 
function connect(){
  require '../config.php';
  return $mysqli;
}



function getAllproducts(){
  $mysqli = connect();
  $res = mysqli_query($mysqli,"SELECT tb_artikel.*,
  kategori_artikel.nama_kategori,
  tb_admin.nama_operator
  FROM tb_artikel
  INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
  INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id 
  ORDER BY id DESC
  ");

  while($row = mysqli_fetch_assoc($res)){
    $products[] = $row;
  }
  return $products;
}

function getProductsByCategory($category){
  $mysqli = connect();
  $category = mysqli_real_escape_string($mysqli, $category);
  $res1 = $mysqli->query("SELECT tb_artikel.*,
  kategori_artikel.nama_kategori,
  tb_admin.nama_operator
  FROM tb_artikel
  INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
  INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id WHERE tb_artikel.id_kategori = '$category'
  ORDER BY id DESC");
  $res = mysqli_query($mysqli,"SELECT tb_artikel.*,
  kategori_artikel.nama_kategori,
  tb_admin.nama_operator
  FROM tb_artikel
  INNER JOIN kategori_artikel ON tb_artikel.id_kategori = kategori_artikel.id
  INNER JOIN tb_admin ON tb_artikel.user_id = tb_admin.id WHERE tb_artikel.id_kategori = '$category'
  ORDER BY id DESC");
  while($row = mysqli_fetch_assoc($res1)){
    $products[] = $row;
  }
  return $products;

}

?>