<?php

//require_once "../../connection.php";
require_once "../../functions/mail.php";
require_once "../../functions/functions.php";

if(isset($_POST['submit'])) {
	try{
		//$db = new DB();
		$target_dir = "uploaded_file/";
		$status = 0;
		$fileStatus = 0;		
		
		$fileStatus = uploadFile("uploaded_file/");
		$statusMessage = generateMessage($fileStatus);
		if($fileStatus !== 2 && $fileStatus !== 3)
			return false;

		$message = makeMessage('standardne-koverte');

		$status = false;
		if($fileStatus === 2 || $fileStatus === 3){
			$status = true;
		} else {
			$status = false;
		}		

		if($status === true){
			if(!isset($_POST['sendCopy']))
				$mailStatus = sendMail($message);
			else {
				$mailStatus = sendMail($message, $_POST['userEmail']);		
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
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/skeleton.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="apple-touch-icon" href="../../images/icon.png">
    <!--FA icons-->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
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
                    <a class="tile" href="../../">
                        <i class="fas fa-home" aria-hidden="true"></i>Pocetna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="../">Koverte, dostavnice, formulari za adresiranje</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Standardne koverte</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading">Standardne koverte</h2>

            <!-- OVDE POCINJE FORMA ** -->
            <form method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="form-box">
				<!-- Paragraf za povratnu poruku -->		
				<?php
					if(isset($status)){
						if($status === true){
							if(isset($statusMessage) && $statusMessage)
								echo '<p id="statusMessage" style="font-size:2rem; font-style: italic; color: green">'.
									htmlspecialchars($statusMessage) . '</p>';
						}
						else {
							if(isset($statusMessage) && $statusMessage)
								echo '<p id="statusMessage" style="font-size:2rem; font-style: italic; color: red">'.
									htmlspecialchars($statusMessage) . '</p>';						
						}
					}
				?> 
                    <!--UPLOAD dugme-->
                    <label class="label__heading">Okacite vas fajl</label>
                    <input type='file' name='fileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>	

                    <!-- VELICINA -->
                    <label class="label__heading">Velicina</label>
                    <label for="B6">
                        <input type="radio" id="B6" name="size" value="B6" checked />
                        <span>B6</span>
                    </label>
                    <label for="B5">
                        <input type="radio" id="B5" name="size" value="B5" />
                        <span>B5</span>
                    </label>
                    <label for="C4">
                        <input type="radio" id="C4" name="size" value="C4" />
                        <span>C4</span>
                    </label>
                    <label for="American1">
                        <input type="radio" id="American1" name="size" value="American sa prozorom desnim" />
                        <span>American sa prozorom desnim</span>
                    </label>
                    <label for="American2">
                        <input type="radio" id="American2" name="size" value="American bez prozora" />
                        <span>American bez prozora</span>
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
                        <option value="100000">10000</option>
                    </select>
                    <!-- ***************************** -->

                    <!--Stampanje na posledjini ******************************-->
                    <label class="label__heading">Stampanje na poledjini:</label>
                    <input class="u-full-width" type="text" placeholder="Prvi red..." name="printingOnBack1" value="">
                    <input class="u-full-width" type="text" placeholder="Drugi red..." name="printingOnBack2" value="">
                    <input class="u-full-width" type="text" placeholder="Treci red..." name="printingOnBack3" value="">
                    <input class="u-full-width" type="text" placeholder="Cetvrti red..." name="printingOnBack4" value="">
                    <!-- ***************************** -->

                    <!--Stampanje na adresnoj strani ******************************-->
                    <label class="label__heading">Stampanje na adresnoj strani:</label>
                    <input class="u-full-width" type="text" placeholder="Prvi red..." name="printingOnAdressPage1" value="">
                    <input class="u-full-width" type="text" placeholder="Drugi red..." name="printingOnAdressPage2" value="">
                    <input class="u-full-width" type="text" placeholder="Treci red..." name="printingOnAdressPage3" value="">
                    <input class="u-full-width" type="text" placeholder="Cetvrti red..." name="printingOnAdressPage4" value="">
                    <!-- ***************************** -->

                    <!--Krajnja poruka-->
                    <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"></textarea>
                    <!-- Varijabilni podaci i prihvatam uslove -->
                    <label for="varData">
                        <input type="checkbox" name="varData" id="varData">
                        <span class="label-body">Varijabilni podaci</span>
                    </label>
                    <label for="sendCopy">
                        <input type="checkbox" name="sendCopy" id="sendCopy">
                        <span class="label-body">Posalji kopiju sebi</span>
                    </label>
                    <!-- POSALJI DUGME -->
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