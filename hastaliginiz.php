<!-- Yeni bir sayfa oluşturulacağı zaman her seferinde bu kodlar arasına yazılacak -->
<?php require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->
      <p class="alert alert-warning">Aşağıdakiler, belirttiğiniz belirtilere uyan hastalıkların listesidir. Hangi polikliniğe gitmeniz gerektiğini anlamanız için yardımcı olmak amacı ile listenemiştir. </br> En doğru sonuç için bir sağlık kuruluşuna başvurmalısınız.</p>
      <?php
        $i = 0;
        foreach($_POST['dizi'] as $gelen){
          $belirti[$i] = $gelen;
          $i++;
        }
        for($j = 0 ; $j < sizeof($belirti) ; $j++){
        }
        try{
          $k=0;//Sayaç için değişken
          for($j = 0 ; $j < sizeof($belirti) ; $j++){
            $belirtiID = $belirti[$j];
            $query = $db->query("SELECT hastaliklar.hastalikID, hastaliklar.hastalikAdi, hastaliklar.hastalikAciklama, poliklinikler.poliklinikAdi
            FROM iliski
            JOIN hastaliklar ON hastaliklar.hastalikID = iliski.hastalikID
            JOIN poliklinikler ON poliklinikler.poliklinikID = hastaliklar.poliklinikID
            WHERE iliski.belirtiID = $belirtiID
            ;")->fetchAll(PDO::FETCH_ASSOC);//Hastalik listesini çeken sql kodu
            foreach ($query as $row) {
              $hastalikID[0][$k] = $row['hastalikID'];
              $hastalikID[1][$k] = $row['hastalikAdi'];
              $hastalikID[2][$k] = $row['hastalikAciklama'];
              $hastalikID[3][$k] = $row['poliklinikAdi'];
              $k++;
            }
          }
          array_multisort($hastalikID[0], $hastalikID[1], $hastalikID[2], $hastalikID[3]);
          $m = 0;
          for($l = 0 ; $l < count($hastalikID[0]) ; $l++){
            if($hastalikID[0][$l] != $hastalikID[0][$l-1]){
              $hastaliklar[1][$m] = $hastalikID[0][$l];
              $hastaliklar[2][$m] = $hastalikID[1][$l];
              $hastaliklar[3][$m] = $hastalikID[2][$l];
              $hastaliklar[4][$m] = $hastalikID[3][$l];
              $m++;
            }
            $hastaliklar[0][$m-1]++;
          }
          array_multisort($hastaliklar[0], SORT_DESC, SORT_NUMERIC,
                          $hastaliklar[1], $hastaliklar[2], $hastaliklar[3], $hastaliklar[4]);

          if(sizeof($hastaliklar[0]) < 3){
            $sayac = sizeof($hastaliklar[0]) ;
          }
          else{
            $sayac = 3;
          }
          if($sayac == 0){
            echo '<p class="alert alert-danger">Belirtiğiniz belirtilere uygun hastalık bulunamamıştır.</p>';
          }
          for($l = 0 ; $l < $sayac ; $l++){
            echo '<p class="alert alert-info"><b><a href="hastalik.php?id='.$hastaliklar[1][$l].'">' . $hastaliklar[2][$l] . '</a></b> bu hastalık için <b>' . $hastaliklar[4][$l] . '</b> polikliniğine gitmelisiniz.</br>
            Belirtilerinizden <b>' . $hastaliklar[0][$l] . '</b> tanesi bu hastalık ile eşleşiyor.  </br>
            ' . $hastaliklar[3][$l] . '</p>';
          }
        }
        catch(Exception $e){
          echo 'hata: ' . $e;
        }
      ?>
      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>