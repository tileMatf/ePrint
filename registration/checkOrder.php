<?php
	session_start();
	
	if(!isset($_SESSION['user_info']) || $_SESSION['user_info']->Role !== '1'
		|| !isset($_POST['orderID']) || !isset($_POST['checkOrder'])){
		$url = isset($_SERVER['HTTPS']) ? "https" : "http" . "://" . $_SERVER['HTTP_HOST'] . "/eprint/";
		header("Location: ". $url);
		exit();
	} 
	else {
		require_once("connection.php");
		$db = new DB();
		$sql_result = $db->checkOrder($_POST['orderID']);

		if($sql_result === true){
			$url = isset($_SERVER['HTTPS']) ? "https" : "http" . "://" . $_SERVER['HTTP_HOST'] . "/eprint/adminpanel/";
			header("Location: ". $url);
			exit();
		}
	}
?>