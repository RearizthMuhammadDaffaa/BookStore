<?php 

function koneksi(){
  return mysqli_connect('localhost' ,'root' ,'' ,'web_profil');

}

function query($query){
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



function ubahKategori($data){
  $conn = koneksi();

  $id = $data['id'];
  $nama_kategori = $data['kategori'];
  
  
  
  $query = "UPDATE tb_kategori SET 
            'nama_kategori' = '$nama_kategori'
            WHERE id =$id";
            
            

  mysqli_query($conn ,$query) or die(mysqli_error($conn));
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}
?>