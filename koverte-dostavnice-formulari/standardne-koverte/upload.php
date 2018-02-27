<?php

require_once "../../connection.php";
require_once '../../mail.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['submit'])) {
	try{
		//$db = new DB();

		date_default_timezone_set('Europe/Belgrade');
		$target_dir = "uploaded_file/";
		$target_binding_dir = "uploaded_binding_file/";	
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$status = 0;
		$fileStatus = 0;
		$bindingFileStatus = 0;
		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);	
		
		// Check if file is a actual image or fake image
	/*	if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);		
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
				$status = 1;
			} 		
		}
	*/	

		// Allow certain file formats	
		if($fileType != "pdf" && $fileType != "jpg") {
//			$statusMessage = "Sorry, only PDF & JPG files are allowed.";
			$statusMessage = "Greška, dozvoljene su samo PDF i JPG datoteke.";
			$uploadOk = 0;
			$fileStatus = 1;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
//			$statusMessage .= "Sorry, your file was not uploaded.";
			$statusMessage .= " Vaša datoteka nije otpremljena.";
		// if everything is ok, try to upload file
		} else {
			// Check if file already exists
			if (file_exists($target_file)) {
				unlink($target_file);
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
//				$statusMessage = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				$statusMessage = "Datoteka ". basename( $_FILES["fileToUpload"]["name"]). " je otpremljena.";
				$fileStatus = 2;			
			}
			else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//$uploadOk = $db->uploadFile($target_file);
				if($uploadOk == 1){
//					$statusMessage = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					$statusMessage = "Datoteka ". basename( $_FILES["fileToUpload"]["name"]). " je otpremljena.";
					$fileStatus = 3;
				} else {
//					$statusMessage = "Sorry, there was an error uploading your file to database.";
					$statusMessage = "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u bazu podataka.";
					$fileStatus = 4;
				}
			} else {
//				$statusMessage = "Sorry, there was an error uploading your file to file system.";
				$statusMessage = "Oprostite, došlo je do greške prilikom otpremanja Vaše datoteke u sistem datoteka.";			
				$fileStatus = 5;
			}
		}	
		
		$message = 
		'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Datum: </label> '.date("d.m.Y.").' </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Standardne koverte </br>
				<label> Datoteka: </label> '.basename( $_FILES["fileToUpload"]["name"]).' </br>
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
					'<li>Komentar korisnika: '.$_POST['comment'].'</li>
				</ul>
			</body>
		</html>';
		
		if(!isset($_POST['sendCopy']))
			$mailStatus = sendMail($message);
		else {
			$mailStatus = sendMail($message, $_POST['userEmail']);		
		}
		
		$status = false;
		if(($fileStatus === 2 || $fileStatus === 3) && $mailStatus === true){
			$status = true;			
		} else {
			$status = false;
		}		
	} catch(RuntimeException $e){
		return $e->getMessage();
	} 
	header("Location: ./index.php?status=".$status);
	exit;
}
?>