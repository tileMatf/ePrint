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
                <!--NAVIGATION-->
                <div class="six columns navigation__header">
                    <div class="navigation__header--nav">
                        <ul class="nav nav-reg-log">
                            <li>
                                <a href="#">Registruj se
                                    <i class="fas fa-user-plus" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">Uloguj se
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

        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../">
                        <i class="fas fa-home" aria-hidden="true"></i>Pocetna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./">Preslikavajuci Blokovi</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->

        <!--Stampanje section-->
        <section class="section__stampanje">
            <div class="container">
                <h2 class="section__heading">Preslikavajuci blokovi</h2>
            </div>
            <!-- OVDE POCINJE FORMA ZA ***BLOKOVE*** -->
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <div class="form-box">
                    <!--UPLOAD dugme-->
                    <label class="label__heading">Okacite vas fajl</label>
		            <input type='file' name='fileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>
                    <div class="row">

                        <!-- BROJ SETOVA ***************************** -->
                        <label for="noOfSet" class="label__heading">Broj setova</label>
                        <input class="u-full-width" type="number" name="noOfSet" value="1">
                        <!-- ***************************** -->

                        <!-- BOJA ***************************** -->
                        <label for="" class="label__heading">Boja</label>
                        <label for="blockColor">
                            <input type="radio" name="blockColor" value="Crno-belo" checked />
                            <span>Crno belo</span>
                        </label>
                        <label for="blockColor" class="label__heading">
                            <input type="radio" name="blockColor" value="Plavo-belo" />
                            <span>Plavo belo</span>
                        </label>
                        <label for="blockColor" class="label__heading">
                            <input type="radio" name="blockColor" value="U boji" />
                            <span>U boji</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- VELICINA BLOKA  ***************************** -->
                        <label for="" class="label__heading">Velicina bloka</label>
                        <label for="blockSize">
                            <input type="radio" name="blockSize" value="A4" checked/>
                            <span>A4</span>
                        </label>
                        <label for="blockSize">
                            <input type="radio" name="blockSize" value="A5" />
                            <span>A5</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- SPAKOVANO -->
                        <label for="" class="label__heading">Spakovano</label>
                        <label for="packing">
                            <input type="radio" name="packing" value="Heftanjem gore" />
                            <span>Heftanjem gore</span>
                        </label>
                        <label for="packing">
                            <input type="radio" name="packing" value="Heftanjem levo" />
                            <span>Heftanjem levo</span>
                        </label>
                        <label for="packing">
                            <input type="radio" name="packing" value="U fasciklu" checked />
                            <span>U fasciklu</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- Krajnja poruka -->
                        <label for="message" class="label__heading">Poruka</label>
                        <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"></textarea>
                        <label for="sendCopy">
                        <input type="checkbox" name="sendCopy">
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
                                    <a href="../stampanje">Stampanje</a>
                                </li>
                                <li>
                                    <a href="./">Preslikavajuci blokovi</a>
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