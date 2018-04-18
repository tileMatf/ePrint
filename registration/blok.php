<?php
class Blok {
	var $OrderID;
	var $FileName;
	var $NumberOfSet;
	var $Color;
	var $Size;
	var $Packing;
	var $Comment;
	var $SendCopy;
	
	function __construct($data){
		$this->FileName = isset($data['fileToUploadName']) ? $data['fileToUploadName'] : null;
		$this->NumberOfSet = $data['noOfSet'];
		$this->Color = $data['blockColor'];
		$this->Size = $data['blockSize'];
		$this->Packing = $data['packing'];
		$this->Comment = isset($data['comment']) && !empty($data['comment']) ? $data['comment'] : null;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}
?>