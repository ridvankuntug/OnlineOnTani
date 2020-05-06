        <li class="nav-item active">
          <a class="nav-link" href="index.php">Anasayfa <span class="sr-only">(current)</span></a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="grup-listesi.php">Grup Listesi</a>
        </li>-->
        <li class="nav-item active">
          <a class="nav-link" href="poliklinikler.php">Poliklinikler</a>
        </li>
      <?php
        if($_SESSION["kullaniciYetki"] >= 4){//Sadece yetkiliye görünüyor
      ?>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hastalıklar
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="hastaliklar.php">Hastalıklar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="hastalik-ekle.php">Hastalık Ekle</a>
          </div>
        </li>
      <?php }else{ ?>
        <li class="nav-item active">
          <a class="nav-link" href="hastaliklar.php">Hastalıklar</a>
        </li>
        <?php } ?>
        <li class="nav-item active">
          <a class="nav-link" href="belirtiler.php">Belirtiler</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="iletisim.php">İletişim</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="hakkimizda.php">Hakkımızda</a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>-->
        <!--Bootstrap Navbar ve Menü içinde görüntülenecek olan linkler sayfası-->