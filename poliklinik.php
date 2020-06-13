<?php $deneme = 'Poliklinik'; require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->
      <div class="list-group">
      <?php
      $id = $_GET["id"];

      if(!$id == null){//İşlem yapılacak mı kontrol ediyor
        try{
          $id = $_GET['id'];
          $query = $db->query("SELECT poliklinikler.poliklinikAdi, hastaliklar.hastalikAdi, hastaliklar.hastalikID
          FROM iliski_ph
          INNER JOIN hastaliklar  ON hastaliklar.hastalikID = iliski_ph.hastalikID
          RIGHT JOIN poliklinikler  ON poliklinikler.poliklinikID = iliski_ph.poliklinikID
          WHERE poliklinikler.poliklinikID = $id;
          ")->fetchAll(PDO::FETCH_ASSOC);//Hastalik listesini çeken sql kodu
          $i=0;//Sayaç için değişken
          foreach ($query as $row) {
            if($i==0){
              echo '<div class="list-group-item list-group-item-primary active"><b>'. $row["poliklinikAdi"] . '</b>
              <a href="poliklinikler.php"><button type="button" class="btn btn-sm btn-primary float-right" >Diğer Poliklinikler</button></a></div>';
              echo '<div class="list-group-item list-group-item-primary">Bu polikliniğin baktığı hastalıklar:</div>';
            }
            echo '<div class="list-group-item">'.++$i.
            '- <a href="hastalik.php?id='.$row["hastalikID"].'"><b>'.$row["hastalikAdi"].'</b></a></div>';
          }
        }catch(PDOException $e) {
          echo '<meta http-equiv="refresh" content="0;URL=poliklinikler.php?hata=Bir%20Sorun%20Oluştu.">';
        }
      }
      else{
        echo '<meta http-equiv="refresh" content="0;URL=poliklinikler.php?hata=Yanlış%20Id.">';
      }
      ?>
      </div>
      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>