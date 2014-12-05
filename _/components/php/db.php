<?php

try
{
	//$pdo = new PDO('mysql:host=localhost;dbname=db190263_should', 'root', '');
	$pdo = new PDO('mysql:host=localhost;dbname=db190263_should', 'db190263_should', 'D34dweight!');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
	$error = 'Unable to connect to the Should database server. <br>' . $e->getMessage();
	include 'error.php';
	exit();
}
