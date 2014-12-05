<?php

include 'db.php';

        
switch ($_POST["fname"]) {
    case 'getHousingData':
        getHousingData($pdo);
        break;
    case 'getCrimeData':
        if (isset($_POST["sectors"]))
            $sector = $_POST["sectors"]; 
        getCrimeData($pdo, $sector);
        break;
}

function getHousingData($pdo) {
    try {
        $query = 'SELECT name, avgCost, sector.id as sectorId 
                    FROM (SELECT sector_id, avg(cost) as avgCost 
                            FROM db190263_should.average_cost 
                            JOIN db190263_should.monthly_report 
                            ON monthly_report.id = average_cost.monthly_report_id 
                            WHERE year = 2014 
                            AND month in ("October", "September", "August") 
                            GROUP BY sector_id) 
                    AS avgthing 
                    JOIN db190263_should.sector 
                    WHERE sector.id = avgthing.sector_id 
                    ORDER BY avgCost DESC';
        
        $s = $pdo->prepare($query);
        $s->execute();
        
        //Parse result into an array
        $results = array();
        
        foreach ( $s as $row ) {
		array_push($results, $row);
	}
        
        echo json_encode($results);
        
    } catch (PDOException $e) {
        $error = 'Error submitting query <br>' . $query . '<br>' . $e->getMessage();
        echo $error;
        exit();
    }
}

function getCrimeData($pdo, $sector) {
    try {
        $query = "SELECT crime_type, count(id) as crimeTotal, sector_id 
                    FROM db190263_should.crime
                    WHERE sector_id in (".implode(",",$sector).")
                    GROUP BY sector_id, crime_type";
        
        $s = $pdo->prepare($query);
        $s->execute();
        
        //Parse result into an array
        $results = array();
	foreach ( $s as $row ) {
		array_push($results, $row);
	}
        
        
        echo json_encode($results);
        
    } catch (PDOException $e) {
        $error = 'Error submitting query ' . $query . ' ' . $e->getMessage();
        echo $error;
        exit();
    }
}