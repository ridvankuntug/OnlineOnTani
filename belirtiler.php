<?php $deneme = 'Belirti Seç'; require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->
      <div class="font-weight-bold">İpucu: Bu sayfada arama teriminizi kolayca bulabilmek için Ctrl+F veya ⌘-F (Mac) tuşlarına basın ve bulma çubuğunu kullanın. Mobil için seçeneklerden "sayfada bul" seçeneğini kullanın.</div>
      <?php
      $hata = $_GET["hata"];
      $basarili = $_GET["basarili"];//Yetki ve sil düğmesine tıklandığında dönen veriyi değişkene alıyor
      if($hata){
        echo '<div class="alert alert-danger" role="alert">'.$hata.'</div>';
      }
      else if($basarili){
        echo '<div class="alert alert-success" role="alert">'.$basarili.'</div>';
      }
      try{
        $query = $db->query("SELECT * FROM belirtiler
        ")->fetchAll(PDO::FETCH_ASSOC);//Belirti listesini çeken sql kodu
        $i=0;//Sayaç için değişken
        foreach ($query as $row) {
          $i++;
          $belirtiler[$i][0] = $row["belirtiID"];
          $belirtiler[$i][1] = $row["belirtiAdi"];
        }
      }catch(Exception $e) {//hata olursa ekrana yazıyoruz
        echo '<div class="alert alert-success" role="alert"> Bir sorun oluşmuş gibi görünüyor. Anasayfaya dönmek için <a href="index.php">tıklayınız</a>.</div>';
      }

      ?>
      <form action="hastaliginiz.php" method="POST">
        <?php
          $ilkHarf = '0';
          for($i = 1, $j = 1 ; $i < sizeof($belirtiler)+1 ; $i++){
            $ilkHarf = mb_substr($belirtiler[$i][1], 0, 1, 'utf-8');
            if($ilkHarf != mb_substr($belirtiler[$i-1][1], 0, 1, 'utf-8')){
              $j++;
              if($j % 3 == 0){
                echo '</br>
                      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                      <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-format="fluid"
                        data-ad-layout-key="-h0+d+5c-9-3e"
                        data-ad-client="ca-pub-7404800709284830"
                        data-ad-slot="3129486486"></ins>
                      <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                      </script>';
              }
              echo '</br><label class="font-weight-bold">&nbsp&nbsp&nbsp&nbsp '.$ilkHarf.'</label>';
            }
            echo '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck'.$i.'" name="dizi[]" value="'.$belirtiler[$i][0].'">
                    <label class="custom-control-label" for="customCheck'.$i.'"><!--'.$belirtiler[$i][0] . ' -) -->' . ucwords($belirtiler[$i][1]).'</label>
                  </div>';
          }
        ?>
        <input type="submit" class="btn btn-primary float-right" style="position:sticky; bottom:10%" value="Gönder">
      </form>
      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>