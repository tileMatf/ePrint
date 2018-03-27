<?php

//require_once "../connection.php";
require_once '../functions/mail.php';
require_once '../functions/functions.php';

if(isset($_POST['submit'])) {
	try{
		$status = 0;
		$fileStatus = 0;
		$bindingFileStatus = 0;	
		
		$fileStatus = uploadFile("uploaded_file/");
		$statusMessage = generateMessage($fileStatus);
		if($fileStatus !== 2 && $fileStatus !== 3)
			return false;
	
		if(!empty($_FILES['bindingFileToUpload']['name'])){
			$bindingFileStatus = uploadFile("uploaded_binding_file/");		
			if($bindingFileStatus !== 2 && $bindingFileStatus !== 3){
				$statusMessage = generateMessage($bindingFileStatus);
				return false;
			}
		}
	
		$message = makeMessage('stampanje');
		
		$status = false;
		if($fileStatus === 2 || $fileStatus === 3){
			if(!empty($files['bindingFileToUpload']['name'])){
				if($bindingFileStatus === 2 || $bindingFileStatus === 3){
					$status = true;
				} else {
					$status = false;
				}
			} else {
				$status = true;
			}
		} else {
			$status = false;
		}

		if($status === true) {
			if(!isset($post['sendCopy']))
				$status = sendMail($message);
			else {
				$status = sendMail($message, $_POST['sendCopyEmail']);		
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

  
 
    <!-- Navigation 2 -->
    <div class="twelve columns">
      <ul class="nav1">
        <li>
          <a class="tile" href="../">
            <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
        </li>
        <span class="line">/</span>
        <li>
          <a class="tile" href="./" style="font-size: 1.6rem;">Štampanje</a>
        </li>
      </ul>
    </div>
    <!-- End of navigation -->

    <!--Stampanje section-->
    <section class="section__stampanje">
      <div class="container">
        <h2 class="section__heading">Štampanje</h2>
      </div>

      <!-- OVDE POCINJE FORMA ZA ***STAMPANJE*** -->
      <form method="POST" name="orderType" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
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
            <input type='file' name='fileToUpload' id="file" class="inputfile" accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>			
            <label for="file"><i class="fa-upload fas fa-upload"></i><span>Okačite fajl</span></label>
            <!-- BROJ PRIMERAKA ***************************** -->
            <label for="noInput" class="label__heading">Broj primeraka</label>
            <input name="noInput" type="number" value="1" class="u-full-width">
            <!-- Redosled primeraka -->
            <label class="label__heading">Složi stranice</label>
            <label for="1,2,3; 1,2,3; 1,2,3">
              <input type="radio" name="orderOfInput" id="1,2,3; 1,2,3; 1,2,3" value="1,2,3; 1,2,3; 1,2,3"
				<?php echo (isset($_POST['orderOfInput']) && $_POST['orderOfInput'] == '1,2,3; 1,2,3; 1,2,3') || !isset($_POST['orderOfInput']) ? "checked" : "" ?>>
              <span>1,2,3; 1,2,3; 1,2,3</span>
            <label for="orderOfInput2">
              <input type="radio" name="orderOfInput" id="1,1,1; 2,2,2; 3,3,3" value="1,1,1; 2,2,2; 3,3,3" 
				<?php echo (isset($_POST['orderOfInput']) && $_POST['orderOfInput1'] == '1,1,1; 2,2,2; 3,3,3') ? "checked" : "" ?>>
              <span>1,1,1; 2,2,2; 3,3,3</span>
            </label>
            <!-- ***************************** -->

            <!-- BOJA ***************************** -->
            <label class="label__heading">Boja</label>
            <label for="Crno-belo">
              <input type="radio" name="colorOfInput" id="Crno-belo" value="Crno-belo" 
				<?php echo (isset($_POST['colorOfInput']) && $_POST['colorOfInput'] == 'Crno-belo') || !isset($_POST['colorOfInput']) ? "checked" : "" ?>>
              <span>Crno belo</span>
            </label>
            <label for="U boji">
              <input type="radio" name="colorOfInput" id="U boji" value="U boji"
				<?php echo (isset($_POST['colorOfInput']) && $_POST['colorOfInput'] == 'U boji') ? "checked" : "" ?>>
              <span>U boji</span>
            </label>
            <!-- ***************************** -->

            <!-- JEDNOSTRANO/DVOSTRANO  ***************************** -->
            <label class="label__heading">Jednostrano / Dvostrano</label>
            <label for="Jednostrano">
              <input type="radio" name="typeOfPrint" id="Jednostrano" value="Jednostrano" 
				<?php echo (isset($_POST['typeOfPrint']) && $_POST['typeOfPrint'] == 'Jednostrano') || !isset($_POST['typeOfPrint']) ? "checked" : "" ?>>
              <span>Jednostrano</span>
            </label>
            <label for="Dvostrano">
              <input type="radio" name="typeOfPrint" id="Dvostrano" value="Dvostrano" 
				<?php echo (isset($_POST['typeOfPrint']) && $_POST['typeOfPrint'] == 'Dvostrano') ? "checked" : "" ?>>
              <span>Dvostrano</span>
            </label>
            <!-- ***************************** -->

            <!-- VELICINA PAPIRA -->
            <label class="label__heading">Veličina papira</label>
            <label for="A4">
              <input type="radio" name="paperSize" id="A4" value="A4"
				<?php echo (isset($_POST['paperSize']) && $_POST['paperSize'] == 'A4') || !isset($_POST['paperSize']) ? "checked" : "" ?>>
              <span>A4</span>
            </label>
            <label for="A3">
              <input type="radio" name="paperSize" id="A3" value="A3" 
				<?php echo (isset($_POST['paperSize']) && $_POST['paperSize'] == 'A3') ? "checked" : "" ?>>
              <span>A3</span>
            </label>
            <!-- ***************************** -->

            <!-- DEBILJINA PAPIRA -->
            <label class="label__heading">Debljina papira</label>
            <label for="80">
              <input type="radio" id="80" name="paperWidth" value="80gr/m2" 
				<?php echo (isset($_POST['paperWidth']) && $_POST['paperWidth'] == '80gr/m2') || !isset($_POST['paperWidth']) ? "checked" : "" ?>>
              <span>80 gr/m<sup>2</sup></span>
            </label>
            <label for="100">
              <input type="radio" id="100" name="paperWidth" value="100gr/m2" 
				<?php echo (isset($_POST['paperWidth']) && $_POST['paperWidth'] == '100gr/m2') ? "checked" : "" ?>>
              <span>100 gr/m<sup>2</sup></span>
            </label>
            <!-- ***************************** -->


            <!-- KORICENJE -->
            <label class="label__heading">Koričenje</label>
            <label for="bindingTypePlastic">
              <input type="radio" id="bindingTypePlastic" name="bindingType" value="Plasticnom spiralom"
				<?php echo (isset($_POST['bindingType']) && $_POST['bindingType'] == 'Plasticnom spiralom') || !isset($_POST['bindingType']) ? "checked" : "" ?>>
              <span>Plastičnom spiralom</span>
            </label>
            <label for="bindingTypeWire">
              <input type="radio" id="bindingTypeWire" name="bindingType" value="Zicanom spiralom" 
				<?php echo (isset($_POST['bindingType']) && $_POST['bindingType'] == 'Zicanom spiralom') ? "checked" : "" ?>>
              <span>Žičanom spiralom</span>
            </label>
            <label for="bindingTypeHard">
              <input type="radio" id="bindingTypeHard" name="bindingType" value="Tvrdo koricenje"
				<?php echo (isset($_POST['bindingType']) && $_POST['bindingType'] == 'Tvrdo koricenje') ? "checked" : "" ?>>
              <span>Tvrdo koričenje</span>
            </label>
            <!-- Upload korice dugme -->
            <label class="label__heading">Okačite koricu</label>
			      <input type='file' name='bindingFileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf'>
            <!-- ***************************** -->

            <!-- HEFTANJE -->
              <label for="heftingType" class="label__heading">Heftanje</label>
              <select class="u-full-width" name="heftingType">
                <option value="Gore levo" selected>Gore levo</option>
                <option value="Gore desno" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Gore desno' ? "selected" : "" ?>>Gore desno</option>
                <option value="Dole levo" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Dole levo' ? "selected" : "" ?>>Dole levo</option>
                <option value="Dole desno" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Dole desno' ? "selected" : "" ?>>Dole desno</option>
                <option value="Po sredini levo" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Po sredini levo' ? "selected" : "" ?>>Po sredini levo</option>
                <option value="Po sredini desno" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Po sredini desno' ? "selected" : "" ?>>Po sredini desno</option>
                <option value="Po sredini gore" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Po sredini gore' ? "selected" : "" ?>>Po sredini gore</option>
                <option value="Po sredini dole" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Po sredini dole' ? "selected" : "" ?>>Po sredini dole</option>
              </select>
            <!-- ***************************** -->


            <!-- BUSENJE -->
              <label for="drillingType" class="label__heading">Bušenje</label>
              <select class="u-full-width" name="drillingType">
                <option value="Dve rupe za registrator levo" selected>Dve rupe za registrator levo</option>
                <option value="Dve rupe za registrator desno" <?php echo isset($_POST['drillingType']) && $_POST['drillingType'] == 'Dve rupe za registrator desno' ? "selected" : "" ?>>Dve rupe za registrator desno</option>
                <option value="Dve rupe za registrator gore" <?php echo isset($_POST['drillingType']) && $_POST['drillingType'] == 'Dve rupe za registrator gore' ? "selected" : "" ?>>Dve rupe za registrator gore</option>
                <option value="Dve rupe za registrator dole" <?php echo isset($_POST['drillingType']) && $_POST['drillingType'] == 'Dve rupe za registrator dole' ? "selected" : "" ?>>Dve rupe za registrator dole</option>
              </select>
            <!-- ***************************** -->

            <!-- Krajnja poruka -->
            <label for="message" class="label__heading">Poruka</label>
            <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : "" ?></textarea>
            <label class="sendCopy" for="sendCopy">
              <input type="checkbox" id="sendCopy" name="sendCopy" 
				<?php echo isset($_POST['sendCopy']) ? "checked" : "" ?>>
              <span class="label-body">Pošalji kopiju sebi</span>
              <input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail">
            </label>
			<input type="hidden" name="orderType" id="orderType" value="stampanje">
			<input type="hidden" id="successMessage" value="Uspešno naručeno.">
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
                                    <a href="./">Štampanje</a>
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
