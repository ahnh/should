<?php
include 'db.php';

switch($_POST["fname"]){
	case 'getHousingAvgCost':
		$owner = null;
		$htype = null;
		
		if ($_POST["owner"])
			$owner = $_POST["owner"];
		if ($_POST["htype"])
			$htype = $_POST["htype"];
		if ($owner == "own")
			getAvgHouseCost($pdo, $htype);
		else
			getAvgRentalCost($pdo, $htype);
		break;
	case 'getHTypes':
		getHousingTypes($pdo);
		break;
}

function getAvgHouseCost($pdo, $htype)
{
	try {
		$query = "SELECT sector.name, cost 
						FROM db190263_should.average_cost, db190263_should.housing_type H, db190263_should.sector
						where monthly_report_id = (SELECT max(id) FROM db190263_should.monthly_report) and H.id = housing_type_id
						and sector_id = sector.id
						and H.name = '".$htype."'
						order by sector_id;";
		$s = $pdo->prepare ( $query );
		$s->execute();
	} catch ( PDOException $e ) {
		$error = 'Error submitting query <br>' . $error . '<br>' . $e->getMessage ();
		echo $error;
		exit ();
	}
	
	returnfunction($s);
}

function getAvgRentalCost($pdo, $htype)
{
	try {
		$query = "SELECT sector.name, cost
						FROM db190263_should.average_rent, db190263_should.housing_type H, db190263_should.sector
						where H.id = housing_type_id
						and sector_id = sector.id
						and H.name = '".$htype."'
						order by sector_id;";
		$s = $pdo->prepare ( $query );
		$s->execute();
	} catch ( PDOException $e ) {
		$error = 'Error submitting query <br>' . $query . '<br>' . $e->getMessage ();
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
