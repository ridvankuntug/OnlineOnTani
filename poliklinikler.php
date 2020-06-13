<?php $deneme = 'Poliklinikler'; require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->
      <ul class="list-group">
      <li class="list-group-item active"><b>Poliklinikler</b></li>
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
        $query = $db->query("SELECT poliklinikler.poliklinikID, poliklinikler.poliklinikAdi
        FROM poliklinikler
        ORDER BY poliklinikler.poliklinikID ASC;")->fetchAll(PDO::FETCH_ASSOC);//Poliklinik listesini çeken sql kodu
        $i=0;//Sayaç için değişken
        foreach ($query as $row) {
          echo '<a href="poliklinik.php?id='.$row["poliklinikID"].'"><div class="list-group-item list-group-item-action">'.++$i.
          '- <b>'.$row["poliklinikAdi"].'</b></a></div>';
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