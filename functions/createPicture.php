<?php

require_once("stringFunctions.php");

	function getEnvelopeReciver($input) {
		if($input === 'Javni izvrsitelj')
			$reciver = "ЈАВНИ ИЗВРШИТЕЉ";
		else if($input === 'Javni beleznik'){
			$reciver = "ЈАВНИ БЕЛЕЖНИК";
		} else if($input === 'Advokat') {
			$reciver = "АДВОКАТ";
		}
		return $reciver;
	}
	
	function fillPaymentData(&$image, $black, $font_path) {
		$type = $_GET['orderType'];
		$purposeOfPayment = isset($_GET['purposeOfPayment']) ? $_GET['purposeOfPayment'] : '';
		$purposeOfPayment = convertToCyrilic(readjustText($purposeOfPayment, 50));
		if(is_array($purposeOfPayment)){
			for($i = 0; $i < count($purposeOfPayment); $i++){
				if($type === 'uplatnice/nalog-za-isplatu'){
					imagettftext($image, 15, 0, 75, 222+$i*22, $black, $font_path, $purposeOfPayment[$i]);
				} else if($type === 'uplatnice/nalog-za-uplatu') {
					imagettftext($image, 11, 0, 30, 138+$i*18, $black, $font_path, $purposeOfPayment[$i]);
				} else { 
					imagettftext($image, 15, 0, 80, 238+$i*22, $black, $font_path, $purposeOfPayment[$i]);
				}
			}
		} else if(isset($purposeOfPayment) && $purposeOfPayment != null){
			if($type === 'uplatnice/nalog-za-isplatu'){
				imagettftext($image, 15, 0, 75, 222, $black, $font_path, $purposeOfPayment);
			} else if($type === 'uplatnice/nalog-za-uplatu') {
				imagettftext($image, 11, 0, 30, 138, $black, $font_path, $purposeOfPayment);
			} else { 
				imagettftext($image, 15, 0, 80, 240, $black, $font_path, $purposeOfPayment);
			}
		}
		$recipient = isset($_GET['recipient']) ? $_GET['recipient'] : '';
		$recipient = convertToCyrilic(readjustText($recipient, 30));
		if(is_array($recipient)){
			for($i = 0; $i < count($recipient); $i++){
				if($type === 'uplatnice/nalog-za-isplatu'){
					imagettftext($image, 15, 0, 75, 332+$i*22, $black, $font_path, $recipient[$i]);
				} else if($type === 'uplatnice/nalog-za-uplatu'){
					imagettftext($image, 11, 0, 30, 215+$i*18, $black, $font_path, $recipient[$i]);
				} else { 
					imagettftext($image, 15, 0, 80, 341+$i*22, $black, $font_path, $recipient[$i]);
				}
			}
		} else if(isset($recipient) && $recipient != null){
			if($type === 'uplatnice/nalog-za-isplatu'){
				imagettftext($image, 15, 0, 75, 332, $black, $font_path, $recipient);
			} else if($type === 'uplatnice/nalog-za-uplatu'){
				imagettftext($image, 11, 0, 30, 215, $black, $font_path, $recipient);
			} else { 
				imagettftext($image, 15, 0, 80, 343, $black, $font_path, $recipient);
			}
		}
		$paymentCode = isset($_GET['paymentCode']) ? $_GET['paymentCode'] : '';
		if($type === 'uplatnice/nalog-za-isplatu'){
			imagettftext($image, 18, 0, 685, 144, $black, $font_path, $paymentCode);
		} else if($type === 'uplatnice/nalog-za-uplatu'){
			imagettftext($image, 12, 0, 437, 72, $black, $font_path, $paymentCode);
		} else { 
			imagettftext($image, 18, 0, 690, 145, $black, $font_path, $paymentCode);
		}
		$currency = "RSD";//$_GET['currency'];
		if($type === 'uplatnice/nalog-za-isplatu'){
			imagettftext($image, 18, 0, 781, 144, $black, $font_path, $currency);
		} else if($type === 'uplatnice/nalog-za-uplatu'){
			imagettftext($image, 12, 0, 505, 72, $black, $font_path, $currency);
		} else { 
			imagettftext($image, 18, 0, 785, 145, $black, $font_path, $currency);
		}
		$amount = isset($_GET['amount']) ? $_GET['amount'] : '';
		if($amount != ''){
				$amount = readjustAmount($amount);
			if($type === 'nalog-za-isplatu'){
				imagettftext($image, 18, 0, 882, 144, $black, $font_path, $amount);
			} else if($type === 'uplatnice/nalog-za-uplatu'){ 
				imagettftext($image, 12, 0, 572, 72, $black, $font_path, $amount);
			} else { 
				imagettftext($image, 18, 0, 890, 145, $black, $font_path, $amount);
			}
		}
		$accountOfRecipient = isset($_GET['accountOfRecipient']) ? $_GET['accountOfRecipient'] : '';
		if($type === 'uplatnice/nalog-za-isplatu'){
			imagettftext($image, 18, 0, 780, 210, $black, $font_path, $accountOfRecipient);
		} else if($type === 'uplatnice/nalog-za-uplatu'){
			imagettftext($image, 12, 0, 437, 125, $black, $font_path, $accountOfRecipient);
		} else { 
			imagettftext($image, 18, 0, 690, 339, $black, $font_path, $accountOfRecipient);
		}
		if($type !== 'uplatnice/nalog-za-prenos'){
			$mockUp = isset($_GET['mockUp']) ? $_GET['mockUp'] : '';
			if($type === 'uplatnice/nalog-za-isplatu'){
				imagettftext($image, 18, 0, 687, 280, $black, $font_path, $mockUp);
			} else if($type === 'uplatnice/nalog-za-uplatu'){
				imagettftext($image, 12, 0, 436, 171, $black, $font_path, $mockUp);
			}
			$referenceNumber = isset($_GET['referenceNumber']) ? $_GET['referenceNumber'] : '';
			if($type === 'uplatnice/nalog-za-isplatu'){
				imagettftext($image, 18, 0, 777, 280, $black, $font_path, $referenceNumber);
			} else if($type === 'uplatnice/nalog-za-uplatu'){
				imagettftext($image, 12, 0, 505, 171, $black, $font_path, $referenceNumber);
			}
		} else { //nalog-za-prenos
			$accountOfOrderer = $_GET['accountOfOrderer'];
			imagettftext($image, 18, 0, 690, 210, $black, $font_path, $accountOfOrderer);		
		
			$mockUpDebit = $_GET['mockUpDebit'];
			imagettftext($image, 18, 0, 690, 275, $black, $font_path, $mockUpDebit);
			$referenceNumber = $_GET['referenceNumber'];
			imagettftext($image, 18, 0, 790, 275, $black, $font_path, $referenceNumber);
			
			$mockUpApproval = $_GET['mockUpApproval'];
			imagettftext($image, 18, 0, 690, 403, $black, $font_path, $mockUpApproval);
			$referenceNumberApprovals = $_GET['referenceNumberApprovals'];
			imagettftext($image, 18, 0, 790, 403, $black, $font_path, $referenceNumberApprovals);
		}
	}
	
	$type = $_GET['orderType'];
	$envelopeReciver = isset($_GET['forInput']) ? getEnvelopeReciver($_GET['forInput']) : '';
	$colorOfDocument = isset($_GET['color']) ? '-' . $_GET['color'] : '';
	$image_file = dirname(__FILE__) . '/Image/' .$type . $colorOfDocument . '.jpg';
	$image = @imagecreatefromjpeg($image_file);
	$black = @imagecolorallocate($image, 0, 0, 0);
	$font_path = dirname(__FILE__) . '/Font/OpenSans-Regular.ttf';	
	$name = isset($_GET['payer']) ? $_GET['payer'] : '';
	$name = isset($name) && !empty($name) ? convertToCyrilic($name) : '';
	$address = isset($_GET['address']) ? $_GET['address'] . ", " : '';
	if(isset($_GET['location']))
		$address .= $_GET['location'];
	$address = isset($address) && !empty($address) ? convertToCyrilic($address) : '';
	$country = isset($_GET['country']) ? $_GET['country'] : '';	
	$country = isset($country) && !empty($country) ? convertToCyrilic($country) : '';
	
	switch ($type) {
		case 'uplatnice/nalog-za-uplatu':
			imagettftext($image, 11, 0, 30, 58, $black, $font_path, $name);
			imagettftext($image, 11, 0, 30, 75, $black, $font_path, $address);
			imagettftext($image, 11, 0, 30, 92, $black, $font_path, $country);
			fillPaymentData($image, $black, $font_path);
			break;
		case 'uplatnice/nalog-za-isplatu':
			imagettftext($image, 15, 0, 75, 112, $black, $font_path, $name);
			imagettftext($image, 15, 0, 75, 135, $black, $font_path, $address);
			imagettftext($image, 15, 0, 75, 158, $black, $font_path, $country);
			fillPaymentData($image, $black, $font_path);
			break;
		case 'uplatnice/nalog-za-prenos':
			imagettftext($image, 15, 0, 80, 130, $black, $font_path, $name);
			imagettftext($image, 15, 0, 80, 152, $black, $font_path, $address);
			imagettftext($image, 15, 0, 80, 174, $black, $font_path, $country);
			fillPaymentData($image, $black, $font_path);
			break;
		case 'koverte-dostavnice-formulari/koverte-sa-povratnicom':
			break;
		case 'koverte-dostavnice-formulari/koverte-sa-dostavnicom':
			imagettftext($image, 20, 0, 170, 1000, $black, $font_path, $envelopeReciver);
			imagettftext($image, 20, 0, 170, 1030, $black, $font_path, convertToCyrilic(strtoupper(isset($_GET['nameLastname']) ? $_GET['nameLastname'] : '')));
			
			imagettftext($image, 20, 0, 170, 1060, $black, $font_path, "Ул. ". convertToCyrilic(isset($_GET['adress']) ? $_GET['adress'] : ''));
			imagettftext($image, 20, 0, 170, 1090, $black, $font_path, convertToCyrilic(isset($_GET['zipCode']) ? $_GET['zipCode'] : ''));
			imagettftext($image, 20, 0, 280, 1090, $black, $font_path, convertToCyrilic(strtoupper(isset($_GET['location']) ? $_GET['location'] : '')));
			imagettftext($image, 19, 0, 680, 1000, $black, $font_path, "ПОШТАРИНА ПЛАЋЕНА КОД ПОШТЕ");
			imagettftext($image, 20, 0, 800, 1030, $black, $font_path, convertToCyrilic(strtoupper(isset($_GET['postagePaid']) ? $_GET['postagePaid'] : '')));
			imagettftext($image, 25, 0, 600, 1060, $black, $font_path, convertToCyrilic($_GET['envelopeType']));
			imagerectangle($image, 590, 1020, 650, 1070, $black);
			if($_GET['forInput'] === 'Javni izvrsitelj')
				imagettftext($image, 20, 0, 830, 1325, $black, $font_path, "ИЗВРШНИ ПОСТУПАК");
			else 
				imagettftext($image, 20, 0, 830, 1325, $black, $font_path, "УПРАВНИ ПОСТУПАК");			
			imagettftext($image, 20, 0, 2050, 1400, $black, $font_path, $envelopeReciver);
			imagettftext($image, 20, 0, 2050, 1450, $black, $font_path, convertToCyrilic($_GET['nameLastname']));
			$readjustedText = readjustText($_GET['adress'], 17);
			
			if(is_array($readjustedText) && count($readjustedText) > 0){
				imagettftext($image, 20, 0, 2050, 1500, $black, $font_path, "Ул. " . convertToCyrilic($readjustedText[0]));
				for($i = 1; $i < count($readjustedText); $i++){
					imagettftext($image, 20, 0, 2050, 1500+$i*30, $black, $font_path, convertToCyrilic($readjustedText[$i]));
				}
				$y_coord = 1500+(count($readjustedText)*30);
			} else {
				if(isset($_GET['adress'])) {
					imagettftext($image, 20, 0, 2050, 1500, $black, $font_path, "Ул. " . convertToCyrilic($_GET['adress']));
				}
			}
			
			//imagettftext($image, 20, 0, 2050, 1500, $black, $font_path, "Ул. " . convertToCyrilic($_GET['adress']));
			//imagettftext($image, 20, 0, 2050, 1550, $black, $font_path, $_GET['zipCode'] . " " . convertToCyrilic($_GET['location']));
			imagettftext($image, 20, 0, 2050, $y_coord, $black, $font_path, $_GET['zipCode'] . " " . convertToCyrilic($_GET['location']));
			break;
		case 'koverte-dostavnice-formulari/dostavnice':			
			imagettftext($image, 16, 0, 70, 50, $black, $font_path, $envelopeReciver);
			imagettftext($image, 16, 0, 290, 50, $black, $font_path, convertToCyrilic(strtoupper($_GET['nameLastname'])));
			imagettftext($image, 16, 0, 70, 75, $black, $font_path, "Ул. " . convertToCyrilic($_GET['adress']));
			imagettftext($image, 16, 0, 70, 100, $black, $font_path, $_GET['zipCode'] . " " . convertToCyrilic($_GET['location']));
			break;
		case 'koverte-dostavnice-formulari/formulari-za-adresiranje':			
			break;
		case 'omot-spisa':
			//imagettftext($image, 32, 0, 100, 100, $black, $font_path, "РЕПУБЛИКА СРБИЈА");
			imagettftext($image, 30, 0, 100, 100, $black, $font_path, $envelopeReciver);
			imagettftext($image, 30, 0, 100, 165, $black, $font_path, convertToCyrilic($_GET['nameLastname']));
			imagettftext($image, 30, 0, 100, 230, $black, $font_path, convertToCyrilic($_GET['address']));
			imagettftext($image, 30, 0, 100, 293, $black, $font_path, convertToCyrilic($_GET['location']));
			break;
		}

	if($image !== false){
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
	} else {
		echo "Error";
	}
?>
