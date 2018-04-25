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
			$_SESSION['status_message'] = "Ulogovani ste kao " . $_SESSION['user_info']->Email;
			unset($_SESSION['registration']);
			unset($_SESSION['error_message']);
			unset($_SESSION['statusMessage']);
			unset($statusMessage);
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