    <style>
      @media screen and (min-width: 576px) {
          .myRightSideBar {
            height: 85vh;
            overflow: auto;
            position: sticky;
            top: 15%
          }
      }
    </style>

    <div class="col-sm-3"><!--Sayfanın ne kadarını kaplayacağını belirliyoruz-->
      <div class="myRightSideBar">
        <h3>Hakkımızda</h3>
        <p><span id="ph-baslik"></span></p>
        <p><span id="ph-icerik1"></span></p>
        <p><span id="ph-icerik2"></span></p>
        <h3><span id="ph-menu"></span></h3>
        <ul class="nav nav-pills flex-column">
          <?php require("inc/links.php"); ?><!--Menü içeriğimiz links.php sayfasından geliyor-->
        </ul>
        <hr class="d-sm-none">
      </div>
    </div>