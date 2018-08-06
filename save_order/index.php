<?php
	@session_start();		
	
	if($_SERVER['REQUEST_METHOD'] !== 'POST') && !isset($_POST['orderType'])){
		header("Location: ../");	
		exit();
	}	
	
	require_once("../../registration/order.php");
	require_once("../../registration/connection.php");
	
		switch($_POST['orderType']){
			case 'stampanje':
				$order = new Stampanje($_POST, $_FILES);
				break;
			case 'blokovi':
				$order = new Blok($_POST, $_FILES);
				break;
			case 'uplatnice/nalog-za-uplatu':
				$order = new UplataIsplataPrenos($_POST, 'Uplata');
				break;
			case 'uplatnice/nalog-za-isplatu':
				$order = new UplataIsplataPrenos($_POST, 'Isplata');
				break;
			case 'uplatnice/nalog-za-prenos':
				$order = new UplataIsplataPrenos($_POST, 'Prenos');
				break;
			case 'koverte-dostavnice-formulari/koverte-sa-povratnicom':
				$order = new KovertaSaPovratnicom($_POST);
				break;
			case 'koverte-dostavnice-formulari/dostavnice':
				$order = new Dostavnica($_POST);
				break;
			case 'koverte-dostavnice-formulari/koverte-sa-dostavnicom':
				$order = new KovertaSaDostavnicom($_POST);
				break;
			case 'koverte-dostavnice-formulari/formulari-za-adresiranje':
				$order = new FormularZaAdresiranje($_POST);
				break;
			case 'koverte-dostavnice-formulari/standardne-koverte':
				$order = new StandardnaKoverta($_POST);
				break;
			case 'omot-spisa':
				$order = new OmotSpisa($_POST);
				break;
		}
		
		if(!isset($order) || !is_object($order)){
			header("Location: ../");
			exit();
		}
		
		$db = new DB();
		if(isset($_SESSION['user_info'])){
			$order->UserID = $_SESSION['user_info']->ID;	
		} else {
			$unregisterUserID = $db->getIdOfUnregisterUser()[0]->ID;
			$order->UserID = $unregisterUserID;
		}
		
		$status = $db->saveOrder($order);
		
		if($status === true){
			unset($statusMessage);			
			$_SESSION['orderSaved'] = 1;
		} else {
			$_SESSION['orderSaved'] = 2;
		}	
		
		echo $status;
?>