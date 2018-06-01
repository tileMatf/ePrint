<?php
class Order {
	var $ID;
	var $TypeID;
	var $UserID;
	var $OrderDate;
	var $Seen;
	var $DeliveryName;
	var $DeliveryEmail;
	var $DeliveryAddress;
	var $DeliveryZipCode;
	var $DeliveryLocation;
	var $SavedOrder;
	
	function __construct($data){
		$this->ID = isset($data['ID']) && !empty($data['ID']) ? $data['ID'] : null;
		$this->DeliveryName = isset($data['deliveryName']) && !empty($data['deliveryName']) ? $data['deliveryName'] : null;
		$this->DeliveryEmail = isset($data['deliveryEmail']) && !empty($data['deliveryEmail']) ? $data['deliveryEmail'] : null;
		$this->DeliveryAddress = isset($data['deliveryAddress']) && !empty($data['deliveryAddress']) ? $data['deliveryAddress'] : null;
		$this->DeliveryZipCode = isset($data['deliveryZipCode']) && !empty($data['deliveryZipCode']) ? $data['deliveryZipCode'] : null;
		$this->DeliveryLocation = isset($data['deliveryLocation']) && !empty($data['deliveryLocation']) ? $data['deliveryLocation'] : null;
		$this->SavedOrder = isset($data['savedOrder']) ? 1 : 0;
	}
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
		parent::__construct($data);
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

class Blok extends Order{
	//var $OrderID;
	var $FileName;
	var $NumberOfSet;
	var $Color;
	var $Size;
	var $Packing;
	var $Comment;
	var $SendCopy;
	
	function __construct($data, $files){
		parent::__construct($data);
		$this->FileName = isset($files['fileToUpload']) ? $files['fileToUpload']['name'] : null;
		$this->NumberOfSet = $data['noOfSet'];
		$this->Color = $data['blockColor'];
		$this->Size = $data['blockSize'];
		$this->Packing = $data['packing'];
		$this->Comment = isset($data['comment']) && !empty($data['comment']) ? $data['comment'] : null;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}

class Dostavnica extends Order{
	//var $OrderID;
	var $Recipient;
	var $Name;
	var $Address;
	var $ZipCode;
	var $Location;
	var $Quantity;
	var $SendCopy;
	
	function __construct($data){
		parent::__construct($data);
		$this->Recipient = $data['forInput'];
		$this->Name = isset($data['nameLastname']) && !empty($data['nameLastname']) ? $data['nameLastname'] : null;
		$this->Address = isset($data['adress']) && !empty($data['adress']) ? $data['adress'] : null;
		$this->ZipCode = isset($data['zipCode']) && !empty($data['zipCode']) ? $data['zipCode'] : null;
		$this->Location = isset($data['location']) && !empty($data['location']) ? $data['location'] : null;
		$this->Quantity = isset($data['quantity']) && !empty($data['quantity']) ? $data['quantity'] : null;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}
class FormularZaAdresiranje extends Order{
	//var $OrderID;
	var $Quantity;
	var $SendCopy;
	var $Type;
	
	function __construct($data){
		parent::__construct($data);
		$this->Quantity = $data['quantity'];
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
		$this->Type = $data['typeOfEnvelope'];
	}
}

class KovertaSaDostavnicom extends Order{
	//var $OrderID;
	var $Recipient;
	var $Color;
	var $Name;
	var $Address;
	var $ZipCode;
	var $Location;
	var $PostagePaid;
	var $EnvelopeType;
	var $Quantity;
	var $SendCopy;
	
	function __construct($data){
		parent::__construct($data);
		$this->Recipient = $data['forInput'];
		$this->Color = $data['color'];
		$this->Name = isset($data['nameLastname']) && !empty($data['nameLastname']) ? $data['nameLastname'] : null;
		$this->Address = isset($data['adress']) && !empty($data['adress']) ? $data['adress'] : null;
		$this->ZipCode = isset($data['zipCode']) && !empty($data['zipCode']) ? $data['zipCode'] : null;
		$this->Location = isset($data['location']) && !empty($data['location']) ? $data['location'] : null;
		$this->PostagePaid = isset($data['postagePaid']) && !empty($data['postagePaid']) ? $data['postagePaid'] : null;
		$this->EnvelopeType = $data['envelopeType'];
		$this->Quantity = isset($data['quantity']) && !empty($data['quantity']) ? $data['quantity'] : null;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}

class KovertaSaPovratnicom extends Order{
	//var $OrderID;
	var $Color;
	var $Quantity;
	var $SendCopy;
	
