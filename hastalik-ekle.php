<?php $deneme = 'Hastalık Ekle'; require("inc/header.php"); ?>

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
          $query = $db->query("SELECT * FROM hastaliklar
          ")->fetchAll(PDO::FETCH_ASSOC);//Belirti listesini çeken sql kodu
          $i=0;//Sayaç için değişken
          foreach ($query as $row) {
            $i++;
            $hastaliklar[$i][0] = $row["hastalikID"];
            $hastaliklar[$i][1] = $row["hastalikAdi"];
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
            if(counter>20){
              alert("Sadece 20 kutucuk eklenebilir(İletişim menüsünden sistem yöneticisi ile iletişime geçebilirsiniz.");
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
            if(counter==2){
              alert("Kaldırılacak kutucuk kalmadı.");
              return false;
            }else{
            counter--;
            $("#ComboBoxDiv" + counter).remove();
            }
          });

          $("#getButtonValue").click(function () {
            var p = document.getElementById("hastalikID");
              var hastalikID = p.options[p.selectedIndex].value;
            var b1 = document.getElementById("belirtiID1");
              var belirtiID1 = b1.options[b1.selectedIndex].value;
            var b2,b3,b4,b5,b6,b7,b8,b9,b10,b11,b12,b13,b14,b15,b16,b17,b18,b19,b20;
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
            if(b11 = document.getElementById("belirtiID11")){
              var belirtiID11 = b11.options[b11.selectedIndex].value;
            }
            if(b12 = document.getElementById("belirtiID12")){
              var belirtiID12 = b12.options[b12.selectedIndex].value;
            }
            if(b13 = document.getElementById("belirtiID13")){
              var belirtiID13 = b13.options[b13.selectedIndex].value;
            }
            if(b14 = document.getElementById("belirtiID14")){
              var belirtiID14 = b14.options[b14.selectedIndex].value;
            }
            if(b15 = document.getElementById("belirtiID15")){
              var belirtiID15 = b15.options[b15.selectedIndex].value;
            }
            if(b16 = document.getElementById("belirtiID16")){
              var belirtiID16 = b16.options[b16.selectedIndex].value;
            }
            if(b17 = document.getElementById("belirtiID17")){
              var belirtiID17 = b17.options[b17.selectedIndex].value;
            }
            if(b18 = document.getElementById("belirtiID18")){
              var belirtiID18 = b18.options[b18.selectedIndex].value;
            }
            if(b19 = document.getElementById("belirtiID19")){
              var belirtiID19 = b19.options[b19.selectedIndex].value;
            }
            if(b20 = document.getElementById("belirtiID20")){
              var belirtiID20 = b20.options[b20.selectedIndex].value;
            }

            $.post('hastalik-ekle-kontrol.php', {hastalikID: hastalikID, belirtiID1: belirtiID1, belirtiID2: belirtiID2, belirtiID3: belirtiID3, belirtiID4: belirtiID4, belirtiID5: belirtiID5, belirtiID6: belirtiID6, belirtiID7: belirtiID7, belirtiID8: belirtiID8, belirtiID9: belirtiID9, belirtiID10: belirtiID10, belirtiID11: belirtiID11, belirtiID12: belirtiID12, belirtiID13: belirtiID13, belirtiID14: belirtiID14, belirtiID15: belirtiID15, belirtiID16: belirtiID16, belirtiID17: belirtiID17, belirtiID18: belirtiID18, belirtiID19: belirtiID19, belirtiID20: belirtiID20 }, function (gelen_cevap) {
              $('#sonucForm').html(gelen_cevap);
            });
          });
        });
      </script>
      <form>
        <div class="form-group">
          <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Hastalıklar</label>
          <select class="form-control form-control-sm" id='hastalikID' name="hastalikID">
            <option selected>Seç...</option>
            <?php
            for($i = 1 ; $i < sizeof($hastaliklar)+1 ; $i++){
              echo '<option value="'.$hastaliklar[$i][0].'"> './*$i.
                '- '.*/$hastaliklar[$i][1].
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
          &nbsp;&nbsp;
          <input class="btn btn-primary btn-sm" type='button' value='Belirti Ekle' id='addButton'>
          <input class="btn btn-primary btn-sm" type='button' value=' Alanı Sil ' id='removeButton'>
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