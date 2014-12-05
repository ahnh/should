<?php
include 'db.php';

switch($_POST["fname"]){
	case 'getSectors':
		getSectors($pdo);
		break;
	case 'getHTypes':
		getOwnerHousingTypes($pdo);
		break;
	case 'getRHTypes':
		getRentHousingTypes($pdo);
			break;
}

function getSectors($pdo)
{
	try {
		$query = "select name from db190263_should.sector where name like '___' order by name";
		$s = $pdo->prepare ( $query );
		$s->execute();
	} catch ( PDOException $e ) {
		$error = 'Error submitting query <br>' . $query . '<br>' . $e->getMessage();
		echo $error;
		exit ();
	}
	
	returnfunction($s);
}

function getOwnerHousingTypes($pdo)
{
	try {
		$query = "SELECT name FROM db190263_should.housing_type where ownership_type_id = 1 order by name";
		$s = $pdo->prepare ( $query );
		$s->execute();
	} catch ( PDOException $e ) {
		$error = 'Error submitting query <br>' . $query . '<br>' . $e->getMessage();
		echo $error;
		exit ();
	}
	
	returnfunction($s);
}


function getRentHousingTypes($pdo)
{
	try {
		$query = "SELECT name FROM db190263_should.housing_type where ownership_type_id = 2";
		$s = $pdo->prepare ( $query );
		$s->execute();
	} catch ( PDOException $e ) {
		$error = 'Error submitting query <br>' . $query . '<br>' . $e->getMessage();
		echo $error;
		exit ();
	}

	returnfunction($s);
}

function returnfunction($s)
{
	$results = array();
	foreach ( $s as $row ) {
		array_push($results, $row);
	}
	
	echo json_encode($results);
}
