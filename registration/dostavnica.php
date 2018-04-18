<?php
class Dostavnica {
	var $OrderID;
	var $Recipient;
	var $Name;
	var $Address;
	var $ZipCode;
	var $Location;
	var $Quantity;
	var $SendCopy;
	
	function __construct($data){
		$this->Recipient = $data['forInput'];
		$this->Name = isset($data['nameLastname']) && !empty($data['nameLastname']) ? $data['nameLastname'] : null;
		$this->Address = isset($data['adress']) && !empty($data['adress']) ? $data['adress'] : null;
		$this->ZipCode = isset($data['zipCode']) && !empty($data['zipCode']) ? $data['zipCode'] : null;
		$this->Location = isset($data['location']) && !empty($data['location']) ? $data['location'] : null;
		$this->Quantity = isset($data['quantity']) && !empty($data['quantity']) ? $data['quantity'] : null;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}
?>