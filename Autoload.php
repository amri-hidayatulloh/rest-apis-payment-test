<?php
require __DIR__ . '/vendor/autoload.php';
require "system/DBConnection.php";
require "system/Helper.php";
require "model/PaymentModel.php";

//Load dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Create new connection
$db = new DBConnection([
	'host' => $_ENV['DB_HOST'],
	'user' => $_ENV['DB_USER'],
	'password' => $_ENV['DB_PASSWORD'],
	'scheme' => $_ENV['DB_SCHEME']
]);

//Passing connection into model
$conn = $db->getConnection();
$payment = new PaymentModel($conn);

//Init object helper
$helper = new Helper();
