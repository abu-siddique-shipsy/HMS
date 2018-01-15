<?php

include __DIR__.'/../config.php';
include Class_path.'class.physician.php';
$query = "SELECT * from physician phy join staff stf on stf.staff_id = phy.id where emp_type = 1";
$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$result = $con->query($query);
while ($exe = $result->fetch_object()) {
	$obj = new physician($exe->staff_id);
	$obj->setWorkingHours($exe->consulting_hrs_frm,$exe->consulting_hrs_to);
	$obj->createScheduled();	
}
