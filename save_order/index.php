<?php
	@session_start();		
	
	if(!isset($_SESSION['user_info'])){
		header("Location: ../" . isset($_POST['orderType']) ? $_POST['orderType'] . "/" : '');
		exit();
	} else if(isset($_POST['orderType'])){
		switch($_POST['orderType']){
			case 'stampanje':
				include("../registration/stampanje.php");
				$order = new Stampanje($_POST);
				break;
			case 'blokovi':
				include("../registration/blok.php");
				$order = new Blok($_POST);
				break;
		}
		
		require_once("../registration/connection.php");
		$db = new DB();
		$status = $db->saveOrder($order, $_SESSION['user_info']->ID);
		if($status === true){
			unset($_POST);
			$_POST = array();
			unset($statusMessage);			
			$_SESSION['orderSaved'] = 1;
		} else {
			$_SESSION['orderSaved'] = 2;
		}	
		
		return $status;
	}
?>