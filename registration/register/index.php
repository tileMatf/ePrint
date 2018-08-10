<?php 
	session_start();
	include("../connection.php");
	require_once("../user.php");

	$db = new DB();
	$inputJSON = file_get_contents('php://input');
	$input = json_decode($inputJSON, TRUE);
	
	$_SESSION['registration'] = null;
	unset($_SESSION['registration']);
	unset($_SESSION['status_message']);
	if(isset($input['email']) && isset($input['psw']) && isset($input['pswRepeat'])){				
		$sql_result = $db->checkMailOccupancy($input['email']);		
		if(count($sql_result) == 0){
			$user = new User($input['email'], $input['psw'], 2);
			$sql_result = $db->addUser($user);
			$_SESSION['registration'] = $sql_result;
			if($sql_result === true) {
				$_SESSION['status_message'] = "Uspešno ste se registrovali.";
				unset($_SESSION['error_message']);
			} else {
				$_SESSION['status_message'] = "Neuspešna registracija, pokušajte ponovo.";							
			}
			echo $sql_result === true;
		} else if($sql_result == null){
			$_SESSION['registration'] = false;
			//$_SESSION['status_message'] = 'Konekcija ka bazi je izgubljena, trenutno nije moguć pristup bazi.';
			echo 0;
		}
		else{
			$_SESSION['registration'] = false;
			//$_SESSION['status_message'] = 'Postoji registracija sa ovom email adresom. Pokušajte sa logovanjem ili registracijom druge adrese.';
			echo -1;
		}
	}
	//header("Location: " . $input['path']);
	//exit();
	
	/*if(isset($input['ac']) && $input['ac'] == 'logout'){
		$_SESSION['user_info'] = null;
		unset($_SESSION['user_info']);
		$logout = 'You are logged out.';
	}*/
?>