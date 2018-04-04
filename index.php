<?php

@session_start();
include("header.php");
?>

    <!---- MAIN PAGE SECTION ---->
    <section class="section__main">
      <!--first row-->
      <div class="container">
        <div class="row">
          <!--Naslov Usluge-->
          <h2 class="mainpage__heading">Usluge</h2>
        </div>
      </div>
      <!--first three icons/h3-->
      <div class="container">
        <div class="row">
          <div class="one-third column">
            <i class="fas fa-print fa-2x"></i>
            <a href="./stampanje" class="link">
              <h3>Štampanje</h3>
            </a>
          </div>

          <div class="one-third column">
            <i class="far fa-clone fa-2x"></i>
            <a href="./blokovi" class="link">
              <h3>Preslikavajući blokovi</h3>
            </a>
          </div>

          <div class="one-third column">
            <i class="far fa-file-alt fa-2x"></i>
            <a href="uplatnice/" class="link">
              <h3>Uplatnice</h3>
            </a>
          </div>
          <!--end of last column-->
        </div>
      </div>
      <!--end of container-->

      <!--second three icons/h3-->
      <div class="container">
        <!--second row-->
        <div class="row">
          <div class="one-third column">
            <i class="far fa-envelope fa-2x"></i>
            <a href="./koverte-dostavnice-formulari" class="link">
              <h3>Koverte, Dostavnice, Formulari za adresiranje</h3>
            </a>
          </div>

          <div class="one-third column">
            <i class="fas fa-file-alt fa-2x"></i>
            <a href="./omot-spisa" class="link">
              <h3>Omot spisa</h3>
            </a>
          </div>
        </div>
        <!--end of row-->
      </div>
      <!--end of container-->
    </section>

    <!----SECTION OSTALO-->
    <section class="section__main section__ostalo">
      <div class="container">
        <h2 class="mainpage__heading">Ostalo</h2>
        <!--second row-->
        <div class="row">
          <div class="one-third column">
            <i class="far fa-money-bill-alt fa-2x"></i>
            <a href="./cenovnik" class="link">
              <h3>Cenovnik</h3>
            </a>
          </div>

          <div class="one-third column">
            <i class="fas fa-users fa-2x"></i>
            <a href="./o-nama" class="link">
              <h3>O nama</h3>
            </a>
          </div>

          <div class="one-third column">
            <i class="far fa-comment fa-2x"></i>
            <a href="./kontakt" class="link">
              <h3>Kontakt</h3>
            </a>
          </div>
        </div>
        <!--end of row-->
      </div>
      <!--end of container-->
    </section>

<?php
include("footer.php");
?>
