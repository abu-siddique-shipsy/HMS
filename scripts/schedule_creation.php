<?php

include __DIR__.'/../config.php';
include Class_path.'class.nursingStation.php';
$query = "SELECT * from ward_task where status = 0";
$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$result = $con->query($query);
$response=[];
while ($exe = $result->fetch_object()) 
{
	$response[] = $exe; 
}
nursingStation::createSchedule($response);
?>

