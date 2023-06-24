<?php 
// include_once("../../config.php");
require '../../config.php';
require_once '../../config.php';
function query($query){
  include_once("../../config.php");
  $conn = koneksi();
  $result = mysqli_query($conn ,$query);

  //jika hasil nya cuma 1 data
  if(mysqli_num_rows($result) == 1){
    return mysqli_fetch_assoc($result);
  }


  $rows = [];

  while($row = mysqli_fetch_assoc($result)){
  $rows[] = $row;
  }
  return $rows;
}

?>