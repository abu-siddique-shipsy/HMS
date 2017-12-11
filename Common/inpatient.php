<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';
include Class_path.'class.inpatient.php';
$response = new stdClass();
if(isset($_POST['save_visit']))
{
	$data = $_POST['data'];
	$response->status = inpatient::save_visit($data);
}
if(isset($_POST['reg_id']))
{

	$reg_id = $_POST['reg_id'];	
	$obj =  inpatient::show_visits($reg_id);
	// print_r($reg_id);
	$response->data = $obj;
}
if(isset($_POST['update_room']))
{
	$data = json_decode($_POST['data']);
	$room_id = $data->room_id;
	$reg_id = $data->reg_id;
	$reset = inpatient::reset_room($reg_id);
	// print_r($reset);die;
	if($reset){
		$response->data=inpatient::update_room($room_id,$reg_id);
		$response->details = "Update Successful";
	}
	else{
		$response->details = "Update Failed";
	}


}
if(isset($_POST['get_lab']))
{
	
	
	$reg_id = $_POST['data'];
	$response->data = inpatient::get_lab_details($reg_id);
	$response->status = "success";
	// print_r($reset);die;
}


echo json_encode($response);
?>
