<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);

$id = $_POST['patient_id'];

$type = $_POST['type'];

$query = "select * from $type where id = $id";

$result = $DBcon->query($query);
$exe = $result->fetch_array();
$response = new stdClass();
$data = new stdClass();

if($type == 'Physician')
{
	$data->r1 = "Dr. ".$exe['name'] ;
	$data->r2 = $exe['qualification'] ;
	$data->r3 = $exe['speciality'] ;
}
if($type == 'Patient')
{
	$data->r1 = $exe['name'] ;
	$data->r2 = $exe['dob'] ;
	$data->r3 = $exe['address'] ;
}
$response->data = $data;
$response->status = "success";
echo json_encode($response);
?>
