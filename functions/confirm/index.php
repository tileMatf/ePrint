<?php

@session_start();

	require_once "../functions.php";
	require_once "../mail.php";
		
	$status = 0;
	$message = makeMessage($_POST['orderType']);			

	$status = sendMail($message);
	
	if(isset($_POST['sendCopy'])){
		if(isset($_POST['sendCopyEmail'])){		
			$status = $status && sendMailWithPicture($_POST['sendCopyEmail']);
		} else if(isset($_SESSION['user_info'])){
			$status = $status && sendMailWithPicture($_SESSION['user_info']->Email); //proveriti
		}
	}
	echo $status;
?>