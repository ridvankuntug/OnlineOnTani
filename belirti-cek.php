<?php require("funcs/headerphp.php"); ?>
<?php
  if($_SESSION["kullaniciYetki"] < 4){//Sayfaya sadece admin erişebiliyor
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
  }
  else{
    try{
      $query = $db->query("SELECT * FROM belirtiler
      ")->fetchAll(PDO::FETCH_ASSOC);//Belirti listesini çeken sql kodu
      $i=0;//Sayaç için değişken
      foreach ($query as $row) {
        $i++;
        $belirtiler[$i][0] = $row["belirtiID"];
        $belirtiler[$i][1] = $row["belirtiAdi"];
      }

      for($i = 1 ; $i < sizeof($belirtiler)+1 ; $i++){
        echo '<option value="'.$belirtiler[$i][0].'">'.$i.
          '-'.$belirtiler[$i][1].
          '</option>';
      }
    }catch(Exception $e) {//hata olursa ekrana yazıyoruz
      echo '<div class="alert alert-success" role="alert"> Bir sorun oluşmuş gibi görünüyor. Anasayfaya dönmek için <a href="index.php">tıklayınız</a>.</div>';
    }
  }
?>