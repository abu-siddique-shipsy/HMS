<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

if(isset($_POST))
{
	$amt = $_POST['amt'];
	$id = $_POST['id'];
	$registration_id = $_POST['reg_id'];
	$query = "insert into patient_charges (registration_id,charged_by,amt,) values ('$registration_id','$id','$amt')";

	$result = $DBcon->query($query);
	
	$response = new stdClass();
	
	$response->data = $result;
	$response->status = "success";
	echo json_encode($response);
}
?>