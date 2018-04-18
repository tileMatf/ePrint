<?php
class StandardnaKoverta {
	var $OrderID;
	var $Size;
	var $Quantity;
	var $BackPrintRow1;
	var $BackPrintRow2;
	var $BackPrintRow3;
	var $BackPrintRow4;
	var $AddressPrintRow1;
	var $AddressPrintRow2;
	var $AddressPrintRow3;
	var $AddressPrintRow4;
	var $Comment;
	var $VariableData;
	var $SendCopy;
	
	function __construct($data){
		$this->Size = $data['size'];
		$this->Quantity = $data['quantity'];
		$this->BackPrintRow1 = isset($data['printingOnBack1']) ? $data['printingOnBack1'] : null;
		$this->BackPrintRow2 = isset($data['printingOnBack2']) ? $data['printingOnBack2'] : null;
		$this->BackPrintRow3 = isset($data['printingOnBack3']) ? $data['printingOnBack3'] : null;
		$this->BackPrintRow4 = isset($data['printingOnBack4']) ? $data['printingOnBack4'] : null;
		$this->AddressPrintRow1 = isset($data['printingOnAdressPage1']) ? $data['printingOnAdressPage1'] : null;
		$this->AddressPrintRow2 = isset($data['printingOnAdressPage2']) ? $data['printingOnAdressPage2'] : null;
		$this->AddressPrintRow3 = isset($data['printingOnAdressPage3']) ? $data['printingOnAdressPage3'] : null;
		$this->AddressPrintRow4 = isset($data['printingOnAdressPage4']) ? $data['printingOnAdressPage4'] : null;
		$this->Comment = isset($data['comment']) && !empty($data['comment']) ? $data['comment'] : null;
		$this->VariableData = isset($data['varData']) ? 1 : 0;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}

}
?>