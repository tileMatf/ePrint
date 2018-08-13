<?php
	@session_start();		
	
	if($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($input['orderType'])){
		header("Location: ../");	
		exit();
	}	
	
	require_once("../../registration/order.php");
	require_once("../../registration/connection.php");
	
		switch($input['orderType']){
			case 'stampanje':
				$order = new Stampanje($input, $_FILES);
				break;
			case 'blokovi':
				$order = new Blok($input, $_FILES);
				break;
			case 'uplatnice/nalog-za-uplatu':
				$order = new UplataIsplataPrenos($input, 'Uplata');
				break;
			case 'uplatnice/nalog-za-isplatu':
				$order = new UplataIsplataPrenos($input, 'Isplata');
				break;
			case 'uplatnice/nalog-za-prenos':
				$order = new UplataIsplataPrenos($input, 'Prenos');
				break;
			case 'koverte-dostavnice-formulari/koverte-sa-povratnicom':
				$order = new KovertaSaPovratnicom($input);
				break;
			case 'koverte-dostavnice-formulari/dostavnice':
				$order = new Dostavnica($input);
				break;
			case 'koverte-dostavnice-formulari/koverte-sa-dostavnicom':
				$order = new KovertaSaDostavnicom($input);
				break;
			case 'koverte-dostavnice-formulari/formulari-za-adresiranje':
				$order = new FormularZaAdresiranje($input);
				break;
			case 'koverte-dostavnice-formulari/standardne-koverte':
				$order = new StandardnaKoverta($input);
				break;
			case 'omot-spisa':
				$order = new OmotSpisa($input);
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