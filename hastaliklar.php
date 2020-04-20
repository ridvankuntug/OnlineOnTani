<?php require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->
      <ul class="list-group">
      <li class="list-group-item active">Hastalıklar</li>
      <?php
      $hata = $_GET["hata"];
      $basarili = $_GET["basarili"];//Yetki ve sil düğmesine tıklandığında dönen veriyi değişkene alıyor
      if($hata){
        echo '<div class="alert alert-danger" role="alert">'.$hata.'</div>';
      }
      else if($basarili){
        echo '<div class="alert alert-success" role="alert">'.$basarili.'</div>';
      }//Yetki ve sil düğmesine tıklandığında dönen sonucu gösteriyor

      try{
        $query = $db->query("SELECT hastaliklar.hastalikID, hastaliklar.hastalikAdi, poliklinikler.poliklinikAdi
        FROM hastaliklar
        INNER JOIN poliklinikler ON hastaliklar.poliklinikID=poliklinikler.poliklinikID;")->fetchAll(PDO::FETCH_ASSOC);//Hastalik listesini çeken sql kodu
        $i=0;//Sayaç için değişken
        foreach ($query as $row) {
          echo '<a href="hastalik.php?id='.$row["hastalikID"].'"><div class="list-group-item list-group-item-action">'.++$i.
          '- <b>Hastalık: </b>'.$row["hastalikAdi"].' <b>Poliklinik: </b>'.$row["poliklinikAdi"].' </a>';
          if($_SESSION["kullaniciYetki"] > 3){
            echo ' <a href="hastalik.php?sil='.$row["hastalikID"].'"><button type="button" class=" btn btn-sm btn-primary" >Sil</button></a>';
          }//Sil butonunu sadece yetkililer görüyor
          echo '</div>';
        }
      }catch(Exception $e) {//hata olursa ekrana yazıyoruz
        echo '<div class="alert alert-success" role="alert"> Bir sorun oluşmuş gibi görünüyor. Anasayfaya dönmek için <a href="index.php">tıklayınız</a>.</div>';
      }
      ?>
      </ul>
      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>