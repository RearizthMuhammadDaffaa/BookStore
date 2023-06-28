var keywoard = document.querySelector('#keywoard');
var tombolCari = document.querySelector('#btn-cari');
var container = document.querySelector('#product-wrapper');



keywoard.addEventListener('keyup', function() {
  
  //buat object ajax
  var xhr = new XMLHttpRequest();
  //cek kesiapan ajax
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      container.innerHTML = xhr.responseText;
    }
  }
  
  xhr.open('GET','buku.php?keywoard=' + keywoard.value,true)
  xhr.send()



});
