<?php
class OmotSpisa {
	var $OrderID;
	var $Recipient;
	var $Name;
	var $Address;
	var $Location;
	var $PaperType;
	var $Quantity;
	var $Comment;
	var $SendCopy;
	
	function __construct($data){
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