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
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- JS files -->
  <script src="../js/main.js"></script>
</head>

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
        <!--NAVIGATION HEADER-->
        <div class="six columns navigation__header">
          <div class="navigation__header--nav">
            <ul class="nav nav-reg-log">
              <li>
                <a href="#0" class="cd-signin">Uloguj se
                  <i class="fas fa-user-plus" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#0" class="cd-signup">Registruj se
                  <i class="fas fa-user" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!--end of second one-half column-->
      </div>
      <!--end of row-->
    </header>

  
 
    <!-- Navigation 2 -->
    <div class="twelve columns">
      <ul class="nav1">
        <li>
          <a class="tile" href="../">
            <i class="fas fa-home" aria-hidden="true"></i>Pocetna</a>
        </li>
        <span class="line">/</span>
        <li>
          <a class="tile" href="./" style="font-size: 1.6rem;">Stampanje</a>
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
            <label class="label__heading">Okacite Vas fajl</label>
		        <input type='file' name='fileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>		

            <!-- BROJ PRIMERAKA ***************************** -->
            <label for="noInput" class="label__heading">Broj primeraka</label>
            <input name="noInput" type="number" value="1" class="u-full-width" required>
            <!-- Redosled primeraka -->
            <label class="label__heading">Slozi stranice</label>
            <label for="orderOfInput1">
              <input type="radio" id="orderOfInput1" name="orderOfInput" value="1,2,3; 1,2,3; 1,2,3" checked />
              <span>1,2,3; 1,2,3; 1,2,3</span>
            <label for="orderOfInput2">
              <input type="radio" id="orderOfInput2" name="orderOfInput" value="1,1,1; 2,2,2; 3,3,3" />
              <span>1,1,1; 2,2,2; 3,3,3</span>
            </label>
            <!-- ***************************** -->

            <!-- BOJA ***************************** -->
            <label class="label__heading">Boja</label>
            <label for="colorBlack">
              <input type="radio" id="colorBlack" name="colorOfInput" value="Crno-belo" checked />
              <span>Crno belo</span>
            </label>
            <label for="colorAll">
              <input type="radio" id="colorAll" name="colorOfInput" value="U boji" />
              <span>U boji</span>
            </label>
            <!-- ***************************** -->

            <!-- JEDNOSTRANO/DVOSTRANO  ***************************** -->
            <label class="label__heading">Jednostrano / Dvostrano</label>
            <label for="onePagePrint">
              <input type="radio" id="onePagePrint" name="typeOfPrint" value="Jednostrano" checked />
              <span>Jednostrano</span>
            </label>
            <label for="bothPagePrint">
              <input type="radio" id="bothPagePrint" name="typeOfPrint" value="Dvostrano" />
              <span>Dvostrano</span>
            </label>
            <!-- ***************************** -->

            <!-- VELICINA PAPIRA -->
            <label class="label__heading">Velicina papira</label>
            <label for="paperSizeA4">
              <input type="radio" id="paperSizeA4" name="paperSize" value="A4" checked />
              <span>A4</span>
            </label>
            <label for="paperSizeA3">
              <input type="radio" id="paperSizeA3" name="paperSize" value="A3" />
              <span>A3</span>
            </label>
            <!-- ***************************** -->

            <!-- DEBILJINA PAPIRA -->
            <label class="label__heading">Debljina papira</label>
            <label for="paperWidth80">
              <input type="radio" id="paperWidth80" name="paperWidth" value="80gr/m2" checked />
              <span>80 gr/m<sup>2</sup></span>
            </label>
            <label for="paperWidth100">
              <input type="radio" id="paperWidth100" name="paperWidth" value="100gr/m2" />
              <span>100 gr/m<sup>2</sup></span>
            </label>
            <!-- ***************************** -->


            <!-- KORICENJE -->
            <label class="label__heading">Koricenje</label>
            <label for="bindingTypePlastic">
              <input type="radio" id="bindingTypePlastic" name="bindingType" value="Plasticnom spiralom" checked />
              <span>Plasticnom spiralom</span>
            </label>
            <label for="bindingTypeWire">
              <input type="radio" id="bindingTypeWire" name="bindingType" value="Zicanom spiralom" />
              <span>Zicanom spiralom</span>
            </label>
            <label for="bindingTypeHard">
              <input type="radio" id="bindingTypeHard" name="bindingType" value="Tvrdo koricenje" />
              <span>Tvrdo koricenje</span>
            </label>
            <!-- Upload korice dugme -->
            <!--<input class="button-primary" type="submit" value="Upload korice">-->
            <label class="label__heading">Okacite koricu</label>
			      <input type='file' name='bindingFileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf'>
            <!-- ***************************** -->

            <!-- HEFTANJE -->
              <label for="heftingType" class="label__heading">Heftanje</label>
              <select class="u-full-width" name="heftingType">
                <option value="Gore levo" selected>Gore levo</option>
                <option value="Gore desno">Gore desno</option>
                <option value="Dole levo">Dole levo</option>
                <option value="Dole desno">Dole desno</option>
                <option value="Po sredini levo">Po sredini levo</option>
                <option value="Po sredini desno">Po sredini desno</option>
                <option value="Po sredini gore">Po sredini gore</option>
                <option value="Po sredini dole">Po sredini dole</option>
              </select>
            <!-- ***************************** -->


            <!-- BUSENJE -->
              <label for="drillingType" class="label__heading">Busenje</label>
              <select class="u-full-width" name="drillingType">
                <option value="Dve rupe za registrator levo" selected>Dve rupe za registrator levo</option>
                <option value="Dve rupe za registrator desno">Dve rupe za registrator desno</option>
                <option value="Dve rupe za registrator gore">Dve rupe za registrator gore</option>
                <option value="Dve rupe za registrator dole">Dve rupe za registrator dole</option>
              </select>
            <!-- ***************************** -->

            <!-- Krajnja poruka -->
            <label for="message" class="label__heading">Poruka</label>
            <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"></textarea>
            <label class="sendCopy">
              <input type="checkbox" id="sendCopy" name="sendCopy">
              <span class="label-body">Posalji kopiju sebi</span>
            </label>
            <input class="button-primary" type="submit" value="Posalji" name="submit" />
            <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p> 
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