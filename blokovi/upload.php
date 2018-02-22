<?php

require_once "../connection.php";
require_once '../mail.php';

try{
	$db = new DB();

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
		
	if(!empty($_FILES['bindingFileToUpload']['name'])){		
		$target_binding_file = $target_binding_dir . basename($_FILES["bindingFileToUpload"]["name"]);	
		echo $target_binding_file;
		$bindingFileType = pathinfo($target_binding_file,PATHINFO_EXTENSION);
		
		// Allow certain file formats for binding
		if($bindingFileType != "pdf" && $bindingFileType != "jpg") {
			echo "Sorry, only PDF & JPG files are allowed.";			
			$uploadOk = 0;
			$status = 6;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			// Check if file already exists
			if (file_exists($target_binding_file)) {
				unlink($target_binding_file);
				move_uploaded_file($_FILES["bindingFileToUpload"]["tmp_name"], $target_binding_file);
				echo "The file ". basename( $_FILES["bindingFileToUpload"]["name"]). " has been uploaded.";
				$status = 7;			
			}
			else if (move_uploaded_file($_FILES["bindingFileToUpload"]["tmp_name"], $target_binding_file)) {
				//$uploadOk = $db->uploadFile($target_file);
				if($uploadOk == 1){
					echo "The file ". basename( $_FILES["bindingFileToUpload"]["name"]). " has been uploaded.";
					$status = 8;
				} else {
					echo  "Sorry, there was an error uploading your file to database.";
					$status = 9;
				}
			} else {
				echo "Sorry, there was an error uploading your file to file system.";			
				$status = 10;
			}
		}
	}	
	
	$message = 
		'<html>
			<head><title> </title></head>
			<body>
				<label> Korisnik: </label> korisnik123 </br>
				<label> Vreme: </label> '.date("h:i").' </br>
				<label> Tip: </label> Preslikavajuci blokovi </br>
				<label> Datoteka: </label> '.basename( $_FILES["fileToUpload"]["name"]).' </br>
				<label> Izabrane opcije: </label> </br>
				<ul>
					<li>Broj setova: '.$_POST['noOfSet'].'</li>
					<li>Boja: '.$_POST['blockColor'].'</li>
					<li>Velicina: '.$_POST['blockSize'].'</li>
					<li>Pakovanje: '.$_POST['packing'].'</li>
					<li>Komentar korisnika: '.$_POST['comment'].'</li>
				</ul>
			</body>
		</html>';
	
	
	//u statusu postoji kolizija, izmeniti
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