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
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/skeleton.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/icon.png">
    <!--FA icons-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container container__main shadow">
        <!--HEADER-->
        <header>
            <div class="row">
                <div class="six columns">
                    <a href="index.html">
                        <img class="logo" src="../../images/eprint1.png" />
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
                    <a class="tile" href="../../">
                        <i class="fa fa-home" aria-hidden="true"></i>Pocetna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="../">Koverte, dostavnice, formulari za adresiranje</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./">Standardne koverte</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading">Standardne koverte</h2>

            <!-- OVDE POCINJE FORMA ** -->
            <form class="form__stampanje form-box">

                <!--UPLOAD dugme-->
                <input class="button-primary" type="submit" value="Upload">

                <!-- VELICINA -->
                <label for="">Velicina</label>
                <label for="regularRadio">
                    <input type="radio" name="radioPrimerak" id="first" value="radio 1" checked />
                    <span>B6</span>
                </label>
                <label for="secondRegularRadio">
                    <input type="radio" name="radioPrimerak" id="second" value="radio 2" />
                    <span>B5</span>
                </label>
                <label for="secondRegularRadio">
                    <input type="radio" name="radioPrimerak" id="second" value="radio 2" />
                    <span>C4</span>
                </label>
                <label for="secondRegularRadio">
                    <input type="radio" name="radioPrimerak" id="second" value="radio 2" />
                    <span>American sa prozorom desnim</span>
                </label>
                <label for="secondRegularRadio">
                    <input type="radio" name="radioPrimerak" id="second" value="radio 2" />
                    <span>American bez prozora</span>
                </label>
                <!-- ***************************** -->

                <!-- Kolicina -->
                <label for="exampleRecipientInput">Kolicina</label>
                <select class="u-full-width" id="exampleRecipientInput">
                    <option value="Option 1" selected>1000</option>
                    <option value="Option 2">2000</option>
                    <option value="Option 3">3000</option>
                    <option value="Option 4">4000</option>
                    <option value="Option 5">5000</option>
                    <option value="Option 6">6000</option>
                    <option value="Option 7">7000</option>
                    <option value="Option 8">8000</option>
                    <option value="Option 9">9000</option>
                    <option value="Option 10">10000</option>
                </select>
                <!-- ***************************** -->

                <!--Stampanje na posledjini ******************************-->
                <label for="exampleEmailInput">Stampanje na poledjini:</label>
                <input class="u-full-width" type="text" placeholder="Prvi red..." id="NumberInput">
                <input class="u-full-width" type="text" placeholder="Drugi red..." id="NumberInput">
                <input class="u-full-width" type="text" placeholder="Treci red..." id="NumberInput">
                <input class="u-full-width" type="text" placeholder="Cetvrti red..." id="NumberInput">
                <!-- ***************************** -->

                <!--Stampanje na adresnoj strani ******************************-->
                <label for="exampleEmailInput">Stampanje na adresnoj strani:</label>
                <input class="u-full-width" type="text" placeholder="Prvi red..." id="NumberInput">
                <input class="u-full-width" type="text" placeholder="Drugi red..." id="NumberInput">
                <input class="u-full-width" type="text" placeholder="Treci red..." id="NumberInput">
                <input class="u-full-width" type="text" placeholder="Cetvrti red..." id="NumberInput">
                <!-- ***************************** -->

                <!-- Krajnja poruka -->
                <label for="exampleMessage">Poruka</label>
                <textarea class="u-full-width" placeholder="Dodatni komentar ..." id="exampleMessage"></textarea>

                <!-- Varijabilni podaci i prihvatam uslove -->
                <label class="example">
                    <input type="checkbox">
                    <span class="label-body">Varijabilni podaci</span>
                </label>
                <label class="example">
                    <input type="checkbox">
                    <span class="label-body">Prihvatam uslove</span>
                </label>

                <!-- Dugme -->
                <input class="button-primary" type="submit" value="Posalji">
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