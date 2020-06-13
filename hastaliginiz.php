<!-- Yeni bir sayfa oluşturulacağı zaman her seferinde bu kodlar arasına yazılacak -->
<?php $deneme = 'Hastalığınız'; require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->
      <div class="alert alert-warning">Aşağıdakiler, belirttiğiniz belirtilere uyan hastalıkların listesidir. Hangi polikliniğe gitmeniz gerektiğini anlamanız için yardımcı olmak amacı ile listenemiştir. </br> En doğru sonuç için bir sağlık kuruluşuna başvurmalısınız.</div>
      <?php
        $i = 0;
        foreach($_POST['dizi'] as $gelen){
          $belirti[$i++] = $gelen;//Gelen belirti ID lerini diziye alıyor
        }
        try{
          $k=0;//Sayaç için değişken
          for($j = 0 ; $j < sizeof($belirti) ; $j++){
            $belirtiID = $belirti[$j];
            $query = $db->query("SELECT hastaliklar.hastalikID, hastaliklar.hastalikAdi, hastaliklar.hastalikAciklama
            FROM iliski_hb
            JOIN hastaliklar ON hastaliklar.hastalikID = iliski_hb.hastalikID
            WHERE iliski_hb.belirtiID = $belirtiID
            ;")->fetchAll(PDO::FETCH_ASSOC);//Hastalik listesini çeken sql kodu
            foreach ($query as $row) {
              $hastalikID[0][$k] = $row['hastalikID'];
              $hastalikID[1][$k] = $row['hastalikAdi'];
              $hastalikID[2][$k++] = $row['hastalikAciklama'];
            }
          }
          array_multisort($hastalikID[0], $hastalikID[1], $hastalikID[2]);
          $m = 0;
          for($l = 0 ; $l < count($hastalikID[0]) ; $l++){
            if($hastalikID[0][$l] != $hastalikID[0][$l-1]){
              $hastaliklar[1][$m] = $hastalikID[0][$l];
              $hastaliklar[2][$m] = $hastalikID[1][$l];
              $hastaliklar[3][$m++] = $hastalikID[2][$l];
            }
            $hastaliklar[0][$m-1]++;
          }
          array_multisort($hastaliklar[0], SORT_DESC, SORT_NUMERIC,
                          $hastaliklar[1], $hastaliklar[2], $hastaliklar[3]);

          if(sizeof($hastaliklar[0]) < 5){
            $sayac = sizeof($hastaliklar[0]) ;
          }
          else{
            $sayac = 5;
          }
          if($sayac == 0){
            echo '<div class="alert alert-danger">Belirtiğiniz belirtilere uygun hastalık bulunamamıştır.</div>';
          }
          for($l = 0 ; $l < $sayac ; $l++){
            $hastalik_ID = $hastaliklar[1][$l];

            echo '<div class="alert alert-info"><b><a href="hastalik.php?id='.$hastaliklar[1][$l].'">
            <svg class="bi bi-reply-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M9.079 11.9l4.568-3.281a.719.719 0 000-1.238L9.079 4.1A.716.716 0 008 4.719V6c-1.5 0-6 0-7 8 2.5-4.5 7-4 7-4v1.281c0 .56.606.898 1.079.62z"/>
            </svg>
            ' . $hastaliklar[2][$l] . '</a></b></br>
                        Belirtilerinizden <b>' . $hastaliklar[0][$l] . '</b> tanesi bu hastalık ile eşleşiyor: </br> ';

            $query = $db->query("SELECT belirtiler.belirtiID, belirtiler.belirtiAdi
            FROM iliski_hb
            JOIN belirtiler ON belirtiler.belirtiID = iliski_hb.belirtiID
            WHERE iliski_hb.hastalikID = $hastalik_ID
            ;")->fetchAll(PDO::FETCH_ASSOC);//Poliklinik listesini çeken sql kodu
            $i=0;
            $j=0;
            foreach ($query as $row) {
              foreach($belirti as $deger){
                if($deger == $row['belirtiID']){
                  if($i++>0){ echo ', ';}//İlk satır ise virgül olmasını engelliyor
                  echo $row['belirtiAdi'];
                }
              }
              $hastalikBelirti[$j++] = $row['belirtiAdi'];
            }

            echo '</br> <a class="btn btn-info btn-sm" data-toggle="collapse" href="#collapse'.$l.'" role="button" aria-expanded="false" aria-controls="collapseExample">
                          Bu Hastalığın Diğer Belirtileri
                        </a>
                        <div class="collapse" id="collapse'.$l.'">
                          <div class="card card-body alert-primary">
                            ';
            $i=0;
            foreach($hastalikBelirti as $row){
              if($i++>0){ echo ', ';}//İlk satır ise virgül olmasını engelliyor
                  echo $row;
            }

            echo '        </div>
                        </div>
            </br>' .$hastaliklar[3][$l]. ' </br>
            Gidebileceğiniz poliklinikler: </br> <b>';

            $query = $db->query("SELECT poliklinikler.poliklinikAdi, poliklinikler.poliklinikID
            FROM iliski_ph
            JOIN poliklinikler ON poliklinikler.poliklinikID = iliski_ph.poliklinikID
            WHERE iliski_ph.hastalikID = $hastalik_ID
            ;")->fetchAll(PDO::FETCH_ASSOC);//Poliklinik listesini çeken sql kodu
            foreach ($query as $row) {
              echo '<a href="poliklinik.php?id='.$row["poliklinikID"].'">
              <svg class="bi bi-reply" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9.502 5.013a.144.144 0 00-.202.134V6.3a.5.5 0 01-.5.5c-.667 0-2.013.005-3.3.822-.984.624-1.99 1.76-2.595 3.876C3.925 10.515 5.09 9.982 6.11 9.7a8.741 8.741 0 011.921-.306 7.403 7.403 0 01.798.008h.013l.005.001h.001L8.8 9.9l.05-.498a.5.5 0 01.45.498v1.153c0 .108.11.176.202.134l3.984-2.933a.494.494 0 01.042-.028.147.147 0 000-.252.494.494 0 01-.042-.028L9.502 5.013zM8.3 10.386a7.745 7.745 0 00-1.923.277c-1.326.368-2.896 1.201-3.94 3.08a.5.5 0 01-.933-.305c.464-3.71 1.886-5.662 3.46-6.66 1.245-.79 2.527-.942 3.336-.971v-.66a1.144 1.144 0 011.767-.96l3.994 2.94a1.147 1.147 0 010 1.946l-3.994 2.94a1.144 1.144 0 01-1.767-.96v-.667z" clip-rule="evenodd"/>
              </svg>
              ' .$row['poliklinikAdi']. '</a></br>';
            }
            echo '</b></div>';
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