<?php 

include 'db.php';

//Cheapest rental sector
try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_rent A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE quarter_id = ( SELECT MAX( id ) FROM db190263_should.quarter ) AND
			H.name = "BACHELOR"
			ORDER BY cost ASC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for cheapest Bachelor apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$cheapest[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}

try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_rent A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE quarter_id = ( SELECT MAX( id ) FROM db190263_should.quarter ) AND
			H.name = "ONE-BEDROOM"
			ORDER BY cost ASC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for cheapest One-Bedroom apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$cheapest[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}

try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_rent A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE quarter_id = ( SELECT MAX( id ) FROM db190263_should.quarter ) AND
			H.name = "TWO-BEDROOM"
			ORDER BY cost ASC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for cheapest Two-bedroom apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$cheapest[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}

try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_rent A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE quarter_id = ( SELECT MAX( id ) FROM db190263_should.quarter ) AND
			H.name = "THREE-BEDROOM"
			ORDER BY cost ASC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for cheapest Three-Bedroom apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$cheapest[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}


//Most expensive rental sector
try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_rent A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE quarter_id = ( SELECT MAX( id ) FROM db190263_should.quarter ) AND
			H.name = "BACHELOR"
			ORDER BY cost DESC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for most expensive Bachelor apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$expensive[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}

try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_rent A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE quarter_id = ( SELECT MAX( id ) FROM db190263_should.quarter ) AND
			H.name = "ONE-BEDROOM"
			ORDER BY cost DESC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for most expensive One-Bedroom apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$expensive[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}

try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_rent A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE quarter_id = ( SELECT MAX( id ) FROM db190263_should.quarter ) AND
			H.name = "TWO-BEDROOM"
			ORDER BY cost DESC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for most expensive Two-bedroom apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$expensive[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}

try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_rent A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE quarter_id = ( SELECT MAX( id ) FROM db190263_should.quarter ) AND
			H.name = "THREE-BEDROOM"
			ORDER BY cost DESC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for most expensive Three-Bedroom apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$expensive[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}


//Most expensive sector to buy a detached house
try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_cost A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE monthly_report_id = ( SELECT MAX( id ) FROM db190263_should.monthly_report ) AND
			H.name = "DETACHED HOUSES"
			ORDER BY cost DESC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for most expensive Three-Bedroom apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$expensiveBuy[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}

//Most expensive sector to buy a detached house
try
{
	$sql = 'SELECT sector_id, S.name as sector, H.name as type, cost 
			FROM db190263_should.average_cost A
			INNER JOIN db190263_should.sector S ON sector_id = S.id
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			WHERE monthly_report_id = ( SELECT MAX( id ) FROM db190263_should.monthly_report ) AND
			H.name = "DETACHED HOUSES"
			ORDER BY cost ASC
			LIMIT 0, 1';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for most expensive Three-Bedroom apartment. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$cheapestBuy[] = array('sector' => $row['sector'], 'type' => $row['type'], 'cost' => $row['cost']);
}


//Most crime
try
{
	$sql = 'SELECT S.name as sector, count(C.id) as crimes FROM db190263_should.crime C
			INNER JOIN db190263_should.sector S ON S.id = sector_id
			WHERE date > "2010-12-31"
			GROUP BY sector_id
			ORDER BY crimes DESC
			LIMIT 0, 3';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for highest crime incidents. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$dangerous[] = array('sector' => $row['sector'], 'crimes' => $row['crimes']);
}


//Least crime
try
{
	$sql = 'SELECT S.name as sector, count(C.id) as crimes FROM db190263_should.crime C
			INNER JOIN db190263_should.sector S ON S.id = sector_id
			WHERE date > "2010-12-31"
			GROUP BY sector_id
			ORDER BY crimes ASC
			LIMIT 0, 3';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving results for lowest crime incidents. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$safe[] = array('sector' => $row['sector'], 'crimes' => $row['crimes']);
}