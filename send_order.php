<?php

@session_start();

require_once '/functions/mail.php';
require_once '/functions/functions.php';

if(isset($_POST['submit']) && !isset($_SESSION['orderSaved'])) {
	try{
	
		$status = 0;
		$fileStatus = 0;
		$bindingFileStatus = 0;	
		
		$fileStatus = uploadFile($_POST['orderType'] . "/uploaded_file/", $_FILES["fileToUpload"]);
		$statusMessage = generateMessage($fileStatus, $_FILES['fileToUpload']);
		if($fileStatus !== 2 && $fileStatus !== 3)
			return false;
	
		if(!empty($_FILES['bindingFileToUpload']['name'])){
			$bindingFileStatus = uploadFile($_POST['orderType'] . "/uploaded_binding_file/", $_FILES["bindingFileToUpload"]);
			$statusMessage .= " " . generateMessage($bindingFileStatus, $_FILES['bindingFileToUpload']);
			if($bindingFileStatus !== 2 && $bindingFileStatus !== 3){
				return false;
			}
		}
	
		$message = makeMessage($_POST['orderType']);
		
		$status = false;
		if($fileStatus === 2 || $fileStatus === 3){
			if(!empty($files['bindingFileToUpload']['name'])){
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

		if($status === true) {
			if(isset($_POST['sendCopy']) && isset($_POST['sendCopyEmail'])){
				$status = sendMail($message, $_POST['sendCopyEmail']);		
			}
			else {
				$status = sendMail($message);		
			}
		}
		
		$_SESSION['status'] = $status;
		$_SESSION['statusMessage'] = $statusMessage;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();		
	} catch(RuntimeException $e){
		return $e->getMessage();
	}
}

?>