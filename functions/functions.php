<?php

require dirname(__FILE__) . '../../vendor/autoload.php';
require 'stringFunctions.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function uploadFile($target_dir){

	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$fileStatus = 0;
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);	

	// Check if file is a actual image or fake image
	/*$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);		
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
		$status = 1;
	} 		
	*/
	
	if(!empty($_FILES["fileToUpload"]['name'])){
		// Allow certain file formats	
		if($fileType != "pdf" && $fileType != "jpg") {
			$statusMessage = "Greška, dozvoljene su samo PDF i JPG datoteke.";
			$uploadOk = 0;
			$fileStatus = 1;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
				$statusMessage .= " Vaša datoteka nije otpremljena.";
		// if everything is ok, try to upload file
		} else {
			// Check if file already exists
			if (file_exists($target_file)) {
				unlink($target_file);
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"]);
				$statusMessage = "Datoteka ". $_FILES["fileToUpload"]["name"] . " je otpremljena.";;
				$fileStatus = 2;			
			}
			else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//$uploadOk = $db->uploadFile($target_file);
				if($uploadOk == 1){
					$statusMessage = "Datoteka ". basename($_FILES["fileToUpload"]["name"]). " je otpremljena.";
					$fileStatus = 3;
				} else {
					$statusMessage = "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u bazu podataka.";
					$fileStatus = 4;
				}
			} else {
				$statusMessage = "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u sistem datoteka.";			
				$fileStatus = 5;
			}
		}	
	}
	return $fileStatus;
}

function generateMessage($status){
	if($status === 1)
		return "Greška, dozvoljene su samo PDF i JPG datoteke.";
	else if($status === 2)
		return "Datoteka ". $file["name"] . " je otpremljena.";
	else if($status === 3)
		return "Datoteka ". basename($_FILES["fileToUpload"]["name"]). " je otpremljena.";
	else if($status === 4)
		return "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u bazu podataka.";
	else if($status === 5)
		return "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u sistem datoteka.";
}

