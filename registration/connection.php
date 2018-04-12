<?php

require_once("blok.php");
require_once("stampanje.php");
require_once("uplata_isplata_prenos.php");
require_once("koverta_sa_povratnicom.php");
require_once("dostavnica.php");
require_once("koverta_sa_dostavnicom.php");
require_once("formular_za_adresiranje.php");
require_once("standardna_koverta.php");
require_once("omot_spisa.php");
require_once("order.php");

class DB {
    public static $connection;
    public function __construct(){
        if(!isset(self::$connection)){
            try{
				self::$connection=new PDO("mysql:host=localhost;dbname=eprint", "root", "", 
						array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); // uzimati podatke iz config.php
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
        }
    }

    public function __destruct(){
        self::$connection = null;
    }
	
	public function checkMailOccupancy($email){
		$query = self::$connection->prepare("select * from users where Email=:email;");
		$query->bindParam(':email',$email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
		echo "COUNT: " . count($result) . "<br>Compare:" . count($result) == 0 . "<br>";
        return $result;
	}
	
	public function insertUser($email, $pass){
		try{
			$query = self::$connection->prepare("insert into users (Email, Password, Role)
					values (:email, :pass, :role);");
			$role = 2;
			$query->bindParam(':email',$email, PDO::PARAM_STR);
			$query->bindParam(':pass',$pass, PDO::PARAM_STR);
			$query->bindParam(':role', $role, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
				return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function loginCheck($email, $pass){
		try{
			$query = self::$connection->prepare("select * from users where Email=:email;");
			$query->bindParam(':email',$email, PDO::PARAM_STR);
			$query->execute();
			$row_count = $query->rowCount();
			if($row_count === 1){
				$query = self::$connection->prepare("select * from users where Email=:email and Password=:pass;");
				$query->bindParam(':email',$email, PDO::PARAM_STR);
				$query->bindParam(':pass',$pass, PDO::PARAM_STR);
				$query->execute();
				$row_count = $query->rowCount();
				if($row_count === 1){
					return $query->fetchAll(PDO::FETCH_OBJ);
				} else if($row_count === 0){
					return 0; /*pogresna lozinka*/
				}
			} else if($row_count === 0){
				return null; /*ne postoji u bazi*/
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return null;
		}		
	}
	
	public function insertOrder($order){
		try{
			$query = self::$connection->prepare("INSERT INTO orders (TypeID, UserID, OrderDate, Seen) 
				VALUES (:typeID, :userID, NOW(), 0)");
			$query->bindValue(":typeID", $order->TypeID, PDO::PARAM_INT);
			$query->bindValue(":userID", $order->UserID, PDO::PARAM_INT);
			
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
		
	public function insertStampanje($stampanje){
		try{
			$query = self::$connection->prepare("INSERT INTO stampanje (OrderID, FileName, CopyNumber, PageOrder, Color, PagePrintType, PaperSize,
				PaperWidth, BindingType, BindingFile, HeftingType, DrillingType, Comment, SendCopy) 
				VALUES (:orderID, :fileName, :copyNumber, :pageOrder, :color, :pagePrintType, :paperSize, 
						:paperWidth, :bindingType, :bindingFile, :heftingType, :drillingType, :comment, :sendCopy)");
			$query->bindValue(":orderID", $stampanje->OrderID, PDO::PARAM_INT);
			$query->bindValue(":fileName", $stampanje->FileName, PDO::PARAM_STR);
			$query->bindValue(":copyNumber", $stampanje->CopyNumber, PDO::PARAM_INT);
			$query->bindValue(":pageOrder", $stampanje->PageOrder, PDO::PARAM_INT);
			$query->bindValue(":color", $stampanje->Color, PDO::PARAM_STR);
			$query->bindValue(":pagePrintType", $stampanje->PagePrintType, PDO::PARAM_STR);
			$query->bindValue(":paperSize", $stampanje->PaperSize, PDO::PARAM_STR);
			$query->bindValue(":paperWidth", $stampanje->PaperWidth, PDO::PARAM_STR);
			$query->bindValue(":bindingType", $stampanje->BindingType, PDO::PARAM_STR);
			$query->bindValue(":bindingFile", $stampanje->BindingFile, PDO::PARAM_STR);
			$query->bindValue(":heftingType", $stampanje->HeftingType, PDO::PARAM_STR);
			$query->bindValue(":drillingType", $stampanje->DrillingType, PDO::PARAM_STR);
			$query->bindValue(":comment", $stampanje->Comment, PDO::PARAM_STR);
			$query->bindValue(":sendCopy", $stampanje->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function insertBlok($blok){
		try{
			$query = self::$connection->prepare("INSERT INTO blokovi (OrderID, FileName, Color, Size, Packing, Comment, SendCopy) 
				VALUES (:orderID, :fileName, :color, :size, :packing, :comment, :sendCopy)");
			$query->bindValue(":orderID", $blok->OrderID, PDO::PARAM_INT);
			$query->bindValue(":fileName", $blok->FileName, PDO::PARAM_STR);
			$query->bindValue(":color", $blok->Color, PDO::PARAM_STR);
			$query->bindValue(":size", $blok->Size, PDO::PARAM_STR);
			$query->bindValue(":packing", $blok->Packing, PDO::PARAM_STR);
			$query->bindValue(":comment", $blok->Comment, PDO::PARAM_STR);
			$query->bindValue(":sendCopy", $blok->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function insertNalog($nalog){
		try{
			if($nalog->Type != null){
				$query = self::$connection->prepare("INSERT INTO `uplate-isplate` (OrderID, Type, Name, Address, Location, Country, PaymentPurpose,
					Recipient, PaymentCode, Currency, Amount, RecipientAccount, Model, ReferenceNumber, PaymentSlipNumber, SetQuantity, Comment, 
					VariableData, SendCopy) VALUES (:orderID, :type, :name, :address, :location, :country, :paymentPurpose, :recipient, 
					:paymentCode, :currency, :amount, :recipientAccount, :model, :referenceNumber, :paymentSlipNumber, :setQuantity, :comment,
					:variableData, :sendCopy)");
				$query->bindValue(":type", $nalog->Type, PDO::PARAM_STR);
				$query->bindValue(":model", $nalog->ModelApproval, PDO::PARAM_STR);
			} else {
				$query = self::$connection->prepare("INSERT INTO prenos (OrderID, Name, Address, Location, Country, PaymentPurpose,
					Recipient, PaymentCode, Currency, Amount, RecipientAccount, ModelDebit, ReferenceNumber, PaymentSlipNumber, SetQuantity, Comment, 
					VariableData, SendCopy, OrdererAccount, ModelApproval, ReferenceNumberApprovals) VALUES (:orderID, :name, :address, 
					:location, :country, :paymentPurpose, :recipient, :paymentCode, :currency, :amount, :recipientAccount, :modelDebit, :referenceNumber,
					:paymentSlipNumber, :setQuantity, :comment, :variableData, :sendCopy, :ordererAccount, :modelApproval, :refNumberApproval)");
				$query->bindValue(":ordererAccount", $nalog->OrdererAccount, PDO::PARAM_INT);
				$query->bindValue(":modelDebit", $nalog->ModelDebit, PDO::PARAM_STR);
				$query->bindValue(":modelApproval", $nalog->ModelApproval, PDO::PARAM_STR);
				$query->bindValue(":refNumberApproval", $nalog->ReferenceNumberApprovals, PDO::PARAM_STR);
			}

			$query->bindValue(":orderID", $nalog->OrderID, PDO::PARAM_INT);
			$query->bindValue(":name", $nalog->Name, PDO::PARAM_STR);
			$query->bindValue(":address", $nalog->Address, PDO::PARAM_INT);
			$query->bindValue(":location", $nalog->Location, PDO::PARAM_INT);
			$query->bindValue(":country", $nalog->Country, PDO::PARAM_STR);
			$query->bindValue(":paymentPurpose", $nalog->PaymentPurpose, PDO::PARAM_STR);
			$query->bindValue(":recipient", $nalog->Recipient, PDO::PARAM_STR);
			$query->bindValue(":paymentCode", $nalog->PaymentCode, PDO::PARAM_STR);
			$query->bindValue(":currency", $nalog->Currency, PDO::PARAM_STR);
			$query->bindValue(":amount", $nalog->Amount, PDO::PARAM_INT);
			$query->bindValue(":recipientAccount", $nalog->RecipientAccount, PDO::PARAM_STR);
			$query->bindValue(":referenceNumber", $nalog->ReferenceNumber, PDO::PARAM_STR);
			$query->bindValue(":paymentSlipNumber", $nalog->PaymentSlipNumber, PDO::PARAM_INT);
			$query->bindValue(":setQuantity", $nalog->SetQuantity, PDO::PARAM_STR);
			$query->bindValue(":comment", $nalog->Comment, PDO::PARAM_STR);
			$query->bindValue(":variableData", $nalog->VariableData, PDO::PARAM_INT);
			$query->bindValue(":sendCopy", $nalog->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function insertKovertaSaPovratnicom($koverta){
		try{
			$query = self::$connection->prepare("INSERT INTO `koverte-sa-povratnicom` (OrderID, Color, Quantity, SendCopy) 
				VALUES (:orderID, :color, :quantity, :sendCopy)");
			$query->bindValue(":orderID", $koverta->OrderID, PDO::PARAM_INT);
			$query->bindValue(":color", $koverta->Color, PDO::PARAM_STR);
			$query->bindValue(":quantity", $koverta->Quantity, PDO::PARAM_STR);
			$query->bindValue(":sendCopy", $koverta->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function insertDostavnica($dostavnica){
		try{
			$query = self::$connection->prepare("INSERT INTO `dostavnice` (OrderID, Recipient, Name, ZipCode, Location, Quantity, SendCopy) 
				VALUES (:orderID, :recipient, :name, :zipCode, :location, :quantity, :sendCopy)");
			$query->bindValue(":orderID", $dostavnica->OrderID, PDO::PARAM_INT);
			$query->bindValue(":recipient", $dostavnica->Recipient, PDO::PARAM_STR);
			$query->bindValue(":name", $dostavnica->Name, PDO::PARAM_STR);
			$query->bindValue(":zipCode", $dostavnica->ZipCode, PDO::PARAM_INT);
			$query->bindValue(":location", $dostavnica->Location, PDO::PARAM_STR);
			$query->bindValue(":quantity", $dostavnica->Quantity, PDO::PARAM_INT);
			$query->bindValue(":sendCopy", $dostavnica->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function insertKovertaSaDostavnicom($koverta){
		try{
			$query = self::$connection->prepare("INSERT INTO `koverte-sa-dostavnicom` (OrderID, Recipient, Color, Name, Address, ZipCode, Location,
				PostagePaid, EnvelopeType, Quantity, SendCopy) 
				VALUES (:orderID, :recipient, :color, :name, :address, :zipCode, :location, :postagePaid, :envelopeType, :quantity, :sendCopy)");
			$query->bindValue(":orderID", $koverta->OrderID, PDO::PARAM_INT);
			$query->bindValue(":recipient", $koverta->Recipient, PDO::PARAM_STR);
			$query->bindValue(":color", $koverta->Color, PDO::PARAM_STR);
			$query->bindValue(":name", $koverta->Name, PDO::PARAM_STR);
			$query->bindValue(":address", $koverta->Address, PDO::PARAM_STR);
			$query->bindValue(":zipCode", $koverta->ZipCode, PDO::PARAM_INT);
			$query->bindValue(":location", $koverta->Location, PDO::PARAM_STR);
			$query->bindValue(":postagePaid", $koverta->PostagePaid, PDO::PARAM_STR);
			$query->bindValue(":envelopeType", $koverta->EnvelopeType, PDO::PARAM_STR);
			$query->bindValue(":quantity", $koverta->Quantity, PDO::PARAM_INT);
			$query->bindValue(":sendCopy", $koverta->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	public function insertFormular($formular){
		try{
			$query = self::$connection->prepare("INSERT INTO `formulari-za-adresiranje` (OrderID, Quantity) 
				VALUES (:orderID, :quantity)");
			$query->bindValue(":orderID", $formular->OrderID, PDO::PARAM_INT);
			$query->bindValue(":quantity", $formular->Quantity, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}	
	}
	
	public function insertStandardnaKoverta($koverta){
		try{
			$query = self::$connection->prepare("INSERT INTO `standardne-koverte` (OrderID, Size, Quantity, BackPrintRow1, BackPrintRow2, 
			BackPrintRow3, BackPrintRow4, AddressPrintRow1, AddressPrintRow2, AddressPrintRow3, AddressPrintRow4, Comment, VariableData, SendCopy) 
				VALUES (:orderID, :size, :quantity, :backPrintRow1, :backPrintRow2, :backPrintRow3, :backPrintRow4, :addressPrintRow1, 
				:addressPrintRow2, :addressPrintRow3, :addressPrintRow4, :comment, :variableData, :sendCopy)");
			$query->bindValue(":orderID", $koverta->OrderID, PDO::PARAM_INT);
			$query->bindValue(":size", $koverta->Size, PDO::PARAM_STR);
			$query->bindValue(":quantity", $koverta->Quantity, PDO::PARAM_INT);
			$query->bindValue(":backPrintRow1", $koverta->BackPrintRow1, PDO::PARAM_STR);
			$query->bindValue(":backPrintRow2", $koverta->BackPrintRow2, PDO::PARAM_STR);
			$query->bindValue(":backPrintRow3", $koverta->BackPrintRow3, PDO::PARAM_STR);
			$query->bindValue(":backPrintRow4", $koverta->BackPrintRow4, PDO::PARAM_STR);
			$query->bindValue(":addressPrintRow1", $koverta->AddressPrintRow1, PDO::PARAM_STR);
			$query->bindValue(":addressPrintRow2", $koverta->AddressPrintRow2, PDO::PARAM_STR);
			$query->bindValue(":addressPrintRow3", $koverta->AddressPrintRow3, PDO::PARAM_STR);
			$query->bindValue(":addressPrintRow4", $koverta->AddressPrintRow4, PDO::PARAM_STR);
			$query->bindValue(":comment", $koverta->Comment, PDO::PARAM_STR);
			$query->bindValue(":variableData", $koverta->VariableData, PDO::PARAM_INT);
			$query->bindValue(":sendCopy", $koverta->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function insertOmotSpisa($omot){
		try{
			$query = self::$connection->prepare("INSERT INTO `omot-spisa` (OrderID, Recipient, Name, Address, Location,
				PaperType, Quantity, Comment, SendCopy) 
				VALUES (:orderID, :recipient, :name, :address, :location, :paperType, :quantity, :comment, :sendCopy)");
			$query->bindValue(":orderID", $omot->OrderID, PDO::PARAM_INT);
			$query->bindValue(":recipient", $omot->Recipient, PDO::PARAM_STR);
			$query->bindValue(":name", $omot->Name, PDO::PARAM_STR);
			$query->bindValue(":address", $omot->Address, PDO::PARAM_STR);
			$query->bindValue(":location", $omot->Location, PDO::PARAM_STR);
			$query->bindValue(":paperType", $omot->PaperType, PDO::PARAM_STR);
			$query->bindValue(":quantity", $omot->Quantity, PDO::PARAM_INT);
			$query->bindValue(":comment", $omot->Comment, PDO::PARAM_STR);
			$query->bindValue(":sendCopy", $omot->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
					return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function getOrdersOfType($userID, $type, $beforeDays, $nalogType = null) {
		try{
			if($nalogType != null){
				$query = self::$connection->prepare("SELECT * FROM `". $type ."` WHERE UserID = :userID AND Type = :nalogType
							AND DATE(OrderDate) >= DATE(DATE_SUB(NOW(), INTERVAL ". $beforeDays ." DAY))");
				$query->bindValue(":nalogType", $nalogType, PDO::PARAM_STR);
			} else {
				$query = self::$connection->prepare("SELECT * FROM `". $type ."` WHERE UserID = :userID 
							AND DATE(OrderDate) >= DATE(DATE_SUB(NOW(), INTERVAL ". $beforeDays ." DAY))");
			}
			
			$query->bindValue(":userID", $userID, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
				return $query->fetchAll(PDO::FETCH_OBJ);
			} else {
				return null;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function getOrders($userID, $beforeDays) {
		$stampanjeOrders = $this->getOrdersOfType($userID, 'stampanjeorder', $beforeDays);
		$blokoviOrders = $this->getOrdersOfType($userID, 'blokoviorder', $beforeDays);
		$uplateOrders = $this->getOrdersOfType($userID, 'uplateisplateorder', $beforeDays, 'Uplata');
		$isplateOrders = $this->getOrdersOfType($userID, 'uplateisplateorder', $beforeDays, 'Isplata');
		$prenosOrders = $this->getOrdersOfType($userID, 'prenosOrder', $beforeDays);
		$koverteSaPovratnicomOrders = $this->getOrdersOfType($userID, 'kovertesapovratnicomorder', $beforeDays);
		$dostavniceOrders = $this->getOrdersOfType($userID, 'dostavniceorder', $beforeDays);
		$koverteSaDostavnicomOrders = $this->getOrdersOfType($userID, 'kovertesadostavnicomorder', $beforeDays);
		$formulariOrders = $this->getOrdersOfType($userID, 'formulariorder', $beforeDays);
		$standardneKoverteOrders = $this->getOrdersOfType($userID, 'standardnekoverteorder', $beforeDays);
		$omotSpisaOrders = $this->getOrdersOfType($userID, 'omotispisaorder', $beforeDays);
		
		$orders = array();
		array_push($orders, $stampanjeOrders, $blokoviOrders, $uplateOrders, $isplateOrders, $prenosOrders, $koverteSaPovratnicomOrders,
			$dostavniceOrders, $koverteSaDostavnicomOrders, $formulariOrders, $standardneKoverteOrders, $omotSpisaOrders);
		return $orders;
	}
	
	public function updateOrder($orderID){
		try{
			$query = self::$connection->prepare("UPDATE orders SET 
					OrderDate = NOW()
					WHERE ID = :orderID");
			$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() >= 0){
				return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	
	public function updateOrderStampanje($stampanje){
		try{
			$query = self::$connection->prepare("UPDATE stampanje SET 
					FileName = :fileName, 
					CopyNumber = :copyNumber, 
					PageOrder = :pageOrder, 
					Color = :color, 
					PagePrintType = :pagePrintType, 
					PaperSize = :paperSize, 
					PaperWidth = :paperWidth, 
					BindingType = :bindingType, 
					BindingFile = :bindingFile, 
					HeftingType = :heftingType, 
					DrillingType = :drillingType,
					Comment = :comment, 
					SendCopy = :sendCopy
					WHERE OrderID = :orderID");
			$query->bindValue(":orderID", $stampanje->OrderID, PDO::PARAM_INT);
			$query->bindValue(":fileName", $stampanje->FileName, PDO::PARAM_STR);
			$query->bindValue(":copyNumber", $stampanje->CopyNumber, PDO::PARAM_INT);
			$query->bindValue(":pageOrder", $stampanje->PageOrder, PDO::PARAM_INT);
			$query->bindValue(":color", $stampanje->Color, PDO::PARAM_STR);
			$query->bindValue(":pagePrintType", $stampanje->PagePrintType, PDO::PARAM_STR);
			$query->bindValue(":paperSize", $stampanje->PaperSize, PDO::PARAM_STR);
			$query->bindValue(":paperWidth", $stampanje->PaperWidth, PDO::PARAM_STR);
			$query->bindValue(":bindingType", $stampanje->BindingType, PDO::PARAM_STR);
			$query->bindValue(":bindingFile", $stampanje->BindingFile, PDO::PARAM_STR);
			$query->bindValue(":heftingType", $stampanje->HeftingType, PDO::PARAM_STR);
			$query->bindValue(":drillingType", $stampanje->DrillingType, PDO::PARAM_STR);
			$query->bindValue(":comment", $stampanje->Comment, PDO::PARAM_STR);
			$query->bindValue(":sendCopy", $stampanje->SendCopy, PDO::PARAM_INT);
			$query->execute();
			$done = false;
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($stampanje->OrderID);			
			return $done;
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function updateOrderBlok($blok){
		try{
			$query = self::$connection->prepare("UPDATE blokovi SET 
					FileName = :fileName, 
					Color = :color, 
					Size = :size, 
					Packing = :packing, 
					Comment = :comment, 
					SendCopy = :sendCopy
					WHERE OrderID = :orderID");
			$query->bindValue(":orderID", $blok->OrderID, PDO::PARAM_INT);
			$query->bindValue(":fileName", $blok->FileName, PDO::PARAM_STR);
			$query->bindValue(":color", $blok->Color, PDO::PARAM_STR);
			$query->bindValue(":size", $blok->Size, PDO::PARAM_STR);
			$query->bindValue(":packing", $blok->Packing, PDO::PARAM_STR);
			$query->bindValue(":comment", $blok->Comment, PDO::PARAM_STR);
			$query->bindValue(":sendCopy", $blok->SendCopy, PDO::PARAM_INT);
			$query->execute();
			$done = false;
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($blok->OrderID);			
			return $done;
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function updateOrderNalog($nalog){
		try{
		if($nalog->Type != null){
				$query = self::$connection->prepare("UPDATE `uplate-isplate` SET
					Type = :type, 
					Name = :name, 
					Address = :address, 
					Location = :location, 
					Country = :country, 
					PaymentPurpose = :paymentPurpose,
					Recipient = :recipient, 
					PaymentCode = :paymentCode, 
					Currency = :currency, 
					Amount = :amount, 
					RecipientAccount = :recipientAccount, 
					Model = :model, 
					ReferenceNumber = :referenceNumber, 
					PaymentSlipNumber = :paymentSlipNumber, 
					SetQuantity = :setQuantity, 
					Comment = :comment, 
					VariableData = :variableData, 
					SendCopy = :sendCopy
					WHERE OrderID = :orderID");
				$query->bindValue(":type", $nalog->Type, PDO::PARAM_STR);
				$query->bindValue(":model", $nalog->ModelApproval, PDO::PARAM_STR);
			} else {
				$query = self::$connection->prepare("UPDATE `prenos` SET
					Name = :name, 
					Address = :address, 
					Location = :location, 
					Country = :country, 
					PaymentPurpose = :paymentPurpose,
					Recipient = :recipient, 
					PaymentCode = :paymentCode, 
					Currency = :currency, 
					Amount = :amount, 
					RecipientAccount = :recipientAccount, 
					ReferenceNumber = :referenceNumber, 
					PaymentSlipNumber = :paymentSlipNumber, 
					SetQuantity = :setQuantity, 
					Comment = :comment, 
					VariableData = :variableData, 
					SendCopy = :sendCopy,
					OrdererAccount = :ordererAccount,
					ModelApproval = :modelApproval,
					ReferenceNumberApprovals = :refNumberApproval,
					ModelDebit = :modelDebit
					WHERE OrderID = :orderID");
				$query->bindValue(":ordererAccount", $nalog->OrdererAccount, PDO::PARAM_INT);
				$query->bindValue(":modelDebit", $nalog->ModelDebit, PDO::PARAM_STR);
				$query->bindValue(":modelApproval", $nalog->ModelApproval, PDO::PARAM_STR);
				$query->bindValue(":refNumberApproval", $nalog->ReferenceNumberApprovals, PDO::PARAM_STR);
			}
			
			$query->bindValue(":orderID", $nalog->OrderID, PDO::PARAM_INT);
			$query->bindValue(":name", $nalog->Name, PDO::PARAM_STR);
			$query->bindValue(":address", $nalog->Address, PDO::PARAM_INT);
			$query->bindValue(":location", $nalog->Location, PDO::PARAM_INT);
			$query->bindValue(":country", $nalog->Country, PDO::PARAM_STR);
			$query->bindValue(":paymentPurpose", $nalog->PaymentPurpose, PDO::PARAM_STR);
			$query->bindValue(":recipient", $nalog->Recipient, PDO::PARAM_STR);
			$query->bindValue(":paymentCode", $nalog->PaymentCode, PDO::PARAM_STR);
			$query->bindValue(":currency", $nalog->Currency, PDO::PARAM_STR);
			$query->bindValue(":amount", $nalog->Amount, PDO::PARAM_INT);
			$query->bindValue(":recipientAccount", $nalog->RecipientAccount, PDO::PARAM_STR);
			$query->bindValue(":referenceNumber", $nalog->ReferenceNumber, PDO::PARAM_STR);
			$query->bindValue(":paymentSlipNumber", $nalog->PaymentSlipNumber, PDO::PARAM_INT);
			$query->bindValue(":setQuantity", $nalog->SetQuantity, PDO::PARAM_STR);
			$query->bindValue(":comment", $nalog->Comment, PDO::PARAM_STR);
			$query->bindValue(":variableData", $nalog->VariableData, PDO::PARAM_INT);
			$query->bindValue(":sendCopy", $nalog->SendCopy, PDO::PARAM_INT);
			
			$query->execute();
			$done = false;
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($nalog->OrderID);			
			return $done;
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function updateOrderKovertaSaPovratnicom($koverta){
		try{
			$query = self::$connection->prepare("UPDATE `koverte-sa-povratnicom` SET 
				Color = :color, 
				Quantity = :quantity, 
				SendCopy = :sendCopy
				WHERE OrderID = :orderID");
			
			$query->bindValue(":orderID", $koverta->OrderID, PDO::PARAM_INT);
			$query->bindValue(":color", $koverta->Color, PDO::PARAM_STR);
			$query->bindValue(":quantity", $koverta->Quantity, PDO::PARAM_STR);
			$query->bindValue(":sendCopy", $koverta->SendCopy, PDO::PARAM_INT);
			
			$query->execute();
			$done = false;
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($koverta->OrderID);			
			return $done;
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function updateOrderDostavnica($dostavnica){
		try{
			$query = self::$connection->prepare("UPDATE `dostavnice` SET 
				Recipient = :recipient, 
				Name = :name, 
				ZipCode = :zipCode, 
				Location = :zipCode, 
				Quantity = :quantity, 
				SendCopy = :sendCopy 
				WHERE OrderID = :orderID");
			$query->bindValue(":orderID", $dostavnica->OrderID, PDO::PARAM_INT);
			$query->bindValue(":recipient", $dostavnica->Recipient, PDO::PARAM_STR);
			$query->bindValue(":name", $dostavnica->Name, PDO::PARAM_STR);
			$query->bindValue(":zipCode", $dostavnica->ZipCode, PDO::PARAM_INT);
			$query->bindValue(":location", $dostavnica->Location, PDO::PARAM_STR);
			$query->bindValue(":quantity", $dostavnica->Quantity, PDO::PARAM_INT);
			$query->bindValue(":sendCopy", $dostavnica->SendCopy, PDO::PARAM_INT);			
			$query->execute();
			$done = false;
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($dostavnica->OrderID);			
			return $done;
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function updateOrderKovertaSaDostavnicom($koverta){
		try{
			$query = self::$connection->prepare("UPDATE `koverte-sa-dostavnicom` SET 
				Recipient = :recipient, 
				Color = :color, 
				Name = :name, 
				Address = :address, 
				ZipCode = :zipCode, 
				Location = :location,
				PostagePaid = :postagePaid, 
				EnvelopeType = :envelopeType, 
				Quantity = :quantity, 
				SendCopy = :sendCopy
				WHERE OrderID = :orderID");
			$query->bindValue(":orderID", $koverta->OrderID, PDO::PARAM_INT);
			$query->bindValue(":recipient", $koverta->Recipient, PDO::PARAM_STR);
			$query->bindValue(":color", $koverta->Color, PDO::PARAM_STR);
			$query->bindValue(":name", $koverta->Name, PDO::PARAM_STR);
			$query->bindValue(":address", $koverta->Address, PDO::PARAM_STR);
			$query->bindValue(":zipCode", $koverta->ZipCode, PDO::PARAM_INT);
			$query->bindValue(":location", $koverta->Location, PDO::PARAM_STR);
			$query->bindValue(":postagePaid", $koverta->PostagePaid, PDO::PARAM_STR);
			$query->bindValue(":envelopeType", $koverta->EnvelopeType, PDO::PARAM_STR);
			$query->bindValue(":quantity", $koverta->Quantity, PDO::PARAM_INT);
			$query->bindValue(":sendCopy", $koverta->SendCopy, PDO::PARAM_INT);		
			$query->execute();
			$done = false;
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($koverta->OrderID);			
			return $done;
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
		public function updateOrderStandardnaKoverta($koverta){
		try{
			$query = self::$connection->prepare("UPDATE `standardne-koverte` SET 
				Size = :size, 
				Quantity = :quantity, 
				BackPrintRow1 = :backPrintRow1, 
				BackPrintRow2 = :backPrintRow2, 
				BackPrintRow3 = :backPrintRow3, 
				BackPrintRow4 = :backPrintRow4,
				AddressPrintRow1 = :addressPrintRow1, 
				AddressPrintRow2 = :addressPrintRow2, 
				AddressPrintRow3 = :addressPrintRow3, 
				AddressPrintRow4 = :addressPrintRow4,
				Comment = :comment,
				VariableData = :variableData,
				SendCopy = :sendCopy
				WHERE OrderID = :orderID");
			$query->bindValue(":orderID", $koverta->OrderID, PDO::PARAM_INT);
			$query->bindValue(":size", $koverta->Size, PDO::PARAM_STR);
			$query->bindValue(":quantity", $koverta->Quantity, PDO::PARAM_INT);
			$query->bindValue(":backPrintRow1", $koverta->BackPrintRow1, PDO::PARAM_STR);
			$query->bindValue(":backPrintRow2", $koverta->BackPrintRow2, PDO::PARAM_STR);
			$query->bindValue(":backPrintRow3", $koverta->BackPrintRow3, PDO::PARAM_STR);
			$query->bindValue(":backPrintRow4", $koverta->BackPrintRow4, PDO::PARAM_STR);
			$query->bindValue(":addressPrintRow1", $koverta->AddressPrintRow1, PDO::PARAM_STR);
			$query->bindValue(":addressPrintRow2", $koverta->AddressPrintRow2, PDO::PARAM_STR);
			$query->bindValue(":addressPrintRow3", $koverta->AddressPrintRow3, PDO::PARAM_STR);
			$query->bindValue(":addressPrintRow4", $koverta->AddressPrintRow4, PDO::PARAM_STR);
			$query->bindValue(":comment", $koverta->Comment, PDO::PARAM_STR);
			$query->bindValue(":variableData", $koverta->VariableData, PDO::PARAM_INT);	
			$query->bindValue(":sendCopy", $koverta->SendCopy, PDO::PARAM_INT);
			$query->execute();
			$done = false;
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($koverta->OrderID);			
			return $done;
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function updateOrderFormularZaAdresiranje($formular){
		try{
			$query = self::$connection->prepare("UPDATE `formulari-za-adresiranje` SET 
				Quantity = :quantity 
				WHERE OrderID = :orderID");
			$query->bindValue(":orderID", $formular->OrderID, PDO::PARAM_INT);
			$query->bindValue(":quantity", $formular->Quantity, PDO::PARAM_INT);
			$query->execute();
			$done = false;
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($formular->OrderID);			
			return $done;
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function updateOrderOmotSpisa($omot){
		try{
			$query = self::$connection->prepare("UPDATE `omot-spisa` SET 
			OrderID = :orderID, 
			Recipient = :recipient, 
			Name = :name, 
			Address = :address, 
			Location = :location,
			PaperType = :paperType, 
			Quantity = :quantity, 
			Comment = :comment, 
			SendCopy = :sendCopy 
			WHERE OrderID = :orderID");
			$query->bindValue(":orderID", $omot->OrderID, PDO::PARAM_INT);
			$query->bindValue(":recipient", $omot->Recipient, PDO::PARAM_STR);
			$query->bindValue(":name", $omot->Name, PDO::PARAM_STR);
			$query->bindValue(":address", $omot->Address, PDO::PARAM_STR);
			$query->bindValue(":location", $omot->Location, PDO::PARAM_STR);
			$query->bindValue(":paperType", $omot->PaperType, PDO::PARAM_STR);
			$query->bindValue(":quantity", $omot->Quantity, PDO::PARAM_INT);
			$query->bindValue(":comment", $omot->Comment, PDO::PARAM_STR);
			$query->bindValue(":sendCopy", $omot->SendCopy, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() >= 0){
				$done = true;
			} else {
				print_r(self::$connection->errorInfo());
				$done = false;
			}
			$done = $done && $this->updateOrder($omot->OrderID);			
			return $done;
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function getUnseenOrder(){
		try{
			$query = self::$connection->prepare("SELECT * FROM orders WHERE Seen = 0 ORDER BY OrderDate");
			$query->execute();
			
			if($query->rowCount() > 0){
				return $query->fetchAll(PDO::FETCH_OBJ);
			} else {
				return null;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function checkOrder($id){
		try{
			$query = self::$connection->prepare("UPDATE orders SET Seen = :seen WHERE ID = :id");
			$query->bindValue(":id", $id, PDO::PARAM_INT);
			$query->bindValue(":seen", 1, PDO::PARAM_INT);
			$query->execute();
			
			if($query->rowCount() > 0){
				return true;
			} else {
				return null;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}	
	}
}	

$conn = new DB();

//echo json_encode($conn->getOrdersOfType(21, 'standardnekoverteorder', 10)[0]);
//echo json_encode($conn->getOrdersOfType(21, 'uplateisplateorder', 10, 'Uplata'));
//echo json_encode($conn->getOrders(21, 10));


/*$stampanje = new Stampanje();
$stampanje->OrderID = 2;
$stampanje->FileName = 'ime fajla1';
$stampanje->CopyNumber = 5;
$stampanje->PageOrder = 2;
$stampanje->Color = 'Crno belo';
$stampanje->PagePrintType = 'Dvostrano';
$stampanje->PaperSize = 'A4';
$stampanje->PaperWidth = '80 gr/m2';
$stampanje->BindingType = 'Tvrdo koricenje';
$stampanje->HeftingType = 'Dole desno';
$stampanje->DrillingType = 'Dve rupe za registrator desno';
$stampanje->SendCopy = 1;*/
//echo $conn->insertStampanje($stampanje);
//echo $conn->updateOrderStampanje($stampanje);

/*$uplata = new UplataIsplataPrenos();
$uplata->OrderID = 2;
//$uplata->Type = 'Uplata';
$uplata->Name = 'Tijana Kostic';
$uplata->Recipient = 'Matematicki fakultet';
$uplata->Amount = 232;
$uplata->VariableData = 1;
$uplata->SendCopy = 0;
echo $conn->updateOrderNalog($uplata);*/

/*$koverta = new KovertaSaPovratnicom();
$koverta->OrderID = 2;
$koverta->Color = 'Bela';
$koverta->Quantity = 9000;
$koverta->SendCopy = 0;
echo $conn->updateOrderKovertaSaPovratnicom($koverta);*/


/*$dostavnica = new Dostavnica();
$dostavnica->OrderID = 2;
$dostavnica->Recipient = 'Javni beleznik';
$dostavnica->Name = 'Zorana Kostic';
$dostavnica->ZipCode = 26000;
$dostavnica->Location = 'Cara Dusana 16a';
$dostavnica->Quantity = 1000;
$dostavnica->SendCopy = 1;
echo $conn->updateOrderDostavnica($dostavnica);*/

/*$dostavnica = new KovertaSaDostavnicom();
$dostavnica->OrderID = 2;
$dostavnica->Recipient = 'Javni izvrsitelj';
$dostavnica->Color = 'Plave';
$dostavnica->Name = 'Zorana Kostic';
$dostavnica->Address = 'Adresa';
$dostavnica->ZipCode = 26000;
$dostavnica->Location = 'Cara Dusana 16a';
$dostavnica->PostagePaid = 'Posta';
$dostavnica->EnvelopeType = 'S0';
$dostavnica->Quantity = 1000;
$dostavnica->SendCopy = 1;
echo $conn->updateOrderKovertaSaDostavnicom($dostavnica);*/

/*echo $conn->insertFormular(2, 1000);*/

/*$koverta = new StandardnaKoverta();
$koverta->OrderID = 2;
$koverta->Size = 'B6';
$koverta->Quantity = 2000;
$koverta->BackPrintRow1 = 'Prvi red';
$koverta->BackPrintRow2 = 'Drugi red';
$koverta->BackPrintRow4 = 'Cetvrti';
$koverta->AddressPrintRow1 = 'hihihihi';
$koverta->VariableData = 0;
$koverta->SendCopy = 1;
echo $conn->updateOrderStandardnaKoverta($koverta);*/

/*$omotSpisa = new OmotSpisa();
$omotSpisa->OrderID = 2;
$omotSpisa->Recipient = 'Javni izvrsitelj';
$omotSpisa->Name = 'Zorana Kostic';
$omotSpisa->Address = 'Adresa';
$omotSpisa->PaperType = '100 gr/m2';
$omotSpisa->Quantity = 1000;
$omotSpisa->SendCopy = 1;
$omotSpisa->Comment = "Komentarkomentar...";
echo $conn->updateOrderOmotSpisa($omotSpisa);*/


//echo $conn->getTeamId('Serbia')[0]->id;
//echo $conn->getTeamleaderCount(1);
//echo json_encode($conn->getTeamPhoto(1));
//echo json_encode($conn->getMemberInfo(3));
//echo $conn->getMembers(1)[1]->country;
//echo json_encode($conn->addMember(3, $me));
//echo json_encode($conn->deleteMember(5));
//echo json_encode($conn->uploadPhoto(1, 'tijanaaaSlika.jpg'));
//echo $conn->getTeam("tijjana@hotmail.com", "chad")[0]->email; 

/*$order = new Order();
$order->UserID = 22;
$order->TypeID = 3;
echo $conn->insertOrder($order);*/

//echo json_encode($conn->getUnseenOrder());
//echo $conn->checkOrder(3);

?>