<?php
class Order {
	var $ID;
	var $TypeID;
	var $UserID;
	var $OrderDate;
	var $Seen;
	var $DeliveryAddress;
	var $DeliveryZipCode;
	var $DeliveryLocation;
	
	/*function __construct($data) {
		$this->ID = isset($data['ID']) && !empty($data['ID']) ? $data['ID'] : null;
		$this->TypeID = isset($TypeID) && !empty($TypeID) ? $TypeID : null;
		$this->UserID = isset($UserID) && !empty($UserID) ? $UserID : null;
		$this->DeliveryAddress = isset($DeliveryAddress) && !empty($DeliveryAddress) ? $DeliveryAddress : null;
		$this->DeliveryZipCode = isset($DeliveryZipCode) && !empty($DeliveryZipCode) ? $DeliveryZipCode : null;
		$this->DeliveryLocation = isset($DeliveryLocation) && !empty($DeliveryLocation) ? $DeliveryLocation : null;
	}*/
}

class OmotSpisa extends Order {
	//var $OrderID;
	var $Recipient;
	var $Name;
	var $Address;
	var $Location;
	var $PaperType;
	var $Quantity;
	var $Comment;
	var $SendCopy;
	
	function __construct($data){
		//parent::__construct($data);
		$this->Recipient = $data['forInput'];
		$this->Name = isset($data['nameLastname']) && !empty($data['nameLastname']) ? $data['nameLastname'] : null;
		$this->Address = isset($data['address']) && !empty($data['address']) ? $data['address'] : null;
		$this->Location = isset($data['location']) && !empty($data['location']) ? $data['location'] : null;
		$this->PaperType = $data['typeOfPaper'];
		$this->Quantity = isset($data['quantity']) && !empty($data['quantity']) ? $data['quantity'] : null;
		$this->Comment = isset($data['comment']) && !empty($data['comment']) ? $data['comment'] : null;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}

?>