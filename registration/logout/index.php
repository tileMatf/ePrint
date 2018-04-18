<?php 
	session_start();
	include("connection.php");
	
	if(isset($_SESSION['user_info'])){
		//session_destroy();
		$_SESSION = [];
	}
	//header('Refresh: 1; URL=index.php?logout=1');
	//header('Location:' . $_SERVER['HTTP_REFERER'] . "?logout=1");
	//exit();
?>