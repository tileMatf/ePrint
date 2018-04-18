<?php
class FormularZaAdresiranje {
	var $OrderID;
	var $Quantity;
	var $SendCopy;
	
	function __construct($data){
		$this->Quantity = $data['quantity'];
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}
?>