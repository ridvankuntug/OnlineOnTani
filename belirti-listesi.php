<?php require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->

      <ul class="list-group">
      <li class="list-group-item list-group-item-primary">Belirtiler</li>
      <?php
      $hata = $_GET["hata"];
      $basarili = $_GET["basarili"];//Gelen veriyi değişkene alıyor
      if($hata){
        echo '<div class="alert alert-danger" role="alert">'.$hata.'</div>';
      }
      else if($basarili){
        echo '<div class="alert alert-success" role="alert">'.$basarili.'</div>';
      }//Yetki ve sil düğmesine tıklandığında dönen sonucu gösteriyor

      if($_SESSION["kullaniciYetki"] < 2){//Sayfaya sadece admin erişebiliyor
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
      }
      else{
        try{
          $query = $db->query("SELECT * FROM belirtiler
          ")->fetchAll(PDO::FETCH_ASSOC);//Belirti listesini çeken sql kodu
          $i=0;//Sayaç için değişken
          foreach ($query as $row) {
            echo '<div class="list-group-item list-group-item-action">'.++$i.
            '- <b>Belirti: </b>'.$row["belirtiAdi"];
            if($_SESSION["kullaniciYetki"] > 3){
              echo ' <a href="belirti-sil.php?sil='.$row["belirtiID"].'"><button type="button" class=" btn btn-sm btn-primary" >Sil</button></a>';
            }//Sil butonunu sadece yetkililer görüyor
            echo '</div>';
          }
        }catch(Exception $e) {//hata olursa ekrana yazıyoruz
          echo '<div class="alert alert-success" role="alert"> Bir sorun oluşmuş gibi görünüyor. Anasayfaya dönmek için <a href="index.php">tıklayınız</a>.</div>';
        }
      }
      ?>
      </ul>

      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>