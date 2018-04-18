<?php
class UplataIsplataPrenos {
	var $OrderID;
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
		$this->VariableData = isset($data['numOfPaySet']) ? 1 : 0;
		$this->SendCopy = isset($data['sendCopy']) ? 1 : 0;

		$this->OrdererAccount = isset($data['accountOfOrderer']) && !empty($data['accountOfOrderer']) ? $data['accountOfOrderer'] : null;
		$this->ModelDebit = isset($data['mockUpDebit']) && !empty($data['mockUpDebit']) ? $data['mockUpDebit'] : null;		
		$this->ReferenceNumberApprovals = isset($data['referenceNumberApprovals']) && !empty($data['referenceNumberApprovals']) ? $data['referenceNumberApprovals'] : null;
	}
}
?>