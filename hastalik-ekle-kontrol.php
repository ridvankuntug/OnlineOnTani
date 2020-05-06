<?php
  include("funcs/headerphp.php");

  $hastalikID       = $_POST["hastalikID"];
  $belirtiID1       = $_POST["belirtiID1"];
  $belirtiID2       = $_POST["belirtiID2"];
  $belirtiID3       = $_POST["belirtiID3"];
  $belirtiID4       = $_POST["belirtiID4"];
  $belirtiID5       = $_POST["belirtiID5"];
  $belirtiID6       = $_POST["belirtiID6"];
  $belirtiID7       = $_POST["belirtiID7"];
  $belirtiID8       = $_POST["belirtiID8"];
  $belirtiID9       = $_POST["belirtiID9"];
  $belirtiID10      = $_POST["belirtiID10"];
  $belirtiID11      = $_POST["belirtiID11"];
  $belirtiID12      = $_POST["belirtiID12"];
  $belirtiID13      = $_POST["belirtiID13"];
  $belirtiID14      = $_POST["belirtiID14"];
  $belirtiID15      = $_POST["belirtiID15"];
  $belirtiID16      = $_POST["belirtiID16"];
  $belirtiID17      = $_POST["belirtiID17"];
  $belirtiID18      = $_POST["belirtiID18"];
  $belirtiID19      = $_POST["belirtiID19"];
  $belirtiID20      = $_POST["belirtiID20"];

  if($_SESSION["kullaniciYetki"] < 4){//Sayfaya sadece admin erişebiliyor
    echo '<div class="alert alert-danger" role="alert"> Yetkiniz yok. Yönetici ile iletişime geçiniz. </div>';
  }
  else if($hastalikID == "" || $belirtiID1 == ""){//Boş alan var mı
    echo '<div class="alert alert-danger" role="alert"> Boş bıraktığınız alanlar var. </div>';
  }
  else{
    try{
      $iliski_hb = $db->prepare("INSERT INTO iliski_hb SET
      hastalikID = ?,
      belirtiID = ?");
      $insert_iliski_hb = $iliski_hb->execute(array(
        $hastalikID, $belirtiID1
      ));
      echo '<div class="alert alert-info" role="alert"> Belirti 1: '.$belirtiID1.' </div>';
      if($iliski_hb){
        if($belirtiID2){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID2
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 2: '.$belirtiID2.' </div>';
        }
        if($belirtiID3){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID3
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 3: '.$belirtiID3.' </div>';
        }
        if($belirtiID4){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID4
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 4: '.$belirtiID4.' </div>';
        }
        if($belirtiID5){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID5
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 5: '.$belirtiID5.' </div>';
        }
        if($belirtiID6){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID6
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 6: '.$belirtiID6.' </div>';
        }
        if($belirtiID7){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID7
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 7: '.$belirtiID7.' </div>';
        }
        if($belirtiID8){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID8
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 8: '.$belirtiID8.' </div>';
        }
        if($belirtiID9){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID9
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 9: '.$belirtiID9.' </div>';
        }
        if($belirtiID10){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID10
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 10: '.$belirtiID10.' </div>';
        }
        if($belirtiID11){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID11
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 11: '.$belirtiID11.' </div>';
        }
        if($belirtiID12){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID12
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 12: '.$belirtiID12.' </div>';
        }
        if($belirtiID13){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID13
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 13: '.$belirtiID13.' </div>';
        }
        if($belirtiID14){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID14
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 14: '.$belirtiID14.' </div>';
        }
        if($belirtiID15){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID15
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 15: '.$belirtiID15.' </div>';
        }
        if($belirtiID16){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID16
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 16: '.$belirtiID16.' </div>';
        }
        if($belirtiID17){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID17
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 17: '.$belirtiID17.' </div>';
        }
        if($belirtiID18){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID18
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 18: '.$belirtiID18.' </div>';
        }
        if($belirtiID19){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID19
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 19: '.$belirtiID19.' </div>';
        }
        if($belirtiID20){
          $insert_iliski_hb = $iliski_hb->execute(array(
            $hastalikID, $belirtiID20
          ));
          echo '<div class="alert alert-info" role="alert"> Belirti 20: '.$belirtiID20.' </div>';
        }
      }
      echo '<div class="alert alert-info" role="alert"> Ekleme Başarılı. </div>';
    }
    catch(PDOException $e){
      echo '<div class="alert alert-success" role="alert">' + $e + '</div>';
    }
  }
?>