	function __construct($data){
		parent::__construct($data);
		$this->Quantity = $data['quantity'];
		$this->Color = $data['color'];
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}

class Stampanje extends Order{
	//var $OrderID;
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
	
	function __construct($data, $files){
		parent::__construct($data);
		$this->FileName = isset($files['fileToUpload']) ? $files['fileToUpload']['name'] : null; 
		$this->CopyNumber = $data['noInput'];
		$this->PageOrder = $data['orderOfInput'];
		$this->Color = $data['colorOfInput'];
		$this->PagePrintType = $data['typeOfPrint'];
		$this->PaperSize = $data['paperSize'];
		$this->PaperWidth = $data['paperWidth'];
		$this->BindingType = $data['bindingType'];
		$this->BindingFile = isset($files['bindingFileToUpload']['name']) ? $files['bindingFileToUpload']['name'] : null;
		$this->HeftingType = $data['heftingType'];
		$this->DrillingType = $data['drillingType'];
		$this->Comment = isset($data['comment']) && !empty($data['comment']) ? $data['comment'] : null;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;
	}
}

class StandardnaKoverta extends Order{
	//var $OrderID;
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
		parent::__construct($data);
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

class UplataIsplataPrenos extends Order {
	//var $OrderID;
	var $Type;
	var $Name;
	var $Address;
	var $Location;
	var $Country;
	var $PaymentPurpose;
	var $Recipient;
	var $PaymentCode;
	var $Currency;
	var $Amount;
	var $RecipientAccount;
	var $Model; //for uplata ispalata
	var $ModelApproval; // for prenos
	var $ReferenceNumber;
	var $PaymentSlipNumber;
	var $SetQuantity;
	var $Comment;
	var $VariableData;
	var $SendCopy;
	var $OrdererAccount;	
	var $ModelDebit;
	var $ReferenceNumberApprovals;
	
	function __construct($data, $type){
		parent::__construct($data);
		$this->Type = $type;
		$this->Name = isset($data['payer']) && !empty($data['payer']) ? $data['payer'] : null;
		$this->Address = isset($data['address']) && !empty($data['address']) ? $data['address'] : null;
		$this->Location = isset($data['location']) && !empty($data['location']) ? $data['location'] : null;
		$this->Country = isset($data['country']) && !empty($data['country']) ? $data['country'] : null;
		$this->PaymentPurpose = isset($data['purposeOfPayment']) && !empty($data['purposeOfPayment']) ? $data['purposeOfPayment'] : null;
		$this->Recipient = isset($data['recipient']) && !empty($data['recipient']) ? $data['recipient'] : null;
		$this->PaymentCode = isset($data['paymentCode']) && !empty($data['paymentCode']) ? $data['paymentCode'] : null;
		$this->Currency = isset($data['currency']) && !empty($data['currency']) ? $data['currency'] : null;
		$this->Amount = isset($data['amount']) && !empty($data['amount']) ? $data['amount'] : null;
		$this->RecipientAccount = isset($data['accountOfRecipient']) && !empty($data['accountOfRecipient']) ? $data['accountOfRecipient'] : null;
		$this->Model = isset($data['mockUp']) && !empty($data['mockUp']) ? $data['mockUp'] : null;
		$this->ModelApproval = isset($data['mockUp']) && !empty($data['mockUp']) ? $data['mockUp'] : null;
		$this->ReferenceNumber = isset($data['referenceNumber']) && !empty($data['referenceNumber']) ? $data['referenceNumber'] : null;
		$this->PaymentSlipNumber = isset($data['numOfPaySet']) && !empty($data['numOfPaySet']) ? $data['numOfPaySet'] : null;
		$this->SetQuantity = isset($data['quantity']) && !empty($data['quantity']) ? $data['quantity'] : null;		
		$this->Comment = isset($data['comment']) && !empty($data['comment']) ? $data['comment'] : null;
		$this->VariableData = isset($data['varData']) ? 1 : 0;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;

		$this->OrdererAccount = isset($data['accountOfOrderer']) && !empty($data['accountOfOrderer']) ? $data['accountOfOrderer'] : null;
		$this->ModelDebit = isset($data['mockUpDebit']) && !empty($data['mockUpDebit']) ? $data['mockUpDebit'] : null;		
		$this->ReferenceNumberApprovals = isset($data['referenceNumberApprovals']) && !empty($data['referenceNumberApprovals']) ? $data['referenceNumberApprovals'] : null;
	}
}
?>