<!-- Yeni bir sayfa oluşturulacağı zaman her seferinde bu kodlar arasına yazılacak -->
<?php require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->

      <?php
      $hata = $_GET["hata"];
      $basarili = $_GET["basarili"];//Yetki ve sil düğmesine tıklandığında dönen veriyi değişkene alıyor
      if($hata){
        echo '<div class="alert alert-danger" role="alert">'.$hata.'</div>';
      }
      else if($basarili){
        echo '<div class="alert alert-success" role="alert">'.$basarili.'</div>';
      }//Yetki ve sil düğmesine tıklandığında dönen sonucu gösteriyor



      if($_SESSION["kullaniciYetki"] < 4){//Sayfaya sadece admin erişebiliyor
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
      }
      else{
        try{
          $query = $db->query("SELECT * FROM poliklinikler
          ")->fetchAll(PDO::FETCH_ASSOC);//Belirti listesini çeken sql kodu
          $i=0;//Sayaç için değişken
          foreach ($query as $row) {
            $i++;
            $poliklinikler[$i][0] = $row["poliklinikID"];
            $poliklinikler[$i][1] = $row["poliklinikAdi"];
          }

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
      }
      ?>

      <script type="text/javascript">

        $(document).ready(function(){
          var counter = 2;

          var phpPage;
          $.get("belirtiler.php", function( my_var ) {
              phpPage = my_var;
          });

          $("#addButton").click(function () {
            if(counter>10){
              alert("Only 10 comboboxes allow");
              return false;
            }

            var newComboBoxDiv = $(document.createElement('div')).attr("id", 'ComboBoxDiv' + counter);

            newComboBoxDiv.after().html('<select class="custom-select mr-sm-2" name="combobox' + counter +
              '" id="combobox' + counter + '" value="" ><option selected>Seç...</option>'+
              phpPage
              +'</select');

            newComboBoxDiv.appendTo("#ComboBoxesGroup");
            counter++;
          });
          $("#removeButton").click(function () {
            if(counter==1){
              alert("No more combobox to remove");
              return false;
            }
            counter--;
            $("#ComboBoxDiv" + counter).remove();
          });
        });
      </script>
      <form>
        <div class="form-group">
          <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Hastalık</label>
          <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Hastalık Adı">
          <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Poliklinikler</label>
          <select class="custom-select mr-sm-1" name="poliklinikler" id='poliklinikler'>
            <option selected>Seç...</option>
            <?php
            for($i = 1 ; $i < sizeof($poliklinikler)+1 ; $i++){
              echo '<option value="'.$i.'"> '.$i.
                '- '.$poliklinikler[$i][1].
                '</option>';
            }
            ?>
          </select>

          <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Belirtiler</label>
          <div id='ComboBoxesGroup'>
            <select class="custom-select mr-sm-1" name="combobox1" id='combobox1'>
              <option selected>Seç...</option>
              <?php
              for($i = 1 ; $i < sizeof($belirtiler)+1 ; $i++){
                echo '<option value="'.$i.'"> '.$i.
                  '- '.$belirtiler[$i][1].
                  '</option>';
              }
              ?>
            </select>
          </div>
          <input class="btn btn-primary" type='button' value='Belirti Ekle' id='addButton'>
          <input class="btn btn-primary" type='button' value='Alanı Sil' id='removeButton'>
        </div>
        <input class="btn btn-primary" type='button' value='Gönder' id='getButtonValue'>
      </form>
      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>