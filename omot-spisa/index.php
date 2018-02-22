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
                    <a class="tile" href="./">Omot spisa</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading">Omot Spisa</h2>

            <!-- OVDE POCINJE FORMA ** -->
            <form class="form__stampanje form-box">

                <!--UPLOAD dugme-->
                <label>Okacite vase fajlove</label>
		        <input type='file' name='fileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>

                <!-- ZA -->
                <label>Za</label>
                <label for="forInput">
                    <input type="radio" name="forInput" value="Javni izvrsitelj" checked />
                    <span>Javni izvrsitelj</span>
                </label>
                <label for="secondRegularRadio">
                    <input type="radio" name="forInput" value="Javni beleznik" />
                    <span>Javni beleznik</span>
                </label>
                <label for="secondRegularRadio">
                    <input type="radio" name="forInput" value="Advokat" />
                    <span>Advokat</span>
                </label>
                <!-- ***************************** -->

                <!--Ime i prezime ******************************-->
                <label for="noInput">Ime i prezime</label>
                <input name="noInput" class="u-full-width" type="text" placeholder="">
                <!-- ***************************** -->

                <!--Ulica ******************************-->
                <label for="noInput">Ulica</label>
                <input name="noInput" class="u-full-width" type="text" placeholder="">
                <!-- ***************************** -->

                <!--Postanski broj ******************************-->
                <label for="noInput">Postani broj</label>
                <input name="noInput" class="u-full-width" type="text" placeholder="">
                <!-- ***************************** -->

                <!--Mesto ******************************-->
                <label for="noInput">Mesto</label>
                <input name="noInput"  class="u-full-width" type="text" placeholder="">
                <!-- ***************************** -->

                <!-- Vrsta papira ***************************** -->
                <label>Vrsta papira</label>
                <label for="typeOfPaper">
                    <input type="radio" name="typeOfPaper" value="100gr/m2" />
                    <span>100gr/m2</span>
                </label>
                <label for="typeOfPaper">
                    <input type="radio" name="typeOfPaper" value="300gr/m2" />
                    <span>300gr/m2</span>
                </label>
                <!-- ***************************** -->

                <!-- Kolicina -->
                <label for="quantity">Kolicina</label>
                <select class="u-full-width" name="quantity">
                    <option value="1000" selected>1000</option>
                    <option value="2000">2000</option>
                    <option value="3000">3000</option>
                    <option value="4000">4000</option>
                    <option value="5000">5000</option>
                    <option value="6000">6000</option>
                    <option value="7000">7000</option>
                    <option value="8000">8000</option>
                    <option value="9000">9000</option>
                </select>
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
                                    <a href="stampanje.html">Stampanje</a>
                                </li>
                                <li>
                                    <a href="blokovi.html">Preslikavajuci blokovi</a>
                                </li>
                                <li>
                                    <a href="uplatnice.html">Uplatnice</a>
                                </li>
                                <li>
                                    <a href="koverte-dostavnice-formulari.html">Koverte, Dostavnice, Formulari za adresiranje</a>
                                </li>
                                <li>
                                    <a href="omot-spisa.html">Omot spisa</a>
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
                                    <a href="cenovnik.html">Cenovnik</a>
                                </li>
                                <li>
                                    <a href="o-nama.html">O nama</a>
                                </li>
                                <li>
                                    <a href="kontakt.html">Kontakt</a>
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