function makeMessage($type){
	$data = $_POST['data'];	
	parse_str($data, $data);
	
	if($type === 'stampanje'){
		$message = 
			'<html>
				<head><title> </title></head>
				<body>
					<label> Korisnik: </label> korisnik123 </br>
					<label> Datum: </label> '.date("d.m.Y.").' </br>
					<label> Vreme: </label> '.date("h:i").' </br>
					<label> Tip: </label> stampanje </br>
					<label> Datoteka: </label> '.basename($files["fileToUpload"]["name"]).' </br>
					<label> Izabrane opcije: </label> </br>
					<ul>
						<li>Broj primeraka: '.$data['noInput'].'</li>
						<li>Redosled stampanja: '.$data['orderOfInput'].'</li>
						<li>Boja: '.$data['colorOfInput'].'</li>
						<li>Nacin stampanja: '.$data['typeOfPrint'].'</li>
						<li>Veličina papira: '.$data['paperSize'].'</li>
						<li>Debljina papira: '.$data['paperWidth'].'</li>
						<li>Koričenje: '.$data['bindingType'].'</li>
						<li>Dodate korice: ';
				if(!empty($_FILES['bindingFileToUpload']['name'])){
					$message = $message . 'DA</li>
						<li>Naziv datoteke za korice: '. basename( $_FILES["bindingFileToUpload"]["name"]). '</li>';
				} else {
					$message = $message . 'NE</li>';
				}
				
				
		$message = $message . '
						<li>Heftanje: '.$data['heftingType'].'</li>
						<li>Bušenje: '.$data['drillingType'].'</li>
						<li>Komentar korisnika: '. test_input($data['comment']).'</li>
					</ul>
				</body>
			</html>';
	} else if($type === 'nalog-za-isplatu' || $type === 'nalog-za-uplatu' || $type === 'nalog-za-prenos'){
		$message = 
			'<html>
				<head><title> </title></head>
				<body>
					<label> Korisnik: </label> korisnik123 </br>
					<label> Datum: </label> '.date("d.m.Y.").' </br>
					<label> Vreme: </label> '.date("h:i").' </br>';
					if($type === 'nalog-za-uplatu')
						$message .= '<label> Tip: </label> Nalog za uplatu </br>';
					else if($type === 'nalog-za-prenos')
						$message .= '<label> TIP: </label> Nalog za prenos </br>';
					else
						$message .= '<label> Tip: </label> Nalog za isplatu </br>';
					if($type === 'nalog-za-uplatu' || $type === 'nalog-za-isplatu'){
						$message .= '<label> Izabrane opcije: </label> </br>
								<ul>
									<li>Platilac: '.$data['payer'].'</li>
									<li>Svrha uplate: '.$data['purposeOfPayment'].'</li>
									<li>Primalac: '.$data['recipient'].'</li>
									<li>Šifra plaćanja: '.$data['paymentCode'].'</li>
									<li>Valuta: '.$data['currency'].'</li>
									<li>Iznos: '.$data['amount'].'</li>
									<li>Račun primaoca: '.$data['accountOfRecipient'].'</li>				
									<li>Model: '.$data['mockUp'].'</li>
									<li>Poziv na broj: '.$data['referenceNumber'].'</li>';
					} else {
						$message .= '<label> Izabrane opcije: </label> </br>
								<ul>
									<li>Platilac: '.$data['payer'].'</li>
									<li>Svrha uplate: '.$data['purposeOfPayment'].'</li>
									<li>Primalac: '.$data['recipient'].'</li>
									<li>Šifra plaćanja: '.$data['paymentCode'].'</li>
									<li>Valuta: '.$data['currency'].'</li>
									<li>Iznos: '.$data['amount'].'</li>
									<li>Račun nalogodavca: '.$data['accountOfOrderer'].'</li>				
									<li>Model (zaduženje): '.$data['mockUpDebit'].'</li>
									<li>Poziv na broj (zaduženje): '.$data['referenceNumber'].'</li>
									<li>Račun primaoca: '.$data['accountOfRecipient'].'</li>				
									<li>Model (odobrenje): '.$data['mockUpApproval'].'</li>
									<li>Poziv na broj (odobrenje): '.$data['referenceNumberApprovals'].'</li>';						
					}
					$message .=	'<li>Broj naloga u setu: '. test_input($data['numOfPaySet']) . '</li>		
						<li>Količina setova: '. test_input($data['quantity']) . '</li>
						<li>Varijabilni podaci: ';
					if(isset($data['varData']))
						$message = $message . 'DA </li>';
					else
						$message = $message . 'NE </li>';
					$message .= '<li>Komentar korisnika: ' . test_input($data['comment']) . '</li>
				</ul>
			</body>
		</html>';		
	}
	else if($type === 'blokovi'){
		$message = 
		'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Preslikavajući blokovi </br>
				<label> Datoteka: </label> '.basename( $_FILES["fileToUpload"]["name"]).' </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Broj setova: '.$data['noOfSet'].'</li>
					<li>Boja: '.$data['blockColor'].'</li>
					<li>Veličina: '.$data['blockSize'].'</li>
					<li>Pakovanje: '.$data['packing'].'</li>
					<li>Komentar korisnika: '. test_input($data['comment']).'</li>
				</ul>
			</body>
		</html>';
	}
	else if($type === 'standardne-koverte'){
			$message = 
		'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Datum: </label> '.date("d.m.Y.").' </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Standardne koverte </br>
				<label> Datoteka: </label> '.basename( $_FILES["fileToUpload"]["name"]).' </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Veličina: '.$data['size'].'</li>
					<li>Količina: '.$data['quantity'].'</li>
					<li>Štampanje na poleđini: 
						<ul>
							<li>Prvi red: '.$data['printingOnBack1'].'</li>
							<li>Drugi red: '.$data['printingOnBack2'].'</li>
							<li>Treći red: '.$data['printingOnBack3'].'</li>
							<li>Četvrti red: '.$data['printingOnBack4'].'</li>							
						</ul>
					</li>
					<li>Štampanje na adresnoj strani: 
						<ul>
							<li>Prvi red: '.$data['printingOnAdressPage1'].'</li>
							<li>Drugi red: '.$data['printingOnAdressPage2'].'</li>
							<li>Treći red: '.$data['printingOnAdressPage3'].'</li>
							<li>Četvrti red: '.$data['printingOnAdressPage4'].'</li>							
						</ul>
					</li>
					<li>Varijabilni podaci: ';
					if(isset($data['varData']))
						$message = $message . 'DA </li>';
					else
						$message = $message . 'NE </li>';					

		$message = $message .
					'<li>Komentar korisnika: '. test_input($data['comment']).'</li>
				</ul>
			</body>
		</html>';
	} else if($type === 'omot-spisa'){
		$message = 
			'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Datum: </label> '.date("d.m.Y.").' </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Omot spisa </br>
				<label> Datoteka: </label> '.basename( $_FILES["fileToUpload"]["name"]).' </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Za: '.$data['forInput'].'</li>
					<li>Ime i prezime: '.test_input($data['nameLastname']).'</li>
					<li>Ulica: '.test_input($data['adress']).'</li>
					<li>Poštanski broj: '.test_input($data['zipCode']).'</li>
					<li>Mesto: '.test_input($data['location']).'</li>
					<li>Vrsta papira: '.$data['typeOfPaper'].'</li>
					<li>Količina: '.$data['quantity'].'</li>
					<li>Komentar korisnika: '. test_input($data['comment']).'</li>
				</ul>
			</body>
		</html>';
	} else if($type === 'koverte-sa-povratnicom'){
		$message = 
			'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Datum: </label> '.date("d.m.Y.").' </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Koverta sa povratnicom za štampanje</br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Boja: '.$data['color'].'</li>
					<li>Količina: '.$data['quantity'].'</li>
				</ul>
			</body>
		</html>';
	} else if($type === 'dostavnica'){
		$message = 
			'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Datum: </label> '.date("d.m.Y.").' </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Dostavnica </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Za: '.$data['forInput'].'</li>
					<li>Ime i prezime: '.test_input($data['nameLastname']).'</li>
					<li>Ulica: '.test_input($data['adress']).'</li>
					<li>Poštanski broj: '.test_input($data['zipCode']).'</li>
					<li>Mesto: '.test_input($data['location']).'</li>
					<li>Količina: '.$data['quantity'].'</li>
				</ul>
			</body>
		</html>';
	} else if($type === 'koverte-sa-dostavnicom'){
		$message = 
			'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Datum: </label> '.date("d.m.Y.").' </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Koverta sa dostavnicom za lično popunjavanje </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Za: '.$data['forInput'].'</li>
					<li>Boja: '.$data['color'].'</li>
					<li>Ime i prezime: '.test_input($data['nameLastname']).'</li>
					<li>Ulica: '.test_input($data['adress']).'</li>
					<li>Poštanski broj: '.test_input($data['zipCode']).'</li>
					<li>Mesto: '.test_input($data['location']).'</li>
					<li>Poštarina plaćena kod: '.test_input($data['postagePaid']).'</li>
					<li>Količina: '.$data['quantity'].'</li>
				</ul>
			</body>
		</html>';
	} else if($type === 'formulari-za-adresiranje'){
		$message = 
			'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Datum: </label> '.date("d.m.Y.").' </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Formular za adresiranje </br>
				<label> Izabrane opcije: </label> </br>
				<ul>					
					<li>Količina: '.$data['quantity'].'</li>
				</ul>
			</body>
		</html>';
	}
	return $message;		
}

