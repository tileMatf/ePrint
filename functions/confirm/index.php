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
	
	echo $status;
?>