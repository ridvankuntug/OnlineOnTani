<?php
  include("funcs/headerphp.php");

  $isim   = $_POST["isim"];
  $eposta = $_POST["eposta"];
  $konu   = $_POST["konu"];
  $icerik = $_POST["icerik"];

  if(!filter_var($eposta, FILTER_VALIDATE_EMAIL)){//E-posta biçimi doğru mu
    echo '<div class="alert alert-danger" role="alert"> E-Posta biçimi yanlış. </div>';
  }
  else if($isim == "" || $eposta == "" || $konu == "" || $icerik == ""){//Boş alan var mı
    echo '<div class="alert alert-danger" role="alert"> Boş bıraktığınız alanlar var. </div>';
  }
  else{
    if($_SESSION["kullaniciID"]){
      $query = $db->prepare("INSERT INTO iletisim SET
        iletisimAd = ?,
        iletisimEPosta = ?,
        iletisimKonu = ?,
        iletisimIcerik = ?,
        kullanıcıID = ?");
      $insert = $query->execute(array(
        $isim, $eposta, $konu, $icerik, $_SESSION["kullaniciID"]
      ));
    }
    else{
      $query = $db->prepare("INSERT INTO iletisim SET
        iletisimAd = ?,
        iletisimEPosta = ?,
        iletisimKonu = ?,
        iletisimIcerik = ?");
      $insert = $query->execute(array(
        $isim, $eposta, $konu, $icerik
      ));//Kaydı yapan sql kodu
    }
    if($insert){//Kayıt başarılı mı
      echo '<div class="alert alert-success" role="alert"> Kayıt alındı, anasayfaya dönmek için <a href="index.php">tıklayınız</a>.</div>';
    }
    else{
      echo '<div class="alert alert-success" role="alert"> Kayıt alınamadı.</div>';
    }
  }

?>