function createPicture($type) {
	if($type === 'nalog-za-uplatu' || $type === 'nalog-za-isplatu' || $type === 'nalog-za-prenos'){
		return createPaymentOrder($type);
	}
	return false;
}

function createPaymentOrder($type){	
	
	$image = imagecreatefromjpeg(dirname(__FILE__) . '/Image/' . $type . '.jpg');
    $black = imagecolorallocate($image, 0, 0, 0);
    $font_path = dirname(__FILE__) . '/Font/OpenSans-Regular.ttf';
	$name = $_POST['payer'];
	$adress = $_POST['address'] . ", " . $_POST['location'];
	$country = $_POST['country'];	
	
	if($type === 'nalog-za-isplatu'){
		imagettftext($image, 15, 0, 75, 112, $black, $font_path, $name);
		imagettftext($image, 15, 0, 75, 135, $black, $font_path, $adress);
		imagettftext($image, 15, 0, 75, 158, $black, $font_path, $country);
	} else if($type === 'nalog-za-uplatu'){
		imagettftext($image, 11, 0, 30, 58, $black, $font_path, $name);
		imagettftext($image, 11, 0, 30, 75, $black, $font_path, $adress);
		imagettftext($image, 11, 0, 30, 92, $black, $font_path, $country);
	} else {
		imagettftext($image, 15, 0, 80, 130, $black, $font_path, $name);
		imagettftext($image, 15, 0, 80, 152, $black, $font_path, $adress);
		imagettftext($image, 15, 0, 80, 174, $black, $font_path, $country);
	}
		
	$purposeOfPayment = $_POST['purposeOfPayment'];
	$purposeOfPayment = readjustText($purposeOfPayment);
	if($type === 'nalog-za-isplatu'){
		imagettftext($image, 15, 0, 75, 222, $black, $font_path, $purposeOfPayment);
	} else if($type === 'nalog-za-uplatu') {
		imagettftext($image, 11, 0, 30, 138, $black, $font_path, $purposeOfPayment);
	} else { 
		imagettftext($image, 15, 0, 80, 240, $black, $font_path, $purposeOfPayment);
	}
	$recipient = $_POST['recipient'];
	$recipient = readjustText($recipient);
	if($type === 'nalog-za-isplatu'){
		imagettftext($image, 15, 0, 75, 332, $black, $font_path, $recipient);
	} else if($type === 'nalog-za-uplatu'){
		imagettftext($image, 11, 0, 30, 215, $black, $font_path, $recipient);
	} else { 
		imagettftext($image, 15, 0, 80, 343, $black, $font_path, $recipient);
	}
	$paymentCode = $_POST['paymentCode'];
	if($type === 'nalog-za-isplatu'){
		imagettftext($image, 18, 0, 685, 144, $black, $font_path, $paymentCode);
	} else if($type === 'nalog-za-uplatu'){
		imagettftext($image, 12, 0, 437, 72, $black, $font_path, $paymentCode);
	} else { 
		imagettftext($image, 18, 0, 690, 145, $black, $font_path, $paymentCode);
	}
	$currency = "RSD";//$_POST['currency'];
	if($type === 'nalog-za-isplatu'){
		imagettftext($image, 18, 0, 781, 144, $black, $font_path, $currency);
    } else if($type === 'nalog-za-uplatu'){
		imagettftext($image, 12, 0, 505, 72, $black, $font_path, $currency);
	} else { 
		imagettftext($image, 18, 0, 785, 145, $black, $font_path, $currency);
	}
	$amount = $_POST['amount'];
	if($amount != ''){
			$amount = readjustAmount($amount);
		if($type === 'nalog-za-isplatu'){
			imagettftext($image, 18, 0, 882, 144, $black, $font_path, $amount);
		} else if($type === 'nalog-za-uplatu'){ 
			imagettftext($image, 12, 0, 572, 72, $black, $font_path, $amount);
		} else { 
			imagettftext($image, 18, 0, 890, 145, $black, $font_path, $amount);
		}
	}
	$accountOfRecipient = $_POST['accountOfRecipient'];
	if($type === 'nalog-za-isplatu'){
		imagettftext($image, 18, 0, 780, 210, $black, $font_path, $accountOfRecipient);
	} else if($type === 'nalog-za-uplatu'){
		imagettftext($image, 12, 0, 437, 125, $black, $font_path, $accountOfRecipient);
	} else { 
		imagettftext($image, 18, 0, 690, 339, $black, $font_path, $accountOfRecipient);
	}
	if($type !== 'nalog-za-prenos'){
		$mockUp = $_POST['mockUp'];
		if($type === 'nalog-za-isplatu'){
			imagettftext($image, 18, 0, 687, 280, $black, $font_path, $mockUp);
		} else if($type === 'nalog-za-uplatu'){
			imagettftext($image, 12, 0, 436, 171, $black, $font_path, $mockUp);
		}
		$referenceNumber = $_POST['referenceNumber'];
		if($type === 'nalog-za-isplatu'){
			imagettftext($image, 18, 0, 777, 280, $black, $font_path, $referenceNumber);
		} else if($type === 'nalog-za-uplatu'){
			imagettftext($image, 12, 0, 505, 171, $black, $font_path, $referenceNumber);
		}
	} else { //nalog-za-prenos
		$accountOfOrderer = $_POST['accountOfOrderer'];
		imagettftext($image, 18, 0, 690, 210, $black, $font_path, $accountOfOrderer);		
	
		$mockUpDebit = $_POST['mockUpDebit'];
		imagettftext($image, 18, 0, 690, 275, $black, $font_path, $mockUpDebit);
		$referenceNumber = $_POST['referenceNumber'];
		imagettftext($image, 18, 0, 790, 275, $black, $font_path, $referenceNumber);
		
		$mockUpApproval = $_POST['mockUpApproval'];
		imagettftext($image, 18, 0, 690, 403, $black, $font_path, $mockUpApproval);
		$referenceNumberApprovals = $_POST['referenceNumberApprovals'];
		imagettftext($image, 18, 0, 790, 403, $black, $font_path, $referenceNumberApprovals);
	}
		
	//date
	//imagettftext($image, 13, 0, 220, 320, $black, $font_path, date("d.m.Y."));
	
	// Send Image to Browser
    $success = imagejpeg($image, dirname(__FILE__) . "/../uplatnice/output/".$type."-popunjen.jpg");
    imagedestroy($image);
	return $success;
}
?>