<?php
require __DIR__ . '/vendor/autoload.php';
require("DBConnection.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new DBConnection([
	'host' => $_ENV['DB_HOST'],
	'user' => $_ENV['DB_USER'],
	'password' => $_ENV['DB_PASSWORD'],
	'scheme' => $_ENV['DB_SCHEME']
]);

$conn = $db->getConnection();
