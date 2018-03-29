<?php
	require "../functions.php";
	require "../mail.php";
		
	$status = 0;
	$message = makeMessage($_POST['orderType']);			

	$status = sendMail($message);
	
	if(isset($_POST['sendCopy']) && isset($_POST['sendCopyEmail'])){		
		$status = $status && sendMailWithPicture();
	}
	echo $status;
?>