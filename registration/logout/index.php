<?php 
	session_start();
	include("connection.php");
	

	if(isset($_SESSION['user_info'])){
		$_SESSION['user_info'] = null;
		unset($_SESSION['user_info']);
		$_SESSION['status_messaage'] = null;
		unset($_SESSION['status_messaage']);
	}
	//header("Location: " . $_POST['path']);
	exit();
?>