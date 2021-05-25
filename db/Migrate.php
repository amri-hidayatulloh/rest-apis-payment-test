<?php
require "./Autoload.php";

if(php_sapi_name() !== 'cli') {
	throw new Exception("Unauthorized access");	
}

$sql = @file_get_contents("./db/base.sql");
$stmt = $conn->prepare($sql);
$exec = $stmt->execute();

if($exec) {
	echo "Migrate Success\n";
	die();
}

echo "Fail to Migrate\n";
