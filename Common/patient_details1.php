<?php

include __DIR__.'\..\config.php';
// include root.'\assets\bootstrap.php';
// include root.'\assets\style.php';
include Class_path.'class.staff.php';
include Class_path.'class.register.php';
$DBcon = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
if(isset($_POST['patient_id']))
{
	$id = $_POST['patient_id'];
	$query = "select * from patient where id = $id";
	$result_array= [];
	$result_array1= [];
	$response = new stdClass();
	// print_r($query);
	$response->data = 1;
	$result = $DBcon->query($query);
	while ($exe = $result->fetch_assoc()) {
		$patient_id = $exe['id'];
		$result_array[] = $exe;
		$response->data = $result_array;
	}


	$response->status = "success";
}
if(isset($_POST['team_id']))
{
	$id = $_POST['team_id'];
	$data = staff::get_staff_by_type($id);
	$response->data = $data;
	$response->status = "success";
	
	
}
if(isset($_POST['inp_pat']))
{
	$inp_pat = $_POST['inp_pat'];
	$data =  $_POST['data'];
	$register_obj = new register($data['pat_id']);
	$register_obj->register_op($data['cons_id'],$inp_pat);
	$register_obj->register_compliant($data['complaint']);
	if($inp_pat)
	{
		$room_id =  $data['room'];
		$insurance =  $data['ins_num'];
		$register_obj->register_ip($room_id,$insurance);
	}
	$response->data = $register_obj;
	$response->status = "success";
	
	
}
if(isset($_POST['pat_reg']))
{
	$data =  $_POST['data'];
	if($data)
	{
		$register_obj = register::patient_update($data);
	}

	$response->patient_id = $register_obj;
	$response->status = "success";
	
	
}
else if(isset($_POST['get_room']))
{
	

	$query = "select * from rooms rm join room_type_map rmt on rm.room_type = rmt.type_id where rm.status = 0";
	$result = $DBcon->query($query);
	$doc_array = [];
	while($exe = $result->fetch_assoc())
	{
		array_push($doc_array,$exe);
	}
	$response = new stdClass();
	$data = $doc_array;
	$response->data = $data;
	$response->status = "success";
	// echo json_encode($response);
}

echo json_encode($response);

?>
