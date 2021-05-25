<?php
require "Autoload.php";

if(php_sapi_name() !== 'cli') {
	throw new Exception("Unauthorized access");	
}

if(!isset($argv[1])) {
	echo "Invalid Invoice ID\n";
}

if(!isset($argv[2])) {
	echo "Invalid Payment Status\n";
}

$invoiceId = $argv[1];
$paymentStatus = strtolower($argv[2]);

if(!in_array($paymentStatus, ['paid','pending','failed'])) {
	echo "Unknown Payment Status\n";
}

$data = $payment->getPaymentByInvoice($invoiceId);

if($data == false or count($data) == 0) {
	echo "Payment not found\n";
	die();
}

$update = $payment->updatePaymentStatus($invoiceId, $paymentStatus);

if($update) {
	$payment->logChange([
		'payment_id' => $data['id_payment'],
		'status' => $paymentStatus,
		'additional_info' => ''
	]);

	echo "Status updated succeffully\n";
} else {
	echo "Failed update status\n";
}




