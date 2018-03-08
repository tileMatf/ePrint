<?php
	require "../functions.php";
	require "../mail.php";
		
	$status = 0;	
	$message = makeMessage($_POST['type']);		
	
	if(!isset($_POST['sendCopy']))
		$status = sendMail($message);			
	else {
		$status = sendMail($message, $_POST['userEmail']);		
	}
	
	if($status === true){
		//$statusMessage = "Nalog za uplatu je uspešno poslat.";
		echo "true";
	}
	else{
		//$statusMessage = "Oprostite, došlo je do greške prilikom slanja. Molim Vas pokušajte ponovo.";
		echo "false";
	}
	//echo $statusMessage;
?>