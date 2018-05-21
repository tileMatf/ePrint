<?php
	session_start();
	include("../connection.php");
	
	
	if(!isset($_SESSION['user_info']) || !isset($_POST['oldPassword']) || !isset($_POST['newPassword'])){
		header("Location: ../../");
		exit();
	}
	
	$db = new DB();
	//echo $db->changePass($_SESSION['user_info']->ID, 'chadmajkl', 'chadmajkl1');
	echo $db->changePass($_SESSION['user_info']->ID, $_POST['oldPassword'], $_POST['newPassword']);
	
?>