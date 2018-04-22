<?php

@session_start();

	if(!isset($_POST['orderType'])){
		header("Location: ../../");
		exit();
	}
	
	require_once "../functions.php"; 
	require_once "../mail.php";
	require_once "../../registration/connection.php";
		
	$status = 0;
	$fileStatus = 0;
	
	/*Upload main file*/
	if(isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload'])){
		if(isset($_SESSION['user_info'])){
			$directory = "uploaded_file/". $_SESSION['user_info']->Email . "/";
			$fileStatus = uploadFile($directory, $_FILES["fileToUpload"]);
		} else {
			$fileStatus = uploadFile("uploaded_file/", $_FILES["fileToUpload"]);
		}
		
		$statusMessage = generateMessage($fileStatus, $_FILES['fileToUpload']);		
		if($fileStatus !== 2 && $fileStatus !== 3)
			echo "1";
	}
	
	/*Upload binding file*/
	if(isset($_FILES['bindingFileToUpload']) && !empty($_FILES['bindingFileToUpload']['name'])){
		if(isset($_SESSION['user_info'])){
			$directory = "uploaded_binding_file/". $_SESSION['user_info']->Email . "/";
			$bindingFileStatus = uploadFile($directory, $_FILES["bindingFileToUpload"]);
		} else {
			$bindingFileStatus = uploadFile("uploaded_binding_file/", $_FILES["bindingFileToUpload"]);
		}
		$statusMessage .= " " . generateMessage($bindingFileStatus, $_FILES['bindingFileToUpload']);
		if($bindingFileStatus !== 2 && $bindingFileStatus !== 3){
			echo "2";
		}
	}
	
	/*Setting status depending on uploaded files status*/	
	if(isset($_FILES['fileToUpload'])){
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
	} else {
		$status = true;
	}
	
	/*Create mail message*/
	if(isset($_SESSION['user_info']))
		$message = makeMessage($_POST['orderType'], $_SESSION['user_info']->Email);
	else 
		$message = makeMessage($_POST['orderType']);
	
	/*Sending mail*/
	if($status === true){
		if($_POST['orderType'] === 'stampanje' || $_POST['orderType'] == 'blokovi'){
			if(isset($_POST['sendCopy'])) {
				if(isset($_POST['sendCopyEmail'])){
					$status = sendMail($message, $_POST['sendCopyEmail']);		
				} else if(isset($_SESSION['user_info'])){
					$status = sendMail($message, $_SESSION['user_info']->Email);
				} else {
					$status = sendMail($message);
				}
			} else {
				$status = sendMail($message);		
			}
		} else {
			$status = sendMail($message);
			
			if(isset($_POST['sendCopy'])){
				if(isset($_POST['sendCopyEmail'])){		
					$status = $status && sendMailWithPicture($_POST['sendCopyEmail']);
				} else if(isset($_SESSION['user_info'])){
					$status = $status && sendMailWithPicture($_SESSION['user_info']->Email);
				}
			}
		}
	}

	/*Save order*/
	if($status === true){
		ob_start();
		include('../../save_order/index.php');
		$status = ob_get_contents();
		ob_end_clean();
		if($status === false)
			echo "3";
	}
	
	/*Echo status*/
	if($status === false)	
		echo "4";
	else
		echo "5";
?>