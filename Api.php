<?php
require("Autoload.php");

if(isset($_GET['endpoint'])) {
	if($_GET['endpoint'] == 'create') {
		echo "Create";
	} else if($_GET['endpoint'] == 'status') {
		echo "Get Status";
	} else {
		header("HTTP/1.0 404 Not Found");
		echo "Unknown endpoint URL";
		die();
	}
} else {
	header("HTTP/1.0 404 Not Found");
	echo "Unknown endpoint URL";
	die();
}


