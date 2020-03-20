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
        }catch(Exception $e) {//hata olursa ekrana yazıyoruz
          echo '<div class="alert alert-success" role="alert"> Bir sorun oluşmuş gibi görünüyor. Anasayfaya dönmek için <a href="index.php">tıklayınız</a>.</div>';
        }
      ?>

      <script type="text/javascript">

        $(document).ready(function(){
          var counter = 2;

          var phpPage;
          $.get("belirti-cek.php", function( my_var ) {
              phpPage = my_var;
          });

          $("#addButton").click(function () {
            if(counter>10){
              alert("Only 10 comboboxes allow");
              return false;
            }

            var newComboBoxDiv = $(document.createElement('div')).attr("id", 'ComboBoxDiv' + counter);

            newComboBoxDiv.after().html('<select class="form-control form-control-sm" name="belirtiID' + counter +
              '" id="belirtiID' + counter + '"><option selected>Seç...</option>'+
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

          $("#getButtonValue").click(function () {
            var hastalikAdi = $("#hastalikAdi").val();
            var p = document.getElementById("poliklinikID");
              var poliklinikID = p.options[p.selectedIndex].value;
            var b1 = document.getElementById("belirtiID1");
              var belirtiID1 = b1.options[b1.selectedIndex].value;
            var b2,b3,b4,b5,b6,b7,b8,b9,b10;
            if(b2 = document.getElementById("belirtiID2")){
              var belirtiID2 = b2.options[b2.selectedIndex].value;
            }
            if(b3 = document.getElementById("belirtiID3")){
              var belirtiID3 = b3.options[b3.selectedIndex].value;
            }
            if(b4 = document.getElementById("belirtiID4")){
              var belirtiID4 = b4.options[b4.selectedIndex].value;
            }
            if(b5 = document.getElementById("belirtiID5")){
              var belirtiID5 = b5.options[b5.selectedIndex].value;
            }
            if(b6 = document.getElementById("belirtiID6")){
              var belirtiID6 = b6.options[b6.selectedIndex].value;
            }
            if(b7 = document.getElementById("belirtiID7")){
              var belirtiID7 = b7.options[b7.selectedIndex].value;
            }
            if(b8 = document.getElementById("belirtiID8")){
              var belirtiID8 = b8.options[b8.selectedIndex].value;
            }
            if(b9 = document.getElementById("belirtiID9")){
              var belirtiID9 = b9.options[b9.selectedIndex].value;
            }
            if(b10 = document.getElementById("belirtiID10")){
              var belirtiID10 = b10.options[b10.selectedIndex].value;
            }

            var kaynakAdi = $("#kaynakAdi").val();

            $.post('hastalik-ekle-kontrol.php', {hastalikAdi: hastalikAdi, poliklinikID: poliklinikID, belirtiID1: belirtiID1, belirtiID2: belirtiID2, belirtiID3: belirtiID3, belirtiID4: belirtiID4, belirtiID5: belirtiID5, belirtiID6: belirtiID6, belirtiID7: belirtiID7, belirtiID8: belirtiID8, belirtiID9: belirtiID9, belirtiID10: belirtiID10, kaynakAdi: kaynakAdi }, function (gelen_cevap) {
              $('#sonucForm').html(gelen_cevap);
            });
          });
        });
      </script>
      <form>
        <div class="form-group">
          <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Hastalık</label>
          <input type="text" class="form-control form-control-sm" id="hastalikAdi" name="hastalikAdi" placeholder="Hastalık Adı">
        </div>
        <div class="form-group">
          <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Poliklinikler</label>
          <select class="form-control form-control-sm" id='poliklinikID' name="poliklinikID">
            <option selected>Seç...</option>
            <?php
            for($i = 1 ; $i < sizeof($poliklinikler)+1 ; $i++){
              echo '<option value="'.$poliklinikler[$i][0].'"> '.$i.
                '- '.$poliklinikler[$i][1].
                '</option>';
            }
            ?>
          </select>
        </div>
        <div class="form-group" id='ComboBoxesGroup'>
          <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Belirtiler</label>
          <select class="form-control form-control-sm" name="belirtiID1" id='belirtiID1'>
            <option selected>Seç...</option>
            <?php
              include("belirti-cek.php");
            ?>
          </select>
        </div>
        <div class="form-group">
          <input class="btn btn-primary btn-sm" type='button' value='Belirti Ekle' id='addButton'>
          <input class="btn btn-primary btn-sm" type='button' value=' Alanı Sil ' id='removeButton'>
        </div>
        <div class="form-group">
          <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kaynak</label>
          <input type="text" class="form-control form-control-sm" id="kaynakAdi" name="kaynakAdi" placeholder="Kaynak Adı(Sonra belrtilecek ise 'Eklenecek' yazın)">
        </div>
        <div class="form-group" id="sonucForm"></div>
        <div class="form-group">
          <input class="btn btn-primary btn-sm float-right" type='button' value=' Gönder ' id='getButtonValue'>
        </div>
      </form>
      <?php } ?>
      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>