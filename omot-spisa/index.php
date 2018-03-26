<?php

require_once '../functions/mail.php';
require_once '../functions/functions.php';

if(isset($_POST['submit'])) {
	try{
		echo "<div id='pictureModal' class='picture-modal'>
			 <span class='picture-close'>&times;</span>
			  <img id='pictureContent' class='picture-modal-content' 
				src='../functions/createPicture.php?". http_build_query($_POST) ."'>
			 <button id='paymentConfirm'>Ok</button>
			</div>";
				
		$fileStatus = uploadFile("uploaded_file/");
		$fileStatusMessage = generateMessage($fileStatus); 
	
		if($fileStatus === 2 || $fileStatus === 3){
			$fileStatus = true;
		} else {
			$fileStatus = false;
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Omot spisa</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading">Omot Spisa</h2>

            <!-- OVDE POCINJE FORMA ** -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="form-box">
				<!-- Paragraf za povratnu poruku -->		
				<p style="font-size:2rem; font-style: italic;" id="statusMessage"></p>

                    <!-- ZA -->
                    <label class="label__heading">Za</label>
                    <label for="Javni izvrsitelj">
                        <input type="radio" name="forInput" id="Javni izvrsitelj" value="Javni izvrsitelj" 
							<?php echo (isset($_POST['forInput']) && $_POST['forInput'] == 'Javni izvrsitelj') || !isset($_POST['forInput']) ? "checked" : "" ?> >
                        <span>Javni izvršitelj</span>
                    </label>
                    <label for="Javni beleznik">
                        <input type="radio" name="forInput" id="Javni beleznik" value="Javni beleznik"
							<?php echo isset($_POST['forInput']) && $_POST['forInput'] == 'Javni beleznik' ? "checked" : ""?>>
                        <span>Javni beležnik</span>
                    </label>
                    <label for="Advokat">
                        <input type="radio" name="forInput" id="Advokat" value="Advokat" 
							<?php echo isset($_POST['forInput']) && $_POST['forInput'] == 'Advokat' ? "checked" : ""?>>
                        <span>Advokat</span>
                    </label>
                    <!-- ***************************** -->

                    <!--Ime i prezime ******************************-->
                    <label for="nameLastname" class="label__heading">Ime i prezime</label>
                    <input name="nameLastname" class="u-full-width" type="text" 
						value="<?php echo isset($_POST['nameLastname']) ? $_POST['nameLastname'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--Ulica ******************************-->
                    <label for="address" class="label__heading">Ulica</label>
                    <input name="address" class="u-full-width" type="text" 
						value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--Mesto ******************************-->
                    <label for="location" class="label__heading">Mesto</label>
                    <input name="location"  class="u-full-width" type="text" 
						value="<?php echo isset($_POST['location']) ? $_POST['location'] : '' ?>" >
                    <!-- ***************************** -->

                    <!-- Vrsta papira ***************************** -->
                    <label class="label__heading">Vrsta papira</label>
                    <label for="100gr/m2">
                        <input type="radio" name="typeOfPaper" id="100gr/m2" value="100gr/m2" 
							<?php echo (isset($_POST['typeOfPaper']) && $_POST['typeOfPaper'] == '100gr/m2') || !isset($_POST['typeOfPaper']) ? "checked" : "" ?>>
                        <span>100gr/m<sup>2</span>
                    </label>
                    <label for="300gr/m2" class="label__heading">
                        <input type="radio" name="typeOfPaper" id="300gr/m2" value="300gr/m2" 
							<?php echo isset($_POST['typeOfPaper']) && $_POST['typeOfPaper'] == '300gr/m2' ? "checked" : ""?>>
                        <span>300gr/m<sup>2</span>
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
                    </select>
                    <!-- ***************************** -->

                    <!-- Krajnja poruka -->
                        <label for="message" class="label__heading">Poruka</label>
                        <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment">
							<?php echo isset($_POST['comment']) ? $_POST['comment'] : ''?>
						</textarea>
                        <label class="sendCopy">
                            <input type="checkbox" id="sendCopy" name="sendCopy" 
								<?php echo isset($_POST['sendCopy']) ? 'checked' : ''?>>
                            <span class="label-body">Pošalji kopiju sebi</span>
                            <input type="text" placeholder="Upišite Vas email" id="email" name="email" />
                        </label>
						<input type="hidden" name="orderType" id="orderType" value="omot-spisa">
						<input type="hidden" id="successMessage" value="Omot spisa je uspešno naručen.">
						<input type="hidden" name="fileStatus" value="<?php if(isset($fileStatus)) echo $fileStatus;?>">
                        <input class="button-primary" type="submit" value="Pošalji" name="submit" >
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
                                    <a href="../blokovi">Preslikavajući blokovi</a>
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