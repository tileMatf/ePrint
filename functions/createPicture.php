<?php

require 'stringFunctions.php';

	function getEnvelopeReciver($input) {
		if($input === 'Javni izvrsitelj')
			$reciver = "ЈАВНИ ИЗВРШИТЕЉ";
		else if($input === 'Javni beleznik'){
			$reciver = "ЈАВНИ БЕЛЕЖНИК";
		} else if($input === 'Advokat') {
			$reciver = "Адвокат";
		}
		return $reciver;
	}

	function fillPaymentData(&$image, $black, $font_path) {
		$type = $_GET['orderType'];
		$purposeOfPayment = $_GET['purposeOfPayment'];
		$purposeOfPayment = readjustText($purposeOfPayment);
		if($type === 'nalog-za-isplatu'){
			imagettftext($image, 15, 0, 75, 222, $black, $font_path, $purposeOfPayment);
		} else if($type === 'nalog-za-uplatu') {
			imagettftext($image, 11, 0, 30, 138, $black, $font_path, $purposeOfPayment);
		} else { 
			imagettftext($image, 15, 0, 80, 240, $black, $font_path, $purposeOfPayment);
		}
		$recipient = $_GET['recipient'];
		$recipient = readjustText($recipient);
		if($type === 'nalog-za-isplatu'){
			imagettftext($image, 15, 0, 75, 332, $black, $font_path, $recipient);
		} else if($type === 'nalog-za-uplatu'){
			imagettftext($image, 11, 0, 30, 215, $black, $font_path, $recipient);
		} else { 
			imagettftext($image, 15, 0, 80, 343, $black, $font_path, $recipient);
		}
		$paymentCode = $_GET['paymentCode'];
		if($type === 'nalog-za-isplatu'){
			imagettftext($image, 18, 0, 685, 144, $black, $font_path, $paymentCode);
		} else if($type === 'nalog-za-uplatu'){
			imagettftext($image, 12, 0, 437, 72, $black, $font_path, $paymentCode);
		} else { 
			imagettftext($image, 18, 0, 690, 145, $black, $font_path, $paymentCode);
		}
		$currency = "RSD";//$_GET['currency'];
		if($type === 'nalog-za-isplatu'){
			imagettftext($image, 18, 0, 781, 144, $black, $font_path, $currency);
		} else if($type === 'nalog-za-uplatu'){
			imagettftext($image, 12, 0, 505, 72, $black, $font_path, $currency);
		} else { 
			imagettftext($image, 18, 0, 785, 145, $black, $font_path, $currency);
		}
		$amount = $_GET['amount'];
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
		$accountOfRecipient = $_GET['accountOfRecipient'];
		if($type === 'nalog-za-isplatu'){
			imagettftext($image, 18, 0, 780, 210, $black, $font_path, $accountOfRecipient);
		} else if($type === 'nalog-za-uplatu'){
			imagettftext($image, 12, 0, 437, 125, $black, $font_path, $accountOfRecipient);
		} else { 
			imagettftext($image, 18, 0, 690, 339, $black, $font_path, $accountOfRecipient);
		}
		if($type !== 'nalog-za-prenos'){
			$mockUp = $_GET['mockUp'];
			if($type === 'nalog-za-isplatu'){
				imagettftext($image, 18, 0, 687, 280, $black, $font_path, $mockUp);
			} else if($type === 'nalog-za-uplatu'){
				imagettftext($image, 12, 0, 436, 171, $black, $font_path, $mockUp);
			}
			$referenceNumber = $_GET['referenceNumber'];
			if($type === 'nalog-za-isplatu'){
				imagettftext($image, 18, 0, 777, 280, $black, $font_path, $referenceNumber);
			} else if($type === 'nalog-za-uplatu'){
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
	$image_file = dirname(__FILE__) . '/Image/' . $type . $colorOfDocument . '.jpg';
	$image = imagecreatefromjpeg($image_file);
	$black = imagecolorallocate($image, 0, 0, 0);
	$font_path = dirname(__FILE__) . '/Font/OpenSans-Regular.ttf';	
	$name = isset($_GET['payer'])? $_GET['payer'] : '';
	$adress = isset($_GET['address']) ? $_GET['address'] . ", " . $_GET['location'] : '';
	$country = isset($_GET['country']) ? $_GET['country'] : '';	

	switch ($type) {
		case 'nalog-za-uplatu':
			imagettftext($image, 11, 0, 30, 58, $black, $font_path, $name);
			imagettftext($image, 11, 0, 30, 75, $black, $font_path, $adress);
			imagettftext($image, 11, 0, 30, 92, $black, $font_path, $country);
			fillPaymentData($image, $black, $font_path);
			break;
		case 'nalog-za-isplatu':
			imagettftext($image, 15, 0, 75, 112, $black, $font_path, $name);
			imagettftext($image, 15, 0, 75, 135, $black, $font_path, $adress);
			imagettftext($image, 15, 0, 75, 158, $black, $font_path, $country);
			fillPaymentData($image, $black, $font_path);
			break;
		case 'nalog-za-prenos':
			imagettftext($image, 15, 0, 80, 130, $black, $font_path, $name);
			imagettftext($image, 15, 0, 80, 152, $black, $font_path, $adress);
			imagettftext($image, 15, 0, 80, 174, $black, $font_path, $country);
			fillPaymentData($image, $black, $font_path);
			break;
		case 'koverta-sa-povratnicom':
			break;
		case 'koverta-sa-dostavnicom':
			imagettftext($image, 20, 0, 170, 1000, $black, $font_path, $envelopeReciver);
			imagettftext($image, 20, 0, 445, 1000, $black, $font_path, strtoupper($_GET['nameLastname']));
			imagettftext($image, 20, 0, 170, 1030, $black, $font_path, "Ул. ". $_GET['adress']);
			imagettftext($image, 20, 0, 170, 1060, $black, $font_path, $_GET['zipCode']);
			imagettftext($image, 20, 0, 280, 1060, $black, $font_path, strtoupper($_GET['location']));
			imagettftext($image, 19, 0, 680, 1000, $black, $font_path, "ПОШТАРИНА ПЛАЋЕНА КОД ПОШТЕ");
			imagettftext($image, 20, 0, 800, 1030, $black, $font_path, strtoupper($_GET['postagePaid']));
			imagettftext($image, 25, 0, 600, 1060, $black, $font_path, $_GET['envelopeType']);
			imagerectangle($image, 590, 1020, 650, 1070, $black);
			if($_GET['forInput'] === 'Javni izvrsitelj')
				imagettftext($image, 20, 0, 830, 1325, $black, $font_path, "ИЗВРШНИ ПОСТУПАК");
			else 
				imagettftext($image, 20, 0, 830, 1325, $black, $font_path, "УПРАВНИ ПОСТУПАК");			
			imagettftext($image, 20, 0, 2050, 1400, $black, $font_path, $envelopeReciver);
			imagettftext($image, 20, 0, 2050, 1450, $black, $font_path, $_GET['nameLastname']);
			imagettftext($image, 20, 0, 2050, 1500, $black, $font_path, "Ул. " . $_GET['adress']);
			imagettftext($image, 20, 0, 2050, 1550, $black, $font_path, $_GET['zipCode'] . " " . $_GET['location']);
			break;
		case 'dostavnica':			
			imagettftext($image, 16, 0, 70, 50, $black, $font_path, $envelopeReciver);
			imagettftext($image, 16, 0, 290, 50, $black, $font_path, strtoupper($_GET['nameLastname']));
			imagettftext($image, 16, 0, 70, 75, $black, $font_path, "Ул. " . $_GET['adress']);
			imagettftext($image, 16, 0, 70, 100, $black, $font_path, $_GET['zipCode'] . " " . $_GET['location']);
			break;
		case 'formular-za-adresiranje':
			break;
		case 'omot-spisa':
			imagettftext($image, 32, 0, 100, 80, $black, $font_path, "РЕПУБЛИКА СРБИЈА");
			imagettftext($image, 30, 0, 100, 130, $black, $font_path, $envelopeReciver);
			imagettftext($image, 30, 0, 100, 180, $black, $font_path, $_GET['nameLastname']);
			imagettftext($image, 30, 0, 100, 230, $black, $font_path, $_GET['location'] . ", " . $_GET['address']);
			break;
	}

	header('Content-type: image/jpeg');
	imagejpeg($image);
	imagedestroy($image);
	
?>
