<?php

//require_once "../connection.php";
require_once '../functions/mail.php';
require_once '../functions/functions.php';

if(isset($_POST['submit'])) {
	try{		
		$status = 0;
		$fileStatus = 0;
		
		$fileStatus = uploadFile("uploaded_file/");
		$statusMessage = generateMessage($fileStatus);
		if($fileStatus !== 2 && $fileStatus !== 3)
			return false;
	
		$message = makeMessage('omot-spisa');
		
		$status = false;
		if($fileStatus === 2 || $fileStatus === 3){
			$status = true;
		} else {
			$status = false;
		}

		if($status === true) {
			if(!isset($post['sendCopy']))
				$status = sendMail($message);
			else {
				$status = sendMail($message, $post['userEmail']);		
			}
		}		
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
                    <a class="tile" href="../">
                        <i class="fas fa-home" aria-hidden="true"></i>Pocetna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Omot spisa</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading">Omot Spisa</h2>

            <!-- OVDE POCINJE FORMA ** -->
            <form method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
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
                    <!--UPLOAD dugme-->
                    <label class="label__heading">Okacite Vas fajl</label>
                    <input type='file' name='fileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>

                    <!-- ZA -->
                    <label class="label__heading">Za</label>
                    <label for="forInput">
                        <input type="radio" name="forInput" value="Javni izvrsitelj" checked />
                        <span>Javni izvrsitelj</span>
                    </label>
                    <label for="forInput">
                        <input type="radio" name="forInput" value="Javni beleznik" />
                        <span>Javni beleznik</span>
                    </label>
                    <label for="forInput">
                        <input type="radio" name="forInput" value="Advokat" />
                        <span>Advokat</span>
                    </label>
                    <!-- ***************************** -->

                    <!--Ime i prezime ******************************-->
                    <label for="nameLastname" class="label__heading">Ime i prezime</label>
                    <input name="nameLastname" class="u-full-width" type="text" placeholder="">
                    <!-- ***************************** -->

                    <!--Ulica ******************************-->
                    <label for="adress" class="label__heading">Ulica</label>
                    <input name="adress" class="u-full-width" type="text" placeholder="">
                    <!-- ***************************** -->

                    <!--Postanski broj ******************************-->
                    <label for="zipCode" class="label__heading">Postanski broj</label>
                    <input name="zipCode" class="u-full-width" type="text" placeholder="">
                    <!-- ***************************** -->

                    <!--Mesto ******************************-->
                    <label for="location" class="label__heading">Mesto</label>
                    <input name="location"  class="u-full-width" type="text" placeholder="">
                    <!-- ***************************** -->

                    <!-- Vrsta papira ***************************** -->
                    <label class="label__heading">Vrsta papira</label>
                    <label for="typeOfPaper">
                        <input type="radio" name="typeOfPaper" value="100gr/m2" checked/>
                        <span>100gr/m<sup>2</span>
                    </label>
                    <label for="typeOfPaper" class="label__heading">
                        <input type="radio" name="typeOfPaper" value="300gr/m2" />
                        <span>300gr/m<sup>2</span>
                    </label>
                    <!-- ***************************** -->

                    <!-- Kolicina -->
                    <label for="quantity" class="label__heading">Kolicina</label>
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
                        <label for="message" class="label__heading">Poruka</label>
                        <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"></textarea>
                        <label class="sendCopy">
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