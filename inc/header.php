<?php require("funcs/headerphp.php"); ?><!--Daha önceden yazdığımız php fonksiyonlarını sayfaya dahil ediyoruz-->
<!DOCTYPE html>
<html lang="tr">
<head>
  <title>Online Ön Tanı <?php echo $deneme; ?></title>

  <link rel="icon" href="img/ico.png">

  <meta charset="utf-8">
  <meta name="description" content="Hangi polikliniğe gitmeniz gerektiğine yardımcı olalım.">
  <meta name="keywords" content="Online Ön Tanı, Çevrim İçi Teşhis, Ön Tanı, Ön Teşhis, Çevrimiçi Teşhis, Çevrim içi tanı, Tıp, Online, Çevrimiçi, Ön, Yeni, Tanı, Teşhis, Hasta, Hastalık, Sağlık, Doktor, Hekim, Muayene, Tarama, Check-up, Hangi, Poliklinik, Bölüm, Uzman, İleri, Teknik">
  <meta name="author" content="Rıdvan Küntuğ">
  <meta name="viewport" content="width=device-width, initial-scale=1"><!--Tarayıcı uyumluluğu için-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"><!--Bootstrap için gerekli dosya yollarını gösteriyoruz-->
  <script src="bootstrap/jquery.min.js"></script><!--Bootstrap için gerekli dosya yollarını gösteriyoruz-->
  <script src="bootstrap/popper.min.js"></script><!--Bootstrap için gerekli dosya yollarını gösteriyoruz-->
  <script src="bootstrap/js/bootstrap.min.js"></script><!--Bootstrap için gerekli dosya yollarını gösteriyoruz-->
  <link rel="stylesheet" href="inc/strings.css">

  <script data-ad-client="ca-pub-7404800709284830" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!--AdSense-->
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
    <a class="navbar-brand" href="index.php">
      <span id="ph-baslik"></span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php require("inc/links.php"); ?><!--Menü içeriğimiz links.php sayfasından geliyor-->
        <li class="nav-item active">
          <script async src='https://cse.google.com/cse.js?cx=5f92abb95bf0f2d0c'></script><div class="gcse-searchbox-only"></div>
        </li>
      </ul>
      </form>
      <form class="form-inline my-2 my-lg-0" id="sonucCikis">
        <ul class="navbar-nav mr-auto">
          <?php if($_SESSION["kullaniciYetki"] == 5){ ?><!--Kullıcılar sayfasını sadece admin görüntüleyebilir-->
              <li class="nav-item active">
                <a class="nav-link" href="kullanici-yetkileri.php">Kullanıcılar</a>
              </li>
          <?php }
              if(!$_SESSION["kullaniciYetki"] == null){ ?><!--Ziyaretçinin oturum açıp açmadığına göre kullanıcı adı ve çıkış butonu gösteriliyor-->
              <li class="nav-item active">
                <a class="nav-link" href="#"> <?php echo $_SESSION["kullaniciAdi"]; ?> </a>
              </li>
          <input type="button" class="btn btn-primary" onclick="cikis()" value="Çıkış"><!--cikis.php sayfasına yönlenecek olan Jquery "cikis()" fonksiyonunu çağırıyor-->
        <?php }
        else{ ?><!--Oturum açılmadı ise Giriş ve Üye ol sayfalarını gösteriyor-->
          <input type="button" class="btn btn-primary" onclick="window.location='giris.php';" value="Giriş">
          <li class="nav-link"></li>
          <input type="button" class="btn btn-primary" onclick="window.location='uye-ol.php';" value="Üye Ol">
        <?php } ?>
      </ul>

    </div>
  </nav>
  <div class="jumbotron text-center" style="margin-top:55px; padding:0.01%">
    <!--<h3><span id="ph-baslik"></span></h3>
    <h5><span id="ph-altbaslik"></span></h5>-->
  </div><!--Navbarın altındaki site bilgileri bölümü-->