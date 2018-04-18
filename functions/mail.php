<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

function sendMail($message, $cc = null){

	date_default_timezone_set('Europe/Belgrade');
	$mail = new PHPMailer;

	$mail->isSMTP();                            // Set mailer to use SMTP
//	$mail->SMTPDebug = 4;						// For debugging
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'tijjana0807@gmail.com';  // SMTP username
	$mail->Password = 'chadmajkl15'; 			// SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                          // TCP port to connect to
	$mail->SMTPOptions = array('ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true)
	);
	$mail->CharSet = 'UTF-8';
	$mail->setFrom('tijjana0807@gmail.com', 'EPrint');
	$mail->addAddress('tijjana@hotmail.com');   // Add a recipient
	if($cc !== NULL){
		$mail->addCC($cc);
	}	
	$mail->isHTML(true);  // Set email format to HTML
	$mail->Subject = 'EPrint - new order';
	$mail->Body    = $message;
	
	//need to install https://getcomposer.org/download/
	if(!$mail->send()) {
		$statusMessage = 'Mailer Error: ' . $mail->ErrorInfo;
		return false;
	} else {
		return true;
	}	
}	

function sendMailWithPicture($to){
	date_default_timezone_set('Europe/Belgrade');
	$mail = new PHPMailer;

	$mail->isSMTP();                            // Set mailer to use SMTP
//	$mail->SMTPDebug = 4;						// For debugging
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'tijjana0807@gmail.com';  // SMTP username
	$mail->Password = 'chadmajkl15'; 			// SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                          // TCP port to connect to
	$mail->SMTPOptions = array('ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true)
	);
	$mail->CharSet = 'UTF-8';
	$mail->setFrom('tijjana0807@gmail.com', 'EPrint');
	$mail->addAddress($to);   // Add a recipient	
	//$mail->isHTML(true);  // Set email format to HTML
	$mail->Subject = 'EPrint - Vaša narudžbina';
	$image = file_get_contents("http://localhost/eprint/functions/createPicture/createPicture.php?" . http_build_query($_POST));
	$mail->addStringEmbeddedImage($image, "order", "order.jpg", "base64", "image/jpeg");
	$mail->Body = 'U prilogu možete videti Vašu narudžbinu.';
	
	//need to install https://getcomposer.org/download/
	if(!$mail->send()) {
		$statusMessage = 'Mailer Error: ' . $mail->ErrorInfo;
		return false;
	} else {
		return true;
	}	
}
?>