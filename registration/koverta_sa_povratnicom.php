<?php
class KovertaSaPovratnicom {
	var $OrderID;
	var $Color;
	var $Quantity;
	var $SendCopy;
	
	function __construct($data){
		$this->Quantity = $data['quantity'];
		$this->Color = $data['color'];
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}
?>