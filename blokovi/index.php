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
		
		$message = makeMessage('blokovi');

		if(!isset($_POST['sendCopy']))
			$mailStatus = sendMail($message);
		else {
			$mailStatus = sendMail($message, $_POST['userEmail']);		
		}
		
		$status = false;
		if(($fileStatus === 2 || $fileStatus === 3) && $mailStatus === true){
			$status = true;
		} else {
			$status = false;
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
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/skeleton.css">
    <link rel="stylesheet" href="../css/style.css">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link rel="apple-touch-icon" href="../images/icon.png">
    <!--Favicon-->
    <!-- For IE 10 and below -->
    <!-- Place favicon.ico in the root directory - no tag necessary -->
    <!-- Icon in the highest resolution we need it for -->
    <link rel="icon" sizes="192x192" href="../images/favicon.png">
    <!-- Apple Touch Icon (reuse 192px icon.png) -->
    <link rel="apple-touch-icon" href="../images/favicon.png">
    <!-- Safari Pinned Tab Icon -->
    <link rel="mask-icon" href="../images/favicon.png" color="blue">    
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
          <!---- NAVIGATION ---->
          <div class="six columns navigation__header navigation__header--nav">
              <!--Registruj se i Uloguj se-->
              <ul class="nav login nav-reg-log">
                <li>
                  <button onclick="document.getElementById('modal1').style.display='block'">Uloguj se<i class="fas fa-user-plus" aria-hidden="true"></i></button>
                </li>
                <li>
                  <button onclick="document.getElementById('modal2').style.display='block'">Registruj se<i class="fas fa-user-plus" aria-hidden="true"></i></button>
                </li>
              </ul>
          </div>
          <!--end of column-->
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
            </div>
        </form>
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
                    <a class="tile" href="../">
                        <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Preslikavajući Blokovi</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->

        <!--Stampanje section-->
        <section class="section__stampanje">
            <div class="container">
                <h2 class="section__heading">Preslikavajući blokovi</h2>
            </div>
            <!-- OVDE POCINJE FORMA ZA ***BLOKOVE*** -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
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
                    <input type='file' name='fileToUpload' id="file" class="inputfile" accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf'
						<?php echo (isset($_POST['fileToUpload']) ? "value='".$_POST['fileToUpload']['name']."'" : "") ?>>
                    <label for="file"><i class="fa-upload fas fa-upload"></i><span>Okačite fajl</span></label>
                    <div class="row">

                        <!-- BROJ SETOVA ***************************** -->
                        <label for="noOfSet" class="label__heading">Broj setova</label>
                        <input class="u-full-width" type="number" name="noOfSet"
							<?php echo (isset($_POST['noOfSet'])) ? "value='".$_POST['noOfSet']."'" : "value='1'" ?>>
                        <!-- ***************************** -->

                        <!-- BOJA ***************************** -->
                        <label for="" class="label__heading">Boja</label>
                        <label for="Crno-belo">
                            <input type="radio" name="blockColor" id="Crno-belo" value="Crno-belo" 
								<?php echo (isset($_POST['blockColor']) && $_POST['blockColor'] == 'Crno-belo') || !isset($_POST['blockColor']) ? "checked" : "" ?>>
                            <span>Crno belo</span>
                        </label>
                        <label for="Plavo-belo" class="label__heading">
                            <input type="radio" name="blockColor" id="Plavo-belo" value="Plavo-belo" 
								<?php echo isset($_POST['blockColor']) && $_POST['blockColor'] == 'Plavo-belo' ? "checked" : "" ?>>
                            <span>Plavo belo</span>
                        </label>
                        <label for="U boji" class="label__heading">
                            <input type="radio" name="blockColor" id="U boji" value="U boji" 
								<?php echo isset($_POST['blockColor']) && $_POST['blockColor'] == 'U boji' ? "checked" : "" ?>>
                            <span>U boji</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- VELICINA BLOKA  ***************************** -->
                        <label for="" class="label__heading">Veličina bloka</label>
                        <label for="A4">
                            <input type="radio" name="blockSize" id="A4" value="A4"
								<?php echo (isset($_POST['blockSize']) && $_POST['blockSize'] == 'A4') || !isset($_POST['blockSize']) ? "checked" : "" ?>>
                            <span>A4</span>
                        </label>
                        <label for="A5">
                            <input type="radio" name="blockSize" id="A5" value="A5"
								<?php echo isset($_POST['blockSize']) && $_POST['blockSize'] == 'A5' ? "checked" : "" ?>>
                            <span>A5</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- SPAKOVANO -->
                        <label for="" class="label__heading">Spakovano</label>
                        <label for="Heftanjem gore">
                            <input type="radio" name="packing" id="Heftanjem gore" value="Heftanjem gore" 
								<?php echo (isset($_POST['packing']) && $_POST['packing'] == 'Heftanjem gore') || !isset($_POST['packing']) ? "checked" : "" ?>>
                            <span>Heftanjem gore</span>
                        </label>
                        <label for="Heftanjem levo">
                            <input type="radio" name="packing" id="Heftanjem levo" value="Heftanjem levo" 
								<?php echo isset($_POST['packing']) && $_POST['packing'] == 'Heftanjem gore' ? "checked" : "" ?>>
                            <span>Heftanjem levo</span>
                        </label>
                        <label for="U fasciklu">
                            <input type="radio" name="packing" id="U fasciklu" value="U fasciklu" checked 
								<?php echo isset($_POST['packing']) && $_POST['packing'] == 'U fasciklu' ? "checked" : "" ?>>
                            <span>U fasciklu</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- Krajnja poruka -->
                        <label for="message" class="label__heading">Poruka</label>
                        <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"></textarea>
                        <label for="sendCopy">
                        <input type="checkbox" name="sendCopy" id="sendCopy" 
							<?php echo isset($_POST['sendCopy']) ? "checked" : "" ?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
						<input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail">
                        </label>
						<input type="hidden" name="orderType" id="orderType" value="blokovi">
						<input type="hidden" id="successMessage" value="Blokovi su uspešno naručeni.">
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
                                    <a href="../stampanje">Štampanje</a>
                                </li>
                                <li>
                                    <a href="./">Preslikavajući blokovi</a>
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

<!-- JS files -->
<script src="../js/main.js"></script>
</body>

</html>