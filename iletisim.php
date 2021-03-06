<!-- Yeni bir sayfa oluşturulacağı zaman her seferinde bu kodlar arasına yazılacak -->
<?php $deneme = 'İletişim'; require("inc/header.php"); ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-9">
      <!-- Site İçeriği Başlangıcı -->
      <div class="row">
        <div class="col-sm-6">

      <script type="text/javascript">
        function ilet(){

          var isim = $("#isim").val();
          var eposta = $("#eposta").val();
          var konu = $("#konu").val();
          var icerik = $("#icerik").val();

          $.post('ilet.php', {isim: isim, eposta: eposta, konu: konu, icerik: icerik}, function (gelen_cevap) {
              success:$('#sonucForm').html(gelen_cevap);
          });
        }
      </script><!-- Kullanıcı bilgilerini uye-ol-kontrol.php sayfasına gönderen Jquery kodu -->
      <h2>İletişim:</h2>
      <form>
        <div class="form-group">
          <label for="isim">Ad Soyad</label>
          <input type="text" class="form-control"  id="isim" name="isim" placeholder="Tam Adınız" <?php if($_SESSION["kullaniciAdi"]){ echo 'value="' . $_SESSION["kullaniciAdi"] . '" readonly'; } ?> required>
        </div>
        <div class="form-group">
          <label for="eposta">E-Posta</label>
          <input type="email" class="form-control" id="eposta" name="eposta" aria-describedby="emailHelp" placeholder="E-Postanız" <?php if($_SESSION["kullaniciEPosta"]){ echo 'value="' . $_SESSION["kullaniciEPosta"] . '" readonly'; } ?> required>
          <small id="emailHelp" class="form-text text-muted">Size ulaşmamız için gerekli.</small>
        </div>
        <div class="form-group">
          <label for="konu">Konu</label>
          <input type="text" class="form-control" id="konu" name="konu" placeholder="Konu" required>
        </div>
        <div class="form-group">
          <label for="icerik">İçerik</label>
          <textarea type="text" class="form-control" id="icerik" name="icerik" placeholder="İçerik" required></textarea>
        </div>
        <div class="form-group" id="sonucForm"></div>
        <div class="form-group">
          <input type="button" class="btn btn-primary" onclick="ilet()" value="İlet">
        </div>
      </form><!-- Üye bilgileri formu -->
        </div>
      </div>
      <!-- Site içeriği Sonu -->
    </div>
    <?php require("inc/right-menu.php"); ?>
  </div>
</div>

<?php require("inc/footer.php"); ?>