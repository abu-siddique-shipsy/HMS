<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';
include Class_path.'class.inpatient.php';
$response = new stdClass();
if(isset($_POST['save_visit']))
{
	$doc_id = $_POST['doc_id'];
	$comments = $_POST['comments'];
	$reg_id = $_POST['reg_id'];
	$obj = new inpatient();

	$response->status = $obj->save_visit($doc_id,$comments,$reg_id);
}
if(isset($_POST['reg_id']))
{

	$reg_id = $_POST['reg_id'];	
	$obj =  inpatient::show_visits($reg_id);
	// print_r($reg_id);
	$response->data = $obj;
}



echo json_encode($response);
?>
