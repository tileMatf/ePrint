<?php

require dirname(__FILE__) . '../../vendor/autoload.php';
require 'stringFunctions.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function uploadFile($target_dir, $file){

	$target_dir = remove_special_char($target_dir);
	if(!file_exists($target_dir)){
		$success = mkdir($target_dir, true);
		if($success  === false)
			return false;
	}
		
	$target_file = $target_dir . basename($file['name']);
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
	
	if(!empty($file)){
		// Allow certain file formats	
		if($fileType != "pdf" && $fileType != "jpg" && $fileType != "jpe" && $fileType != "jpeg" && $fileType != "png") {
			$statusMessage = "Greška, dozvoljene su samo PDF, JPG, JPEG, JPE i PNG datoteke.";
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
				$k = move_uploaded_file($file["tmp_name"], $target_file);
				$statusMessage = "Datoteka ". $file["name"] . " je otpremljena.";;
				$fileStatus = 2;			
			}
			else if (move_uploaded_file($file["tmp_name"], $target_file)) {
				//$uploadOk = $db->uploadFile($target_file);
				if($uploadOk == 1){
					$statusMessage = "Datoteka ". basename($file["name"]). " je otpremljena.";
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

function generateMessage($status, $file){
	if($status === 1)
		return "Greška, dozvoljene su samo PDF, JPG, JPEG, PNG i JPE datoteke.";
	else if($status === 2)
		return "Datoteka ". basename($file["name"]) . " je otpremljena.";
	else if($status === 3)
		return "Datoteka ". basename($file["name"]). " je otpremljena.";
	else if($status === 4)
		return "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u bazu podataka.";
	else if($status === 5)
		return "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u sistem datoteka.";
}

function makeMessage($type, $user = null){
	//$data = $_POST['data'];	
	//parse_str($data, $data);
	$message = '<html>
				<head><title> </title></head>
				<body>
					<label> Korisnik: </label> ';
				if($user != null && !empty($user))
					$message .= $user . '</br>';
				else 
					$message .= 'Neregistrovan korisnik </br>';
	$message .= '<label> Datum: </label> '.date("d.m.Y.").' </br>
				<label> Vreme: </label> '.date("h:i").' </br>';
	if($type === 'stampanje'){
		$message .= '<label> Tip: </label> stampanje </br>
					<label> Datoteka: </label> '.$_FILES["fileToUpload"]["name"].' </br>
					<label> Izabrane opcije: </label> </br>
					<ul>
						<li>Broj primeraka: '.$_POST['noInput'].'</li>
						<li>Redosled stampanja: '.$_POST['orderOfInput'].'</li>
						<li>Boja: '.$_POST['colorOfInput'].'</li>
						<li>Nacin stampanja: '.$_POST['typeOfPrint'].'</li>
						<li>Veličina papira: '.$_POST['paperSize'].'</li>
						<li>Debljina papira: '.$_POST['paperWidth'].'</li>
						<li>Koričenje: '.$_POST['bindingType'].'</li>
						<li>Dodate korice: ';
				if(!empty($_FILES['bindingFileToUpload']['name'])){
					$message = $message . 'DA</li>
						<li>Naziv datoteke za korice: '. basename( $_FILES["bindingFileToUpload"]["name"]). '</li>';
				} else {
					$message = $message . 'NE</li>';
				}
				
		$message = $message . '
						<li>Heftanje: '.$_POST['heftingType'].'</li>
						<li>Bušenje: '.$_POST['drillingType'].'</li>
						<li>Komentar korisnika: '. test_input($_POST['comment']).'</li>
					</ul>';
	} else if($type === 'uplatnice/nalog-za-isplatu' || $type === 'uplatnice/nalog-za-uplatu' || $type === 'uplatnice/nalog-za-prenos'){

					if($type === 'uplatnice/nalog-za-uplatu')
						$message .= '<label> Tip: </label> Nalog za uplatu </br>';
					else if($type === 'uplatnice/nalog-za-prenos')
						$message .= '<label> Tip: </label> Nalog za prenos </br>';
					else
						$message .= '<label> Tip: </label> Nalog za isplatu </br>';
					if($type === 'uplatnice/nalog-za-uplatu' || $type === 'uplatnice/nalog-za-isplatu'){
						$message .= '<label> Izabrane opcije: </label> </br>
								<ul>
									<li>Platilac: '.$_POST['payer'].'</li>
									<li>Svrha uplate: '.$_POST['purposeOfPayment'].'</li>
									<li>Primalac: '.$_POST['recipient'].'</li>
									<li>Šifra plaćanja: '.$_POST['paymentCode'].'</li>
									<li>Valuta: '.$_POST['currency'].'</li>
									<li>Iznos: '.$_POST['amount'].'</li>
									<li>Račun primaoca: '.$_POST['accountOfRecipient'].'</li>				
									<li>Model: '.$_POST['mockUp'].'</li>
									<li>Poziv na broj: '.$_POST['referenceNumber'].'</li>';
					} else {
						$message .= '<label> Izabrane opcije: </label> </br>
								<ul>
									<li>Platilac: '.$_POST['payer'].'</li>
									<li>Svrha uplate: '.$_POST['purposeOfPayment'].'</li>
									<li>Primalac: '.$_POST['recipient'].'</li>
									<li>Šifra plaćanja: '.$_POST['paymentCode'].'</li>
									<li>Valuta: '.$_POST['currency'].'</li>
									<li>Iznos: '.$_POST['amount'].'</li>
									<li>Račun nalogodavca: '.$_POST['accountOfOrderer'].'</li>				
									<li>Model (zaduženje): '.$_POST['mockUpDebit'].'</li>
									<li>Poziv na broj (zaduženje): '.$_POST['referenceNumber'].'</li>
									<li>Račun primaoca: '.$_POST['accountOfRecipient'].'</li>				
									<li>Model (odobrenje): '.$_POST['mockUpApproval'].'</li>
									<li>Poziv na broj (odobrenje): '.$_POST['referenceNumberApprovals'].'</li>';						
					}
					$message .=	'<li>Broj naloga u setu: '. test_input($_POST['numOfPaySet']) . '</li>		
						<li>Količina setova: '. test_input($_POST['quantity']) . '</li>
						<li>Varijabilni podaci: ';
					if(isset($_POST['varData']))
						$message = $message . 'DA </li>';
					else
						$message = $message . 'NE </li>';
					$message .= '<li>Komentar korisnika: ' . test_input($_POST['comment']) . '</li>
				</ul>';
	}
	else if($type === 'blokovi'){
		$message .= '<label> Tip: </label> Preslikavajući blokovi </br>
				<label> Datoteka: </label> '.basename( $_FILES["fileToUpload"]["name"]).' </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Broj setova: '.$_POST['noOfSet'].'</li>
					<li>Boja: '.$_POST['blockColor'].'</li>
					<li>Veličina: '.$_POST['blockSize'].'</li>
					<li>Pakovanje: '.$_POST['packing'].'</li>
					<li>Komentar korisnika: '. test_input($_POST['comment']).'</li>
				</ul>';
	}
	else if($type === 'koverte-dostavnice-formulari/standardne-koverte'){
			$message .= '<label> Tip: </label> Standardne koverte </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Veličina: '.$_POST['size'].'</li>
					<li>Količina: '.$_POST['quantity'].'</li>
					<li>Štampanje na poleđini: 
						<ul>
							<li>Prvi red: '.$_POST['printingOnBack1'].'</li>
							<li>Drugi red: '.$_POST['printingOnBack2'].'</li>
							<li>Treći red: '.$_POST['printingOnBack3'].'</li>
							<li>Četvrti red: '.$_POST['printingOnBack4'].'</li>							
						</ul>
					</li>
					<li>Štampanje na adresnoj strani: 
						<ul>
							<li>Prvi red: '.$_POST['printingOnAdressPage1'].'</li>
							<li>Drugi red: '.$_POST['printingOnAdressPage2'].'</li>
							<li>Treći red: '.$_POST['printingOnAdressPage3'].'</li>
							<li>Četvrti red: '.$_POST['printingOnAdressPage4'].'</li>							
						</ul>
					</li>
					<li>Varijabilni podaci: ';
					if(isset($_POST['varData']))
						$message = $message . 'DA </li>';
					else
						$message = $message . 'NE </li>';					

		$message = $message .
					'<li>Komentar korisnika: '. test_input($_POST['comment']).'</li>
				</ul>';
	} else if($type === 'omot-spisa'){
		$message .= '<label> Tip: </label> Omot spisa </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Za: '.$_POST['forInput'].'</li>
					<li>Ime i prezime: '.test_input($_POST['nameLastname']).'</li>
					<li>Ulica: '.test_input($_POST['address']).'</li>
					<li>Mesto: '.test_input($_POST['location']).'</li>
					<li>Vrsta papira: '.$_POST['typeOfPaper'].'</li>
					<li>Količina: '.$_POST['quantity'].'</li>
					<li>Komentar korisnika: '. test_input($_POST['comment']).'</li>
				</ul>';
	} else if($type === 'koverte-dostavnice-formulari/koverte-sa-povratnicom'){
		$message .= '<label> Tip: </label> Koverta sa povratnicom za štampanje</br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Boja: '.$_POST['color'].'</li>
					<li>Količina: '.$_POST['quantity'].'</li>
				</ul>';
	} else if($type === 'dostavnica'){
		$message .= '<label> Tip: </label> Dostavnica </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Za: '.$_POST['forInput'].'</li>
					<li>Ime i prezime: '.test_input($_POST['nameLastname']).'</li>
					<li>Ulica: '.test_input($_POST['adress']).'</li>
					<li>Poštanski broj: '.test_input($_POST['zipCode']).'</li>
					<li>Mesto: '.test_input($_POST['location']).'</li>
					<li>Količina: '.$_POST['quantity'].'</li>
				</ul>';
	} else if($type === 'koverte-dostavnice-formulari/koverte-sa-dostavnicom'){
		$message .= '<label> Tip: </label> Koverta sa dostavnicom za lično popunjavanje </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Za: '.$_POST['forInput'].'</li>
					<li>Boja: '.$_POST['color'].'</li>
					<li>Ime i prezime: '.test_input($_POST['nameLastname']).'</li>
					<li>Ulica: '.test_input($_POST['adress']).'</li>
					<li>Poštanski broj: '.test_input($_POST['zipCode']).'</li>
					<li>Mesto: '.test_input($_POST['location']).'</li>
					<li>Poštarina plaćena kod: '.test_input($_POST['postagePaid']).'</li>
					<li>Tip koverte: '.test_input($_POST['envelopeType']).'</li>
					<li>Količina: '.$_POST['quantity'].'</li>
				</ul>';
	} else if($type === 'koverte-dostavnice-formulari/formulari-za-adresiranje'){
		$message .= '<label> Tip: </label> Formular za adresiranje </br>
				<label> Izabrane opcije: </label> </br>
				<ul>					
					<li>Količina: '.$_POST['quantity'].'</li>
				</ul>';
	}
	
	$message .= '</br></br><label>Dostava: </label> </br>
					<ul>
						<li>Ime i prezime: '. $_POST['deliveryName'] .'</li>
						<li>Adresa: '.$_POST['deliveryAddress'].'</li>
						<li>Mesto: '.$_POST['deliveryZipCode'] . ' ' . $_POST['deliveryLocation'].'</li>
					</ul>
			</body>
		</html>';
	
	return $message;		
}

?>