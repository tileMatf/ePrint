<?php

require_once "../connection.php";
require_once '../mail.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['submit'])) {
	try{
		//$db = new DB();

		date_default_timezone_set('Europe/Belgrade');
		$target_dir = "uploaded_file/";
		$target_binding_dir = "uploaded_binding_file/";	
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$status = 0;
		$fileStatus = 0;
		$bindingFileStatus = 0;
		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);	
		
		// Check if file is a actual image or fake image
	/*	if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);		
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
				$status = 1;
			} 		
		}
	*/	

		// Allow certain file formats	
		if($fileType != "pdf" && $fileType != "jpg") {
//			$statusMessage = "Sorry, only PDF & JPG files are allowed.";
			$statusMessage = "Greška, dozvoljene su samo PDF i JPG datoteke.";
			$uploadOk = 0;
			$fileStatus = 1;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
//			$statusMessage .= "Sorry, your file was not uploaded.";
			$statusMessage .= " Vaša datoteka nije otpremljena.";
		// if everything is ok, try to upload file
		} else {
			// Check if file already exists
			if (file_exists($target_file)) {
				unlink($target_file);
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
//				$statusMessage = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				$statusMessage = "Datoteka ". basename( $_FILES["fileToUpload"]["name"]). " je otpremljena.";
				$fileStatus = 2;			
			}
			else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//$uploadOk = $db->uploadFile($target_file);
				if($uploadOk == 1){
//					$statusMessage = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					$statusMessage = "Datoteka ". basename( $_FILES["fileToUpload"]["name"]). " je otpremljena.";
					$fileStatus = 3;
				} else {
//					$statusMessage = "Sorry, there was an error uploading your file to database.";
					$statusMessage = "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u bazu podataka.";
					$fileStatus = 4;
				}
			} else {
//				$statusMessage = "Sorry, there was an error uploading your file to file system.";
				$statusMessage = "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u sistem datoteka.";			
				$fileStatus = 5;
			}
		}
		if(!empty($_FILES['bindingFileToUpload']['name'])){		
			$target_binding_file = $target_binding_dir . basename($_FILES["bindingFileToUpload"]["name"]);	
			$bindingFileType = pathinfo($target_binding_file,PATHINFO_EXTENSION);
			
			// Allow certain file formats for binding
			if($bindingFileType != "pdf" && $bindingFileType != "jpg") {
//				$statusMessage = "Sorry, only PDF & JPG files are allowed.";			
				$statusMessage = "Greška, dozvoljene su samo PDF i JPG datoteke.";
				$uploadOk = 0;
				$bindingFileStatus = 1;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
//				$statusMessage = "Sorry, your file was not uploaded.";
				$statusMessage = "Oprostite, Vaša datoteka nije otpremljena.";
			// if everything is ok, try to upload file
			} else {
				// Check if file already exists
				if (file_exists($target_binding_file)) {
					unlink($target_binding_file);
					move_uploaded_file($_FILES["bindingFileToUpload"]["tmp_name"], $target_binding_file);
//					$statusMessage = "The file ". basename( $_FILES["bindingFileToUpload"]["name"]). " has been uploaded.";
					$statusMessage = "Datoteka ". basename( $_FILES["bindingFileToUpload"]["name"]). " je otpremljena.";
					$bindingFileStatus = 2;			
				}
				else if (move_uploaded_file($_FILES["bindingFileToUpload"]["tmp_name"], $target_binding_file)) {
					//$uploadOk = $db->uploadFile($target_file);
					if($uploadOk == 1){
//						$statusMessage = "The file ". basename( $_FILES["bindingFileToUpload"]["name"]). " has been uploaded.";
						$statusMessage = "Datoteka ". basename( $_FILES["bindingFileToUpload"]["name"]). " je otpremljena.";
						$bindingFileStatus = 3;
					} else {
//						$statusMessage = "Sorry, there was an error uploading your file to database.";
						$statusMessage = "Oprostite, došlo je do greške prilikom otpremanja datoteke u bazu podataka.";
						$bindingFileStatus = 4;
					}
				} else {
//					$statusMessage = "Sorry, there was an error uploading your file to file system.";			
					$statusMessage = "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u sistem datoteka.";
					$bindingFileStatus = 5;
				}
			}
		}	
		
		$message = 
			'<html>
				<head><title> </title></head>
				<body>
					<label> Korisnik: </label> korisnik123 </br>
					<label> Datum: </label> '.date("d.m.Y.").' </br>
					<label> Vreme: </label> '.date("h:i").' </br>
					<label> Tip: </label> stampanje </br>
					<label> Datoteka: </label> '.basename( $_FILES["fileToUpload"]["name"]).' </br>
					<label> Izabrane opcije: </label> </br>
					<ul>
						<li>Broj primeraka: '.$_POST['noInput'].'</li>
						<li>Redosled stampanja: '.$_POST['orderOfInput'].'</li>
						<li>Boja: '.$_POST['colorOfInput'].'</li>
						<li>Nacin stampanja: '.$_POST['typeOfPrint'].'</li>
						<li>Velicina papira: '.$_POST['paperSize'].'</li>
						<li>Debljina papira: '.$_POST['paperWidth'].'</li>
						<li>Koricenje: '.$_POST['bindingType'].'</li>
						<li>Dodate korice: ';
				if(!empty($_FILES['bindingFileToUpload']['name'])){
					$message = $message . 'DA</li>
						<li>Naziv datoteke za korice: '. basename( $_FILES["bindingFileToUpload"]["name"]). '</li>';
				} else {
					$message = $message . 'NE</li>';
				}
				
				
		$message = $message . '
						<li>Heftanje: '.$_POST['heftingType'].'</li>
						<li>Busenje: '.$_POST['drillingType'].'</li>
						<li>Komentar korisnika: '. test_input($_POST['comment']).'</li>
					</ul>
				</body>
			</html>';
		
		
		if(!isset($_POST['sendCopy']))
			$mailStatus = sendMail($message);
		else {
			$mailStatus = sendMail($message, $_POST['userEmail']);		
		}
		
		$status = false;
		if(($fileStatus === 2 || $fileStatus === 3) && $mailStatus === true){
			if(!empty($_FILES['bindingFileToUpload']['name'])){
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

  <!-- JS files -->
  <script src="../js/main.js"></script>
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
        <!--NAVIGATION HEADER-->
        <div class="six columns navigation__header">
          <div class="navigation__header--nav">
            <ul class="nav nav-reg-log">
              <li>
                <a href="#0" class="cd-signin">Uloguj se
                  <i class="fas fa-user-plus" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#0" class="cd-signup">Registruj se
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

  
 
    <!-- Navigation 2 -->
    <div class="twelve columns">
      <ul class="nav1">
        <li>
          <a class="tile" href="../">
            <i class="fas fa-home" aria-hidden="true"></i>Pocetna</a>
        </li>
        <span class="line">/</span>
        <li>
          <a class="tile" href="./" style="font-size: 1.6rem;">Stampanje</a>
        </li>
      </ul>
    </div>
    <!-- End of navigation -->

    <!--Stampanje section-->
    <section class="section__stampanje">
      <div class="container">
        <h2 class="section__heading">Stampanje</h2>
      </div>

      <!-- OVDE POCINJE FORMA ZA ***STAMPANJE*** -->
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
            <label class="label__heading">Okacite Vas fajl</label>
		    <input type='file' name='fileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf' required>		

            <!-- BROJ PRIMERAKA ***************************** -->
            <label for="noInput" class="label__heading">Broj primeraka</label>
            <input name="noInput" type="number" value="1" class="u-full-width" required>
            <!-- Redosled primeraka -->
            <label class="label__heading">Slozi stranice</label>
            <label for="orderOfInput1">
              <input type="radio" id="orderOfInput1" name="orderOfInput" value="1,2,3; 1,2,3; 1,2,3" checked />
              <span>1,2,3; 1,2,3; 1,2,3</span>
            <label for="orderOfInput2">
              <input type="radio" id="orderOfInput2" name="orderOfInput" value="1,1,1; 2,2,2; 3,3,3" />
              <span>1,1,1; 2,2,2; 3,3,3</span>
            </label>
            <!-- ***************************** -->

            <!-- BOJA ***************************** -->
            <label class="label__heading">Boja</label>
            <label for="colorBlack">
              <input type="radio" id="colorBlack" name="colorOfInput" value="Crno-belo" checked />
              <span>Crno belo</span>
            </label>
            <label for="colorAll">
              <input type="radio" id="colorAll" name="colorOfInput" value="U boji" />
              <span>U boji</span>
            </label>
            <!-- ***************************** -->

            <!-- JEDNOSTRANO/DVOSTRANO  ***************************** -->
            <label class="label__heading">Jednostrano / Dvostrano</label>
            <label for="onePagePrint">
              <input type="radio" id="onePagePrint" name="typeOfPrint" value="Jednostrano" checked />
              <span>Jednostrano</span>
            </label>
            <label for="bothPagePrint">
              <input type="radio" id="bothPagePrint" name="typeOfPrint" value="Dvostrano" />
              <span>Dvostrano</span>
            </label>
            <!-- ***************************** -->

            <!-- VELICINA PAPIRA -->
            <label class="label__heading">Velicina papira</label>
            <label for="paperSizeA4">
              <input type="radio" id="paperSizeA4" name="paperSize" value="A4" checked />
              <span>A4</span>
            </label>
            <label for="paperSizeA3">
              <input type="radio" id="paperSizeA3" name="paperSize" value="A3" />
              <span>A3</span>
            </label>
            <!-- ***************************** -->

            <!-- DEBILJINA PAPIRA -->
            <label class="label__heading">Debljina papira</label>
            <label for="paperWidth80">
              <input type="radio" id="paperWidth80" name="paperWidth" value="80gr/m2" checked />
              <span>80 gr/m<sup>2</sup></span>
            </label>
            <label for="paperWidth100">
              <input type="radio" id="paperWidth100" name="paperWidth" value="100gr/m2" />
              <span>100 gr/m<sup>2</sup></span>
            </label>
            <!-- ***************************** -->


            <!-- KORICENJE -->
            <label class="label__heading">Koricenje</label>
            <label for="bindingTypePlastic">
              <input type="radio" id="bindingTypePlastic" name="bindingType" value="Plasticnom spiralom" checked />
              <span>Plasticnom spiralom</span>
            </label>
            <label for="bindingTypeWire">
              <input type="radio" id="bindingTypeWire" name="bindingType" value="Zicanom spiralom" />
              <span>Zicanom spiralom</span>
            </label>
            <label for="bindingTypeHard">
              <input type="radio" id="bindingTypeHard" name="bindingType" value="Tvrdo koricenje" />
              <span>Tvrdo koricenje</span>
            </label>
            <!-- Upload korice dugme -->
            <!--<input class="button-primary" type="submit" value="Upload korice">-->
            <label class="label__heading">Okacite koricu</label>
			      <input type='file' name='bindingFileToUpload' accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf'>
            <!-- ***************************** -->

            <!-- HEFTANJE -->
              <label for="heftingType" class="label__heading">Heftanje</label>
              <select class="u-full-width" name="heftingType">
                <option value="Gore levo" selected>Gore levo</option>
                <option value="Gore desno">Gore desno</option>
                <option value="Dole levo">Dole levo</option>
                <option value="Dole desno">Dole desno</option>
                <option value="Po sredini levo">Po sredini levo</option>
                <option value="Po sredini desno">Po sredini desno</option>
                <option value="Po sredini gore">Po sredini gore</option>
                <option value="Po sredini dole">Po sredini dole</option>
              </select>
            <!-- ***************************** -->


            <!-- BUSENJE -->
              <label for="drillingType" class="label__heading">Busenje</label>
              <select class="u-full-width" name="drillingType">
                <option value="Dve rupe za registrator levo" selected>Dve rupe za registrator levo</option>
                <option value="Dve rupe za registrator desno">Dve rupe za registrator desno</option>
                <option value="Dve rupe za registrator gore">Dve rupe za registrator gore</option>
                <option value="Dve rupe za registrator dole">Dve rupe za registrator dole</option>
              </select>
            <!-- ***************************** -->

            <!-- Krajnja poruka -->
            <label for="message" class="label__heading">Poruka</label>
            <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"></textarea>
            <label class="sendCopy">
              <input type="checkbox" id="sendCopy" name="sendCopy">
              <span class="label-body">Posalji kopiju sebi</span>
            </label>
            <input class="button-primary" type="submit" value="Posalji" name="submit"/>
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
                                    <a href="./">Stampanje</a>
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