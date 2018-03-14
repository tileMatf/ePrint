<?php
//require_once "../../connection.php";
//require_once '../../functions/mail.php';
require_once '../../functions/functions.php';

if(isset($_POST['submit'])) {
	try{		
		$createPicture = createPicture('koverta-sa-dostavnicom');
		
		if($createPicture === true){
			echo "<div id='pictureModal' class='picture-modal'>
					  <span class='picture-close'>&times;</span>
					  <img class='picture-modal-content' id='nalog' src='../output/koverta-sa-dostavnicom-" . $_POST['color'] . ".jpg'>
					  <div id='picture-caption'></div>
					  <button id='paymentConfirm'>Ok</button>
				 </div>";
		}
		/*
		$status = 0;
		$message = makeMessage('koverte-sa-dostavnicom');

		if(!isset($post['sendCopy']))
			$status = sendMail($message);
		else 
			$status = sendMail($message, $post['userEmail']);		
				
		if($status === true)
			$statusMessage = "Koverta sa dostavnicom za ručno popunjavanje je uspešno naručena.";
		else
			$statusMessage = "Oprostite, došlo je do greške. Molim Vas, pokušajte ponovo."; */
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Facebook meta tags-->
    <meta property="og:url" content="http://example .com/page.html">
    <meta property="og:title" content="ePrint">
    <meta property="og:image" content="http://example.com/image.jpg">
    <meta property="og:description" content="Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.">
    <meta property="og:site_name" content="Site Name">
    <meta property="og:locale" content="Sh_SP">
    <meta property="og:type" content="website" />
    <!-- Twitter meta tags -->
    <meta name="twitter:url" content="http://example.com/page.html">
    <meta name="twitter:title" content="ePrint">
    <meta name="twitter:image" content="http://example.com/image.jpg">
    <meta name="twitter:description" content=Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image:alt" content="Alt text for image">
    <!--Font from Google-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600&amp;subset=latin-ext" rel="stylesheet" type="text/css">
    <!--CSS files-->
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/skeleton.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <link rel="apple-touch-icon" href="../images/icon.png">
    <!--Favicon-->
    <!-- For IE 10 and below -->
    <!-- Place favicon.ico in the root directory - no tag necessary -->
    <!-- Icon in the highest resolution we need it for -->
    <link rel="icon" sizes="192x192" href="../images/favicon.png">
    <!-- Apple Touch Icon (reuse 192px icon.png) -->
    <link rel="apple-touch-icon" href="../images/favicon.png">
    <!-- Safari Pinned Tab Icon -->
    <link rel="mask-icon" href="../../images/favicon.png" color="blue">    
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
                    <a href="../../">
                        <img class="logo" src="../../images/eprint1.png" />
                    </a>
                </div>
                <!--NAVIGATION-->
                <div class="six columns navigation__header">
                    <div class="navigation__header--nav">
                        <ul class="nav login nav-reg-log">
                            <li>
                            <button onclick="document.getElementById('modal1').style.display='block'">Uloguj se<i class="fas fa-user-plus" aria-hidden="true"></i></button>
                            </li>
                            <li>
                            <button onclick="document.getElementById('modal2').style.display='block'">Registruj se<i class="fas fa-user-plus" aria-hidden="true"></i></button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end of second one-half column-->
            </div>
            <!--end of row-->
        </header>
         <!-- LOGIN MODAL1 -->
         <div id="modal1" class="modal">
            <span class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate" action="/action_page.php">
                <div class="container">
                    <h1 class="log-reg__heading">Uloguj se</h1>
                    <p>Popunite navedena polja.</p>
                    <hr>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Unesite email" name="email" required>
                
                    <label for="psw"><b>Lozinka</b></label>
                    <input type="password" placeholder="Unesite lozinku" name="psw" required>
                        
                    <button type="submit" class="login-btn">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Zapamti me
                    </label>
                </div>
    
                <div class="container" style="background-color:#f1f1f1; margin-top: 40px;">
                    <div class="row">
                        <div class="seven columns">
                        <button type="button" class="cancelbtn">Nazad</button>
                    </div>
                    <div class="five columns" style="padding-top: 5px;">
                        <a href="#">Zaboravili ste šifru?</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- REGISTER MODAL 2 -->
    <div id="modal2" class="modal">
        <span class="close" title="Close Modal">&times;</span>
        <form class="modal-content animate" action="/action_page.php">
            <div class="container">
                <h1 class="log-reg__heading">Registruj se</h1>
                <p>Popunite navedena polja.</p>
                <hr>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Upišite Vašu email adresu" name="email" required>
            
                <label for="psw"><b>Lozinka</b></label>
                <input type="password" placeholder="Upišite Vašu lozinku" name="psw" required>
            
                <label for="psw-repeat"><b>Potvrdite lozinku</b></label>
                <input type="password" placeholder="Potvrdite Vašu lozinku" name="psw-repeat" required>
                    
                <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Zapamti me
                </label>
            
                <p>Pravljenjem naloga prihvatate naše <a href="#" style="color:dodgerblue">uslove</a> poslovanja</p>
            
                <div class="clearfix">
                    <button type="button" class="cancelbtn">Nazad</button>
                    <button type="submit" class="signupbtn">Registruj se</button>
                </div>
            </div>
        </form>
    </div>    
        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../../">
                        <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="../">Koverte, dostavnice, formulari za adresiranje</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Koverte sa dostavnicom za ručno popunjavanje</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading section-heading--smaller">Koverte sa dostavnicom za ručno popunjavanje</h2>

            <!-- OVDE POCINJE FORMA ** -->
            <form method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-box">
				<!-- Paragraf za povratnu poruku -->		
				<p style="font-size:2rem; font-style: italic;" id="statusMessage"></p>
                    <!-- ZA -->
                    <label class="label__heading">Za</label>
                    <label for="Javni izvrsitelj">
                        <input type="radio" id="Javni izvrsitelj" name="forInput" value="Javni izvrsitelj" 
							<?php echo (isset($_POST['forInput']) && $_POST['forInput'] == 'Javni izvrsitelj') || !isset($_POST['forInput']) ? "checked" : "" ?>>
                        <span>Javni izvršitelj</span>
                    </label>
                    <label for="Javni beleznik">
                        <input type="radio" id="Javni beleznik" name="forInput" value="Javni beleznik" 
							<?php echo isset($_POST['forInput']) && $_POST['forInput'] == 'Javni beleznik' ? "checked" : ""?>>
                        <span>Javni beležnik</span>
                    </label>

                    <!-- BOJA -->
                    <label class="label__heading">Boja</label>
                    <label for="plava">
                        <input type="radio" id="plava" name="color" value="plava" checked 
							<?php echo (isset($_POST['color']) && $_POST['color'] == 'plava') || !isset($_POST['color']) ? "checked" : "" ?>>
                        <span>Plave</span>
                    </label>
                    <label for="bela">
                        <input type="radio" id="bela" name="color" value="bela" 
							<?php echo isset($_POST['color']) && $_POST['color'] == 'bela' ? "checked" : ""?>>
                        <span>Bele</span>
                    </label>

                    <!--Ime i prezime ******************************-->
                    <label for="nameLastname" class="label__heading">Ime i prezime</label>
                    <input name="nameLastname" class="u-full-width" type="text"
						value="<?php echo isset($_POST['nameLastname']) ? $_POST['nameLastname'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Ulica ******************************-->
                    <label for="adress" class="label__heading">Ulica</label>
                    <input name="adress" class="u-full-width" type="text"
						value="<?php echo isset($_POST['adress']) ? $_POST['adress'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Postanski broj ******************************-->
                    <label for="zipCode" class="label__heading">Postanski broj</label>
                    <input name="zipCode" class="u-full-width" type="text"
						value="<?php echo isset($_POST['zipCode']) ? $_POST['zipCode'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Mesto ******************************-->
                    <label for="location" class="label__heading">Mesto</label>
                    <input name="location"  class="u-full-width" type="text"
						value="<?php echo isset($_POST['location']) ? $_POST['location'] : '' ?>">
                    <!-- ***************************** -->


                    <!--Postarina placena kod poste ******************************-->
                    <label for="postagePaid" class="label__heading">Poštarina plaćena kod pošte</label>
                    <input name="postagePaid"  class="u-full-width" type="text"
						value="<?php echo isset($_POST['postagePaid']) ? $_POST['postagePaid'] : '' ?>">
                    <!-- ***************************** -->

                    <!-- S0 ili S5 -->
                    <label class="label__heading">Koverte za lično popunjavanje</label>
                    <label for="zeroEnvelope">
                        <input type="radio" id="zeroEnvelope" name="envelopeType" value="S0" checked 
							<?php echo (isset($_POST['envelopeType']) && $_POST['envelopeType'] == 'S0') || !isset($_POST['envelopeType']) ? "checked" : "" ?>>
                        <span>S0</span>
                    </label>
                    <label for="fiveEnvelope">
                        <input type="radio" id="fiveEnvelope" name="envelopeType" value="S5" 
							<?php echo isset($_POST['envelopeType']) && $_POST['envelopeType'] == 'S5' ? "checked" : ""?>>
                        <span>S5</span>
                    </label>

                    <!-- Kolicina -->
                    <label for="quantity" class="label__heading">Količina</label>
                    <select class="u-full-width" name="quantity">
                        <option value="1000" selected>1000</option>
                        <option value="2000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '2000' ? "selected" : ""?>>2000</option>
                        <option value="3000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '3000' ? "selected" : ""?>>3000</option>
                        <option value="4000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '4000' ? "selected" : ""?>>4000</option>
                        <option value="5000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '5000' ? "selected" : ""?>>5000</option>
                        <option value="6000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '6000' ? "selected" : ""?>>6000</option>
                        <option value="7000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '7000' ? "selected" : ""?>>7000</option>
                        <option value="8000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '8000' ? "selected" : ""?>>8000</option>
                        <option value="9000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '9000' ? "selected" : ""?>>9000</option>
                        <option value="10000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '10000' ? "selected" : ""?>>10000</option>
                    </select>
                    <!-- ***************************** -->

                    <label class="sendCopy">
                        <input type="checkbox" id="sendCopy" name="sendCopy">
                        <span class="label-body">Pošalji kopiju sebi</span>
                        <input type="text" placeholder="Upišite Vas email" id="email" name="email" />
                    </label>
                    <input class="button-primary" type="submit" value="Pošalji" name="submit" />
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
                                    <a href="../../stampanje">Štampanje</a>
                                </li>
                                <li>
                                    <a href="../../blokovi">Preslikavajući blokovi</a>
                                </li>
                                <li>
                                    <a href="../../uplatnice">Uplatnice</a>
                                </li>
                                <li>
                                    <a href="../">Koverte, Dostavnice, Formulari za adresiranje</a>
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
	<!-- JS files -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="../../js/main.js"></script>
	<script>
		var pictureClose = document.getElementsByClassName("picture-close")[0];
		// When the user clicks on <span> (x), close the modal
		pictureClose.onclick = function() { 
			$('#pictureModal').css("display", "none");
		}
	
		$("#paymentConfirm").click(function(e) {
			e.preventDefault();	
			$('#pictureModal').css("display", "none");

			$.ajax({
				type: "POST",
				url: "../../functions/confirm/",
				dataType: "text",
				data: { 
					type: 'koverta-sa-dostavnicom',
					data: $('form').serialize()
				},
				success: function(result) {
					if(result == "true") {
						$('form')[0].reset();
						$('#statusMessage').text("Koverta sa dostavnicom je uspešno naručena.");
						$('#statusMessage').css("color", "green");
					} else {
						$('#statusMessage').text("Oprostite, došlo je do greške prilikom slanja. Molim Vas pokušajte ponovo.");
						$('#statusMessage').css("color", "red");
					}
				},
				error: function(result) {			
					$('#statusMessage').text("Oprostite, došlo je do greške na serveru prilikom slanja. Molim Vas, pokušajte ponovo.");
					$('#statusMessage').css("color", "red");
				}
			});
		});
	</script>
</body>

</html>