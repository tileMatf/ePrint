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
                    <a href="index.html">
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Standardne koverte</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading">Standardne koverte</h2>

            <!-- OVDE POCINJE FORMA ** -->
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
                    <!-- VELICINA -->
                    <label class="label__heading">Veličina</label>
                    <label for="B6">
                        <input type="radio" id="B6" name="size" value="B6"
							<?php echo (isset($_POST['size']) && $_POST['size'] == 'B6') || !isset($_POST['size']) ? "checked" : "" ?>>
                        <span>B6</span>
                    </label>
                    <label for="B5">
                        <input type="radio" id="B5" name="size" value="B5" 
							<?php echo (isset($_POST['size']) && $_POST['size'] == 'B5') ? "checked" : "" ?>>
                        <span>B5</span>
                    </label>
                    <label for="C4">
                        <input type="radio" id="C4" name="size" value="C4" 
							<?php echo (isset($_POST['size']) && $_POST['size'] == 'C4') ? "checked" : "" ?>>
                        <span>C4</span>
                    </label>
                    <label for="American1">
                        <input type="radio" id="American1" name="size" value="American sa prozorom desnim"
							<?php echo (isset($_POST['size']) && $_POST['size'] == 'American sa prozorom desnim') ? "checked" : "" ?>>
                        <span>American sa prozorom desnim</span>
                    </label>
                    <label for="American2">
                        <input type="radio" id="American2" name="size" value="American bez prozora" 
							<?php echo (isset($_POST['size']) && $_POST['size'] == 'American bez prozora') ? "checked" : "" ?>>
                        <span>American bez prozora</span>
                    </label>
                    <!-- ***************************** -->

                    <!-- Kolicina -->
                    <label for="quantity" class="label__heading">Količina</label>
                    <select class="u-full-width" name="quantity">
                        <option value="1000" selected>1000</option>
                        <option value="2000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '2000' ? "selected" : "" ?>>2000</option>
                        <option value="3000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '3000' ? "selected" : "" ?>>3000</option>
                        <option value="4000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '4000' ? "selected" : "" ?>>4000</option>
                        <option value="5000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '5000' ? "selected" : "" ?>>5000</option>
                        <option value="6000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '6000' ? "selected" : "" ?>>6000</option>
                        <option value="7000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '7000' ? "selected" : "" ?>>7000</option>
                        <option value="8000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '8000' ? "selected" : "" ?>>8000</option>
                        <option value="9000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '9000' ? "selected" : "" ?>>9000</option>
                        <option value="100000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '10000' ? "selected" : "" ?>>10000</option>
                    </select>
                    <!-- ***************************** -->

                    <!--Stampanje na posledjini ******************************-->
                    <label class="label__heading">Štampanje na poledjini:</label>
                    <input class="u-full-width" type="text" placeholder="Prvi red..." name="printingOnBack1" 
						<?php echo isset($_POST['printingOnBack1']) ? "value='".$_POST['printingOnBack1']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Drugi red..." name="printingOnBack2"
						<?php echo isset($_POST['printingOnBack2']) ? "value='".$_POST['printingOnBack2']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Treći red..." name="printingOnBack3" 
						<?php echo isset($_POST['printingOnBack3']) ? "value='".$_POST['printingOnBack3']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Četvrti red..." name="printingOnBack4"
						<?php echo isset($_POST['printingOnBack4']) ? "value='".$_POST['printingOnBack4']."'" : "" ?>>
                    <!-- ***************************** -->

                    <!--Stampanje na adresnoj strani ******************************-->
                    <label class="label__heading">Štampanje na adresnoj strani:</label>
                    <input class="u-full-width" type="text" placeholder="Prvi red..." name="printingOnAdressPage1"
						<?php echo isset($_POST['printingOnAdressPage1']) ? "value='".$_POST['printingOnAdressPage1']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Drugi red..." name="printingOnAdressPage2" 
						<?php echo isset($_POST['printingOnAdressPage2']) ? "value='".$_POST['printingOnAdressPage2']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Treći red..." name="printingOnAdressPage3" 
						<?php echo isset($_POST['printingOnAdressPage3']) ? "value='".$_POST['printingOnAdressPage3']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Četvrti red..." name="printingOnAdressPage4" 
						<?php echo isset($_POST['printingOnAdressPage4']) ? "value='".$_POST['printingOnAdressPage4']."'" : "" ?>>
                    <!-- ***************************** -->

                    <!--Krajnja poruka-->
                    <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : "" ?></textarea>
                    <!-- Varijabilni podaci i prihvatam uslove -->
                    <label for="varData">
                        <input type="checkbox" name="varData" id="varData"
							<?php echo isset($_POST['varData']) ? "checked" : ""?>>
                        <span class="label-body">Varijabilni podaci</span>
                    </label>
                    <label class="sendCopy">
                        <input type="checkbox" id="sendCopy" name="sendCopy"
							<?php echo isset($_POST['sendCopy']) ? "checked" : ""?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
                        <input type="text" placeholder="Upišite Vas email" id="email" name="email" />
                    </label>
					<input type="hidden" name="orderType" id="orderType" value="standarna-koverta">
					<input type="hidden" id="successMessage" value="Standardna koverta je uspešno naručena.">
                    <!-- POSALJI DUGME -->
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
<!-- JS files -->
<script src="../../js/main.js"></script>
</body>

</html>