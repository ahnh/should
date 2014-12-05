<?php

include '_/components/php/db.php';

////////////////////
// Rental prices over last 3 quarters
////////////////////

// Rental prices by housing type for most current quarter
try
{
	$sql = 'SELECT H.name as name, quarter_name as quarter, year, count(A.id), ROUND(AVG(cost),0) as cost FROM db190263_should.average_rent A
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			INNER JOIN db190263_should.sector S ON S.id = sector_id
			INNER JOIN db190263_should.quarter Q ON Q.id = quarter_id
			WHERE quarter_id = ( SELECT id FROM db190263_should.quarter ORDER BY id DESC LIMIT 0, 1)
			GROUP BY H.id';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving rental statistics. " . $e->getMessage();
	echo $message;
	exit();
}

foreach($s as $row)
{
	$rental[] = array('name' => $row['name'], 'cost' => $row['cost'], 'quarter' => $row['quarter'], 'year' => $row['year']);
}

// Rental prices by housing type for 2nd most current quarter
try
{
	$sql = 'SELECT H.name as name, quarter_name as quarter, year, count(A.id) as count, ROUND(AVG(cost),0) as cost FROM db190263_should.average_rent A
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			INNER JOIN db190263_should.sector S ON S.id = sector_id
			INNER JOIN db190263_should.quarter Q ON Q.id = quarter_id
			WHERE quarter_id = ( SELECT id FROM db190263_should.quarter ORDER BY id DESC LIMIT 1, 1)
			GROUP BY H.id';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving rental statistics. " . $e->getMessage();
	echo $message;
	exit();
}

foreach($s as $row)
{
	$rental[] = array('name' => $row['name'], 'cost' => $row['cost'], 'quarter' => $row['quarter'], 'year' => $row['year']);
}

// Rental prices by housing type for 3rd most current quarter
try
{
	$sql = 'SELECT H.name as name, quarter_name as quarter, year, count(A.id) as count, ROUND(AVG(cost),0) as cost FROM db190263_should.average_rent A
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			INNER JOIN db190263_should.sector S ON S.id = sector_id
			INNER JOIN db190263_should.quarter Q ON Q.id = quarter_id
			WHERE quarter_id = ( SELECT id FROM db190263_should.quarter ORDER BY id DESC LIMIT 2, 1)
			GROUP BY H.id';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving rental statistics. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$rental[] = array('name' => $row['name'], 'cost' => $row['cost'], 'quarter' => $row['quarter'], 'year' => $row['year']);
}


////////////////////
// Buying prices over last 3 quarters
////////////////////


// Buying prices by housing type for most current quarter
try
{
	$sql = 'SELECT H.name as name, count(A.id) as count, ROUND(AVG(cost),0) as cost FROM db190263_should.average_cost A
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			INNER JOIN db190263_should.sector S ON S.id = sector_id
			INNER JOIN db190263_should.monthly_report Q ON Q.id = monthly_report_id
			WHERE monthly_report_id = ( SELECT id FROM db190263_should.monthly_report ORDER BY id DESC LIMIT 1, 1) OR
			monthly_report_id = ( SELECT id FROM db190263_should.monthly_report ORDER BY id DESC LIMIT 2, 1) OR
			monthly_report_id = ( SELECT id FROM db190263_should.monthly_report ORDER BY id DESC LIMIT 3, 1)
			GROUP BY H.id';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving rental statistics. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$buying[] = array('name' => $row['name'], 'cost' => $row['cost']);
}

// Rental prices by housing type for 2nd most current quarter
try
{
	$sql = 'SELECT H.name as name, count(A.id) as count, ROUND(AVG(cost),0) as cost FROM db190263_should.average_cost A
			INNER JOIN db190263_should.housing_type H ON housing_type_id = H.id
			INNER JOIN db190263_should.sector S ON S.id = sector_id
			INNER JOIN db190263_should.monthly_report Q ON Q.id = monthly_report_id
			WHERE monthly_report_id = ( SELECT id FROM db190263_should.monthly_report ORDER BY id DESC LIMIT 4, 1) OR
			monthly_report_id = ( SELECT id FROM db190263_should.monthly_report ORDER BY id DESC LIMIT 5, 1) OR
			monthly_report_id = ( SELECT id FROM db190263_should.monthly_report ORDER BY id DESC LIMIT 6, 1)
			GROUP BY H.id';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving rental statistics. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$buying[] = array('name' => $row['name'], 'cost' => $row['cost']);
}

////////////////////
// Crime numbers over past 2 years
////////////////////


// Crime by most recent year
try
{
	$sql = 'SELECT T.name as crime, date, count(C.id) as count FROM db190263_should.crime C
			INNER JOIN db190263_should.crime_type T ON T.id = crime_type
			WHERE date = (SELECT DISTINCT date FROM db190263_should.crime ORDER BY date DESC LIMIT 0, 1)
			GROUP BY crime_type
			ORDER BY crime_type';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving rental statistics. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$crime[] = array('crime' => $row['crime'], 'date' => $row['date'], 'count' => $row['count']);
}

// Crime by 2md most recent year
try
{
	$sql = 'SELECT T.name as crime, date, count(C.id) as count FROM db190263_should.crime C
			INNER JOIN db190263_should.crime_type T ON T.id = crime_type
			WHERE date = (SELECT DISTINCT date FROM db190263_should.crime ORDER BY date DESC LIMIT 1, 1)
			GROUP BY crime_type
			ORDER BY crime_type';
	$s = $pdo->prepare($sql);
	$s->execute();
}
catch(PDOException $e)
{
	$message = "Error retrieving rental statistics. " . $e->getMessage();
	include 'error.php';
	exit();
}

foreach($s as $row)
{
	$crime[] = array('crime' => $row['crime'], 'date' => $row['date'], 'count' => $row['count']);
}