<?php

include 'db.php';

switch ($_POST["fname"]) {
    case 'getTotalAvgHouseCost':
        getTotalAvgPrice($pdo);
        break;
    case 'getCrimeAvgNum':
        getCrimeAvgNum($pdo);
        break;
}

function getTotalAvgPrice($pdo) {
    try {
        $year = date("Y");

        $query = "SELECT avg(cost) as avgCost
                    FROM db190263_should.average_cost 
                    JOIN db190263_should.monthly_report
                    ON monthly_report.id = average_cost.monthly_report_id
                    WHERE year = " . $year . "
                    AND month in (\"October\", \"September\", \"August\")
                    ORDER BY avgCost ASC";
        
        $s = $pdo->prepare($query);
        $s->execute();
        
    //Parse result into an array
    $results = array();
	foreach ( $s as $row ) {
		array_push($results, $row);
	}
        
        $query = "SELECT avg(cost) as avgCost
                    FROM db190263_should.average_rent 
                    JOIN db190263_should.quarter
                    ON quarter.id = average_rent.quarter_id
                    WHERE year = " . $year . "
                    AND quarter_name = 3
                    ORDER BY avgCost ASC";
        
        $s = $pdo->prepare($query);
        $s->execute();
        
        //Parse result into an array
        foreach ( $s as $row ) {
		array_push($results, $row);
	}
        
        echo json_encode($results);
        
    } catch (PDOException $e) {
        $error = 'Error submitting query <br>' . $sql . '<br>' . $e->getMessage();
        include 'error.php';
        exit();
    }
}

function getCrimeAvgNum($pdo) {
    try {
        $query = "SELECT crime_type, count(id) 
                    FROM db190263_should.crime
                    GROUP BY crime_type";
        
        $s = $pdo->prepare($query);
        $s->execute();
        
        //Parse result into an array
        $results = array();
	foreach ( $s as $row ) {
		array_push($results, $row);
	}
        
        echo json_encode($results);
        
    } catch (PDOException $e) {
        $error = 'Error submitting query <br>' . $sql . '<br>' . $e->getMessage();
        include 'error.php';
        exit();
    }
}
