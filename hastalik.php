<?php $deneme = 'Hastalık'; require("inc/header.php"); ?>

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
          FROM iliski_hb
          INNER JOIN belirtiler  ON belirtiler.belirtiID = iliski_hb.belirtiID
          INNER JOIN hastaliklar  ON hastaliklar.hastalikID = iliski_hb.hastalikID
          WHERE hastaliklar.hastalikID = $id;
          ")->fetchAll(PDO::FETCH_ASSOC);//Hastalik listesini çeken sql kodu
          $i=0;//Sayaç için değişken
          foreach ($query as $row1) {
            if($i==0){
              echo '<div class="list-group-item list-group-item-primary active"><b>' .$row1["hastalikAdi"]. '</b>
              <a href="hastaliklar.php"><button type="button" class="btn btn-sm btn-primary float-right" >Bütün Hastalıklar</button></a></div>
              <div class="list-group-item list-group-item-primary">Poliklinikler:</div>';
              $query = $db->query("SELECT poliklinikler.poliklinikAdi, poliklinikler.poliklinikID
              FROM iliski_ph
              JOIN poliklinikler ON poliklinikler.poliklinikID = iliski_ph.poliklinikID
              WHERE iliski_ph.hastalikID = $id
              ;")->fetchAll(PDO::FETCH_ASSOC);//Poliklinik listesini çeken sql kodu
              foreach ($query as $row2) {
                echo '<div class="list-group-item"><a href="poliklinik.php?id='.$row2["poliklinikID"].'"><b>'
                .$row2['poliklinikAdi']. '</b></a></div>';
              }
              echo '<div class="list-group-item list-group-item-primary"> Belirtiler: </div>';
            }
            echo '<div class="list-group-item">'.++$i.
            '- <b>'.$row1["belirtiAdi"].'</b></div>';
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