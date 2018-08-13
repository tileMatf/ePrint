<?php
	session_start();
	include("../connection.php");
	
	$inputJSON = file_get_contents('php://input');
	$input = json_decode($inputJSON, TRUE);
	
	if(!isset($_SESSION['user_info']) || !isset($input['oldPassword']) || !isset($input['newPassword'])){
		header("Location: ../../");
		exit();
	}
	
	$db = new DB();		
	echo $db->changePass($_SESSION['user_info']->ID, $input['oldPassword'], $input['newPassword']);
	
?>