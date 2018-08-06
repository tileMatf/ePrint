<?php 
	session_start();
	include("../connection.php");
	include("../user.php");

	$db = new DB();
	
	if(isset($_POST['email']) && isset($_POST['psw'])){
		$sql_result = $db->loginCheck($_POST['email'], $_POST['psw']);
		if($sql_result === 0){
			$_SESSION['user_info'] = null;
			unset($_SESSION['user_info']);
			echo 0;
		} else if($sql_result != null){
			$_SESSION['user_info'] = $sql_result[0];
			$_SESSION['registration'] = null;
			$_SESSION['status_message'] = $_SESSION['user_info']->Email;
			$_SESSION['login'] = true;
			unset($_SESSION['registration']);
			unset($_SESSION['error_message']);
			unset($_SESSION['statusMessage']);
			unset($statusMessage);
			/*setting cookie with email and password when 'remember me' is checked*/
			if(!empty($_POST['remember'])){
				setcookie ("email",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60), false);
				setcookie ("psw",$_POST["psw"],time()+ (10 * 365 * 24 * 60 * 60), false);
			} else {
				if(isset($_COOKIE["email"])) {
					setcookie ("email","");
				}
				if(isset($_COOKIE["psw"])) {
					setcookie ("psw","");
				}
			}
			
			echo json_encode($sql_result[0]);
		} else {
			$_SESSION['user_info'] = null;
			unset($_SESSION['user_info']);
			echo -1;
		}
	}
	//header("Location: " . $_SERVER['HTTP_REFERER']);
	//exit();
?>