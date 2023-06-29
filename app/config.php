<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$base_url_admin = "http://localhost/BOOKSTORE/app/admin";
$base_url = "http://localhost/BOOKSTORE/app";
$databaseHost = 'localhost';
$databaseName = 'uas_pabw';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);



// function query($query){
//     $conn = koneksi();
//     $result = mysqli_query($conn ,$query);
  
//     //jika hasil nya cuma 1 data
//     if(mysqli_num_rows($result) == 1){
//       return mysqli_fetch_assoc($result);
//     }
  
  
//     $rows = [];
  
//     while($row = mysqli_fetch_assoc($result)){
//     $rows[] = $row;
//     }
//     return $rows;
//   }





