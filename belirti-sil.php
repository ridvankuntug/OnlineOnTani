<?php require("funcs/headerphp.php");
$sil = $_GET["sil"];//belirti-listesi.php sayfasından gelen veriler

if($_SESSION["kullaniciYetki"] < 4){//İşlemi sadece admin yaptı ise gerçekleşiyor
  echo '<meta http-equiv="refresh" content="0;URL=index.php">';
}
else if($sil > 1){//Silme işlemi mi yapılacağını kontrol ediyor
  try{
    $query = $db->prepare("DELETE FROM belirtiler WHERE
    belirtiID = ?");
    $delete = $query->execute(array(
      $sil
    ));//Sil değişkeni içerisinde gelen IDli kişiyi siliyor

    if($delete){//İşlem başarılı mı diye kontrol ediyor
      echo '<meta http-equiv="refresh" content="0;URL=belirti-listesi.php?basarili=Silindi.">';
    }
    else{
      echo '<meta http-equiv="refresh" content="0;URL=belirti-listesi.php?hata=Bir%20Sorun%20Oluştu.">';
    }
  }catch(Exception $e) {
    echo '<meta http-equiv="refresh" content="0;URL=belirti-listesi.php?hata=Bir%20Sorun%20Oluştu.">';
  }
}
else{
  echo '<meta http-equiv="refresh" content="0;URL=belirti-listesi.php?hata=Yanlış%20Id.">';
}
?>