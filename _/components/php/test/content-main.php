<?php

include '_/components/php/test/db.php';

echo "Test";

try
{
	$sql = "SELECT count(*) FROM db190263_should.sector";
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$error = 'Error submitting query <br>' . $sql . '<br>' . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	var_dump($row);
}