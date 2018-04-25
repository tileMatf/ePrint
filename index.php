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
            <a href="./stampanje" class="link">
				<i class="fas fa-print fa-2x"></i>
				<h3>Štampanje</h3>
            </a>
          </div>

          <div class="one-third column">
            <a href="./blokovi" class="link">
				<i class="far fa-clone fa-2x"></i>
				<h3>Preslikavajući blokovi</h3>
            </a>
          </div>

          <div class="one-third column">
            <a href="uplatnice/" class="link">
              <i class="far fa-file-alt fa-2x"></i>
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
            <a href="./koverte-dostavnice-formulari" class="link">
		      <i class="far fa-envelope fa-2x"></i>
              <h3>Koverte, Dostavnice, Formulari za adresiranje</h3>
            </a>
          </div>

          <div class="one-third column">
            <a href="./omot-spisa" class="link">
              <i class="fas fa-file-alt fa-2x"></i>
              <h3>Omot spisa</h3>
            </a>
          </div>
		  		  
		  <div class="one-third column" <?php if(!isset($_SESSION['user_info'])) echo 'title="Opcija samo za registrovane korisnike"';?>>
            <a <?php if(isset($_SESSION['user_info'])) echo 'href="./narudzbine/"'?> class="link<?php if(!isset($_SESSION['user_info'])) echo ' disabled-links'?>">
              <i class="fas fa-list-ol fa-2x"></i>
              <h3>Sačuvane narudžbine</h3>
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
            <a href="./cenovnik" class="link">
			  <i class="far fa-money-bill-alt fa-2x"></i>
              <h3>Cenovnik</h3>
            </a>
          </div>

          <div class="one-third column">            
            <a href="./o-nama" class="link">
			  <i class="fas fa-users fa-2x"></i>
              <h3>O nama</h3>
            </a>
          </div>

          <div class="one-third column">            
            <a href="./kontakt" class="link">
			  <i class="far fa-comment fa-2x"></i>
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
