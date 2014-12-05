<?php
include 'db.php';
$crimetypes = array();
$sector = null;
if (isset ( $_POST ['crimetypes'] )) {
	$crimetypes = $_POST ['crimetypes'];
	//echo json_encode(implode(",",$crimetypes));
}

if (isset ( $_POST ['sector'] )) {
	$sector = $_POST['sector'];
}

try {
	if ($sector) {
		$query = "select * from db190263_should.coordinates
				where id in (
					select coordinates from db190263_should.crime
					where crime_type in (".implode(",",$crimetypes).")
							and crime.date>='2011-01-01'
							and sector_id = (select id from db190263_should.sector where name like '".$sector."'));";
	}
	else {
		$query = "select * from db190263_should.coordinates
					where id in (
						select coordinates from db190263_should.crime
						where crime_type in (".implode(",",$crimetypes).")
								and crime.date>='2011-01-01')";
	}
	$s = $pdo->prepare ( $query );
	$s->execute();
} catch ( PDOException $e ) {
	$error = 'Error submitting query <br>' . $query . '<br>' . $e->getMessage ();
	echo $error;
	exit ();
}

$results = array();
foreach ( $s as $row ) {
	array_push($results, $row);
}

echo json_encode($results);