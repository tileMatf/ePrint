<?php

//require_once "../connection.php";
require_once '../../functions/mail.php';
require_once "../../functions/functions.php";


if(isset($_POST['submit'])) {
	try{
		//$db = new DB();
		
		$status = 0;	
		$message = makeMessage('nalog-za-isplatu');			
		
		if(!isset($_POST['sendCopy']))
			$status = sendMail($message);			
		else {
			$status = sendMail($message, $_POST['userEmail']);		
		}
		if($status === true)
			$statusMessage = "Nalog za isplatu je uspešno poslat.";
		else
			$statusMessage = "Oprostite, došlo je do greške prilikom slanja. Molim Vas pokušajte ponovo.";
	} catch(RuntimeException $e){
		return $e->getMessage();
	} 
}
?>

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
                    <a href="../index.html">
                        <img class="logo" src="../images/eprint1.png" />
                    </a>
                </div>
                <!--NAVIGATION-->
                <div class="six columns navigation__header">
                    <div class="navigation__header--nav">
                        <ul class="nav">
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
                    <a class="tile" href="../../">
                        <i class="fas fa-home" aria-hidden="true"></i>Pocetna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="../">Uplatnice</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Nalog za isplatu</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <div class="container">
                <h2 class="section__heading">Nalog za isplatu</h2>
            </div>
            <!-- OVDE POCINJE FORMA -->
            <form method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-box">
				<!-- Paragraf za povratnu poruku -->		
				<?php
					if(isset($status)){
						if($status === true){
							if(isset($statusMessage) && $statusMessage)
								echo '<p style="font-size:2rem; font-style: italic; color: green">'.
									htmlspecialchars($statusMessage) . '</p>';
						}
						else {
							if(isset($statusMessage) && $statusMessage)
								echo '<p style="font-size:2rem; font-style: italic; color: red">'.
									htmlspecialchars($statusMessage) . '</p>';						
						}
					}
				?> 				
                    <!-- UNOS PODATAKA ***************************** -->
                    <!--<h5>Unos podataka</h5>-->

                    <!--PlATILAC ******************************-->
                    <label for="payer" class="label__heading">Platilac</label>
                    <input class="u-full-width" type="text" placeholder="" name="payer">
                    <!-- ***************************** -->

                    <!--SVRHA UPLATE ******************************-->
                    <label for="purposeOfPayment" class="label__heading">Svrha uplate</label>
                    <input class="u-full-width" type="text" placeholder="" name="purposeOfPayment">
                    <!-- ***************************** -->

                    <!--PRIMALAC ******************************-->
                    <label for="recipient" class="label__heading">Primalac</label>
                    <input class="u-full-width" type="text" placeholder="" name="recipient">
                    <!-- ***************************** -->

                    <!--SIFRA PLACANJA ******************************-->
                    <label for="paymentCode" class="label__heading">Sifra placanja</label>
                    <input class="u-full-width" type="text" placeholder="" name="paymentCode">
                    <!-- ***************************** -->

                    <!--VALUTA ******************************-->
                    <label for="currency" class="label__heading">Valuta</label>
                    <input class="u-full-width" type="text" placeholder="" name="currency">
                    <!-- ***************************** -->

                    <!--IZNOS ******************************-->
                    <label for="amount" class="label__heading">Iznos</label>
                    <input class="u-full-width" type="text" placeholder="RSD" name="amount">
                    <!-- ***************************** -->

                    <!--RACUN PRIMAOCA ******************************-->
                    <label for="accountOfRecipient" class="label__heading">Racun primaoca</label>
                    <input class="u-full-width" type="text" placeholder="" name="accountOfRecipient">
                    <!-- ***************************** -->

                    <!--MODEL ******************************-->
                    <label for="mockUp" class="label__heading">Model</label>
                    <input class="u-full-width" type="text" placeholder="" name="mockUp">
                    <!-- ***************************** -->

                    <!--POZIV NA BROJ ******************************-->
                    <label for="referenceNumber" class="label__heading">Poziv na broj</label>
                    <input class="u-full-width" type="text" placeholder="" name="referenceNumber">
                    <!-- ***************************** -->

                    <!-- Kraj naloga za prenos u setu sledi radio buttons -->

                    <!-- BROJ UPLATNICA U SETU ***************************** --> <!-- SVAKA UPLATNICA OVO IMA DRUGACIJE -->
                    <label for="" class="label__heading">Broj naloga za isplatu u setu</label>
                    <label for="1plus1">
                        <input type="radio" name="numOfPaySet" id="1plus1" value="1+1" checked />
                        <span>1+1</span>
                    </label>
                    <label for="1plus2">
                        <input type="radio" name="numOfPaySet" id="1plus2" value="1+2" />
                        <span>1+2</span>
                    </label>
                    <!-- ***************************** -->

                    <!-- KOLICINA SETOVA -->
                    <label for="quantity" class="label__heading">Kolicina setova</label>
                    <select class="u-full-width" name="quantity">
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                        <option value="900" selected>900</option>
                        <option value="1800">1800</option>
                        <option value="2700">2700</option>
                        <option value="5400">5400</option>
                        <option value="8100">8100</option>
                        <option value="10800">10800</option>
                    </select>
                    <!-- ***************************** -->

                    <!--Krajnja poruka-->
                    <label for="message" class="label__heading">Poruka</label>
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
                                    <a href="../stampanje.html">Stampanje</a>
                                </li>
                                <li>
                                    <a href="../blokovi.html">Preslikavajuci blokovi</a>
                                </li>
                                <li>
                                    <a href="../uplatnice.html">Uplatnice</a>
                                </li>
                                <li>
                                    <a href="../koverte-dostavnice-formulari.html">Koverte, Dostavnice, Formulari za adresiranje</a>
                                </li>
                                <li>
                                    <a href="../omot-spisa.html">Omot spisa</a>
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
                                    <a href="../cenovnik.html">Cenovnik</a>
                                </li>
                                <li>
                                    <a href="../o-nama.html">O nama</a>
                                </li>
                                <li>
                                    <a href="../kontakt.html">Kontakt</a>
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