<?php
  error_reporting(0);//Basit uyarıları gizliyoruz
  header('Content-type: text/html; charset=utf-8');
  require("funcs/baglanti.php");//baglanti.php sayfasını çağırıyoruz
  session_start();//Session global değişkenini başlatıyoruz
?>