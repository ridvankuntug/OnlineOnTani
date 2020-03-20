<?php
  include("funcs/headerphp.php");

  $hastalikAdi = $_POST["hastalikAdi"];
  $poliklinikID = $_POST["poliklinikID"];
  $belirtiID1 = $_POST["belirtiID1"];
  $belirtiID2 = $_POST["belirtiID2"];
  $belirtiID3 = $_POST["belirtiID3"];
  $belirtiID4 = $_POST["belirtiID4"];
  $belirtiID5 = $_POST["belirtiID5"];
  $belirtiID6 = $_POST["belirtiID6"];
  $belirtiID7 = $_POST["belirtiID7"];
  $belirtiID8 = $_POST["belirtiID8"];
  $belirtiID9 = $_POST["belirtiID9"];
  $belirtiID10 = $_POST["belirtiID10"];
  $kaynakAdi = $_POST["kaynakAdi"];
  if($hastalikAdi == "" || $poliklinikID == "" || $belirtiID1 == "" || $kaynakAdi == ""){//Boş alan var mı
    echo '<div class="alert alert-danger" role="alert"> Boş bıraktığınız alanlar var. </div>';
  }
  else{
    try{
      $kaynak = $db->prepare("INSERT INTO kaynaklar SET
      kaynakAdi = ?");
      $insert_kaynak = $kaynak->execute(array(
        $kaynakAdi
      ));
      $kaynak_id = $db->lastInsertId();

      $hastalik = $db->prepare("INSERT INTO hastaliklar SET
      hastalikAdi = ?,
      poliklinikID = ?,
      kaynakID = ?");
      $insert_hastalik = $hastalik->execute(array(
        $hastalikAdi, $poliklinikID, $kaynak_id
      ));//Kaydı yapan sql kodu
      $hastalik_id = $db->lastInsertId();

      $iliski = $db->prepare("INSERT INTO iliski SET
      hastalikID = ?,
      belirtiID = ?");
      $insert_iliski = $iliski->execute(array(
        $hastalik_id, $belirtiID1
      ));
      if($belirtiID2){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID2
        ));
      }
      if($belirtiID3){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID3
        ));
      }
      if($belirtiID4){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID4
        ));
      }
      if($belirtiID5){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID5
        ));
      }
      if($belirtiID6){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID6
        ));
      }
      if($belirtiID7){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID7
        ));
      }
      if($belirtiID8){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID8
        ));
      }
      if($belirtiID9){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID9
        ));
      }
      if($belirtiID10){
        $insert_iliski = $iliski->execute(array(
          $hastalik_id, $belirtiID10
        ));
      }
      echo '<div class="alert alert-info" role="alert"> Ekleme Başarılı. </div>';
    }
    catch(PDOException $e){
      echo '<div class="alert alert-success" role="alert">' + $e + '</div>';
    }
  }
?>