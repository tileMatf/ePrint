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
			case 'uplatnice/nalog-za-uplatu':
				include("../registration/uplata_isplata_prenos.php");
				$order = new UplataIsplataPrenos($_POST, 'Uplata');
				break;
			case 'uplatnice/nalog-za-isplatu':
				include("../registration/uplata_isplata_prenos.php");
				$order = new UplataIsplataPrenos($_POST, 'Isplata');
				break;
			case 'uplatnice/nalog-za-prenos':
				include("../registration/uplata_isplata_prenos.php");
				$order = new UplataIsplataPrenos($_POST, 'Prenos');
				break;
			case 'koverte-dostavnice-formulari/koverte-sa-povratnicom':
				include("../registration/koverta_sa_povratnicom.php");
				$order = new KovertaSaPovratnicom($_POST);
				break;
			case 'koverte-dostavnice-formulari/dostavnice':
				include("../registration/dostavnica.php");
				$order = new Dostavnica($_POST);
				break;
			case 'koverte-dostavnice-formulari/koverte-sa-dostavnicom':
				include("../registration/koverta_sa_dostavnicom.php");
				$order = new KovertaSaDostavnicom($_POST);
				break;
			case 'koverte-dostavnice-formulari/formulari-za-adresiranje':
				include("../registration/formular_za_adresiranje.php");
				$order = new FormularZaAdresiranje($_POST);
				break;
			case 'koverte-dostavnice-formulari/standardne-koverte':
				include("../registration/standardna_koverta.php");
				$order = new StandardnaKoverta($_POST);
				break;
			case 'omot-spisa':
				include("../registration/omot_spisa.php");
				$order = new OmotSpisa($_POST);
				break;
		}
		
		require_once("../registration/connection.php");
		$db = new DB();
		$order->UserId = $_SESSION['user_info']->ID;
		$status = $db->saveOrder($order);
		if($status === true){
			unset($_POST);
			$_POST = array();
			unset($statusMessage);			
			$_SESSION['orderSaved'] = 1;
		} else {
			$_SESSION['orderSaved'] = 2;
		}	
		
		echo $status;
	}
?>