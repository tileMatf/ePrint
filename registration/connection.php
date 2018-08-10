<?php

require_once("order.php");

class DB {
	protected $config;
    public static $connection;
    public function __construct(){
        if(!isset(self::$connection)){
            try{
				self::$connection=new PDO("mysql:host=localhost;dbname=eprint", "root", "", 
						array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
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
        return $result;
	}
	
	public function addUser($user){
		try{
			$query = self::$connection->prepare("insert into users (Email, Password, Role)
					values (:email, :pass, :role);");
			$query->bindParam(':email',$user->Email, PDO::PARAM_STR);
			$query->bindParam(':pass',$user->Password, PDO::PARAM_STR);
			$query->bindParam(':role', $user->Role, PDO::PARAM_INT);
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
			$query = self::$connection->prepare("select ID from users where Email=:email;");
			$query->bindParam(':email',$email, PDO::PARAM_STR);
			$query->execute();
			$row_count = $query->rowCount();
			if($row_count === 1){
				$query = self::$connection->prepare("select ID, Email, Role from users where Email=:email and Password=:pass;");
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
	
	private function insertOrder($order){
		try{
			$query = self::$connection->prepare("INSERT INTO orders (TypeID, UserID, OrderDate, Seen, SavedOrder, DeliveryName, 
				DeliveryEmail, DeliveryPhone, DeliveryAddress, DeliveryZipCode, DeliveryLocation) 
				VALUES (:typeID, :userID, NOW(), 0, :savedOrder, :name, :email, :phone, :address, :zipCode, :location)");
			$query->bindValue(":typeID", $order->TypeID, PDO::PARAM_INT);
			$query->bindValue(":userID", $order->UserID, PDO::PARAM_INT);
			$query->bindValue(":savedOrder", $order->SavedOrder, PDO::PARAM_INT);
			$query->bindValue(":name", $order->DeliveryName, PDO::PARAM_STR);
			$query->bindValue(":email", $order->DeliveryEmail, PDO::PARAM_STR);
			$query->bindValue(":phone", $order->DeliveryPhone, PDO::PARAM_STR);
			$query->bindValue(":address", $order->DeliveryAddress, PDO::PARAM_STR);
			$query->bindValue(":zipCode", $order->DeliveryZipCode, PDO::PARAM_STR);
			$query->bindValue(":location", $order->DeliveryLocation, PDO::PARAM_STR);			
			$query->execute();
			
			if($query->rowCount() > 0){	
				return self::$connection->lastInsertId();
			} else {
				print_r(self::$connection->errorInfo());
				return -1;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
		
	private function insertStampanje($stampanje){
		try{
			$stampanje->TypeID = 1;
			$orderID = $this->insertOrder($stampanje);
			if($orderID > 0){
				$query = self::$connection->prepare("INSERT INTO stampanje (OrderID, FileName, CopyNumber, PageOrder, Color, PagePrintType, PaperSize,
					PaperWidth, BindingType, BindingFile, HeftingType, DrillingType, Comment, SendCopy) 
					VALUES (:orderID, :fileName, :copyNumber, :pageOrder, :color, :pagePrintType, :paperSize, 
							:paperWidth, :bindingType, :bindingFile, :heftingType, :drillingType, :comment, :sendCopy)");
				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
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
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	private function insertBlok($blok){
		try{
			$blok->TypeID = 2;
			$orderID = $this->insertOrder($blok);
			if($orderID > 0){
				$query = self::$connection->prepare("INSERT INTO blokovi (OrderID, FileName, NumberOfSet, Color, Size, Packing, Comment, SendCopy) 
					VALUES (:orderID, :fileName, :numberOfSet, :color, :size, :packing, :comment, :sendCopy)");
				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
				$query->bindValue(":fileName", $blok->FileName, PDO::PARAM_STR);
				$query->bindValue(":numberOfSet", $blok->NumberOfSet, PDO::PARAM_INT);
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
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	private function insertNalog($nalog){
		try{
			if($nalog->Type == 'Uplata')
				$nalog->TypeID = 3;
			else if($nalog->Type == 'Isplata')
				$nalog->TypeID = 4;
			else 
				$nalog->TypeID = 5;
			$orderID = $this->insertOrder($nalog);
			if($orderID > 0){
				if($nalog->Type == 'Uplata' || $nalog->Type == 'Isplata'){
					$query = self::$connection->prepare("INSERT INTO `uplate-isplate` (OrderID, Type, Name, Address, Location, Country, PaymentPurpose,
						Recipient, PaymentCode, Currency, Amount, RecipientAccount, Model, ReferenceNumber, PaymentSlipNumber, SetQuantity, Comment, 
						VariableData, SendCopy) VALUES (:orderID, :type, :name, :address, :location, :country, :paymentPurpose, :recipient, 
						:paymentCode, :currency, :amount, :recipientAccount, :model, :referenceNumber, :paymentSlipNumber, :setQuantity, :comment,
						:variableData, :sendCopy)");
					$query->bindValue(":type", $nalog->Type, PDO::PARAM_STR);
					$query->bindValue(":model", $nalog->Model, PDO::PARAM_STR);
				} else if($nalog->Type == 'Prenos'){
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

				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
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
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	private function insertKovertaSaPovratnicom($koverta){
		try{
			$koverta->TypeID = 6;
			$orderID = $this->insertOrder($koverta);
			if($orderID > 0){
				$query = self::$connection->prepare("INSERT INTO `koverte-sa-povratnicom` (OrderID, Color, Quantity, SendCopy) 
					VALUES (:orderID, :color, :quantity, :sendCopy)");
				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
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
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	private function insertDostavnica($dostavnica){
		try{
			$dostavnica->TypeID = 7;
			$orderID = $this->insertOrder($dostavnica);
			if($orderID > 0){
				$query = self::$connection->prepare("INSERT INTO `dostavnice` (OrderID, Recipient, Name, Address, ZipCode, Location, Quantity, SendCopy) 
					VALUES (:orderID, :recipient, :name, :address, :zipCode, :location, :quantity, :sendCopy)");
				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
				$query->bindValue(":recipient", $dostavnica->Recipient, PDO::PARAM_STR);
				$query->bindValue(":name", $dostavnica->Name, PDO::PARAM_STR);
				$query->bindValue(":address", $dostavnica->Address, PDO::PARAM_STR);
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
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	private function insertKovertaSaDostavnicom($koverta){
		try{
			$koverta->TypeID = 8;
			$orderID = $this->insertOrder($koverta);
			if($orderID > 0){				
				$query = self::$connection->prepare("INSERT INTO `koverte-sa-dostavnicom` (OrderID, Recipient, Color, Name, Address, ZipCode, Location,
					PostagePaid, EnvelopeType, Quantity, SendCopy) 
					VALUES (:orderID, :recipient, :color, :name, :address, :zipCode, :location, :postagePaid, :envelopeType, :quantity, :sendCopy)");
				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
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
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	private function insertFormular($formular){
		try{
			$formular->TypeID = 9;
//			$this->beginTransaction();
			$orderID = $this->insertOrder($formular);
			if($orderID > 0){
				$query = self::$connection->prepare("INSERT INTO `formulari-za-adresiranje` (OrderID, Quantity, Type, SendCopy) 
					VALUES (:orderID, :quantity, :type, :sendCopy)");
				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
				$query->bindValue(":quantity", $formular->Quantity, PDO::PARAM_INT);
				$query->bindValue(":type", $formular->Type, PDO::PARAM_STR);
				$query->bindValue(":sendCopy", $formular->SendCopy, PDO::PARAM_INT);
				$query->execute();
				if($query->rowCount() > 0){
						return true;
				} else {
					print_r(self::$connection->errorInfo());
					return false;
				}
			} else {
//				$this->rollBack();
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}	
	}
	
	private function insertStandardnaKoverta($koverta){
		try{
			$koverta->TypeID = 10;
			$orderID = $this->insertOrder($koverta);
			if($orderID > 0){
				$query = self::$connection->prepare("INSERT INTO `standardne-koverte` (OrderID, Size, Quantity, BackPrintRow1, BackPrintRow2, 
				BackPrintRow3, BackPrintRow4, AddressPrintRow1, AddressPrintRow2, AddressPrintRow3, AddressPrintRow4, Comment, VariableData, SendCopy) 
					VALUES (:orderID, :size, :quantity, :backPrintRow1, :backPrintRow2, :backPrintRow3, :backPrintRow4, :addressPrintRow1, 
					:addressPrintRow2, :addressPrintRow3, :addressPrintRow4, :comment, :variableData, :sendCopy)");
				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
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
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	private function insertOmotSpisa($omot){
		try{
			$omot->TypeID = 11;
			$orderID = $this->insertOrder($omot);
			if($orderID > 0){
				$query = self::$connection->prepare("INSERT INTO `omot-spisa` (OrderID, Recipient, Name, Address, Location,
					PaperType, Quantity, Comment, SendCopy) 
					VALUES (:orderID, :recipient, :name, :address, :location, :paperType, :quantity, :comment, :sendCopy)");
				$query->bindValue(":orderID", $orderID, PDO::PARAM_INT);
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
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	private function getOrdersOfType($userID, $type, $beforeDays, $nalogType = null) {
		try{
			if($nalogType != null){
				$query = self::$connection->prepare("SELECT * FROM `". $type ."` WHERE UserID = :userID AND Type = :nalogType
							AND SavedOrder = 1"); //AND DATE(OrderDate) >= DATE(DATE_SUB(NOW(), INTERVAL ". $beforeDays ." DAY))
				$query->bindValue(":nalogType", $nalogType, PDO::PARAM_STR);
			} else {
				$query = self::$connection->prepare("SELECT * FROM `". $type ."` WHERE UserID = :userID 
							AND DATE(OrderDate) >= DATE(DATE_SUB(NOW(), INTERVAL ". $beforeDays ." DAY))
							AND SavedOrder = 1");
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

	public function getUnseenOrders($type){
		try{
			switch($type){
				case 'Stampanje':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM stampanjeorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
				case 'Preslikavajuci blokovi':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM blokoviorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
				case 'Uplate':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM uplateisplateorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 AND Type = 'Uplata' ORDER BY OrderDate");
					break;
				case 'Isplate':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM uplateisplateorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 AND Type = 'Isplata' ORDER BY OrderDate");
					break;
				case 'Prenos':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM prenosorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
				case 'Koverta-sa-povratnicom':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM kovertesapovratnicomorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
				case 'Dostavnica':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM dostavniceorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
				case 'Koverta-sa-dostavnicom':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM kovertesadostavnicomorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
				case 'Formular-za-adresiranje':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM formulariorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
				case 'Standardna-koverta':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM standardnekoverteorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
				case 'Omot-spisa':
					$query = self::$connection->prepare("SELECT u.ID, u.Email, o.* FROM omotispisaorder o INNER JOIN users u ON u.ID = o.UserID WHERE Seen = 0 ORDER BY OrderDate");
					break;
			}
			
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
	
	public function getSavedOrders($userID, $type){
		try{
			switch($type){
				case 'Stampanje':
					$query = self::$connection->prepare("SELECT o.* FROM stampanjeorder o WHERE UserID = :userID ORDER BY OrderDate");
					break;
				case 'Preslikavajuci blokovi':
					$query = self::$connection->prepare("SELECT o.* FROM blokoviorder o WHERE UserID = :userID ORDER BY OrderDate");
					break;
				case 'Uplate':
					$query = self::$connection->prepare("SELECT o.* FROM uplateisplateorder o WHERE UserID = :userID AND Type = 'Uplata' ORDER BY OrderDate");
					break;
				case 'Isplate':
					$query = self::$connection->prepare("SELECT o.* FROM uplateisplateorder o WHERE UserID = :userID AND Type = 'Isplata' ORDER BY OrderDate");
					break;
				case 'Prenos':
					$query = self::$connection->prepare("SELECT o.* FROM prenosorder o D WHERE UserID = :userID ORDER BY OrderDate");
					break;
				case 'Koverta-sa-povratnicom':
					$query = self::$connection->prepare("SELECT o.* FROM kovertesapovratnicomorder o WHERE UserID = :userID ORDER BY OrderDate");
					break;
				case 'Dostavnica':
					$query = self::$connection->prepare("SELECT o.* FROM dostavniceorder o WHERE UserID = :userID ORDER BY OrderDate");
					break;
				case 'Koverta-sa-dostavnicom':
					$query = self::$connection->prepare("SELECT o.* FROM kovertesadostavnicomorder o WHERE UserID = :userID ORDER BY OrderDate");
					break;
				case 'Formular-za-adresiranje':
					$query = self::$connection->prepare("SELECT o.* FROM formulariorder o WHERE UserID = :userID ORDER BY OrderDate");
					break;
				case 'Standardna-koverta':
					$query = self::$connection->prepare("SELECT o.* FROM standardnekoverteorder o WHERE UserID = :userID ORDER BY OrderDate");
					break;
				case 'Omot-spisa':
					$query = self::$connection->prepare("SELECT o.* FROM omotispisaorder o WHERE UserID = :userID ORDER BY OrderDate");
					break;
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
	
	public function saveOrder($order) {
		try{
			$saved = false;

			if($order instanceof Stampanje){
				$saved = $this->insertStampanje($order);
			} else if($order instanceof Blok){
				$saved = $this->insertBlok($order);
			} else if($order instanceof UplataIsplataPrenos){
				$saved = $this->insertNalog($order);
			} else if($order instanceof KovertaSaPovratnicom){
				$saved = $this->insertKovertaSaPovratnicom($order);
			} else if($order instanceof Dostavnica){
				$saved = $this->insertDostavnica($order);
			} else if($order instanceof KovertaSaDostavnicom){
				$saved = $this->insertKovertaSaDostavnicom($order);
			} else if($order instanceof FormularZaAdresiranje){
				$saved = $this->insertFormular($order);
			} else if($order instanceof StandardnaKoverta){
				$saved = $this->insertStandardnaKoverta($order);
			} else if($order instanceof OmotSpisa){
				$saved = $this->insertOmotSpisa($order);
			}
			return $saved;
		} catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	
	public function addAdmin($email, $pass){
		try{
			$admin = new User($email, $pass, 1);
			$sql_result = $this->addUser($admin);
			return $sql_result;
		} catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	public function getIdOfUnregisterUser(){
		try{
			$query = self::$connection->prepare("SELECT ID FROM users WHERE Role = 3");
			$query->execute();
			if($query->rowCount() > 0){
				return $query->fetchAll(PDO::FETCH_OBJ);
			} else {
				return false;
			}
		} catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	public function changePass($id, $old_pass, $new_pass){
		try{
			$query = self::$connection->prepare("SELECT * FROM users WHERE ID = :id AND Password = :pass");
			$query->bindValue(":id", $id, PDO::PARAM_INT);
			$query->bindValue(":pass", $old_pass, PDO::PARAM_STR);
			$query->execute();
			if($query->rowCount() === 1){
				$query = self::$connection->prepare("UPDATE users SET Password = :pass WHERE ID = :id");
				$query->bindValue(":pass", $new_pass, PDO::PARAM_STR);
				$query->bindValue(":id", $id, PDO::PARAM_INT);
				$query->execute();
				if($query->rowCount() === 1){
					return true;
				} else {
					//echo $query->mysql_info();
					return $query->mysql_info();
				}
			} else {
				return false;
			}
		} catch(PDOException $e){
			//echo $e->getMessage();
			return $e->getMessage();
		}
	}
}

//$conn = new DB();

//echo json_encode($conn->getOrdersOfType(21, 'standardnekoverteorder', 10)[0]);
//echo json_encode($conn->getOrdersOfType(21, 'uplateisplateorder', 10, 'Uplata'));
//echo json_encode($conn->getOrders(21, 10));

/*
$stampanje = new Stampanje();
$stampanje->OrderID = 3;
$stampanje->FileName = 'ime fajla13';
$stampanje->CopyNumber = 51;
$stampanje->PageOrder = 1;
$stampanje->Color = 'U boji';
$stampanje->PagePrintType = 'Dvostrano';
$stampanje->PaperSize = 'A4';
$stampanje->PaperWidth = '80 gr/m2';
$stampanje->BindingType = 'Tvrdo koricenje';
$stampanje->HeftingType = 'Dole desno';
$stampanje->DrillingType = 'Dve rupe za registrator levo';
$stampanje->SendCopy = 0;*/
//echo $conn->insertStampanje($stampanje);
//echo $conn->updateOrderStampanje($stampanje);
//echo $conn->saveOrder($stampanje);

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

/*$k = array('forInput' => 'Javni izvrsitelj', 'color' => 'Plave', 'nameLastname' => 'Zorana', 'adress' => 'Adresa',
	'zipCode' => '26000', 'location' => 'Cara Dusana 16a', 'postagePaid' => '...', 'quantity' => '1000', 'envelopeType' => 'S0', 
	'sendCopy' => 0, 'deliveryAddress' => 'deliveryAddress', 'deliveryZipCode' => 'deliveryZipCode', 'deliveryLocation' => 'deliveryLocation');
$dostavnica = new KovertaSaDostavnicom($k);
$dostavnica->UserID = 3;
$dostavnica->TypeID = 1;*/
/*$dostavnica->ID = 2;
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
$dostavnica->DeliveryAddress = "adresa isporuke";
$dostavnica->DeliveryZipCode = "zip isporuke";
$dostavnica->DeliveryLocation = "mesto isporuke";*/
//echo $conn->saveOrder($dostavnica);

/*$a['deliveryAddress'] = 'aa';
$a['deliveryEmail'] = 'bb';
$a['deliveryLocation'] = 'cc';
$a['deliveryName'] = 'dd';
$a['deliveryZipCode'] = 'ee';
$a['quantity'] = '1230';
$a['typeOfEnvelope'] = 'S6';
$formular = new FormularZaAdresiranje($a);
$formular->UserID = 3;
echo $conn->insertFormular($formular);*/

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
