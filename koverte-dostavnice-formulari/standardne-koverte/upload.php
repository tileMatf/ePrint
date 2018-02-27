<?php

require_once "../../connection.php";
require_once '../../mail.php';

try{
	//$db = new DB();

	$target_dir = "uploaded_file/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$status = 0;
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
		echo "Sorry, only PDF & JPG files are allowed.";
		$uploadOk = 0;
		$status = 1;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		// Check if file already exists
		if (file_exists($target_file)) {
			unlink($target_file);
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			$status = 2;			
		}
		else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//$uploadOk = $db->uploadFile($target_file);
			if($uploadOk == 1){
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				$status = 3;
			} else {
				echo  "Sorry, there was an error uploading your file to database.";
				$status = 4;
			}
		} else {
			echo "Sorry, there was an error uploading your file to file system.";			
			$status = 5;
		}
	}
			
	$message = 
		'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
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
	
	
	//u statusu postoji kolizija, izmeniti zbog sendMail
	if(!isset($_POST['sendCopy']))
		$status = sendMail($message);
	else {
		$status = sendMail($message, $_POST['userEmail']);		
	}
	
	//header("Location: ./index.php?status=".$status);
	//exit();
} catch(RuntimeException $e){
	echo $e->getMessage();
} 
?>