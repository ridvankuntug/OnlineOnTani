<?php require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->
      <div class="list-group">
      <?php
      $id = $_GET["id"];
      $sil = $_GET["sil"];//hastaliklar.php sayfasından gelen veriler

      if(!$id == null){//İşlem yapılacak mı kontrol ediyor
        try{
          $id = $_GET['id'];
          $query = $db->query("SELECT hastaliklar.hastalikAdi, belirtiler.belirtiAdi, hastaliklar.hastalikAciklama
          FROM iliski
          INNER JOIN belirtiler  ON belirtiler.belirtiID = iliski.belirtiID
          INNER JOIN hastaliklar  ON hastaliklar.hastalikID = iliski.hastalikID
          WHERE hastaliklar.hastalikID = $id;
          ")->fetchAll(PDO::FETCH_ASSOC);//Hastalik listesini çeken sql kodu
          $i=0;//Sayaç için değişken
          foreach ($query as $row) {
            if($i==0){
              echo '<div class="list-group-item list-group-item-primary active">'. $row["hastalikAdi"] .
              '<a href="hastaliklar.php"><button type="button" class="btn btn-sm btn-primary float-right" >Geri</button></a></div>';
              echo '<div class="list-group-item list-group-item-primary">'. $row["hastalikAciklama"] .
              '</div>';
            }
            echo '<div class="list-group-item">'.++$i.
            '- <b>Belirti: </b>'.$row["belirtiAdi"].'</div>';
          }
        }catch(PDOException $e) {
          echo '<meta http-equiv="refresh" content="0;URL=hastaliklar.php?hata=Bir%20Sorun%20Oluştu.">';
        }
      }
      else if($sil != null && $_SESSION["kullaniciYetki"] > 3){//Silme işlemi mi yapılacağını kontrol ediyor
        try{
          $query = $db->prepare("DELETE FROM hastaliklar WHERE
          hastalikID = ?");
          $delete = $query->execute(array(
            $sil
          ));//Sil değişkeni içerisinde gelen IDli kişiyi siliyor

          if($delete){//İşlem başarılı mı diye kontrol ediyor
            echo '<meta http-equiv="refresh" content="0;URL=hastaliklar.php?basarili=Silindi.">';
          }
          else{
            echo '<meta http-equiv="refresh" content="0;URL=hastaliklar.php?hata=Bir%20Sorun%20Oluştu.">';
          }
        }catch(PDOException $e) {
          echo '<meta http-equiv="refresh" content="0;URL=hastaliklar.php?hata=Bir%20Sorun%20Oluştu.">';
        }
      }
      else{
        echo '<meta http-equiv="refresh" content="0;URL=hastaliklar.php?hata=Yanlış%20Id.">';
      }
      ?>
      </div>
      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>