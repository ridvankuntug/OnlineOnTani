<?php require("funcs/headerphp.php"); ?><!--Daha önceden yazdığımız php fonksiyonlarını sayfaya dahil ediyoruz-->
<!DOCTYPE html>
<html lang="tr">
<head>
  <title>Online Ön Tanı</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"><!--Tarayıcı uyumluluğu için-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"><!--Bootstrap için gerekli dosya yollarını gösteriyoruz-->
  <script src="bootstrap/jquery.min.js"></script><!--Bootstrap için gerekli dosya yollarını gösteriyoruz-->
  <script src="bootstrap/popper.min.js"></script><!--Bootstrap için gerekli dosya yollarını gösteriyoruz-->
  <script src="bootstrap/js/bootstrap.min.js"></script><!--Bootstrap için gerekli dosya yollarını gösteriyoruz-->
  <link rel="stylesheet" href="inc/strings.css">
</head>
<body>
  <script type="text/javascript">
    function cikis(){
      $.post('cikis.php', {}, function (gelen_cevap) {
          success:$('#sonucCikis').html(gelen_cevap);
      });
    }
  </script><!--Arkaplanda başka sayfadaki php kodları ile iletişim kurup çıkış işlemini yapacak ve sonucu döndürecek Jquery kodumuz-->
  <nav class="navbar navbar-expand-sm navbar-dark bg-info fixed-top"><!--Bootstrap Navigasyon menümüzün başlangıcı-->
    <a class="navbar-brand" href="#"><span id="ph-baslik"></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php require("inc/links.php"); ?><!--Menü içeriğimiz links.php sayfasından geliyor-->
      </ul>
      <form class="form-inline my-2 my-lg-0" id="sonucCikis">
          <?php if($_SESSION["kullaniciYetki"] == 5){ ?><!--Kullıcılar sayfasını sadece admin görüntüleyebilir-->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="kullanici-yetkileri.php">Kullanıcılar</a>
              </li>
          <?php } ?>
        <?php if($_SESSION["kullaniciYetki"] > 0){ ?><!--Ziyaretçinin oturum açıp açmadığına göre kullanıcı adı ve çıkış butonu gösteriliyor-->
              <li class="nav-item active">
                <a class="nav-link" href="#"> <?php echo $_SESSION["kullaniciAdi"]; ?> </a>
              </li>
            </ul>
          <input type="button" class="btn btn-primary" onclick="cikis()" value="Çıkış"><!--cikis.php sayfasına yönlenecek olan Jquery "cikis()" fonksiyonunu çağırıyor-->
        <?php }
        else{ ?><!--Oturum açılmadı ise Giriş ve Üye ol sayfalarını gösteriyor-->
          <input type="button" class="btn btn-primary" onclick="window.location='giris.php';" value="Giriş">
          <li class="nav-link"></li>
          <input type="button" class="btn btn-primary" onclick="window.location='uye-ol.php';" value="Üye Ol">
        <?php } ?>
      </form>
    </div>
  </nav>

  <div class="jumbotron text-center" style="margin-bottom:0; margin-top:55px; padding:1rem"><!--Navbarın altındaki site bilgileri bölümü-->
    <h2><span id="ph-baslik"></span></h2>
    <h4><span id="ph-altbaslik"></span></h4>
  </div>