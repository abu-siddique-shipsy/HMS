<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';
 include Class_path.'class.pathology.php';

$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
$id = $_POST['patient_id'];
// echo $id;
if($id != 0)
{
	
	$query = "SELECT rg.room_id,rg.is_inp,rg.registration_id as reg_id,id,sex,name,address,phone_number,dob,(SELECT COUNT(*) from registration rg where rg.patient_id = pt.id) as num_vis,(SELECT MAX(rg.in_at) from registration rg where rg.patient_id = pt.id) as last_visit from patient pt join registration rg on rg.patient_id = pt.id where rg.registration_id = $id group by pt.id";
}
else
{$query = "SELECT rg.registration_id as reg_id,id,sex,name,address,phone_number,dob,(SELECT COUNT(*) from registration rg where rg.patient_id = pt.id) as num_vis,(SELECT MAX(rg.in_at) from registration rg where rg.patient_id = pt.id) as last_visit from patient pt join registration rg on rg.patient_id = pt.id group by pt.id";}
$result_array= [];
$result_array1= [];
$response = new stdClass();

// print_r($query);
$result = $DBcon->query($query);
while ($exe = $result->fetch_assoc()) {
	$patient_id = $exe['id'];

	$result_array[] = $exe;
	$response->is_inp = $exe['is_inp'];
	$response->data = $result_array;
}

if (isset($_POST['complaint'])) {
	$query = "SELECT * FROM registration_flow where patient_id= '$patient_id' order by on_date DESC";
	$query1 = "SELECT * FROM registration_flow where registration_id = '$id'";
	$result1 = $DBcon->query($query1);
	$exe1 = $result1->fetch_array();
	$response->now_complaint = $exe1['complaint'];
	// print_r($query);
	$result = $DBcon->query($query);
	while ($exe = $result->fetch_assoc()) {
		$result_array1[] = $exe;
		$response->complaint = $result_array1;
	}
}
if (isset($_POST['get_proc'])) {
	$reg_id = $_POST['reg_id'];
	$result = pathology::get_procedures($reg_id);
	// $query = "SELECT * FROM lab_requests where reg_id = $reg_id and status = 0";
	// $query1 = "SELECT * FROM registration_flow where registration_id = '$id'";
	// $result1 = $DBcon->query($query1);
	// $exe1 = $result1->fetch_array();
	// $response->now_complaint = $exe1['complaint'];
	// // print_r($query);
	// $result = $DBcon->query($query);
	// while ($exe = $result->fetch_assoc()) {
	// 	$result_array1[] = $exe;
	// 	$response->complaint = $result_array1;
	// }
	$response->data = $result;
}
if (isset($_POST['test_results'])) {
	$data = json_decode($_POST['test_results']);
	$reg_id = $_POST['reg_id'];
	$result = pathology::update_procedures($reg_id,$data);
	// $query = "SELECT * FROM lab_requests where reg_id = $reg_id and status = 0";
	// $query1 = "SELECT * FROM registration_flow where registration_id = '$id'";
	// $result1 = $DBcon->query($query1);
	// $exe1 = $result1->fetch_array();
	// $response->now_complaint = $exe1['complaint'];
	// // print_r($query);
	// $result = $DBcon->query($query);
	// while ($exe = $result->fetch_assoc()) {
	// 	$result_array1[] = $exe;
	// 	$response->complaint = $result_array1;
	// }
	if($result)
		$response->data = "Success";
}


$response->status = "success";
echo json_encode($response);
?>
