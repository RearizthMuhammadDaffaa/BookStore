<?php 
require 'function.php';
if(isset($_POST['category'])){
  $category = $_POST['category'];
  if($category === ""){
    $products = getAllproducts();
  }else{
    $products = getProductsByCategory($category);
  }
  echo json_encode($products);
}
?>