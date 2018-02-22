<!DOCTYPE html>
<html class="no-js" lang="sr">

<head>
  <meta charset="UTF-8">
  <title>ePrint</title>
  <!--Meta tags-->
  <meta name="description" content="Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!--Font from Google-->
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600&amp;subset=latin-ext" rel="stylesheet" type="text/css">
  <!--CSS files-->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/skeleton.css">
  <link rel="stylesheet" href="../css/style.css">
  <!--Favicon-->
  <link rel="icon" type="image/png" href="../images/favicon.png">
  <link rel="apple-touch-icon" href="../images/icon.png">
  <!--FA icons-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
	include("../connection.php");
	
	$db = new DB();
	
?>

<body>
  <div class="container container__main shadow">
    <!--HEADER-->
    <header>
      <div class="row">
        <div class="six columns">
          <a href="../">
            <img class="logo" src="../images/eprint1.png" />
          </a>
        </div>
        <!--NAVIGATION-->
        <div class="six columns navigation__header">
          <div class="navigation__header--nav">
            <ul class="nav">
              <li>
                <a href="#">Registruj se
                  <i class="fa fa-user-plus" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#">Uloguj se
                  <i class="fa fa-user" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!--end of second one-half column-->
      </div>
      <!--end of row-->
    </header>

    <!-- Navigation -->
    <div class="twelve columns">
      <ul class="nav1">
        <li>
          <a class="tile" href="../">
            <i class="fa fa-home" aria-hidden="true"></i>Pocetna</a>
        </li>
        <span class="line">/</span>
        <li>
          <a class="tile" href="./">Stampanje</a>
        </li>
      </ul>
    </div>
    <!-- End of navigation -->

    <!--Stampanje section-->
    <section class="section__stampanje">
      <div class="container">
        <h2 class="section__heading">Stampanje</h2>
      </div>

      <!-- OVDE POCINJE FORMA ZA ***STAMPANJE*** -->
      <form method="POST" action="upload.php" enctype="multipart/form-data">
        <div class="form-box">
          <!--UPLOAD dugme-->
      <!--<input class="button-primary" type="submit" value="Upload">-->
            <label>Okacite vase fajlove</label>
		        <input type='file' name='fileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>		
            <div class="row">

            <!-- BROJ PRIMERAKA ***************************** -->
            <label for="noInput">Broj primeraka</label>
            <input name="noInput" type="number" value="1" class="u-full-width" required>
            <!-- Redosled primeraka -->
            <label for="orderOfInput">
              <input type="radio" name="orderOfInput" value="1,2,3; 1,2,3; 1,2,3" checked />
              <span>1,2,3; 1,2,3; 1,2,3</span>
            <label for="orderOfInput">
              <input type="radio" name="orderOfInput" value="1,1,1; 2,2,2; 3,3,3" />
              <span>1,1,1; 2,2,2; 3,3,3</span>
            </label>
            <!-- ***************************** -->

            <!-- BOJA ***************************** -->
            <label>Boja</label>
            <label for="colorOfInput">
              <input type="radio" name="colorOfInput" value="Crno-belo" checked />
              <span>Crno belo</span>
            </label>
            <label for="colorOfInput">
              <input type="radio" name="colorOfInput" value="U boji" />
              <span>U boji</span>
            </label>
            <!-- ***************************** -->

            <!-- JEDNOSTRANO/DVOSTRANO  ***************************** -->
            <label>Jednostrano / Dvostrano</label>
            <label for="typeOfPrint">
              <input type="radio" name="typeOfPrint" value="Jednostrano" checked />
              <span>Jednostrano</span>
            </label>
            <label for="typeOfPrint">
              <input type="radio" name="typeOfPrint" value="Dvostrano" />
              <span>Dvostrano</span>
            </label>
            <!-- ***************************** -->

            <!-- VELICINA PAPIRA -->
            <label>Velicina papira</label>
            <label for="paperSize">
              <input type="radio" name="paperSize" value="A4" checked />
              <span>A4</span>
            </label>
            <label for="paperSize">
              <input type="radio" name="paperSize" value="A3" />
              <span>A3</span>
            </label>
            <!-- ***************************** -->

            <!-- DEBILJINA PAPIRA -->
            <label>Debljina papira</label>
            <label for="paperWidth">
              <input type="radio" name="paperWidth" value="80gr/m2" checked />
              <span>80 gr/m<sup>2</sup></span>
            </label>
            <label for="paperWidth">
              <input type="radio" name="paperWidth" value="100gr/m2" />
              <span>100 gr/m<sup>2</sup></span>
            </label>
            <!-- ***************************** -->


            <!-- KORICENJE -->
            <label>Koricenje</label>
            <label for="bindingType">
              <input type="radio" name="bindingType" value="Plasticnom spiralom" checked />
              <span>Plasticnom spiralom</span>
            </label>
            <label for="bindingType">
              <input type="radio" name="bindingType" value="Zicanom spiralom" />
              <span>Zicanom spiralom</span>
            </label>
            <label for="bindingType">
              <input type="radio" name="bindingType" value="Tvrdo koricenje" />
              <span>Tvrdo koricenje</span>
            </label>
            <!-- Upload korice dugme -->
            <!--<input class="button-primary" type="submit" value="Upload korice">-->
            <label>Okacite koricu</label>
			      <input type='file' name='bindingFileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf'>
            <!-- ***************************** -->

            <!-- HEFTANJE -->
            <label for="">Heftanje</label>
            <label for="heftingType">
              <input type="radio" name="heftingType" value="Gore levo" checked />
              <span>Gore levo</span>
            </label>
            <label for="heftingType">
              <input type="radio" name="heftingType" value="Gore desno" />
              <span>Gore desno</span>
            </label>
            <label for="heftingType">
              <input type="radio" name="heftingType" value="Dole levo" />
              <span>Dole levo</span>
            </label>
            <label for="heftingType">
              <input type="radio" name="heftingType" value="Dole desno" />
              <span>Dole desno</span>
            </label>
            <label for="heftingType">
              <input type="radio" name="heftingType" value="Po sredini levo" />
              <span>Po sredini levo</span>
            </label>
            <label for="heftingType">
              <input type="radio" name="heftingType" value="Po sredini desno" />
              <span>Po sredini desno</span>
            </label>
            <label for="heftingType">
              <input type="radio" name="heftingType" value="Po sredini gore" />
              <span>Po sredini gore</span>
            </label>
            <label for="heftingType">
              <input type="radio" name="heftingType" value="Po sredini dole" />
              <span>Po sredini dole</span>
            </label>
            <!-- ***************************** -->

            <!-- BUSENJE -->
            <label>Busenje</label>
            <label for="drillingType">
              <input type="radio" name="drillingType" value="Dve rupe za registrator levo" checked />
              <span>Dve rupe za registrator levo</span>
            </label>
            <label for="drillingType">
              <input type="radio" name="drillingType" value="Dve rupe za registrator desno" />
              <span>Dve rupe za registrator desno</span>
            </label>
            <label for="drillingType">
              <input type="radio" name="drillingType" value="Dve rupe za registrator gore" />
              <span>Dve rupe za registrator gore</span>
            </label>
            <label for="drillingType">
              <input type="radio" name="drillingType" value="Dve rupe za registrator dole" />
              <span>Dve rupe za registrator dole</span>
            </label>
            <!-- ***************************** -->

            <!-- Krajnja poruka -->
            <label for="message">Poruka</label>
            <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"></textarea>
            <label class="sendCopy">
              <input type="checkbox" name="sendCopy">
              <span class="label-body">Posalji kopiju sebi</span>
            </label>
            <label class="acceptConditions">
              <input type="checkbox" name="acceptCondition" required>
              <span class="label-body">Prihvatam uslove</span>
            </label>
            <input class="button-primary" type="submit" value="Posalji" name="submit" />
          </div>
      </form>
    </section>





        <!--Footer-->
        <footer>
            <div class="container">
                <div class="row">
                    <!--Usluge na dnu-->
                    <div class="six columns aside">
                        <h3>Usluge</h3>
                        <nav class="side__nav">
                            <ul class="side__nav--ul">
                                <li>
                                    <a href="./">Stampanje</a>
                                </li>
                                <li>
                                    <a href="../blokovi">Preslikavajuci blokovi</a>
                                </li>
                                <li>
                                    <a href="../uplatnice">Uplatnice</a>
                                </li>
                                <li>
                                    <a href="../koverte-dostavnice-formulari">Koverte, Dostavnice, Formulari za adresiranje</a>
                                </li>
                                <li>
                                    <a href="../omot-spisa">Omot spisa</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- End of usluga -->

                    <div class="six columns aside">
                        <h3>Ostalo</h3>
                        <nav class="side__nav">
                            <ul class="side__nav--ul">
                                <li>
                                    <a href="../cenovnik">Cenovnik</a>
                                </li>
                                <li>
                                    <a href="../o-nama">O nama</a>
                                </li>
                                <li>
                                    <a href="../kontakt">Kontakt</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- End of ostalo -->

                </div>
                <!-- End of row -->
            </div>
            <!-- End of container -->
        </footer>
        <!--End of footer-->
    </div>
    <!--end of MAIN container-->
</body>

</html>