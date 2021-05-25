<?php
require("Autoload.php");

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


echo "Status Updated\n";





