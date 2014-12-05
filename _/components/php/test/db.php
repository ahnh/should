<?php
try
{
  $pdo = new PDO('mysql:host=external-db.s190263.gridserver.com', 'db190263_should', 'D34dweight!');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  $error = 'Unable to connect to the Should database server. <br>' . $e->getMessage();
  include 'error.php';
  exit();
}
