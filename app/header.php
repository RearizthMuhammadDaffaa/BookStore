<div class="dropdown mx-4">
            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
             <img src="uploads/no-photo.jpg"  class="img-fluid rounded-circle" height="30" width="30" alt="">
             <span><?= $_SESSION['username']; ?></span>
            </a>

            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Edit Profile</a>
              <a class="dropdown-item" href="#">Isi saldo</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </div>