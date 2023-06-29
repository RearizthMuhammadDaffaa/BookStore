let selectmenu = document.querySelector('#products');
let container = document.querySelector('.product-wrapper');
var keywoard = document.querySelector('#cari');
var tombolCari = document.querySelector('#btn-cari');
var wrapper = document.querySelector('#container');

selectmenu.addEventListener("change",function(){
    let categoryName = this.value;

    
    let http = new XMLHttpRequest();

    http.onload = function(){
      if(this.readyState == 4 && this.status == 200){
        let response = JSON.parse(this.responseText);
        
        let out = "";
        for(let item of response){
          let createdTime = new Date(item.created_time);
          let formattedDate = createdTime.getDate() + '-' + (createdTime.getMonth() + 1) + '-' + createdTime.getFullYear();
          out += `
          <div class="col-md-6 "> 
          <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary">${item.nama_kategori}</strong>
              <h3 class="mb-0"> ${item.judul_artikel}</h3>
              <div class="mb-1 text-muted">${formattedDate}</div>
              <p class="card-text mb-auto text-justify">${item.content_artikel.substring(0,30) + '...'}</p>
              <a href="artikelDetail.php?id=${item.id}" class="stretched-link">Continue reading</a>
            </div>
            <div class="col-auto  d-lg-block">
             
              <img width="200px" class="img-thumbnail " src="../admin/artikel/image/${item.cover}" alt="">
            </div>
          </div>
          </div>
        `;
        }
        container.innerHTML = out
      }
    }



    http.open("POST",'script.php',true);
    http.setRequestHeader("content-type","application/x-www-form-urlencoded");
    http.send('category=' + categoryName);
})





keywoard.addEventListener('keyup', function() {
  
  alert(keywoard.value)
  //buat object ajax
  var xhr = new XMLHttpRequest();
  //cek kesiapan ajax
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      wrapper.innerHTML = xhr.responseText;
    }
  }
  
  xhr.open('GET','cariArtikel.php?keywoard=' + keywoard.value,true)
  xhr.send()



});
