<?php
class Stampanje {
	var $OrderID;
	var $FileName;
	var $CopyNumber;
	var $PageOrder;
	var $Color;
	var $PagePrintType;
	var $PaperSize;
	var $PaperWidth;
	var $BindingType;
	var $BindingFile;
	var $HeftingType;
	var $DrillingType;
	var $Comment;
	var $SendCopy;
	
	function __construct($data){
		$this->FileName = isset($data['fileToUploadName']) ? $data['fileToUploadName'] : null; 
		$this->CopyNumber = $data['noInput'];
		$this->PageOrder = $data['orderOfInput'];
		$this->Color = $data['colorOfInput'];
		$this->PagePrintType = $data['typeOfPrint'];
		$this->PaperSize = $data['paperSize'];
		$this->PaperWidth = $data['paperWidth'];
		$this->BindingType = $data['bindingType'];
		$this->BindingFile = isset($data['bindingFileToUploadName']) ? $data['bindingFileToUploadName'] : null;
		$this->HeftingType = $data['heftingType'];
		$this->DrillingType = $data['drillingType'];
		$this->Comment = isset($data['comment']) && !empty($data['comment']) ? $data['comment'] : null;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}
?>