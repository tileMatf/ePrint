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
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="apple-touch-icon" href="../../images/icon.png">
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
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <div class="form-box">
                    <!--UPLOAD dugme-->
                    <label>Okacite vas fajl</label>
                    <input type='file' name='fileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>	

                    <!-- VELICINA -->
                    <label>Velicina</label>
                    <label for="size">
                        <input type="radio" name="size" value="B6" checked />
                        <span>B6</span>
                    </label>
                    <label for="size">
                        <input type="radio" name="size" value="B5" />
                        <span>B5</span>
                    </label>
                    <label for="size">
                        <input type="radio" name="size" value="C4" />
                        <span>C4</span>
                    </label>
                    <label for="size">
                        <input type="radio" name="size" value="American sa prozorom desnim" />
                        <span>American sa prozorom desnim</span>
                    </label>
                    <label for="size">
                        <input type="radio" name="size" value="American bez prozora" />
                        <span>American bez prozora</span>
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
                        <option value="100000">10000</option>
                    </select>
                    <!-- ***************************** -->

                    <!--Stampanje na posledjini ******************************-->
                    <label for="printingOnBack">Stampanje na poledjini:</label>
                    <input class="u-full-width" type="text" placeholder="Prvi red..." name="printingOnBack">
                    <input class="u-full-width" type="text" placeholder="Drugi red..." name="printingOnBack">
                    <input class="u-full-width" type="text" placeholder="Treci red..." name="printingOnBack">
                    <input class="u-full-width" type="text" placeholder="Cetvrti red..." name="printingOnBack">
                    <!-- ***************************** -->

                    <!--Stampanje na adresnoj strani ******************************-->
                    <label for="printingOnAdressPage">Stampanje na adresnoj strani:</label>
                    <input class="u-full-width" type="text" placeholder="Prvi red..." name="printingOnAdressPage">
                    <input class="u-full-width" type="text" placeholder="Drugi red..." name="printingOnAdressPage">
                    <input class="u-full-width" type="text" placeholder="Treci red..." name="printingOnAdressPage">
                    <input class="u-full-width" type="text" placeholder="Cetvrti red..." name="printingOnAdressPage">
                    <!-- ***************************** -->

                    <!--Krajnja poruka-->
                    <label for="message">Poruka</label>
                    <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"></textarea>
                    <!-- Varijabilni podaci i prihvatam uslove -->
                    <label for="varData">
                        <input type="checkbox" name="varData">
                        <span class="label-body">Varijabilni podaci</span>
                    </label>
                    <label for="sendCopy">
                        <input type="checkbox" name="sendCopy">
                        <span class="label-body">Posalji kopiju sebi</span>
                    </label>
                    <!-- POSALJI DUGME -->
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
                                    <a href="../../stampanje">Stampanje</a>
                                </li>
                                <li>
                                    <a href="../../blokovi">Preslikavajuci blokovi</a>
                                </li>
                                <li>
                                    <a href="../../uplatnice">Uplatnice</a>
                                </li>
                                <li>
                                    <a href="../../koverte-dostavnice-formulari">Koverte, Dostavnice, Formulari za adresiranje</a>
                                </li>
                                <li>
                                    <a href="../../omot-spisa">Omot spisa</a>
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
                                    <a href="../../cenovnik">Cenovnik</a>
                                </li>
                                <li>
                                    <a href="../../o-nama">O nama</a>
                                </li>
                                <li>
                                    <a href="../../kontakt">Kontakt</a>
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